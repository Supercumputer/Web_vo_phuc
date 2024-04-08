
<div class="box_tite mb-3">Quản lý sản phẩm biến thể</div>

<div class="box_table my-3">
    <h2 class="py-2 mx-3">Cập nhật sản phẩm biến thể</h2>

    <div class="box_wap mx-3 py-3">
        <form method="POST" id="form" action="index.php?variant_update" class="row g-3">
            <input type="hidden" name="variant_id" value="<?= $variant_id?>">

            <div class="col-md-12">
                <label for="inputState" class="form-label">Mã sản phẩm</label>
                <input type="text" class="form-control" name="product_id" value="<?= $product_id?>" readonly>
            </div>

            <div class="col-md-12">
                <label for="inputEmail4" class="form-label">Giá</label>
                <input type="text" class="form-control" name="price" value="<?= $price?>">
            </div>

            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Số lượng</label>
                <input type="number" class="form-control" name="quantity" value="<?= $quantity?>">
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Giảm giá</label>
                <input type="text" class="form-control" name="discount" value="<?= $discount?>">
            </div>
            <div class="col-md-6">
                <label for="inputState" class="form-label">Size</label>
                <select class="form-select" name="size_id">
                    <option value="">Chọn size</option>
                    <?php foreach($list_size as $list) : ?>
                        <option value="<?= $list['size_id']?>" <?= $list['size_id'] === $size_id ? 'selected' : ''?>><?= $list['size_name']?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="col-md-6">
                <label for="inputState" class="form-label">Màu sắc</label>
                <select class="form-select" name="color_id">
                    <option value="">Chọn màu sắc</option>
                    <?php foreach($list_color as $list) : ?>
                        <option value="<?= $list['color_id']?>" <?= $list['color_id'] === $color_id ? 'selected' : ''?>><?= $list['color_name']?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="box_btn">
                <button type="submit" class="btn btn-primary">Cập nhật</button>
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
            "discount": {
                number: true,
                range: [0, 100]
            }
           
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
            "discount": {
                number: "Vui lòng nhập một số hợp lệ cho giá trị chiết khấu.",
                range: "Giá trị chiết khấu phải nằm trong khoảng từ 0 đến 100."
            }
        }
    });
});


</script>