<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">List of Drivers</h3>
		<div class="card-tools">
			<a href="?page=drivers/manage_driver" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Tạo mới</a>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-hover table-stripped">
				<colgroup>
					<col width="10%">
					<col width="25%">
					<col width="25%">
					<col width="20%">
					<col width="20%">
				</colgroup>
				<thead>
					<tr>
						<th>ID</th>
						<th>Số GPLX</th>
						<th>Tên</th>
						<th>Loại bằng lái</th>
						<th>Thao tác</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
						$qry = $conn->query("SELECT * from `drivers_list` order by unix_timestamp(date_created) desc ");
						while($row = $qry->fetch_assoc()):
							$lt_qry = $conn->query("SELECT meta_value FROM `drivers_meta` where driver_id = '{$row['id']}' and meta_field = 'license_type' ");
							$row['license_type'] = ($lt_qry->num_rows > 0) ? $lt_qry->fetch_array()['meta_value'] : "N/A";
					?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td><?php echo $row['license_id_no'] ?></td>
							<td><span class="mr-2"><a href="javascript:void(0)" class="view_details badge badge-dark text-light" data-id="<?php echo $row['id'] ?>"> <i class="fa fa-eye"></i></a></span> <?php echo $row['name'] ?></td>
							<td><?php echo $row['license_type'] ?></td>
							<td>
								 <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
				                  		Chỉnh sửa
				                    <span class="sr-only">Toggle Dropdown</span>
				                  </button>
				                  <div class="dropdown-menu" role="menu">
				                    <a class="dropdown-item" href="?page=drivers/manage_driver&id=<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Cập nhật</a>
				                    <div class="dropdown-divider"></div>
				                    <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Xóa</a>
				                  </div>
							</td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.delete_data').click(function(){
			_conf("Bạn có chắc chắn muốn xóa thông tin này không?","delete_driver",[$(this).attr('data-id')])
		})
		$('.view_details').click(function(){
			uni_modal("<i class='fa fa-id-card'></i><b>Thông tin người vi phạm</b>","drivers/view_details.php?id="+$(this).attr('data-id'),'large')
		})
		$('.table').dataTable({
			columnDefs: [
				{ orderable: false, targets: [3,4] }
			]
		});
	})
	function delete_driver($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_driver",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("Đã xảy ra lỗi gì đó.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("Đã xảy ra lỗi gì đó.",'error');
					end_loader();
				}
			}
		})
	}
</script>