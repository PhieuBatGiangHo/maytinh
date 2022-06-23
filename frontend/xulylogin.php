<?php
 $username=$_POST['username'];
 $password=$_POST['password'];

//so sánh với dữ liệu trong database
$conn=new mysqli('localhost','root','','maytinh');
$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql)->fetch_assoc();
if($result['password']==$password){
    echo 'Đăng nhập thành công';
    header('Location:../admin');
}
else{
    echo 'Đăng nhập thất bại';
}
?>