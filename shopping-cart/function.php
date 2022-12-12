<?php 
	DEFINE("DB_SERVER", "localhost");
	DEFINE("DB_USERNAME", "root");
	DEFINE("DB_PASSWORD", "");
	DEFINE("DB_NAME", "shoppingcart3b");

	function openConnection(){
		$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
		if ($con === false) 
			die("Error: could not connect" . mysqli_connect_error());

		return $con;		
	}

	function closeConnection($con){
		mysql_close($con);
	}


	function sanitizeInput($con, $input){
		return mysqli_real_escape_string($con, stripcslashes(htmlspecialchars($input)));
	}

	function fileUpload($imgInput){

		$arrErrors = array();
		
		  $fileName = $imgInput['name'];
          $fileSize = $imgInput['size'];
          $fileTemp= $imgInput['tmp_name'];
          $fileType= $imgInput['type'];

          $fileExtTemp = explode('.', $fileName);
          $fileExt = strtolower(end($fileExtTemp));

          $arrAllowedFiles = array('jpeg', 'jpg', 'png');
          $uploadDIR = 'uploads/';

          if (in_array($fileExt, $arrAllowedFiles) === false) 
               $arrErrors[] = "extension file (".$fileName .")is not allowed, you can only choose JPG JPEG PNG";


            if (empty($arrErrors)) {
            	 move_uploaded_file($fileTemp, $uploadDIR . $fileName);
            }else{
               $arrErrors[] ='fil upload Error';
            }
           return $arrErrors[] = $arrErrors;
	}


?>