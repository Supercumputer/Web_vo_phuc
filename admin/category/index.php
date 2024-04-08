<?php
    require '../../global.php';
    require '../../dao/pdo.php';
    require '../../dao/category.php';
    require '../../dao/product.php';


    extract($_REQUEST);
    if(exist_param('btn_add_ui')){
        $VIEW_NAME = 'addDM.php';
    }else if(exist_param('btn_add')){

        $category_name = $_POST['category_name'];
        $category_img = save_file('category_img', $UPLOAD_URL);
        $status_hide = $_POST['status_hide'];

        if(category_exist1($category_name)){
            $VIEW_NAME = 'addDM.php';
            echo Show_toast("Tên danh mục đã tồn tại.");
        }else if(category_exist_img($category_img)){
            echo Show_toast("Image đã tồn tại.");
            $VIEW_NAME = 'addDM.php';
        }else{
            category_insert($category_name, $category_img, $status_hide);
            $list_category = category_select_all();
            $VIEW_NAME = 'listDM.php';
            echo Show_toast("Tạo mới danh mục thành công.");
        }
        
    }else if(exist_param('btn_edit')){
        $category_id = $_REQUEST['btn_edit'];
        $category_infor = category_select_by_id($category_id);
        extract($category_infor);
        $VIEW_NAME = "editDM.php";

    }else if(exist_param('btn_update')){
        $category_id = $_POST['category_id'];
        $category_name = $_POST['category_name'];
        $status_hide = $_POST['status_hide'];
        $hinh = $_POST['category_img'];
        $category_img_new = save_file('category_img_new', $UPLOAD_URL);
        $category_img = $category_img_new ? $category_img_new : $hinh;
        $category_infor = category_select_by_id($category_id);
        
        if($category_name === $category_infor['category_name'] || category_exist1($category_name) < 1){
            category_update($category_name, $category_img, $status_hide, $category_id);
            $list_category = category_select_all();
            $VIEW_NAME = 'listDM.php';
            echo Show_toast("Cập nhật danh mục thành công.");
        }else{
            extract($category_infor);
            echo Show_toast("Danh mục đã tồn tại.");
            $VIEW_NAME = "editDM.php";
        }

    }else if(exist_param('btn_delete')){
        $id = $_REQUEST['btn_delete']; 
        $category_id = explode('_', $id);

        foreach($category_id as $list){
            $list_pro = product_select_all_by_category_id($list);
            foreach($list_pro as $listsp){
                product_update_category($listsp['product_id']);
            }
        }

        category_delete($category_id);
        $list_category = category_select_all();
        $VIEW_NAME = 'listDM.php';
        echo Show_toast("Xóa danh mục thành công.");
    }else if(exist_param('key')){
        $keyword = $_REQUEST['key'];
        $list_category = category_select_keyword($keyword);
        $VIEW_NAME = 'listDM.php';
    }else{
        $list_category = category_select_all();
        $VIEW_NAME = 'listDM.php';
    }

    require '../layout.php';

?>