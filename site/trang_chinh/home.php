        <div class="box_banner">
            <div class="d-flex bbh">
                <div class="banner_left col-lg-8 col-12">
                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="<?= $CONTENT?>/image/slide1.jpg"
                                    class="d-block w-100 hh" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="<?= $CONTENT?>/image/slide2.jpg"
                                    class="d-block w-100" alt="...">
                            </div>
                            
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="d-none d-lg-block col-4">
                    <div class="banner_right ">
                        <div class="banner_sale_1"><img src="<?=$CONTENT?>/image/slide6.webp" alt=""></div>
                        <div class="banner_sale_2"><img src="<?=$CONTENT?>/image/slide5.jpg" alt=""></div>
                    </div>
                </div>

            </div>

        </div>

        <div class="box_content mt-3">
            <div class="row">
                <div class="col-xl-4 col-lg-6 mb-3">
                    <div class="kh_item d-flex align-items-center gap-3">
                        <img src="<?=$CONTENT?>/image/icon01.png" alt="">
                        <div class="kh_item_text">
                            <h4 style="color: red;">Thương hiệu lâu đời</h4>
                            <p>Tân Việt đã kinh doanh võ phục và các dụng cụ thi đấu, tập luyện từ năm 1962</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 mb-3">
                    <div class="kh_item d-flex align-items-center gap-3">
                        <img src="<?=$CONTENT?>/image/icon02.jpg" alt="">
                        <div class="kh_item_text">
                            <h4 style="color: red;">Ship hàng siêu tốc</h4>
                            <p>Chúng tôi hỗ trợ ship hàng siêu tốc khu vực nội thành TP. Hồ Chí Minh</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-12 mb-3">
                    <div class="kh_item d-flex align-items-center gap-3">
                        <img src="<?=$CONTENT?>/image/icon03.png" alt="">
                        <div class="kh_item_text">
                            <h4 style="color: red;">Đổi trả miễn phí</h4>
                            <p>Chúng tôi hỗ trợ đổi trả miễn phí với hàng lỗi, hàng kém chất lượng năm 1962</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="box_content py-3">
            <div class="d-flex justify-content-between align-items-center">
                <p class="vien"></p>
                <span class="title_ct">DANH MỤC VÕ PHỤC</span>
                <p class="vien"></p>
            </div>
            
            <p class="text-center pb-4">Mời bạn cùng tham khảo danh mục sản phẩm bán chạy nhất của Tân Việt</p>
            
            <div class="slider_container">
                
                <div class="swiper card_slider">
                    <div class="swiper-wrapper">
                        <?php foreach($list_dm as $list) : extract($list)?>
                            <div class="swiper-slide">
                                <a href="<?=$SITE_URL?>/san_pham/index.php?keyword=<?= $category_name?>">
                                    <div class="img_box">
                                        <img src="<?=$UPLOAD_URL.'/'.$category_img?>" alt="">
                                    </div>
                                    <div class="tieudeanh">
                                        <h5 class="tieudend"><?= $category_name?></h5>
                                    </div>
                                </a>

                            </div>
                        <?php endforeach ?>
                    </div>
                    <div class="swiper-button-next arrow arrow-left"></div>
                    <div class="swiper-button-prev arrow arrow-left"></div>
                </div>
              
            </div>
        </div>

        <div class="box_content py-3">
            <div class="box_muc mb-3 d-flex justify-content-between align-items-center">
                <p>VÕ PHỤC NỔI BẬT</p>
                <div>
                    <a href="<?=$SITE_URL?>/san_pham/index.php">Xem tất cả</a>
                    <i class="fa-solid fa-angle-right"></i>
                </div>
            </div>
            <div class="row">
                <?php foreach($list_sp_view as $list) : extract($list)?>
                    <div class=" col-xl-3 col-lg-3 col-md-4 col-sm-6 mb-3">
                        <a href="<?=$SITE_URL?>/san_pham/index.php?san_pham_chi_tiet=<?= $product_id ?>" class="box_sp d-flex flex-column">
                            <div class="box_img_sp d-flex justify-content-center">
                                <img src="<?=$UPLOAD_URL.'/'.$image_url?>" alt="">
                            </div>
                            <h1 class="title"><?= $product_name?></h1>
                            <span><?= number_format($price, 0, "", ".")?> VNĐ</span>
                        </a>
                    </div>
                <?php endforeach ?>
                
            </div>
        </div>

        <div class="box_content py-3">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="box_bn_img">
                        <img src="<?=$CONTENT?>/image/banner-1.jpg" alt="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box_bn_img">
                        <img src="<?=$CONTENT?>/image/banner02.jpg" alt="">
                    </div>
                </div>

            </div>
        </div>

        <div class="box_content py-3">
            <div class="box_muc mb-3 d-flex justify-content-between align-items-center">
                <p>TAEKWONDO</p>
                <div>
                    <a href="<?=$SITE_URL?>/san_pham/index.php?keyword=Taekwondo">Xem tất cả</a>
                    <i class="fa-solid fa-angle-right"></i>
                </div>
            </div>
            <div class="row">
                <?php foreach($list_sp as $list) : extract($list)?>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 mb-3">
                        <a href="<?=$SITE_URL?>/san_pham/index.php?san_pham_chi_tiet=<?= $product_id ?>" class="box_sp d-flex flex-column">
                            <div class="box_img_sp d-flex justify-content-center">
                                <img src="<?=$UPLOAD_URL.'/'.$image_url?>" alt="">
                            </div>
                            <h1 class="title"><?= $product_name?></h1>
                            <span><?= number_format($price, 0, "", ".") ?> VNĐ</span>
                        </a>
                    </div>
                <?php endforeach ?>
            </div>
        </div>

        <div class="box_content py-3">
            <div class="d-flex justify-content-between align-items-center">
                <p class="vien"></p>
                <span class="title_ct">ĐỐI TÁC CỦA CHÚNG TÔI</span>
                <p class="vien"></p>
            </div>
            <p class="text-center mb-4">Chân thành cảm ơn các đối tác đã cung cấp võ phục và các thiết bị luyện tập cho chúng
                tôi trong suốt thời gian qua</p>

                     <!-- đối tác của chúng tôi -->

            <div class="slider_container">
                
                <div class="swiper card_slider">
                    <div class="swiper-wrapper">
                        <?php foreach($list_br as $list) : extract($list) ?>
                            <div class="swiper-slide">
                                <div class="d-flex justify-content-center">
                                    <img src="<?=$UPLOAD_URL.'/'.$brand_img ?>" alt="">
                                </div>
                            </div>        
                        <?php endforeach ?>                
                    </div>
                    <div class="swiper-button-next  arrow-left"></div>
                    <div class="swiper-button-prev arrow-left "></div>
                </div>
                
            </div>
        </div>

        <div class="box_content pt-3">
            <div class="d-flex justify-content-between align-items-center">
                <p class="vien"></p>
                <p class="title_ct">KHÁCH HÀNG NÓI GÌ VỀ CHÚNG TÔI</p>
                <p class="vien"></p>
            </div>
            <p class="text-center mb-3">Với hơn 40 năm phục vụ, chúng tôi đã nhận được không ít lời khen ngợi và phản hồi
                tích cực</p>
            <div class="slider_container">
               
                    <div class="swiper card_slider_feeback">
                        <div class="swiper-wrapper">
    
                        <div class="swiper-slide">
                            <div class="img_box_feedback">
                                <img src="https://gcs.tripi.vn/public-tripi/tripi-feed/img/474015QSt/anh-gai-xinh-1.jpg" alt="">
                                <div class="des">
                                <p>Lê Phương Linh - Khánh Hòa</p>
                                Tôi rất yên tâm bởi đây là công nghệ đã được các tổ chức uy tín trên thế giới như FDA (Hoa Kỳ), CE (Châu Âu) chứng nhận về hiệu quả và độ an toàn. Bây giờ mặt tôi không còn vết nám nào cả. Cảm ơn spa rất nhiều! Chúc Beryl Beauty Spa làm ăn phát đạt!
                                </div>
                            </div>
                        </div>
    
                        <div class="swiper-slide">
                            <div class="img_box_feedback">
                                <img src="https://mas.edu.vn/wp-content/uploads/2022/08/gai-xinh-deo-kinh-47.jpg" alt="">
                                <div class="des">
                                    <p>Thanh Mai - Bình Dương</p>
                                Tôi rất yên tâm bởi đây là công nghệ đã được các tổ chức uy tín trên thế giới như FDA (Hoa Kỳ), CE (Châu Âu) chứng nhận về hiệu quả và độ an toàn. Bây giờ mặt tôi không còn vết nám nào cả. Cảm ơn spa rất nhiều! Chúc Beryl Beauty Spa làm ăn phát đạt!
                                </div>
                            </div>
                        </div>
    
                        <div class="swiper-slide">
                            <div class="img_box_feedback">
                            <img src="https://thcsbinhchanh.edu.vn/wp-content/uploads/2023/08/Anh-gai-xinh-lam-anh-dai-dien-facebook.jpg" alt="">
                            <div class="des">
                                <p>Nguyễn Phương - Thái Bình</p>
                                Tôi rất yên tâm bởi đây là công nghệ đã được các tổ chức uy tín trên thế giới như FDA (Hoa Kỳ), CE (Châu Âu) chứng nhận về hiệu quả và độ an toàn. Bây giờ mặt tôi không còn vết nám nào cả. Cảm ơn spa rất nhiều! Chúc Beryl Beauty Spa làm ăn phát đạt!
                            </div>
                            </div>
                        </div>
    
                        <div class="swiper-slide">
                        <div class="img_box_feedback">
                            <img src="https://toigingiuvedep.vn/wp-content/uploads/2022/05/anh-trai-dep-dau-nam-han-quoc.jpg" alt="">
                            <div class="des">
                                <p>Nguyễn Nam Khang - Hà Nội</p>
                            Tôi rất yên tâm bởi đây là công nghệ đã được các tổ chức uy tín trên thế giới như FDA (Hoa Kỳ), CE (Châu Âu) chứng nhận về hiệu quả và độ an toàn. Bây giờ mặt tôi không còn vết nám nào cả. Cảm ơn spa rất nhiều! Chúc Beryl Beauty Spa làm ăn phát đạt!
                            </div>
                        </div>
                        </div>
    
                        </div>
                        <div class="swiper-button-next arrow-left"></div>
                        <div class="swiper-button-prev arrow-left"></div>
                    </div>
               
            </div>
        </div> 

        <div class="box_content py-3">
            <p class="title_ct text-center">Tin tức – bài viết</p>
            <p class="bor_box"></p>

            <div class="row mt-4">
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="box_tt">
                        <div class="box_img_tt">
                            <img src="<?=$CONTENT?>/image/tt_1.jpg"
                                alt="">
                        </div>
                        <h1>Tổng Đàn Chủ Nam Anh Kiệt đáp trả “cực gắt” lời thách đấu của cựu vô địch SEA Games Tán Thủ
                        </h1>
                        <span>Sau thất bại của tay đấm Tán Thủ phong trào Lưu Cường ...</span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="box_tt">
                        <div class="box_img_tt">
                            <img src="<?=$CONTENT?>/image/tt_2.jpg"
                                alt="">
                        </div>
                        <h1>Những võ sĩ UFC bị “sấp mặt” nhiều nhất trên lồng sắt</h1>
                        <span>Việc bị hạ knock-out không chỉ ảnh hưởng đến thành tích thi ...</span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="box_tt">
                        <div class="box_img_tt">
                            <img src="<?=$CONTENT?>/image/tt_3.jpg"
                                alt="">
                        </div>
                        <h1>Thời phong kiến, muốn làm quan võ phải thi như thế nào?</h1>
                        <span>Sau thất bại của tay đấm Tán Thủ phong trào Lưu Cường ...</span>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center my-3">
            <a href="<?=$SITE_URL?>/trang_chinh/index.php?tin_tuc"><button type="button" class="btn btn-danger btn-sm">Xem thêm</button></a>
            </div>
        </div>

        <div class="box_content py-3">
            <div class="img_bn_cc"><img src="<?=$CONTENT?>/image/end03.jpg" alt=""></div>
        </div>