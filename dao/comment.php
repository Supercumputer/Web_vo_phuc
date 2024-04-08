<?php
    function comment_insert($content, $created_at, $product_id, $user_id, $status_hide, $start){
        $sql = "INSERT INTO comments(content, created_at, product_id, user_id, status_hide, start) VALUES (?, ?, ?, ?, ?, ?)";
        pdo_execute($sql, $content, $created_at, $product_id, $user_id, $status_hide, $start);
    }

    function comment_update($status_hide, $comment_id){
        $sql = "UPDATE comments SET status_hide= ? WHERE comment_id=?";
        pdo_execute($sql, $status_hide, $comment_id);
    }

    function comment_delete($comment_id){
        $sql = "DELETE FROM comments WHERE comment_id=?";
        if(is_array($comment_id)){
            foreach ($comment_id as $ma) {
                pdo_execute($sql, $ma);
            }
        }
        else{
            pdo_execute($sql, $comment_id);
        }
    }

    // function comment_select_all_product_id($product_id){
    //     $sql = "SELECT cm.*, ac.user_name, ac.avatar 
    //     FROM comments cm JOIN users ac ON cm.user_id = ac.user_id 
    //     WHERE cm.product_id = ? ORDER BY comment_id DESC";
    //     return pdo_query($sql, $product_id);
    // }

    function comment_select_all_product_id_hide($product_id, $start = 0, $page_next){

        $sql = "SELECT cm.*, ac.user_name, ac.avatar 

        FROM comments cm JOIN users ac ON cm.user_id = ac.user_id 

        WHERE cm.product_id = ? AND cm.status_hide = 1";

        if($start >= 1){
            $sql .= " AND cm.start = $start";
        }
        
        $sql .= " ORDER BY comment_id DESC";

        if($page_next >= 0) {
            $sql .= " LIMIT $page_next, 8";
        }

        return pdo_query($sql, $product_id);
    }

    function comment_select_by_id($comment_id){
        $sql = "SELECT * FROM comments WHERE comment_id=?";
        return pdo_query_one($sql, $comment_id);
    }

    function comment_select_start($product_id){
        $sql = "SELECT AVG(start) AS avg_start FROM comments WHERE product_id=?";
        return pdo_query_value($sql, $product_id);
    }

    function comment_select_count_rating($product_id){
        $sql = "SELECT COUNT(*) AS count_rating FROM comments WHERE product_id=?";
        return pdo_query_value($sql, $product_id);
    }

    function comment_exit_user($product_id, $user_id){
        $sql = "SELECT COUNT(*) FROM comments WHERE product_id = ? AND user_id = ?";
        return pdo_query_value($sql, $product_id, $user_id) > 0;
    }

    function comment_select_keyword_detail($product_id, $keyword, $page_next) {
        $sql = "SELECT cm.*, ac.user_name, ac.avatar  
        FROM comments cm JOIN users ac ON cm.user_id = ac.user_id
        WHERE cm.product_id = ? AND (cm.content LIKE ? OR cm.created_at LIKE ? OR ac.user_name LIKE ? ) 
        ORDER BY comment_id DESC";

        if($page_next >= 0) {
            $sql .= " LIMIT $page_next, 10";
        }
        return pdo_query($sql, $product_id, '%'.$keyword.'%', '%'.$keyword.'%', '%'.$keyword.'%');
    }

    // function thong_ke_comment(){
    //     $sql = "SELECT hh.product_id, hh.product_name, COUNT(*) so_luong, 
    //     MIN(bl.created_at) cu_nhat, MAX(bl.created_at) moi_nhat
    //     FROM comments bl JOIN products hh ON hh.product_id = bl.product_id
    //     GROUP BY hh.product_id, hh.product_name HAVING so_luong > 0";
    //     return pdo_query($sql);
    // }

    function thong_ke_comment_keyword($keyword, $page_next){
        $sql = "SELECT hh.product_id, hh.product_name, COUNT(*) so_luong, 
        MIN(bl.created_at) cu_nhat, MAX(bl.created_at) moi_nhat
        FROM comments bl JOIN products hh ON hh.product_id = bl.product_id
        WHERE hh.product_id LIKE ? OR hh.product_name LIKE ?
        GROUP BY hh.product_id, hh.product_name HAVING so_luong > 0";

        if($page_next >= 0) {
            $sql .= " LIMIT $page_next, 10";
        }
        
        return pdo_query($sql, '%'.$keyword.'%', '%'.$keyword.'%');
    }

?>




