<?php
     require '../../global.php';
     require '../../dao/pdo.php';
     require '../../dao/order.php';
     require '../../dao/status.php';
   
     extract($_REQUEST);
      if(exist_param('btn_edit')){
        $order_id = $_REQUEST['btn_edit'];
        $order_infor = order_select_by_id($order_id);
        $list_order_detail = order_detail_select_alls($order_id);
        $list_status = status_select_all();
        extract($order_infor);
        $VIEW_NAME = "editDH.php";
 
     }else if(exist_param('btn_update')){
        $order_id = $_POST['order_id'];
        $status_id = $_POST['status_id'];
        order_update($status_id, $order_id);
        $count_doc = order_select_keyword('', -1);

        $total_pages = ceil(sizeof($count_doc) / 8);
     
        $page = $page ?? 1;

        $page_next = ($page - 1) * 8;

        $list_order = order_select_keyword('', $page_next);
        
        $VIEW_NAME = 'listDH.php';
        echo Show_toast("Cập nhật đơn hàng thành công.");
        
     }else if(exist_param('btn_delete')){
        $id = $_REQUEST['btn_delete'];
        $order_id = explode('_', $id);
        order_delete($order_id);
        $count_doc = order_select_keyword('', -1);

        $total_pages = ceil(sizeof($count_doc) / 8);
     
        $page = $page ?? 1;

        $page_next = ($page - 1) * 8;

        $list_order = order_select_keyword('', $page_next);

        $VIEW_NAME = 'listDH.php';

        echo Show_toast("Xóa đơn hàng thành công.");
        
     }else if(exist_param('key')){
        $keyword = $_REQUEST['key'];

        $count_doc = order_select_keyword($keyword, -1);

        $total_pages = ceil(sizeof($count_doc) / 8);
     
        $page = $page ?? 1;

        $page_next = ($page - 1) * 8;

        $list_order = order_select_keyword($keyword, $page_next);

        $VIEW_NAME = 'listDH.php';
     }else{
        $count_doc = order_select_keyword('', -1);

        $total_pages = ceil(sizeof($count_doc) / 8);
     
        $page = $page ?? 1;

        $page_next = ($page - 1) * 8;

        $list_order = order_select_keyword('', $page_next);

        $VIEW_NAME = 'listDH.php';
    }

    require '../layout.php';

?>