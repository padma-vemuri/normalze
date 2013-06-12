<html>
<head>
	<title>Reset Your Password</title>
</head>
<body>
	<?php
		$formHTML = array(
					'id' => 'form',
					//'action' => 'login/validate'
					); 
		if(isset($this->session->userdata['error']))
                    echo $this->session->userdata['error'];
		echo form_open('login/setpassword',$formHTML);
		echo "<h2> Set your New Password</h2>";
		echo "<br/>";

		$Newpassword = array(
						'name' =>'password',
						'id'   =>'password',
						'placeholder'=>'New Password',
						'maxlength' => '18',
						'size' => '24'
			);

		$Conpassword = array(
						'name' =>'conpassword',
						'id'   =>'conpassword',
						'placeholder'=>'Confirm Password',
						'maxlength' => '18',
						'size' => '24'
			);


		echo form_label('NewPassword','Newpassword');

		echo form_password($Newpassword); 
		echo "<br/><br/>";
		echo form_label('Confirm','Confirmpassword');
		echo form_password($Conpassword);
		$inputSubmit = array(
						'type' =>'submit',
						'value' =>'Confirm',
						'id'	=>'button');

	
		echo "<br/><br/>";
		echo form_submit($inputSubmit);
	
		echo form_close();
	?>

</body>
</html>