<?php
    function order_detail_insert($order_id, $variant_id, $price, $quantity, $unit_price){
        $sql = "INSERT INTO order_details(order_id, variant_id, price, quantity, unit_price) VALUES (?, ?, ?, ?, ?)";
        pdo_execute($sql, $order_id, $variant_id, $price, $quantity, $unit_price);
    }

    function count_product_sold_variant($variant_id){
        $sql = "SELECT COALESCE(SUM(dhct.quantity), 0) AS so_luong_ban_duoc FROM order_details dhct 
        JOIN orders dh ON dhct.order_id = dh.order_id
        WHERE (dh.status_id = 4 OR dh.status_id = 6) AND dhct.variant_id = ?";
        return pdo_query_value($sql, $variant_id);
    }

    function order_detail_select_all_by_order_id($order_id){
        $sql = "SELECT variant_id FROM order_details
        WHERE order_id = ?";
        return pdo_query($sql, $order_id);
    }
?>