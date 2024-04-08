
<div class="box_tite mb-3">Quản lý voucher</div>

<div class="box_table my-3">
    <h2 class="py-2 mx-3">Cập nhật voucher</h2>

    <div class="box_wap mx-3 py-3">
        <form action="index.php?btn_update" method="POST" id="form" class="row g-3">
            <input type="hidden" name="voucher_id" value="<?= $voucher_id?>">

            <div class="col-md-3">
                <label for="inputEmail4" class="form-label">Mã giảm giá</label>
                <input type="text" class="form-control" name="voucher_code" value="<?= $voucher_code?>" <?= $status != 0 ? 'readonly' : '' ?>>
            </div>

            <div class="col-md-3">
                <label for="inputEmail4" class="form-label">Giảm %</label>
                <input type="text" class="form-control" name="discount_amount" value="<?= $discount_amount?>" <?= $status != 0 ? 'readonly' : '' ?>>
            </div>

            <div class="col-md-3">
                <label for="inputEmail4" class="form-label">Ngày tạo</label>
                <input type="date" class="form-control" name="end_date" value="<?= $created_at?>" readonly>
            </div>

            <div class="col-md-3">
                <label for="inputEmail4" class="form-label">Ngày hết hạn</label>
                <input type="date" class="form-control" name="end_date" value="<?= $end_date?>" <?= $status != 0 ? 'readonly' : '' ?>>
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
			"voucher_code": {
				required: true,
				maxlength: 20
			},
            "discount_amount": {
				required: true,
                number: true,
                range: [0, 100]
			}
		},
        messages: {
			"voucher_code": {
				required: "Bạn chưa nhập tên voucher",
				maxlength: "Hãy nhập tối đa 20 ký tự"
			},
            "discount_amount": {
				required: "Bạn chưa nhập giảm giá.",
                number: "Vui lòng nhập một số hợp lệ cho giá trị chiết khấu.",
                range: "Giá trị chiết khấu phải nằm trong khoảng từ 0 đến 100."
			}
		}
	});
});


</script>