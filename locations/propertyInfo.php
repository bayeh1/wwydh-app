<html>
	<?php
		include "../helpers/conn.php";
		//$servername = "wwydh-mysql.cqqq2sesxkkq.us-east-1.rds.amazonaws.com";
		//$username = "wwydh_a_team";
		//$password = "nzqbzNU3drDhVsgHsP4f";

		//$conn = new mysqli($servername, $username, $password, "wwydh");
		$theQuery = "SELECT * FROM locations where `id`='{$_GET["id"]}'";
		$result = $conn->query($theQuery);
		$rowcount=mysqli_num_rows($result);
		$row = @mysqli_fetch_array($result);
		
		echo "<head>";
		echo "<title>{$row["building_address"]}</title>";
		echo "<style>";
			echo ".imgViewer {width: 100%; height: 25em; background-color: #fbffdf; background-repeat:repeat; background-position: center;}";
			echo "td {padding: 1.5em;}";
			echo "h1, h3 {text-align: center;}";
		echo "</style>";
		echo "</head>";
		echo "<body>";
		echo "<div class=\"imgViewer\" style=\"background-image:url(../helpers/location_images/{$row["image"]})\">";
		echo "</div>";
		echo "<h1>{$row["building_address"]}</h1>";
		echo "<h3>Property Information</h3>";
		echo "<p align=\"center\">";
		"<table>";
			echo "<td><b><li>Block: </b>{$row["block"]}</li><b><li>Lot: </b>{$row["lot"]}</li><b><li>Zip Code: </b>{$row["zip_code"]}</li></td>";
			echo "<td><b><li>City: </b>{$row["city"]}</li><b><li>Neighborhood: </b>{$row["neighborhood"]}</li></td>";
			echo "<td><b><li>Council District: </b>{$row["council_district"]}</li><b><li>Police District: </b>{$row["police_district"]}</li></td>";
			echo "<td><b><li>Owner: </b>{$row["owner"]}</li><b><li>Use: </b>{$row["use"]}</li><b><li>Mailing Address: </b>{$row["mailing_address"]}</li></td>";
		echo "</table>";
		echo "</p>";
		echo "</body>";
	?>
</html>
