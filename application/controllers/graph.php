

<?php
  // This function is used to connect to the database with userid and password are hard coded.
  require_once ('/assets/jpgraph/src/jpgraph.php');
  require_once ('/assets/jpgraph/src/jpgraph_bar.php');

 function see(){
 
$datay=array(10,18,29);
 
// Size of graph
$width=400;
$height=500;
 
// Set the basic parameters of the graph
$graph = new Graph($width,$height);
$graph->SetScale('textlin');
 
$top = 60;
$bottom = 30;
$left = 80;
$right = 30;
$graph->Set90AndMargin($left,$right,$top,$bottom);
 
// Nice shadow
$graph->SetShadow();
 
// Setup labels

$Yaxis = ['padma','kumar','venmuri'];
$graph->xaxis->SetTickLabels($Yaxis);
 
// Label align for X-axis
$graph->xaxis->SetLabelAlign('right','center','right');
 
// Label align for Y-axis
$graph->yaxis->SetLabelAlign('center','bottom');
 
// Titles
$graph->title->Set('Number of incidents');
 
// Create a bar pot
$bplot = new BarPlot($datay);
$bplot->SetFillColor('orange');
$bplot->SetWidth(0.5);
$bplot->SetYMin(10);
 
$graph->Add($bplot);
 
$graph->Stroke();

}

see();
?>