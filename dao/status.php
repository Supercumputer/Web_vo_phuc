<?php

function status_select_all(){
    $sql = "SELECT * FROM status ORDER BY status_id ASC";
    return pdo_query($sql);
}


?>