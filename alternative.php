<?php 
	include('config.php');
	include('function.php');

	// menjalankan perintah edit
	if(isset($_POST['edit'])) {
		$id = $_POST['id'];

		header('Location: edit.php?type=alternative&id='.$id);
		exit();
	}

	// menjalankan perintah delete
	if(isset($_POST['delete'])) {
		$id = $_POST['id'];
		deleteAlternative($id);
	}

	// menjalankan perintah tambah
	if(isset($_POST['add'])) {
		$name = $_POST['name'];
		addData('alternative',$name);
	}

	include('header.php');

?>


<section class="content">

	<h2 class="ui header">Alternative</h2>

	<table class="ui celled table">
		<thead>
			<tr>
				<th class="collapsing">No</th>
				<th colspan="2">Name</th>
			</tr>
		</thead>
		<tbody>

		<?php
			// Menampilkan list alternatif
			$query = "SELECT id,name FROM alternative ORDER BY id";
			$result	= mysqli_query($conn, $query);

			$i = 0;
			while ($row = mysqli_fetch_array($result)) {
				$i++;
		?>
			<tr>
				<td><?php echo $i ?></td>
				<td><?php echo $row['name'] ?></td>
				<td class="right aligned collapsing">
					<form method="post" action="alternative.php">
						<input type="hidden" name="id" value="<?php echo $row['id'] ?>">
						<button type="submit" name="edit" class="ui mini teal left labeled icon button"><i class="right edit icon"></i>EDIT</button>
						<button type="submit" name="delete" class="ui mini red left labeled icon button"><i class="right remove icon"></i>DELETE</button>
					</form>
				</td>
			</tr>

<?php } ?>
	
		</tbody>
		<tfoot class="full-width">
			<tr>
				<th colspan="3">
					<a href="add_new.php?type=alternative">
						<div class="ui right floated small primary labeled icon button">
						<i class="plus icon"></i>ADD NEW ALTERNATIVE
						</div>
					</a>
				</th>
			</tr>
		</tfoot>
	</table>

	<br>


	<form action="w_criteria.php">
	<button class="ui inverted green button" style="float: right;">
		Next<i class="angle double right icon"></i>
	</button>
	</form>
</section>

<?php include('footer.php'); ?>