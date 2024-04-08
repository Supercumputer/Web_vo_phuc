
<div class="filter">
<div class="box_content pt-3 d-flex align-items-center justify-content-between">
    <div>
        <nav aria-label="breadcrumb" class="d-none d-md-block">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item">Library</li>
                <li class="breadcrumb-item active" aria-current="page">Data</li>
            </ol>
        </nav>
    </div>

</div>
</div>

<div class="box_content bbg-gr py-3">
    <div class="bgkj">
        <h1>Thông tin khách hàng</h1>
        <form class="row mt-3" action="index.php" method="post" id="form">
            <div class="col-lg-7 col-md-6">
                <div class="row g-3 mb-3">
                    <div class="col-lg-6">
                        <label for="inputEmail4" class="form-label">Họ và tên</label>
                        <input type="text" class="form-control" name="full_name" value="<?= $_SESSION['user']['full_name'] ?? $full_name?>">
                        <span style="color: red;"><?= $errors['full_name'] ?? ""?></span>
                    </div>
                    <div class="col-lg-6">
                        <label for="inputPassword4" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="<?= $_SESSION['user']['email'] ?? $email?>">
                        <span style="color: red;"><?= $errors['email'] ?? ""?></span>
                    </div>
                    <div class="col-12">
                        <label for="inputAddress2" class="form-label">Số điện thoại</label>
                        <input type="text" class="form-control" name="phone" value="<?= $_SESSION['user']['phone'] ?? $phone?>">
                        <span style="color: red;"><?= $errors['phone'] ?? ""?></span>
                    </div>
                    <div class="col-12">
                        <label for="inputAddress" class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" value="<?= $_SESSION['user']['address'] ?? $address?>">
                        <span style="color: red;"><?= $errors['address'] ?? ""?></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-6">
                <div class="box_infor_money">
                    <h2 class="hdd">Hóa đơn</h2>
                    <div class="d-flex flex-column gap-3">
                        <div class="luka d-flex justify-content-between align-items-center">
                            <p>Giá tạm thời</p>
                            <p><?= number_format($total_price, 0, "", ".")?> VNĐ</p>
                        </div>
                        <div class="luka d-flex justify-content-between align-items-center">
                            <p>Phí vận chuyển</p>
                            <p>34.000 VNĐ</p>
                        </div>
                        <div class="luka d-flex justify-content-between align-items-center">
                            <p>Voucher</p>
                            <?php echo isset($voucher) ? "<p>".$sale."</p>" : '<p><a class="likmm"></a><input type="text" name="voucher"></p>'?>
                            <input type="hidden" name="voucher_code" value="<?= $voucher?>">
                        </div>

                        <div class="luka d-flex justify-content-between align-items-center">
                            <p>Tổng tiền</p>
                            <p><?= number_format($payment, 0, "", ".")?> VNĐ</p>
                        </div>
                        <input type="hidden" name="total_price" value="<?= $total_price?>">
                        <input type="hidden" name="payment" value="<?= $payment?>">
                        <input type="hidden" name="sale" value="<?= $sale?>">

                        <div class="luka d-flex justify-content-between align-items-center">
                            <p>Hình thức thanh toán</p>
                        </div>
                        <div class="ck_onl d-flex align-items-center">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="thanhtoan" id="inlineRadio1" value="vnpay">
                                <label class="form-check-label" for="inlineRadio1">Vn Pay</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="thanhtoan" id="inlineRadio2" value="knh" checked>
                                <label class="form-check-label" for="inlineRadio2">Thanh toán khi nhận hàng</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <button type="submit" name="redirect" class="btn btn-danger col-12">Thanh Toán</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

</div>
<script>
    let list = document.querySelector('input[name=voucher]');
    let link = document.querySelector('.likmm');
    let totalPrice = <?= $total_price ?>; 
   
    list.addEventListener('change', function (e) {
        link.href = `index.php?total_price=${totalPrice}&voucher=${e.target.value}`;
        link.click();
    });

    $(document).ready(function() {
    $("#form").validate({
        onfocusout: false,
        onkeyup: false,
        onclick: false,
        rules: {
            "full_name": {
                required: true,
                maxlength: 50
            },
            
            "email": {
                required: true,
                email: true
            },

            "phone": {
                required: true,
                minlength: 8
            },
            
            "address": {
                required: true,
                minlength: 8
            }
           
        },
        messages: {
            "full_name": {
                required: "Vui lòng nhập tên đầy đủ của bạn.",
                maxlength: "Tên của bạn không được vượt quá 50 ký tự."
            },
            
            "email": {
                required: "Vui lòng nhập địa chỉ email.",
                email: "Vui lòng nhập địa chỉ email hợp lệ."
            },

            "phone": {
                required: "Vui lòng nhập số điện thoại.",
                minlength: "Số điện thoại phải có ít nhất 8 ký tự."
            },
            
            "address": {
                required: "Vui lòng nhập địa chỉ.",
                minlength: "Địa chỉ phải có ít nhất 8 ký tự."
            }
        }
    });
});
</script>