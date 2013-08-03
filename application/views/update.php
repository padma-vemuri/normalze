<?php
error_reporting(0);

echo "<table class ='countIssues'> <tr><th id= 'theader' colspan = '4'> Release Related </th></tr>";
echo " <tr><th  id= 'theader2Y' colspan = '2'>Yes</th><th  id= 'theader2N' colspan = '2'>No</th> </tr>";
echo "<tr><td class ='tdataY'>";
foreach ($openCount as $row) {
  echo "Open: ".$row->OPEN.'' ;
}
echo "</td>";
echo "<td class ='tdataY'>";
foreach ($closedCount as $row) {
  echo "Closed: ".$row->CLOSED.'' ;
}
foreach ($openCountNotRelated as $row)
  echo "<td class ='tdataN'>Open: ".$row->OPEN."</td>";
foreach ($closedCountNotRelated as $row)
  echo "<td class ='tdataN'>Closed: ".$row->CLOSED."</td>";

echo "</tr> </table>"

?>
<table  class="curvedEdges" style = "position:absolute; top:260px;table-layout:fixed; "  >
  <tr style="background-color:lightblue;white-space:nowrap;text-align:left;">
    
    <th>Date</th>
    <th>Issue Number</th>
    <th>GBP</th>
    <th>Project Name </th>
    <th>Application</th>    
    <th>Priority</th>  
    <th>DB/FE</th>
    <th>Database</th>
    <th>Supported DB </th>
    <th>Analyst</th>
    <th>Status</th>
    <th>Release Related</th>    
    <th>Summary</th>
    <th>Recommendations</th>
    <th>Case/PBI</th>    
      
  </tr>

<?php 
error_reporting(0);
$view ='VI';
foreach($query as $row){

    $search = preg_replace('/\(|\)/','',$row->CaseNo);
    $search = preg_replace('/\ |\ /','',$search);
     
     $pattern = '/PAGED/';
     $replacement = '';
   $incnumber = preg_replace($pattern,$replacement ,$search); 
  echo "<tr class =\"hover\" style=\"border:0px;\">";

    //echo "<td> <a id='link' href=''>Edit</a></td>"

    echo "<td style='width:60px;'>". $row->IssueReportedDate ."</td>";
 	//echo "<td>". $row->CaseNo ."</td>";  

 	echo  "<td  >"."<a href='' style=\"color:blue;\" onclick =\"javascript: window.open('view/".$incnumber."', 'window_name', 'width = 250, height = 250,scrollbars=yes');\">Audit</a>".anchor('home/create/'.$incnumber, $row->CaseNo,array('id'=>'edit'))."</td>"; 
  echo "<td style='word-wrap:break-word;'>". $row->GBP ."</td>";
  echo "<td style='word-wrap:break-word;'>". $row->Project ."</td>";
  echo "<td style='word-wrap:break-word;'>". $row->Application ."</td>";
 	echo "<td style='word-wrap:break-word;' >". $row->Priority ."</td>";
 	echo "<td   style='text-align:center;'>". $row->DBFE ."</td>";
 	echo "<td style='word-wrap:break-word;' >". $row->Database ."</td>";  
 	echo "<td  style='text-align:center;'>". $row->SupportedDB ."</td>";
 	echo "<td >". $row->Analyst ."</td>";
 	echo "<td >". $row->Status."</td>";
 	echo "<td  style='text-align:center;'>". $row->ReleaseRelated ."</td>";  
 	echo "<td style='word-wrap:break-word;' >".$row->Summary."</td>"; 
  echo "<td style='word-wrap:break-word;' >".  $row->Recommendations."</td>";
 	echo "<td style='text-align:center;'>". $row->CasePBI ."</td>";



  echo "</tr>";   

}

?>
</table>
