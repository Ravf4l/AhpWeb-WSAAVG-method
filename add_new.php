<?php
	include('config.php');
	include('function.php');

	// mendapatkan data edit
	if(isset($_GET['type'])) {
		$type	= $_GET['type'];
	}

	if (isset($_POST['add'])) {
		$type	= $_POST['type'];
		$name 	= $_POST['name'];

		addData($type,$name);

		header('Location: '.$type.'.php');
	}

	include('header.php');
?>

<section class="content">
	<h2>Add <?php echo $type?></h2>

	<form class="ui form" method="post" action="add_new.php">
		<div class="inline field">
			<label><?php echo $type ?> name</label>
			<input type="text" name="name" placeholder="new <?php echo $type?>">
			<input type="hidden" name="type" value="<?php echo $type?>">
		</div>
		<br>
		<input class="ui green button" type="submit" name="add" value="SAVE">
	</form>
</section>

<?php include('footer.php'); ?>