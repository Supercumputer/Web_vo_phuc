
<div class="box_tite mb-3">Quản lý phản hồi của khách hàng</div>

<div class="box_table my-3">
    <div class="box_btns py-2 mx-3 d-flex justify-content-between align-items-center">
        <div class="box_btn">
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
                    <th scope="col">Họ và tên</th>
                    <th scope="col">Email</th>
                    <th scope="col">Số điện thoại</th>
                    <th scope="col">Nội dung</th>
                    <th scope="col">Ngày gửi</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach($list_contact as $list) : extract($list)?>
                    <tr style="vertical-align: middle;">
                        <th scope="col">
                            <input class="form-check-input" name="input_item" type="checkbox" value="<?= $contact_id?>" >
                        <th>
                        <td><?= $full_name?></td>
                        <td><?= $email?></td>
                        <td><?= $phone?></td>
                        <td><div class="title" style="width: 220px;"><?= $message?></div></td>
                        <td><?= $created_at?></td>
                        <td><?= $status_feedback === 1 ? '<span style="color: #198754;font-weight: 500;">Đã phản hồi</span>' : '<span style="color: #DC3545;font-weight: 500;">Chưa phản hồi</span>'?></td>
                        <td>
                            <div class="icon_btn">
                                <a class="btn_show" data-bs-toggle="modal" data-bs-target="#exampleModal" data="<?= $contact_id?>"><i class="fa-solid fa-trash-can"></i></a>
                                <a href="index.php?btn_edit=<?= $contact_id?>"><i class="fa-solid fa-pen-to-square"></i></a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>
                
            </tbody>
        </table>
        
    </div>

    <?php if(sizeof($count_doc) > 10) : ?>
        <div class="d-flex flex-row-reverse pe-3">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php if($page > 1) : ?>
                        <li class="page-item">
                            <a class="page-link linkm" href="index.php?page=<?= $page - 1?><?= isset($keyword) ? '&key='.$keyword : ''?>">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php endif ?>
                    
                    <?php for($i = 1 ; $i <= $total_pages ; $i++) : ?>
                        <li class="page-item"><a class="page-link linkm" href="index.php?page=<?= $i?><?= isset($keyword) ? '&key='.$keyword : ''?>"><?= $i?></a></li>
                    <?php endfor ?>

                    <?php if($page < $total_pages) : ?>
                        <li class="page-item">
                            <a class="page-link linkm" href="index.php?page=<?= $page + 1?><?= isset($keyword) ? '&key='.$keyword : ''?>">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    <?php endif ?>
                </ul>
            </nav>
        </div>
    <?php endif ?>

</div>

