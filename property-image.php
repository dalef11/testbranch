<?php   
include("connection.php");   
$conn = oci_connect($UName,$PWord,$DB)     
or die("Couldn't logon.");    
$query="select image_name 
from listing_image 
where property_id=10077";
$stmt = oci_parse($conn,$query);   
oci_execute($stmt); 
while ($row = oci_fetch_array ($stmt)){ 
?> <img src="<?php echo "property_images/".$row["IMAGE_NAME"]; ?>"> <?php } ?>
<br/><br/>
<a class="sourcecode" href="printsource.php?source=property-image.php" target="_blank">Property</a> 