<?php ob_start(); ?> 
<html>
<head>
 <link rel="stylesheet" href="/css/table.css"> 
	<title>Upload</title>
</head> 
<body>
<?php include "default.html"; ?>
<section><h3>Property</h3></section>
<?php if (!isset($_FILES["userfile"]["tmp_name"]))
	{ ?>
	<?php 
		include("connection.php");   
		$conn = oci_connect($UName,$PWord,$DB)     
		or die("Couldn't logon.");    
		$query="INSERT INTO property
		VALUES (property_seq.nextval,'".$_POST["street"]."','".$_POST["suburb"]."','".$_POST["state"]."','".$_POST["postcode"]."','".$_POST["bath"]."','".$_POST["bed"]."','".$_POST["car"]."','".$_POST["typeList"]."')";
		$stmt = oci_parse($conn,$query);   
		if(@oci_execute($stmt)){
		echo "Property Details complete <br/><br/>";
		} else {
		echo "fail";
		var_dump($_POST);
		}
		$query="select property_seq.currval from dual";
		$stmt = oci_parse($conn,$query);   
		oci_execute($stmt); 
	$temp_id = oci_fetch_array($stmt);
 ?>


	<form method="post" enctype="multipart/form-data" action="upload.php">
		<label style="margin-top:2em;">Select a file: </label>
		<input type="hidden" name="id" value="<?php echo $temp_id[0]; ?>">
		<input type="file" size="50" name="userfile" required><br/><br/>
		<input type="submit" value="Upload File">
		<input type='button' value='cancel' OnClick='window.location="property-index.php"'>
	</form>
<?php } 
else 
{ 

	include("connection.php");   
	$conn = oci_connect($UName,$PWord,$DB)     
		or die("Couldn't logon.");    
	$query="INSERT INTO listing_image
		VALUES (image_seq.nextval,'".$_FILES["userfile"]["name"]."','".$_POST["id"]."')";
		$stmt = oci_parse($conn,$query);   
		if(@oci_execute($stmt)){
		echo "Image successfully uploaded. <br/><br/><br/>";
		} else {
		echo "fail";
		}
	$upfile = "property_images/".$_FILES["userfile"]["name"];
	if(!move_uploaded_file($_FILES["userfile"]["tmp_name"],$upfile)) {
		echo "ERROR: Could Not Move File Into Directory";
		?><a class="button" href="property-index.php">Return to list</a> <?php
	}  	
	else {
		?> Successfully added Image<br/>
		<a class="button" href="property-features.php?propertyid= <?php echo $_POST["id"]; ?>">Next</a> <br/><br/><?php 
	}
} ?> <a class="sourcecode" href="printsource.php?source=upload.php" target="_blank">Property</a> 