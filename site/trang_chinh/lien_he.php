

<div class="box_content py-3">
    <iframe
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7446.828176655126!2d105.72645661228769!3d21.056117322076254!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313454570374c5e3%3A0xdeb4689fca01b0ff!2zTmjhu5VuLCBNaW5oIEtoYWksIFThu6sgTGnDqm0sIEjDoCBO4buZaSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1710605752119!5m2!1svi!2s"
    height="300" style="border:0;width: 100%;" allowfullscreen="" loading="lazy"
    referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>

<div class="box_content py-2">
    <div class="row">
        <div class="col-xl-6">
            <h4>Liên hệ với chúng tôi</h4>
            <p class="gt_text">Trụ sở chính: 180 – 182 Lý Chính Thắng, Phường 9, Quận 3, TP Hồ Chí Minh
                Chi nhánh: Tầng 4, số 01 ngõ 120 Trường Chinh, Thanh Xuân , Hà Nội</p>
            <p class="gt_text">Hotline: (024) 9865 7868 &&
                (028) 9885 6845</p>
            <p class="gt_text">Email: vothuat@gmail.com &&
                vothuatdemo@gmail.com</p><br>
        </div>
        <div class="col-xl-6 gap-2">
            <form action="index.php?lien_he" method="post" id="form">
                <div class="mb-3">
                    <input type="text" class="form-control" name="full_name" placeholder="Họ và tên...">
                </div>

                <div class="mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Email liên hệ...">
                </div>

                <div class="mb-3">
                    <input type="text" class="form-control" name="phone" placeholder="Số điện thoại...">
                </div>

                <div class="mb-3">
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Nội dung liên hệ..." name="message"></textarea>
                </div>

                <button type="submit" class="btn btn-danger mb-2">Gửi liên hệ</button>
            </form>
        </div>

    </div>
</div>


<script>
    
    $(document).ready(function() {
    $("#form").validate({
        onfocusout: false,
        onkeyup: false,
        onclick: false,
        rules: {
            "full_name": {
                required: true,
                maxlength: 15
            },
            
            "email": {
                required: true,
                email: true
            },

            "phone": {
                required: true,
                minlength: 10
            },
            
            "message": {
                required: true,
            }
           
        },
        messages: {
            "full_name": {
                required: "Vui lòng nhập tên của bạn.",
                maxlength: "Tên người nhận không được vượt quá 15 ký tự."
            },
            
            "email": {
                required: "Vui lòng nhập địa chỉ email.",
                email: "Vui lòng nhập địa chỉ email hợp lệ."
            },

            "phone": {
                required: "Vui lòng nhập số điện thoại.",
                minlength: "Số điện thoại phải có ít nhất 10 ký tự."
            },
            
            "message": {
                required: "Vui lòng nhập nội dung bạn muốn gửi.",
            }
        }
    });
});
</script>
