<?php
    function voucher_insert($voucher_code, $discount_amount, $created_at, $end_date, $status){
        $sql = "INSERT INTO voucher(voucher_code, discount_amount, created_at, end_date, status) VALUES (?, ?, ?, ?, ?)";
        pdo_execute($sql, $voucher_code, $discount_amount, $created_at, $end_date, $status);
    }

    function voucher_update($voucher_code, $discount_amount, $end_date, $voucher_id){
        $sql = "UPDATE voucher SET voucher_code = ?, discount_amount = ?, end_date = ? WHERE voucher_id=?";
        pdo_execute($sql, $voucher_code, $discount_amount, $end_date, $voucher_id);
    }

    function voucher_update_status($status, $voucher_id){
        $sql = "UPDATE voucher SET status = ? WHERE voucher_id=?";
        pdo_execute($sql, $status, $voucher_id);
    }

    function voucher_select_all(){
        $sql = "SELECT * FROM voucher";
        return pdo_query($sql);
    }

    function voucher_select_all_status_0(){
        $sql = "SELECT * FROM voucher WHERE status = 0";
        return pdo_query($sql);
    }

    function voucher_delete($voucher_id){
        $sql = "DELETE FROM voucher WHERE voucher_id=?";
        if(is_array($voucher_id)){
            foreach ($voucher_id as $ma) {
                pdo_execute($sql, $ma);
            }
        }
        else{
            pdo_execute($sql, $voucher_id);
        }
    }

    function voucher_exist1($voucher_code){
        $sql = "SELECT count(*) FROM voucher WHERE voucher_code=?";
        return pdo_query_value($sql, $voucher_code) > 0;
    }

    function voucher_select_by_id($voucher_id){
        $sql = "SELECT * FROM voucher WHERE voucher_id=?";
        return pdo_query_one($sql, $voucher_id);
    }

    function voucher_select_keyword($keyword) {
        $sql = "SELECT * FROM voucher WHERE voucher_code LIKE ? OR discount_amount = ?";
        return pdo_query($sql, '%'.$keyword.'%', $keyword);
    }

?>