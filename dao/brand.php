<?php
    function brand_insert($brand_name, $brand_img, $status_hide){
        $sql = "INSERT INTO brands(brand_name, brand_img, status_hide) VALUES (?, ?, ?)";
        pdo_execute($sql, $brand_name, $brand_img, $status_hide);
    }

    function brand_update($brand_name, $brand_img, $status_hide, $brand_id){
        $sql = "UPDATE brands SET brand_name=?, brand_img=?, status_hide=? WHERE brand_id=?";
        pdo_execute($sql, $brand_name, $brand_img, $status_hide, $brand_id);
    }

    function brand_delete($brand_id){
        $sql = "DELETE FROM brands WHERE brand_id=?";
        if(is_array($brand_id)){
            foreach ($brand_id as $ma) {
                pdo_execute($sql, $ma);
            }
        }
        else{
            pdo_execute($sql, $brand_id);
        }
    }


    function brand_select_all(){
        $sql = "SELECT * FROM brands ORDER BY brand_id ASC";
        return pdo_query($sql);
    }

    function brand_exist1($brand_name){
        $sql = "SELECT count(*) FROM brands WHERE brand_name=?";
        return pdo_query_value($sql, $brand_name) > 0;
    }

    function brand_exist_img($brand_img){
        $sql = "SELECT count(*) FROM brands WHERE brand_img=?";
        return pdo_query_value($sql, $brand_img) > 0;
    }

    function brand_select_by_id($brand_id){
        $sql = "SELECT * FROM brands WHERE brand_id=?";
        return pdo_query_one($sql, $brand_id);
    }

    function brand_select_keyword($keyword) {
        $sql = "SELECT * FROM brands WHERE brand_name LIKE ?";
        return pdo_query($sql, '%'.$keyword.'%');
    }

    function brand_select_status_hide(){
        $sql = "SELECT * FROM brands WHERE status_hide = 1 ORDER BY brand_id ASC";
        return pdo_query($sql);
    }

?>