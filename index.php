<!DOCTYPE html>
<html>
<head>
	<title>PHP CURL - Download Remote File and Save in Local</title>
	<style type="text/css">
		div.wrapper{
			max-width: 500px;
    		margin: 0 auto;
			border: 1px solid #ddd;
		    padding: 20px;
		    margin-top: 30px;
		    border-radius: 3px;
		}
		div.wrapper h3{
			text-align: center;
		}


		div.wrapper form{
			display: flex;
			justify-content: space-between;	
		}
		div.wrapper form div:nth-child(1){
			width: 70%
		}
		div.wrapper form div:nth-child(2){
			width: 30%
		}
		div.wrapper input{
			width: 100%;
			outline: none;
			border: 1px solid #ddd;
			border-radius: 3px;
			padding: 10px 5px
		}
		div.wrapper input[type=submit]{
			background: blue;
			color: #fff;
			border: none;
			cursor: pointer;
		}

	</style>
</head>
<body>

	<?php
		$msg = false;
		if (isset($_POST['url']) && $_POST['url'] != '') {

			$base_path = getcwd()."/local_files/";
	        
	        //now download image to save local
	        $filename_from_url = parse_url($_POST['url']);
	        $ext = pathinfo($filename_from_url['path'], PATHINFO_EXTENSION);

	        curl_setopt($ch=curl_init(), CURLOPT_URL, $_POST['url']);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	        $response = curl_exec($ch);
	        curl_close($ch);

	        // now save video
	        $fileName = "remote-file-".uniqid().microtime('now');
	        
	        file_put_contents($base_path.$fileName.".".$ext, $response);
	        if (file_exists($base_path.$fileName.".".$ext)) {
	            $imageName = $fileName.".".$ext;
	            $msg = "SUCCESS! The file saved as (".$imageName.")";
	        }else{
	        	$msg = "Something went wrong";
	        }
	        
		}
	?>


	<div class="wrapper">
		<h3>PHP CURL - Download Remote File and Save in Local</h3>
		<div>
			<?php
				if ($msg !== false) {
					echo $msg;
					$msg = false;
				}
			?>
		</div>
		<form method="POST" action="">
			<div>
				<input type="url" name="url" placeholder="Enter Remote File URL">
			</div>
			<div>
				<input type="submit" name="Submit">
			</div>
		</form>
	</div>
</body>
</html>