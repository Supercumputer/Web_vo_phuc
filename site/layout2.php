<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?= $CONTENT?>/image/tanviet.jpg" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"
        type="text/javascript"></script>
    <!-- <link rel="stylesheet" href="login.css"> -->
    <link rel="stylesheet" href="<?=$CONTENT?>/css/index.css">

    <title>Tân Việt</title>
</head>

<body>

    <div class="box_contens d-flex justify-content-center align-items-center">
        <?php require $VIEW_NAME?>
    </div>
    
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <img src="<?=$CONTENT?>/image/logo.png" width="100" height="30" alt="Bootstrap">
            <strong class="me-auto"></strong>
            <small class="text-muted">11 mins ago</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div id="toast-body-content" class="toast-body"></div>
    </div>
</div>
</body>

</html>
<script>
    function showToast(message) {
        var liveToast = new bootstrap.Toast(document.getElementById('liveToast'));
        document.getElementById('toast-body-content').innerHTML = message;
        liveToast.show();
    }

    $(document).ready(function() {
    $("#form").validate({
        onfocusout: false,
        onkeyup: false,
        onclick: false,
        rules: {
            "user_name": {
                required: true,
                maxlength: 15
            },
            "full_name": {
                required: true,
                minlength: 2
            },
            "pass_word": {
                required: true,
                minlength: 8
            },
            "re-password": {
                equalTo: "#pass_word",
                minlength: 8
            },
            "email": {
                required: true,
                email: true
            },
            "phone": {
                required: true,
                minlength: 8
            },
            "address": {
                required: true,
                minlength: 8
            }
        },
        messages: {
            "user_name": {
                required: "Vui lòng nhập tên người dùng.",
                maxlength: "Tên người dùng không được vượt quá 15 ký tự."
            },
            "full_name": {
                required: "Vui lòng nhập họ và tên.",
                minlength: "Họ và tên phải có ít nhất 2 ký tự."
            },
            "pass_word": {
                required: "Vui lòng nhập mật khẩu.",
                minlength: "Mật khẩu phải có ít nhất 8 ký tự."
            },
            "re-password": {
                equalTo: "Mật khẩu nhập lại phải giống với mật khẩu đã nhập trước đó.",
                minlength: "Mật khẩu nhập lại phải có ít nhất 8 ký tự."
            },
            "email": {
                required: "Vui lòng nhập địa chỉ email.",
                email: "Vui lòng nhập địa chỉ email hợp lệ."
            },
            "phone": {
                required: "Vui lòng nhập số điện thoại.",
                minlength: "Số điện thoại phải có ít nhất 8 ký tự."
            },
            "address": {
                required: "Vui lòng nhập địa chỉ.",
                minlength: "Địa chỉ phải có ít nhất 8 ký tự."
            }
        }
    });
});

</script>