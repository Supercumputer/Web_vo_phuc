<?php
    function color_insert($color_name){
        $sql = "INSERT INTO colors(color_name) VALUES (?)";
        pdo_execute($sql, $color_name);
    }

    function color_update($color_name, $color_id){
        $sql = "UPDATE colors SET color_name=? WHERE color_id=?";
        pdo_execute($sql, $color_name, $color_id);
    }

    function color_delete($color_id){
        $sql = "DELETE FROM colors WHERE color_id=?";
        if(is_array($color_id)){
            foreach ($color_id as $ma) {
                pdo_execute($sql, $ma);
            }
        }
        else{
            pdo_execute($sql, $color_id);
        }
    }

    function color_select_all(){
        $sql = "SELECT * FROM colors ORDER BY color_id ASC";
        return pdo_query($sql);
    }

    function color_select_by_id($color_id){
        $sql = "SELECT * FROM colors WHERE color_id=?";
        return pdo_query_one($sql, $color_id);
    }

    function color_exist($color_id){
        $sql = "SELECT count(*) FROM colors WHERE color_id=?";
        return pdo_query_value($sql, $color_id) > 0;
    }

    function color_exist_name($color_name){
        $sql = "SELECT count(*) FROM colors WHERE color_name=?";
        return pdo_query_value($sql, $color_name) > 0;
    }
    
?>




