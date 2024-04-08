
<div class="box_tite mb-3">Quản lý sản phẩm</div>

<div class="box_table my-3">
    <h2 class="py-2 mx-3">Tạo mới sản phẩm</h2>

    <div class="box_wap mx-3 py-3">
        <form method="POST" id="form" action="index.php?btn_add" class="row g-3">
            <div class="col-md-12">
                <label for="inputEmail4" class="form-label">Mã sản phẩm</label>
                <input type="text" class="form-control" name="product_id">
            </div>
            <div class="col-md-12">
                <label for="inputEmail4" class="form-label">Tên sản phẩm</label>
                <input type="text" class="form-control" name="product_name">
            </div>

            <div class="col-md-6">
                <label for="inputState" class="form-label">Danh mục</label>
                <select class="form-select" name="category_id">
                    <option value="">Chọn danh mục</option>
                    <?php foreach($list_category as $list): extract($list)?>
                        <option value="<?= $category_id?>"><?= $category_name?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="col-md-6">
                <label for="inputState" class="form-label">Hãng</label>
                <select class="form-select" name="brand_id">
                    <option value="">Chọn hãng</option>
                    <?php foreach($list_brand as $list): extract($list)?>
                        <option value="<?= $brand_id?>"><?= $brand_name?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Mô tả</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3"></textarea>
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
			"product_id": {
				required: true,
				maxlength: 20
			},
            "product_name": {
				required: true,
				maxlength: 199
			},
            "category_id": {
				required: true,
			},
            "brand_id": {
				required: true,
			},
            "created_at": {
                required: true,
                date: true
			},
           
            "description": {
				required: true,
			}
           
            
		},
        messages: {
			"product_id": {
                required: "Vui lòng nhập mã sản phẩm",
                maxlength: "Mã sản phẩm không được vượt quá 20 ký tự"
            },
            "product_name": {
                required: "Vui lòng nhập tên sản phẩm",
                maxlength: "Tên sản phẩm không được vượt quá 199 ký tự"
            },
            "category_id": {
                required: "Vui lòng chọn danh mục"
            },
            "brand_id": {
                required: "Vui lòng chọn thương hiệu"
            },
            "created_at": {
                required: "Vui lòng chọn ngày tạo sản phẩm",
                date: "Vui lòng nhập đúng định dạng ngày tháng"
            },
            "description": {
                required: "Vui lòng nhập mô tả",
            }
        }
    });
});


</script>
