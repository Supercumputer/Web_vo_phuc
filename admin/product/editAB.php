
<div class="box_tite mb-3">Quản lý hình ảnh</div>

<div class="box_table my-3">
    <h2 class="py-2 mx-3">Cập nhật hình ảnh</h2>

    <div class="box_wap mx-3 py-3">
        <form action="index.php?album_update" method="POST" id="form" class="row g-3" enctype="multipart/form-data">
            <input class="form-control" type="hidden" name="album_id" value="<?= $album_id?>">

            <div class="col-md-6">
                <label for="formFile" class="form-label">Hình ảnh (<?= $image_url?>)</label>
                <input class="form-control" type="file" name="image_url_new">
            </div>

            <input class="form-control" type="hidden" name="image_url" value="<?= $image_url?>">

            <div class="col-md-6">
                <label for="inputState" class="form-label">Mã sản phẩm</label>
                <input class="form-control" type="text" name="product_id" value="<?= $product_id?>" readonly>
            </div>

            <div class="box_btn">
                <button type="submit" class="btn btn-primary">Cập nhật</button>
                <button type="reset" class="btn btn-secondary">Nhập lại</button>
                <button type="button" class="btn btn-success"><a href="index.php?album=<?= $product_id?>">Danh sách</a></button>
            </div>
        </form>

    </div>

</div>

