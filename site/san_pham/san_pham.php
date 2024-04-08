<div class="filter">
    <div class="box_content py-3 d-flex align-items-center justify-content-between">
        <div>
            <nav aria-label="breadcrumb" class="d-none d-md-block">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">Trang chủ</li>
                    <li class="breadcrumb-item">Sản phẩm</li>
                    <li class="breadcrumb-item active" aria-current="page">Data</li>
                </ol>
            </nav>
        </div>

        <div class="col-lg-4 col-md-6 col-10">
            <form action="index.php" method="get" class="d-flex gap-2">
                <?= isset($keyword) ? '<input type="hidden" name="keyword" value="'.$keyword.'">' : ''?>
                <?= isset($color) ? '<input type="hidden" name="color" value="'.$color.'">' : ''?>
                <?= isset($size) ? '<input type="hidden" name="size" value="'.$size.'">' : ''?>
                
                <select class="form-select" name="sort_by">
                    <option value="default_sort">Sắp xếp sản phẩm</option>
                    <option value="price_asc">Sắp xếp tăng dần theo giá</option>
                    <option value="price_desc">Sắp xếp giảm dần theo giá</option>
                </select>
                <button type="submit" class="btn btn-danger">Sort</button>
            </form>

        </div>
    </div>
</div>


<div class="box_content bbg-gr py-3">
    <div class="row">

        <div class="col-xl-3 mb-3 d-none d-xl-block">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Lọc theo danh mục
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <?php foreach ($list_dm as $dm) : extract($dm) ?>
                                <a href="index.php?keyword=<?= $category_name ?><?= isset($color) ? '&color='.$color : '' ?><?= isset($size) ? '&size='.$size : '' ?><?= isset($sort_by) ? '&sort_by='.$sort_by : ''?>" style="color: black; display:block;width:100%;padding:10px;">
                                    <?= $category_name ?></a>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            Lọc theo màu sắc
                        </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <?php foreach($list_color as $list) : extract($list)?>
                                <a href="index.php?keyword=<?= $keyword ?? ''?>&color=<?= $color_id?><?= isset($size) ? '&size='.$size : '' ?><?= isset($sort_by) ? '&sort_by='.$sort_by : ''?>" style="color: black; display:block;width:100%;padding:10px;"><?= $color_name?></a>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                            Lọc theo kích thước
                        </button>
                    </h2>
                    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <?php foreach($list_size as $list) : extract($list)?>
                                <a href="index.php?keyword=<?= $keyword ?? ''?><?= isset($color) ? '&color='.$color : '' ?>&size=<?= $size_id?><?= isset($sort_by) ? '&sort_by='.$sort_by : ''?>" style="color: black; display:block;width:100%;padding:10px;"><?= $size_name?></a>
                            <?php endforeach ?>

                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="col-xl-9 mb-3">
            <div class="row">
                <?php if (empty($list_sp)) : ?>
                    <div class="col-12">
                        <p class="text_not_sp">Không có sản phẩm nào.</p>
                    </div>
                <?php else : ?>
                    <?php foreach ($list_sp as $list) : extract($list) ?>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 mb-3">
                            <a href="index.php?san_pham_chi_tiet=<?= $product_id ?>" class="box_sp d-flex flex-column">
                                <div class="box_img_sp d-flex justify-content-center">
                                    <img src="<?= $UPLOAD_URL . '/' . $image_url ?>" alt="">
                                </div>
                                <h1 class="title"><?= $product_name ?></h1>
                                <span><?= number_format($price, 0, "", ".") ?> VNĐ</span>
                            </a>
                        </div>
                    <?php endforeach ?>
                <?php endif ?>
            </div>
            <?php if(sizeof($count_doc) > 8) : ?>
                <div class="d-flex justify-content-center">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <?php if($page > 1) : ?>
                                <li class="page-item">
                                    <a class="page-link linkm" href="index.php?page=<?= $page - 1?><?= isset($keyword) ? '&keyword='.$keyword : ''?><?= isset($color) ? '&color='.$color : '' ?><?= isset($size) ? '&size='.$size : '' ?><?= isset($sort_by) ? '&sort_by='.$sort_by : ''?>">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            <?php endif ?>
                            
                            <?php for($i = 1 ; $i <= $total_pages ; $i++) : ?>
                                <li class="page-item"><a class="page-link linkm" href="index.php?page=<?= $i?><?= isset($keyword) ? '&keyword='.$keyword : ''?><?= isset($color) ? '&color='.$color : '' ?><?= isset($size) ? '&size='.$size : '' ?><?= isset($sort_by) ? '&sort_by='.$sort_by : ''?>"><?= $i?></a></li>
                            <?php endfor ?>

                            <?php if($page < $total_pages) : ?>
                                <li class="page-item">
                                    <a class="page-link linkm" href="index.php?page=<?= $page + 1?><?= isset($keyword) ? '&keyword='.$keyword : ''?><?= isset($color) ? '&color='.$color : '' ?><?= isset($size) ? '&size='.$size : '' ?><?= isset($sort_by) ? '&sort_by='.$sort_by : ''?>">
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