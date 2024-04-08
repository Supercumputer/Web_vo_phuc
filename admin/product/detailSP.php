
<div class="box_tite mb-3">Quản lý sản phẩm</div>

<div class="box_table my-3">

    <div class="box_wap_user mx-3 py-3">
        <div class="row">
            <div class="col-6">
                <div class="box_staff p-0 d-flex gap-2">
                    <div class="box_bt_av"><i class="fa-solid fa-snowflake icon_1"></i></div>
                    <div class="title_auths">
                        <h1 class="">Quản lý biến thể</h1>
                        <p><?= $count_variant?> Biến thể</p>
                    </div>
                </div>
                <div class="box_edit_user mt-2 d-flex justify-content-between align-items-center">
                    <a href="index.php?variant=<?= $product_id?>" class="view_detail">Xem chi tiết</a>
                    <i class="fa-solid fa-list"></i>
                </div>
            </div>
            <div class="col-6">
                <div class="box_staff p-0 d-flex gap-2">
                    <div class="box_bt_av bg"><i class="fa-regular fa-image icon_2"></i></div>
                    <div class="title_auths">
                        <h1 class="">Quản lý hình ảnh</h1>
                        <p><?= $count_album?> Hình ảnh</p>
                    </div>
                </div>
                <div class="box_edit_user mt-2 d-flex justify-content-between align-items-center">
                    <a href="index.php?album=<?= $product_id?>" class="view_detail">Xem chi tiết</a>
                    <i class="fa-solid fa-list"></i>
                </div>
            </div>

        </div>

    </div>

</div>

