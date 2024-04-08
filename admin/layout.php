<?php

    if(!isset($_SESSION['user']) || ($_SESSION['user']['role'] == 2)){
        header("location: $SITE_URL/trang_chinh/index.php");
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?= $CONTENT?>/image/tanviet.jpg" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= $CONTENT?>/css/style.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
    
    <title>Tân Việt</title>
</head>

<body>
    <div class="container-fluid px-0 d-flex">
        <div class="box_left ">
            <div class="box_infor d-flex flex-column align-items-center">
                <a href="<?=$ADMIN_URL?>/account/index.php?btn_detail">
                    <div class="box_avata mb-2">
                        <img src="<?= !empty($_SESSION['user']['avatar']) ? $UPLOAD_URL.'/'.$_SESSION['user']['avatar']
                            : $CONTENT.'/image/avatar.jpg'?>"
                            class="avatar" alt="">
                    </div>
                </a>
                <h2 class="user_name"><?= $_SESSION['user']['full_name']?></h2>
                <span>Chào mừng bạn trở lại</span>
            </div>

            <div class="box_menu mt-2 d-flex flex-column align-items-center gap-2">
                <div class="box_item d-flex align-items-center gap-3 bg-warning">
                    <i class="fa-solid fa-user-secret"></i>
                    <span>POS Quản trị</span>
                </div>

                <?php require 'menu.php'?>

            </div>
        </div>

        <div class="box_right">

            <div class="box_right_top d-flex flex-row-reverse"><a href="<?=$SITE_URL?>/trang_chinh/index.php"><i class="fa-solid fa-right-from-bracket"></i></a></div>
            <div class="box_right_content col-12 px-3 mt-3">
                <?php require $VIEW_NAME?>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal delete</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">Bạn có chắc muốn xóa không.</div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary"><a>Delete</a></button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!--Toast  -->
            <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <img src="<?=$CONTENT?>/image/logo.png" width="100" height="30" alt="Bootstrap">
                        <strong class="me-auto"></strong>
                        <small>11 mins ago</small>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div id="toast-body-content" class="toast-body"></div>
                </div>
            </div>

        </div>
    </div>
</body>


<script>
    const btn_show = document.querySelectorAll('.btn_show')
    const btn_href = document.querySelector('.modal-footer a')
    const checked_input_all = document.querySelector('.form-check-input[name="input_all"]') 
    const btn_checked_all = document.querySelector('.select-all') 
    const btn_unchecked_all = document.querySelector('.deselect-all') 
    const btn_delete_all = document.querySelector('.delete-selected') 
    const link_delete = document.querySelector('.url_all_delete') 
    const checked_inputs = document.querySelectorAll('.form-check-input[name="input_item"]') 
    
    btn_show.forEach(element => {
        element.onclick = function(){
            let str = ''
            if(this.getAttribute('data_id') !== null){
                str = `&id=${this.getAttribute('data_id')}&name=${this.getAttribute('data_name')}`
            }
            const id = this.getAttribute('data')
            btn_href.setAttribute('href', `index.php?btn_delete=${id}`+ str)
        }
    });

    function showToast(message) {
        var liveToast = new bootstrap.Toast(document.getElementById('liveToast'));
        document.getElementById('toast-body-content').innerHTML = message;
        liveToast.show();
    }

    checked_input_all.addEventListener('change', function() {
        checked_inputs.forEach(function(checkbox) {
            checkbox.checked = checked_input_all.checked ? true : false;
        });
    });

    btn_checked_all.addEventListener('click', function() {
        checked_input_all.checked = true;
        checked_inputs.forEach(function(checkbox) {
            checkbox.checked = true;
        });
    });

    btn_unchecked_all.addEventListener('click', function() {
        checked_inputs.forEach(function(checkbox) {
            checkbox.checked = false;
        });
        checked_input_all.checked = false;
    });

    checked_inputs.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            if(checked_inputs.length > document.querySelectorAll('.form-check-input[name="input_item"]:checked').length){
                checked_input_all.checked = false;
            }else{
                checked_input_all.checked = true;
            }
        });
        
    });

    btn_delete_all.addEventListener('click', function() {
        let str = ''
        if(checked_inputs[0].getAttribute('data_id') !== null){
            str = `&id=${checked_inputs[0].getAttribute('data_id')}&name=${checked_inputs[0].getAttribute('data_name')}`
        }

        const input_checked = document.querySelectorAll('.form-check-input[name="input_item"]:checked')
        let href = "";
        input_checked.forEach(function(checkbox) {
            href += "_" + checkbox.value;
        });
        
        href = href.substring(1);
        link_delete.href = "index.php?btn_delete="+ href + str
        link_delete.click()
    });
    
</script>  
</html>


        