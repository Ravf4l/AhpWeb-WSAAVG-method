<?php

include('config.php');
include('function.php');


if (isset($_POST['submit'])) {
	$type = $_POST['type'];

	// jumlah kriteria
	if ($type == 'criteria') {
		$n		= getTotalCriteria();
	} else {
		$n		= getTotalAlternative();
	}

	// memetakan nilai ke dalam bentuk matrix
	// x = baris
	// y = kolom
	$matrix = array();
	$order 	= 0;

	for ($x=0; $x <= ($n-2) ; $x++) {
		for ($y=($x+1); $y <= ($n-1) ; $y++) {
			$order++;
			$pilih	= "pilih".$order;
			$weight = "weight".$order;
			if ($_POST[$pilih] == 1) {
				$matrix[$x][$y] = $_POST[$weight];
				$matrix[$y][$x] = 1 / $_POST[$weight];
			} else {
				$matrix[$x][$y] = 1 / $_POST[$weight];
				$matrix[$y][$x] = $_POST[$weight];
			}


			if ($type == 'criteria') {
				inputDataRatioCriteria($x,$y,$matrix[$x][$y]);
			} else {
				inputDataRatioAlternative($x,$y,($type-1),$matrix[$x][$y]);
			}
		}
	}

	// diagonal --> bernilai 1
	for ($i = 0; $i <= ($n-1); $i++) {
		$matrix[$i][$i] = 1;
	}

	// inisialisasi jumlah tiap kolom dan baris kriteria
	$jmlmpb = array();
	$jmlmnk = array();
	$ws = array();
	$jmlwsavg = array();
	for ($i=0; $i <= ($n-1); $i++) {
		$jmlmpb[$i] = 0;
		$jmlmnk[$i] = 0;
		$ws[$i] = 0;
		$jmlwsavg[$i] = 0;
	}

	// menghitung jumlah pada kolom kriteria tabel perbandingan berpasangan
	for ($x=0; $x <= ($n-1) ; $x++) {
		for ($y=0; $y <= ($n-1) ; $y++) {
			$value		= $matrix[$x][$y];
			$jmlmpb[$y] += $value;
		}
	}


	// menghitung jumlah pada baris kriteria tabel nilai kriteria
	// matrixb merupakan matrix yang telah dinormalisasi
	for ($x=0; $x <= ($n-1) ; $x++) {
		for ($y=0; $y <= ($n-1) ; $y++) {
			$matrixb[$x][$y] = $matrix[$x][$y] / $jmlmpb[$y];
			$value	= $matrixb[$x][$y];
			$jmlmnk[$x] += $value;
		}

		// nilai priority vektor
		$pv[$x]	 = $jmlmnk[$x] / $n;

		// memasukkan nilai priority vektor ke dalam tabel pv_criteria dan pv_alternative
		if ($type == 'criteria') {
			$id_criteria = getCriteriaID($x);
			inputCriteriaPV($id_criteria,$pv[$x]);
		} else {
			$id_criteria	= getCriteriaID($type-1);
			$id_alternative	= getAlternativeID($x);
			inputAlternativePV($id_alternative,$id_criteria,$pv[$x]);
		}
	}

		// nilai weighted sum
		for ($x=0; $x <= ($n-1) ; $x++) {
			for ($y=0; $y <= ($n-1) ; $y++) {
				$value	= $matrix[$x][$y];
				$ws[$x] += ($value * $pv[$y]);
			}
		}

		// nilai ws/avg
		for ($x=0; $x <= ($n-1) ; $x++) {
			for ($y=0; $y <= ($n-1) ; $y++) {
				$wsavg[$x] = $ws[$x]/$pv[$x];
				$value = $wsavg[$x];
				$jmlwsavg[$y] += $value;
			}
		}

	// cek konsistensi
	$eigenvektor = getEigenVector($jmlmpb,$jmlmnk, $jmlwsavg, $n);
	$consIndex   = getConsIndex($jmlmpb,$jmlmnk, $jmlwsavg, $n);
	$consRatio   = getConsRatio($jmlmpb,$jmlmnk, $jmlwsavg, $n);

	if ($type == 'criteria') {
		include('n_criteria.php');
	} else {
		include('n_alternative.php');
	}

}


?>
