
<div class="box_tite mb-3">Thống kê hàng hóa theo loại</div>

<div class="box_table my-3">
    <div class="box_btns py-2 mx-3 d-flex align-items-center gap-2">

        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
            <div class="btn-group" role="group">
                <button id="btnGroupDrop1" type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Thống kê hàng hóa theo loại
                </button>
                <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <li><a class="dropdown-item" href="index.php?btn_tktn">Thống kê đơn hàng bán được theo ngày</a></li>
                    <li><a class="dropdown-item" href="index.php?btn_tktk">Thống kê hàng hóa tồn kho</a></li>
                    <li><a class="dropdown-item" href="index.php?btn_tkbc">Thống kê hàng bán chạy</a></li>
                </ul>
            </div>
        </div>

        <button type="button" class="btn btn-danger"><a href="index.php?btn_chart">Biểu đồ</a></button>
    </div>

    <div class="box_wap mx-3 py-2">

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Loại hàng</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Giá cao nhất</th>
                    <th scope="col">Giá thấp nhất</th>
                    <th scope="col">Giá trung bình</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($listTK1 as $list) : extract($list) ?>
                <tr style="vertical-align: middle;">
                    <td><?= $category_name?></td>
                    <td><?= $so_luong ?></td>
                    <td><?= number_format($gia_max, 0, "", ".") ?></td>
                    <td><?= number_format($gia_min, 0, "", ".") ?></td>
                    <td><?= number_format($gia_avg, 0, "", ".") ?></td>
                </tr>
                <?php endforeach ?>
                
            </tbody>
        </table>
    </div>

</div>
