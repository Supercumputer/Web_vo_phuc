<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?= $CONTENT?>/image/tanviet.jpg" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="<?=$CONTENT?>/css/index.css">
    <!--  -->
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
    <!-- linkSlider -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <title>Tân Việt</title>
</head>

<body>
    <header class="container-fuild">
        <div class="header_top">
            <div class="box_wrap_top d-flex justify-content-md-between justify-content-center">
                <p class="title_header">Chào mừng <?= $_SESSION['user']['user_name'] ?? "bạn"?> đến với website shop võ thuật</p>
                <div class="d-md-block d-none">
                    <div class="d-flex d-flex align-items-center gap-2">
                        <a href="<?=$SITE_URL?>/tai_khoan/index.php" class="text_link_mm d-flex align-items-center gap-2">
                            <i class="fa-solid fa-user"></i>
                            <span>Tài khoản</span>
                        </a>
                        <div class="d-flex d-flex align-items-center gap-2">
                            <i class="fa-brands fa-product-hunt"></i>
                            <span>Sản phẩm</span>
                        </div>
                        <div class="d-flex d-flex align-items-center gap-2">
                            <i class="fa-solid fa-location-dot"></i>
                            <span>Hệ thống cửa hàng</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="header_center">
            <div class="box_wrap_center d-flex justify-content-between align-items-center">
                <div class="box_icon_menu d-md-none d-block">
                    <!-- iconBar -->
                    <!-- them  class iconBar vao icon -->
                    <a class="btn " data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                        <i class="fa-solid fa-bars bars"></i>
                    </a>
                    <!-- end -->
                </div>
                <a href="<?=$SITE_URL?>/trang_chinh/index.php"><div class="box_img"><img src="<?=$CONTENT?>/image/logo.png" alt=""></div></a>
                <div class="d-none d-md-block">
                    <form action="<?=$SITE_URL?>/san_pham/index.php" method="GET" class="box_search d-flex align-items-center">
                        <input type="text" placeholder="Tìm kiếm tại đây ..." name="keyword">
                        <button class="btn_search"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>

                <div class="d-none d-xl-block">
                    <div class="box_phone d-flex align-items-center gap-3">
                        <i class="fa-solid fa-phone-volume"></i>
                        <div class="d-flex flex-sm-column">
                            <span class="name_order">Gọi đặt hàng</span>
                            <span class="name_number">033.8973.258</span>
                        </div>
                    </div>
                </div>

                <div class="d-none d-xl-block">
                    <div class="box_phone d-flex align-items-center gap-3">
                        <i class="fa-solid fa-phone-volume"></i>
                        <div class="d-flex flex-sm-column">
                            <span class="name_order">Gọi tư vấn</span>
                            <span class="name_number">033.8973.258</span>
                        </div>
                    </div>
                </div>

                <div class="box_icon_cart d-md-none d-block">
                    <a class="ttloo" href="<?=$SITE_URL?>/gio_hang/index.php">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </a>
                </div>
            </div>

        </div>

        <div class="header_bottom d-none d-md-block">
            <div class="box_wrap_bottom d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="d-none d-lg-block">
                        <div class="bt_left d-flex align-items-center gap-3">
                            <i class="fa-solid fa-bars"></i>
                            <p>DANH MỤC SẢN PHẨM</p>
                            <div class="box_dm_po">
                                <?php foreach($list_dm as $list) : ?>
                                    <a href="<?=$SITE_URL?>/san_pham/index.php?keyword=<?= $list['category_name']?>" class="d-flex align-items-center gap-2">
                                        <i class="fa-solid fa-angle-right"></i>
                                        <span><?= $list['category_name']?></span>
                                    </a>
                                <?php endforeach ?>
                            </div>
                        </div>
                        
                    </div>

                    <?php require 'menu.php'?>
                    
                </div>

                <a class="cart d-flex align-items-center" href="<?=$SITE_URL?>/gio_hang/index.php">
                    <span class="d-none d-lg-block">Giỏ hàng</span>
                    <i class="fa-solid fa-cart-shopping"></i>
                </a>

            </div>

        </div>
    </header>

    <main>
        <?php require $VIEW_NAME?>

        <div class="box_mail_form">
            <div class="box_content_db">
                <div class="d-flex flex-md-row flex-column box_cc align-items-md-center justify-content-between gap-3">
                    <div class="km_text col-md-4 col-12">
                        <p>Đăng ký nhận tin khuyến mãi</p>
                        <span>Đăng ký nhận tin khuyến mãi
                            Dành cho khách hàng mới, đăng ký để nhận ưu đãi sớm nhất!</span>
                    </div>
                    <div class="gif_text d-flex align-items-center gap-2">
                        <i class="fa-solid fa-gift"></i>
                        <p>ĐĂNG KÝ NHẬN VOUCHER</p>
                    </div>
                    <div class="d-flex align-items-center col-md-5 col-12 gap-2">
                        <input type="text" placeholder="Nhập email của bạn tại đây ...">
                        <button type="button" class="btn btn-danger">Đăng kí ngay</button>
                    </div>

                </div>
            </div>


        </div>
    </main>
    <footer>
        <div class="box_content d-flex flex-column flex-md-row justify-content-between gap-3 mt-4">

            <div class="box_f_1">
                <img src="<?=$CONTENT?>/image/logo.png" alt="">
                <h2>Shop võ phục Tân Việt - Since 1962</h2>
                <p>Tân Việt được thành lập năm 1962. Trải qua hơn nửa thế kỷ xây dựng và phát triển, đến nay, Tân Việt
                    luôn
                    tự hào là nhân tố tiên phong trong lĩnh vực thiết kế, sản xuất, cung cấp và phân phối võ phục cũng
                    như
                    dụng cụ thể thao nói chung và dụng cụ võ thuật nói riêng.</p>

            </div>

            <div class="box_f_2">
                <img src="<?=$CONTENT?>/image/phone.jpg" alt="">
                <p class="py-2">Chẳng phải đợi lâu, chúng tôi ship hàng mọi miền tổ quốc với phí ship ưu đãi nhất!</p>
                <ul>
                    <li><span>Địa chỉ:</span> 528/5/112 Điện Biên Phủ, P.11, Q.10, TP.HCM</li>
                    <li><span>Hotline:</span> 1900-0062</li>
                    <li><span>Fanpage:</span> Tân Việt Co</li>
                    <li><span>Email:</span> sales_online@tanvietco.com</li>
                </ul>
            </div>

            <div class="box_f_3 d-md-none d-lg-block">
                <h2>Bản đồ đường đi tới Shop</h2>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7446.828176655126!2d105.72645661228769!3d21.056117322076254!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313454570374c5e3%3A0xdeb4689fca01b0ff!2zTmjhu5VuLCBNaW5oIEtoYWksIFThu6sgTGnDqm0sIEjDoCBO4buZaSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1710605752119!5m2!1svi!2s"
                    height="250" style="border:0;width: 100%;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
        <div class="fold mt-3">
            <div
                class="box_content d-flex flex-column flex-md-row justify-content-md-between justify-content-center align-items-center">
                <p>Copyright © 2019 - Shop đồ Võ Thuật Demo</p>
                <p>Hotline: 033.8973.258</p>
            </div>
        </div>
    </footer>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <div class="wraper_img">
                <img src="<?=$CONTENT?>/image/phone.jpg" alt="">
            </div>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="wrapp_danhmuc">
                <?php foreach($list_dm as $list) : extract($list)?>
                    <li><a href="<?=$SITE_URL?>/san_pham/index.php?keyword=<?= $category_name?>"><?= $category_name ?></a></li>
                <?php endforeach ?>
            </ul>
        </div>
    </div>

    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="<?=$CONTENT?>/image/logo.png" width="100" height="30" alt="Bootstrap">
                <strong class="me-auto"></strong>
                <small class="text-muted">11 mins ago</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div id="toast-body-content" class="toast-body"></div>
        </div>
    </div>
</body>

 <script>
    function showToast(message) {
        var liveToast = new bootstrap.Toast(document.getElementById('liveToast'));
        document.getElementById('toast-body-content').innerHTML = message;
        liveToast.show();
    }

    var swiper = new Swiper(".card_slider", {
        slidesPerView: 3,
        spaceBetween: 20,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      breakpoints: {
        320: {
          slidesPerView: 1,
        
        },
        480: {
          slidesPerView: 2,
        },
        768: {
          slidesPerView: 3,
          
        },
        1200: {
          slidesPerView: 4,
          
        },
      },
      });

    //   feedback
    var swiper = new Swiper(".card_slider_feeback", {
        slidesPerView: 3,
        spaceBetween: 10,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            320: {
            slidesPerView: 1,
            
            },
            480: {
            slidesPerView: 1,
            },
            768: {
            slidesPerView: 2,
            
            },
            1200: {
            slidesPerView: 2,
            
            },
        },
    });

</script>
    

