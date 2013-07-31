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

		
		echo form_open('login/newuser',$formHTML);
		$firstname = array(
						'name' =>'firstname',
						'id'   =>'firstname',
						'class' =>'signin',
						'Required' =>'Required',
						'placeholder'=>'FIRST NAME',
						'maxlength' => '18',
						'size' => '24'
						);
		$lastname = array(
						'name' =>'lastname',
						'id'   =>'lastname',
						'class' =>'signin',
						'Required' =>'Required',
						'placeholder'=>'LAST NAME',
						'maxlength' => '18',
						'size' => '24'
						);
				
		$ccid = array(
						'name' =>'ccid',
						'id'   =>'ccid',
						'class' =>'signin',
						'Required' =>'Required',
						'placeholder'=>'ccid (Cisco Id)',
						'maxlength' => '18',
						'size' => '24'

						);

        
		echo "<h1> Request </h1><br/>";
		
		echo form_label('First Name', 'firstname',$att); 	echo form_input($firstname); echo "<br/><br/>";	
		
		echo form_label('Last Name', 'lastname',$att);     echo form_input($lastname);echo "<br/><br/>";
		
		
		echo form_label('ccid', 'ccid',$att);              echo form_input($ccid);echo "<br/>";
		
		
		
		




		$inputSubmit = array(
						'type' =>'submit',
						'value' =>'Request',
						
						'id'	=>'button');

		
		
		echo "<br/><br/><br/>";

		echo form_submit($inputSubmit);
		echo"<input type='button' id=\"button\" onClick=\"window.history.back();\" name ='cancel' value=\"Back\">";
		
		echo "<br/>";
	    echo "<h1 class= 'logo' style='position:absolute;right:10px; bottom:-20px;'><img src=\"/test/normalize/assets/images/ciscologo.jpg\"/> </h1>";
		echo form_close();

	?>
</div>
