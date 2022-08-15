<?php
	include('header.php');

?>

<section class="content">
	<h3 class="ui header">Comparison Matrix</h3>
	<table class="ui collapsing celled blue table">
		<thead>
			<tr>
				<th>Criteria</th>
<?php
	for ($i=0; $i <= ($n-1); $i++) {
		echo "<th>".getAlternativeName($i)."</th>";
	}
?>
			</tr>
		</thead>
		<tbody>
<?php
	for ($x=0; $x <= ($n-1); $x++) {
		echo "<tr>";
		echo "<td>".getAlternativeName($x)."</td>";
			for ($y=0; $y <= ($n-1); $y++) {
				echo "<td>".round($matrix[$x][$y],5)."</td>";
			}

		echo "</tr>";
	}
?>
		</tbody>
		<tfoot>
			<tr>
				<th>Total</th>
<?php
		for ($i=0; $i <= ($n-1); $i++) {
			echo "<th>".round($jmlmpb[$i],5)."</th>";
		}
?>
			</tr>
		</tfoot>
	</table>


	<br>

	<h3 class="ui header">Normalization</h3>
	<table class="ui celled red table">
		<thead>
			<tr>
				<th>Criteria</th>
<?php
	for ($i=0; $i <= ($n-1); $i++) {
		echo "<th>".getAlternativeName($i)."</th>";
	}
?>
				<th>Total</th>
				<th>Priority Vector <em>(average)</em></th>
				<th>Weighted Sum</th>
				<th>WS/AVG</th>
			</tr>
		</thead>
		<tbody>
<?php
	for ($x=0; $x <= ($n-1); $x++) {
		echo "<tr>";
		echo "<td>".getAlternativeName($x)."</td>";
			for ($y=0; $y <= ($n-1); $y++) {
				echo "<td>".round($matrixb[$x][$y],5)."</td>";
			}

		echo "<td>".round($jmlmnk[$x],5)."</td>";
		echo "<td>".round($pv[$x],5)."</td>";
		echo "<td>".round($ws[$x],5)."</td>";
		echo "<td>".round($wsavg[$x],5)."</td>";

		echo "</tr>";
	}
?>

		</tbody>
		<tfoot>
			<tr>
				<th colspan="<?php echo ($n+4)?>">Principe Eigen Vector (λ maks)</th>
				<th><?php echo (round($eigenvektor,5))?></th>
			</tr>
			<tr>
				<th colspan="<?php echo ($n+4)?>">Consistency Index</th>
				<th><?php echo (round($consIndex,5))?></th>
			</tr>
			<tr>
				<th colspan="<?php echo ($n+4)?>">Consistency Ratio</th>
				<th><?php echo (round(($consRatio * 100),2))?> %</th>
			</tr>
		</tfoot>
	</table>



<?php

	if ($consRatio > 0.1) {
?>
		<div class="ui icon red message">
			<i class="close icon"></i>
			<i class="warning circle icon"></i>
			<div class="content">
				<div class="header">
					Consistency Ratio over than 10% !!
				</div>
				<p>Please input the value again..</p>
			</div>
		</div>

		<br>

		<a href='javascript:history.back()'>
			<button class="ui inverted red button">
				<i class="angle double left icon"></i>
				Previous
			</button>
		</a>

<?php

	} else {
		if ($type == getTotalCriteria()) {
?>

<br>

<form action="final_score.php">
	<button class="ui inverted green button" style="float: right;">
		Next <i class="angle double right icon"></i>
	</button>
</form>


<?php

		} else {

?>
<br>
	<a href="<?php echo "w_alternative.php?c=".($type + 1)?>">
	<button class="ui inverted green button" style="float: right;">
		Next <i class="angle double right icon"></i>
	</button>
	</a>

<?php

		}
	}

	echo "</section>";
	include('footer.php');

?>
