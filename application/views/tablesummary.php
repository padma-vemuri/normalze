<?php
error_reporting(0);
echo "<table class ='countIssues'> 
			<tr><th id= 'theaderH'  colspan = '4'> Cases </th>
				<th id= 'theaderH'  colspan = '4'> PBI</th></tr>
			
			<tr><th id = 'theader' colspan ='8'>Release Related</th> </tr>
			";
echo " <tr><th  id= 'theader2Y' colspan = '2'>Yes</th><th  id= 'theader2N' colspan = '2'>No</th>
			<th  id= 'theader2Y' colspan = '2'>Yes</th><th  id= 'theader2N' colspan = '2'>No</th> </tr>";

echo "<tr><td class ='tdataY'>"; 
foreach ($countOpenINCY as $row) {
  echo "Open: ".$row->OPEN.'' ;
}
echo "</td>";


echo "<td class ='tdataY'>";
foreach ($countClosedINCY as $row) {
  echo "Closed:   ".$row->CLOSED.'' ;
}
echo "</td>";



foreach ($countOpenINCN as $row)
  echo "<td class ='tdataN'>Open: ".$row->OPEN."</td>";

//echo "<td class ='tdataN'>Open: ";
foreach ($countClosedINCN as $row)
  echo "<td class ='tdataN'>Closed: ".$row->CLOSED."</td>";
//echo "<td class ='tdataN'>Closed: ";




echo "<td class ='tdataY'>";
foreach ($countOpenPBIY as $row) {
  echo "Open:   ".$row->OPEN.'' ;
}
echo "</td>";

echo "<td class ='tdataY'>";
foreach ($countClosedPBIY as $row) {
  echo "Closed:   ".$row->CLOSED.'' ;
}
echo "</td>";


foreach ($countOpenPBIN as $row)
  echo "<td class ='tdataN'>Open: ".$row->OPEN."</td>";

//echo "<td class ='tdataN'>Open: ";
foreach ($countClosedPBIN as $row)
  echo "<td class ='tdataN'>Closed: ".$row->CLOSED."</td>";
//echo "<td class ='tdataN'>Closed: ";

echo "</tr> </table>";

?>

