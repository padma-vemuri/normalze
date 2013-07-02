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
		
		echo form_open('login/validate',$formHTML);

        
		echo "<h1> Login </h1><br/>";
		
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
						'value' =>'Log in',
						'id'	=>'button');

		echo form_input($inputUsername);
		echo "<br/><br/><div id=\"loginjs\" style =\"top:175px;right:30px; position:absolute;\" class =\"jqoutput\"></div>";

		echo form_label('Password', 'password',$att);
		$inputPassword= array(
				'name' =>'password',
				'id'   =>'password',
				'class' =>'signin',
				'Required' =>'Required',
				'placeholder'=>'password',
				'maxlength' => '18',
				'size' => '24'
				);
		echo form_password($inputPassword);
		echo "<br/><br/><div id=\"passwordjs\" style =\"top:245px;right:30px; position:absolute;\" class =\"jqoutput\"></div>";
		echo "<br/><br/>";

		echo form_submit($inputSubmit);
		 
		echo "<br/>";
		echo anchor('login/new', 'Sign up?');
		echo "<br/>";
	    echo "<h1 class= 'logo' style='position:absolute;right:10px; bottom:-20px;'><img src=\"/test/normalize/assets/images/ciscologo.jpg\"/> </h1>";
		echo form_close();

	?>
</div>
