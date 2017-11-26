<?php
include("../../class.mysql.php");
include("../../class.config.php");
include("../../store/functions.php");

$q=$_GET["q"];

$db = new project_DB_Sql;
$qry = "SELECT `crew_id`, `last_name`, `first_name` FROM `crew` WHERE `last_name` LIKE '" . $q . "%' ORDER BY `last_name`, `first_name`";
$db->query($qry);

echo "Results of search on letter '<strong>" . $q . "</strong>'";
echo "<form name=\"select_crew\" id=\"select_crew\" method=\"get\" action=\"ajax/select_crew.php\">\n";
echo "<select name=\"id\" size=\"1\" onChange=\"selectCrew(this.form)\">\n";
echo "<option value=\"\">--select a name--</option>\n";

while($db->next_record()) {
  $id = $db->f('crew_id');
  $l = $db->f('last_name');
  $f = $db->f('first_name');

  echo "<option value=\"" . $id . "\">" . $l . ", " . $f . "</option>\n";

}

echo "</select>\n</form>";

?>
