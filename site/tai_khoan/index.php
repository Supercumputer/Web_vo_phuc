<?php
    // ob_start(); 
    require "../../global.php"; 
    require "../../dao/pdo.php";
    require "../../dao/account.php";
    require "../../dao/category.php";
    require "../../dao/activated.php";
    require "../../mail/sendmail.php";

    extract($_REQUEST);
    if(exist_param('register')){
        $VIEW_NAME = 'tai_khoan/register.php';
    }else if(exist_param('btn_login')){
        $user = user_select_by_email($email);
        if($user){
            if($user['activated'] === 1){
                if($user['pass_word'] === $pass_word){
                    if(exist_param('ghi_nho')){
                        setcookie("email", $email, 30);
                        setcookie("pass_word", $pass_word, 30);
                    }else{
                        delete_cookie("email");
                        delete_cookie("pass_word");
                    }
                    $_SESSION['user'] = $user;
                    header('location:'. $SITE_URL.'/trang_chinh/index.php'); 
                }else{
                    echo Show_toast("Mật khẩu không chính xác.");
                }
            }else{
                $check_status = activated_select_by_user_id($user['user_id']);
                if(!empty($check_status) && $check_status['is_used'] == 0 ){
                    echo Show_toast("Tài khoản này chưa được kích hoạt.");
                }else{
                    echo Show_toast("Tài khoản này đang bị khóa.");
                }
            }
        }else{
            echo Show_toast("Email không tồn tại.");
        }

        $VIEW_NAME = 'tai_khoan/log_in.php';
    }else if(exist_param('log_out')){
        session_unset();
        $ma_kh = get_cookie('ma_kh');
        $mat_khau = get_cookie('mat_khau');
        header('location:'. $SITE_URL.'/trang_chinh/index.php'); 
    }else if(exist_param('btn_register')){
        if(user_exist_name($user_name) > 0){
            echo Show_toast("User name đã tồn tại.");
            $VIEW_NAME = 'tai_khoan/register.php';
        }else if(user_exist_email($email) > 0){
            echo Show_toast("Email đã tồn tại.");
            $VIEW_NAME = 'tai_khoan/register.php';
        }else if(user_exist_phone($phone) > 0){
            echo Show_toast("phone đã tồn tại.");
            $VIEW_NAME = 'tai_khoan/register.php';
        }else{
            $user_name = $_POST['user_name'];
            $full_name = $_POST['full_name'];
            $email = $_POST['email'];
            $pass_word = $_POST['pass_word'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $avatar = '';
            $created_at = date_format(date_create(), 'Y-m-d');

            user_insert($user_name, $full_name, $email, $pass_word, $phone, $avatar, $address, 2, 0, $created_at);

            $user_infor = user_select_by_email($email);
          
            echo Show_toast("Tạo tài khoản thành công.");

            if($user_infor['user_id']){
                $token = bin2hex(random_bytes(8));
                activated_insert($token, $user_infor['user_id'], $created_at, 0);

                $subject = 'Mã kích hoạt tài khoản';
                $body = '<div>
                <p>Mã kích hoạt tài khoản của bạn là: '.$token.'</p>
                <a href="http://localhost:8080/Qshop/site/tai_khoan/index.php?kich_hoat">Quay lại trang đăng nhập.</a>
                </div>';
                
                $status = sendEmail($user_infor['email'], $user_infor['user_name'], $subject, $body);

                if($status == 1){
                    echo Show_toast("Vui lòng kiểm tra email của bạn để lấy mã kích hoạt tài khoản.");
                }else{
                    echo Show_toast($status);
                }
            }

            $VIEW_NAME = 'tai_khoan/kich_hoat_tk.php';
        }

    }else if(exist_param('doi_mk_ui')){
        $list_dm = category_select_all_1();
        $VIEW_NAME = 'tai_khoan/doi_mat_khau.php';
        require '../layout.php';
        die;
    }else if(exist_param('btn_update_mk')){
        $user = user_select_by_email($email);
        if($user){
            if($user['pass_word'] == $pass_word){
                try{
                    user_change_pass($pass_word_new, $email);
                    echo Show_toast("Đổi mật khẩu thành công.");
                    $user = user_select_by_email($email);
                    $_SESSION['user'] = $user;
                }catch(Exception $exc){
                    echo Show_toast("Đổi mật khẩu thất bại.");
                }
            }else{
                echo Show_toast("Mật khẩu cũ không khớp.");
            }
        }else{
            echo Show_toast("Email không tồn tại.");
        }
        $list_dm = category_select_all_1();
        $VIEW_NAME = 'tai_khoan/doi_mat_khau.php';
        require '../layout.php';
        die;
    }else if(exist_param('btn_update_tk')){
        $user_infor = user_select_by_id($_SESSION['user']['user_id']);

        if($user_name !== $user_infor['user_name'] && user_exist_name($user_name) > 0){
            echo Show_toast("User name đã tồn tại.");
            
        }else if(user_exist_email($email) > 0 && $email !== $user_infor['email']){
            echo Show_toast("Email đã tồn tại.");
            
        }else if(user_exist_phone($phone) > 0 && $phone !== $user_infor['phone']){
            echo Show_toast("phone đã tồn tại.");
            
        }else{

            $hinh = $_POST['avatar'];
            $avatar_new = save_file('avatar_new', $UPLOAD_URL);
            $avatar = $avatar_new ? $avatar_new : $hinh;
            user_update($user_name, $full_name, $email, $_SESSION['user']['pass_word'], $phone, $avatar, $address, $_SESSION['user']['role'], $_SESSION['user']['activated'], $_SESSION['user']['user_id']);
            $user = user_select_by_email($email);
            $_SESSION['user'] = $user;
            echo Show_toast("Cập nhật tài khoản thành công.");
            
        }
        $list_dm = category_select_all_1();
        $VIEW_NAME = 'tai_khoan/tai_khoan_detail.php';
        require '../layout.php';
        die;

        
    }else if(exist_param('forget_pass_word')){

        if(!empty($email)){
            $user = user_select_by_email($email);
            if($user){
                $subject = 'Lấy lại mật khẩu';
                $body = '<div>
                <p>Mật khẩu của bạn là: '.$user['pass_word'].'</p>
                <a href="http://localhost:8080/Qshop/site/tai_khoan/index.php">Quay lại trang đăng nhập.</a>
                </div>';
                
                $status = sendEmail($user['email'], $user['user_name'], $subject, $body);
                if($status == 1){
                    echo Show_toast("Vui lòng kiểm tra email của bạn để lấy mật khẩu.");
                }else{
                    echo Show_toast($status);
                }
                $VIEW_NAME = 'tai_khoan/log_in.php';
                require '../layout2.php';
                die;
            }else{
                echo Show_toast("Email không tồn tại.");
            }
        }
        $VIEW_NAME = 'tai_khoan/forget_pass_word.php';

    }else if(exist_param('kich_hoat')){

        if(isset($activated_code)){
            if(!empty($activated_code)){

                $list_tk = activated_select_all();

                $check = false;

                foreach($list_tk as $list){

                    if($list['activated_code'] == $activated_code){

                        if($list['is_used'] == 0){

                            activated_update(1, $list['activated_id']);
                            user_update_activated(1, $list['user_id']);
                            $check = true;
                            break;

                        }else{

                            echo Show_toast("Tài khoản này đã được kích hoạt rồi.");
                            $VIEW_NAME = 'tai_khoan/log_in.php';
                            require '../layout2.php';
                            die;
                        }

                    }

                }

                if($check){
                    echo Show_toast("Tài khoản kích hoạt thành công.");
                    $VIEW_NAME = 'tai_khoan/log_in.php';
                }else{
                    echo Show_toast("Mã kích hoạt không tồn tại.");
                    $VIEW_NAME = 'tai_khoan/kich_hoat_tk.php';
                }

            }else{
                echo Show_toast("Bạn chưa nhập mã kích hoạt.");
                $VIEW_NAME = 'tai_khoan/kich_hoat_tk.php';
            }

        }else{
            $VIEW_NAME = 'tai_khoan/kich_hoat_tk.php';
        }

    }else{
        if(isset($_SESSION['user'])){
            $list_dm = category_select_all_1();
            $VIEW_NAME = 'tai_khoan/tai_khoan_detail.php';
            require '../layout.php';
            die;
        }else{
            $VIEW_NAME = 'tai_khoan/log_in.php';
        }
    }
    
    require '../layout2.php';

    // ob_end_flush();
?>