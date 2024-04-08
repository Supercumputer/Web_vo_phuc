<?php
    require '../../global.php';
    require '../../dao/pdo.php';
    require '../../dao/statistic.php';
    require '../../dao/account.php';
    require '../../dao/order.php';
    require '../../dao/category.php';
    require '../../dao/product.php';
    
    if(exist_param('mesenger')){
        echo Show_toast("Bạn không đủ quyền truy cập chức năng đó.");
    }

    $count_dm = category_exist_count();
    $count_ac = user_exist_count();
    $count_dh = order_exist_count();
    $count_sp = product_exist_count();

    $list_top_5_user = user_select_top_5_new();
    $list_top_5_order = order_select_top_5_new();
    $result = thong_ke_don_hang_theo_thang();

    $VIEW_NAME = './dasboad.php';
    require '../layout.php';
?>
