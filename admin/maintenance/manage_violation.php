<?php
if (isset($_GET['id']) && $_GET['id'] > 0) {
	$qry = $conn->query("SELECT * from `violations` where id = '{$_GET['id']}' ");
	if ($qry->num_rows > 0) {
		foreach ($qry->fetch_assoc() as $k => $v) {
			$$k = $v;
		}
	}
}
?>
<div class="card card-outline card-info">
	<div class="card-header">
		<h3 class="card-title"><?php echo isset($id) ? "Cập nhật " : "Tạo " ?> vi phạm</h3>
	</div>
	<div class="card-body">
		<form action="" id="violation-form">
			<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
			<div class="form-group col-6">
				<label for="code" class="control-label">Mã vi phạm</label>
				<input name="code" id="code" maxlength="20" type="text" class="form-control form" value="<?php echo isset($code) ? $code : ''; ?>" />
			</div>
			<div class="form-group col-6">
				<label for="name" class="control-label">Tên vi phạm</label>
				<input name="name" id="name" type="text" class="form-control form" value="<?php echo isset($name) ? $name : ''; ?>" />
			</div>
			<div class="form-group col-6">
				<label for="rate" class="control-label">Mức phạt</label>
				<input type="text" oninput="calculateFine(),validate()" min=0 id="min_fine" name="min_fine" maxlength="15" size="15" value="<?php echo isset($min_fine) ? $min_fine : ''; ?>">
				-
				<input type="text" oninput="calculateFine(),validate()" min=0 id="max_fine" name="max_fine" maxlength="15" size="15" value="<?php echo isset($max_fine) ? $max_fine : ''; ?>">
			</div>
			<div class="form-group col-6">
				<p id="action-text" class="text-danger"></p>
			</div>
			<div class="form-group col-6">
				<label for="fine" class="control-label">Tiền phạt</label>
				<input name="fine" id="fine" maxlength="20" type="text" class="form-control form" readonly value="<?php echo isset($fine) ? $fine : ''; ?>" />
			</div>
			<div class="form-group col-4">
				<label for="law_id" class="control-label">Nhóm lỗi</label>
				<select name="law_id" id="law_id" class="custom-select selevt">
					<?php
					$qry = $conn->query("SELECT * FROM `traffic_law`");
					while ($row = $qry->fetch_assoc()) {
						$selected = isset($law_id) && $law_id == $row['id'] ? 'selected' : '';
						echo '<option value="' . $row['id'] . '" ' . $selected . '>' . $row['law_name'] . ' (' . $row['type'] . ')</option>';
					}
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="description" class="control-label">Mô tả</label>
				<textarea name="description" id="" cols="30" rows="2" class="form-control form no-resize summernote"><?php echo isset($description) ? $description : ''; ?></textarea>
			</div>
			<div class="form-group col-4">
				<label for="status" class="control-label">Trạng thái</label>
				<select name="status" id="status" class="custom-select selevt">
					<option value="1" <?php echo isset($status) && $status == 1 ? 'selected' : '' ?>>Khả dụng</option>
					<option value="0" <?php echo isset($status) && $status == 0 ? 'selected' : '' ?>>Không khả dụng</option>
				</select>
			</div>

		</form>
	</div>
	<div class="card-footer">
		<button class="btn btn-flat btn-primary" form="violation-form">Lưu</button>
		<a class="btn btn-flat btn-default" href="?page=maintenance/violations">Huỷ</a>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('#violation-form').submit(function(e) {
			e.preventDefault();
			var _this = $(this)
			$('.err-msg').remove();
			start_loader();
			$.ajax({
				url: _base_url_ + "classes/Master.php?f=save_violation",
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
						location.href = "./?page=maintenance/violations";
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

	function calculateFine() {
		// Lấy giá trị từ các ô max_fine và min_fine
		var maxFine = parseFloat(document.getElementById('max_fine').value) || 0;
		var minFine = parseFloat(document.getElementById('min_fine').value) || 0;

		// Tính toán giá trị trung bình và gán vào ô fine
		var fine = (maxFine + minFine) / 2;
		document.getElementById('fine').value = fine;
	}

	function validate() {
		var min_fine = document.getElementById('min_fine').value;
		var max_fine = document.getElementById('max_fine').value;

		if (min_fine !== '' && max_fine !== '') {
			if (parseInt(min_fine) >= parseInt(max_fine)) {
				document.getElementById('action-text').innerHTML = 'Số trước không được lớn hơn số sau';
			} else
				document.getElementById('action-text').innerHTML = '';
		}
	}
</script>