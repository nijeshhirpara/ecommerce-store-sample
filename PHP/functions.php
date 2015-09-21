<?php

	function get_product(){

		//Paginate

		if(isset($_GET['id']) AND $_GET['id']!=''){

			$id = filter_var($_GET['id'], FILTER_VALIDATE_INT);


	    	$result = mysqli_query($GLOBALS['mysqli'],"select * from product where Id=".$id);

	    	if($result){

				while($row = mysqli_fetch_assoc($result)){

					$id = filter_var($row['Id'], FILTER_VALIDATE_INT);
					$productName = filter_var($row['Product Name']);
					$Price = filter_var($row['Price'], FILTER_VALIDATE_INT);

					?>
						<div class="product fl">
	 						<img src="images/product.jpg">
	 						<br/>
	 						<a href="#"><?php echo $productName; ?></a>
	 						<span>Price: <?php echo $Price; ?></span>
						</div>
					<?php

				}
			}

			echo "<div class='clear'><div/>";


		}

		
	}

	function get_home(){

		//Paginate

		if(isset($_GET['cat']) AND $_GET['cat']!=''){

			$cat = filter_var($_GET['cat'], FILTER_VALIDATE_INT);

			$where= " where CatID = ".$cat;

		}else{

			$where= " where 1";
		}

		// Find out how many items are in the table
	    $resc = mysqli_query($GLOBALS['mysqli'],"select * from product".$where);
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
		$sql = "select * from product".$where;

		$sql.= " order by `Product Name` ASC limit ".$offset.",".$limit;

		$result = mysqli_query($GLOBALS['mysqli'],$sql);

		if($result){

			while($row = mysqli_fetch_assoc($result)){

				$id = filter_var($row['Id'], FILTER_VALIDATE_INT);
				$productName = filter_var($row['Product Name']);

				?>
					<div class="product fl">
 						<img src="images/product.jpg">
 						<br/>
 						<a href="index.php?route=PRODUCT&id=<?php echo $id; ?>"><?php echo $productName; ?></a>
					</div>
				<?php

			}
		}

		echo "<div class='clear'><div/>";

		// Display the paging information
	    echo '<div id="paging"><p>', $prevlink, ' Page ', $page, ' of ', $pages, ' pages, displaying ', $start, '-', $end, ' of ', $total, ' results ', $nextlink, ' </p></div>';



	}

	function get_upload(){

		if (isset($_POST['submit'])) {

		    $tmp = $_FILES['fileToUpload']['tmp_name'];
		    $name = $_FILES['fileToUpload']['name'];

		    //Can be any full path, just don't end with a /. That will be added in in the path variable
		    $uploads_dir = $_SERVER['DOCUMENT_ROOT'].'/ecom/uploads';

		    $path = $uploads_dir.'/'.$name;

		    if(move_uploaded_file($tmp, $path)){
		        echo "<br><center><p>". $name ."</p></center>";

		        //Import uploaded file to Database
		        $import = "LOAD DATA INFILE '".$path."'
		               IGNORE INTO TABLE product  CHARACTER SET utf8 FIELDS TERMINATED BY ','
		               OPTIONALLY ENCLOSED BY '\"' IGNORE 1 LINES (`ProductID`, `Category`, `Product Name`, `Price`);
		        ";

		        mysqli_query($GLOBALS['mysqli'],$import) or die(mysqli_error($GLOBALS['mysqli']));
		        
		        mysqli_query($GLOBALS['mysqli'],"INSERT IGNORE INTO `category`(`Category`) SELECT Category from product where 1 group by Category") or die(mysqli_error($GLOBALS['mysqli']));

		        $sql = "SELECT CatId, Category from category where 1";
		        $result = mysqli_query($GLOBALS['mysqli'],$sql) or die(mysqli_error($GLOBALS['mysqli']));

		        if($result){

					while($row = mysqli_fetch_assoc($result)){

						$id = filter_var($row['CatId'], FILTER_VALIDATE_INT);
						$productName = filter_var($row['Category']);
						$up = "UPDATE `product` SET CatID='".$row['CatId']."' WHERE `CatID` = '' AND `Category`='".$row['Category']."'";
						mysqli_query($GLOBALS['mysqli'],$up) or die(mysqli_error($GLOBALS['mysqli']));

					}
				}


		        echo 'File Uploaded successfully';

		        //If you do not want to keep the csv, you can delete it after this point.
		        //unlink($path);

		    }else{
		        echo 'Failed to move uploaded files';
		    }

		}

		?>

		<form action="index.php?route=UPLOAD" method="post" enctype="multipart/form-data">
		    Select Product CSV to upload:
		    <input type="file" name="fileToUpload" id="fileToUpload">
		    <input type="submit" value="uploadFile" name="submit">
		</form>

		<?php
	}
	
