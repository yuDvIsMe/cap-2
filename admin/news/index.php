<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title font-weight-bold">Danh sách bài viết</h3>
		<div class="card-tools">
			<a href="?page=news/manage_news" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Tạo mới</a>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-bordered table-stripped table-hover">
				<colgroup>
					<col width="5%">
					<col width="10%">
					<col width="25%">
					<col width="15%">
					<col width="35%">
					<col width="10%">
				</colgroup>
				<thead>
					<tr class="text-center">
						<th>STT</th>
						<th>Ngày đăng</th>
						<th>Tiêu đề</th>
						<th>Ảnh</th>
						<th>Chi tiết</th>
						<th>Thao tác</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
						$qry = $conn->query("SELECT * from `news_list` order by unix_timestamp(post_date) desc ");
						while($row = $qry->fetch_assoc()):
					?>
						<tr>
							<td  class="text-center"><?php echo $i++; ?></td>
							<td><?php echo date("Y-m-d H:i",strtotime($row['post_date'])) ?></td>
							<td><?php echo $row['title'] ?></td>
							<td><img src="<?php echo validate_image($row['image']) ?>" class="img-avatar img-thumbnail p-0 border-2" alt="news_image"></td>
							<td><p class="truncate m-0"><?php echo $row['content'] ?></p></td>
							<td align="center">
								 <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
				                  		Chỉnh sửa
				                    <span class="sr-only">Toggle Dropdown</span>
				                  </button>
				                  <div class="dropdown-menu" role="menu">
				                    <a class="dropdown-item" href="?page=news/manage_news&id=<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Cập nhật</a>
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
			_conf("Bạn có chắc chắn muốn xóa thông tin này không?","delete_news",[$(this).attr('data-id')])
		})
		$('.table').dataTable({
			columnDefs: [
				{ orderable: false, targets: [3,4] }
			]
		});
	})
	function delete_news($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_news",
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