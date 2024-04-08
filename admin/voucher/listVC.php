
<div class="box_tite mb-3">Quản lý voucher</div>

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
                    <th scope="col">Mã giảm giá</th>
                    <th scope="col">Giảm %</th>
                    <th scope="col">Ngày tạo</th>
                    <th scope="col">Ngày hết hạn</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach($list_voucher as $list) : extract($list)?>
                    <tr style="vertical-align: middle;">
                        <th scope="col">
                            <input class="form-check-input" name="input_item" type="checkbox" value="<?= $voucher_id?>" >
                        <th>
                        <td><?= $voucher_code?></td>
                        <td><?= $discount_amount?>%</td>
                        <td><?= $created_at?></td>
                        <td><?= $end_date?></td>
                        <td><?= $status == 0 ? '<span style="color: #198754; font-weight: 500;">Chưa dùng</span>' : ($status == 2 ? '<span style="color: #DC3545; font-weight: 500;">Đã hết hạn</span>' : '<span style="font-weight: 500;">Đã dùng</span>')?></td>
                        <td>
                            <div class="icon_btn">
                                <a class="btn_show" data-bs-toggle="modal" data-bs-target="#exampleModal" data="<?= $voucher_id?>"><i class="fa-solid fa-trash-can"></i></a>
                                <a href="index.php?btn_edit=<?= $voucher_id?>"><i class="fa-solid fa-pen-to-square"></i></a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>
                
            </tbody>
        </table>
        
    </div>

</div>

