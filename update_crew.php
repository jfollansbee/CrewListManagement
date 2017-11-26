<?php
include("../../class.mysql.php");
include("../../class.config.php");
include("../../store/functions.php");
?>

<html>
<title>Crew Table Update</title>
<head>
<link href="../style-sheet1.css" rel="stylesheet" type="text/css" media="all">
</head>
<body>
<p class="master-content">Update Results for Crew Table | <a href="crew_table_update.php">Update Another Crew Record</a> | <a href="crew_table_input.php">Create a New Crew Record</a></p>

<p class="master-content">
<?php

if(isset($_POST['crew_id']) and $_POST['crew_id'] != "") {
$crew_id = $_POST['crew_id'];
} else {
exit("Crew ID number missing from form submit!");
}

if(isset($_POST['last_name']) and $_POST['last_name'] != "") {
$title = $_POST['title'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$middle_name = $_POST['middle_name'];

$position_array = $_POST['position'];
if (isset($position_array)) {
$position_array = implode(",", $position_array);
} else {
$position_array = '';
}

$year_array = $_POST['year'];
if (isset($year_array)) {
$year_array = implode(",", $year_array);
} else {
$year_array = '';
}

$email = $_POST['email'];

$boat_array = $_POST['boat'];
if (isset($boat_array)) {
$boat_array = implode(",", $boat_array);
} else {
$boat_array = '';
}

$board = $_POST['board'];
$ancient_mariner = $_POST['ancient_mariner'];
$display = $_POST['display'];
$master = $_POST['master'];
$potc = $_POST['potc'];
$notes = $_POST['notes'];

// echo "Last name: $last_name<br />";
// echo "Position: $position_array<br />";

} else {
echo "Sorry, we need a last name at least.";
}


$db = new project_DB_SQL;

$update_query = "UPDATE crew SET last_name = '$last_name', first_name = '$first_name', middle_name = '$middle_name', nickname = '$nickname', title = '$title', position = '$position_array', year = '$year_array', email = '$email', boat = '$boat_array', board = '$board', ancient_mariner = '$ancient_mariner', display = '$display', master = '$master', potc = '$potc', notes = '$notes' WHERE crew_id = '$crew_id'";

$db->query($update_query);

echo "Update successful for $first_name $last_name!";

?>
<br />
<a href="crew_table_update.php">Update another crew record.</a>
</p>

</body>
</html>