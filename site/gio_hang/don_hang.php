
<div class="filter">
    <div class="box_content pt-3 d-flex align-items-center justify-content-between">
        <div>
            <nav aria-label="breadcrumb" class="d-none d-md-block">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Trang chu</li>
                    <li class="breadcrumb-item">Giỏ hàng</li>
                    <li class="breadcrumb-item active" aria-current="page">Lịch sử đơn hàng</li>
                </ol>
            </nav>
        </div>

    </div>
</div>


<div class="box_content bbg-gr py-3">
    <div class="bgkj">
        <h1>Lịch sử đơn hàng</h1>
        <?php
            if(!isset($_SESSION['user'])){
                echo '<div class="d-flex flex-column align-items-center">
                        <h1 class="title_order">Kiểm tra đơn hàng của bạn</h1>
                        <form action="index.php?don_hang" method="post" class="box_order_search d-flex flex-column align-items-center col-7 gap-3">
                            <input type="text" class="col-6" name="order_id" placeholder="Nhập vào mã đơn hàng để tra cứu.">
                            <button type="submit" class="btn btn-danger col-3 mb-3">Tra cứu</button>
                        </form>
                    </div>';
            }
            if(!empty($list_dh)){
                foreach($list_dh as $list){
                    $list_or = order_detail_select_alls($list['order_id']);
                        echo '<div class="box_hd mb-2">
                                <div class="icon_deles" style="display: '.($list['status_id'] < 4 ? "none" : "block").'"><a href="index.php?don_hang&status_hide='.$list['order_id'].'"><i class="fa-regular fa-circle-xmark"></i></a></div>
                                <div class="wrapper_history_cart">
                                    <div class="wrapper_item_history_cart">
                                        <div class="history_cart_1"><b>Mã đơn: '.$list['order_id'].'</b></div>

                                        <div class="status_history_cart">
                                            <div class="status_delevery">
                                                <i class="fas fa-truck"></i>';
                                            echo $list['status_id'] == 6 ? '<span>Giao hàng thành công</span>' : ($list['status_id'] == 5 ? '<span>Giao hàng đã bị hủy</span>' : ($list['status_id'] == 4 ? '<span>Đã giao hàng</span>' : ($list['status_id'] == 3 ? '<span>Đang giao hàng</span>' : ($list['status_id'] == 2 ? '<span>Đang chuẩn bị hàng</span>' : '<span>Đang chờ xác nhận</span>'))));
                                            echo '</div>
                                            <div class="check_status">';
                                                echo $list['status_id'] == 6 ? '<span>HOÀN THÀNH</span>' : ($list['status_id'] == 5 ? '<span>ĐÃ HỦY</span>' : '<span>CHƯA HOÀN THÀNH</span>');
                                            echo '</div>
                                        </div>
                                    </div>
                                </div>';


                                foreach($list_or as $lists){
                                    extract($lists);
                                    echo '<a href="'.$SITE_URL.'/san_pham/index.php?san_pham_chi_tiet='.$product_id.'" class="history_cart_infor_wrapper align-items-center">
                                            <div class="history_cart_infor">
                                                <div class="history_cart_img">
                                                    <img src="'.$UPLOAD_URL.'/'.$image.'" alt="">
                                                </div>
                                                <div class="history_cart_infor_detail">
                                                    <p class="history_cart_infor_title">'.$product_name.'</p>
                                                    <p class="history_cart_infor_title_distribute">Phân loại hàng :'.$color_name .' - '.$size_name.'</p>
                                                    <p class="history_cart_infor_quantity">
                                                        <span>x '.$quantity.'</span>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="history_cart_infor_detail_price">
                                                <span>'.number_format($unit_price, 0, "", ".").'đ</span>
                                            </div>
                                        </a>';
                                    };
                                    echo '<div class="d-flex align-items-center justify-content-between mt-3">
                                        <p></p>
                                        <div class="d-flex align-items-center gap-2">
                                        <p class="bill_price mb-0">Thành tiền:</p>
                                        <p class="tt_pr">'.number_format($list['payment'], 0, "", ".").'đ</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-3">
                                        <p><b>Ngày tạo:</b> '.$list['created_at'].' / <b>Địa chỉ nhận hàng:</b> '.$list['address'].'</p>';
                                    if(isset($_SESSION['user'])){
                                        echo ($list['status_id'] == 1 || $list['status_id'] == 2) ? '<a href="index.php?btn_status='.$list['order_id'].'&status_id=5&page='.$page.'"><button type="button" class="btn btn-danger">Hủy đơn hàng</button></a>' : 
                                        ($list['status_id'] == 5 ? '<a href="index.php?btn_status='.$list['order_id'].'&status_id=1&page='.$page.'"><button type="button" class="btn btn-success">Mua lại</button></a>' : 
                                        ($list['status_id'] == 4 ? '<a href="index.php?btn_status='.$list['order_id'].'&status_id=6&page='.$page.'"><button type="button" class="btn btn-success">Đã nhận được hàng</button></a>' : 
                                        ($list['status_id'] == 6 ? '<a href="index.php?mua_lai='.$list['order_id'].'"><button type="button" class="btn btn-success">Mua lại</button></a>' : '<button type="button" class="btn btn-success" disabled>Đã nhận được hàng</button></a>')));
                                    }else{
                                        echo '<button type="button" class="btn btn-danger">Để hủy đơn hàng liên hệ hotline 033.897.3258</button>';
                                    }
                                    
                                    echo '</div>';

                        echo '</div>';
                    }
            }else{
                echo isset($_SESSION['user']) ? "<p class='text-center'>Chưa có đơn hàng nào.</p>" : "";
                 
            }  
          ?>
        <?php if(sizeof($count_doc) > 8) : ?>
            <div class="d-flex flex-row-reverse">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <?php if($page > 1) : ?>
                            <li class="page-item">
                                <a class="page-link linkm" href="index.php?don_hang&page=<?= $page - 1?>">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                        <?php endif ?>
                        
                        <?php for($i = 1 ; $i <= $total_pages ; $i++) : ?>
                            <li class="page-item"><a class="page-link linkm" href="index.php?don_hang&page=<?= $i?>"><?= $i?></a></li>
                        <?php endfor ?>

                        <?php if($page < $total_pages) : ?>
                            <li class="page-item">
                                <a class="page-link linkm" href="index.php?don_hang&page=<?= $page + 1?>">
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

