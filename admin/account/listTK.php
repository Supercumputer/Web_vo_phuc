
<div class="box_tite mb-3">Quản lý tài khoản <?= ($role ?? $list_user[0]['role']) == 1 ? "Manager" : "Customer"?></div>

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
            <input type="hidden" name="role" value="<?= $role ?? $list_user[0]['role']?>">
        </form>
    </div>

    <div class="box_wap mx-3 py-2">

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">
                        <input class="form-check-input" name="input_all" type="checkbox" value="">
                    <th>
                    <th scope="col">STT</th>
                    <th scope="col">Họ và tên</th>
                    <th scope="col">Ảnh</th>
                    <th scope="col">Email</th>
                    <th scope="col">SĐT</th>
                    <th scope="col">Địa chỉ</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php for($i = 0; $i < sizeof($list_user); $i++){
                    extract($list_user[$i]); 
                ?>
                    <tr style="vertical-align: middle;">
                        <th scope="col">
                            <input class="form-check-input" name="input_item" type="checkbox"
                                value="<?= $user_id?>" data_id="<?= $role ?>" data_name="">
                        <th>
                        <td scope="row"><?= $i + 1 ?></td>
                        <td style="width: 150px;"><?= $full_name?></td>
                        <td><img src="<?=$UPLOAD_URL.'/'.$avatar?>" width="80" height="80" style="object-fit: cover;" alt=""></td>
                        <td><?= $email?></td>
                        <td><?= $phone?></td>
                        <td><?= $address?></td>
                        <td style="width: 130px;"><?= $activated === 0 ? '<span style="color: red;font-weight: 500;">Chưa kích hoạt</span>' : '<span style="color: green;font-weight: 500;">Đã kích hoạt</span>'?></td>
                        <td>
                            <div class="icon_btn">
                                <a class="btn_show" data-bs-toggle="modal" data-bs-target="#exampleModal" data="<?= $user_id?>" data_id="<?= $role ?>" data_name=""><i class="fa-solid fa-trash-can"></i></a>  
                                <a href="index.php?btn_edit=<?= $user_id?>"><i class="fa-solid fa-pen-to-square"></i></a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
                
            </tbody>
        </table>

        <?php if(sizeof($count_doc) > 10) : ?>
        <div class="d-flex flex-row-reverse pe-3">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php if($page > 1) : ?>
                        <li class="page-item">
                            <a class="page-link linkm" href="index.php?<?= isset($keyword) ? 'key='.$keyword.'&role='.$role : 'btn_list='.$role?>&page=<?= $page - 1?>">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php endif ?>
                    
                    <?php for($i = 1 ; $i <= $total_pages ; $i++) : ?>
                        <li class="page-item"><a class="page-link linkm" href="index.php?<?= isset($keyword) ? 'key='.$keyword.'&role='.$role : 'btn_list='.$role?>&page=<?= $i?>"><?= $i?></a></li>
                    <?php endfor ?>

                    <?php if($page < $total_pages) : ?>
                        <li class="page-item">
                            <a class="page-link linkm" href="index.php?<?= isset($keyword) ? 'key='.$keyword.'&role='.$role : 'btn_list='.$role?>&page=<?= $page + 1?>">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    <?php endif ?>
                </ul>
            </nav>
        </div>
        <?php endif ?>
    </div>

</div>
