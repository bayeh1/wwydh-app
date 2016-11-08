<?php

    session_start();

    include "../helpers/conn.php";

	$userInfoRow = null;
  $usrRankVal = null;

	if (isset($_GET["usrID"]))
	{
		$usrQuery = "SELECT * from user_profiles where id=" . $_GET["usrID"];
		$queryResult = $conn->query($usrQuery);
		$userInfoRow = @mysqli_fetch_array($queryResult);
	}
  if(isset($_GET["usrID"]))
  {
  $usrRankQry = "SELECT rank from user_profiles where id=" . $_GET["usrID"];
  $rqueryResult = $conn->query($usrRankQry);
  $rankRow = @mysqli_fetch_array($rqueryResult);
  }
  if(isset($_GET["usrID"]))
  {
  $comPlete = "SELECT completed from projects where id=" . $_GET["usrID"];
  $rComP = $conn->query($comPlete);
  $rCompRow = @mysqli_fetch_array($rComP);
  }
  if(isset($_GET["usrID"]))
  {
  $name = "SELECT first,last from users where id=" . $_GET["usrID"];
  $name1 = $conn->query($name);
  $nameRow = @mysqli_fetch_array($name1);
  }





	function writeSkillSection($image_path, $skillname, $description)
	{
		echo "<div class=\"skillSection\">\n\t<img class=\"skillImg\" src=\"" . $image_path . "\"></img>\n\t<div class=\"skillLabel\">" . $skillname . "</div>\n\t<span class=\"tooltiptext\">" . $description . "</span>\n</div>";
	}
  function printRank($usrRankVal)
  {
   echo $usrRankVal;
  }
	//if (isset($_SESSION[)
?>
<!DOCTYPE html>
<html>
    <head>
		<link href="styles.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
	<div id="MySkills" class="BoxContainer">
		<div class="BoxLabel">
			Contributions
		</div>
		<?php
			//TODO: Use SESSION instead of GET
			if (isset($_GET["loggedIn"]))
			{

			}
			$userSkillQuery = "SELECT skill_arr from user_profiles where id=" . $_GET["usrID"];
			$queryResult = $conn->query($userSkillQuery);
			$skillsArrRow = @mysqli_fetch_array($queryResult);

			$skills = explode(";", $skillsArrRow['skill_arr']);


			foreach ($skills as $currentSkill)
			{
				$skillsQuery = "SELECT * from user_skills where id=" . $currentSkill;
				$skillResult = $conn->query($skillsQuery);
				$skillsRow = @mysqli_fetch_array($skillResult);

				writeSkillSection($skillsRow['img'], $skillsRow['skill_name'], $skillsRow['skill_description']);
			}
		?>
    	</div>

    <div id="AboutMe" class="BoxContainer">
  		<div class="BoxLabel">
  			Rank
  		</div>
      <div class="BoxContent">
        <?php
        echo $rankRow['rank'];
        ?>
      </div>
      </div>

      <div id="AboutMe" class="BoxContainer">
    		<div class="BoxLabel">
    			Completed Projects
    		</div>
        <div class="BoxContent">
          <?php
          echo $rCompRow['completed'];
          ?>
        </div>
        </div>
        <div id="AboutMe" class="BoxContainer">
          <div class="BoxLabel">
            Name
          </div>
          <div class="BoxContent">
            <?php
            echo $nameRow['first']." ".$nameRow['last'];
            ?>
          </div>
          </div>

	<div id="AboutMe" class="BoxContainer">
		<div class="BoxLabel">
			About Me
		</div>
		<div class="BoxContent">
			<?php
				echo $userInfoRow['about_me'];
			?>
		</div>
	</div>
	</body>
</html>
