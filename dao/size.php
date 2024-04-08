<?php
    function size_insert($size_name){
        $sql = "INSERT INTO sizes(size_name) VALUES (?)";
        pdo_execute($sql, $size_name);
    }

    function size_update($size_name, $size_id){
        $sql = "UPDATE sizes SET size_name=? WHERE size_id=?";
        pdo_execute($sql, $size_name, $size_id);
    }

    function size_delete($size_id){
        $sql = "DELETE FROM sizes WHERE size_id=?";
        if(is_array($size_id)){
            foreach ($size_id as $ma) {
                pdo_execute($sql, $ma);
            }
        }
        else{
            pdo_execute($sql, $size_id);
        }
    }

    function size_select_all(){
        $sql = "SELECT * FROM sizes ORDER BY size_id ASC";
        return pdo_query($sql);
    }

    function size_select_by_id($size_id){
        $sql = "SELECT * FROM sizes WHERE size_id=?";
        return pdo_query_one($sql, $size_id);
    }

    function size_exist($size_id){
        $sql = "SELECT count(*) FROM sizes WHERE size_id=?";
        return pdo_query_value($sql, $size_id) > 0;
    }

    function size_exist_name($size_name){
        $sql = "SELECT count(*) FROM sizes WHERE size_name=?";
        return pdo_query_value($sql, $size_name) > 0;
    }

?>




