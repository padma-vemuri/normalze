<div id= "formdiv">
	<?php 
		error_reporting(0);
		echo $this->session->userdata['error'];
        $this->session->unset_userdata('error');
		
		$formHTML = array(
					'id' => 'form',
					//'action' => 'login/validate'
					);
		$att = array(
					'class' => 'signin');
		
		echo form_open('home/emailsupport',$formHTML);

        
		echo "<h1> Report a Problem </h1><br/>";
		
		echo form_label('Username', 'username',$att);
		$inputUsername = array(
				'name' =>'username',
				'id'   =>'userid',
				'class' =>'signin',
				'Required' =>'Required',
				'placeholder'=>'ccid',
				'maxlength' => '18',
				'size' => '24'
				);
		$inputSubmit = array(
						'type' =>'submit',
						'value' =>'Send',
						'id'	=>'button');

		echo form_input($inputUsername);
		echo "<br/><br/><div id=\"loginjs\" style =\"top:175px;right:30px; position:absolute;\" class =\"jqoutput\"></div>";

		echo form_label('Issue', 'issue',$att);
		$inputProblem = array(
				'name' =>'problem',
				'id'   =>'problem',
				'class' =>'signin',
				'Required' =>'Required',
				'placeholder'=>'Describe your problem here. Keep it short.',
				'rows' => 8,
				'cols' => 40,
				);
		echo form_textarea($inputProblem);
		echo "<br/><br/><div id=\"passwordjs\" style =\"top:245px;right:30px; position:absolute;\" class =\"jqoutput\"></div>";

		echo form_submit($inputSubmit);
		 
		
		echo "<br/>";
	    echo "<h1 class= 'logo' style='position:absolute;right:10px; bottom:-20px;'><img src=\"/test/normalize/assets/images/ciscologo.jpg\"/> </h1>";
		echo form_close();

	?>
</div>

