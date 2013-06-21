<div id ="emailsform">
<?php
	//error_reporting(0);
	$formHTML = array(
					'id' => 'emailform'
					);
	$att = array(
					'class' => 'signin'
					);
	echo form_open('home/email',$formHTML);
	echo "<h1> Check the Tables</h1>";

	$casesummary = array(
    'name'        => 'casesummary',
    'id'          => 'casesummary',
    'value'       => 'accept',
    'checked'     => TRUE,
    'style'       => 'margin:10px',
    );
    $projectslist = array(
    'name'        => 'projectslist',
    'id'          => 'projectslist',
    'value'       => 'accept',
    'checked'     => TRUE,
    'style'       => 'margin:10px',
    );
    $inputSubmit = array(
						'type' =>'submit',
                        'name' =>'emailform',
						'value' =>'Send',
						'id'	=>'button'
						);
    $statusreport = array(
    'name'        => 'statusreport',
    'id'          => 'statusreport',
    'value'       => 'accept',
    'checked'     => TRUE,
    'style'       => 'margin:10px',
    );

	echo form_label('Case Summary','casesummary',$att).' '.form_checkbox($casesummary)."<br/><br/>";

	echo form_label('Status Report','statusreport',$att).' '.form_checkbox($statusreport)."<br/><br/>";

	echo form_label('Project List','projectslist',$att).' '.form_checkbox($projectslist)."<br/>";

	echo form_submit($inputSubmit);
	
	echo form_close();

?>
</div>