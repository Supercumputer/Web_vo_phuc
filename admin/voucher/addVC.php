
<div class="box_tite mb-3">Quản lý voucher</div>

<div class="box_table my-3">
    <h2 class="py-2 mx-3">Tạo mới voucher</h2>

    <div class="box_wap mx-3 py-3">
        <form action="index.php?btn_add" method="POST" id="form" class="row g-3" enctype="multipart/form-data">
            <div class="col-md-4">
                <label for="inputEmail4" class="form-label">Mã giảm giá</label>
                <input type="text" class="form-control" name="voucher_code">
            </div>

            <div class="col-md-4">
                <label for="inputEmail4" class="form-label">Giảm %</label>
                <input type="text" class="form-control" name="discount_amount">
            </div>

            <div class="col-md-4">
                <label for="inputEmail4" class="form-label">Ngày hết hạn</label>
                <input type="date" class="form-control" name="end_date">
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
			"voucher_code": {
				required: true,
				maxlength: 20
			},
            "discount_amount": {
				required: true,
                number: true,
                range: [0, 100]
			},
            "end_date": {
                required: true
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
			},
            "end_date": {
                required: "Bạn chưa nhập ngày hết hạn."
            }
		}
	});
});


</script>
