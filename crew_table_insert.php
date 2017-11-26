<?php
include("../../class.mysql.php");
include("../../class.config.php");
include("../../store/functions.php");
?>

<html>
<title>Crew Table Insert</title>
<head>
<link href="../style-sheet1.css" rel="stylesheet" type="text/css" media="all">
</head>
<body>
<p class="master-content">Insert Results for Crew Table | <a href="crew_table_input.php">Create Another Crew Record</a> | <a href="crew_table_update.php">Update a Crew Record</a></p>

<p class="master-content">
<?php

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

// echo $last_name . "<br />";
// echo $position_array . "<br />";

} else {
echo "Sorry, we need a last name at least.";
}


$db = new project_DB_SQL;

$insert_query = " INSERT INTO `histbea5_test`.`crew` (
`crew_id` ,
`last_name` ,
`first_name` ,
`middle_name` ,
`nickname` ,
`title` ,
`position` ,
`year` ,
`email` ,
`boat` ,
`board` ,
`ancient_mariner` ,
`display` ,
`master` ,
`potc` ,
`notes` 
)
VALUES (
NULL , '$last_name', '$first_name', '$middle_name', '$nickname', '$title', '$position_array', '$year_array', '$email', '$boat_array', '$board', '$ancient_mariner', '$display', '$master', '$potc', '$notes'
)";

$db->query($insert_query);

echo "<br />Record for $first_name $last_name successfully created!";

?>
</p>

</body>
</html>