
<div class="box_tite mb-3">Bảng điều khiển</div>
<div class="box_count">
    <div class="row">
        <div class="col custom-column">
            <div class="box_count_item d-flex align-items-center gap-2 ">
                <i class="icon_01 fa-solid fa-users"></i>
                <div class="box_infor_item">
                    <div class="infor_item_top">
                        <h2>TỔNG TÀI KHOẢN</h2>
                        <p><?= $count_ac?> tài khoản</p>
                    </div>
                    <span class="title_des">Tổng số tài khoản được quản lý</span>
                </div>
            </div>

        </div>
        <div class="col custom-column">
            <div class="box_count_item d-flex align-items-center gap-2 ">
                
                <i class="icon_02 fa-solid fa-layer-group"></i>
                <div class="box_infor_item">
                    <div class="infor_item_top">
                        <h2>TỔNG DANH MỤC</h2>
                        <p><?= $count_dm?> danh mục</p>
                    </div>
                    <span class="title_des">Tổng số danh mục được quản lý</span>
                </div>
            </div>

        </div>
        <div class="col custom-column">
            <div class="box_count_item d-flex align-items-center gap-2 ">
                <i class="icon_03 fa-solid fa-clipboard"></i>
                <div class="box_infor_item">
                    <div class="infor_item_top">
                        <h2>TỔNG ĐƠN HÀNG</h2>
                        <p><?= $count_dh?> đơn hàng</p>
                    </div>
                    <span class="title_des">Tổng số đơn hàng được quản lý</span>
                </div>
            </div>

        </div>
        <div class="col custom-column">
            <div class="box_count_item d-flex align-items-center gap-2 ">
                <i class="icon_04 fa-solid fa-database"></i>
                <div class="box_infor_item">
                    <div class="infor_item_top">
                        <h2>TỔNG SẢN PHẨM</h2>
                        <p><?= $count_sp?> sản phẩm</p>
                    </div>
                    <span class="title_des">Tổng số sản phẩm được quản lý</span>
                </div>
            </div>

        </div>
    </div>

</div>

<div class="box_chart mt-3">
    <h2 class="py-2 mx-3">Biểu đồ thống kê đơn hàng theo tháng</h2>
    <div id="myfirstchart" style="height: 250px;"></div>
</div>
<div class="box_table my-3">
    <h2 class="py-2 mx-3">Khách hàng mới</h2>

    <div class="box_wap mx-3 py-2">
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID </th>
                    <th scope="col">Tên khách hàng</th>
                    <th scope="col">Email</th>
                    <th scope="col">Số điện thoại</th>
                    <th scope="col">Địa chỉ</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($list_top_5_user as $list) : extract($list) ?>
                    <tr style="vertical-align: middle;">
                        <td><?= $user_id?></td>
                        <td><?= $full_name?></td>
                        <td><?= $email?></td>
                        <td><?= $phone?></td>
                        <td><?= $address?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

</div>
<div class="box_table">
    <h2 class="py-2 mx-3">Đơn hàng mới nhất</h2>

    <div class="box_wap mx-3 py-2">
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Khách hàng</th>
                    <th scope="col">Ngày tạo</th>
                    <th scope="col">Mã giảm giá</th>
                    <th scope="col">Tổng</th>
                    <th scope="col">Trạng thái</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach($list_top_5_order as $list) : extract($list) ?>
                    <tr style="vertical-align: middle;">
                        <td scope="row"><?= $order_id?></td>
                        <td style="width: 300px;">
                            <div class="d-flex flex-column">
                                <span><?= $full_name?></span>
                                <span><?= $email?></span>
                                <span><?= $phone?></span>
                                <span><?= $address?></span>
                            </div>
                        </td>
                        <td><?= $created_at?></td>
                        <td><?= $voucher ? $voucher : 'Không có'?></td>
                        <td><?= number_format($payment, 0, "", ".")?></td>
                        <td><?= $status_id === 4 ? '<span style="color: #198754; font-weight: 500;">'.$status_name.'</span>' : ($status_id === 5 ? '<span style="color: #DC3545; font-weight: 500;">'.$status_name.'</span>' : '<span style="font-weight: 500;">'.$status_name.'</span>')?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script>
    // Khởi tạo mảng orderData
    let orderData = [];

    <?php
    // Duyệt qua mỗi phần tử trong kết quả từ PHP
    foreach($result as $item) {
        // Tạo một đối tượng JavaScript và thêm vào mảng orderData
        echo "orderData.push({ month: '" . $item['month'] . "', orders: " . $item['total_orders'] . " });";
    }
    ?>
    // Tạo biểu đồ diện tích với Morris.js
    new Morris.Area({
        // ID của phần tử HTML để vẽ biểu đồ
        element: 'myfirstchart',
        // Dữ liệu
        title: 'Biểu đồ thống kê đơn hàng theo tháng',
        data: orderData,
        // Trường dữ liệu cho trục x (tháng)
        xkey: 'month',
        // Trường dữ liệu cho trục y (số đơn hàng)
        ykeys: ['orders'],
        // Nhãn cho trục y
        labels: ['Số đơn hàng'],
        // Màu sắc của biểu đồ
        lineColors: ['#FF5733'], // Màu cam
        // Định dạng hiển thị cho dữ liệu trên biểu đồ
        parseTime: false
    });
</script>
