
<div class="box_tite mb-3">Thống kê đơn hàng bán được theo ngày</div>

<div class="box_table my-3">
    <div class="box_btns py-2 mx-3 d-flex align-items-center gap-2">

        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
            <div class="btn-group" role="group">
                <button id="btnGroupDrop1" type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Thống kê đơn hàng bán được theo ngày
                </button>
                <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <li><a class="dropdown-item" href="index.php">Thống kê hàng hóa theo loại</a></li>
                    <li><a class="dropdown-item" href="index.php?btn_tktk">Thống kê hàng hóa tồn kho</a></li>
                    <li><a class="dropdown-item" href="index.php?btn_tkbc">Thống kê hàng bán chạy</a></li>
                </ul>
            </div>
        </div>

        <button type="button" class="btn btn-danger"><a href="index.php?btn_chart">Biểu đồ</a></button>
        
        <!-- <div class="box_btn">
            <button type="button" class="btn btn-primary"><a href="index.php">Thống kê hàng hóa theo loại</a></button>
            <button type="button" class="btn btn-success"><a href="index.php?btn_tktl">Thống kê đơn hàng bán được theo ngày</a></button>
        </div> -->
    </div>

    <div class="box_wap mx-3 py-2">
        <div class="col-5 mx-1">
            <form action="index.php?btn_tktn" method="post">
                <div class="row">
                    <div class="col">
                        <input type="date" class="form-control" name="start_date" value="<?= $start_date?>">
                    </div>
                    
                    <div class="col">
                        <input type="date" class="form-control" name="end_date" value="<?= $end_date?>">
                    </div>

                    <div class="col">
                    <button type="submit" class="btn btn-primary">Lọc</button>
                    </div>
                </div>
            </form>
        </div>
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Ngày bán</th>
                    <th scope="col">Số lượng sản phẩm bán được</th>
                    <th scope="col">Số lượng đơn hàng</th>
                    <th scope="col">Tổng doanh thu</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($listTK as $list) : extract($list) ?>
                <tr style="vertical-align: middle;">
                    
                    <td scope="row"><?= $ngay?></td>
                    <td><?= $ban_duoc ?></td>
                    <td><?= $count_order ?></td>
                    <td><?= number_format($sum_pay, 0, "", ".") ?></td>
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
                            <a class="page-link linkm" href="index.php?btn_tktn&page=<?= $page - 1?><?= isset($start_date) ? '&start_date='.$start_date : ''?><?= isset($end_date) ? '&end_date='.$end_date : ''?>">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php endif ?>
                    
                    <?php for($i = 1 ; $i <= $total_pages ; $i++) : ?>
                        <li class="page-item"><a class="page-link linkm" href="index.php?btn_tktn&page=<?= $i?><?= isset($start_date) ? '&start_date='.$start_date : ''?><?= isset($end_date) ? '&end_date='.$end_date : ''?>"><?= $i?></a></li>
                    <?php endfor ?>

                    <?php if($page < $total_pages) : ?>
                        <li class="page-item">
                            <a class="page-link linkm" href="index.php?btn_tktn&page=<?= $page + 1?><?= isset($start_date) ? '&start_date='.$start_date : ''?><?= isset($end_date) ? '&end_date='.$end_date : ''?>">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    <?php endif ?>
                </ul>
            </nav>
        </div>
    <?php endif ?>

</div>
