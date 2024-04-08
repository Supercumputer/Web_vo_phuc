<?php
    function variant_insert($product_id, $size_id, $color_id, $price, $quantity){
        $sql = "INSERT INTO variants(product_id, size_id, color_id, price, quantity) VALUES (?, ?, ?, ?, ?)";
        pdo_execute($sql, $product_id, $size_id, $color_id, $price, $quantity);
    }

    function variant_update($product_id, $size_id, $color_id, $price, $quantity, $discount, $variant_id){
        $sql = "UPDATE variants SET product_id=?, size_id=?, color_id=?, price=?, quantity=?, discount=? WHERE variant_id=?";
        pdo_execute($sql, $product_id, $size_id, $color_id, $price, $quantity, $discount, $variant_id);
    }

    function variant_delete($variant_id){
        $sql = "DELETE FROM variants WHERE variant_id=?";
        if(is_array($variant_id)){
            foreach ($variant_id as $ma) {
                pdo_execute($sql, $ma);
            }
        }
        else{
            pdo_execute($sql, $variant_id);
        }
    }

    function variant_select_all(){
        $sql = "SELECT va.*, sp.product_name, si.size_name, cl.color_name 
        FROM variants va JOIN sizes si ON va.size_id = si.size_id 
        JOIN colors cl ON va.color_id = cl.color_id 
        JOIN products sp ON va.product_id = sp.product_id
        ORDER BY variant_id ASC";
        return pdo_query($sql);
    }

    function variant_select_by_product_id($product_id){
        $sql = "SELECT va.*, sp.product_name, si.size_name, cl.color_name 
        FROM variants va JOIN sizes si ON va.size_id = si.size_id 
        JOIN colors cl ON va.color_id = cl.color_id 
        JOIN products sp ON va.product_id = sp.product_id
        WHERE va.product_id=?
        ORDER BY va.variant_id ASC";
        return pdo_query($sql, $product_id);
    }

    function variant_select_all_color_by_id($product_id){
        $sql = "SELECT DISTINCT cl.color_name, cl.color_id FROM variants va JOIN colors cl 
        ON va.color_id = cl.color_id WHERE va.product_id = ?
        ORDER BY variant_id ASC";
        return pdo_query($sql, $product_id);
    }

    function variant_select_all_size_by_id($product_id, $color_id){
        $sql = "SELECT DISTINCT va.price, si.size_name, si.size_id FROM variants va JOIN sizes si 
        ON va.size_id = si.size_id WHERE va.product_id = ? AND va.color_id = ? 
        ORDER BY variant_id ASC";
        return pdo_query($sql, $product_id, $color_id);
    }

    function variant_select_all_price_by_id($product_id, $color_id, $size_id){
        $sql = "SELECT va.*, si.size_name, cl.color_name FROM variants va JOIN sizes si 
        ON va.size_id = si.size_id JOIN colors cl 
        ON va.color_id = cl.color_id WHERE va.product_id = ? AND va.color_id = ? AND va.size_id = ?";
        return pdo_query_one($sql, $product_id, $color_id, $size_id);
    }

    function variant_select_all_variant_by_id($variant_id){
        $sql = "SELECT va.*, si.size_name, cl.color_name, sp.product_name, MIN(ab.image_url) AS image FROM variants va 
        JOIN sizes si ON va.size_id = si.size_id 
        JOIN colors cl ON va.color_id = cl.color_id 
        JOIN products sp ON va.product_id = sp.product_id
        JOIN albums ab ON ab.product_id = sp.product_id
        WHERE va.variant_id = ? ";
        return pdo_query_one($sql, $variant_id);
    }

    function variant_select_by_price($product_id, $price){
        $sql = "SELECT va.* FROM variants va WHERE va.product_id = ? AND va.price = ?";
        return pdo_query_one($sql, $product_id, $price);
    }
    
    function variant_select_by_id($variant_id){
        $sql = "SELECT * FROM variants WHERE variant_id=?";
        return pdo_query_one($sql, $variant_id);
    }

    function variant_exist($variant_id){
        $sql = "SELECT count(*) FROM variants WHERE variant_id=?";
        return pdo_query_value($sql, $variant_id) > 0;
    }

    function variant_exist_all($product_id, $size_id, $color_id){
        $sql = "SELECT count(*) FROM variants WHERE product_id = ? AND size_id = ? AND color_id = ?";
        return pdo_query_value($sql, $product_id, $size_id, $color_id) > 0;
    }

    function variant_exist_all_size($product_id, $size_id){
        $sql = "SELECT count(*) FROM variants WHERE product_id = ? AND size_id = ?";
        return pdo_query_value($sql, $product_id, $size_id) > 0;
    }

    function variant_exist_all_color($product_id, $color_id){
        $sql = "SELECT count(*) FROM variants WHERE product_id = ? AND color_id = ?";
        return pdo_query_value($sql, $product_id, $color_id) > 0;
    }

    function variant_exist_product_id($product_id){
        $sql = "SELECT count(*) FROM variants WHERE product_id=?";
        return pdo_query_value($sql, $product_id);
    }

    function permistion_comment($product_id, $email){
        $sql = "SELECT count(*) FROM variants va
        JOIN order_details dhct ON dhct.variant_id = va.variant_id 
        JOIN orders dh ON dh.order_id = dhct.order_id 
        WHERE va.product_id=? AND dh.email = ? AND (dh.status_id = 4 OR dh.status_id = 6)";
        return pdo_query_value($sql, $product_id, $email) > 0;
    }

    function variant_select_keyword($keyword, $product_id) {
        $sql = "SELECT va.*,sp.product_name, si.size_name, cl.color_name 
        FROM variants va JOIN sizes si ON va.size_id = si.size_id 
        JOIN colors cl ON va.color_id = cl.color_id 
        JOIN products sp ON va.product_id = sp.product_id
        WHERE (sp.product_name LIKE ? OR si.size_name LIKE ? OR cl.color_name LIKE ?) AND va.product_id = ?";
        return pdo_query($sql, '%'.$keyword.'%', '%'.$keyword.'%', '%'.$keyword.'%', $product_id);
    }


?>




