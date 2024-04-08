
<div class="box_tite mb-3">Quản lý Phản hồi khách hàng</div>

<div class="box_table my-3">
    <h2 class="py-2 mx-3">Trả lời phản hồi</h2>

    <div class="box_wap mx-3 py-3">
        <form action="index.php?btn_update" method="POST" id="form" class="row g-3" enctype="multipart/form-data">
            <input type="hidden" name="contact_id" value="<?= $contact_id?>">
            <input type="hidden" name="full_name" value="<?= $full_name?>">
            <input type="hidden" name="email" value="<?= $email?>">
            <input type="hidden" name="phone" value="<?= $phone?>">
            <div class="mb-2">
                <label for="exampleFormControlTextarea1" class="form-label">Messenger</label>
                <textarea class="form-control" rows="3" disabled><?= $message?></textarea>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Nội dung phản hồi</label>
                <textarea class="form-control" rows="3" name="phan_hoi"></textarea>
            </div>

            <div class="box_btn">
                <button type="submit" class="btn btn-primary">Gửi</button>
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
			"phan_hoi": {
				required: true,
			}
		},
        messages: {
			"phan_hoi": {
				required: "Bạn chưa nhập nội dung phản hồi."
			}
		}
	});
});


</script>