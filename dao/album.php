<?php
    function album_insert($image_url, $product_id){
        $sql = "INSERT INTO albums(image_url, product_id) VALUES (?, ?)";
        pdo_execute($sql, $image_url, $product_id);
    }

    function album_update($image_url, $product_id, $album_id){
        $sql = "UPDATE albums SET image_url=?, product_id=? WHERE album_id=?";
        pdo_execute($sql, $image_url, $product_id, $album_id);
    }

    function album_delete($album_id){
        $sql = "DELETE FROM albums WHERE album_id=?";
        if(is_array($album_id)){
            foreach ($album_id as $ma) {
                pdo_execute($sql, $ma);
            }
        }
        else{
            pdo_execute($sql, $album_id);
        }
    }

    function album_select_all(){
        $sql = "SELECT * FROM albums ORDER BY album_id ASC";
        return pdo_query($sql);
    }

    function album_select_by_id($album_id){
        $sql = "SELECT * FROM albums WHERE album_id=?";
        return pdo_query_one($sql, $album_id);
    }

    function album_select_by_product_id($product_id){
        $sql = "SELECT * FROM albums WHERE product_id=?";
        return pdo_query($sql, $product_id);
    }

    function album_exist_name($image_url){
        $sql = "SELECT count(*) FROM albums WHERE image_url=?";
        return pdo_query_value($sql, $image_url) > 0;
    }

    function album_exist_product_id($product_id){
        $sql = "SELECT count(*) FROM albums WHERE product_id=?";
        return pdo_query_value($sql, $product_id);
    }
    
    function album_select_keyword($keyword, $product_id) {
        $sql = "SELECT * FROM albums WHERE image_url LIKE ? AND product_id = ?";
        return pdo_query($sql, '%'.$keyword.'%', $product_id);
    }

?>




