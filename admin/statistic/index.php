<?php
    require '../../global.php';
    require_once '../../dao/pdo.php';
    require_once '../../dao/order.php';
    require_once '../../dao/statistic.php';
    
    extract($_REQUEST);
  
    if(exist_param('btn_tktn')){
        $date = get_min_max_order_dates();

        $count_doc = thong_ke_doanh_so_theo_ngay_nhap(empty($start_date) ? $date['min_date'] : $start_date , empty($end_date) ? $date['max_date'] : $end_date, -1);

        $total_pages = ceil(sizeof($count_doc) / 10);
     
        $page = $page ?? 1;

        $page_next = ($page - 1) * 10;

        $listTK = thong_ke_doanh_so_theo_ngay_nhap(empty($start_date) ? $date['min_date'] : $start_date , empty($end_date) ? $date['max_date'] : $end_date, $page_next);
        
        $VIEW_NAME = 'listTK.php';

    }else if(exist_param('btn_tktk')){

        $listTK = thong_ke_hang_ton_kho();

        $VIEW_NAME = 'listTK2.php';

    }else if(exist_param('btn_tkbc')){
        $thang_hien_tai = date('m'); // Lấy tháng hiện tại
        $nam_hien_tai = date('Y'); // Lấy năm hiện tại
        $date = get_min_max_order_dates();

        if(!empty($start_date) || !empty($end_date)){
            $listTK = thong_ke_hang_ban_chay_theo_ngay(empty($start_date) ? $date['min_date'] : $start_date , empty($end_date) ? $date['max_date'] : $end_date);
        }else{
            $listTK = thong_ke_hang_ban_chay();
        }
        $VIEW_NAME = 'listTK3.php';

    }else if(exist_param('btn_chart')){

        $date = get_min_max_order_dates();

        $listTK1 = thong_ke_hang_hoa_theo_loai();

        $listTk2 = thong_ke_doanh_so_theo_ngay_nhap(empty($start_date) ? $date['min_date'] : $start_date , empty($end_date) ? $date['max_date'] : $end_date, 0);
        
        $VIEW_NAME = 'chart.php';
    }else{
        $listTK1 = thong_ke_hang_hoa_theo_loai();
        $VIEW_NAME = 'listTK1.php';
    }
    require '../layout.php';
?>