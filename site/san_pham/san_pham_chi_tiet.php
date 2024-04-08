<div class="bbg-gr">
    <div class="box_content py-3">
        <div class="mgbg">
            <div class="row padi">
                <div class="col-lg-6 ">
                    <!-- start render sp ct -->
                    <div class="box_img_imgs">

                        <div class="carousel d-flex flex-column gap-2" id="carouselDemo" data-bs-wrap="true">

                            <div class="carousel-inner d-flex justify-content-center">

                            <?php $is_first = true; ?>
                            <?php foreach ($list_img as $list) : extract($list) ?>
                                <div class="carousel-item <?= $is_first ? 'active' : '' ?> h">
                                    <img class="img_carousel" src="<?= $UPLOAD_URL.'/'.$image_url?>" alt="">
                                </div>
                                <?php $is_first = false; ?>
                            <?php endforeach ?>

                            </div>

                            <div class="carousel-indicators d-flex align-items-center">
                                <?php $is_first = true; $dem = 0;?>
                                <?php foreach ($list_img as $list) : extract($list) ?>
                                    <button type="button" class="<?= $is_first ? 'active' : '' ?>" data-bs-target="#carouselDemo" data-bs-slide-to="<?= $dem?>">
                                        <img class="carousel-indicators_img" src="<?= $UPLOAD_URL.'/'.$image_url?>" alt="">
                                    </button>  
                                    <?php $is_first = false; $dem++?>             
                                <?php endforeach ?>

                            </div>

                        </div>
                        
                    </div>

                </div>

                <div class="col-lg-6">
                    <h1 class="name_product"><?= $product_name?></h1>
                    <div class="d-flex align-items-center">
                        <div id='rating3' class='px-0 pe-2'></div>
                        <p class='danhgia'><?= $result_rating?> Đánh giá</p>
                        <p class='daban'><?= $result_sold?> Đã bán</p>
                    </div>

                    <div class="box_price my-3 d-flex align-items-center">
                        <?php
                            $sale_price = $infor_varian['price'] - ($infor_varian['price'] * ($infor_varian['discount'] / 100));
                            if($infor_varian['discount'] > 0){
                                echo '<p class="t_price">đ'.number_format($infor_varian['price'], 0, "", ".").'</p> - <p class="t_discount mx-1">₫'.number_format($sale_price, 0, "", ".").'</p>';
                            }else{
                                echo '<p class="t_discount">₫'.number_format($infor_varian['price'], 0, "", ".").'</p>';
                            }
                        ?>

                    </div>

                    <p class="mn">Color:</p>
                    <div class="box_color d-flex gap-2 mb-3">
                        <?php foreach($list_color as $list) : ?>
                            <a href="index.php?san_pham_chi_tiet=<?= $product_id?>&color_id=<?= $list['color_id']?>"><p class="<?= $list['color_id'] == $color_id ? 'active_btn' : ''?>"><?= $list['color_name']?></p></a>
                        <?php endforeach ?>
                    </div>

                    <p class="mn">Size:</p>
                    <div class="box_color d-flex gap-2 mb-3">
                        <?php foreach($list_size as $list) : ?>
                            <a href="index.php?san_pham_chi_tiet=<?= $product_id?>&color_id=<?= $color_id?>&size_id=<?= $list['size_id']?>"><p class="<?= $list['size_id'] == $size_id ? 'active_btn' : ''?>"><?= $list['size_name']?></p></a>
                        <?php endforeach ?>
                    </div>

                    <p class="mn">Số lượng:</p>
                    <form action="index.php?add_cart" method="post">
                        <div class=" d-flex">
                            <input type="button" class="decrease" value="-">
                            <input type="text" class="quantity-input text-center" name="quantity" value="1" min="1" step="1">
                            <input type="button" class="increase" value="+">
                            <input type="hidden" name="variant_id" value="<?= $infor_varian['variant_id']?>">
                            <input type="hidden" name="image" value="<?= $list_img[0]['image_url']?>">
                            <input type="hidden" name="product_name" value="<?= $product_name?>">

                            <input type="hidden" name="size_id" value="<?= $infor_varian['size_id']?>">
                            <input type="hidden" name="color_id" value="<?= $infor_varian['color_id']?>">

                            <?php if($count_quantity > 0){ ?>
                                <span class="ps-3"><?= $count_quantity ?> sản phẩm có sẵn</span>
                            <?php }else{ ?>
                                <span class="ps-3" style="color: #DC3545; font-weight: 500;">Sản phẩm đã hết hàng.</span>
                            <?php } ?>
                        </div>

                        <div class="mt-4">
                            <button type="<?= $count_quantity > 0 ? 'submit' : 'button'?>" class="btn btn-success btn-lg" <?= $count_quantity <= 0 ? 'disabled' : ''?> name="mua_ngay">Mua ngay</button>
                            <button type="<?= $count_quantity > 0 ? 'submit' : 'button'?>" class="btn btn-danger btn-lg" <?= $count_quantity <= 0 ? 'disabled' : ''?> name="add_cart">Thêm vào giỏ hàng</button>
                        </div>
                    </form>
                    
                </div>

            </div>
        </div>

    </div>
    <?php if(sizeof($list_sp) > 1) :?>
        <div class="box_content mb-3">
            <div class="slider_container">
                    <div class="swiper card_slider">
                        <div class="swiper-wrapper" style="max-height: 278px;">
                            <?php foreach($list_sp as $list) : ?>
                                <div class="swiper-slide">
                                    <a href="index.php?san_pham_chi_tiet=<?= $list['product_id'] ?>" class="box_sp d-flex flex-column">
                                        <div class="box_img_sp d-flex justify-content-center">
                                            <img src="<?= $UPLOAD_URL . '/' . $list['image_url'] ?>" alt="">
                                        </div>
                                        <h1 class="title"><?= $list['product_name'] ?></h1>
                                        <span><?= number_format($list['price'], 0, "", ".") ?> VNĐ</span>
                                    </a>
                                </div>
                            <?php endforeach ?>
                        </div>
                        <div class="swiper-button-next arrow arrow-left"></div>
                        <div class="swiper-button-prev arrow arrow-left"></div>
                    </div>
            </div>
        </div>
    <?php endif?>                      
    <div class="box_content pb-3">
        <div class="mgbg p-3">
            <p class="tii">CHI TIẾT SẢN PHẨM</p>
            <div class="box_infor_ct d-flex flex-column gap-3">
                <p class="d-flex"><span class="mjh">Danh muc:</span><span class="okl"><?= $category_name?></span></p>
                <p class="d-flex"><span class="mjh">Ngày sản xuất:</span><span class="okl"><?= $created_at?></span></p>
                <p class="d-flex"><span class="mjh">Nhãn hàng:</span><span class="okl"><?= $brand_name?></span></p>
                <p class="d-flex"><span class="mjh">Kho hàng:</span><span class="okl">Dụng Cụ Võ Thuật Giá Sỉ HCM</span></p>
                <p class="d-flex"><span class="mjh">Gửi từ</span><span class="okl">TP. Hồ Chí Minh</span></p>
            </div>
            <p class="tii">MÔ TẢ SẢN PHẨM</p>
            <div class="box_infor_mt mb-2">
                <p><?= $description?></p>
            </div>
        </div>
    </div>

    <div class="box_content pb-3">
        <div class="mgbg p-3">
            <p class="tii mb-3">ĐÁNH GIÁ SẢN PHẨM</p>
            <!--  -->
            <div class="box_ratings d-flex gap-5 align-items-center mb-3">
                <div class="box_start d-flex flex-column justify-content-center align-items-center">
                    <p class="start_up_count"><?= $result_start?> / 5 Sao</p>
                    <div id='rating2' class='px-0 mb-3'></div>
                </div>
                <div class="box_start_btn">

                    <div class="box_color">
                        <a href="index.php?san_pham_chi_tiet=<?= $product_id ?>&start=all"><p class="<?= (check_url('start=all') || !check_url('start')) ? 'active_btn' : ''?>">Tất cả</p></a>
                    </div>
                
                    <div class="box_color">
                        <a href="index.php?san_pham_chi_tiet=<?= $product_id ?>&start=5"><p class="<?= check_url('start=5') ? 'active_btn' : ''?>">5 sao</p></a>
                    </div>
                
                    <div class="box_color">
                        <a href="index.php?san_pham_chi_tiet=<?= $product_id ?>&start=4"><p class="<?= check_url('start=4') ? 'active_btn' : ''?>">4 sao</p></a>
                    </div>
                       
                    <div class="box_color">
                        <a href="index.php?san_pham_chi_tiet=<?= $product_id ?>&start=3"><p class="<?= check_url('start=3') ? 'active_btn' : ''?>">3 sao</p></a>
                    </div>
                
                    <div class="box_color">
                        <a href="index.php?san_pham_chi_tiet=<?= $product_id ?>&start=2"><p class="<?= check_url('start=2') ? 'active_btn' : ''?>">2 sao</p></a>
                    </div>
            
                    <div class="box_color">
                        <a href="index.php?san_pham_chi_tiet=<?= $product_id ?>&start=1"><p class="<?= check_url('start=1') ? 'active_btn' : ''?>">1 sao</p></a>
                    </div>
                        
                </div>
            </div>
            <!--  -->
            <div class="bbox_comment">
                <div class="bbox_comment">
                   <?php if (isset($_SESSION['user']) && permistion_comment($product_id, $_SESSION['user']['email']) > 0 && comment_exit_user($product_id, $_SESSION['user']['user_id']) < 1) {
                        
                        echo "<div class='d-flex gap-3'>
                            <div class='box_inf_ava'>
                                <img src='".(!empty($_SESSION['user']['avatar']) ? $UPLOAD_URL.'/'.$_SESSION['user']['avatar']
                                : $CONTENT.'/image/avatar.jpg')."' alt=''>
                            </div>
                            <div class='nd_bt d-flex flex-column'>
                                                   
                                <p class='loi'>" . $_SESSION['user']['user_name'] . "</p>
                                
                                <form class='form_bl' action='index.php?id=" . $product_id . "&btn_comment' method='post'>
                                    <div id='rating' class='px-0 mb-3'></div>
                                    <div class='imk'></div>
                                    <input type='hidden' name='product_id' value='" . $product_id . "'>
                                    <textarea name='content' placeholder='Nhập bình luận tại đây!' rows='3' class='nd_bl'></textarea>
                                    <button type='submit' class='btn btn-danger'>Bình luận</button>
                                </form>
                            </div>
                        </div>";
                    }?>

                    <?php foreach ($list_comment as $lt_bl) : ?>
                        <div class="d-flex gap-3 mb-2">
                            <div class="box_inf_ava"><img src="<?= $UPLOAD_URL . '/' . $lt_bl['avatar'] ?>" alt=""></div>
                            <div class="d-flex flex-column gap-2">
                                <div>
                                    <p class="loi"><?= $lt_bl['user_name'] ?></p>
                                    <?php drawStars($lt_bl['start'], 'start_item');?>
                                    <p class="tl"><?= $lt_bl['created_at'] ?></p>
                                </div>

                                <span class="text-justify"><?= $lt_bl['content'] ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <?php if(sizeof($count_doc) > 8) : ?>
                        <div class="d-flex justify-content-center">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <?php if($page > 1) : ?>
                                        <li class="page-item">
                                            <a class="page-link linkm" href="index.php?san_pham_chi_tiet=<?= $product_id ?><?= isset($start) ? '&start='.$start : ''?>&page=<?= $page - 1?>">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                    <?php endif ?>
                                    
                                    <?php for($i = 1 ; $i <= $total_pages ; $i++) : ?>
                                        <li class="page-item"><a class="page-link linkm" href="index.php?san_pham_chi_tiet=<?= $product_id ?><?= isset($start) ? '&start='.$start : ''?>&page=<?= $i?>"><?= $i?></a></li>
                                    <?php endfor ?>

                                    <?php if($page < $total_pages) : ?>
                                        <li class="page-item">
                                            <a class="page-link linkm" href="index.php?san_pham_chi_tiet=<?= $product_id ?><?= isset($start) ? '&start='.$start : ''?>&page=<?= $page + 1?>">
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
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

<script>
$(function () {
    let form = document.querySelector('.imk');
   
    $("#rating").rateYo({
        starWidth: "20px",
        ratedFill: "#FFD700",
        rating: 0, // Điểm rating mặc định (tùy chọn)
        numStars: 5, // Số lượng sao tối đa
        precision: 1, // Số thập phân (tùy chọn)
        fullStar: true, // Cho phép hiển thị sao đầy đủ (tùy chọn)
        onChange: function (rating, rateYoInstance) {
            form.innerHTML = `<input type="hidden" name="start" value="${rating}">`
        }
    });
});

$("#rating2").rateYo({
    starWidth: "25px",
    ratedFill: "#FFD700",
    rating: <?=$result_start?>, // Điểm rating mặc định (tùy chọn)
    numStars: 5, // Số lượng sao tối đa
    precision: 1, // Số thập phân (tùy chọn)
    fullStar: true,
    readOnly: true // Cho phép hiển thị sao đầy đủ (tùy chọn)
});

$("#rating3").rateYo({
    starWidth: "18px",
    ratedFill: "#FFD700",
    rating: <?=$result_start?>, // Điểm rating mặc định (tùy chọn)
    numStars: 5, // Số lượng sao tối đa
    precision: 1, // Số thập phân (tùy chọn)
    fullStar: true,
    readOnly: true // Cho phép hiển thị sao đầy đủ (tùy chọn)
});

    document.addEventListener('DOMContentLoaded', function () {
        const decreaseButtons = document.querySelectorAll('.decrease');
        const increaseButtons = document.querySelectorAll('.increase');
        const quantityInput = document.querySelectorAll('.quantity-input');

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
                if (currentValue < <?= $infor_varian['quantity'] - count_product_sold_variant($infor_varian['variant_id']) ?>) {
                    input.value = currentValue + 1;
                }
            });
        });
    });

</script>