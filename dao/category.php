<?php
    function category_insert($category_name, $category_img, $status_hide){
        $sql = "INSERT INTO categorys(category_name, category_img, status_hide) VALUES (?, ?, ?)";
        pdo_execute($sql, $category_name, $category_img, $status_hide);
    }

    function category_update($category_name, $category_img, $status_hide, $category_id){
        $sql = "UPDATE categorys SET category_name=?, category_img=?, status_hide=? WHERE category_id=?";
        pdo_execute($sql, $category_name, $category_img, $status_hide, $category_id);
    }

    function category_delete($category_id){
        $sql = "DELETE FROM categorys WHERE category_id=?";
        if(is_array($category_id)){
            foreach ($category_id as $ma) {
                pdo_execute($sql, $ma);
            }
        }
        else{
            pdo_execute($sql, $category_id);
        }
    }

    function category_select_all(){
        $sql = "SELECT * FROM categorys ORDER BY category_id ASC";
        return pdo_query($sql);
    }

    function category_select_all_1(){
        $sql = "SELECT * FROM categorys WHERE status_hide = 1 ORDER BY category_id ASC";
        return pdo_query($sql);
    }

    function category_select_by_id($category_id){
        $sql = "SELECT * FROM categorys WHERE category_id=?";
        return pdo_query_one($sql, $category_id);
    }

    function category_exist($category_id){
        $sql = "SELECT count(*) FROM categorys WHERE category_id=?";
        return pdo_query_value($sql, $category_id) > 0;
    }

    function category_exist_count(){
        $sql = "SELECT count(*) FROM categorys";
        return pdo_query_value($sql);
    }

    function category_exist1($category_name){
        $sql = "SELECT count(*) FROM categorys WHERE category_name=?";
        return pdo_query_value($sql, $category_name) > 0;
    }

    function category_exist_img($category_img){
        $sql = "SELECT count(*) FROM categorys WHERE category_img=?";
        return pdo_query_value($sql, $category_img) > 0;
    }
    
    function category_select_keyword($keyword) {
        $sql = "SELECT * FROM categorys WHERE category_name LIKE ?";
        return pdo_query($sql, '%'.$keyword.'%');
    }

?>




