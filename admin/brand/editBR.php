
<div class="box_tite mb-3">Quản lý thương hiệu</div>

<div class="box_table my-3">
    <h2 class="py-2 mx-3">Cập nhật thương hiệu</h2>

    <div class="box_wap mx-3 py-3">
        <form action="index.php?btn_update" method="POST" id="form" class="row g-3" enctype="multipart/form-data">
            <input type="hidden" name="brand_id" value="<?= $brand_id?>">
            <div class="col-md-4">
                <label for="inputEmail4" class="form-label">Tên thương hiệu</label>
                <input type="text" class="form-control" id="inputEmail4" name="brand_name" value="<?= $brand_name?>">
            </div>
            <div class="col-md-4">
                <label for="formFile" class="form-label">Hình ảnh</label>
                <input class="form-control" type="file" name="brand_img_new">
            </div>
            <input type="hidden" name="brand_img" value="<?= $brand_img?>">
            <div class="col-md-4">
                <label for="inputState" class="form-label">Hiển thị menu</label>
                <select id="inputState" class="form-select" name="status_hide">
                    <option value="1" <?= $status_hide === 1 ? 'selected' : ''?>>Có</option>
                    <option value="0" <?= $status_hide === 0 ? 'selected' : ''?>>Không</option>
                </select>   
            </div>

            <div class="box_btn">
                <button type="submit" class="btn btn-primary">Cập nhật</button>
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
			}
		},
        messages: {
			"brand_name": {
				required: "Bạn chưa nhập tên thương hiệu",
				maxlength: "Hãy nhập tối đa 199 ký tự"
			}
		}
	});
});


</script>