<?php
    // ob_start(); 
    require "../../global.php"; 
    require "../../dao/pdo.php";
    require "../../dao/category.php";
    require "../../dao/order.php";
    require "../../dao/variant.php";
    require "../../dao/order_detail.php";

    extract($_REQUEST);

    if(exist_param('btn_delete')){
        array_splice($_SESSION['cart'], $btn_delete, 1);
        echo Show_toast("Xoá thành công sản phẩm trong giỏ hàng.");
        $VIEW_NAME = 'gio_hang/gio_hang.php';

    }else if(exist_param('btn_delete_all')){
        unset($_SESSION['cart']);
        echo Show_toast("Xoá giỏ hàng thành công.");
        $VIEW_NAME = 'gio_hang/gio_hang.php';

    }else if(exist_param('don_hang')){
        
        $count_doc = [];

        if(isset($_SESSION['user'])){

            if(!empty($status_hide)){
                order_update_status_hide($status_hide);
            }

            $count_doc = order_select_all_email($_SESSION['user']['email'], $_SESSION['user']['phone'], -1);

            $total_pages = ceil(sizeof($count_doc) / 8);
        
            $page = $page ?? 1;

            $next_page = ($page - 1) * 8;

            $list_dh = order_select_all_email($_SESSION['user']['email'], $_SESSION['user']['phone'], $next_page);

        }else if(isset($order_id)){
            if(empty($order_id)){
                echo Show_toast("Bạn chưa nhập vào mã đơn hàng");
            }else{
                $list_dh = order_select_search_id($order_id);
                if(sizeof($list_dh) <= 0){
                    echo Show_toast("Mã đơn hàng không tồn tại.");
                }
            }
        }
        $VIEW_NAME = 'gio_hang/don_hang.php';

    }else if(exist_param('btn_status')){
        $order_id = $_REQUEST['btn_status'];

        $status_id = $_REQUEST['status_id'];

        order_update($status_id, $order_id);

        echo Show_toast("Cập nhật đơn hàng thành công.");

        $count_doc = order_select_all_email($_SESSION['user']['email'], $_SESSION['user']['phone'], -1);

        $total_pages = ceil(sizeof($count_doc) / 8);
    
        $page = $page ?? 1;

        $next_page = ($page - 1) * 8;

        $list_dh = order_select_all_email($_SESSION['user']['email'], $_SESSION['user']['phone'], $next_page);

        $VIEW_NAME = 'gio_hang/don_hang.php';

    }else if(exist_param('mua_lai')){
        $order_id = $_REQUEST['mua_lai'];
        $list_variant = order_detail_select_all_by_order_id($order_id);

        foreach($list_variant as $list){

            $infor_bt = variant_select_all_variant_by_id($list['variant_id']);

            extract($infor_bt);

            if(!isset($_SESSION['cart'])){
                $_SESSION['cart'] = [];
            } 

            $check = false;
    
            for($i = 0; $i < sizeof($_SESSION['cart']); $i++){
                
                if($_SESSION['cart'][$i][0] == $product_name && 
                    $_SESSION['cart'][$i][3] == $color_name && 
                    $_SESSION['cart'][$i][4] == $size_name){

                        $_SESSION['cart'][$i][5] = 1 + $_SESSION['cart'][$i][5];
                        echo Show_toast("Cập nhật giỏ hàng thành công.");
                        $check = true;
        
                        break;
                    }
            }
    
            
            if(!$check){
                $price = $price - ($price * ($discount / 100));
                $sp = [$product_name, $image, $price, $color_name, $size_name, 1, $variant_id];
                $_SESSION['cart'][] = $sp;
            }
        }
        $VIEW_NAME = 'gio_hang/gio_hang.php';
    }else{
        if(!empty($update_quantity)){
            $_SESSION['cart'][$id][5] = $update_quantity;
        }
        $VIEW_NAME = 'gio_hang/gio_hang.php';
    }
    $list_dm = category_select_all_1();
    require '../layout.php';

    // ob_end_flush();
?>