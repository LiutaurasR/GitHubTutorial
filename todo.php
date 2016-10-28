<?php
//print_r($_SERVER);

$list = array();

//db connection
$conn = new PDO('mysql:dbname=user1_todo;host=localhost', 'user1', 'password');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$insert = $conn->prepare('INSERT INTO item (title) VALUES (:title)');
	$insert->bindParam(":title", $_POST['title'], PDO::PARAM_STR, 256);
	$insert->execute();
}


//get all items
$getall = $conn->prepare("SELECT * FROM item");

if($getall->execute()){
	$list = $getall->fetchAll();
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>TO-DO app</title>
	</head>
	<body>
		<ul id="items">
			<?php foreach ($list as $item) { ?>
				<li><?php echo $item['title']?></li>
			<?php } ?>
		</ul>
		<form name="listitem" method="post">
			Item: <input type="text" name="title"/>
			<input type="submit"/>
		</form>
	</body>
</html>