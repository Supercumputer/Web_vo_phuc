
<div class="box_tite mb-3">Quản lý thương hiệu</div>

<div class="box_table my-3">
    <h2 class="py-2 mx-3">Tạo mới thương hiệu</h2>

    <div class="box_wap mx-3 py-3">
        <form action="index.php?btn_add" method="POST" id="form" class="row g-3" enctype="multipart/form-data">
            <div class="col-md-4">
                <label for="inputEmail4" class="form-label">Tên thương hiệu</label>
                <input type="text" class="form-control" id="inputEmail4" name="brand_name">
            </div>
            <div class="col-md-4">
                <label for="formFile" class="form-label">Hình ảnh</label>
                <input class="form-control" type="file" name="brand_img">
            </div>
            <div class="col-md-4">
                <label for="inputState" class="form-label">Hiển thị menu</label>
                <select id="inputState" class="form-select" name="status_hide">
                    <option value="1">Có</option>
                    <option value="0">Không</option>
                </select>
            </div>

            <div class="box_btn">
                <button type="submit" class="btn btn-primary">Tạo mới</button>
                <button type="reset" class="btn btn-secondary">Nhập lại</button>
                <button type="button" class="btn btn-success"><a href="index.php">Danh sách</a></button>
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
			"brand_name": {
				required: true,
				maxlength: 199
			},
            "brand_img": {
				required: true,
			}
		},
        messages: {
			"brand_name": {
				required: "Bạn chưa nhập tên thương hiệu",
				maxlength: "Hãy nhập tối đa 199 ký tự"
			},
            "brand_img": {
				required: "Bạn chưa nhập hình ảnh",
			}
		}
	});
});


</script>
