<?php
    require '../../global.php';
    require '../../dao/pdo.php';
    require '../../dao/voucher.php';

    extract($_REQUEST);

    if(exist_param('btn_add_ui')){
        $VIEW_NAME = 'addVC.php';
    }else if(exist_param('btn_add')){
        $created_at = date_format(date_create(), 'Y-m-d');
        if(voucher_exist1($voucher_code)){
            $VIEW_NAME = 'addVC.php';
            echo Show_toast("voucher đã tồn tại.");
        }else if($end_date <= $created_at){
            $VIEW_NAME = 'addVC.php';
            echo Show_toast("Ngày hết hạn phải lớn hơn ngày hiện tại.");
        }else{
            voucher_insert($voucher_code, $discount_amount, $created_at, $end_date, 0);
            $list_voucher = voucher_select_all();
            $VIEW_NAME = 'listVC.php';
            echo Show_toast("Tạo mới voucher thành công.");
        }
        
    }else if(exist_param('btn_edit')){
        $voucher_id = $_REQUEST['btn_edit'];
        $voucher_infor = voucher_select_by_id($voucher_id);
        extract($voucher_infor);
        $VIEW_NAME = "editVC.php";

    }else if(exist_param('btn_update')){
        
        $voucher_infor = voucher_select_by_id($voucher_id);
        $created_at = date_format(date_create(), 'Y-m-d');

        if($end_date <= $created_at){
            extract($voucher_infor);
            echo Show_toast("Ngày hết hạn phải lớn hơn ngày hiện tại.");
            $VIEW_NAME = "editVC.php";
            require '../layout.php';
            die;
        }
        
        if($voucher_code === $voucher_infor['voucher_code'] || voucher_exist1($voucher_code) < 1){
            voucher_update($voucher_code, $discount_amount, $end_date, $voucher_id);
            $list_voucher = voucher_select_all();
            $VIEW_NAME = 'listVC.php';
            echo Show_toast("Cập nhật voucher thành công.");
        }else{
            extract($voucher_infor);
            echo Show_toast("voucher đã tồn tại.");
            $VIEW_NAME = "editVC.php";
        }
    }else if(exist_param('btn_delete')){
        $id = $_REQUEST['btn_delete']; 
        $voucher_id = explode('_', $id);
        voucher_delete($voucher_id);
        $list_voucher = voucher_select_all();
        $VIEW_NAME = 'listVC.php';
        echo Show_toast("Xóa voucher thành công.");
    }else if(exist_param('key')){
        $keyword = $_REQUEST['key'];
        $list_voucher = voucher_select_keyword($keyword);
        $VIEW_NAME = 'listVC.php';
    }else{
        $date_now = date_format(date_create(), 'Y-m-d');
        $list_voucher = voucher_select_all();
        foreach($list_voucher as $list){
            extract($list);
            if($date_now > $end_date){
                voucher_update_status(2, $list['voucher_id']);
            }  
        }
        $VIEW_NAME = 'listVC.php';
    }

    require '../layout.php';

?>