<?php
    function contact_insert($full_name, $email, $phone, $message, $status_feedback, $created_at){
        $sql = "INSERT INTO contacts(full_name, email, phone, message, status_feedback, created_at) VALUES (?, ?, ?, ?, ?, ?)";
        pdo_execute($sql, $full_name, $email, $phone, $message, $status_feedback, $created_at);
    }

    function contact_update($status_feedback, $contact_id){
        $sql = "UPDATE contacts SET status_feedback=? WHERE contact_id=?";
        pdo_execute($sql, $status_feedback, $contact_id);
    }

    function contact_delete($contact_id){
        $sql = "DELETE FROM contacts WHERE contact_id=?";
        if(is_array($contact_id)){
            foreach ($contact_id as $ma) {
                pdo_execute($sql, $ma);
            }
        }
        else{
            pdo_execute($sql, $contact_id);
        }
    }

    function contact_select_all(){
        $sql = "SELECT * FROM contacts ORDER BY contact_id ASC";
        return pdo_query($sql);
    }

    function contact_select_by_id($contact_id){
        $sql = "SELECT * FROM contacts WHERE contact_id=?";
        return pdo_query_one($sql, $contact_id);
    }

    function contact_select_keyword($keyword, $page_next) {
        $sql = "SELECT * FROM contacts 
        WHERE full_name LIKE ? OR email LIKE ? OR phone LIKE ? OR created_at LIKE ?
        ORDER BY contact_id DESC";

        if($page_next >= 0) {
            $sql .= " LIMIT $page_next, 10";
        }
        return pdo_query($sql, '%'.$keyword.'%', '%'.$keyword.'%', '%'.$keyword.'%', '%'.$keyword.'%');
    }

?>




