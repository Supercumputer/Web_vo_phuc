
<div class="box_tite mb-3">Quản lý hình ảnh</div>

<div class="box_table my-3">
    <div class="box_btns py-2 mx-3 d-flex justify-content-between align-items-center">
        <div class="box_btn">
            <button type="button" class="btn btn-primary"><a href="index.php?album_add_ui=<?= $product_id?>">Tạo mới</a></button>
            <button type="button" class="btn btn-secondary select-all">Chọn tất cả</button>
            <button type="button" class="btn btn-success deselect-all">Bỏ chọn tất cả</button>
            <button type="button" class="btn btn-danger delete-selected"><a class="url_all_delete" onclick="return confirm('Bạn có muốn xóa không.')">Xóa mục đã chọn</a></button>
        </div>

        <form action="index.php" method="GET" class="mb-0">
            <input type="hidden" name="product_id" value="<?= $product_id?>">
            <input type="text" name="album_key" placeholder="Search here ...">
        </form>

    </div>

    <div class="box_wap mx-3 py-2">
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" class="check_column">
                        <input class="form-check-input" name="input_all" type="checkbox" value="">
                    <th>
                    <th scope="col">ID Album</th>
                    <th scope="col">Đường dẫn hình ảnh</th>
                    <th scope="col">Mã sản phẩm</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach($list_album as $list) : extract($list)?>
                    <tr style="vertical-align: middle;">
                        <th scope="col">
                            <input class="form-check-input" name="input_item" type="checkbox" value="<?= $album_id?>" data_id="<?= $product_id ?>" data_name="ab">
                        <th>
                        <td scope="row" class="id_column"><?= $album_id?></td>
                        <td>
                            <div class="d-flex gap-2 align-items-center">
                                <img src="<?=$UPLOAD_URL.'/'.$image_url?>" width="80" alt="">
                                <span><?= $image_url?></span>
                            </div>
                        </td>
                        <td><?= $product_id?></td>
                        <td>
                            <div class="icon_btn">
                                <a class="btn_show" data-bs-toggle="modal" data-bs-target="#exampleModal" data="<?= $album_id?>" data_id="<?= $product_id ?>" data_name="ab"><i class="fa-solid fa-trash-can"></i></a>
                                <a href="index.php?album_edit=<?= $album_id?>"><i class="fa-solid fa-pen-to-square"></i></a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>
                
            </tbody>
        </table>
        
    </div>

</div>

