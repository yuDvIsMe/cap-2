<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">Danh sách các lỗi vi phạm</h3>
		<?php if($_settings->userdata('type') == 1): ?>
		<div class="card-tools">
			<a href="?page=maintenance/manage_violation" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Tạo mới</a>
		</div>
		<?php endif; ?>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-bordered table-stripped table-hover">
			<?php if($_settings->userdata('type') == 1): ?>
				<colgroup>
					<col width="5%">
					<col width="15%">
					<col width="20%">
					<col width="25%">
					<col width="10%">
					<col width="10%">
					<col width="15%">
				</colgroup>
			<?php else: ?>
				<colgroup>
					<col width="10%">
					<col width="15%">
					<col width="25%">
					<col width="30%">
					<col width="10%">
					<col width="10%">
				</colgroup>
			<?php endif; ?>
				<thead>
					<tr class="text-center">
						<th>ID</th>
						<th>Ngày tạo</th>
						<th>Tên</th>
						<th>Mô tả</th>
						<th>Tiền phạt</th>
						<th>Trạng thái</th>
						<?php if($_settings->userdata('type') == 1): ?>
						<th>Thao tác</th>
						<?php endif; ?>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
						$qry = $conn->query("SELECT * from `violations` order by unix_timestamp(date_created) desc ");
						while($row = $qry->fetch_assoc()):
                            $row['description'] = strip_tags(stripslashes(html_entity_decode($row['description'])));
					?>
						<tr class="text-center" title="<?php echo $row['description'] ?>">
							<td><?php echo $i++; ?></td>
							<td><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td>
							<td><?php echo '['.$row['code'].'] - '.$row['name'] ?></td>
							<td><p class="truncate m-0"><?php echo $row['description'] ?></p></td>
							<td><?php echo number_format($row['fine'],2) ?></td>
							<td class="text-center">
                                <?php if($row['status'] == 1): ?>
                                    <span class="badge badge-success">Khả dụng</span>
                                <?php else: ?>
                                    <span class="badge badge-danger">Không khả dụng</span>
                                <?php endif; ?>
                            </td>
							<?php if($_settings->userdata('type') == 1): ?>
							<td align="center">
								 <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
				                  		Chỉnh sửa
				                    <span class="sr-only">Toggle Dropdown</span>
				                  </button>
				                  <div class="dropdown-menu" role="menu">
				                    <a class="dropdown-item" href="?page=maintenance/manage_violation&id=<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Cập nhật</a>
				                    <div class="dropdown-divider"></div>
				                    <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Xóa</a>
				                  </div>
							</td>
							<?php endif; ?>
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
			_conf("Bạn có chắc chăn muốn xóa vi phạm này?","delete_violation",[$(this).attr('data-id')])
		})
		$('.table').dataTable();
	})
	function delete_violation($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_violation",
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