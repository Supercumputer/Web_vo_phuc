
<div class="box_tite mb-3">Quản lý danh mục</div>

<div class="box_table my-3">
    <h2 class="py-2 mx-3">Tạo mới danh mục</h2>

    <div class="box_wap mx-3 py-3">
        <form action="index.php?btn_add" method="POST" id="form" class="row g-3" enctype="multipart/form-data">
            <div class="col-md-4">
                <label for="inputEmail4" class="form-label">Tên danh mục</label>
                <input type="text" class="form-control" id="inputEmail4" name="category_name">
            </div>
            <div class="col-md-4">
                <label for="formFile" class="form-label">Hình ảnh</label>
                <input class="form-control" type="file" name="category_img">
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
			"category_name": {
				required: true,
				maxlength: 199
			},
            "category_img": {
				required: true,
			}
		},
        messages: {
			"category_name": {
				required: "Bạn chưa nhập tên danh mục",
				maxlength: "Hãy nhập tối đa 199 ký tự"
			},
            "category_img": {
				required: "Bạn chưa nhập hình ảnh",
			}
		}
	});
});


</script>
