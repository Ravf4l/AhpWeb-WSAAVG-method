<?php
	include('config.php');
	include('function.php');

	// mendapatkan data edit
	if(isset($_GET['type']) && isset($_GET['id'])) {
		$id 	= $_GET['id'];
		$type	= $_GET['type'];

		// hapus record
		$query 	= "SELECT name FROM $type WHERE id=$id";
		$result	= mysqli_query($conn, $query);
		
		while ($row = mysqli_fetch_array($result)) {
			$name = $row['name'];
		}
	}

	if (isset($_POST['update'])) {
		$id 	= $_POST['id'];
		$type	= $_POST['type'];
		$name 	= $_POST['name'];

		$query 	= "UPDATE $type SET name='$name' WHERE id=$id";
		$result	= mysqli_query($conn, $query);

		if (!$result) {
			echo "Update gagal";
			exit();
		} else {
			header('Location: '.$type.'.php');
			exit();
		}
	}

	include('header.php');
?>

<section class="content">
	<h2>Edit <?php echo $type?></h2>

	<form class="ui form" method="post" action="edit.php">
		<div class="inline field">
			<label><?php echo $type ?> name </label>
			<input type="text" name="name" value="<?php echo $name?>">
			<input type="hidden" name="id" value="<?php echo $id?>">
			<input type="hidden" name="type" value="<?php echo $type?>">
		</div>
		<br>
		<input class="ui green button" type="submit" name="update" value="UPDATE">
	</form>
</section>

<?php include('footer.php'); ?>