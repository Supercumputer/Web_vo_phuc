
<div class="box_tite mb-3">Quản lý tài khoản</div>

<div class="box_table my-3">
    <h2 class="py-2 mx-3">Tạo mới tài khoản</h2>

    <div class="box_wap mx-3 py-3">
        <form action="index.php?btn_update" method="POST" id="form" enctype="multipart/form-data" class="row g-3">
            <input type="hidden" name="user_id" value="<?= $user_id?>">
            <div class="col-md-4">
                <label for="inputEmail4" class="form-label">UserName</label>
                <input type="text" class="form-control" name="user_name" value="<?= $user_name?>" <?= $user_name == 'Admin' ? 'readonly' : ''?>>
            </div>
            <div class="col-md-4">
                <label for="inputEmail4" class="form-label">Họ và tên</label>
                <input type="text" class="form-control" name="full_name" value="<?= $full_name?>">
            </div>
            <div class="col-md-4">
                <label for="inputPassword4" class="form-label">Địa chỉ email</label>
                <input type="email" class="form-control"  name="email" value="<?= $email?>">
            </div>
            <div class="col-md-4">
                <label for="inputZip" class="form-label">Mật khẩu</label>
                <input type="password" class="form-control" name="pass_word" id="pass_word" value="<?= $pass_word?>">
            </div>
            
            <div class="col-md-4">
                <label for="formFile" class="form-label">Hình ảnh</label>
                <input class="form-control" type="file" name="avatar_new" >
            </div>

            <input type="hidden" name="avatar" value="<?= $avatar?>">

            <div class="col-md-4">
                <label for="inputState" class="form-label">Trạng thái kích hoạt</label>

                <?php if($user_name == 'Admin') { ?>
                    <input type="hidden" name="activated" value="<?= $activated?>">
                    <input type="text" class="form-control" value="<?= $activated == 0 ? 'Chưa kích hoạt' : 'Đã kích hoạt'?>" readonly>
                <?php }else{ ?>
                    <select id="inputState" class="form-select" name="activated">
                        <option value="0" <?= $activated === 0 ? 'selected' : ''?>>Chưa kích hoạt</option>
                        <option value="1" <?= $activated === 1 ? 'selected' : ''?>>Đã kích hoạt</option>
                    </select>
                <?php }?>
            </div>

            <div class="col-md-6">
                <label for="inputAddress" class="form-label">Số điện thoại</label>
                <input type="text" class="form-control" name="phone" value="<?= $phone?>">
            </div>

            <div class="col-md-6">
                <label for="inputState" class="form-label">Quyền hạn</label>
                <?php if($user_name == 'Admin') { ?>
                    <input type="hidden" name="role" value="<?= $role?>">
                    <input type="text" class="form-control" value="<?= $role == 2 ? 'Customer' : 'Admin'?>" readonly>
                <?php }else{ ?>
                    <select id="inputState" class="form-select" name="role">
                        <option value="2" <?= $role === 2 ? 'selected' : ''?>>Customer</option>
                        <option value="1" <?= $role === 1 ? 'selected' : ''?>>Admin</option>
                    </select>
                <?php }?>
            </div>

            <div class="col-12">
                <label for="inputAddress" class="form-label">Địa chỉ thường trú</label>
                <input type="text" class="form-control" name="address" value="<?= $address?>">
            </div>

            <div class="box_btn">
                <button type="submit" class="btn btn-primary">Cập nhật</button>
                <button type="reset" class="btn btn-secondary">Nhập lại</button>
                <button type="button" class="btn btn-success"><a href="index.php?btn_list=<?=$role?>">Danh sách</a></button>
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
