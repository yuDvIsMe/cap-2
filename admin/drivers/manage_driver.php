<?php
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `drivers_list` where id = '{$_GET['id']}' ");
    $qry2 = $conn->query("SELECT * from `drivers_meta` where driver_id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
	if($qry2->num_rows > 0){
        while($row = $qry2->fetch_assoc()){
            	${$row['meta_field']}=$row['meta_value'];
        }
    }
}
?>

<style>
	img#cimg{
		height: 25vh;
		width: 15vw;
		object-fit: scale-down;
		object-position: center center;
	}
</style>
<div class="card card-outline card-info">
	<div class="card-header">
		<h3 class="card-title"><?php echo isset($id) ? "Cập nhật ": "Tạo " ?> thông tin người vi phạm</h3>
	</div>
	<div class="card-body">
		<form action="" id="driver-form">
			<input type="hidden" name ="id" value="<?php echo isset($id) ? $id : '' ?>">
			<div class="row">
				<div class="col-6">
					<div class="form-group">
						<label for="license_id_no" class="control-label">Số GPLX</label>
						<input type="text" maxlength="50" class="form-control form" required name="license_id_no" value="<?php echo isset($license_id_no) ? $license_id_no : '' ?>">
					</div>
					<div class="form-group">
						<label for="name" class="control-label">Họ và tên</label>
						<input type="text" class="form-control form" required name="name" value="<?php echo isset($name) ? $name : '' ?>">
					</div>
					<div class="form-group">
						<label for="dob" class="control-label">Ngày sinh</label>
						<input type="date" class="form-control form" required name="dob" value="<?php echo isset($dob) ? date("Y-m-d",strtotime($dob)) : '' ?>">
					</div>
					<div class="form-group">
						<label for="permanent_address" class="control-label">Địa chỉ thường trú</label>
						<textarea rows="3" class="form-control" style="resize:none" required name="permanent_address"><?php echo isset($permanent_address) ? $permanent_address : '' ?></textarea>
					</div>
				</div>
				<div class="col-6">
					<div class="form-group">
						<label for="nationality" class="control-label">Quốc tịch</label>
						<input type="text" class="form-control form" required name="nationality" value="<?php echo isset($nationality) ? $nationality : '' ?>">
					</div>
					<div class="form-group">
						<label for="contact" class="control-label">Số điện thoại</label>
						<input type="text" maxlength="13" class="form-control form" required name="contact" value="<?php echo isset($contact) ? $contact : '' ?>">
					</div>
					<div class="form-group">
						<label for="license_type" class="control-label">Loại bằng</label>
						<select name="license_type" id="license_type" class="custom-select select2">
							<option <?php echo (isset($license_type) && $license_type == 'A1') ? 'selected' : '' ?>>A1</option>
							<option <?php echo (isset($license_type) && $license_type == 'A2') ? 'selected' : '' ?>>A2</option>
							<option <?php echo (isset($license_type) && $license_type == 'A3') ? 'selected' : '' ?>>A3</option>
							<option <?php echo (isset($license_type) && $license_type == 'A4') ? 'selected' : '' ?>>A4</option>
							<option <?php echo (isset($license_type) && $license_type == 'B1') ? 'selected' : '' ?>>B1</option>
							<option <?php echo (isset($license_type) && $license_type == 'B2') ? 'selected' : '' ?>>B2</option>
							<option <?php echo (isset($license_type) && $license_type == 'C') ? 'selected' : '' ?>>C</option>
							<option <?php echo (isset($license_type) && $license_type == 'D') ? 'selected' : '' ?>>D</option>
							<option <?php echo (isset($license_type) && $license_type == 'FB2') ? 'selected' : '' ?>>FB2</option>
							<option <?php echo (isset($license_type) && $license_type == 'FC') ? 'selected' : '' ?>>FC</option>
							<option <?php echo (isset($license_type) && $license_type == 'FD') ? 'selected' : '' ?>>FD</option>
							<option <?php echo (isset($license_type) && $license_type == 'FE') ? 'selected' : '' ?>>FE</option>
						</select>
					</div>
					<div class="form-group">
						<label for="" class="control-label">Hình ảnh</label>
						<div class="custom-file">
						<input type="hidden" name="image_path" value="<?php echo isset($image_path) ? $image_path : '' ?>">
						<input type="file" class="custom-file-input rounded-circle" id="customFile" name="img" onchange="displayImg(this,$(this))">
						<label class="custom-file-label" for="customFile">Chọn tệp</label>
						</div>
					</div>
					<div class="form-group d-flex justify-content-center">
						<img align="center" src="<?php echo validate_image(isset($image_path) ? $image_path : '') ?>" alt="" id="cimg" class="img-fluid img-thumbnail">
					</div>
				</div>
			</div>
			
		</form>
	</div>
	<div class="card-footer">
		<button class="btn btn-flat btn-primary" form="driver-form">Lưu</button>
		<a class="btn btn-flat btn-default" href="?page=drivers">Hủy</a>
	</div>
</div>
<script>
	function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        	_this.siblings('.custom-file-label').html(input.files[0].name)
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
	$(document).ready(function(){
		$('#driver-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_driver",
				data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
				error:err=>{
					console.log(err)
					alert_toast("Đã xảy ra lỗi gì đó",'error');
					end_loader();
				},
				success:function(resp){
					if(typeof resp =='object' && resp.status == 'success'){
						location.href = "./?page=drivers";
					}else if(resp.status == 'failed' && !!resp.msg){
                        var el = $('<div>')
                            el.addClass("alert alert-danger err-msg").text(resp.msg)
                            _this.prepend(el)
                            el.show('slow')
                            $("html, body").animate({ scrollTop: _this.closest('.card').offset().top }, "fast");
                            end_loader()
                    }else{
						alert_toast("Đã xảy ra lỗi gì đó",'error');
						end_loader();
                        console.log(resp)
					}
				}
			})
		})
	})
</script>