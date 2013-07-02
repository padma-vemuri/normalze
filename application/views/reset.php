
<div id = 'resetform' >
	<p> If you are seeing this page, you are either a new user or you asked for a password reset.</p>
	
	<fieldset>
			<b>Password Requirements</b><br/>
			<ul class="passwordReset">
			<li class="passwordReset" >1) We suggest it be same as your cisco pasword to avoid confusion.</li>
			<li class="passwordReset" >2) It should atleast be 8 characters.</li>
			<li class="passwordReset" >3) It can't be your ccid </li>
			</ul>
	</fieldset>
	<br/>
	<br/>
	<?php
		error_reporting(0);
		echo $this->session->userdata['error'];
        $this->session->unset_userdata('error');
		$formHTML = array(
					'id' => 'form',
					//'action' => 'login/validate'
					); 
		echo form_open('login/setpassword',$formHTML);

		echo "<h1 id=\"reset\"> Set your New Password</h1>";
		echo "<br/>";
		$att = array(
					'class' => 'signin');
		
		$Newpassword = array(
						'name' =>'password',
						'id'   =>'password',
						'Required' => 'Required',
						'placeholder'=>'New Password',
						'maxlength' => '18',
						'size' => '24'
			);

		$Conpassword = array(
						'name' =>'conpassword',
						'id'   =>'conpassword',
						'placeholder'=>'Confirm Password',
						'Required' =>'Required',
						'maxlength' => '18',
						'size' => '24'
			);


		echo form_label('New Password','Newpassword',$att);
 
		echo form_password($Newpassword); //echo "<div class=\"subscript\">*Password should be atleast 8 characters.</div>";
		echo "<br/><br/>";
		echo form_label('Confirm','Confirmpassword',$att);
		echo form_password($Conpassword);
		$inputSubmit = array(
						'type' =>'submit',
						'value' =>'Confirm',
						'id'	=>'button');

		echo "<div class=\"redjs\"></div>";echo "<div class=\"greenjs\"></div>";
		echo "<br/><br/>";
		echo form_submit($inputSubmit);
		echo "<h1 class= 'logo' style='position:absolute;right:10px; bottom:-20px;'><img src=\"/test/normalize/assets/images/ciscologo.jpg\"/> </h1>";
		echo form_close();
	?>

</div>
