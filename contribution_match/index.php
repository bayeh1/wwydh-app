<?php

    session_start();

    include "../helpers/conn.php";

	if (isset($_GET['stage']))
	{
		$reqType = $_GET['stage'];
	}
	else
	{
		$reqType = "stage1";
	}

	function writeResultsTable($skillClass, $range)
	{
		$conn = new mysqli("mysql.winnerdigital.net", "wwydh", "foucheisbae", "wwydh");
		if ($range === "any")
		{
			$header = "<tr><th>Description</th><th>Skill</th><th>Location</th></tr>";
			$sQuery = "";
			if ($skillClass === "1")
			{
				$sQuery = "SELECT contribution_desc, skill_name FROM active_contributions INNER JOIN user_skills ON active_contributions.skillID=user_skills.id";
			}
			else
			{
				$skillClass *= 100;
				$sQuery = "SELECT contribution_desc, skill_name FROM active_contributions INNER JOIN user_skills ON active_contributions.skillID=user_skills.id WHERE skill_class >= " . $skillClass . " AND skill_class < " . ($skillClass + 100);
			}
			$sQueryResult = $conn->query($sQuery);
			$skillsRow = @mysqli_fetch_array($sQueryResult);
			$resRowCount = mysqli_num_rows($sQueryResult);

			if ($resRowCount == 0)
			{
				echo "<div class=\"sectionText\" style=\"text-align: center;\">Sorry, there are no jobs in that category right now.</div><br/>";
			}
			else
			{
				echo "<div class=\"sectionText\" style=\"text-align: center;\">Here's what we found:</div><br/>";
				echo "<table>";
				echo $header;
				for ($x = 0; $x < $resRowCount; $x++)
				{
					echo "<tr><td>" . $skillsRow['contribution_desc'] . "</td><td>" . $skillsRow['skill_name'] . "</td><td>Baltimore</td></tr>";
					$skillsRow = @mysqli_fetch_array($sQueryResult);
				}

				echo "</table>";
			}
		}
	}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>WWYDH | Contribute</title>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,600i,700" rel="stylesheet">
        <link href="styles.css" type="text/css" rel="stylesheet" />
		<link href="../helpers/header_footer.css" type="text/css" rel="stylesheet" />
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBzAMBl8WEWkqExNw16kEk40gCOonhMUmw" async defer></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script type="text/javascript">
            // convert location data from php to javascript using JSON
            var locations = [{latitude: 39.311111, longitude: -76.614877}];

            function initMap() {
				document.getElementById("customRange").disabled = true;
				document.getElementById("distRange").disabled = true;
                // Create a map object and specify the DOM element for display.
                var map = new google.maps.Map(document.getElementById('map'), {
                    animation: google.maps.Animation.DROP,
                    center: {lat: parseFloat(locations[0].latitude), lng: parseFloat(locations[0].longitude)},
                    scrollwheel: false,
                    zoom: 14
                });
            }

        </script>

        <!-- scroll on click to how it works -->
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $("#see-how").click(function() {
                    $("html, body").animate({scrollTop: $("#how").offset().top}, 650);
                })
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function() {
                $("li.tablink").click(function() {
                    if (!$(this).hasClass("active")) {
                        // handle nav change
                        $("li.tablink").removeClass("active");
                        $(this).addClass("active");

                        // handle content change
                        $(".tabcontent").removeClass("active");
                        $(".tabcontent[data-tab=" + $(this).data("target") + "]").addClass("active");
                    }
                })
            })
       </script>
    </head>
    <body onload="initMap()">
        <div id="nav">
            <div class="nav-inner width">
                <a href="../home">
                    <div id="logo"></div>
                    <div id="logo_name">What Would You Do Here?</div>
                <div id="user_nav" class="nav">
                    <ul>
                        <a href="#"><li>Log in</li></a>
                        <a href="#"><li>Sign up</li></a>
                    </ul>
                </div>
                <div id="main_nav" class="nav">
                    <ul>
                        <a href="../locations"><li>Locations</li></a>
                        <a href="../ideas"><li>Ideas</li></a>
                        <a href="../projects"><li>Projects</li></a>
                        <a href="../contact"><li>Contact</li></a>
                    </ul>
                </div>
            </div>
        </div>
        <div id="skillsGrid" <?php if ($reqType !== "stage1") echo " style=\"display: none;\""; ?>>
			<div class="sectionText">How do you want to help? </div><br/>
			<a href="index.php?stage=stage2&choice=1">
			<div class="skillSquare1"></div>
			</a>
			<a href="index.php?stage=stage2&choice=2">
			<div class="skillSquare2"></div>
			</a>
			<a href="index.php?stage=stage2&choice=3">
			<div class="skillSquare3"></div>
			</a>
			<a href="index.php?stage=stage2&choice=4">
			<div class="skillSquare4"></div>
			</a>
			<a href="index.php?stage=stage2&choice=5">
			<div class="skillSquare5"></div>
			</a>
			<a href="index.php?stage=stage2&choice=6">
			<div class="skillSquare6"></div>
			</a>
		</div>
		<div id="selectRange" <?php if ($reqType !== "stageX") echo " style=\"display: none;\"" ?>>
			<div id="distanceSelector">
				<div class="rbLabel"><input type="radio" class="radioBtn" name="rangeType" value="anyRange" checked> Any Range</div>
				<div class="rbLabel"><input type="radio" class="radioBtn" name="rangeType" value="customRange" id="customRange"> Custom Range</div><br/>
				<input type="range" id="distRange" value="50">
			</div>
			<div id="mapContainer">
				<div id="map"></div>
			</div>
		</div>
		<div id="availableJobs" <?php if ($reqType !== "stage2") echo " style=\"display: none;\"" ?>>
			<?php
				if (isset($_GET['choice']))
				{
					writeResultsTable($_GET['choice'], "any");
				}
			?>
		</div>
        <div id="footer">
            <div class="grid-inner">
                &copy; Copyright WWYDH <?php echo date("Y") ?>
            </div>
        </div>
    </body>
</html>
