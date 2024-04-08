<?php
    // function order_insert($full_name, $email, $phone, $address, $total_price, $status_id, $voucher, $payment, $created_at){
    //     $sql = "INSERT INTO orders(full_name, email, phone, address, total_price, status_id, voucher, payment, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    //     pdo_execute($sql, $full_name, $email, $phone, $address, $total_price, $status_id, $voucher, $payment, $created_at);
    // }

    function order_insert($full_name, $email, $phone, $address, $total_price, $status_id, $voucher, $payment, $hinh_thuc_thanh_toan, $created_at){
        $conn = pdo_get_connection();
        $sql = "INSERT INTO orders(full_name, email, phone, address, total_price, status_id, voucher, payment, hinh_thuc_thanh_toan, created_at) VALUES ('$full_name', '$email', '$phone', '$address', '$total_price', '$status_id', '$voucher', '$payment', '$hinh_thuc_thanh_toan', '$created_at')";
        $conn->exec($sql);
        $last_id = $conn->lastInsertId();
        return $last_id;
    }

    function order_update($status_id, $order_id){
        $sql = "UPDATE orders SET status_id=? WHERE order_id=?";
        pdo_execute($sql, $status_id, $order_id);
    }

    function order_update_hinh_thuc_thanh_toan($status_id, $hinh_thuc_thanh_toan, $order_id){
        $sql = "UPDATE orders SET status_id = ?, hinh_thuc_thanh_toan = ? WHERE order_id=?";
        pdo_execute($sql, $status_id, $hinh_thuc_thanh_toan, $order_id);
    }

    function order_delete($order_id){
        $sql = "DELETE FROM orders WHERE order_id=?";
        if(is_array($order_id)){
            foreach ($order_id as $ma) {
                pdo_execute($sql, $ma);
            }
        }
        else{
            pdo_execute($sql, $order_id);
        }
    }

    function order_update_status_hide($order_id){
        $sql = "UPDATE orders SET status_hide = 1 WHERE order_id = ?";
        return pdo_execute($sql, $order_id);
    }

    function order_select_all_email($email, $phone, $page_next){
        $sql = "SELECT dh.*, st.status_name FROM orders dh 
        JOIN status st ON dh.status_id = st.status_id 
        WHERE dh.email = ? AND dh.phone = ? AND dh.status_hide = 0
        ORDER BY order_id DESC";
        if($page_next >= 0) {
            $sql .= " LIMIT $page_next, 8";
        }
        return pdo_query($sql, $email, $phone);
    }

    function order_select_search_id($order_id){
        $sql = "SELECT * FROM orders WHERE order_id=? ORDER BY order_id DESC";
        return pdo_query($sql, $order_id);
    }

    function order_detail_select_all($order_id){
        $sql = "SELECT ct.*,sp.product_id, sp.product_name, cl.color_name, si.size_name
        FROM order_details ct JOIN variants bt ON ct.variant_id = bt.variant_id 
        JOIN products sp ON bt.product_id = sp.product_id 
        JOIN colors cl ON cl.color_id = bt.color_id
        JOIN sizes si ON si.size_id = bt.size_id
        WHERE ct.order_id = ?
        ORDER BY order_detail_id ASC";
        return pdo_query($sql, $order_id);
    }

    function order_select_by_id($order_id){
        $sql = "SELECT * FROM orders WHERE order_id=? ORDER BY order_id DESC";
        return pdo_query_one($sql, $order_id);
    }

    function order_select_top_5_new(){
        $sql = "SELECT dh.*, st.status_name 
        FROM orders dh JOIN status st ON dh.status_id = st.status_id
        ORDER BY created_at DESC LIMIT 5";
        return pdo_query($sql);
    }

    function order_exist($order_id){
        $sql = "SELECT count(*) FROM orders WHERE order_id=?";
        return pdo_query_value($sql, $order_id) > 0;
    }

    function order_exist_count(){
        $sql = "SELECT count(*) FROM orders";
        return pdo_query_value($sql);
    }

    function order_exist_role($role){
        $sql = "SELECT count(*) FROM orders WHERE role=?";
        return pdo_query_value($sql, $role);
    }

    function order_exist_name($full_name){
        $sql = "SELECT count(*) FROM orders WHERE full_name=?";
        return pdo_query_value($sql, $full_name) > 0;
    }

    function order_exist_email($email){
        $sql = "SELECT count(*) FROM orders WHERE email=?";
        return pdo_query_value($sql, $email) > 0;
    }

    function get_min_max_order_dates(){
        $sql = "SELECT MIN(created_at) AS min_date, MAX(created_at) AS max_date FROM orders";
        return pdo_query_one($sql);
    }

    function order_select_keyword($keyword, $page_next) {
        $sql = "SELECT dh.*, st.status_name FROM orders dh 
        JOIN status st ON dh.status_id = st.status_id 
        WHERE dh.full_name LIKE ? OR dh.email LIKE ? OR dh.address LIKE ? OR dh.phone LIKE ? OR dh.order_id = ? 
        ORDER BY order_id DESC";
        if($page_next >= 0) {
            $sql .= " LIMIT $page_next, 8";
        }
        return pdo_query($sql, '%'.$keyword.'%', '%'.$keyword.'%', '%'.$keyword.'%', '%'.$keyword.'%', $keyword);
    }

    function order_detail_select_alls($order_id){
        $sql = "SELECT hdct.*, cl.color_name, si.size_name, sp.product_name, sp.product_id, MIN(al.image_url) AS image
        FROM order_details hdct 
        JOIN variants va ON hdct.variant_id = va.variant_id 
        JOIN products sp ON sp.product_id = va.product_id 
        JOIN albums al ON al.product_id = sp.product_id 
        JOIN colors cl ON cl.color_id = va.color_id
        JOIN sizes si ON si.size_id = va.size_id
        WHERE hdct.order_id = ?
        GROUP BY hdct.order_detail_id
        ORDER BY order_detail_id ASC";
        return pdo_query($sql, $order_id);
    }

   
?>




