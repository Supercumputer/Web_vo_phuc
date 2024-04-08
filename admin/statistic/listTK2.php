
<div class="box_tite mb-3">Thống kê hàng hóa tồn kho</div>

<div class="box_table my-3">
    <div class="box_btns py-2 mx-3 d-flex align-items-center gap-2">

        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
            <div class="btn-group" role="group">
                <button id="btnGroupDrop1" type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Thống kê hàng hóa tồn kho
                </button>
                <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                <li><a class="dropdown-item" href="index.php">Thống kê hàng hóa theo loại</a></li>
                    <li><a class="dropdown-item" href="index.php?btn_tktn">Thống kê đơn hàng bán được theo ngày</a></li>
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
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col">Màu</th>
                    <th scope="col">Size</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Sale</th>
                    <th scope="col">Số lượng đã bán</th>
                    <th scope="col">Số lượng tồn kho</th>
                    <th scope="col">Tổng giá tồn kho</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($listTK as $list) : 
                    extract($list);
                    $sum_inventory = ($price - ($price * ($discount / 100))) * $so_luong_ton_kho;
                ?>
                <tr style="vertical-align: middle;">
                    <td style="width: 400px;"><?= $product_name?></td>
                    <td><?= $color_name ?></td>
                    <td><?= $size_name ?></td>
                    <td><?= number_format($price, 0, "", ".") ?></td>
                    <td><?= $discount ?>%</td>
                    <td><?= $so_luong_da_ban ?></td>
                    <td><?= $so_luong_ton_kho ?></td>
                    <td><?= number_format($sum_inventory, 0, "", ".") ?></td>
                </tr>
                <?php endforeach ?>
                
            </tbody>
        </table>
    </div>

</div>
