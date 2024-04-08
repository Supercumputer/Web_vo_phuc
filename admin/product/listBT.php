
<div class="box_tite mb-3">Quản lý sản phẩm biến thể</div>

<div class="box_table my-3">
    <div class="box_btns py-2 mx-3 d-flex justify-content-between align-items-center">
        <div class="box_btn">
            <button type="button" class="btn btn-primary"><a href="index.php?variant_add_ui=<?= $product_id?>">Tạo mới</a></button>
            <button type="button" class="btn btn-secondary select-all">Chọn tất cả</button>
            <button type="button" class="btn btn-success deselect-all">Bỏ chọn tất cả</button>
            <button type="button" class="btn btn-danger delete-selected"><a class="url_all_delete" onclick="return confirm('Bạn có muốn xóa không.')">Xóa mục đã chọn</a></button>
        </div>

        <form action="index.php" method="GET" class="mb-0">
            <input type="hidden" name="product_id" value="<?= $product_id?>">
            <input type="text" name="variant_key" placeholder="Search here ...">
        </form>

    </div>

    <div class="box_wap mx-3 py-2">

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">
                        <input class="form-check-input" name="input_all" type="checkbox" value="">
                    <th>
                    <th scope="col">ID</th>
                    <th scope="col" class="name_column">Tên sản phẩm</th>
                    <th scope="col">Size</th>
                    <th scope="col">Màu</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Giảm giá</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($list_variant as $list) : extract($list) ?>
                    <tr style="vertical-align: middle;">
                        <th scope="col">
                            <input class="form-check-input" name="input_item" type="checkbox" value="<?= $variant_id?>" data_id="<?= $product_id ?>" data_name="bt">
                        <th>
                        <td scope="row"><?= $variant_id?></td>
                        <td><span class="title"><?= $product_name?></span></td>
                        <td><?= $size_name?></td>
                        <td><?= $color_name?></td>
                        <td><?= number_format($price, 0, "", ".")?></td>
                        <td><?= $quantity?></td>
                        <td><?= $discount?>%</td>
                        <td>
                            <div class="icon_btn">
                                <a class="btn_show" data-bs-toggle="modal" data-bs-target="#exampleModal" data="<?= $variant_id?>" data_id="<?= $product_id ?>" data_name="bt"><i class="fa-solid fa-trash-can"></i></a>
                                <a href="index.php?variant_edit=<?= $variant_id?>"><i class="fa-solid fa-pen-to-square"></i></a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>
                

            </tbody>
        </table>
    </div>

</div>
