
<div class="box_tite mb-3">Quản lý tài khoản</div>

<div class="box_table my-3">
    <div class="box_btns py-2 mx-3 d-flex justify-content-between">
        <div class="box_btn">
            <button type="button" class="btn btn-primary"><a href="index.php?btn_add_ui">Tạo mới</a></button>
        </div>
    </div>

    <div class="box_wap_user mx-3 py-3">
        <div class="row">
            <div class="col-6">
                <div class="box_staff d-flex gap-3">
                    <div class="box_avata_auth"><img
                            src="<?=$CONTENT?>/image/images.png"
                            alt=""></div>
                    <div class="title_auth">
                        <h1>Tài khoản quản trị</h1>
                        <p><?= $manager?> Tài khoản</p>
                    </div>
                </div>
                <div class="box_edit_user d-flex justify-content-between align-items-center">
                    <a href="index.php?btn_list=1" class="view_detail">Xem chi tiết</a>
                    <i class="fa-solid fa-list"></i>
                </div>
            </div>
            <div class="col-6">
                <div class="box_staff d-flex gap-3">
                    <div class="box_avata_auth"><img
                            src="<?=$CONTENT?>/image/images.png"
                            alt=""></div>
                    <div class="title_auth">
                        <h1>Tài khoản khách hàng</h1>
                        <p><?= $customer?> Tài khoản</p>
                    </div>
                </div>
                <div class="box_edit_user d-flex justify-content-between align-items-center">
                    <a href="index.php?btn_list=2" class="view_detail">Xem chi tiết</a>
                    <i class="fa-solid fa-list"></i>
                </div>
            </div>

        </div>

    </div>

</div>

