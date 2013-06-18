<div name ="body" id ="search" class ="body">
<?php
error_reporting(0);
echo "<br/>";
$formHTML = array(
					'id' => 'search');
echo form_open('home/search',$formHTML);

$list = array(
		 'CASE_NO'  => 'Issue Number',
		 'ISSUE_REPORTED_DATE' =>'Reported Date',
		 'APPLICATION' =>'Application',
		 'DB_FE' =>	'DB/FE',
		 'DB'	=>'Database',
		 'SUPPORTED_DB' =>'Supported DB',
		 'STATUS'  =>'Status',
		 'CASE_PBI' =>'Case PBI',
		 'RELEASE_RELATED' =>'Release Relates',
		 'ANALYST' =>'Analyst'
			);

$inputUsername = array(
				'name' =>'search',
				'class'   =>'search',
				'placeholder'=>'Search here..',
				'maxlength' => '1300',
				'size' => '20',
				'height' => '30px'
				);

$inputSubmit = array(
						'type' =>'submit',
						'value' =>'Submit',
						'id'	=>'button');

echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo  "Search&nbsp;&nbsp;&nbsp;".form_input($inputUsername);
echo "&nbsp;&nbsp;&nbsp;&nbsp;By&nbsp;&nbsp;&nbsp;".form_dropdown('list',$list,'1','id ="list" class ="search" style =""');
//echo form_dropdown>

echo "&nbsp;&nbsp;&nbsp;".form_submit($inputSubmit);

form_close();
?>
</div>