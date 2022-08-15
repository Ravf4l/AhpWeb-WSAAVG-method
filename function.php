<?php

// mencari ID kriteria
// berdasarkan urutan ke berapa (C1, C2, C3)
function getCriteriaID($no_order) {
	include('config.php');
	$query  = "SELECT id FROM criteria ORDER BY id";
	$result = mysqli_query($conn, $query);

	while ($row = mysqli_fetch_array($result)) {
		$listID[] = $row['id'];
	}

	return $listID[($no_order)];
}

// mencari ID alternatif
// berdasarkan urutan ke berapa (A1, A2, A3)
function getAlternativeID($no_order) {
	include('config.php');
	$query  = "SELECT id FROM alternative ORDER BY id";
	$result = mysqli_query($conn, $query);

	while ($row = mysqli_fetch_array($result)) {
		$listID[] = $row['id'];
	}

	return $listID[($no_order)];
}

// mencari nama kriteria
function getCriteriaName($no_order) {
	include('config.php');
	$query  = "SELECT name FROM criteria ORDER BY id";
	$result = mysqli_query($conn, $query);

	while ($row = mysqli_fetch_array($result)) {
		$name[] = $row['name'];
	}

	return $name[($no_order)];
}

// mencari nama alternatif
function getAlternativeName($no_order) {
	include('config.php');
	$query  = "SELECT name FROM alternative ORDER BY id";
	$result = mysqli_query($conn, $query);

	while ($row = mysqli_fetch_array($result)) {
		$name[] = $row['name'];
	}

	return $name[($no_order)];
}

// mencari priority vector alternatif
function getAlternativePV($id_alternative,$id_criteria) {
	include('config.php');
	$query = "SELECT score FROM pv_alternative WHERE id_alternative=$id_alternative AND id_criteria=$id_criteria";
	$result = mysqli_query($conn, $query);
	while ($row = mysqli_fetch_array($result)) {
		$pv = $row['score'];
	}

	return $pv;
}

// mencari priority vector kriteria
function getCriteriaPV($id_criteria) {
	include('config.php');
	$query = "SELECT score FROM pv_criteria WHERE id_criteria=$id_criteria";
	$result = mysqli_query($conn, $query);
	while ($row = mysqli_fetch_array($result)) {
		$pv = $row['score'];
	}

	return $pv;
}

// mencari jumlah alternatif
function getTotalAlternative() {
	include('config.php');
	$query  = "SELECT count(*) FROM alternative";
	$result = mysqli_query($conn, $query);
	while ($row = mysqli_fetch_array($result)) {
		$jmlData = $row[0];
	}

	return $jmlData;
}

// mencari jumlah kriteria
function getTotalCriteria() {
	include('config.php');
	$query  = "SELECT count(*) FROM criteria";
	$result = mysqli_query($conn, $query);
	while ($row = mysqli_fetch_array($result)) {
		$jmlData = $row[0];
	}

	return $jmlData;
}

// menambah data kriteria / alternatif
function addData($tabel,$name) {
	include('config.php');

	$query 	= "INSERT INTO $tabel (name) VALUES ('$name')";
	$add	= mysqli_query($conn, $query);

	if (!$add) {
		echo "Gagal mmenambah data".$tabel;
		exit();
	}
}

// hapus kriteria
function deleteCriteria($id) {
	include('config.php');

	// hapus record dari tabel kriteria
	$query 	= "DELETE FROM criteria WHERE id=$id";
	mysqli_query($conn, $query);

	// hapus record dari tabel pv_kriteria
	$query 	= "DELETE FROM pv_criteria WHERE id_criteria=$id";
	mysqli_query($conn, $query);

	// hapus record dari tabel pv_alternatif
	$query 	= "DELETE FROM pv_alternative WHERE id_criteria=$id";
	mysqli_query($conn, $query);

	$query 	= "DELETE FROM ratio_criteria WHERE criteria1=$id OR criteria2=$id";
	mysqli_query($conn, $query);

	$query 	= "DELETE FROM ratio_alternative WHERE comparison=$id";
	mysqli_query($conn, $query);
}

// hapus alternatif
function deleteAlternative($id) {
	include('config.php');

	// hapus record dari tabel alternatif
	$query 	= "DELETE FROM alternative WHERE id=$id";
	mysqli_query($conn, $query);

	// hapus record dari tabel pv_alternatif
	$query 	= "DELETE FROM pv_alternative WHERE id_alternative=$id";
	mysqli_query($conn, $query);

	// hapus record dari tabel ranking
	$query 	= "DELETE FROM ranking WHERE id_alternative=$id";
	mysqli_query($conn, $query);

	$query 	= "DELETE FROM ratio_alternative WHERE alternative1=$id OR alternative2=$id";
	mysqli_query($conn, $query);
}

// memasukkan nilai priority vektor kriteria
function inputCriteriaPV ($id_criteria,$pv) {
	include ('config.php');

	$query = "SELECT * FROM pv_criteria WHERE id_criteria=$id_criteria";
	$result = mysqli_query($conn, $query);

	if (!$result) {
		echo "Error !!!";
		exit();
	}

	// jika result kosong maka masukkan data baru
	// jika telah ada maka diupdate
	if (mysqli_num_rows($result)==0) {
		$query = "INSERT INTO pv_criteria (id_criteria, score) VALUES ($id_criteria, $pv)";
	} else {
		$query = "UPDATE pv_criteria SET score=$pv WHERE id_criteria=$id_criteria";
	}


	$result = mysqli_query($conn, $query);
	if(!$result) {
		echo "Can't update priority vector of criteria";
		exit();
	}

}

// memasukkan nilai priority vektor alternatif
function inputAlternativePV ($id_alternative,$id_criteria,$pv) {
	include ('config.php');

	$query  = "SELECT * FROM pv_alternative WHERE id_alternative = $id_alternative AND id_criteria = $id_criteria";
	$result = mysqli_query($conn, $query);

	if (!$result) {
		echo "Error !!!";
		exit();
	}

	// jika result kosong maka masukkan data baru
	// jika telah ada maka diupdate
	if (mysqli_num_rows($result)==0) {
		$query = "INSERT INTO pv_alternative (id_alternative,id_criteria,score) VALUES ($id_alternative,$id_criteria,$pv)";
	} else {
		$query = "UPDATE pv_alternative SET score=$pv WHERE id_alternative=$id_alternative AND id_criteria=$id_criteria";
	}

	$result = mysqli_query($conn, $query);
	if (!$result) {
		echo "Can't update average of alternative";
		exit();
	}

}


// memasukkan bobot nilai perbandingan kriteria
function inputDataRatioCriteria($criteria1,$criteria2,$score) {
	include('config.php');

	$id_criteria1 = getCriteriaID($criteria1);
	$id_criteria2 = getCriteriaID($criteria2);

	$query  = "SELECT * FROM ratio_criteria WHERE criteria1 = $id_criteria1 AND criteria2 = $id_criteria2";
	$result = mysqli_query($conn, $query);

	if (!$result) {
		echo "Error !!!";
		exit();
	}

	// jika result kosong maka masukkan data baru
	// jika telah ada maka diupdate
	if (mysqli_num_rows($result)==0) {
		$query = "INSERT INTO ratio_criteria (criteria1,criteria2,score) VALUES ($id_criteria1,$id_criteria2,$score)";
	} else {
		$query = "UPDATE ratio_criteria SET score=$score WHERE criteria1=$id_criteria1 AND criteria2=$id_criteria2";
	}

	$result = mysqli_query($conn, $query);
	if (!$result) {
		echo "Can't input data ratio";
		exit();
	}

}

// memasukkan bobot nilai perbandingan alternatif
function inputDataRatioAlternative($alternative1,$alternative2,$comparison,$score) {
	include('config.php');


	$id_alternative1 = getAlternativeID($alternative1);
	$id_alternative2 = getAlternativeID($alternative2);
	$id_comparison  = getCriteriaID($comparison);

	$query  = "SELECT * FROM ratio_alternative WHERE alternative1 = $id_alternative1 AND alternative2 = $id_alternative2 AND comparison = $id_comparison";
	$result = mysqli_query($conn, $query);

	if (!$result) {
		echo "Error !!!";
		exit();
	}

	// jika result kosong maka masukkan data baru
	// jika telah ada maka diupdate
	if (mysqli_num_rows($result)==0) {
		$query = "INSERT INTO ratio_alternative (alternative1,alternative2,comparison,score) VALUES ($id_alternative1,$id_alternative2,$id_comparison,$score)";
	} else {
		$query = "UPDATE ratio_alternative SET score=$score WHERE alternative1=$id_alternative1 AND alternative2=$id_alternative2 AND comparison=$id_comparison";
	}

	$result = mysqli_query($conn, $query);
	if (!$result) {
		echo "Can't input data ratio";
		exit();
	}

}

// mencari nilai bobot perbandingan kriteria
function getScoreRatioCriteria($criteria1,$criteria2) {
	include('config.php');

	$id_criteria1 = getCriteriaID($criteria1);
	$id_criteria2 = getCriteriaID($criteria2);

	$query  = "SELECT score FROM ratio_criteria WHERE criteria1 = $id_criteria1 AND criteria2 = $id_criteria2";
	$result = mysqli_query($conn, $query);

	if (!$result) {
		echo "Error !!!";
		exit();
	}

	if (mysqli_num_rows($result)==0) {
		$score = 1;
	} else {
		while ($row = mysqli_fetch_array($result)) {
			$score = $row['score'];
		}
	}

	return $score;
}

// mencari nilai bobot perbandingan alternatif
function getScoreRatioAlternative($alternative1,$alternative2,$comparison) {
	include('config.php');

	$id_alternative1 = getAlternativeID($alternative1);
	$id_alternative2 = getAlternativeID($alternative2);
	$id_comparison  = getCriteriaID($comparison);

	$query  = "SELECT score FROM ratio_alternative WHERE alternative1 = $id_alternative1 AND alternative2 = $id_alternative2 AND comparison = $id_comparison";
	$result = mysqli_query($conn, $query);

	if (!$result) {
		echo "Error !!!";
		exit();
	}
	if (mysqli_num_rows($result)==0) {
		$score = 1;
	} else {
		while ($row = mysqli_fetch_array($result)) {
			$score = $row['score'];
		}
	}

	return $score;
}

// menampilkan nilai IR
function getScoreRI($jmlCriteria) {
	include('config.php');
	$query  = "SELECT score FROM ri WHERE total=$jmlCriteria";
	$result = mysqli_query($conn, $query);
	while ($row = mysqli_fetch_array($result)) {
		$scoreRI = $row['score'];
	}

	return $scoreRI;
}

// mencari Principe Eigen Vector (λ maks)
function getEigenVector($matrix_a,$matrix_b,$matrix_c, $n) {
	$eigenvektor = 0;
	for ($i=0; $i <= ($n-1) ; $i++) {
		$eigenvektor = ($matrix_c[$i] / $n);
	}

	return $eigenvektor;
}

// mencari Cons Index
function getConsIndex($matrix_a,$matrix_b, $matrix_c, $n) {
	$eigenvektor = getEigenVector($matrix_a,$matrix_b, $matrix_c, $n);
	$consindex = ($eigenvektor - $n)/($n-1);

	return $consindex;
}

// Mencari Consistency Ratio
function getConsRatio($matrix_a,$matrix_b, $matrix_c, $n) {
	$consindex = getConsIndex($matrix_a,$matrix_b, $matrix_c, $n);
	$consratio = $consindex / getScoreRI($n);

	return $consratio;
}

// menampilkan tabel perbandingan bobot
function showTabelRatio($type,$criteria) {
	include('config.php');

	if ($criteria == 'criteria') {
		$n = getTotalCriteria();
	} else {
		$n = getTotalAlternative();
	}

	$query = "SELECT name FROM $criteria ORDER BY id";
	$result	= mysqli_query($conn, $query);
	if (!$result) {
		echo "Error connection database!!!";
		exit();
	}

	// buat list nama pilihan
	while ($row = mysqli_fetch_array($result)) {
		$pilihan[] = $row['name'];
	}

	// tampilkan tabel
	?>

	<form class="ui form" action="proses.php" method="post">
	<table class="ui celled selectable collapsing table">
		<thead>
			<tr>
				<th colspan="2">more priority</th>
				<th>value</th>
			</tr>
		</thead>
		<tbody>

	<?php

	//inisialisasi
	$order = 0;

	for ($x=0; $x <= ($n - 2); $x++) {
		for ($y=($x+1); $y <= ($n - 1) ; $y++) {

			$order++;

	?>
			<tr>
				<td>
					<div class="field">
						<div class="ui radio checkbox">
							<input name="pilih<?php echo $order?>" value="1" checked="" class="hidden" type="radio">
							<label><?php echo $pilihan[$x]; ?></label>
						</div>
					</div>
				</td>
				<td>
					<div class="field">
						<div class="ui radio checkbox">
							<input name="pilih<?php echo $order?>" value="2" class="hidden" type="radio">
							<label><?php echo $pilihan[$y]; ?></label>
						</div>
					</div>
				</td>
				<td>
					<div class="field">

	<?php
	if ($criteria == 'criteria') {
		$score = getScoreRatioCriteria($x,$y);
	} else {
		$score = getScoreRatioAlternative($x,$y,($type-1));
	}

	?>
						<input type="text" name="weight<?php echo $order?>" value="<?php echo $score?>" required>
					</div>
				</td>
			</tr>
			<?php
		}
	}

	?>
		</tbody>
	</table>
	<input type="text" name="type" value="<?php echo $type; ?>" hidden>
	<br><br><input class="ui inverted orange button" type="submit" name="submit" value="CALCULATE">
	</form>

	<?php
}

?>
