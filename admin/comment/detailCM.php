
<div class="box_tite mb-3">Đánh giá chi tiết</div>

<div class="box_table my-3">
    <div class="box_btns py-2 mx-3 d-flex justify-content-between align-items-center">
        
        <div class="box_btn">
            <button type="button" class="btn btn-secondary select-all">Chọn tất cả</button>
            <button type="button" class="btn btn-success deselect-all">Bỏ chọn tất cả</button>
            <button type="button" class="btn btn-danger delete-selected"><a class="url_all_delete" onclick="return confirm('Bạn có muốn xóa không.')">Xóa mục đã chọn</a></button>
        </div>
        <form action="index.php" method="GET" class="mb-0">
            <input type="text" name="key" placeholder="Search here ...">
            <input type="hidden" name="product_id" value="<?= $product_id ?? $list_comment_detail[0]['product_id']?>">
        </form>

    </div>

    <div class="box_wap mx-3 py-3">

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">
                        <input class="form-check-input" name="input_all" type="checkbox" value="">
                    <th>
                    <th scope="col">STT</th>
                    <th scope="col" class="name_column">Nội dung</th>
                    <th scope="col">Ngày đánh giá</th>
                    <th scope="col">Người đánh giá</th>
                    <th scope="col">Sao</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php for($i = 0; $i < sizeof($list_comment_detail); $i++){ 
                    extract($list_comment_detail[$i]);
                ?>
                    <tr>
                        <td scope="col">
                            <input class="form-check-input" name="input_item" type="checkbox" value="<?= $comment_id?>" data_id="<?= $product_id ?>" data_name="">
                        <td>
                        <td scope="row"><?= $i + 1?></td>
                        <td scope="row"><?= $content?></td>
                        <td scope="row"><?= $created_at?></td>
                        <td scope="row"><?= $user_name?></td>
                        <td scope="row"><?= drawStars($start, '')?></td>
                        <td><?= $status_hide === 1 ? '<span style="color: #198754;font-weight: 500;">Hiển thị</span>' : '<span style="color: #DC3545;font-weight: 500;">Không hiển thị</span>'?></td>
                        <td>
                            <div class="icon_btn">
                                <a class="btn_show" data-bs-toggle="modal" data-bs-target="#exampleModal" data="<?= $comment_id?>" data_id="<?= $product_id ?>" data_name=""><i class="fa-solid fa-trash-can"></i></a>
                                <a href="index.php?btn_edit=<?= $comment_id?>"><i class="fa-solid fa-pen-to-square"></i></a>
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
                            <a class="page-link linkm" href="index.php?<?= isset($keyword) ? 'key='.$keyword.'&product_id='.$product_id : 'btn_detail='.$product_id?>&page=<?= $page - 1?>">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php endif ?>
                    
                    <?php for($i = 1 ; $i <= $total_pages ; $i++) : ?>
                        <li class="page-item"><a class="page-link linkm" href="index.php?<?= isset($keyword) ? 'key='.$keyword.'&product_id='.$product_id : 'btn_detail='.$product_id?>&page=<?= $i?>"><?= $i?></a></li>
                    <?php endfor ?>

                    <?php if($page < $total_pages) : ?>
                        <li class="page-item">
                            <a class="page-link linkm" href="index.php?<?= isset($keyword) ? 'key='.$keyword.'&product_id='.$product_id : 'btn_detail='.$product_id?>&page=<?= $page + 1?>">
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
