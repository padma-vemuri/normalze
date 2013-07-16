<?php
error_reporting(0);

foreach ($openCount as $row) {
  echo "<p class = 'countIssues'><b>Open :</b> ".$row->OPEN.' | ' ;
}
foreach ($closedCount as $row) {
  echo " <b>Closed :</b> ".$row->CLOSED.' | ' ;
}
foreach ($othersCount as $row) {
  echo "<b> Rest: </b>".$row->OTHERS.' </p> ' ;
}


?>
<table  class="curvedEdges" style = "position:absolute; top:260px;">
  <tr style="background-color:lightblue;white-space:nowrap;text-align:left;">
    
    <th>Date</th>
    <th>Issue Number</th>
    <th>Application</th>    
    <th>Priority</th>  
    <th>DB/FE</th>
    <th>Database</th>
    <th>Supported DB </th>
    <th>Analyst</th>
    <th>Status</th>
    <th>Release Related</th>
    <th>Recommendations</th>
    <th>Summary</th>
    <th>Case/PBI</th>    
      
  </tr>

<?php 
error_reporting(0);
$view ='VI';
foreach($query as $row){

    $search = preg_replace('/\(|\)/','',$row->CaseNo);
    $search = preg_replace('/\ |\ /','',$search);
     
     $pattern = '/Paged/';
     $replacement = '';
   $incnumber = preg_replace($pattern,$replacement ,$search); 
  echo "<tr class =\"hover\" style=\"border:0px;\">";

    //echo "<td> <a id='link' href=''>Edit</a></td>"

    echo "<td >". $row->IssueReportedDate ."</td>";
 	//echo "<td>". $row->CaseNo ."</td>";  

 	echo  "<td  >"."<a href='' style=\"color:blue;\" onclick =\"javascript: window.open('view/".$incnumber."', 'window_name', 'width = 250, height = 250,scrollbars=yes');\">Audit</a>".anchor('home/create/'.$incnumber, $row->CaseNo,array('id'=>'edit'))."</td>"; 
  echo "<td style='word-wrap:break-word;'>". $row->Application ."</td>";
 	echo "<td style='word-wrap:break-word;' >". $row->Priority ."</td>";
 	echo "<td   style='text-align:center;'>". $row->DBFE ."</td>";
 	echo "<td >". $row->Database ."</td>";  
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
