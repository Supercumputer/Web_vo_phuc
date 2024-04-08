<?php
    ob_start(); 
    require "../../global.php"; 
    require "../../dao/pdo.php";
    require "../../dao/category.php";
    require "../../dao/order.php";
    require "../../dao/order_detail.php";
    require "../../dao/voucher.php";
    require "../../dao/vnp_payment.php";
    require "../../dao/account.php";
    require "../../mail/sendmail.php";

    extract($_REQUEST);

    if(exist_param('thanhtoan')){
        $errors = [];

        if(empty($full_name)){
            $errors['full_name'] = 'Họ và tên không được để trống.'; 
        }

        if(empty($email)){
            $errors['email'] = 'Email không được để trống.'; 
        }

        if(empty($phone)){
            $errors['phone'] = 'Số điện thoại không được để trống.'; 
        }

        if(empty($address)){
            $errors['address'] = 'Địa chỉ giao hàng không được trống.';
        }

        if(empty($errors)){

            if(isset($email) && (user_exist_email($email) > 0 || user_exist_phone($phone) > 0) ){
                
                if(isset($_SESSION['user']) && $_SESSION['user']['email'] == $email && $_SESSION['user']['phone'] == $phone){
                
                }else{
                    $kj = '';
                    if(isset($_SESSION['user'])){
                        if($_SESSION['user']['email'] != $email){
                            $kj = 'Email đã tồn tại';
                        }

                        if($_SESSION['user']['phone'] !== $phone){
                            $kj = 'Phone đã tồn tại';
                        }

                    }else{
                        $check_email = user_exist_email($email);
                        $check_phone = user_exist_phone($phone);
                        $kj = ($check_email == 1 && $check_phone == 1) ? 'Email và SĐT đã tồn tại' : ($check_email == 1 ? 'Email đã tồn tại' : 'Phone đã tồn tại');
                    }
                    
                    $voucher = $voucher_code;
                    $sale = !empty($sale) ? $sale : '0%';
                    echo Show_toast($kj." đã tồn tại.");
                    $VIEW_NAME = 'thanh_toan/thanh_toan.php';
                    $list_dm = category_select_all_1();
                    require '../layout.php';
                    die;
                }
            }
            
            $list_vou = voucher_select_all_status_0();
            $voucher = '';
            
            foreach($list_vou as $list){
                if($voucher_code === $list['voucher_code']){
                    $voucher = $list['voucher_code'];
                    voucher_update_status(1, $list['voucher_id']);
                    break;
                }
            }
            
            $created_at = date_format(date_create(), 'Y-m-d');
        
            $order_id = order_insert($full_name, $email, $phone, $address, $total_price, 5, $voucher, $payment, null, $created_at);

            if($thanhtoan === 'knh'){
                for($i = 0; $i < sizeof($_SESSION['cart'] ?? []); $i++){
                    order_detail_insert($order_id, $_SESSION['cart'][$i][6], $_SESSION['cart'][$i][2], $_SESSION['cart'][$i][5], ($_SESSION['cart'][$i][2] * $_SESSION['cart'][$i][5]));
                }
                order_update_hinh_thuc_thanh_toan(1, 'COD', $order_id);
                unset($_SESSION['cart']);
                $status = "Đặt hàng thành công";
                $check = true;

                if(!isset($_SESSION['user'])){
                    $subject = 'Thông tin đơn hàng của bạn';
                    $body = '<div>
                        <p>Đơn hàng của bạn đã được tạo thành công và đang chờ xác nhận.</p>
                        <p>Mã đơn hàng của bạn là: '.$order_id.'</p>
                        <p>Để hủy đơn hàng vui lòng liên hệ đến hotline 0338973258.</p>
                        <a href="http://localhost:8080/Qshop/site/gio_hang/index.php?don_hang">Tra cứu đơn hàng tại đây.</a>
                    </div>';
                    
                    $status_order = sendEmail($email, $full_name, $subject, $body);
                    echo $status_order;
                    if($status_order == 1){
                        echo Show_toast("Vui lòng kiểm tra email của bạn để lấy id tra cứu đơn hàng");
                    }else{
                        echo Show_toast($status_order);
                    }
                }

                $VIEW_NAME = 'thanh_toan/thanks.php';

            }else{
            
                $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
                $vnp_Returnurl = "http://localhost:8080/Qshop/site/thanh_toan/index.php?thanks";
                $vnp_TmnCode = "73F9JXGN";//Mã website tại VNPAY 
                $vnp_HashSecret = "JKCHPFHWSDOCWHFQAUUBMCDVCIRCFCAD"; //Chuỗi bí mật
                $vnp_TxnRef = $order_id; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
                $vnp_OrderInfo = 'Thanh toán đơn hàng online vnpay';
                $vnp_OrderType = 'billpayment';
                $vnp_Amount = $_POST['payment'] * 100;
                $vnp_Locale = 'vn';
                $vnp_BankCode = '';
                $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
                //Add Params of 2.0.1 Version
                $vnp_ExpireDate = date('YmdHis', strtotime('+1 day'));
                $inputData = array(
                    "vnp_Version" => "2.1.0",
                    "vnp_TmnCode" => $vnp_TmnCode,
                    "vnp_Amount" => $vnp_Amount,
                    "vnp_Command" => "pay",
                    "vnp_CreateDate" => date('YmdHis'),
                    "vnp_CurrCode" => "VND",
                    "vnp_IpAddr" => $vnp_IpAddr,
                    "vnp_Locale" => $vnp_Locale,
                    "vnp_OrderInfo" => $vnp_OrderInfo,
                    "vnp_OrderType" => $vnp_OrderType,
                    "vnp_ReturnUrl" => $vnp_Returnurl,
                    "vnp_TxnRef" => $vnp_TxnRef,
                    "vnp_ExpireDate"=>$vnp_ExpireDate
                );
                
                if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                    $inputData['vnp_BankCode'] = $vnp_BankCode;
                }
                if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
                    $inputData['vnp_Bill_State'] = $vnp_Bill_State;
                }
                
                //var_dump($inputData);
                ksort($inputData);
                $query = "";
                $i = 0;
                $hashdata = "";
                foreach ($inputData as $key => $value) {
                    if ($i == 1) {
                        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                    } else {
                        $hashdata .= urlencode($key) . "=" . urlencode($value);
                        $i = 1;
                    }
                    $query .= urlencode($key) . "=" . urlencode($value) . '&';
                }
                
                $vnp_Url = $vnp_Url . "?" . $query;
                if (isset($vnp_HashSecret)) {
                    $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
                    $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
                }
                $returnData = array('code' => '00'
                    , 'message' => 'success'
                    , 'data' => $vnp_Url);
                    if (isset($_POST['redirect'])) {
                        for($i = 0; $i < sizeof($_SESSION['cart'] ?? []); $i++){
                            order_detail_insert($order_id, $_SESSION['cart'][$i][6], $_SESSION['cart'][$i][2], $_SESSION['cart'][$i][5], ($_SESSION['cart'][$i][2] * $_SESSION['cart'][$i][5]));
                        }
                        order_update_hinh_thuc_thanh_toan(5, 'VNPAY', $order_id);
                        header('Location: ' . $vnp_Url);
                        die();
                    } else {
                        echo json_encode($returnData);
                    }
                    // vui lòng tham khảo thêm tại code demo
            }
        }else{
            $voucher = $voucher_code;
            $sale = !empty($sale) ? $sale : '0%';
            $VIEW_NAME = 'thanh_toan/thanh_toan.php';
        }
    }else if(exist_param('thanks')){
        if(exist_param('vnp_Amount')){
            $order_id = $vnp_TxnRef;
            $status = '';
            $check = true;
            vnp_payment_insert($order_id, $vnp_Amount, $vnp_BankCode, $vnp_BankTranNo ?? '', $vnp_CardType, $vnp_OrderInfo, $vnp_PayDate, $vnp_ResponseCode, $vnp_TmnCode, $vnp_TransactionNo, $vnp_TransactionStatus, $vnp_TxnRef, $vnp_SecureHash);
            if($vnp_ResponseCode == '00' || $vnp_TransactionStatus == '00'){
                $status = "Thanh toán đơn hàng thành công";
                unset($_SESSION['cart']);
                order_update(1, $order_id);

                if(!isset($_SESSION['user'])){
                    $order_infor = order_select_by_id($order_id);
                    
                    $subject = 'Thông tin đơn hàng của bạn';

                    $body = '<div>
                        <p>Đơn hàng của bạn đã được tạo thành công và đang chờ xác nhận.</p>
                        <p>Mã đơn hàng của bạn là: '.$order_id.'</p>
                        <p>Để hủy đơn hàng vui lòng liên hệ đến hotline 0338973258.</p>
                        <a href="http://localhost:8080/Qshop/site/gio_hang/index.php?don_hang">Tra cứu đơn hàng tại đây.</a>
                    </div>';
                    
                    $status_order = sendEmail($order_infor['email'], $order_infor['full_name'], $subject, $body);
    
                    if($status_order == 1){
                        echo Show_toast("Vui lòng kiểm tra email của bạn để lấy id tra cứu đơn hàng");
                    }else{
                        echo Show_toast($status_order);
                    }
                }

            }else{
                $status = "Thanh toán đơn hàng thất bại";
                $check = false;
            }
        }

        $VIEW_NAME = 'thanh_toan/thanks.php';
    }else{
        $full_name = '';
        $email = '';
        $address = '';
        $phone = '';

        $total_price = $_REQUEST['total_price'];
        $sale = "";
        if(isset($voucher)){
            $date_now = date_format(date_create(), 'Y-m-d');
            $list_vou = voucher_select_all_status_0();
            $check = false;
            foreach($list_vou as $list){
                extract($list);
                if($voucher === $voucher_code){
                    if($date_now > $end_date){
                        voucher_update_status(2, $list['voucher_id']);
                        echo Show_toast("voucher đã hết hạn.");
                    }else{
                        $giam = intval($total_price) * ($discount_amount / 100);
                        $payment = intval($total_price) + intval(34000) - $giam;
                        $sale = $discount_amount.'%';
                        $check = true;
                        break;
                    }
                }
            }

            if(!$check){
                $payment = intval($total_price) + intval(34000) ;
                $sale = "0%";
            }

        }else{
            $payment = intval($total_price) + intval(34000) ;
        }
        
        $VIEW_NAME = 'thanh_toan/thanh_toan.php';
    }
    $list_dm = category_select_all_1();
    require '../layout.php';
    ob_end_flush();
?>