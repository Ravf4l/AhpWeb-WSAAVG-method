<?php

include('config.php');
include('function.php');


// menghitung perangkingan
$jmlCriteria 	= getTotalCriteria();
$jmlAlternative	= getTotalAlternative();
$score			= array();

// mendapatkan nilai tiap alternatif
for ($x=0; $x <= ($jmlAlternative-1); $x++) {
	// inisialisasi
	$score[$x] = 0;

	for ($y=0; $y <= ($jmlCriteria-1); $y++) {
		$id_alternative 	= getAlternativeID($x);
		$id_criteria	= getCriteriaID($y);

		$pv_alternative	= getAlternativePV($id_alternative,$id_criteria);
		$pv_criteria	= getCriteriaPV($id_criteria);

		$score[$x]	 	+= ($pv_alternative * $pv_criteria);
	}
}

// update nilai ranking
for ($i=0; $i <= ($jmlAlternative-1); $i++) { 
	$id_alternative = getAlternativeID($i);
	$query = "INSERT INTO ranking VALUES ($id_alternative,$score[$i]) ON DUPLICATE KEY UPDATE score=$score[$i]";
	$result = mysqli_query($conn,$query);
	if (!$result) {
		echo "Gagal mengupdate ranking";
		exit();
	}
}

include('header.php');

?>

<section class="content">
	<h2 class="ui header">Priority Ranking</h2>
	<table class="ui celled table">
		<thead>
		<tr>
			<th>Overall Composite Height</th>
			<th>Priority Vector <em>(average)</em></th>
			<?php
			for ($i=0; $i <= (getTotalAlternative()-1); $i++) { 
				echo "<th>".getAlternativeName($i)."</th>\n";
			}
			?>
		</tr>
		</thead>
		<tbody>

		<?php
			for ($x=0; $x <= (getTotalCriteria()-1) ; $x++) { 
				echo "<tr>";
				echo "<td>".getCriteriaName($x)."</td>";
				echo "<td>".round(getCriteriaPV(getCriteriaID($x)),5)."</td>";

				for ($y=0; $y <= (getTotalAlternative()-1); $y++) { 
					echo "<td>".round(getAlternativePV(getAlternativeID($y),getCriteriaID($x)),5)."</td>";
				}


				echo "</tr>";
			}
		?>
		</tbody>

		<tfoot>
		<tr>
			<th colspan="2">Total</th>
			<?php
			for ($i=0; $i <= ($jmlAlternative-1); $i++) { 
				echo "<th>".round($score[$i],5)."</th>";
			}
			?>
		</tr>
		</tfoot>

	</table>


	<h2 class="ui header">Ranking</h2>
	<table class="ui celled collapsing table">
		<thead>
			<tr>
				<th>Rank</th>
				<th>Alternative</th>
				<th>Score</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$query  = "SELECT id,name,id_alternative,score FROM alternative,ranking WHERE alternative.id = ranking.id_alternative ORDER BY score DESC";
				$result = mysqli_query($conn, $query);

				$i = 0;
				while ($row = mysqli_fetch_array($result)) {
					$i++;
				?>
				<tr>
					<?php if ($i == 1) {
						echo "<td><div class=\"ui ribbon label red\"><i class=\"fire icon\"></i>BEST</div></td>";
					} else {
						echo "<td>".$i."</td>";
					}

					?>

					<td><?php echo $row['name'] ?></td>
					<td><?php echo $row['score'] ?></td>
				</tr>

				<?php	
				}


			?>
		</tbody>
	</table>
</section>

<?php include('footer.php'); ?>