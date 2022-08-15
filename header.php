<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>DSS Group 6</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="semantic/dist/semantic.min.css">
</head>

<body>
<header style="background-color: orange;">
	<h1 class="ui header"; style="text-align: left; color: white;"><i class="code icon" style="width: 40px;"></i>Decision Support System (AHP Method)</h1>
</header>

<div class="wrapper">
	<nav id="navigation" role="navigation">
		<ul>
			<li><a class="item" href="index.php"><i class="home icon" style="width: 20px;"></i>Home</a></li>
			<li>
				<a class="item" href="criteria.php"><i class="table icon" style="width: 20px;"></i>Criteria
					<div class="ui orange circular label" style="float: right;"><?php echo getTotalCriteria(); ?></div>
				</a>
			</li>
			<li>
				<a class="item" href="alternative.php"><i class="table icon" style="width: 20px;"></i>Alternative
					<div class="ui orange circular label" style="float: right;"><?php echo getTotalAlternative(); ?></div>
				</a>
			</li>
			<li><a class="item" href="w_criteria.php"><i class="balance scale icon" style="width: 20px;"></i>Criteria Comparison</a></li>
			<li><a class="item" href="w_alternative.php?c=1"><i class="balance scale icon" style="width: 20px;"></i>Alternative Comparison</a></li>
				<ul>
					<?php

						if (getTotalCriteria() > 0) {
							for ($i=0; $i <= (getTotalCriteria()-1); $i++) { 
								echo "<li><a class='item' href='w_alternative.php?c=".($i+1)."'>".getCriteriaName($i)."</a></li>";
							}
						}

					?>
				</ul>
			<li><a class="item" href="final_score.php"><i class="chart bar icon" style="width: 20px;"></i>Final Result</a></li>
		</ul>
	</nav>