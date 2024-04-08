<div class="box_content bbg-gr py-3">
    <div class="mgbg d-flex justify-content-center py-4">
        <div class="thank d-flex flex-column align-items-center">
            <?= $check ? '<i class="fa-regular fa-circle-check ic_tc"></i>' : '<i class="fa-regular fa-circle-xmark ic_tb"></i>'?>
            <h1 class="<?= $check ? 'h1_true' : 'h1_false'?>"><?= $status?></h1>
            <p class="text-center">Chúng tôi sẽ liên hệ quý khách để xác nhận đơn hàng xớm nhất.</p>
            <div class="d-flex align-items-center gap-2">
                <a href="<?=$SITE_URL?>/gio_hang/index.php?don_hang"><button type="button" class="btn btn-outline-secondary">Xem chi tiết đơn hàng</button></a>
                <a href="<?=$SITE_URL?>/san_pham/index.php"><button type="button" class="btn btn-danger">Tiếp tục mua hàng</button></a>
            </div>
        </div>
    </div>
</div>