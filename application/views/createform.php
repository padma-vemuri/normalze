	<div id="errordiv">
		<?php
		echo $this->session->userdata['errorlog'];
    	$this->session->unset_userdata('errorlog'); 
    	?>
	</div>


	<div id="addform">

<?php  

	error_reporting(0);
	 	if($populate){

	 		foreach ($populate as $row) {
	 			$id      = $row->ID;
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
	 		
	 	}


		$formHTML = array(
					'id' => 'createform',
					'name'=> 'createform'
					//'action' => 'login/validate'
					); 
		
		$reporteddate = array(
						'name' =>'reporteddate',
						'id'   =>'reporteddate',
						'placeholder'=>'DD-MM-YYYY',
						'type' =>'text',
						'required' =>'required',
						'size' => 21,
						'value'=>$repdate,
						'readOnly'=>'readOnly'
	
							);
		$reporteddate1 = array(
						'name' =>'reporteddate1',
						'id'   =>'reporteddate',
						'type' =>'text',
						'size' => 21,
						'value'=>$repdate,
						'disabled'=>'disabled'
	
							);
		
		$priority =array(
					'name' => 'priority',
					'id' =>'priority',
					'rows' =>3,
					'cols' =>20,
					'required' =>'required',
					'value'=>$priority

						);
		$summary =array(
					'name' => 'summary',
					'id' =>'summary',
					'rows' => 4,
					'required' =>'required',
					'cols' => 40,
					'value' => $summary

						);
		$recommendations =array(
					'name' => 'recommendations',
					'id' =>'recommendations',
					'rows' => 4,
					'required' =>'required',
					'cols' => 40,
					'value'=>$recommendations

						);


		$inputSubmit = array(
						'type' =>'submit',
						'value' =>'Save',
						'id'	=>'button',
						'name' =>'submit',
						'onclick'=>'return confirm(\'Please Confirm !\');');
		$inputDelete= array(
						'type' =>'submit',
						'value' =>'Delete',
						'id'	=>'button',
						'name' =>'delete',
						'style' =>'top:10px',
						'onclick'=>'return confirm(\'Do really want to delete this Issue/Case ? \');');

		$casenumber = array(
						'name' => 	'casenumber',
						'id'   =>  	'casenumber',
						'required' =>'required',
						'size' =>	21,
						'maxlength' =>22,
						'value'=> $case_no
						);
		$application = array(
						'name' => 	'application',
						'id'   =>  	'application',
						'rows' => 3,
						'cols' => 20,
						'maxlength' => 200,
						'required' =>'required',
						'value'=> $application
						);
		$db = array(
						'name' => 	'db',
						'id'   =>  	'db',
						'required' =>'required',
						'size' =>	21,
						'required' =>'required',
						'value'=> $db
						);
		
		echo form_open('home/addform',$formHTML);

		
        echo form_hidden('caseid',$id);
        $url = $_SERVER['REQUEST_URI'];
        echo form_hidden('url',$url);
		
		if($populate){	
			echo form_submit($inputDelete);
			
			echo"<input type='button' id=\"button\" name ='cancel' value=\"Cancel\" 
				onclick=\" var result = confirm('Do really want to Cancel ?'); 
					if(result == true)
						window.history.back();
					else
						 return false;;\" />";
			echo form_submit($inputSubmit); 
			echo form_label('Reported Date','reporteddate');
			echo form_input($reporteddate1);
			echo "<br/><br/>";
		}
		else{
			echo form_label('Reported Date','reporteddate');
			echo form_input($reporteddate);
			echo"<input type='button' id=\"button\" name ='cancel' value=\"Cancel\" 
					onclick=\" var result = confirm('Do really want to Cancel ?'); 
						if(result == true)
							window.history.back();
						else
						 return false;;\" />";
			echo form_submit($inputSubmit);
			 
			echo "<br/><br/>";
		}

		
	
		echo form_label('Issue Number','casenumber');
		echo form_input($casenumber);
		echo "<div id=\"casenumberjs\" style =\"top:65px;right:130px; position:absolute;\" class =\"jqoutput\"></div>";
		echo "<br/><br/>";

		echo form_label('GBP','gbp');
		//echo form_dropdown('gbplist',$gbplist,'1','id ="gbplist"');
		echo form_dropdown('gbplist',$gbplist,$gbp,'id ="gbplist" style ="width: 160px;"');
		echo "<br/><br/>";

		echo form_label('Project Name','project');
		echo form_dropdown('prolist',$prolist,$project,'id ="prolist" style ="width: 160px;');
		echo "<br/><br/>";

		
		
		echo form_label('Application','application');
		echo form_input($application);
		echo "<br/><br/>";

		echo form_label('Priority','priority');
		echo form_textarea($priority);
		echo "<br/><br/>";

		if($populate){
			if($dbfe == 'DB')
				echo form_label('DB/FE','dbfe').form_radio('dbfe','DB','checked = "TRUE"')." Database ".form_radio('dbfe','FE')." Front End";
			elseif($dbfe == 'FE')
				echo form_label('DB/FE','dbfe').form_radio('dbfe','DB')." Database ".form_radio('dbfe','FE','checked ="TRUE"')." Front End";
		}
		else 
			echo form_label('DB/FE','dbfe').form_radio('dbfe','DB','class ="rad"')." Database ".form_radio('dbfe','FE')." Front End";



		
		echo "<br/><br/>";

		echo form_label('DB','db');
		echo form_input($db);
		echo "<br/><br/>";

		if($populate){
			if($suppdb == 'Y')
				echo form_label('Supported DB','supdb').form_radio('supdb','Y','checked = "TRUE"')." Yes ".form_radio('supdb','N')." No ";				
			elseif($suppdb == 'N')
				echo form_label('Supported DB','supdb').form_radio('supdb','Y')." Yes ".form_radio('supdb','N','checked = "TRUE"')." No ";
		}
		else
			echo form_label('Supported DB','supdb').form_radio('supdb','Y','class ="rad"')." Yes ".form_radio('supdb','N')." No ";
		
		echo " <a id=\"suppdb\" href='http://wikicentral.cisco.com/display/PERF/List+of+Supported+Production+Databases' target=\"_blank\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Click here for the supported DB list</a>";	
		
		echo "<br/><br/>";



		echo form_label('Current Analyst','curanal');

		echo form_dropdown('anallist',$anallist,$curanal,'id ="anallist"style ="width: 160px;');
		echo "&nbsp;&nbsp;&nbsp;&nbsp; <u style=\"color:darkred;\">Note: Please enter current Analyst Only</u>";
		echo "<br/><br/>";

		if($populate){
			switch ($status) {
				case 'Open':
					echo form_label('Status','status')."".form_radio('status','Open','checked ="TRUE"')." Open ".form_radio('status','Closed')." Closed ".
						form_radio('status','WIP')." WIP ".form_radio('status','Resolved')." Resolved ".
						form_radio('status','Recommendations Provided')." Recommendations Provided ".
						form_radio('status','Waiting For Information')." Waiting For Information ";			
					break;
				case 'Closed':
					echo form_label('Status','status')."".form_radio('status','Open')." Open ".form_radio('status','Closed','checked ="TRUE"')." Closed ".
						form_radio('status','WIP')." WIP ".form_radio('status','Resolved')." Resolved ".
						form_radio('status','Recommendations Provided')." Recommendations Provided ".
						form_radio('status','Waiting For Information')." Waiting For Information ";
					break;
				case  'WIP':
					echo form_label('Status','status')."".form_radio('status','Open')." Open ".form_radio('status','Closed')." Closed ".
						form_radio('status','WIP','checked ="TRUE"')." WIP ".form_radio('status','Resolved')." Resolved ".
						form_radio('status','Recommendations Provided')." Recommendations Provided ".
						form_radio('status','Waiting For Information')." Waiting For Information ";
					break;
				case 'Resolved':
					echo form_label('Status','status')."".form_radio('status','Open')." Open ".form_radio('status','Closed')." Closed ".
						form_radio('status','WIP')." WIP ".form_radio('status','Resolved','checked ="TRUE"')." Resolved ".
						form_radio('status','Recommendations Provided')." Recommendations Provided ".
						form_radio('status','Waiting For Information')." Waiting For Information ";
					break;
				case 'Recommendations Provided':
					echo form_label('Status','status')."".form_radio('status','Open')." Open ".form_radio('status','Closed')." Closed ".
						form_radio('status','WIP')." WIP ".form_radio('status','Resolved')." Resolved ".
						form_radio('status','Recommendations Provided','checked ="TRUE"')." Recommendations Provided ".
						form_radio('status','Waiting For Information')." Waiting For Information ";
					break;
				case 'Waiting For Information':
					echo form_label('Status','status')."".form_radio('status','Open')." Open ".form_radio('status','Closed')." Closed ".
						form_radio('status','WIP')." WIP ".form_radio('status','Resolved')." Resolved ".
						form_radio('status','Recommendations Provided')." Recommendations Provided ".
						form_radio('status','Waiting For Information','checked ="TRUE"')." Waiting For Information ";
					break;
				default:
					# code...
					break;
			}

		}
		else
			echo form_label('Status','status')."".form_radio('status','Open','class ="rad"')." Open ".form_radio('status','Closed')." Closed ".
						form_radio('status','WIP')." WIP ".form_radio('status','Resolved')." Resolved ".
						form_radio('status','Recommendations Provided')." Recommendations Provided ".
						form_radio('status','Waiting For Information')." Waiting For Information ";
		
		echo "<br/><br/>";

		if($populate){
			if($relrelated == 'Y')
				echo form_label('Release Related','relrelated').form_radio('relrelated','Y','checked = "TRUE"')." Yes ".form_radio('relrelated','N')." No ".form_radio('relrelated','N/A')." N/A ";
			elseif($relrelated == 'N')
				echo form_label('Release Related','relrelated').form_radio('relrelated','Y')." Yes ".form_radio('relrelated','N','checked = "TRUE"')." No ".form_radio('relrelated','N/A')." N/A ";	
			elseif($relrelated == 'N/A')
				echo form_label('Release Related','relrelated').form_radio('relrelated','Y')." Yes ".form_radio('relrelated','N')." No ".form_radio('relrelated','N/A','checked = "TRUE"')." N/A ";		
		}
		else
			echo form_label('Release Related','relrelated').form_radio('relrelated','Y','class ="rad"')." Yes ".form_radio('relrelated','N')." No ".form_radio('relrelated','N/A')." N/A ";
		echo "<br/>";
		
		echo "<p style=\"color:darkred; position:absolute; line-height: 1.2em; left:140px;\">Summary: Briefly state problem in your own words. Do not copy paste from &shy;<br/> 
				INC/PBI. Also please update the summary to the current status. &shy;<br/> 
				Please hit enter when you approach end of **every** line in the box.</p><br/><br/><br/><br/><br/>";

		echo form_label('Summary','summary');
		echo form_textarea($summary);
		echo "<br/>";
		echo "<p style=\"color:darkred; position:absolute; left:140px;\">Recommendations: Please hit enter when you approach end of line in the box.</p><br/><br/><br/>";
		echo form_label('Recommendations','recommendations');
		echo form_textarea($recommendations);

		echo "<br/><br/>";
		
		
		if($populate)
			echo form_submit($inputDelete);
		
		echo"<input type='button' id=\"button\" name ='cancel' value=\"Cancel\" 
				onclick=\" var result = confirm('Do really want to Cancel ?'); 
					if(result == true)
						window.history.back();
					else
						 return false;;\" />";
		echo form_submit($inputSubmit); 
		echo "<h1 class= 'logo' style='position:absolute;right:5px; bottom:-23px;'><img src=\"/test/normalize/assets/images/ciscologo32.jpg\"/> </h1>";
		echo form_close();
?>
</div> 