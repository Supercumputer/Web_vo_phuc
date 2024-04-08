<?php
    
    // function thong_ke_doanh_so_theo_ngay(){
    //     $sql ="SELECT DATE(created_at) AS ngay, COUNT(*) AS ban_duoc, 
    //     COUNT(DISTINCT order_id) AS count_order, SUM(payment) AS sum_pay
    //     FROM orders WHERE created_at BETWEEN (SELECT MIN(created_at) FROM orders) 
    //     AND (SELECT MAX(created_at) FROM orders)
    //     GROUP BY DATE(created_at)";
    //     return pdo_query($sql);
    // }

    function thong_ke_doanh_so_theo_ngay_nhap($start_date, $end_date, $page_next){
        $sql ="SELECT DATE(orders.created_at) AS ngay, COUNT(order_details.order_id) AS ban_duoc, 
                COUNT(DISTINCT orders.order_id) AS count_order, SUM(orders.payment) AS sum_pay
                FROM orders LEFT JOIN order_details ON orders.order_id = order_details.order_id 
                WHERE orders.created_at BETWEEN ? AND ?
                GROUP BY DATE(orders.created_at)
                ORDER BY orders.created_at DESC";

        if($page_next >= 0) {
            $sql .= " LIMIT $page_next, 10";
        }

        return pdo_query($sql, $start_date, $end_date);
    }
    
    function thong_ke_don_hang_theo_thang(){
        $sql = "SELECT MONTHNAME(created_at) AS month, COUNT(*) AS total_orders FROM orders GROUP BY MONTHNAME(created_at)";
        return pdo_query($sql);
    }

    function thong_ke_hang_hoa_theo_loai(){
        $sql = "SELECT ct.category_id, ct.category_name, COUNT(*) AS so_luong, 
        MIN(va.price) AS gia_min, MAX(va.price) AS gia_max, AVG(va.price) AS gia_avg
        FROM categorys ct JOIN products sp ON ct.category_id = sp.category_id 
        JOIN variants va ON sp.product_id = va.product_id
        GROUP BY ct.category_id, ct.category_name";
        return pdo_query($sql);
    }

    function thong_ke_hang_ton_kho(){
        $sql = "SELECT va.*, sp.product_name, si.size_name, cl.color_name,
        COALESCE(SUM(dhct.quantity), 0) AS so_luong_da_ban, 
        (va.quantity - COALESCE(SUM(dhct.quantity), 0)) AS so_luong_ton_kho
        FROM variants va 
        LEFT JOIN order_details dhct ON va.variant_id = dhct.variant_id
        LEFT JOIN orders dh ON dh.order_id = dhct.order_id 
        JOIN products sp ON sp.product_id = va.product_id
        JOIN colors cl ON cl.color_id = va.color_id 
        JOIN sizes si ON si.size_id = va.size_id 
        WHERE dh.status_id = 4 OR dh.status_id IS NULL
        GROUP BY va.variant_id
        ORDER BY so_luong_ton_kho DESC LIMIT 10";
        return pdo_query($sql);
    }

    function thong_ke_hang_ban_chay(){
        $sql = "SELECT va.*, sp.product_name, si.size_name, cl.color_name, 
        SUM(dhct.quantity) AS so_luong_da_ban, (va.quantity - SUM(dhct.quantity)) AS so_luong_ton_kho
        FROM variants va JOIN order_details dhct ON va.variant_id = dhct.variant_id
        JOIN orders dh ON dh.order_id = dhct.order_id
        JOIN products sp ON sp.product_id = va.product_id
        JOIN colors cl ON cl.color_id = va.color_id 
        JOIN sizes si ON si.size_id = va.size_id 
        WHERE dh.status_id = 4 
        AND MONTH(dh.created_at) = MONTH(NOW())
        AND YEAR(dh.created_at) = YEAR(NOW()) 
        GROUP BY va.variant_id
        ORDER BY so_luong_da_ban DESC LIMIT 10";
        return pdo_query($sql);
    }

    function thong_ke_hang_ban_chay_theo_ngay($start_date, $end_date){
        $sql = "SELECT va.*, sp.product_name, si.size_name, cl.color_name,
        SUM(dhct.quantity) AS so_luong_da_ban, (va.quantity - SUM(dhct.quantity)) AS so_luong_ton_kho
        FROM variants va JOIN order_details dhct ON va.variant_id = dhct.variant_id
        JOIN orders dh ON dh.order_id = dhct.order_id
        JOIN products sp ON sp.product_id = va.product_id
        JOIN colors cl ON cl.color_id = va.color_id 
        JOIN sizes si ON si.size_id = va.size_id
        WHERE dh.status_id = 4 AND dh.created_at BETWEEN ? AND ?
        GROUP BY va.variant_id
        ORDER BY so_luong_da_ban DESC LIMIT 10";
        return pdo_query($sql, $start_date, $end_date);
    }
    
    
?>