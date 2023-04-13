<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title font-weight-bold">Danh sách biên bản vi phạm</h3>
		<div class="card-tools">
			<a href="?page=violations/manage_record" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Tạo mới</a>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-hover table-stripped">
				<colgroup>
					<col width="5%">
					<col width="25%">
					<col width="15%">
					<col width="15%">
					<col width="20%">
					<col width="15%">
					<col width="5%">
				</colgroup>
				<thead>
					<tr>
						<th>ID</th>
						<th>Thời gian</th>
						<th>Số QĐXP</th>
						<th>Biển số</th>
						<th>Người lập</th>
						<th>Trạng thái</th>
						<th>Thao tác</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
						$qry = $conn->query("SELECT r.*,d.license_id_no FROM `violation_list` r inner join `drivers_list` d on r.driver_id = d.id order by unix_timestamp(r.date_created) desc ");
						while($row = $qry->fetch_assoc()):
					?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td><?php echo date("Y-m-d H:i A",strtotime($row['date_created'])) ?></td>
							<td><a href="javascript:void(0)" class="view_details" data-id="<?php echo $row['id'] ?>"><?php echo $row['ticket_no'] ?></a></td>
							<td><?php echo $row['license_id_no'] ?></td>
							<td><?php echo $row['officer_name'] ?></td>
							<td>
                                <?php if($row['status'] == 1): ?>
                                    <span class="badge badge-success">Đã thanh toán</span>
                                <?php else: ?>
                                    <span class="badge badge-secondary">Chưa thanh toán</span>
                                <?php endif; ?>
                            </td>
							<td align="center">
								 <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
				                  		Chỉnh sửa
				                    <span class="sr-only">Toggle Dropdown</span>
				                  </button>
				                  <div class="dropdown-menu" role="menu">
				                    <a class="dropdown-item" href="?page=violations/manage_record&id=<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Chỉnh sửa</a>
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
			_conf("Bạn có chắc chắn muốn xóa biên bản này không?","delete_violation",[$(this).attr('data-id')])
		})
		$('.view_details').click(function(){
			uni_modal("<i class='fa fa-ticket'></i><b> Thông tin cụ thể biên bản xử phạt</b>","violations/view_details.php?id="+$(this).attr('data-id'),'mid-large')
		})
		$('.table').dataTable({
			columnDefs:[{ orderable: false, targets: [5,6] }]
		});
	})
	function delete_violation($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_violation_record",
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