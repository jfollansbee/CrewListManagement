<?php
include("../../class.mysql.php");
include("../../class.config.php");
include("../../store/functions.php");

$db = new project_DB_Sql;

// Get the boats into a hash
$boat_arr[0]='unknown';
$content_qry = 'SELECT `boat_id`,`boat`FROM `crew_boat`';
$db->query($content_qry);
while($db->next_record()) {
  $key = $db->f('boat_id');
  $value = $db->f('boat');
  $boat_arr[$key]=$value;
}
$db->free();

// Get the jobs into a hash
$job_arr[0]='unknown';
$content_qry = 'SELECT `position_id`,`position`FROM `crew_position` ORDER BY position';
$db->query($content_qry);
while($db->next_record()) {
  $key = $db->f('position_id');
  $value = $db->f('position');
  $job_arr[$key]=$value;
}
$db->free();

?>

<html>
<title>Who's Working Now?</title>
<head>
<script type="text/javascript" src="crew_list.js"></script>

<link href="../style-sheet1.css" rel="stylesheet" type="text/css" media="all">
</head>
<body>
<p class="master-content">Who's Working Now?</p>

<?php

// We only want these positions and boats. We really ought to do this with a database query.
$pos_id = array(1,9,7,4,6,10,17,14); // master, first mate, engineer, bosun, education officer, purser, cook, steward
$boat_id = array(1,2); // LW and HC

foreach($pos_id as $key) {
  echo "Value: " . $job_arr[$key] . "<br />";
  }

?>

<p class="master-content">Assign crew to boat and position for display.</p>

<script language="javascript" src="calendar/calendar.js"></script>

<p class="master-content">
<?php
$alphabet = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
echo "| ";

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
$db->free();

?>
<br /><br />

<div class="master-content" id="crew_list">List appears here.</div>

<script language="javascript" src="calendar.js"></script>

<form action="crew_today_input.php" method="POST">
<?php

//get class into the page
require_once('classes/tc_calendar.php');

//instantiate class and set properties
$myCalendar = new tc_calendar("date1", true);
$myCalendar->setIcon("images/iconCalendar.gif");
$myCalendar->setDate(1, 1, 2009);
//output the calendar
$myCalendar->writeScript();

echo "&nbsp;--||--&nbsp;";

//instantiate class and set properties
$myCalendar = new tc_calendar("date2", true);
$myCalendar->setIcon("images/iconCalendar.gif");
$myCalendar->setDate(31, 12, 2009);
//output the calendar
$myCalendar->writeScript();

?>
<br />
<input type="button" name="button" id="button" value="Check the value" onClick="javascript:alert('Date selected from '+this.form.date1.value+' to '+this.form.date2.value);">
<input type="submit" value="submit">
</form>


</p>

</body>
</html>