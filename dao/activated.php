<?php
    function activated_insert($activated_code, $user_id, $created_at, $is_used){
        $sql = "INSERT INTO activated_token(activated_code, user_id, created_at, is_used) VALUES (?, ?, ?, ?)";
        pdo_execute($sql, $activated_code, $user_id, $created_at, $is_used);
    }

    function activated_update($is_used, $activated_id){
        $sql = "UPDATE activated_token SET is_used=? WHERE activated_id=?";
        pdo_execute($sql, $is_used, $activated_id);
    }

    function activated_delete($activated_id){
        $sql = "DELETE FROM activated_token WHERE activated_id=?";
        if(is_array($activated_id)){
            foreach ($activated_id as $ma) {
                pdo_execute($sql, $ma);
            }
        }
        else{
            pdo_execute($sql, $activated_id);
        }
    }

    function activated_select_all(){
        $sql = "SELECT * FROM activated_token ORDER BY activated_id ASC";
        return pdo_query($sql);
    }


    function activated_select_by_user_id($user_id){
        $sql = "SELECT * FROM activated_token WHERE user_id=?";
        return pdo_query_one($sql, $user_id);
    }

   

?>