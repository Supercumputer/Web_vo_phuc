<?php
    function user_insert($user_name, $full_name, $email, $pass_word, $phone, $avatar, $address, $role, $activated, $created_at){
        $sql = "INSERT INTO users(user_name, full_name, email, pass_word, phone, avatar, address, role, activated, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        pdo_execute($sql, $user_name, $full_name, $email, $pass_word, $phone, $avatar, $address, $role, $activated, $created_at);
    }

    function user_update($user_name, $full_name, $email, $pass_word, $phone, $avatar, $address, $role, $activated, $user_id){
        $sql = "UPDATE users SET user_name=?, full_name=?, email=?, pass_word=?, phone=?, avatar=?, address=?, role=?, activated=? WHERE user_id=?";
        pdo_execute($sql, $user_name, $full_name, $email, $pass_word, $phone, $avatar, $address, $role, $activated, $user_id);
    }

    function user_update_activated($activated, $user_id){
        $sql = "UPDATE users SET activated=? WHERE user_id=?";
        pdo_execute($sql, $activated, $user_id);
    }

    function user_delete($user_id){
        $sql = "DELETE FROM users WHERE user_id=?";
        if(is_array($user_id)){
            foreach ($user_id as $ma) {
                pdo_execute($sql, $ma);
            }
        }
        else{
            pdo_execute($sql, $user_id);
        }
    }

    // function user_select_all($role){
    //     $sql = "SELECT * FROM users WHERE role=? ORDER BY user_id ASC";
    //     return pdo_query($sql, $role);
    // }

    function user_select_top_5_new(){
        $sql = "SELECT * FROM users ORDER BY created_at DESC LIMIT 5";
        return pdo_query($sql);
    }

    function user_select_by_id($user_id){
        $sql = "SELECT * FROM users WHERE user_id=?";
        return pdo_query_one($sql, $user_id);
    }

    function user_select_by_email($email){
        $sql = "SELECT * FROM users WHERE email=?";
        return pdo_query_one($sql, $email);
    }

    function user_exist($user_id){
        $sql = "SELECT count(*) FROM users WHERE user_id=?";
        return pdo_query_value($sql, $user_id) > 0;
    }

    function user_exist_count(){
        $sql = "SELECT count(*) FROM users";
        return pdo_query_value($sql);
    }

    function user_exist_role($role){
        $sql = "SELECT count(*) FROM users WHERE role=?";
        return pdo_query_value($sql, $role);
    }

    function user_exist_name($user_name){
        $sql = "SELECT count(*) FROM users WHERE user_name=?";
        return pdo_query_value($sql, $user_name) > 0;
    }

    function user_exist_email($email){
        $sql = "SELECT count(*) FROM users WHERE email=?";
        return pdo_query_value($sql, $email) > 0;
    }

    function user_exist_phone($phone){
        $sql = "SELECT count(*) FROM users WHERE phone=?";
        return pdo_query_value($sql, $phone) > 0;
    }

    function user_change_pass($pass_word_new, $email){
        $sql = "UPDATE users SET pass_word = ? WHERE email=?";
        return pdo_query($sql, $pass_word_new, $email);
    }

    function user_select_keyword($keyword, $role, $page_next) {
        $sql = "SELECT * FROM users 
        WHERE (user_name LIKE ? 
        OR full_name LIKE ? 
        OR email LIKE ? 
        OR address LIKE ? 
        OR phone LIKE ?) AND role=? ORDER BY user_id ASC";
        if($page_next >= 0) {
            $sql .= " LIMIT $page_next, 10";
        }
        return pdo_query($sql, '%'.$keyword.'%', '%'.$keyword.'%', '%'.$keyword.'%', '%'.$keyword.'%', '%'.$keyword.'%', $role);
    }

?>




