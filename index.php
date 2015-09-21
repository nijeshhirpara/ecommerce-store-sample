<?php 
	

include_once('PHP/dbconfig.php');

?>

<!DOCTYPE html>

<html>
	<head>
    	<meta charset="utf-8">
    	<title>Ecom Website</title>

    	<link rel="stylesheet" type="text/css" href="css/style.css">

    	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>


    	<script >

			$(function(){

			 	$('a').each(function() {
			    	if ($(this).prop('href') == window.location.href) {
			      		$(this).parent().addClass('current');
			    	}	
			  	});

			});

		</script>



	</head>
	<body>
		<header>
			<h4>Ecomm Programming Test</h4>
		</header>
		<nav>
			<ul>
				<li class="fl <?php if(!isset($_GET['route'])){ echo 'current';} ?>"><a href="index.php?route=HOME">HOME</a></li>
				<li class="fl"><a href="index.php?route=UPLOAD">UPLOAD</a></li>
			</ul>	
			<div class="clear"></div>
		</nav>
		<aside class="sideMenu fl">

			<div>Categories</div>
			<div>

				<ul>

					<?php


							$sql = "select Category from product where 1 group by Category order by Category ASC";

							$result = mysql_query($sql);

							if($result){


								while($row = mysql_fetch_array($result)){

									echo "<li><a href='index.php?route=HOME&cat=".$row['Category']."''>".$row['Category']."</a></li>";

								}
							}

					?>
				</ul>	

			</div>
		</aside>
		<section class="content fr">

			<div>
				<?php include_once('PHP/route.php'); ?>
			</div>
		</section>
		<div class="clear"></div>
		<footer></footer>
	</body>
</html>