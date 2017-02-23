<?php ob_start(); ?> 
<?php include "default.html"; ?>
<html>
<head>
		<script src="https://code.jquery.com/jquery-3.1.0.js"
	  integrity="sha256-slogkvB1K3VOkzAI8QITxV3VzpOnkeNVsKvtkYLMjfk="
	  crossorigin="anonymous">
	</script>
	<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
	<script type="text/javascript" src="DataTables/datatables.min.js"></script>
	<title>View Properties</title>
</head> 
<body>
<h2>Properties</h2>
<?php   
include("connection.php");   
$conn = oci_connect($UName,$PWord,$DB)     
or die("Couldn't logon.");    
$query="SELECT p.property_id, p.property_street, p.property_suburb, p.property_state, p.property_pc, t.type_name AS name 
FROM PROPERTY p, TYPE t WHERE  p.type_type_id=t.type_id";
$stmt = oci_parse($conn,$query);   
oci_execute($stmt); ?>
<a class="button special" href="property-add.php"> Create</a>
<div class="table-wrapper">
<table id="table_id" class="display"> 
<script type="text/javascript">
		$(document).ready( function () {
			$('#table_id').DataTable();
		} );		
	</script>
	<thead>
		<tr>
			<th>ID</th>
			<th>Street</th>
			<th>Suburb</th>
			<th>State</th>
			<th>PostCode</th>
			<th>Type</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
<?php
while ($row = oci_fetch_array ($stmt)){ 
?> 
	<tr> 
		<td><?php echo $row["PROPERTY_ID"]; ?></td> 
		<td><?php echo $row["PROPERTY_STREET"]; ?></td>
		<td><?php echo $row["PROPERTY_SUBURB"]; ?></td>
		<td><?php echo $row["PROPERTY_STATE"]; ?></td>
		<td><?php echo $row["PROPERTY_PC"]; ?></td>
		<td><?php echo $row["NAME"]; ?></td>
		<td> <a style="margin-right:2em;" href="property-edit.php?propertyid= <?php echo $row["PROPERTY_ID"]; ?> &Action=Delete">Delete </a> 
		<a style="margin-right:2em;" href="property-edit.php?propertyid=<?php echo $row["PROPERTY_ID"]; ?>&state=<?php echo $row["PROPERTY_STATE"]; ?>&Action=Update">Update </a>
		<a style="" href="image-index.php?propertyid=<?php echo $row["PROPERTY_ID"]; ?>">Images </a>
		</td>
	</tr>
<?php } ?></tbody>
</table>
</div>
<a class="sourcecode" href="printsource.php?source=property-index.php" target="_blank">Property</a> 
</div>
</div>
</div>
</body>
</html>	