<?php
require_once('../config.php');
class Master extends DBConnection
{
	private $settings;
	private $permitted_chars;
	public function __construct()
	{
		global $_settings;
		$this->settings = $_settings;
		$this->permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		parent::__construct();
	}
	public function __destruct()
	{
		parent::__destruct();
	}
	function capture_err()
	{
		if (!$this->conn->error)
			return false;
		else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
			return json_encode($resp);
			exit;
		}
	}
	function save_violation()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'description'))) {
				if (!empty($data)) $data .= ",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if (isset($_POST['description'])) {
			if (!empty($data)) $data .= ",";
			$data .= " `description`='" . addslashes(htmlentities($description)) . "' ";
		}
		$check = $this->conn->query("SELECT * FROM `violations` where `code` = '{$code}' " . (!empty($id) ? " and id != {$id} " : "") . " ")->num_rows;
		if ($this->capture_err())
			return $this->capture_err();
		if ($check > 0) {
			$resp['status'] = 'failed';
			$resp['msg'] = "Mã vi phạm trùng lặp";
			return json_encode($resp);
			exit;
		}
		if (empty($id)) {
			$sql = "INSERT INTO `violations` set {$data} ";
			$save = $this->conn->query($sql);
		} else {
			$sql = "UPDATE `violations` set {$data} where id = '{$id}' ";
			$save = $this->conn->query($sql);
		}
		if ($save) {
			$resp['status'] = 'success';
			if (empty($id))
				$this->settings->set_flashdata('success', "Tạo mới thành công");
			else
				$this->settings->set_flashdata('success', "Cập nhật thành công");
		} else {
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error . "[{$sql}]";
		}
		return json_encode($resp);
	}
	function delete_violation()
	{
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `violations` where id = '{$id}'");
		if ($del) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', "Xóa thành công");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function generate_string($input, $strength = 10)
	{

		$input_length = strlen($input);
		$random_string = '';
		for ($i = 0; $i < $strength; $i++) {
			$random_character = $input[mt_rand(0, $input_length - 1)];
			$random_string .= $random_character;
		}

		return $random_string;
	}
	function upload_files()
	{
		extract($_POST);
		$data = "";
		if (empty($upload_code)) {
			while (true) {
				$code = $this->generate_string($this->permitted_chars);
				$chk = $this->conn->query("SELECT * FROM `uploads` where dir_code ='{$code}' ")->num_rows;
				if ($chk <= 0) {
					$upload_code = $code;
					$resp['upload_code'] = $upload_code;
					break;
				}
			}
		}

		if (!is_dir(base_app . 'uploads/blog_uploads/' . $upload_code))
			mkdir(base_app . 'uploads/blog_uploads/' . $upload_code);
		$dir = 'uploads/blog_uploads/' . $upload_code . '/';
		$images = array();
		for ($i = 0; $i < count($_FILES['img']['tmp_name']); $i++) {
			if (!empty($_FILES['img']['tmp_name'][$i])) {
				$fname = $dir . (time()) . '_' . $_FILES['img']['name'][$i];
				$f = 0;
				while (true) {
					$f++;
					if (is_file(base_app . $fname)) {
						$fname = $f . "_" . $fname;
					} else {
						break;
					}
				}
				$move = move_uploaded_file($_FILES['img']['tmp_name'][$i], base_app . $fname);
				if ($move) {
					$this->conn->query("INSERT INTO `uploads` (dir_code,user_id,file_path)VALUES('{$upload_code}','{$this->settings->userdata('id')}','{$fname}')");
					$this->capture_err();
					$images[] = $fname;
				}
			}
		}
		$resp['images'] = $images;
		$resp['status'] = 'success';
		return json_encode($resp);
	}
	function save_driver()
	{
		foreach ($_POST as $k => $v) {
			$_POST[$k] = addslashes($v);
		}
		extract($_POST);
		$chk = $this->conn->query("SELECT * FROM `drivers_list` where  license_id_no = '{$license_id_no}' " . ($id > 0 ? " and id!= '{$id}' " : ""))->num_rows;
		$this->capture_err();
		if ($chk > 0) {
			$resp['status'] = 'failed';
			$resp['msg'] = "Số GPLX này đã có trong hệ thống, vui lòng kiểm tra lại.";
			return json_encode($resp);
			exit;
		}
		if (empty($id))
			$sql1 = "INSERT INTO `drivers_list` set `name` = '{$name}', license_id_no = '{$license_id_no}' ";
		else
			$sql1 = "UPDATE `drivers_list` set `name` = '{$name}', license_id_no = '{$license_id_no}' where id = '{$id}' ";

		$save1 = $this->conn->query($sql1);
		$this->capture_err();
		$driver_id = empty($id) ? $this->conn->insert_id : $id;
		$this->conn->query("DELETE FROM `drivers_meta` where driver_id = '{$driver_id}' ");
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id'))) {
				if (!empty($data)) $data .= ",";
				$v = addslashes($v);
				$data .= " ('{$driver_id}','{$k}','{$v}') ";
			}
		}
		$data .= ",('{$driver_id}','driver_id','{$driver_id}')";


		$sql = "INSERT INTO `drivers_meta` (`driver_id`,`meta_field`,`meta_value`) VALUES {$data} ";
		$save = $this->conn->query($sql);
		$this->capture_err();
		if ($save) {
			$resp['status'] = 'success';
			if (empty($id))
				$this->settings->set_flashdata('success', "Người vi phạm mới đã được thêm vào hệ thống");
			else
				$this->settings->set_flashdata('success', "Cập nhật thông tin người vi phạm thành công.");
			$id = empty($id) ? $this->conn->insert_id : $id;
			$dir = 'uploads/drivers/';
			if (!is_dir(base_app . $dir))
				mkdir(base_app . $dir);
			if (isset($_FILES['img'])) {
				if (!empty($_FILES['img']['tmp_name'])) {
					$fname = $dir . $driver_id . "." . (pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION));
					$move =  move_uploaded_file($_FILES['img']['tmp_name'], base_app . $fname);
					if ($move) {
						$this->conn->query("INSERT INTO `drivers_meta` set `meta_value` = '{$fname}', driver_id = '{$driver_id}',`meta_field` = 'image_path' ");
						if (!empty($image_path) && is_file(base_app . $image_path))
							unlink(base_app . $image_path);
					}
				}
			}
		} else {
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error . "[{$sql}]";
		}
		return json_encode($resp);
	}
	function delete_driver()
	{
		extract($_POST);
		$qry = $this->conn->query("SELECT * FROM `drivers_meta` where driver_id = '{$id}'");
		while ($row = $qry->fetch_assoc()) {
			${$row['meta_field']} = $row['meta_value'];
		}
		$del = $this->conn->query("DELETE FROM `drivers_list` where id = '{$id}'");
		$this->capture_err();
		if ($del) {
			$resp['status'] = 'success';
			if (is_file(base_app . $image_path))
				unlink((base_app . $image_path));
			$this->settings->set_flashdata('success', "Xóa thông tin người vi phạm thành công");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function delete_img()
	{
		extract($_POST);
		if (is_file(base_app . $path)) {
			if (unlink(base_app . $path)) {
				$del = $this->conn->query("DELETE FROM `uploads` where file_path = '{$path}'");
				$resp['status'] = 'success';
			} else {
				$resp['status'] = 'failed';
				$resp['error'] = 'failed to delete ' . $path;
			}
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = 'Unkown ' . $path . ' path';
		}
		return json_encode($resp);
	}
	function save_violation_record()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'fine', 'violation_id'))) {
				$v = addslashes($v);
				if (!empty($data)) $data .= ",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		$chk = $this->conn->query("SELECT * FROM `violation_list` where  ticket_no = '{$ticket_no}' " . (($id > 0) ? " and id!= '{$id}' " : ""))->num_rows;
		$this->capture_err();
		if ($chk > 0) {
			$resp['status'] = 'failed';
			$resp['msg'] = "violation Ticker No. already exist in the database. Please review and try again.";
			return json_encode($resp);
			exit;
		}

		if (empty($id)) {
			$sql = "INSERT INTO `violation_list` set {$data} ";
		} else {
			$sql = "UPDATE `violation_list` set {$data} where id = '{$id}' ";
		}
		$save = $this->conn->query($sql);
		$this->capture_err();
		$driver_violation_id = empty($id) ? $this->conn->insert_id : $id;
		$this->conn->query("DELETE FROM `violation_items` where `driver_violation_id` = '{$driver_violation_id}'");
		$this->capture_err();
		$data = "";
		foreach ($violation_id as $k => $v) {
			if (!empty($data)) $data .= ", ";
			$data .= "('{$driver_violation_id}','{$v}','{$fine[$k]}','{$status}','{$date_created}')";
		}
		$save2 = $this->conn->query("INSERT INTO `violation_items` (`driver_violation_id`,`violation_id`,`fine`,`status`,`date_created`) VALUES {$data}");
		$this->capture_err();
		if ($save && $save2) {
			if (empty($id))
				$this->settings->set_flashdata('success', " Tạo biển bản thành công");
			else
				$this->settings->set_flashdata('success', " Cập nhật biên bản thành công");
			$resp['status'] = 'success';
			$resp['id'] = $driver_violation_id;
		} else {
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error . "[{$sql}]";
		}
		return json_encode($resp);
	}
	function delete_violation_record()
	{
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `violation_list` where id = '{$id}'");
		if ($del) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', "Xóa thành công");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function save_news()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if ($k !== 'id') {
				if (!empty($data)) $data .= ",";
				$data .= " `{$k}`='{$v}' ";
			}
		}

		if (!empty($id)) {
			$sql = "UPDATE `news_list` SET {$data} WHERE `id`='{$id}'";
		} else {
			$sql = "INSERT INTO `news_list` SET {$data}";
		}
		if ($this->conn->query($sql)) {
			$resp['status'] = 'success';
			if (empty($id))
				$this->settings->set_flashdata('success', "Tạo mới thành công");
			else
				$this->settings->set_flashdata('success', "Cập nhật thành công");
		} else {
			$resp['status'] = 'failed';
			$resp['err'] = 'Lỗi khi lưu tin tức: ' . $this->conn->error;
		}
		return json_encode($resp);
	}
	function delete_news()
	{
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `news_list` where id = '{$id}'");
		if ($del) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', "Xóa thành công");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
}

$Master = new Master();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$sysset = new SystemSettings();
switch ($action) {
	case 'save_violation':
		echo $Master->save_violation();
		break;
	case 'delete_violation':
		echo $Master->delete_violation();
		break;
	case 'upload_files':
		echo $Master->upload_files();
		break;
	case 'save_driver':
		echo $Master->save_driver();
		break;
	case 'delete_driver':
		echo $Master->delete_driver();
		break;

	case 'save_violation_record':
		echo $Master->save_violation_record();
		break;
	case 'delete_violation_record':
		echo $Master->delete_violation_record();
		break;
	case 'delete_img':
		echo $Master->delete_img();
		break;
	case 'save_news':
		echo $Master->save_news();
		break;
	case 'delete_news':
		echo $Master->delete_news();
		break;
	default:
		// echo $sysset->index();
		break;
}
