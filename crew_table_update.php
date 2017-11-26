<?php
include("../../class.mysql.php");
include("../../class.config.php");
include("../../store/functions.php");
?>

<html>
<title>Crew Table Update</title>
<head>
<script type="text/javascript" src="crew_list.js"></script>
<link href="../style-sheet1.css" rel="stylesheet" type="text/css" media="all">
</head>
<body>
<p class="master-content">Update Crew Record | <a href="crew_table_input.php">Create a Crew Record</a></p>

<p class="master-content">
<?php
$alphabet = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
echo "| ";
$db = new project_DB_SQL;

foreach ($alphabet as $value) {
  $q = "SELECT * FROM crew WHERE last_name LIKE '" . $value . "%'";
  $db->query($q);
  $rows = $db->num_rows();
  if ($rows != 0) {
    echo "<a href=\"javascript:showList('$value')\">" . $value . "</a> | ";
    } else {
    echo $value . " | ";
    }
  }
?>
<br /><br />

<div class="master-content" id="crew_list">List appears here.</div>

<br />

<div class="master-content" id="show_form">Crew update form appears here.</div>

</p>
</body>
</html>
