<?php

	function get_home(){

		$sql = "select * from product where 1 order by Id ASC";

		$result = mysql_query($sql);

		if($result){


			while($row = mysql_fetch_array($result)){

				echo $row['Product Name'];

			}
		}


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

?>