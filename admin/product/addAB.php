
<div class="box_tite mb-3">Quản lý hình ảnh</div>

<div class="box_table my-3">
    <h2 class="py-2 mx-3">Tạo mới hình ảnh</h2>

    <div class="box_wap mx-3 py-3">
        <form action="index.php?album_add" method="POST" id="form" class="row g-3" enctype="multipart/form-data">
            <div class="col-md-6">
                <label for="formFile" class="form-label">Hình ảnh</label>
                <input class="form-control" type="file" name="images[]" multiple>
            </div>

            <div class="col-md-6">
                <label for="inputState" class="form-label">Mã sản phẩm</label>
                <input class="form-control" type="text" name="product_id" value="<?= $product_id?>" readonly>
            </div>

            <div class="box_btn">
                <button type="submit" class="btn btn-primary">Tạo mới</button>
                <button type="reset" class="btn btn-secondary">Nhập lại</button>
                <button type="button" class="btn btn-success"><a href="index.php?album=<?= $product_id?>">Danh sách</a></button>
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
			"images[]": {
				required: true,
			},
            "product_id": {
				required: true,
			}
		},
        messages: {
			"images[]": {
				required: "Bạn chưa chọn hình ảnh",
			},
            "product_id": {
				required: "Bạn chưa chọn mã sản phẩm",
			}
		}
	});
});


</script>
