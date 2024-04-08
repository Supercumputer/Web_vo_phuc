<?php
    require '../../global.php';
    require '../../dao/pdo.php';
    require '../../dao/contact.php';
    require "../../mail/sendmail.php";

    extract($_REQUEST);
    if(exist_param('btn_edit')){
        $contact_id = $_REQUEST['btn_edit'];
        $contact_infor = contact_select_by_id($contact_id);
        extract($contact_infor);
        $VIEW_NAME = "editCT.php";

    }else if(exist_param('btn_update')){
        
        $subject = 'Phản hồi khách hàng';
        $body = '<div>
        <p>Chúng tôi chân thành cảm ơn bạn '.$full_name.' đã liên hệ với chúng tôi.</p>
        <p>'.$phan_hoi.'</p>
        <a href="http://localhost:8080/Qshop/site/trang_chinh/index.php">Trang web của chúng tôi.</a>
        </div>';
        
        $status = sendEmail($email, $full_name, $subject, $body);
        if($status == 1){
            contact_update(1, $contact_id);
            echo Show_toast("Phản hồi đã được gửi thành công.");
        }else{
            echo Show_toast($status);
        }

        $count_doc = contact_select_keyword('', -1);

        $total_pages = ceil(sizeof($count_doc) / 10);
     
        $page = $page ?? 1;

        $page_next = ($page - 1) * 10;

        $list_contact = contact_select_keyword('', $page_next);
        
        $VIEW_NAME = 'listCT.php';
        
    }else if(exist_param('btn_delete')){
        $id = $_REQUEST['btn_delete']; 
        $contact_id = explode('_', $id);
        contact_delete($contact_id);

        $count_doc = contact_select_keyword('', -1);

        $total_pages = ceil(sizeof($count_doc) / 10);
     
        $page = $page ?? 1;

        $page_next = ($page - 1) * 10;

        $list_contact = contact_select_keyword('', $page_next);
        
        $VIEW_NAME = 'listCT.php';
        echo Show_toast("Xóa phản hồi thành công.");
    }else if(exist_param('key')){
        $keyword = $_REQUEST['key'];
        
        $count_doc = contact_select_keyword($keyword, -1);

        $total_pages = ceil(sizeof($count_doc) / 10);
     
        $page = $page ?? 1;

        $page_next = ($page - 1) * 10;

        $list_contact = contact_select_keyword($keyword, $page_next);
        $VIEW_NAME = 'listCT.php';
    }else{
        $count_doc = contact_select_keyword('', -1);

        $total_pages = ceil(sizeof($count_doc) / 10);
     
        $page = $page ?? 1;

        $page_next = ($page - 1) * 10;

        $list_contact = contact_select_keyword('', $page_next);

        // $list_contact = contact_select_all();
        $VIEW_NAME = 'listCT.php';
    }

    require '../layout.php';

?>