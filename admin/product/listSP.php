
<div class="box_tite mb-3">Quản lý sản phẩm</div>

<div class="box_table my-3">
    <div class="box_btns py-2 mx-3 d-flex justify-content-between align-items-center">
    <div class="box_btn">
            <button type="button" class="btn btn-primary"><a href="index.php?btn_add_ui">Tạo mới</a></button>
            <button type="button" class="btn btn-secondary select-all">Chọn tất cả</button>
            <button type="button" class="btn btn-success deselect-all">Bỏ chọn tất cả</button>
            <button type="button" class="btn btn-danger delete-selected"><a class="url_all_delete" onclick="return confirm('Bạn có muốn xóa không.')">Xóa mục đã chọn</a></button>
            <button type="button" class="btn btn-primary"><a href="index.php?list_trash"><i class="fa-solid fa-trash-can"></i> Thùng rác</a></button>
        </div>

        <form action="index.php" method="GET" class="mb-0">
            <input type="text" name="key" placeholder="Search here ...">
        </form>
    </div>

    <div class="box_wap mx-3 pt-2 pb-1">

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">
                        <input class="form-check-input" name="input_all" type="checkbox" value="">
                    <th>
                    <th scope="col">ID</th>
                    <th scope="col" class="name_column">Tên sản phẩm</th>
                    <th scope="col">Ảnh</th>
                    <th scope="col">Danh mục</th>
                    <th scope="col">Hãng</th>
                    <th scope="col">Số lượt xem</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($list_product as $list) : extract($list) ?>
                <tr style="vertical-align: middle;">
                    <th scope="col">
                        <input class="form-check-input" name="input_item" type="checkbox" value="<?= $product_id?>" data_id="<?= $product_id ?>" data_name="sp">
                    <th>
                    <td scope="row"><?= $product_id?></td>
                    <td><span class="title"><?= $product_name?></span></td>
                    <td><img src="<?=$UPLOAD_URL.'/'.$image_url?>" width="80" alt=""></td>
                    <td><?= $category_name?></td>
                    <td><?= $brand_name?></td>
                    <td><?= $view?></td>
                    <td>
                        <div class="icon_btn">
                            <a class="btn_show" data-bs-toggle="modal" data-bs-target="#exampleModal" data="<?= $product_id?>" data_id="<?= $product_id ?>" data_name="sp"><i class="fa-solid fa-trash-can"></i></a>
                            <a href="index.php?btn_edit=<?= $product_id?>"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="index.php?manager_sp=<?= $product_id?>"><i class="fa-brands fa-dropbox"></i></i></a>
                        </div>
                    </td>
                </tr>
                <?php endforeach ?>
                
            </tbody>
        </table>
    </div>

    <?php if(sizeof($count_doc) > 8) : ?>
        <div class="d-flex flex-row-reverse pe-3">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php if($page > 1) : ?>
                        <li class="page-item">
                            <a class="page-link linkm" href="index.php?page=<?= $page - 1?><?= isset($keyword) ? '&key='.$keyword : ''?>">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php endif ?>
                    
                    <?php for($i = 1 ; $i <= $total_pages ; $i++) : ?>
                        <li class="page-item"><a class="page-link linkm" href="index.php?page=<?= $i?><?= isset($keyword) ? '&key='.$keyword : ''?>"><?= $i?></a></li>
                    <?php endfor ?>

                    <?php if($page < $total_pages) : ?>
                        <li class="page-item">
                            <a class="page-link linkm" href="index.php?page=<?= $page + 1?><?= isset($keyword) ? '&key='.$keyword : ''?>">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    <?php endif ?>
                </ul>
            </nav>
        </div>
    <?php endif ?>

</div>
