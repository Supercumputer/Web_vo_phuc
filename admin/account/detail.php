
<div class="box_tite mb-3">Quản lý tài khoản</div>

<div class="box_table my-3">
    <h2 class="py-2 mx-3">Thông tin tài khoản chi tiết</h2>

    <div class="box_wap mx-3 py-3">
        <form action="index.php?btn_update" method="POST" id="form" enctype="multipart/form-data" class="row g-3">
            <div class="col-8">
                <div class="row g-3 mb-2">
                    <div class="col">
                        <label for="inputEmail4" class="form-label">User name</label>
                        <input type="text" class="form-control" placeholder="First name" aria-label="First name" value="<?= $_SESSION['user']['user_name']?>" disabled>
                    </div>
                    <div class="col">
                        <label for="inputEmail4" class="form-label">Họ và tên</label>
                        <input type="text" class="form-control" placeholder="Last name" aria-label="Last name" value="<?= $_SESSION['user']['full_name']?>" disabled>
                    </div>
                </div>
                <div class="col-md-12 mb-2">
                    <label for="inputEmail4" class="form-label">Email</label>
                    <input type="email" class="form-control" id="inputEmail4" value="<?= $_SESSION['user']['email']?>" disabled>
                </div>
                <div class="col-md-12 mb-2">
                    <label for="inputPassword4" class="form-label">Password</label>
                    <input type="password" class="form-control" id="inputPassword4" value="<?= $_SESSION['user']['pass_word']?>" disabled>
                </div>
                <div class="col-12 mb-2">
                    <label for="inputAddress" class="form-label">Địa chỉ</label>
                    <input type="text" class="form-control" value="<?= $_SESSION['user']['address']?>" disabled>
                </div>
                
                <div class="row g-3 mb-2">
                    <div class="col-md-6">
                        <label for="inputCity" class="form-label">Số điện thoai</label>
                        <input type="text" class="form-control" value="<?= $_SESSION['user']['phone']?>" disabled>
                    </div>
                        <div class="col-6">
                        <label for="inputAddress2" class="form-label">Quyền hạn</label>
                        <input type="text" class="form-control" value="<?= $_SESSION['user']['role'] == 2 ? 'Customer' : (($_SESSION['user']['role'] == 1 && $_SESSION['user']['user_id'] == 22) ? 'Admin' : 'Manager') ?>" disabled>
                    </div>
                </div>
                
              
            </div>
            
            <div class="col-4 d-flex flex-column justify-content-center align-items-center">
                <div class="avatar">
                    <img src="<?= !empty($_SESSION['user']['avatar']) ? $UPLOAD_URL.'/'.$_SESSION['user']['avatar'] : $CONTENT.'/image/avatar.jpg'?>" style="width: 100%" alt="">
                </div>
            </div>

        </form>

    </div>

</div>
<script>
$().ready(function() {
	$("#form").validate({
		onfocusout: false,
		onkeyup: false,
		onclick: false,
		rules: {
			"user_name": {
				required: true,
				maxlength: 50
			},
            "full_name": {
				required: true,
				maxlength: 50
			},
            "email": {
				required: true,
				email: true
			},
            "pass_word": {
				required: true,
				minlength: 8
			},
            "pass_word_check": {
                equalTo: "#pass_word",
				minlength: 8
			},
            "avatar": {
				required: true,
			},
            "phone": {
				required: true,
				maxlength: 15
			},
            "role": {
				required: true,
			},
            "address": {
				required: true,
			},
            
		},
        messages: {
			"user_name": {
				required: "Bạn chưa nhập user_name",
				maxlength: "Hãy nhập tối đa 50 ký tự"
			},
            "full_name": {
				required: "Bạn chưa nhập họ và tên",
				maxlength: "Hãy nhập tối đa 50 ký tự"
			},
            "email": {
                required: "Bạn chưa nhập email.",
                email: "Phải nhập đúng định dạng email."
            },
            "avatar": {
                required: "Bạn chưa chon hình ảnh.",
            },
            "phone": {
                required: "Vui lòng nhập số điện thoại",
                maxlength: "Số điện thoại không được vượt quá 15 ký tự"
            },
            "role": {
                required: "Bạn chưa chọn quyền cho tài khoản",
            },
            "address": {
                required: "Bạn chưa nhập địa chỉ",
            },
            "avatar": {
                required: "Bạn chưa chọn hình ảnh",
            },
            "pass_word": {
                required: "Bạn chưa nhập mật khẩu",
                maxlength: "Hãy nhập ít nhất 8 ký tự"
            },
            "pass_word_check": {
                equalTo: "Hai password phải giống nhau",
				minlength: "Hãy nhập ít nhất 8 ký tự"
            }
		}
	});
});


</script>
