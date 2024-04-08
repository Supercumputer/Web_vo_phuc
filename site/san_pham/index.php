<?php

    // ob_start(); 
    require "../../global.php"; 
    require "../../dao/pdo.php";
    require "../../dao/category.php";
    require "../../dao/product.php";
    require "../../dao/album.php";
    require "../../dao/variant.php";
    require "../../dao/comment.php";
    require "../../dao/size.php";
    require "../../dao/color.php";
    require "../../dao/order_detail.php";

    extract($_REQUEST);
    if(exist_param('san_pham_chi_tiet')){

        $product_id = $_REQUEST['san_pham_chi_tiet'];

        $count_doc = comment_select_all_product_id_hide($product_id, (!isset($start) || $start == 'all' ) ? 0 : $start, -1);

        $total_pages = ceil(sizeof($count_doc) / 8);
    
        $page = $page ?? 1;

        $next_page = ($page - 1) * 8;

        $result_start = round(comment_select_start($product_id), 1);

        $result_rating = comment_select_count_rating($product_id);

        product_view($product_id);

        $infor_sp = product_select_by_id_ui($product_id);

        extract($infor_sp);

        $infor = variant_select_by_price($product_id, $price);

        extract($infor);

        $color_id = $_REQUEST['color_id'] ?? $color_id;

        $list_comment = comment_select_all_product_id_hide($product_id, (!isset($start) || $start == 'all' ) ? 0 : $start, $next_page);
       
        $list_img = album_select_by_product_id($product_id);

        $list_color = variant_select_all_color_by_id($product_id);

        $list_size = variant_select_all_size_by_id($product_id, $color_id);
        
        $size_id = $_REQUEST['size_id'] ?? $list_size[0]['size_id'];

        $infor_varian = variant_select_all_price_by_id($product_id, $color_id, $size_id);

        $result_sold = count_product_sold_variant($infor_varian['variant_id']);

        $count_quantity = $infor_varian['quantity'] - $result_sold;

        $list_sp = product_select_name($category_name);

        $VIEW_NAME = 'san_pham/san_pham_chi_tiet.php';

    }else if(exist_param('keyword')){
       
        $sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'default_sort';

        $count_doc = product_select_keyword_pro($keyword, $sort_by, $color ?? 0, $size ?? 0, -1);

        $total_pages = ceil(sizeof($count_doc) / 8);
     
        $page = $page ?? 1;

        $next_page = ($page - 1) * 8;
        
        $list_sp = product_select_keyword_pro($keyword, $sort_by, $color ?? 0, $size ?? 0, $next_page);

        $list_color = color_select_all();

        $list_size = size_select_all();

        $VIEW_NAME = 'san_pham/san_pham.php';

    } else if (exist_param('btn_comment')) {
        if (isset($_SESSION['user']) && isset($_POST['content']) && !empty(trim($_POST['content'])) && !empty($start)) {

            $content = $_POST['content'];

            $user_id = $_SESSION['user']['user_id'];

            $created_at = date_format(date_create(), 'Y-m-d');

            $status_hide = 1;

            $product_id = isset($_POST['product_id']) ? $_POST['product_id'] : $product_id;

            if(comment_exit_user($product_id, $user_id) < 1){

                comment_insert($content, $created_at, $product_id, $user_id, $status_hide, $start);

                echo Show_toast("Bình luận của bạn đã được ghi nhận.");

            }

        }else{

            echo Show_toast("Bạn chưa nhập nội dung bình luận.");

        }

        $product_id = $_REQUEST['id'];

        $count_doc = comment_select_all_product_id_hide($product_id, 0, -1);

        $total_pages = ceil(sizeof($count_doc) / 8);
    
        $page = $page ?? 1;

        $next_page = ($page - 1) * 8;

        $result_start = round(comment_select_start($product_id), 1);

        $result_rating = comment_select_count_rating($product_id);

        $infor_sp = product_select_by_id_ui($product_id);

        extract($infor_sp);

        $infor = variant_select_by_price($product_id, $price);

        extract($infor);

        $color_id = $_REQUEST['color_id'] ?? $color_id;

        $list_comment = comment_select_all_product_id_hide($product_id, 0, $next_page);

        $list_img = album_select_by_product_id($product_id);

        $list_color = variant_select_all_color_by_id($product_id);

        $list_size = variant_select_all_size_by_id($product_id, $color_id);
        
        $size_id = $_REQUEST['size_id'] ?? $list_size[0]['size_id'];

        $infor_varian = variant_select_all_price_by_id($product_id, $color_id, $size_id);

        $result_sold = count_product_sold_variant($infor_varian['variant_id']);

        $count_quantity = $infor_varian['quantity'] - $result_sold;

        $list_sp = product_select_name($category_name);
        
        $VIEW_NAME = 'san_pham/san_pham_chi_tiet.php';
   
    }else if(exist_param('add_cart')){

        $quantity = (is_numeric($_POST['quantity']) && $_POST['quantity'] > 0) ? $_POST['quantity'] : 1;

        $variant_id = $_POST['variant_id'];

        $image = $_POST['image'];

        $product_name = $_POST['product_name'];

        $list_sp_bt = variant_select_all_variant_by_id($variant_id);
        
        if(!isset($_SESSION['cart'])){

            $_SESSION['cart'] = [];

        } 
        $check = false;

        for($i = 0; $i < sizeof($_SESSION['cart']); $i++){
            
            if($_SESSION['cart'][$i][0] == $product_name && 
                $_SESSION['cart'][$i][3] == $list_sp_bt['color_name'] && 
                $_SESSION['cart'][$i][4] == $list_sp_bt['size_name']){

                    $_SESSION['cart'][$i][5] = $quantity + $_SESSION['cart'][$i][5];

                    echo Show_toast("Cập nhật giỏ hàng thành công.");

                    $check = true;

                    break;
                }
        }

        if(!$check){
            $price = $list_sp_bt['price'] - ($list_sp_bt['price'] * ($list_sp_bt['discount'] / 100));
            $sp = [$product_name, $image, $price, $list_sp_bt['color_name'], $list_sp_bt['size_name'], $quantity, $variant_id];
            $_SESSION['cart'][] = $sp;
            echo Show_toast("Thêm sản phẩm vào giỏ hàng thành công.");
        }

        if(isset($mua_ngay)){
            header('location: '.$SITE_URL.'/gio_hang/index.php');
            die;
        }

        $count_doc = comment_select_all_product_id_hide($list_sp_bt['product_id'], (!isset($start) || $start == 'all' ) ? 0 : $start, -1);

        $total_pages = ceil(sizeof($count_doc) / 8);
    
        $page = $page ?? 1;

        $next_page = ($page - 1) * 8;

        $result_start = round(comment_select_start($list_sp_bt['product_id']), 1);

        $result_rating = comment_select_count_rating($list_sp_bt['product_id']);

        $infor_sp = product_select_by_id_ui($list_sp_bt['product_id']);

        extract($infor_sp);

        $infor = variant_select_by_price($list_sp_bt['product_id'], $price);

        extract($infor);

        $color_id = $_REQUEST['color_id'] ?? $color_id;

        $list_comment = comment_select_all_product_id_hide($list_sp_bt['product_id'], (!isset($start) || $start == 'all' ) ? 0 : $start, $next_page);

        $list_img = album_select_by_product_id($list_sp_bt['product_id']);

        $list_color = variant_select_all_color_by_id($list_sp_bt['product_id']);

        $list_size = variant_select_all_size_by_id($list_sp_bt['product_id'], $color_id);

        $size_id = $_REQUEST['size_id'] ?? $list_size[0]['size_id'];

        $infor_varian = variant_select_all_price_by_id($list_sp_bt['product_id'], $color_id, $size_id);

        $result_sold = count_product_sold_variant($infor_varian['variant_id']);

        $count_quantity = $infor_varian['quantity'] - $result_sold;

        $list_sp = product_select_name($category_name);

        $VIEW_NAME = 'san_pham/san_pham_chi_tiet.php';

    }else{

        $sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'default_sort';

        $count_doc = product_select_keyword_pro("", $sort_by, 0, 0, -1);

        $total_pages = ceil(sizeof($count_doc) / 8);
     
        $page = $page ?? 1;

        $next_page = ($page - 1) * 8;
     
        $list_sp = product_select_keyword_pro("", $sort_by, 0, 0, $next_page);
        
        $list_color = color_select_all();
        
        $list_size = size_select_all();

        $VIEW_NAME = 'san_pham/san_pham.php';
    }

    $list_dm = category_select_all_1();

    require '../layout.php';


// ob_end_flush();
