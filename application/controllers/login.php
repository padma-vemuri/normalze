	<?php
if(!defined('BASEPATH'))
	exit('No Direct script would be allowed');

class Login extends CI_Controller {
	public function index(){
		if(isset($this->session->userdata['username']))
                    redirect('home');
        else{
			$this->load->view('header');
			$this->load->view('login');
			//$this->load->view('footer');
		}
	}
	function validate(){
		$this->load->model('user_model');
		$query = $this->user_model->validate();
		$username = $this->input->post('username');
		$Password = $this->input->post('password');
		if($username && $Password){
			if($username == NULL){
				$this->session->set_userdata('error','<p class="errorlog">Username can not be NULL</p>');
				redirect('login');
			}
			elseif($Password == NULL){
				$this->session->set_userdata('error','<p class ="errorlog">Password can not be NULL </p>');
				redirect('login');
			}
			elseif(strlen($Password)< 8){
				$this->session->set_userdata('error','<p class ="errorlog">Password can not be less than 8 characters</p>');
				redirect('login');
			}
		}

	    if($query){
    			foreach ($query as $row) {
    				if ($row['VALID'] == 'Y'){
    					$query = $this->user_model->first_time_flag();
    				 	if ($query){
    				 		foreach ($query as $row) {
    				 			if($row['FIRST_TIME_FLAG'] == 'Y'){
    				 				$this->session->set_userdata('username',$this->input->post('username'));	
    				 				redirect('login/reset');
    				 			}
    				 		}
    				 	}
				 		$this->session->set_userdata('username',$this->input->post('username'));
						redirect('home');
    				}

    				
    				elseif($row['VALID'] == 'N'){
    				 	$query = $this->user_model->first_time_flag();
    				 	if ($query){
    				 		foreach ($query as $row) {
    				 			if($row['FIRST_TIME_FLAG'] == 'N'){
    				 				$this->session->set_userdata('error','<p class ="errorlog">Wrong ID/Password. Please try again!</p>');
    				 				redirect('login');
    				 			}
    				 			elseif ($row['FIRST_TIME_FLAG'] == 'Y'){
    				 				$this->session->set_userdata('username',$this->input->post('username'));	
    				 				redirect('login/reset');
    				 			}
    				
    				 		}
    				 	}
	    				else{
	    					$this->session->set_userdata('error','<p class ="errorlog">Wrong ID/Password. Please try again!</p>');
    				 		redirect('login');
                   		}

    				}    			
    			}
	    }

		else{	
			  $this->session->set_userdata('error','<p class ="errorlog">Please try again!</p>');
			  redirect(base_url());


		}
	}

	function setpassword(){
		$this->load->model('user_model');
		$password = $this->input->post('password');
		$conpassword = $this->input->post('conpassword');
		if (strlen($password) < 8 && strlen($conpassword) < 8 ){
			$this->session->set_userdata('error',"<p class ='errorlog'>Password should be atleast 8 characters</p>"); 
			redirect('login/reset');
            
		}
		elseif($password !== $conpassword){
			$this->session->set_userdata('error', "<p class ='errorlog'>Passwords did not match.</p>"); 
			redirect('login/reset');
			
		}
		elseif($password == $conpassword && $password == $this->session->userdata('')){
			$this->session->set_userdata('error', "<p class ='errorlog'It can not be your ccid.</p>"); 
			redirect('login/reset');
		}
		elseif($password == $conpassword){
			$query =$this->user_model->setpassword();
    	}
			
		if($query)
			redirect('home');
		else
			redirect('login/reset');

	}

	function reset(){
		$this->load->view('header');
		$this->load->view('reset');
		//$this->load->view('footer');
	}

	function signup(){

		$this->load->view('header');
		$this->load->view('signup');
	}
	function newuser(){
		$this->load->view('header');
		$this->load->library('email');
               $firstname =  $this->input->post('firstname');
               $lastname =  $this->input->post('lastname');
               $ccid = $this->input->post('ccid');
               $firstname = $this->input->post('firstname');
               $lastname = $this->input->post('lastname');

                         $this->email->set_newline("\r\n");
                         $this->email->from($ccid.'@cisco.com');
                         $this->email->to($ccid.'@cisco.com');
                         $this->email->bcc('venvemur@cisco.com'); 
                         $this->email->subject('ATS Performance Support');
                         $this->email->message('<html> 
                                                  <body>
                                                       Hi '.$firstname.' '.$lastname.',<br/>

                                                       Your cecid is '.$ccid.'.<br/><br/>



                                                       
                                                       Our Records say that you have requested for a new user account for the normalization tool.<br/>
                                                       If this is not you. Please Ignore this email.<br/><br/>
                                                       If this is you,

                                                       We will send your id and passoword within 2 bussiness days or less to this email account<br/>
                                                       Please acknowledge by accessing your account using the credentials in that email.<br/><br/>

                                                       See you soon. <br/><br/>
                                                       Regards,<br/>
                                                       ATS Performance Support. 
                                                       
                                                   </body>
                                                 </html>

                                                  ');
               
               if ($this->email->send()){
                    $this->session->set_userdata('sucesslog','<p class="sucesslog">Your Email has been sent!</p>');
                    $this->load->view('newuser');
               }
               else
                    echo $this->email->print_debugger();
	}
}



?>