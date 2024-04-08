
<div class="filter">
<div class="box_content py-3 d-flex align-items-center justify-content-between">
    <div>
        <nav aria-label="breadcrumb" class="d-none d-md-block">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">Trang chủ</li>
                <li class="breadcrumb-item">Giỏ hàng</li>
                <li class="breadcrumb-item active" aria-current="page">Data</li>
            </ol>
        </nav>
    </div>
    
</div>
</div>

<div class="box_content bbg-gr py-3">
    <div class="bgkj scn">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Sản phẩm</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Màu</th>
                    <th scope="col">Kích thước</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Tổng tiền</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                <?php 
                    $sum_price = 0;
                    if(empty($_SESSION['cart'])) {
                        echo "<tr><td colspan='8' style='text-align: center'>Giỏ hàng chưa có sản phẩm nào</td></tr>";
                    }else{
                        for($i = 0; $i < sizeof($_SESSION['cart'] ?? []); $i++ ){
                            $price = $_SESSION['cart'][$i][5] * $_SESSION['cart'][$i][2];
                            $sum_price += $price;
                            echo '<tr style="vertical-align: middle;">
                                    <td style="width:400px;">'.$_SESSION['cart'][$i][0].'</td>
                                    <td><img src="'.$UPLOAD_URL.'/'.$_SESSION['cart'][$i][1].'" width="100px" height="100px" style="object-fit: cover;" alt=""></td>
                                    <td>'.number_format($_SESSION['cart'][$i][2], 0, "", ".").'</td>
                                    <td>'.$_SESSION['cart'][$i][3].'</td>
                                    <td>'.$_SESSION['cart'][$i][4].'</td>
                                    <td>
                                        <div class="d-flex">
                                            <input type="button" class="decrease" value="-">
                                            <input type="text" class="quantity-input text-center" value="'.$_SESSION['cart'][$i][5].'" min="1" step="1" readonly>
                                            <input type="button" class="increase" value="+">
                                        </div>
                                    </td>
                                    <td>'.number_format($price, 0, "", ".").'</td>
                                    <td style="width: 170px;">
                                        <div class="d-flex gap-1">
                                            <a href="'.$SITE_URL.'/gio_hang/index.php?btn_delete='.$i.'"><button type="button" class="btn btn-danger">Xóa</button><a>
                                            <a class="btn_up"><button type="button" class="btn " style="color: white; background: #FFC107">Cập nhật</button><a> 
                                        </div>
                                    </td>
                                </tr>';
                        }
                    }
                ?>
                
            </tbody>
        </table>
        <div class="d-flex justify-content-between">
            <div class="d-flex gap-2 align-items-center">
                <a href="<?=$SITE_URL?>/san_pham/index.php"><button type="button" class="btn btn-primary">Tiếp tục mua sắm</button></a>
                <a href="index.php?don_hang"><button type="button" class="btn btn-success">Lịch sử đơn hàng</button></a>
                <a href="<?=$SITE_URL?>/gio_hang/index.php?btn_delete_all"><button type="button" class="btn btn-danger">Xóa giỏ hàng</button></a>
            </div>

            <div class="d-flex gap-3 align-items-center">
                <p class="mb-0"><b>Tổng tiền:</b> <?= number_format($sum_price, 0, "", ".")?> VND</p>
                <?php echo $sum_price > 0 ? '<a href="'.$SITE_URL.'/thanh_toan/index.php?total_price='.$sum_price.'"><button type="button" class="btn btn-success">Thanh toán</button></a>' : '<button type="button" class="btn btn-success" disabled>Thanh toán</button>';?>
            </div>
        </div>
        
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const decreaseButtons = document.querySelectorAll('.decrease');
        const increaseButtons = document.querySelectorAll('.increase');
        const quantityInput = document.querySelectorAll('.quantity-input');
        const btn_up = document.querySelectorAll('.btn_up');
        
        decreaseButtons.forEach(function(button) {
            button.addEventListener('click', function () {
                let input = button.parentElement.querySelector('.quantity-input');
                let currentValue = parseInt(input.value);
                if (currentValue > 1) {
                    input.value = currentValue - 1;
                }
            });
        });

        increaseButtons.forEach(function(button) {
            button.addEventListener('click', function () {
                let input = button.parentElement.querySelector('.quantity-input');
                let currentValue = parseInt(input.value);
                if (currentValue < 99) {
                    input.value = currentValue + 1;
                }
            });
        });

        btn_up.forEach(function(item, index) {
            item.addEventListener('click', function () {
                let value = document.querySelectorAll('.quantity-input')[index].value;
                item.href = `index.php?update_quantity=${value}&id=${index}`;
            });
        });

    });
</script>