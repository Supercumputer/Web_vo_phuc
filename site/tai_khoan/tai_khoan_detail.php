<div class="box_profile">
    <div class="wrapper_profile my-3">
      <h2>Thông tin tài khoản chi tiết</h2>
      <form action="index.php?btn_update_tk" method="post" id="form" class="row" enctype="multipart/form-data">
          <div class="col-md-3 col-sm-4 mb-3">
              <div class="img_tk">
                  <img src="<?= !empty($_SESSION['user']['avatar']) ? $UPLOAD_URL.'/'.$_SESSION['user']['avatar'] : $CONTENT.'/image/avatar.jpg'?>" alt="">
              </div>
              <p class="btnss bg-danger"><label for="av">Avatar</label></p>
              <input type="file" name="avatar_new" id="av" style="display: none">
              <input type="hidden" name="avatar" value="<?=$_SESSION['user']['avatar']?>">
          </div>
          <div class="col-md-9 col-sm-8">
            <div>
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label for="formGroupExampleInput2" class="form-label">User name</label>
                        <input type="text" class="form-control" name="user_name" value="<?= $_SESSION['user']['user_name']?>" <?= $_SESSION['user']['user_name'] == 'Admin' ? 'readonly' : ''?>>
                    </div>

                    <div class="col-lg-6">
                        <label for="formGroupExampleInput2" class="form-label">Họ và tên</label>
                        <input type="text" class="form-control" name="full_name" value="<?= $_SESSION['user']['full_name']?>">
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="<?= $_SESSION['user']['email']?>">
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Phone</label>
                    <input type="text" class="form-control" name="phone" value="<?= $_SESSION['user']['phone']?>">
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Địa chỉ</label>
                    <input type="text" class="form-control" name="address" value="<?= $_SESSION['user']['address']?>">
                </div>
                
                <div class="d-flex justify-content-center gap-2">
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                    <a href="index.php?doi_mk_ui"><button type="button" class="btn btn-secondary">Đổi mật khẩu</button></a>
                    <?= $_SESSION['user']['role'] == 1 ? '<a href="'. $ADMIN_URL.'/dasboad/"><button type="button" class="btn btn-success">Tài khoản quản trị</button></a>' : ""?>
                    <a href="index.php?log_out"><button type="button" class="btn btn-danger">Đăng xuất</button></a>
                </div>
            </div>
          </div>
      </form>
    </div>

</div>

<script>
    
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