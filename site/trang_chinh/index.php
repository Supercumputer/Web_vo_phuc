<?php
    // ob_start(); 
    require "../../global.php"; 
    require "../../dao/pdo.php";
    require "../../dao/category.php";
    require "../../dao/brand.php";
    require "../../dao/product.php";
    require "../../dao/contact.php";

    extract($_REQUEST);
    if(exist_param('gioi_thieu')){
        $VIEW_NAME = 'trang_chinh/gioi_thieu.php';
    }else if(exist_param('lien_he')){
        if(!empty($_POST)){
            $created_at = date_format(date_create(), 'Y-m-d');
            contact_insert($full_name, $email, $phone, $message, 0, $created_at);
            echo Show_toast("Chúng tôi sẽ phản hồi trong thời gian sớm nhất.");
        }
        $VIEW_NAME = 'trang_chinh/lien_he.php';
    }else if(exist_param('tin_tuc')){
        $VIEW_NAME = 'trang_chinh/tin_tuc.php';
    }else if(exist_param('san_pham')){
        $VIEW_NAME = 'trang_chinh/san_pham.php';
    }else{
        $list_sp = product_select_name('Taekwondo');
        $list_sp_view = product_select_top_view();
        $list_br = brand_select_status_hide();
        $VIEW_NAME = 'trang_chinh/home.php';
    }
    $list_dm = category_select_all_1();
    require '../layout.php';

    // ob_end_flush();
?>