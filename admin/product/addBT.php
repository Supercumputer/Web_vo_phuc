
<div class="box_tite mb-3">Quản lý sản phẩm biến thể</div>

<div class="box_table my-3">
    <h2 class="py-2 mx-3">Tạo mới sản phẩm</h2>

    <div class="box_wap mx-3 py-3">
        <form action="index.php?variant_add" method="POST" id="form" class="row g-3">

            <div class="col-md-12">
                <label for="inputState" class="form-label">Mã sản phẩm</label>
                <input type="text" class="form-control" name="product_id" value="<?= $product_id?>" readonly>
            </div>

            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Giá</label>
                <input type="text" class="form-control" name="price">
            </div>

            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Số lượng</label>
                <input type="number" class="form-control" name="quantity">
            </div>

            <div class="col-md-6">
                <label for="inputState" class="form-label">Size</label>
                <select class="form-select" name="size_id">
                    <option value="">Chọn size</option>
                    <?php foreach($list_size as $list): extract($list)?>
                        <option value="<?= $size_id?>"><?= $size_name?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="col-md-6">
                <label for="inputState" class="form-label">Màu sắc</label>
                <select class="form-select" name="color_id">
                    <option value="">Chọn màu sắc</option>
                    <?php foreach($list_color as $list): extract($list)?>
                        <option value="<?= $color_id?>"><?= $color_name?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="box_btn">
                <button type="submit" class="btn btn-primary">Tạo mới</button>
                <button type="reset" class="btn btn-secondary">Nhập lại</button>
                <button type="button" class="btn btn-success"><a href="index.php?variant=<?= $product_id?>">Danh sách</a></button>
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
			"product_id": {
				required: true,
			},
            "color_id": {
				required: true,
			},
            "size_id": {
				required: true,
			},
            "price": {
				required: true,
                number: true
			},
            "quantity": {
                required: true,
                number: true
			},
            // "discount": {
            //     required: true,
            //     number: true,
            //     range: [0, 100]
            // }
           
		},
        messages: {
			"product_id": {
                required: "Vui lòng nhập mã sản phẩm."
            },
            "color_id": {
                required: "Vui lòng chọn màu sắc."
            },
            "size_id": {
                required: "Vui lòng chọn kích thước."
            },
            "price": {
                required: "Vui lòng nhập giá sản phẩm.",
                number: "Vui lòng nhập một số hợp lệ cho giá sản phẩm."
            },
            "quantity": {
                required: "Vui lòng nhập số lượng.",
                number: "Vui lòng nhập một số hợp lệ cho số lượng."
            },
            // "discount": {
            //     required: "Vui lòng nhập giá trị chiết khấu.",
            //     number: "Vui lòng nhập một số hợp lệ cho giá trị chiết khấu.",
            //     range: "Giá trị chiết khấu phải nằm trong khoảng từ 0 đến 100."
            // }
        }
    });
});


</script>