<?php
	include('config.php');
	include('function.php');

	include('header.php');
?>
<section class="content">
	<h2 class="ui header">Criteria Comparison</h2>
	<?php showTabelRatio('criteria','criteria'); ?>
</section>

<section class="right content">
	<h2> Preference Scale </h2>
	<table class="ui collapsing striped red table">
		<thead>
			<tr>
				<th>Verbal Judgement of Preferences</th>
				<th>Numerical Rating <em>(Preference)</em></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="center aligned">9</td>
				<td>Extremely preferred</td>
			</tr>
			<tr>
				<td class="center aligned">8</td>
				<td>Very strongly to extremely preferred</td>
			</tr>
			<tr>
				<td class="center aligned">7</td>
				<td>Very Strongly preferred</em></td>
			</tr>
			<tr>
				<td class="center aligned">6</td>
				<td>Moderately to strongly preferred</td>
			</tr>
			<tr>
				<td class="center aligned">5</td>
				<td>Strongly preferred</td>
			</tr>
			<tr>
				<td class="center aligned">4</td>
				<td>Moderately to strongly preferred</td>
			</tr>
			<tr>
				<td class="center aligned">3</td>
				<td>Moderately preferred</em></td>
			</tr>
			<tr>
				<td class="center aligned">2</td>
				<td>Eqyally to moderately preferred</td>
			</tr>
			<tr>
				<td class="center aligned">1</td>
				<td>Equally preferred</td>
			</tr>
		</tbody>
	</table>
</section>

<?php include('footer.php'); ?>