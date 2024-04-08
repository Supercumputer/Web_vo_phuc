<?php
    require '../../global.php';
    require '../../dao/pdo.php';
    require '../../dao/brand.php';
    require '../../dao/product.php';

    extract($_REQUEST);

    if(exist_param('btn_add_ui')){
        $VIEW_NAME = 'addBR.php';
    }else if(exist_param('btn_add')){
        $brand_name = $_POST['brand_name'];
        $brand_img = save_file('brand_img', $UPLOAD_URL);
        $status_hide = $_POST['status_hide'];
        if(brand_exist1($brand_name)){
            echo Show_toast("Brand đã tồn tại.");
            $VIEW_NAME = 'addBR.php';
        }else if(brand_exist_img($brand_img)){
            echo Show_toast("Image đã tồn tại.");
            $VIEW_NAME = 'addBR.php';
        }else{
            
            brand_insert($brand_name, $brand_img, $status_hide);
            $list_brand = brand_select_all();
            echo Show_toast("Tạo mới Brand thành công.");
            $VIEW_NAME = 'listBR.php';
        }
        
    }else if(exist_param('btn_edit')){
        $brand_id = $_REQUEST['btn_edit'];
        $brand_infor = brand_select_by_id($brand_id);
        extract($brand_infor);
        $VIEW_NAME = "editBR.php";

    }else if(exist_param('btn_update')){
        $brand_id = $_POST['brand_id'];
        $brand_name = $_POST['brand_name'];
        $status_hide = $_POST['status_hide'];
        $hinh = $_POST['brand_img'];
        $brand_img_new = save_file('brand_img_new', $UPLOAD_URL);
        $brand_img = $brand_img_new ? $brand_img_new : $hinh;
        $brand_infor = brand_select_by_id($brand_id);
        
        if($brand_name === $brand_infor['brand_name'] || brand_exist1($brand_name) < 1 ){
            brand_update($brand_name, $brand_img, $status_hide, $brand_id);
            $list_brand = brand_select_all();
            $VIEW_NAME = 'listBR.php';
            echo Show_toast("Cập nhật Brand thành công.");
        }else{
            extract($brand_infor);
            echo Show_toast("Brand đã tồn tại.");
            $VIEW_NAME = "editBR.php";
        }
    }else if(exist_param('btn_delete')){
        $id = $_REQUEST['btn_delete']; 
        $brand_id = explode('_', $id);

        foreach($brand_id as $list){
            $list_pro = product_select_all_by_brand_id($list);
            foreach($list_pro as $listsp){
                product_update_brand($listsp['product_id']);
            }
        }

        brand_delete($brand_id);
        $list_brand = brand_select_all();
        $VIEW_NAME = 'listBR.php';
        echo Show_toast("Xóa Brand thành công.");
    }else if(exist_param('key')){
        $keyword = $_REQUEST['key'];
        $list_brand = brand_select_keyword($keyword);
        $VIEW_NAME = 'listBR.php';
    }else{
        $list_brand = brand_select_all();
        $VIEW_NAME = 'listBR.php';
    }

    require '../layout.php';

?>