<div id="addform">

<?php  

	 	if($populate){

	 		foreach ($populate as $row) {
	 		$repdate = $row->ISSUE_REPORTED_DATE;
	 		$case_no = $row->CASE_NO;
	 		$project = $row->PROJECT;
	 		$gbp = $row->GBP;
	 		$application = $row->APPLICATION;
	 		$priority = $row->PRIORITY;
	 		$dbfe = $row->DB_FE;
	 		$db = $row->DB;
	 		$suppdb = $row->SUPPORTED_DB;
	 		$curanal = $row->ANALYST;
	 		$status = $row->STATUS;
	 		$relrelated = $row->RELEASE_RELATED;
	 		$summary = $row->SUMMARY;
	 		$recommendations = $row->RECOMMENDATIONS;

	 		
	 		}
	 		echo "<h2> Update</h2>";
	 	}

	 	else
	 		echo "<h2>Create </h2>";
		
	 		
	 	
		$formHTML = array(
					'id' => 'createform',
					//'action' => 'login/validate'
					); 
		
		$reporteddate = array(
						'name' =>'reporteddate',
						'id'   =>'reporteddate',
						'placeholder'=>'date',
						'type' =>'date',
						'size' => 60,
						'value'=>$repdate
	
							);

		$reporteddate1 = array(
						'name' =>'reporteddate',
						'id'   =>'reporteddate',
						'placeholder'=>'date',
						'type' =>'text',
						'size' => 20,
						'value'=>$repdate,
						'disabled'=>'disabled'
	
							);
		
		$priority =array(
					'name' => 'priority',
					'id' =>'priority',
					'size' =>20,
					'value'=>$priority

						);
		$summary =array(
					'name' => 'summary',
					'id' =>'summary',
					'rows' => 4,
					'cols' => 40,
					'maxlength'=>4000,
					'placeholder'=>'4000 characters only',
					'value' => $summary

						);
		$recommendations =array(
					'name' => 'recommendations',
					'id' =>'recommendations',
					'rows' => 4,
					'cols' => 40,
					'maxlength'=>4000,
					'placeholder'=>'4000 characters only',
					'value'=>$recommendations

						);


		$inputSubmit = array(
						'type' =>'submit',
						'value' =>'Submit',
						'id'	=>'button');

		$casenumber = array(
						'name' => 	'casenumber',
						'id'   =>  	'casenumber',
						'size' =>	20,
						'value'=> $case_no
						);
		$casenumber1 = array(
						'name' => 	'casenumber',
						'id'   =>  	'casenumber',
						'size' =>	20,
						
						'value'=> $case_no
						);


		$application = array(
						'name' => 	'application',
						'id'   =>  	'application',
						'size' =>	20,
						'value'=> $application
						);
        
		echo form_open('home/addform',$formHTML);

		if($populate){
			echo form_label('Issue Reported Date','reporteddate');
			echo form_input($reporteddate1);
			echo "<br/><br/>";
			//var_dump($prolist);
		}
		else{
			echo form_label('Issue Reported Date','reporteddate');
			echo form_input($reporteddate);
			echo "<br/><br/>";
		}
		
		/*echo form_label('casepbi','casepbi');
		echo form_dropdown('case',$casepbi);
		echo "<br/><br/>"; */
		if($populate){
			echo form_label('Case/PBI Number','casenumber');
			echo form_input($casenumber1);
			echo "<br/><br/>";
		}
		else{
			echo form_label('Case/PBI Number','casenumber');
			echo form_input($casenumber);
			echo "<br/><br/>";

		}

		if()
		echo form_label('GBP','gbp');
		//echo form_dropdown('gbplist',$gbplist,'1','id ="gbplist"');
		echo form_dropdown('gbplist',$gbplist,'1','id ="gbplist" style ="width: 160px;"');
		

		echo form_label('Project Name','project');
		echo form_dropdown('',$prolist,'1','id ="prolist" style ="width: 160px;');
		echo "<br/><br/>";

		
		
		echo form_label('Application','application');
		echo form_input($application);
		echo "<br/><br/>";

		echo form_label('Priority','priority');
		echo form_input($priority);
		echo "<br/><br/>";

		echo form_label('Datebase/FrontEnd','dbfe').form_radio('dbfe','db','id ="dbfe" value ="db"')."DB".form_radio('dbfe','fe','id ="dbfe" value ="fe"')."FE";

		
		echo "<br/><br/>";

		echo form_label('DB','db');
		echo form_input('db',$db);
		echo "<br/><br/>";

		echo form_label('Supported DB','supdb').form_radio('supdb','yes','id ="supdb" value ="yes"')."YES".form_radio('supdb','no','id ="supdb" value ="no"')."No";
		
		echo " <a id=\"suppdb\" href='http://wikicentral.cisco.com/display/PERF/List+of+Supported+Production+Databases' target=\"_blank\">Click here for the supported DB list</a>";	
		echo "<br/><br/>";



		echo form_label('Current Analyst','curral');

		echo form_dropdown('anallist',$anallist,'1','id ="anallist"style ="width: 160px;');
		echo "&nbsp;&nbsp;&nbsp;&nbsp; <u style=\"color:red;\">Note: Please enter current Analyst Only</u>";

		echo "<br/><br/>";

		echo form_label('Status','status')."".form_radio('status','open','id ="status" value ="open"')."Open".form_radio('status','closed','id ="status" value ="closed"')."Closed".
						form_radio('status','wip','id ="status" value ="wip"')."WIP".form_radio('status','resolved','id ="status" value ="resolved"')."Resolved".
						form_radio('status','recommendatation_provided','id ="status" value ="recommendatation_provided"')."Recommendation Provided".form_radio('status','waiting_for_information','id ="status" value ="waiting for information"')."Waiting For Information";
		echo "<br/><br/>";

		echo form_label('Release Related','relrelated').form_radio('relrelated','yes','id ="status" value ="yes"')."YES".form_radio('relrelated','no','id ="status" value ="no"')."NO".form_radio('relrelated','N/A','id ="status" value ="N/A"')."N/A";
		echo "<br/><br/>";

		echo "<p style=\"color:red; position:absolute; left:100px;\">Summary: Briefly state problem in your own words. Do not copy paste from &shy;<br/> 
				INC/PBI. Also please update the summary to the current status. &shy;<br/> 
				Please hit enter when you approach end of **every** line in the box.</p><br/><br/><br/><br/>";
		echo form_label('Summary','summary');

		echo form_textarea($summary);
		echo "<br/><br/>";
		echo "<p style=\"color:red; position:absolute; left:100px;\">Recommendations: Please hit enter when you approach end of line in the box.</p><br/><br/>";
		echo form_label('Recommendations','recommendations');
		echo form_textarea($recommendations);

		echo "<br/><br/>";
		echo "<button id ='button'><a id ='link' href='/normalize/index.php/home/update'>Cancel</a></button>";
		echo form_submit($inputSubmit);
		echo "<br/><br/><br/><br/><br/><br/>";

		echo form_close();
?>
</div> 