<?php

	function get_home(){

		//Paginate

		// Find out how many items are in the table
	    $resc = mysqli_query($GLOBALS['mysqli'],"select * from product where 1");
	    $total = mysqli_num_rows($resc);

	    // How many items to list per page
	    $limit = 5;

	    // How many pages will there be
	    $pages = ceil($total / $limit);

	  	// What page are we currently on?
	    $page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
	        'options' => array(
	            'default'   => 1,
	            'min_range' => 1,
	        ),
	    )));

	    // Calculate the offset for the query
	    $offset = ($page - 1)  * $limit;

	    // Some information to display to the user
	    $start = $offset + 1;
	    $end = min(($offset + $limit), $total);

	    // The "back" link
	    $prevlink = ($page > 1) ? '<a href="?page=1" title="First page">&laquo;</a> <a href="?page=' . ($page - 1) . '" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';

	    // The "forward" link
	    $nextlink = ($page < $pages) ? '<a href="?page=' . ($page + 1) . '" title="Next page">&rsaquo;</a> <a href="?page=' . $pages . '" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';

	    

	    //Fetch Product from db
		$sql = "select * from product where 1 order by Id ASC limit ".$offset.",".$limit;

		$result = mysqli_query($GLOBALS['mysqli'],$sql);

		if($result){

			while($row = mysqli_fetch_assoc($result)){

				

				?>
					<div class="product fl">
 						<img src="images/product.jpg">
 						<br/>
 						<a href="<?php echo $row['Id']; ?>"><?php echo $row['Product Name']; ?></a>
					</div>
				<?php

			}
		}

		echo "<div class='clear'><div/>";

		// Display the paging information
	    echo '<div id="paging"><p>', $prevlink, ' Page ', $page, ' of ', $pages, ' pages, displaying ', $start, '-', $end, ' of ', $total, ' results ', $nextlink, ' </p></div>';



	}

	function get_upload(){

		?>

		<form action="index.php?route=UPLOAD" method="post" enctype="multipart/form-data">
		    Select Product CSV to upload:
		    <input type="file" name="fileToUpload" id="fileToUpload">
		    <input type="submit" value="uploadFile" name="submit">
		</form>

		<?php
	}
	
	
	function addContact(){

		$field = array();
		$val = array();
		foreach ($_POST as $key => $value) {

			if(!empty($value)){
				array_push($field, $key);
				array_push($val, $value);
			}else{
				echo '<p class="errorMessage">Please fill all fields properly.</p>';
				return;
			}
				
		}

		$sql = 'insert into contact ('.implode(",",$field).',time) values ("'.implode('","',$val).'",NOW())';

		$result = mysql_query($sql);

		if(!$result){
			echo '<p class="errorMessage">Please fill all fields properly.</p>';
		}else{
			echo '<p class="message">Thank you for initiating contact, our sales team will get back to you ASAP.</p>';
		}
	}
