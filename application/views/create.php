<div name ="body" id ="search" class ="body">
<?php
error_reporting(0);
echo "<br/>";
$formHTML = array(
					'id' => 'search');
echo form_open('home/create',$formHTML);



$inputUsername = array(
				'name' =>'search',
				'id'   =>'search',
				'placeholder'=>'Type here',
				'maxlength' => '18',
				'size' => '24'
				);
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo form_close();
?>
</div>