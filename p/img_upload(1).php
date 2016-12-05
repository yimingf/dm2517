<html>
<body>

<?php
	$num = $_POST["num"];
	// get the number.
	$target_file = "img/" . $_FILES["fileToUpload"]["name"];
	// get the target file.
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$format = $_FILES['fileToUpload']['type'];
		$size = $_FILES['fileToUpload']['size'];
		$file_tmp =$_FILES['fileToUpload']['tmp_name'];
		// get the content, file type and the size.

		if (move_uploaded_file($file_tmp, $target_file)) {
      echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";

      $link = mysqli_connect('localhost', 'yimingf', 'yimingf-xmlpub13', 'yimingf');
			// check connection.
	    if (mysqli_connect_errno()) {
	      printf("Connect failed: %s\n", mysqli_connect_error());
	      exit();
	    }
	    $sql_link = "successfully linked!";

			$query = "INSERT INTO img (num, format, size/*, publish_date, caption, description, thumbnail*/) VALUES ('$num', '$format', '$size'/*, '$description', '$capture'*/)";
			// insert the image.
			if (($result = mysqli_query($link, $query)) === false) {
	        printf("Query failed: %s<br />\n%s", $query, mysqli_error($link));
	        exit();
	      } else {
	        $sql_link .= " and successfully inserted!";
	    }
    } else {
      echo "Sorry, there was an error uploading your file.";
      print_r($errors);
    }
    // upload the file.
	}
?>

<form method="post" enctype="multipart/form-data">
		Number: <input type="text" name="num" value="<?php echo $num;?>">
		<br>
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>

<?php
	echo "<br>";
	echo $_FILES["fileToUpload"]["name"];
	echo "<br>";
	echo $file_tmp;
	echo "<br>";
	echo $target_file;
	echo "<br>";
	echo $size;
	echo "<br>";
	echo $format;
?>

</body>
</html>
