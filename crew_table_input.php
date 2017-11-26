<?php
include("../../class.mysql.php");
include("../../class.config.php");
include("../../store/functions.php");
?>

<html>
<title>Crew Table Input Form</title>
<head>
<link href="../style-sheet1.css" rel="stylesheet" type="text/css" media="all">
</head>
<body>
<p class="master-content">Input page for Crew Table in Database | <a href="crew_table_update.php">Update Crew Record</a></p>

<form name="inputForm" action="crew_table_insert.php" method="post">

<p class="master-content">Title <input type="text" name="title" size="10"/></p>

<p class="master-content">First name <input type="text" name="first_name" size="50"/></p>

<p class="master-content">Last name <input type="text" name="last_name" size="50"/></p>

<p class="master-content">Middle name <input type="text" name="middle_name" size="50"/></p>

<p class="master-content">Nickname <input type="text" name="nickname" size="50"/></p>

<p class="master-content">Position (select one or more)<br />
<?php
$db1 = new project_DB_SQL;
$sql1 = "SELECT `position_id`, `position` FROM `crew_position` ORDER BY `position`";
$db1->query($sql1);
$num_rows = $db1->num_rows();
echo "<select multiple name=\"position[]\" size=\"" . $num_rows . "\">\n";
while ($db1->next_record()) {
  $position_id = $db1->f('position_id'); 
  $position = $db1->f('position');
  echo "<option value =\"" . $position_id . "\">$position</option>\n"; 
}
echo "</select>";
?>
</p>

<p class="master-content">Years served (select one or more)<br />
<?php
$db2 = new project_DB_SQL;
$sql2 = "SELECT `year_id`, `year` FROM `crew_year` ORDER BY `year`";
$db2->query($sql2);
$num_rows = $db2->num_rows();
echo "<select multiple name=\"year[]\" size=\"" . $num_rows . "\">\n";
while ($db2->next_record()) {
  $year_id = $db2->f('year_id'); 
  $year = $db2->f('year');
  echo "<option value =\"" . $year_id . "\">$year</option>\n"; 
}
echo "</select>";
?>
</p>

<p class="master-content">Email <input type="text" name="email" size="50"/></p>

<p class="master-content">Boat (select one or more)<br />
<?php
$db3 = new project_DB_SQL;
$sql3 = "SELECT `boat_id`, `boat` FROM `crew_boat` ORDER BY `boat_id`";
$db3->query($sql3);
$num_rows = $db3->num_rows();
echo "<select multiple name=\"boat[]\" size=\"" . $num_rows . "\">\n";
while ($db3->next_record()) {
  $boat_id = $db3->f('boat_id'); 
  $boat = $db3->f('boat');
  echo "<option value =\"" . $boat_id . "\">$boat</option>\n"; 
}
echo "</select>";
?>
</p>

<p class="master-content">Board member? <input type="radio" name="board" value="1" /> 
Yes
<input type="radio" name="board" value="0" checked /> 
No
</p>

<p class="master-content">Ancient Mariner? <input type="radio" name="ancient_mariner" value="1" /> 
Yes
<input type="radio" name="ancient_mariner" value="0" checked /> 
No
</p>

<p class="master-content">Master? <input type="radio" name="master" value="1" /> 
Yes
<input type="radio" name="master" value="0" checked /> 
No
</p>

<p class="master-content">POTC crew? <input type="radio" name="potc" value="1" /> 
Yes
<input type="radio" name="potc" value="0" checked /> 
No
</p>

<p class="master-content">Display? <input type="radio" name="display" value="1" checked /> 
Yes
<input type="radio" name="display" value="0" /> 
No
</p>

<p class="master-content">Notes <input type="text" name="notes" size="50"/></p>

<input type="submit" value="Submit" />
</form>

</body>
</html>