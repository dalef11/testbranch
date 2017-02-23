<?php ob_start(); ?> 
<html>
<head>
 <link rel="stylesheet" href="/css/table.css"> 
	<title>Create Type</title>
</head> 
<body>
<?php include "default.html"; ?>
<section><h3>House Types</h3></section>
<?php if (empty($_POST["name"])) 
{ ?>
<hr></hr>
	<form style="margin-left:10%"action="type-add.php" method="post">
	<h3> Create new Type</h3>
	<div class="row uniform">
		<div class="6u 12u$(xsmall)">
			<input placeholder="Name" type="text" name="name" required><br>
		</div>
		<div class="12u$">
			<ul class="actions">
				<li><input value="Submit" class="special" type="submit"></li>
				<li style="float:right"><input value="Back" class="button" href="type-index.php"></li>
			</ul>
		</div>
	</div>
	</form>
	
<?php } else { 
	
	include("connection.php");   
	$conn = oci_connect($UName,$PWord,$DB)     
	or die("Couldn't logon.");    
	$query="INSERT INTO type
	VALUES (type_seq.nextval,'".$_POST["name"]."')";
	$stmt = oci_parse($conn,$query);   
	if(@oci_execute($stmt)){
?>
		<p>Successfully added <?php echo $_POST["name"] ?> 
		<?php } else { ?>
		<p>There was an error in creating your entry. Please contact a system administrator. </p> 
		<?php } ?>
		<br/><br/><a class="button" href="type-index.php">Return to list</a><br/><br/>
	 <?php } ?>
	 <a class="sourcecode" href="printsource.php?source=type-add.php" target="_blank">Type</a> 
</body>
</html>