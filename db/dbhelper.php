<?php
require_once ('config.php');

function execute($sql) {
	//Lưu dữ liệu vào bảng
	//Mở kết nối đến database
	$con = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
	//Thêm, sửa, xóa dữ liệu
	mysqli_query($con, $sql);

	//Đóng kết nối
	mysqli_close($con);
}

function executeResult($sql) {
	//Lưu dữ liệu vào bảng
	//Mở kết nối đến database
	$con = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
	//Thêm, sửa, xóa dữ liệu
	$result = mysqli_query($con, $sql);
	$data   = [];
	if($result != null){
		while ($row = mysqli_fetch_array($result, 1)) {
			$data[] = $row;
	}
	
	}

	//Đóng kết nối
	mysqli_close($con);

	return $data;
}

function executeSingleResult($sql) {
	//Lưu dữ liệu vào bảng
	//Mở kết nối đến database
	$con = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
	//insert, update, delete
	$result = mysqli_query($con, $sql);
	$row    = mysqli_fetch_array($result, 1);

	//Đóng kết nối
	mysqli_close($con);

	return $row;
}