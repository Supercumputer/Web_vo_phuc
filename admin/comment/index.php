<?php
    require '../../global.php';
    require '../../dao/pdo.php';
    require '../../dao/comment.php';
    extract($_REQUEST);
    if(exist_param('btn_detail')){
        $product_id = $_REQUEST['btn_detail'];

        $count_doc = comment_select_keyword_detail($product_id, '', -1);

        $total_pages = ceil(sizeof($count_doc) / 10);
     
        $page = $page ?? 1;

        $page_next = ($page - 1) * 10;

        $list_comment_detail = comment_select_keyword_detail($product_id, '', $page_next);

        $VIEW_NAME = 'detailCM.php';

    }else if(exist_param('btn_delete')){
        $id = $_REQUEST['btn_delete'];
        $product_id = $_REQUEST['id'];
        $comment_id = explode('_', $id);
        comment_delete($comment_id);

        $count_doc = comment_select_keyword_detail($product_id, '', -1);

        $total_pages = ceil(sizeof($count_doc) / 10);
     
        $page = $page ?? 1;

        $page_next = ($page - 1) * 10;

        $list_comment_detail = comment_select_keyword_detail($product_id, '', $page_next);
       
        $VIEW_NAME = 'detailCM.php';
        echo Show_toast("Xóa bình luận thành công.");
    }else if(exist_param('btn_edit')){
        $comment_id = $_REQUEST['btn_edit'];
        $comment_infor = comment_select_by_id($comment_id);
        extract($comment_infor);
        $VIEW_NAME = 'editCM.php';
    }else if(exist_param('btn_update')){
        $comment_id = $_POST['comment_id'];
        $status_hide = $_POST['status_hide'];
        $product_id = $_POST['product_id'];
        comment_update($status_hide, $comment_id);

        $count_doc = comment_select_keyword_detail($product_id, '', -1);

        $total_pages = ceil(sizeof($count_doc) / 10);
     
        $page = $page ?? 1;

        $page_next = ($page - 1) * 10;

        $list_comment_detail = comment_select_keyword_detail($product_id, '', $page_next);

        $VIEW_NAME = 'detailCM.php';
        
        echo Show_toast("Cập nhật bình luận thành công.");
    }else if(exist_param('key')){
        $keyword = $_REQUEST['key'];

        $count_doc = comment_select_keyword_detail($product_id, $keyword, -1);

        $total_pages = ceil(sizeof($count_doc) / 10);
     
        $page = $page ?? 1;

        $page_next = ($page - 1) * 10;

        $list_comment_detail = comment_select_keyword_detail($product_id, $keyword, $page_next);

        $VIEW_NAME = 'detailCM.php';
    }else if(exist_param('keys')){
        $keyword = $_REQUEST['keys'];

        $count_doc = thong_ke_comment_keyword($keyword, -1);

        $total_pages = ceil(sizeof($count_doc) / 10);
     
        $page = $page ?? 1;

        $page_next = ($page - 1) * 10;

        $list_comment = thong_ke_comment_keyword($keyword, $page_next);

        $VIEW_NAME = 'listCM.php';
    }else{
        $count_doc = thong_ke_comment_keyword('', -1);

        $total_pages = ceil(sizeof($count_doc) / 10);
     
        $page = $page ?? 1;

        $page_next = ($page - 1) * 10;

        $list_comment = thong_ke_comment_keyword('', $page_next);

        $VIEW_NAME = 'listCM.php';
    }

    require '../layout.php';

?>