<?php
    function product_insert($product_id, $product_name, $description, $category_id, $brand_id, $created_at){
        $sql = "INSERT INTO products(product_id, product_name, description, category_id, brand_id, created_at) VALUES (?, ?, ?, ?, ?, ?)";
        pdo_execute($sql, $product_id, $product_name, $description, $category_id, $brand_id, $created_at);
    }

    function product_update($product_name, $description, $category_id, $brand_id, $created_at, $product_id){
        $sql = "UPDATE products SET product_name=?, description=?, category_id=?, brand_id=?, created_at=? WHERE product_id=?";
        pdo_execute($sql, $product_name, $description, $category_id, $brand_id, $created_at, $product_id);
    }

    function product_update_category($product_id){
        $sql = "UPDATE products SET category_id = 0 WHERE product_id=?";
        pdo_execute($sql, $product_id);
    }

    function product_update_brand($product_id){
        $sql = "UPDATE products SET brand_id = 0 WHERE product_id=?";
        pdo_execute($sql, $product_id);
    }

    function product_update_status_trash($status_trash, $product_id){
        $sql = "UPDATE products SET status_trash = ? WHERE product_id=?";
        pdo_execute($sql, $status_trash, $product_id);
    }

    function product_delete($product_id){
        $sql = "DELETE FROM products WHERE product_id=?";
        if(is_array($product_id)){
            foreach ($product_id as $ma) {
                pdo_execute($sql, $ma);
            }
        }
        else{
            pdo_execute($sql, $product_id);
        }
    }

    function product_select_all_by_category_id($category_id){
        $sql = "SELECT * FROM products WHERE category_id = ?";
        return pdo_query($sql, $category_id);
    }

    function product_select_all_by_brand_id($brand_id){
        $sql = "SELECT * FROM products WHERE brand_id = ?";
        return pdo_query($sql, $brand_id);
    }

    function product_select_top_view(){
        $sql = "SELECT sp.product_id, sp.product_name, MIN(a.image_url) AS image_url , MIN(bt.price) AS price
        FROM products sp LEFT JOIN albums a ON sp.product_id = a.product_id 
        LEFT JOIN variants bt ON sp.product_id = bt.product_id
        WHERE sp.status_trash = 0 AND a.image_url IS NOT NULL AND bt.price IS NOT NULL
        GROUP BY sp.product_id, sp.product_name
        ORDER BY sp.view DESC LIMIT 8";
        return pdo_query($sql);
    }

    function product_select_name($category_name){
        $sql = "SELECT sp.product_id, sp.product_name, MIN(a.image_url) AS image_url , MIN(bt.price) AS price
        FROM products sp LEFT JOIN albums a ON sp.product_id = a.product_id 
        JOIN categorys dm ON sp.category_id = dm.category_id
        LEFT JOIN variants bt ON sp.product_id = bt.product_id
        WHERE dm.category_name = ? AND a.image_url IS NOT NULL AND bt.price IS NOT NULL AND sp.status_trash = 0
        GROUP BY sp.product_id, sp.product_name
        ORDER BY sp.view DESC LIMIT 8";
        return pdo_query($sql, $category_name);
    }

    function product_select_by_id_ui($product_id){
        $sql = "SELECT sp.*, ct.category_name, br.brand_name, MIN(bt.price) AS price
        FROM products sp LEFT JOIN categorys ct ON sp.category_id = ct.category_id 
        JOIN brands br ON sp.brand_id = br.brand_id 
        JOIN variants bt ON sp.product_id = bt.product_id
        WHERE sp.product_id = ? AND sp.status_trash = 0 
        GROUP BY sp.product_id";
        return pdo_query_one($sql, $product_id);
    }

    function product_select_by_id($product_id){
        $sql = "SELECT * FROM products WHERE product_id=?";
        return pdo_query_one($sql, $product_id);
    }

    function product_exist_count(){
        $sql = "SELECT count(*) FROM products";
        return pdo_query_value($sql);
    }

    function product_exist_name($product_name){
        $sql = "SELECT count(*) FROM products WHERE product_name=?";
        return pdo_query_value($sql, $product_name) > 0;
    }

    function product_exist_id($product_id){
        $sql = "SELECT count(*) FROM products WHERE product_id=?";
        return pdo_query_value($sql, $product_id) > 0;
    }

    function product_view($product_id){
        $sql = "UPDATE products SET view= view + 1 WHERE product_id=?";
        return pdo_execute($sql, $product_id);
    }

    function product_select_keyword($keyword, $page_next, $status_trash) {
        $sql = "SELECT sp.*, ct.category_name, br.brand_name, MIN(a.image_url) AS image_url 
        FROM products sp 
        JOIN categorys ct ON sp.category_id = ct.category_id 
        JOIN brands br ON sp.brand_id = br.brand_id 
        LEFT JOIN albums a ON sp.product_id = a.product_id
        WHERE (sp.product_id LIKE ? OR sp.product_name LIKE ? OR br.brand_name LIKE ? OR ct.category_name LIKE ?)
        AND sp.status_trash = ? 
        GROUP BY sp.product_id
        ORDER BY sp.created_at ASC";
        if($page_next >= 0) {
            $sql .= " LIMIT $page_next, 8";
        }
        return pdo_query($sql, '%'.$keyword.'%', '%'.$keyword.'%', '%'.$keyword.'%', '%'.$keyword.'%', $status_trash);
    }

    // function product_select_keyword_pro($keyword, $sort_by, $page_next) {
    //     $sql = "SELECT sp.product_id, sp.product_name, ct.category_name, br.brand_name, MIN(bt.price) AS price, MIN(ab.image_url) AS image_url 
    //     FROM products sp 
    //     LEFT JOIN categorys ct ON sp.category_id = ct.category_id 
    //     JOIN brands br ON sp.brand_id = br.brand_id 
    //     JOIN variants bt ON sp.product_id = bt.product_id 
    //     JOIN albums ab ON sp.product_id = ab.product_id 
    //     WHERE (product_name LIKE ? OR brand_name LIKE ? OR category_name = ?) 
    //     AND ab.image_url IS NOT NULL AND bt.price IS NOT NULL AND sp.status_trash = 0
    //     GROUP BY sp.product_id ";
    
    //     switch ($sort_by) {
    //         case 'name_asc':
    //             $sql .= "ORDER BY sp.product_name ASC";
    //             break;
    //         case 'name_desc':
    //             $sql .= "ORDER BY sp.product_name DESC";
    //             break;
    //         case 'price_asc':
    //             $sql .= "ORDER BY price ASC";
    //             break;
    //         case 'price_desc':
    //             $sql .= "ORDER BY price DESC";
    //             break;
    //         default:
    //             $sql .= "ORDER BY created_at DESC";
    //             break;
    //     }

    //     if($page_next >= 0) {
    //         $sql .= " LIMIT $page_next, 8";
    //     }
    
    //     return pdo_query($sql, '%'.$keyword.'%', $keyword, $keyword);
    // }

    function product_select_keyword_pro($keyword, $sort_by, $color, $size, $page_next) {
        $sql = "SELECT sp.product_id, sp.product_name, ct.category_name, br.brand_name, MIN(bt.price) AS price, MIN(ab.image_url) AS image_url 
        FROM products sp 
        LEFT JOIN categorys ct ON sp.category_id = ct.category_id 
        JOIN brands br ON sp.brand_id = br.brand_id 
        JOIN variants bt ON sp.product_id = bt.product_id 
        JOIN albums ab ON sp.product_id = ab.product_id 
        WHERE (sp.product_name LIKE ? OR ct.category_name = ?) 
        AND ab.image_url IS NOT NULL AND bt.price IS NOT NULL AND sp.status_trash = 0";

        if($color > 0) {
            $sql .= " AND bt.color_id = $color";
        }

        if($size > 0) {
            $sql .= " AND bt.size_id = $size";
        }

        $sql .= " GROUP BY sp.product_id ";
    
        switch ($sort_by) {
            case 'name_asc':
                $sql .= "ORDER BY sp.product_name ASC";
                break;
            case 'name_desc':
                $sql .= "ORDER BY sp.product_name DESC";
                break;
            case 'price_asc':
                $sql .= "ORDER BY price ASC";
                break;
            case 'price_desc':
                $sql .= "ORDER BY price DESC";
                break;
            default:
                $sql .= "ORDER BY created_at DESC";
                break;
        }

        if($page_next >= 0) {
            $sql .= " LIMIT $page_next, 8";
        }
    
        return pdo_query($sql, '%'.$keyword.'%', $keyword);
    }

?>




