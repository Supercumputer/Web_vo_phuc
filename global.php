<?php
    session_start();
    $SL_PER_PAGE = 10;
    $ROOT_URL = "/Qshop";
    $CONTENT = "$ROOT_URL/content";
    $ADMIN_URL = "$ROOT_URL/admin";
    $SITE_URL  = "$ROOT_URL/site";
    $UPLOAD_URL = "../../upload/";
   
    function exist_param($filedname){
        return array_key_exists($filedname, $_REQUEST);
    }

    function save_file($filedname, $target_dir){
        $file_uploaded = $_FILES[$filedname];
        $file_name = basename($file_uploaded['name']);
        $target_part = $target_dir . $file_name;
        move_uploaded_file($file_uploaded['tmp_name'], $target_part);
        return $file_name;
    }

    function set_cookie($name, $value, $day){
        return setcookie($name, $value, time() + (86400 * $day), '/');
    }
    
    function get_cookie($name){
        return $_COOKIE[$name] ?? "";
    }

    function delete_cookie($name){
        return set_cookie($name, "", -1);
    }

    
    function Show_toast($title){
        return "<script>
             document.addEventListener('DOMContentLoaded', function() {
                 showToast('$title');
             });
             </script>";
     }

     function check_url ($name){
        $current_url = "http://$_SERVER[SERVER_NAME]$_SERVER[REQUEST_URI]";
        return strpos($current_url, $name) !== false; 
     }

     function drawStars($rating, $lass) {
        echo '<div class="stars-container '.$lass.'">';
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $rating) {
                echo '<span class="star" style="color: gold;font-size: 20px;">&#9733;</span>'; // Solid star
            } else {
                echo '<span class="star" style="color: gray;font-size: 20px;">&#9734;</span>'; // Empty star
            }
        }
        echo '</div>';
    }

    
?>