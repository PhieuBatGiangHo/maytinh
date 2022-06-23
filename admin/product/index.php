<?php
require_once ('../../db/dbhelper.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Quản Lý Sản Phẩm</title>
	<!-- boot trap -->
	<!--  CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<!--  jQuery Library  -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<button type="button" class="btn btn-Primary"><a href="../../frontend">Đăng Xuất</a></button>
	<ul class="nav nav-tabs">
	  <li class="nav-item">
	    <a class="nav-link active" href="../category/">Quản Lý Danh Mục</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link" href="#">Quản Lý Sản Phẩm</a>
	  </li>
	</ul>

	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center">Quản Lý Sản Phẩm</h2>
			</div>
			<div class="panel-body">
				<a href="add.php">
					<button class="btn btn-success" style="margin-bottom: 15px;">Thêm Sản Phẩm</button>
				</a>
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th width="50px">STT</th>
							<th>Hình Ảnh</th>
                            <th>Tên Sản Phẩm</th>
                            <th>Giá Bán</th>
                            <th>Danh Mục</th>
							<th>Mô tả</th>
                            <th>Ngày cập nhật</th>
							<th width="50px"></th>
							<th width="50px"></th>
						</tr>
					</thead>
					<tbody>
<?php
$limit=5;
$page=1;
if (isset($_GET['page'])){
	$page = $_GET['page'];
}
if ($page<=0){
	$page=1;
}
$firstIndex = ($page-1)*$limit;
//Lay danh sach san pham tu database
$sql          = 'select product.id, product.title, product.price, 
product.thumbnail, product.externalcontent, product.updated_at, category.name 
category_name from product left join category on 
product.id_category = category.id '.' limit '.$firstIndex.', '.$limit;
$productList = executeResult($sql);
$sql = 'select count(id) as total from product where 1';
$countResult = executeSingleResult($sql);
$number = 0;
if($countResult != null){
$count = $countResult['total'];
$number = ceil($count/$limit);
}
$index = 1;
foreach ($productList as $item) {
	echo '<tr>
				<td>'.(++$firstIndex).'</td>
				<td><img src="'.$item['thumbnail'].'" style="max-width:100px"/></td>
                <td>'.$item['title'].'</td>
                <td>'.$item['price'].'</td>
                <td>'.$item['category_name'].'</td>
				<td>'.$item['externalcontent'].'</td>
				
                <td>'.$item['updated_at'].'</td>
				<td>
					<a href="add.php?id='.$item['id'].'"><button class="btn btn-warning">Sửa</button></a>
				</td>
				<td>
					<button class="btn btn-danger" onclick="deleteProduct('.$item['id'].')">Xoá</button>
				</td>
			</tr>';
}
?>
					</tbody>
				</table>
				<?php
if ($number > 1){
?>	

<ul class="pagination pagination-sm">
<?php
	if ($page>1){
		echo '<li class="page-item"><a class="page-link" href="?page='.($page-1).'">Quay lại</a></li>';
	}
?>
	<?php
	for ($i=0; $i < $number ; $i++) { 
		if ($page == ($i+1)){
			echo '<li class="page-item"><a class="page-link" 
			href="#">'.($i+1).'</a></li>';
		}
		else{ 
			echo '<li class="page-item"><a class="page-link" 
			href="?page='.($i+1).'">'.($i+1).'</a></li>';
		}
	}
	?>
  
  
  
  <?php
	if ($page < ($number)){
		echo '<li class="page-item"><a class="page-link" href="?page='.($page+1).'">Trang kế</a></li>';
	}
?>
</ul>

<?php
}
?>	
			</div>
		</div>
	</div>

	<script type="text/javascript">
		function deleteProduct(id) {
			var option = confirm('Bạn có chắc chắn muốn xoá sản phẩm này không?')
			if(!option) {
				return;
			}

			console.log(id)
			//ajax - lenh post
			$.post('ajax.php', {
				'id': id,
				'action': 'delete'
			}, function(data) {
				location.reload()
			})
		}
	</script>
</body>
</html>