<div class="box_profile">
    <div class="wrapper_profile my-3">
      <h2>Thông tin tài khoản chi tiết</h2>
      <div class="row">
          <div class="col-md-3 col-sm-4 mb-3">
              <div class="img_tk">
                  <img src="<?= !empty($_SESSION['user']['avatar']) ? $UPLOAD_URL.'/'.$_SESSION['user']['avatar'] : $CONTENT.'/image/avatar.jpg'?>" alt="">
              </div>
              <p class="btnss bg-danger"><label for="av">Avatar</label></p>
              <input type="text" name="" id="av" style="display: none">
          </div>
          <div class="col-md-9 col-sm-8">
            <form action="index.php?btn_update_mk" method="post" id="form" class="row g-3">
                
                <div class="">
                    <label for="formGroupExampleInput2" class="form-label">Email</label>
                    <input type="text" class="form-control" name="email" placeholder="" value="<?= $_SESSION['user']['email']?>">
                </div>
                <div class="col-md-12">
                    <label for="inputPassword4" class="form-label">Mật khẩu cũ</label>
                    <input type="password" class="form-control" name="pass_word">
                </div>
                <div class="col-md-12">
                    <label for="inputPassword4" class="form-label">Mật khẩu mới</label>
                    <input type="password" class="form-control" name="pass_word_new" id="pass_word_new">
                </div>
                <div class="">
                    <label for="formGroupExampleInput2" class="form-label">Xác nhận mật khẩu mới</label>
                    <input type="password" class="form-control" name="xn_pass_word">
                </div>

                <div class="d-flex justify-content-center gap-2">
                    <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
                    <a href="index.php"><button type="button" class="btn btn-success">Quản lý tài khoản</button></a>
                </div>
            </form>
          </div>
      </div>
    </div>

</div>
    
<script>
$().ready(function() {
	$("#form").validate({
		onfocusout: false,
		onkeyup: false,
		onclick: false,
		rules: {
			"email": {
                required: true,
                email: true
            },
            "pass_word": {
				required: true,
				minlength: 8
			},
			"pass_word_new": {
				required: true,
				minlength: 8
			},
			"xn_pass_word": {
                required: true,
                equalTo: "#pass_word_new",
                minlength: 8
            }
            
		},

        messages: {
			"email": {
                required: "Vui lòng nhập địa chỉ email.",
                email: "Vui lòng nhập địa chỉ email hợp lệ."
            },
			"pass_word": {
				required: "Mật khẩu không được trống.",
				minlength: "Hãy nhập ít nhất 8 ký tự."
			},
			"pass_word_new": {
                required: "Mật khẩu mới không được trống.",
                minlength: "Hãy nhập ít nhất 8 ký tự."
			},
			"xn_pass_word": {
                required: "Xác nhận mật khẩu mới không được trống.",
                equalTo: "Mật khẩu không khớp.",
                minlength: "Hãy nhập ít nhất 8 ký tự."
            },
           
		}
	});
});
</script>