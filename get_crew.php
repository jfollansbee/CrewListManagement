<!-- script begins -->
<?php
include("../../class.mysql.php");
include("../../class.config.php");
include("../../store/functions.php");

// Get the boats into a hash
$boat_arr[0]='unknown';
$db1 = new project_DB_Sql;
$content_qry = 'SELECT `boat_id`,`boat`FROM `crew_boat`';
$db1->query($content_qry);
while($db1->next_record()) {
  $key = $db1->f('boat_id');
  $value = $db1->f('boat');
  $boat_arr[$key]=$value;
}

// Get the jobs into a hash
$job_arr[0]='unknown';
$db2 = new project_DB_Sql;
$content_qry = 'SELECT `position_id`,`position`FROM `crew_position` ORDER BY position';
$db2->query($content_qry);
while($db2->next_record()) {
  $key = $db2->f('position_id');
  $value = $db2->f('position');
  $job_arr[$key]=$value;
}

// Get the years into a hash
$year_arr[0]='unknown';
$db3 = new project_DB_Sql;
$content_qry = 'SELECT `year_id`,`year`FROM `crew_year` ORDER BY year';
$db3->query($content_qry);
while($db3->next_record()) {
  $key = $db3->f('year_id');
  $value = $db3->f('year');
  $year_arr[$key]=$value;
}

$q=$_GET["q"];

$db4 = new project_DB_Sql;
$content_qry = "SELECT crew_id, last_name, first_name, middle_name, nickname, title, position, year, email, boat, board, ancient_mariner, display, master, potc, notes FROM crew WHERE crew_id = '".$q."'";
$db4->query($content_qry);

while($db4->next_record()) {
  $crew_id = $db4->f('crew_id');
  $last_name = $db4->f('last_name');
  $first_name = $db4->f('first_name');
  $middle_name = $db4->f('middle_name');
  $nickname = $db4->f('nickname');
  $title = $db4->f('title');
  $position = $db4->f('position');
  $year = $db4->f('year');
  $email = $db4->f('email');
  $boat = $db4->f('boat');
  $board = $db4->f('board');
  $ancient_mariner = $db4->f('ancient_mariner');
  $display = $db4->f('display');
  $master = $db4->f('master');
  $potc = $db4->f('potc');
  $notes = $db4->f('notes');
}

$boats = explode(',', $boat);
$all_boats = array();
for($i=0;$i<count($boats);$i++)
   {
   $key = $boats[$i]; 
   array_push($all_boats, $boat_arr[$key]);
   }
$show_boats = implode(", ", $all_boats);

if ($position != "") {
  $jobs = explode(',', $position);
  $all_jobs = array();
  for($i=0;$i<count($jobs);$i++)
     {
     $key = $jobs[$i]; 
     array_push($all_jobs, $job_arr[$key]);
     }
  $show_jobs = implode(", ", $all_jobs);
} else {
  $show_jobs = "?";
}

if ($year != "") {
  $years = explode(',', $year);
  $all_years = array();
  for($i=0;$i<count($years);$i++)
     {
     $key = $years[$i]; 
     array_push($all_years, $year_arr[$key]);
     }
  $show_years = implode(", ", $all_years);
} else {
  $show_years = "?";
}

echo "<form id=\"update_crew\" action=\"update_crew.php\" method=\"POST\">\n";
echo "<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"550\">
     <tr>
     <td class=\"master-content\">
     <input type=\"hidden\" name=\"crew_id\" value=\"$crew_id\">
     Last name: <input type=\"text\" name=\"last_name\" size=\"12\" value=\"$last_name\"/>
     </td>
     <td class=\"master-content\">
     First name: <input type=\"text\" name=\"first_name\" size=\"12\" value=\"$first_name\"/>
     </td>
     </tr>
     <tr>
     <td class=\"master-content\">
     Middle name: <input type=\"text\" name=\"middle_name\" size=\"12\" value=\"$middle_name\"/>
     </td>
     <td class=\"master-content\">
     Nickname: <input type=\"text\" name=\"nickname\" size=\"12\" value=\"$nickname\"/>
     </td>
     </tr>
     <tr>
     <td class=\"master-content\">
     Title: <input type=\"text\" name=\"title\" size=\"12\" value=\"$title\"/>
     </td>
     </tr><tr><td class=\"master-content\" valign=\"top\">";

echo "Position (select one or more)<br />";
$db5 = new project_DB_SQL;
$sql = "SELECT `position_id`, `position` FROM `crew_position` ORDER BY `position`";
$db5->query($sql);
$num_rows = $db5->num_rows();
echo "<select multiple name=\"position[]\" size=\"" . $num_rows . "\">\n";
while ($db5->next_record()) {
  $selected = "";
  $position_id = $db5->f('position_id'); 
  $position = $db5->f('position');
    for($i=0;$i<count($jobs);$i++) {
      if ($jobs[$i] == $position_id) {
      $selected = "SELECTED";
      break;
      }
    }
  echo "<option value=\"" . $position_id . "\" " . $selected . ">$position</option>\n"; 
}
echo "</select>";
echo "</td><td class=\"master-content\" valign=\"top\">";

echo "Years served (select one or more)<br />";

$db6 = new project_DB_SQL;
$sql = "SELECT `year_id`, `year` FROM `crew_year` ORDER BY `year`";
$db6->query($sql);
$num_rows = $db6->num_rows();
echo "<select multiple name=\"year[]\" size=\"" . $num_rows . "\">\n";
while ($db6->next_record()) {
  $selected = "";
  $year_id = $db6->f('year_id'); 
  $year = $db6->f('year');
    for($i=0;$i<count($years);$i++) {
      if ($years[$i] == $year_id) {
      $selected = "SELECTED";
      break;
      }
    }
  echo "<option value=\"" . $year_id . "\" " . $selected . ">$year</option>"; 
}
echo "</select>\n<br /><br />";

echo "Boat (select one or more)<br />";
$db7 = new project_DB_SQL;
$sql = "SELECT `boat_id`, `boat` FROM `crew_boat` ORDER BY `boat_id`";
$db7->query($sql);
$num_rows = $db7->num_rows();
echo "<select multiple name=\"boat[]\" size=\"" . $num_rows . "\">\n";
while ($db7->next_record()) {
  $selected = "";
  $boat_id = $db7->f('boat_id'); 
  $boat = $db7->f('boat');
    for($i=0;$i<count($boats);$i++) {
      if ($boats[$i] == $boat_id) {
      $selected = "SELECTED";
      break;
      }
    }
  echo "<option value=\"" . $boat_id . "\" " . $selected . ">$boat</option>"; 
}
echo "</select><br /><br />";

echo "Board member?";
if ($board == 1) {
  echo "<input type=\"radio\" name=\"board\" value=\"1\" checked /> Yes <input type=\"radio\" name=\"board\" value=\"0\"/> No";
  } else {
  echo "<input type=\"radio\" name=\"board\" value=\"1\" /> Yes <input type=\"radio\" name=\"board\" value=\"0\" checked /> No";
  }

echo "<br /><br />";

echo "Ancient Mariner?";
if ($ancient_mariner == 1) {
  echo "<input type=\"radio\" name=\"ancient_mariner\" value=\"1\" checked /> Yes <input type=\"radio\" name=\"ancient_mariner\" value=\"0\"/> No";
  } else {
  echo "<input type=\"radio\" name=\"ancient_mariner\" value=\"1\" /> Yes <input type=\"radio\" name=\"ancient_mariner\" value=\"0\" checked /> No";
  }

echo "<br /><br />";

echo "Master?";
if ($master == 1) {
  echo "<input type=\"radio\" name=\"master\" value=\"1\" checked /> Yes <input type=\"radio\" name=\"master\" value=\"0\"/> No";
  } else {
  echo "<input type=\"radio\" name=\"master\" value=\"1\" /> Yes <input type=\"radio\" name=\"master\" value=\"0\" checked /> No";
  }

echo "<br /><br />";

echo "POTC?";
if ($potc == 1) {
  echo "<input type=\"radio\" name=\"potc\" value=\"1\" checked /> Yes <input type=\"radio\" name=\"potc\" value=\"0\"/> No";
  } else {
  echo "<input type=\"radio\" name=\"potc\" value=\"1\" /> Yes <input type=\"radio\" name=\"potc\" value=\"0\" checked /> No";
  }

echo "<br /><br />";

echo "Display?";
if ($display == 1) {
  echo "<input type=\"radio\" name=\"display\" value=\"1\" checked /> Yes <input type=\"radio\" name=\"display\" value=\"0\"/> No";
  } else {
  echo "<input type=\"radio\" name=\"display\" value=\"1\" /> Yes <input type=\"radio\" name=\"display\" value=\"0\" checked /> No";
  }

echo "<br /><br />";


echo "</td></tr><tr>
     <td class=\"master-content\">
     Email: <input type=\"text\" name=\"email\" size=\"25\" value=\"$email\"/>
     </td>
     <td class=\"master-content\">
     Notes: <input type=\"text\" name=\"notes\" size=\"35\" maxlength=\"255\" value=\"$notes\"/>
     </td>
     </tr>
     <tr>
     <td class=\"master-content\">
     <input type=\"submit\" name=\"submit\" value=\"Update!\">
     </td>
     </tr>
     </table>\n";
echo "</form>";

?> <!-- script end -->
