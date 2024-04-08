
<div class="box_tite mb-3">Quản lý đánh giá</div>

<div class="box_table my-3">
    <h2 class="py-2 mx-3">Cập nhật đánh giá</h2>

    <div class="box_wap mx-3 py-3">
        <form action="index.php?btn_update" method="POST" id="form" class="row g-3">

            <input type="hidden" name="comment_id" value="<?= $comment_id?>">
            <input type="hidden" name="product_id" value="<?= $product_id?>">
            <div class="col-md-4">
                <label for="inputEmail4" class="form-label">Người đánh giá</label>
                <input type="text" class="form-control" value="<?= $content?>" readonly>
            </div>

            <div class="col-md-4">
                <label for="inputEmail4" class="form-label">Ngày đánh giá</label>
                <input type="date" class="form-control" value="<?= $created_at?>" readonly>
            </div>

            <div class="col-md-4">
                <label for="inputState" class="form-label">Hiển thị</label>
                <select id="inputState" class="form-select" name="status_hide">
                    <option value="1" <?= $status_hide === 1 ? 'selected' : ''?>>Có</option>
                    <option value="0" <?= $status_hide === 0 ? 'selected' : ''?>>Không</option>
                </select>   
            </div>
            
            <div class="col-md-12">
                <label for="inputEmail4" class="form-label">Nội dung</label>
                <input type="text" class="form-control" value="<?= $content?>" readonly>
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
			"category_name": {
				required: true,
				maxlength: 199
			}
		},
        messages: {
			"category_name": {
				required: "Bạn chưa nhập tên danh mục",
				maxlength: "Hãy nhập tối đa 199 ký tự"
			}
		}
	});
});


</script>