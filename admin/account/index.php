<?php
    require '../../global.php';
    require '../../dao/pdo.php';
    require '../../dao/account.php';
    extract($_REQUEST);
    
    if(exist_param('btn_list')){
        $role = $_REQUEST['btn_list'];

        $count_doc = user_select_keyword('', $role, -1);

        $total_pages = ceil(sizeof($count_doc) / 10);
     
        $page = $page ?? 1;

        $page_next = ($page - 1) * 10;

        $list_user = user_select_keyword('', $role, $page_next);

        $VIEW_NAME = 'listTK.php';

    }else if(exist_param('btn_add_ui')){
        $VIEW_NAME = 'addTK.php';
    }else if(exist_param('btn_add')){
        if(user_exist_name($user_name) > 0){
            echo Show_toast("User name đã tồn tại.");
            $VIEW_NAME = 'addTK.php';
        }else if(user_exist_email($email) > 0){
            echo Show_toast("Email đã tồn tại.");
            $VIEW_NAME = 'addTK.php';
        }else if(user_exist_phone($phone) > 0){
            echo Show_toast("phone đã tồn tại.");
            $VIEW_NAME = 'addTK.php';
        }else{
            $user_name = $_POST['user_name'];
            $full_name = $_POST['full_name'];
            $email = $_POST['email'];
            $pass_word = $_POST['pass_word'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $role = $_POST['role'];
            $avatar = save_file('avatar', $UPLOAD_URL);
            $created_at = date_format(date_create(), 'Y-m-d');
            user_insert($user_name, $full_name, $email, $pass_word, $phone, $avatar, $address, $role, 0, $created_at);
            $manager = user_exist_role(1);
            $customer = user_exist_role(2);
            echo Show_toast("Tạo tài khoản thành công.");
            $VIEW_NAME = 'account.php';
        }
    }else if(exist_param('btn_edit')){
        $user_id = $_REQUEST['btn_edit'];
        $user_infor = user_select_by_id($user_id);
        extract($user_infor);
        $VIEW_NAME = "editTK.php";
    }else if(exist_param('btn_update')){
        $user_id = $_POST['user_id'];
        $user_name = $_POST['user_name'];
        $full_name = $_POST['full_name'];
        $email = $_POST['email'];
        $pass_word = $_POST['pass_word'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $role = $_POST['role'];
        $hinh = $_POST['avatar'];
        $avatar_new = save_file('avatar_new', $UPLOAD_URL);
        $avatar = $avatar_new ? $avatar_new : $hinh;
        $activated = $_POST['activated'];
        $user_infor = user_select_by_id($user_id);
        
        if($user_name !== $user_infor['user_name'] && user_exist_name($user_name) > 0){
            echo Show_toast("User name đã tồn tại.");
            $VIEW_NAME = 'editTK.php';
        }else if(user_exist_email($email) > 0 && $email !== $user_infor['email']){
            echo Show_toast("Email đã tồn tại.");
            $VIEW_NAME = 'editTK.php';
        }else if(user_exist_phone($phone) > 0 && $phone !== $user_infor['phone']){
            echo Show_toast("phone đã tồn tại.");
            $VIEW_NAME = 'editTK.php';
        }else{
            user_update($user_name, $full_name, $email, $pass_word, $phone, $avatar, $address, $role, $activated, $user_id);

            echo Show_toast("Cập nhật khoản thành công.");

            $count_doc = user_select_keyword('', $role, -1);

            $total_pages = ceil(sizeof($count_doc) / 10);
        
            $page = $page ?? 1;

            $page_next = ($page - 1) * 10;

            $list_user = user_select_keyword('', $role, $page_next);
    
            $VIEW_NAME = 'listTK.php';
        }

    }else if(exist_param('btn_delete')){
        $role = $_REQUEST['id'];

        $id = $_REQUEST['btn_delete'];

        $user_id = explode('_', $id);
        
        $count_doc = user_select_keyword('', $role, -1);

        $total_pages = ceil(sizeof($count_doc) / 10);
     
        $page = $page ?? 1;

        $page_next = ($page - 1) * 10;

        foreach($user_id as $user){
            if($user == $_SESSION['user']['user_id']){
                echo Show_toast("Không được xóa chính mình.");
            }else{
                user_delete($user);
                echo Show_toast("Xóa tài khoản thành công.");
            }
        }

        $list_user = user_select_keyword('', $role, $page_next);
      
        $VIEW_NAME = 'listTK.php';
    }else if(exist_param('key')){
        $keyword = $_REQUEST['key'];

        $count_doc = user_select_keyword($keyword, $role, -1);

        $total_pages = ceil(sizeof($count_doc) / 10);
     
        $page = $page ?? 1;

        $page_next = ($page - 1) * 10;

        $list_user = user_select_keyword($keyword, $role, $page_next);

        $VIEW_NAME = 'listTK.php';

    }else if(exist_param('btn_detail')){
        $VIEW_NAME = 'detail.php';
    }else{
        $manager = user_exist_role(1);
        $customer = user_exist_role(2);
        $VIEW_NAME = 'account.php';
    }

    if(exist_param('btn_detail') || ($_SESSION['user']['role'] == 1 && $_SESSION['user']['user_name'] == 'Admin')){
        require '../layout.php';
    }else{
        header("location: $ADMIN_URL/dasboad/index.php?mesenger");
    }

?>