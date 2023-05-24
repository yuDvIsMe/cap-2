<?php
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT * from `question` where id = '{$_GET['id']}' ");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_assoc() as $k => $v) {
            $$k = $v;
        }
    }
}
?>

<div class="col-lg-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title"><?php echo isset($id) ? "Cập nhật " : "Tạo " ?> câu hỏi</h3>
        </div>
        <div class="card-body">
            <form action="" id="manage-quiz">
                <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
                <div class="form-group">
                    <label for="content" class="control-label">Câu hỏi</label>
                    <input type="text" class="form-control form-control-sm" name="content" id="content" value="<?php echo isset($content) ? $content : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="" class="control-label">Ảnh</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input rounded-circle" id="customFile" name="content_img" onchange="displayImg(this,$(this))">
                        <label class="custom-file-label" for="customFile">Chọn tệp</label>
                    </div>
                </div>
                <div class="form-group col-6 d-flex justify-content-center">
                    <img src="<?php echo validate_image(isset($content_img) ? $content_img : '') ?>" alt="" id="cimg" class="img-fluid img-thumbnail">
                </div>
                <div class="form-group">
                    <label for="option_A" class="control-label">Đáp án A</label>
                    <input type="text" class="form-control form-control-sm" name="option_A" id="option_A" value="<?php echo isset($option_A) ? $option_A : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="option_B" class="control-label">Đáp án B</label>
                    <input type="text" class="form-control form-control-sm" name="option_B" id="option_B" value="<?php echo isset($option_B) ? $option_B : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="option_C" class="control-label">Đáp án C</label>
                    <input type="text" class="form-control form-control-sm" name="option_C" id="option_C" value="<?php echo isset($option_C) ? $option_C : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="option_D" class="control-label">Đáp án D</label>
                    <input type="text" class="form-control form-control-sm" name="option_D" id="option_D" value="<?php echo isset($option_D) ? $option_D : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="correct_option" class="control-label">Đáp án đúng</label>
                    <select name="correct_option" id="correct_option" class="custom-select"  required>
                        <option value="a" <?php echo (isset($correct_option) && $correct_option == 'a') ? 'selected' : '' ?>>A</option>
                        <option value="b" <?php echo (isset($correct_option) && $correct_option == 'b') ? 'selected' : '' ?>>B</option>
                        <option value="c" <?php echo (isset($correct_option) && $correct_option == 'c') ? 'selected' : '' ?>>C</option>
                        <option value="d" <?php echo (isset($correct_option) && $correct_option == 'd') ? 'selected' : '' ?>>D</option>
                    </select>
                </div>
                <input type="hidden" name="user_id" value="<?php echo isset($user_id) ? $user_id : $_settings->userdata('id') ?>">
        </div>
    </div>
    <div class="card-footer">
        <div class="col-md-12">
            <div class="row">
                <button class="btn btn-sm btn-primary mr-2" form="manage-quiz">Lưu</button>
                <a class="btn btn-sm btn-secondary" href="./?page=quiz">Hủy</a>
            </div>
        </div>
    </div>
</div>
<style>
    img#cimg {
        height: 50vh;
        width: 100%;
        object-fit: contain;
    }
</style>
<script>
    function displayImg(input, _this) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#cimg').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $(document).ready(function() {
        $('#manage-quiz').submit(function(e) {
            e.preventDefault();
            var _this = $(this)
            $('.err-msg').remove();
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=save_quiz",
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
                error: err => {
                    console.log(err)
                    alert_toast("Đã xảy ra lỗi gì đó", 'error');
                    end_loader();
                },
                success: function(resp) {
                    if (typeof resp == 'object' && resp.status == 'success') {
                        location.href = "./?page=quiz";
                    } else if (resp.status == 'failed' && !!resp.msg) {
                        var el = $('<div>')
                        el.addClass("alert alert-danger err-msg").text(resp.msg)
                        _this.prepend(el)
                        el.show('slow')
                        $("html, body").animate({
                            scrollTop: _this.closest('.card').offset().top
                        }, "fast");
                        end_loader()
                    } else {
                        alert_toast("Đã xảy ra lỗi gì đó", 'error');
                        end_loader();
                        console.log(resp)
                    }
                }
            })
        })

        $('.summernote').summernote({
            height: '30vh',
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ol', 'ul', 'paragraph', 'height']],
                ['view', ['undo', 'redo', 'fullscreen', 'codeview', 'help']]
            ]
        })
    })
</script>