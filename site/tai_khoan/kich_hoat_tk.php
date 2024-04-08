<div class="box_conten_lg d-flex col-xl-7 col-lg-9 col-md-10 col-11 align-items-center">
    <div class="box_imgm col-5 d-none d-sm-block"><img
            src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/db/Vovinam_demonstration_Master_de_fleuret_2014_t223131.jpg/220px-Vovinam_demonstration_Master_de_fleuret_2014_t223131.jpg"
            alt=""></div>
    <div class="box_form col-sm-7 col-12">
        <h1 style="padding-bottom: 10px;">Welcome to Tan Viet</h1>
        <p style="padding-bottom: 10px;"><a href="<?=$SITE_URL?>/trang_chinh/index.php"><img width="300px" src="<?=$CONTENT?>/image/logo.png" alt=""></a></p>
        
        <p class="name_ac mb-3">Kích hoạt tài khoản</p>
        <form class="row g-3" action="index.php?kich_hoat" method="post" id="form">
            
            <div class="col-md-12">
                <input type="text" class="form-control" placeholder="Nhập vào mã kích hoạt" name="activated_code">
            </div>

            <div class="col-12 text-center">
                <button type="submit" class="btn btn-danger col-5">Kích hoạt tài khoản</button>
            </div>

            <div class="nut_chuyen d-flex justify-content-center gap-2">
                <a href="index.php">Đăng nhập</a>
                <a href="index.php?register">Đăng ký</a>
            </div>
        </form>
        
    </div>
</div>