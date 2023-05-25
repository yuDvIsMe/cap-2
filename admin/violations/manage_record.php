<?php
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT * from `violation_list` where id = '{$_GET['id']}' ");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_assoc() as $k => $v) {
            $$k = stripslashes($v);
        }
    }
}

function generateRandomString()
{
    $characters = '0123456789';
    $randomString = 'G';
    for ($i = 0; $i < 8; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
    return $randomString;
}

?>

<style>
    .uploaded_img {
        width: 150px;
        height: 135px;
        object-fit: scale-down;
        object-position: center center;
    }

    .img-panel {
        width: 170px;
    }
</style>
<div class="card card-outline card-info">
    <div class="card-header">
        <h3 class="card-title"><?php echo isset($id) ? "Cập nhật " : "Tạo " ?> biên bản vi phạm</h3>
    </div>
    <div class="card-body">
        <form name="violation-form-name" action="" id="violation-form">
            <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <lable class="control-label" for="date_created">Thời gian vi phạm</lable>
                        <input type="datetime-local" class="form-control" name="date_created" id="date_created" value="<?php echo isset($date_created) ? date("Y-m-d\\TH:i", strtotime($date_created)) : date("Y-m-d\\TH:i") ?>" required>
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="ticket_no" id="ticket_no" value="<?php echo isset($ticket_no) ? $ticket_no : generateRandomString() ?>" required>
                    </div>
                    <div class="form-group">
                        <lable class="control-label" for="driver_id">Người vi phạm</lable>
                        <select name="driver_id" id="driver_id" class="custom-select select2" required>
                            <option value=""></option>
                            <?php
                            $driver = $conn->query("SELECT * FROM `drivers_list` order by `name` asc ");
                            while ($row = $driver->fetch_assoc()) :
                            ?>
                                <option value="<?php echo $row['id'] ?>" <?php echo (isset($driver_id) && $driver_id == $row['id']) ? 'selected' : '' ?>>[<?php echo $row['license_id_no'] ?>] <?php echo ucwords($row['name']) ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <lable class="control-label" for="driver_email">Email người vi phạm</lable>
                        <input type="email" class="form-control" name="driver_email" id="driver_email" value="<?php echo isset($driver_email) ? $driver_email : '' ?>" required>
                        <p id="alert-email"></p>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <lable class="control-label" for="officer_id">ID người lập</lable>
                        <input type="text" class="form-control" name="officer_id" id="officer_id" value="<?php echo isset($officer_id) ? $officer_id : '' ?>" required>
                    </div>
                    <div class="form-group">
                        <lable class="control-label" for="officer_name">Người lập</lable>
                        <input type="text" class="form-control" name="officer_name" id="officer_name" value="<?php echo isset($officer_name) ? $officer_name : '' ?>" required>
                    </div>
                    <div class="form-group">
                        <lable class="control-label" for="status">Trạng thái</lable>
                        <input name="status" id="status" type="text" class="form-control form" readonly value="<?php echo (isset($status) && $status == '1') ? 'Đã thanh toán' : 'Chưa thanh toán'; ?>" />
                    </div>
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-6">
                    <h5 class='border-bottom border-light'><b>Danh sách vi phạm</b></h5>
                    <div class="row">
                        <!-- <div class="col-auto float-left">
                        <div class="form-group">
                            <lable class="control-label" for="violation_id">Lỗi</lable>
                        </div>
                    </div> -->
                        <div class="col-7">
                            <div class="form-group">
                                <select id="violation_id" class="custom-select select2">
                                    <option value=""></option>
                                    <?php
                                    $driver = $conn->query("SELECT * FROM `violations` order by `name` asc ");
                                    while ($row = $driver->fetch_assoc()) :
                                    ?>
                                        <option value="<?php echo $row['id'] ?>" data-code="<?php echo $row['code'] ?>" data-fine="<?php echo $row['fine'] ?>" data-name="<?php echo $row['name'] ?>"><?php echo "[" . $row['code'] . "]" . ucwords($row['name']) ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <button class='btn btn-flat btn-default bg-lightblue' type="button" id="add_to_list"><i class="fa fa-plus"></i> Thêm</button>
                            </div>
                        </div>
                        <div class="col-4"></div>
                    </div>
                    <table class="table table-stripped table-hover" id="fine-list">
                        <thead>
                            <tr>
                                <th>Mã vi phạm</th>
                                <th>Vi phạm</th>
                                <th class="text-right">Tiền phạt</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($id)) :
                                $olist = $conn->query("SELECT i.*,o.code,o.name FROM `violation_items` i inner join `violations` o on i.violation_id = o.id where i.driver_violation_id ='{$id}' ");
                                while ($row = $olist->fetch_assoc()) :
                            ?>
                                    <tr>
                                        <td><?php echo $row['code'] ?>
                                            <input type="hidden" name="violation_id[]" value="<?php echo $row['violation_id'] ?>">
                                            <input type="hidden" name="fine[]" value="<?php echo $row['fine'] ?>">
                                        </td>
                                        <td><?php echo $row['name'] ?></td>
                                        <td class="fine text-right"><?php echo number_format($row['fine']) ?></td>
                                        <td>
                                            <button class="btn  btn-sm btn-default text-danger" type="button" onclick="rem_item($(this))"><i class="fa fa-times"></i></button>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php endif; ?>
                            <?php if (!isset($id) || (isset($olist) && $olist->num_rows <= 0)) : ?>
                                <tr id='td-none'>
                                    <th colspan="4" class="text-center">Chưa thêm vi phạm</th>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Tổng cộng</th>
                                <th colspan="2" class="text-right" id="total_amount"><?php echo isset($total_amount) ? number_format($total_amount, 2) : '0' ?></th>
                                <th><input type="hidden" name="total_amount" value="<?php echo isset($total_amount) ? $total_amount : 0 ?>"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="remarks" class="control-label">Nhận xét</label>
                        <textarea name="remarks" id="remarks" class="form-control" cols="30" rows="3" ><?php echo isset($remarks) ? $remarks : '' ?></textarea>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer">
        <button class="btn btn-flat btn-primary" name="save_btn" form="violation-form">Lưu</button>
        <a class="btn btn-flat btn-default" href="?page=violations">Hủy</a>
    </div>
</div>
<script>

    // ----------------

    function rem_item(_this) {
        _this.closest('tr').remove()
        calculate_total();
    }

    function calculate_total() {
        var total = 0;
        $('#fine-list input[name="fine[]"]').each(function() {
            var fine = $(this).val()
            total += parseFloat(fine)
        })
        $('#total_amount').text(parseFloat(total).toLocaleString('en-US'))
        $('input[name="total_amount"]').val(parseFloat(total))
    }
    $(document).ready(function() {


        $('.select2').select2({
            placeholder: "Vui lòng chọn ở đây",
            width: "relative"
        })
        $('#add_to_list').click(function() {
            var violation_id = $('#violation_id').val();
            if (violation_id === '') {
                return; // Không thực hiện thêm hàng mới vào bảng
            }
            var fine = $('#violation_id option[value="' + violation_id + '"]').attr('data-fine');
            var violation = $('#violation_id option[value="' + violation_id + '"]').attr('data-name');
            var code = $('#violation_id option[value="' + violation_id + '"]').attr('data-code');
            var tr = $("<tr>");
            tr.append('<td>' + code + '<input type="hidden" name="violation_id[]" value="' + violation_id + '"><input type="hidden" name="fine[]" value="' + fine + '"></td>');
            tr.append('<td>' + violation + '</td>');
            tr.append('<td class="text-right">' + (parseFloat(fine).toLocaleString('en-US')) + '</td>');
            tr.append('<td><button class="btn btn-sm btn-default text-danger" type="button" onclick="rem_item($(this))"><i class="fa fa-times"></i></button></td>');
            $('#fine-list tbody').append(tr);
            if ($('#td-none').length > 0) {
                $('#td-none').remove();
            }
            calculate_total();
            $('#violation_id').val('').trigger('change');
        });

        $('#violation-form').submit(function(e) {
            e.preventDefault();
            var _this = $(this)
            $('.err-msg').remove();
            start_loader();
            if ($('[name="violation_id[]"]').length <= 0) {
                alert_toast('Vui lòng thêm một vi phạm vào biên bản', 'warning')
                end_loader();
                return false;
            }
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=save_violation_record",
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
                        end_loader();
                        uni_modal("<i class='fa fa-ticket'></i> Thông tin biên bản vi phạm giao thông", "violations/view_details.php?id=" + resp.id, 'mid-large')
                        setTimeout(() => {
                            end_loader();
                        }, 500);
                        $('#uni_modal').on('hide.bs.modal', function(e) {
                            location.href = "./?page=violations";
                        })
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

    })
</script>