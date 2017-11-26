var xmlHttp;

function showList(str)
{
if (str.length==0)
 { 
 document.getElementById("crew_list").
 innerHTML="";
 document.getElementById("crew_list").
 style.border="0px";
 return;
 }

xmlHttp=GetXmlHttpObject()

if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request");
 return;
 } 

var url="crew_list.php";
url=url+"?q="+str;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
} // end function showList


function stateChanged() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 { 
 document.getElementById("crew_list").
 innerHTML=xmlHttp.responseText;
// document.getElementById("crew_list").
// style.border="1px solid #A5ACB2";
 } 
} // end function stateChanged


function selectCrew(crewForm) {
  // formAction = crewForm.action;
  var crew_id = crewForm.id.options[crewForm.id.options.selectedIndex].value;

//  alert(crew_id);
//  return;

if (crew_id.length==0)
 { 
 document.getElementById("show_form").
 innerHTML="";
 document.getElementById("show_form").
 style.border="0px";
 return;
 }

xmlHttp=GetXmlHttpObject()

if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request");
 return;
 } 

var url="get_crew.php";
url=url+"?q="+crew_id;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChangedForm ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
} // end function selectCrew

function stateChangedForm() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 { 
 document.getElementById("show_form").
 innerHTML=xmlHttp.responseText;
// document.getElementById("show_form").
// style.border="1px solid #A5ACB2";
 } 
} // end function stateChangedForm


function GetXmlHttpObject()
{
var xmlHttp=null;
try
 {
 // Firefox, Opera 8.0+, Safari
 xmlHttp=new XMLHttpRequest();
 }
catch (e)
 {
 // Internet Explorer
 try
  {
  xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
  }
 catch (e)
  {
  xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
 }
return xmlHttp;
}