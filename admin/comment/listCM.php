
<div class="box_tite mb-3">Quản lý đánh giá</div>

<div class="box_table my-3">
    <div class="box_btns py-2 mx-3 d-flex justify-content-between align-items-center">
        
        <h2 class="text_name">Danh sách thống kê đánh giá</h2>
        <form action="index.php" method="GET" class="mb-0">
            <input type="text" name="keys" placeholder="Search here ...">
        </form>

    </div>

    <div class="box_wap mx-3 py-2">

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Mã hàng hóa</th>
                    <th class="name_column">Tên hàng hóa</th>
                    <th>Số đánh giá</th>
                    <th>Mới nhất</th>
                    <th>Cũ nhất</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($list_comment as $list) : extract($list)?>
                    <tr style="vertical-align: middle;">
                        <td><?= $product_id?></td>
                        <td><span class="title" style="width: 500px;"><?= $product_name?></span></td>
                        <td><?= $so_luong?></td>
                        <td><?= $moi_nhat?></td>
                        <td><?= $cu_nhat?></td>
                        <td>
                            <button type="button" class="btn btn-success"><a href="index.php?btn_detail=<?= $product_id?>">Xem chi tiết</a></button>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        
        <?php if(sizeof($count_doc) > 10) : ?>
        <div class="d-flex flex-row-reverse ">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php if($page > 1) : ?>
                        <li class="page-item">
                            <a class="page-link linkm" href="index.php?<?= isset($keyword) ? 'keys='.$keyword : ''?>&page=<?= $page - 1?>">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php endif ?>
                    
                    <?php for($i = 1 ; $i <= $total_pages ; $i++) : ?>
                        <li class="page-item"><a class="page-link linkm" href="index.php?<?= isset($keyword) ? 'keys='.$keyword : ''?>&page=<?= $i?>"><?= $i?></a></li>
                    <?php endfor ?>

                    <?php if($page < $total_pages) : ?>
                        <li class="page-item">
                            <a class="page-link linkm" href="index.php?<?= isset($keyword) ? 'keys='.$keyword : ''?>&page=<?= $page + 1?>">
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

