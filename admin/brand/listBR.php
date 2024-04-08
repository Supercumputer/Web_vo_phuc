
<div class="box_tite mb-3">Quản lý thương hiệu</div>

<div class="box_table my-3">
    <div class="box_btns py-2 mx-3 d-flex justify-content-between align-items-center">
        <div class="box_btn">
            <button type="button" class="btn btn-primary"><a href="index.php?btn_add_ui">Tạo mới</a></button>
            <button type="button" class="btn btn-secondary select-all">Chọn tất cả</button>
            <button type="button" class="btn btn-success deselect-all">Bỏ chọn tất cả</button>
            <button type="button" class="btn btn-danger delete-selected"><a class="url_all_delete" onclick="return confirm('Bạn có muốn xóa không.')">Xóa mục đã chọn</a></button>
        </div>

        <form action="index.php" method="GET" class="mb-0">
            <input type="text" name="key" placeholder="Search here ...">
        </form>

    </div>

    <div class="box_wap mx-3 py-2">
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" class="check_column">
                        <input class="form-check-input" name="input_all" type="checkbox" value="">
                    <th>
                    <th scope="col">STT</th>
                    <th scope="col">Tên thương hiệu</th>
                    <th scope="col">Ảnh thương hiệu</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                <?php for($i = 0; $i < sizeof($list_brand); $i++) {
                    extract($list_brand[$i]);
                    if($brand_id == 1){
                        continue;
                    }
                ?>

                    <tr style="vertical-align: middle;">
                        <th scope="col">
                            <input class="form-check-input" name="input_item" type="checkbox" value="<?= $brand_id?>" >
                        <th>
                        <td scope="row" class="id_column"><?= $i?></td>
                        <td><?= $brand_name?></td>
                        <td>
                            <div class="d-flex gap-2 align-items-center">
                                <img src="<?=$UPLOAD_URL.'/'.$brand_img?>" width="50" alt="">
                                <span><?= $brand_img?></span>
                            </div>
                        </td>
                        <td><?= $status_hide == 1 ? '<span style="color: #198754;font-weight: 500;">Hiển thị</span>' : '<span style="color: #DC3545;font-weight: 500;">Không hiển thị</span>'?></td>
                        <td>
                            <div class="icon_btn">
                                <a class="btn_show" data-bs-toggle="modal" data-bs-target="#exampleModal" data="<?= $brand_id?>"><i class="fa-solid fa-trash-can"></i></a>
                                <a href="index.php?btn_edit=<?= $brand_id?>"><i class="fa-solid fa-pen-to-square"></i></a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
                
            </tbody>
        </table>
        
    </div>

</div>

