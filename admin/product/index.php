<?php
    require '../../global.php';
    require '../../dao/pdo.php';
    require '../../dao/product.php';
    require '../../dao/category.php';
    require '../../dao/brand.php';
    require '../../dao/variant.php';
    require '../../dao/color.php';
    require '../../dao/size.php';
    require '../../dao/album.php';


    extract($_REQUEST);

    if(exist_param('btn_add_ui')){
        $list_category = category_select_all();
        $list_brand = brand_select_all();
        $VIEW_NAME = 'addSP.php';
    }else if(exist_param('btn_add')){
        
        if(product_exist_name($product_name)){
            $list_category = category_select_all();
            $list_brand = brand_select_all();
            $VIEW_NAME = 'addSP.php';
            echo Show_toast("Tên sản phẩm đã tồn tại.");
        }else if(product_exist_id($product_id)){
            $list_category = category_select_all();
            $list_brand = brand_select_all();
            $VIEW_NAME = 'addSP.php';
            echo Show_toast("Mã sản phẩm đã tồn tại.");
        }else{
            $product_id = $_POST['product_id'];
            $product_name = $_POST['product_name'];
            $category_id = $_POST['category_id'];
            $brand_id = $_POST['brand_id'];
            $created_at = date_format(date_create(), 'Y-m-d');
            $description = $_POST['description'];

            product_insert($product_id, $product_name, $description, $category_id, $brand_id, $created_at);

            $count_doc = product_select_keyword('', -1, 0);

            $total_pages = ceil(sizeof($count_doc) / 8);
        
            $page = $page ?? 1;

            $page_next = ($page - 1) * 8;

            $list_product = product_select_keyword('', $page_next, 0);
            $VIEW_NAME = 'listSP.php';
            echo Show_toast("Tạo mới sản phẩm thành công.");
        }
        
    }else if(exist_param('btn_edit')){
        $product_id = $_REQUEST['btn_edit'];
        $list_category = category_select_all();
        $list_brand = brand_select_all();
        $product_infor = product_select_by_id($product_id);
        extract($product_infor);
        $VIEW_NAME = "editSP.php";

    }else if(exist_param('btn_update')){
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $description = $_POST['description'];
        $brand_id = $_POST['brand_id'];
        $category_id = $_POST['category_id'];
        $created_at = $_POST['created_at'];
        $product_infor = product_select_by_id($product_id);
        
        if($product_name === $product_infor['product_name'] || product_exist_name($product_name) < 1){
            product_update($product_name, $description, $category_id, $brand_id, $created_at, $product_id);
            $count_doc = product_select_keyword('', -1, isset($status_trash) ? $status_trash : 0);

            $total_pages = ceil(sizeof($count_doc) / 8);
        
            $page = $page ?? 1;

            $page_next = ($page - 1) * 8;

            $list_product = product_select_keyword('', $page_next, isset($status_trash) ? $status_trash : 0);

            $VIEW_NAME = (isset($status_trash) && $status_trash == 1) ? 'listTrash.php' : 'listSP.php';

            echo Show_toast("Cập nhật sản phẩm thành công.");

        }else{

            $list_category = category_select_all();
            $list_brand = brand_select_all();
            extract($product_infor);
            echo Show_toast("Sản phẩm đã tồn tại.");
            $VIEW_NAME = "editSP.php";
        }
    }else if(exist_param('btn_delete')){
        
        $id = $_REQUEST['btn_delete'];
        $id_sp = $_REQUEST['id'];
        $id_c = explode('_', $id);

        if($name == 'sp'){
            $count_doc = product_select_keyword('', -1, 0);

            $total_pages = ceil(sizeof($count_doc) / 8);
        
            $page = $page ?? 1;

            $page_next = ($page - 1) * 8;

            foreach($id_c as $listid){
                product_update_status_trash(1, $listid);
            }

            $list_product = product_select_keyword('', $page_next, 0);

            $VIEW_NAME = 'listSP.php';

            echo Show_toast("Xóa sản phẩm thành công.");

        }else if($name == 'destroy'){

            $count_doc = product_select_keyword('', -1, 1);

            $total_pages = ceil(sizeof($count_doc) / 8);
        
            $page = $page ?? 1;

            $page_next = ($page - 1) * 8;

            product_delete($id_c);
       
            $list_product = product_select_keyword('', $page_next, 1);

            $VIEW_NAME = 'listTrash.php';

            echo Show_toast("Sản phẩm đã bị xóa hoàn toàn.");
        }else if($name == 'bt'){
            variant_delete($id_c);
            $list_variant = variant_select_by_product_id($id_sp);
            $VIEW_NAME = 'listBT.php';
            echo Show_toast("Xóa biến thể thành công.");
        }else{
            album_delete($id_c);
            $list_album = album_select_by_product_id($id_sp);
            $VIEW_NAME = 'listAB.php';
            echo Show_toast("Xóa hình ảnh thành công.");
        }
    }else if(exist_param('key')){
   
        $keyword = $_REQUEST['key'];

        $count_doc = product_select_keyword($keyword, -1, (isset($status_trash) && $status_trash == 1) ? $status_trash : 0);

        $total_pages = ceil(sizeof($count_doc) / 8);
     
        $page = $page ?? 1;

        $page_next = ($page - 1) * 8;

        $list_product = product_select_keyword($keyword, $page_next, (isset($status_trash) && $status_trash == 1) ? $status_trash : 0);

        $VIEW_NAME = (isset($status_trash) && $status_trash == 1) ? 'listTrash.php' : 'listSP.php';

    }else if(exist_param('list_trash')){

        $count_doc = product_select_keyword('', -1, 1);

        $total_pages = ceil(sizeof($count_doc) / 8);
     
        $page = $page ?? 1;

        $page_next = ($page - 1) * 8;

        $list_product = product_select_keyword('', $page_next, 1);

        $VIEW_NAME = 'listTrash.php';

    }else if(exist_param('btn_restore')){

        $product_id = $_REQUEST['btn_restore'];

        product_update_status_trash(0, $product_id);

        $count_doc = product_select_keyword('', -1, 1);

        $total_pages = ceil(sizeof($count_doc) / 8);
     
        $page = $page ?? 1;

        $page_next = ($page - 1) * 8;

        $list_product = product_select_keyword('', $page_next, 1);

        echo Show_toast("Khôi phục sản phẩm thành công.");

        $VIEW_NAME = 'listTrash.php';

    }else if(exist_param('manager_sp')){
        $product_id = $_REQUEST['manager_sp'];
        $count_album = album_exist_product_id($product_id);
        $count_variant = variant_exist_product_id($product_id);
        $VIEW_NAME = 'detailSP.php';
    }else if(exist_param('variant')){
        $product_id = $_REQUEST['variant'];
        $list_variant = variant_select_by_product_id($product_id);
        $VIEW_NAME = 'listBT.php';

    }else if(exist_param('variant_add_ui')){
        $product_id = $_REQUEST['variant_add_ui'];
        $list_color = color_select_all();
        $list_size = size_select_all();
        $VIEW_NAME = 'addBT.php';
    }else if(exist_param('variant_add')){
        if(variant_exist_all($product_id, $size_id, $color_id)){
            $list_color = color_select_all();
            $list_size = size_select_all();
            $VIEW_NAME = 'addBT.php';
            echo Show_toast("Biến thể đã tồn tại.");
        }else{
            $product_id = $_POST['product_id'];
            $color_id = $_POST['color_id'];
            $size_id = $_POST['size_id'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];
            variant_insert($product_id, $size_id, $color_id, $price, $quantity);
            $list_variant = variant_select_by_product_id($product_id);
            $VIEW_NAME = 'listBT.php';
            echo Show_toast("Tạo mới biến thể thành công.");
        }
    }else if(exist_param('variant_edit')){
        $variant_id = $_REQUEST['variant_edit'];
        $list_color = color_select_all();
        $list_size = size_select_all();
        $variant_infor = variant_select_by_id($variant_id);
        extract($variant_infor);
        $VIEW_NAME = "editBT.php";

    }else if(exist_param('variant_update')){
        $variant_id = $_POST['variant_id'];
        $product_id = $_POST['product_id'];
        $color_id = $_POST['color_id'];
        $size_id = $_POST['size_id'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $discount = $_POST['discount'];

        $variant_infor = variant_select_by_id($variant_id);
        
        if(($product_id == $variant_infor['product_id'] && $color_id == $variant_infor['color_id'] && $size_id == $variant_infor['size_id']) || variant_exist_all($product_id, $size_id, $color_id) < 1){
            variant_update($product_id, $size_id, $color_id, $price, $quantity, $discount, $variant_id);
            $list_variant = variant_select_by_product_id($product_id);
            $VIEW_NAME = 'listBT.php';
            echo Show_toast("Cập nhật biến thể thành công.");
        }else{
            $list_color = color_select_all();
            $list_size = size_select_all();
            extract($variant_infor);
            echo Show_toast("Biến thể đã tồn tại.");
            $VIEW_NAME = "editBT.php";
        }
    }else if(exist_param('variant_delete')){
        $id = $_REQUEST['variant_delete'];
        $variant_id = explode('_', $id);
        variant_delete($variant_id);
        $list_variant = variant_select_by_product_id($product_id);
        $VIEW_NAME = 'listBT.php';
        echo Show_toast("Xóa biến thể thành công.");
    }else if(exist_param('variant_key')){
        $keyword = $_REQUEST['variant_key'];
        $list_variant = variant_select_keyword($keyword, $product_id);
        $VIEW_NAME = 'listBT.php';

    }else if(exist_param('album')){
        $product_id = $_REQUEST['album'];
        $list_album = album_select_by_product_id($product_id);
        $VIEW_NAME = 'listAB.php';
    }else if(exist_param('album_add_ui')){
        $product_id = $_REQUEST['album_add_ui'];
        $VIEW_NAME = 'addAB.php';
    }else if(exist_param('album_add')){
        $product_id = $_POST['product_id'];
        $files = $_FILES['images'];
        $list = $files['name'];

        foreach($list as $key => $item){
            if(album_exist_name($item) < 1){
                $target_part = $UPLOAD_URL . $item;
                move_uploaded_file($files['tmp_name'][$key], $target_part);
                album_insert($item, $product_id);
            }else{
                echo Show_toast($item." đã tồn tại.");
                continue;
            }
            echo Show_toast("Tạo mới hình ảnh thành công.");
        }

        $list_album = album_select_by_product_id($product_id);
        $VIEW_NAME = 'listAB.php';

    }else if(exist_param('album_edit')){
        $album_id = $_REQUEST['album_edit'];
        $album_infor = album_select_by_id($album_id);
        extract($album_infor);
        $VIEW_NAME = "editAB.php";

    }else if(exist_param('album_update')){
        $album_id = $_POST['album_id'];
        $product_id = $_POST['product_id'];
        $hinh = $_POST['image_url'];
        $img_new = save_file('image_url_new', $UPLOAD_URL);
        $image_url = $img_new ? $img_new : $hinh;

        $album_infor = album_select_by_id($album_id);
        
        if($image_url === $album_infor['image_url'] || album_exist_name($image_url) < 1){
            album_update($image_url, $product_id, $album_id);
            $list_album = album_select_by_product_id($product_id);
            $VIEW_NAME = 'listAB.php';
            echo Show_toast("Cập nhật hình ảnh thành công.");
        }else{
            extract($album_infor);
            echo Show_toast("Hình ảnh đã tồn tại.");
            $VIEW_NAME = "editAB.php";
        }
    }else if(exist_param('album_delete')){
        $id = $_REQUEST['album_delete'];
        $album_id = explode('_', $id);
        album_delete($album_id);
        $list_album = album_select_all();
        $VIEW_NAME = 'listAB.php';
        echo Show_toast("Xóa hình ảnh thành công.");
    }else if(exist_param('album_key')){
        $keyword = $_REQUEST['album_key'];
        $list_album = album_select_keyword($keyword, $product_id);
        $VIEW_NAME = 'listAB.php';
    }else{
        $count_doc = product_select_keyword('', -1, 0);

        $total_pages = ceil(sizeof($count_doc) / 8);
     
        $page = $page ?? 1;

        $page_next = ($page - 1) * 8;

        $list_product = product_select_keyword('', $page_next, 0);

        $VIEW_NAME = 'listSP.php';
    }

    require '../layout.php';

?>