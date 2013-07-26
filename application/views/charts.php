<?php 
	$incidentSummaryJSON = json_encode($incidentSummary);
	$incidentLoggedByDateJSON = json_encode($incidentLoggedByDate);
	$incidentLoggedByProjectsJSON = json_encode($incidentLoggedByProjects);
	$incidentOpenByProjectJSON = json_encode($incidentOpenByProject);
	$closedCasesByProjectJSON = json_encode($closedCasesByProject);
?>
<div class ="charts"> 
<div class ="left"  id='incidentSummary'>Incident Summary <br/><br/></div>
<div class ="left"  id='incidentLoggedByDate'> Incident Logged By Date <br/><br/></div>
<div class ="right" id='incidentOpenByProject'> Incident Open By Project <br/><br/></div>
<div class ="right" id='incidentLoggedByProjects'><br/><br/><br/> Incident Logged By Projects</div>
<div class ="right"id='closedCasesByProject'><br/><br/><br/> Closed Cases By Project</div>
</div>

<script src="http://yui.yahooapis.com/3.11.0/build/yui/yui-min.js"></script>
<script>

YUI().use('charts', function (Y) {
    var incidentSummaryData = <?php echo $incidentSummaryJSON;?>;
    var incidentLoggedByProjectsData = <?php echo $incidentLoggedByProjectsJSON;?>;
    var incidentLoggedByDateData = <?php echo $incidentLoggedByDateJSON;?>;
 	var incidentOpenByProjectData = <?php echo $incidentOpenByProjectJSON;?>;
 	var closedCasesByProjectData = <?php echo $closedCasesByProjectJSON;?>;
    
    var gridlines = {
                            styles: {
                                line: {
                                    color: " #dad8c9"
                                }
                            }
                        };
     
 
// Instantiate and render the chart
var incidentSummary = new Y.Chart({

    dataProvider: incidentSummaryData,
    render: "#incidentSummary",
    title:"incidentSummary",
    type: 'bar',
    categoryKey: "LABEL",
    alwaysShowZero:true,
    horizontalGridlines:gridlines ,
    verticalGridlines: gridlines 
});

var incidentLoggedByProjects = new Y.Chart({
    dataProvider: incidentLoggedByProjectsData,
    render: "#incidentLoggedByProjects",
    type: 'bar',
    categoryKey: "PROJECT",
    alwaysShowZero:true,
    horizontalGridlines:gridlines, 
    verticalGridlines:gridlines
});
var incidentLoggedByDate = new Y.Chart({
    dataProvider: incidentLoggedByDateData,
    render: "#incidentLoggedByDate",
    type: 'bar',
    categoryKey: "LABEL",
    alwaysShowZero:true,
    horizontalGridlines:gridlines, 
    verticalGridlines:gridlines
});
var incidentOpenByProject = new Y.Chart({
    dataProvider: incidentOpenByProjectData,
    render: "#incidentOpenByProject",
    type: 'bar',
    categoryKey: "LABEL",
    alwaysShowZero:true,
    horizontalGridlines:gridlines, 
    verticalGridlines:gridlines
});
var closedCasesByProject = new Y.Chart({
    dataProvider: closedCasesByProjectData,
    render: "#closedCasesByProject",
    type: 'bar',
    categoryKey: "LABEL",
    alwaysShowZero:true,
    horizontalGridlines:gridlines, 
    verticalGridlines:gridlines
});



});



</script>