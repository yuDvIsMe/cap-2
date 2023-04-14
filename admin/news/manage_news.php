<?php
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `news_list` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
?>

<div class="col-lg-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title"><?php echo isset($id) ? "Cập nhật " : "Tạo " ?> bài viết</h3>
        </div>
        <div class="card-body">
            <form action="" id="manage-news">
                <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
                <div class="form-group">
                    <label for="title" class="control-label">Tiêu đề</label>
                    <input type="text" class="form-control form-control-sm" name="title" id="title" value="<?php echo isset($title) ? $title : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="" class="control-label">Ảnh bìa</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input rounded-circle" id="customFile" name="image" onchange="displayImg(this,$(this))">
                        <label class="custom-file-label" for="customFile">Chọn tệp</label>
                    </div>
                </div>
                <div class="form-group col-6 d-flex justify-content-center">
                    <img src="<?php echo validate_image(isset($meta['image']) ? $meta['image'] : '') ?>" alt="" id="cimg" class="img-fluid img-thumbnail">
                </div>
                <div class="form-group">
                    <label for="content" class="control-label">Nội dung</label>
                    <textarea name="content" id="" cols="30" rows="2" class="form-control form no-resize summernote"><?php echo isset($content) ? $content : ''; ?></textarea>
                </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="col-md-12">
            <div class="row">
                <button class="btn btn-sm btn-primary mr-2" form="manage-news">Lưu</button>
                <a class="btn btn-sm btn-secondary" href="./?page=news">Hủy</a>
            </div>
        </div>
    </div>
</div>
<style>
    img#cimg {
        height: 15vh;
        width: 15vh;
        object-fit: cover;
        border-radius: 100% 100%;
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
        $('#manage-news').submit(function(e) {
            e.preventDefault();
            var _this = $(this)
            $('.err-msg').remove();
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=save_news",
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
                        location.href = "./?page=news";
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