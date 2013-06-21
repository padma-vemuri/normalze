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

		echo "<h1 id=\"reset\"> Set your New Password</h1>";
		echo "<br/>";
		$att = array(
					'class' => 'signin');
		
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


		echo form_label('New Password','Newpassword',$att);
 
		echo form_password($Newpassword); echo "<div class=\"subscript\">*Password should be atleast 8 characters.</div>";
		echo "<br/><br/>";
		echo form_label('Confirm','Confirmpassword',$att);
		echo form_password($Conpassword);
		$inputSubmit = array(
						'type' =>'submit',
						'value' =>'Confirm',
						'id'	=>'button');

	
		echo "<br/>";
		echo form_submit($inputSubmit);
		echo "<h1 class= 'logo' style='position:absolute;right:10px; bottom:-20px;'><img src=\"/test/normalize/assets/images/ciscologo.jpg\"/> </h1>";
		echo form_close();
	?>

</body>
</html>