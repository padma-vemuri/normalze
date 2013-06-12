<?php
	if(!defined('BASEPATH'))
		exit('No Direct script would be allowed');
	class Home extends CI_Controller{
		
		public function index(){
			$this->load->view('header');
			$this->load->view('menu');
			$this->load->model('user_model');
			$query = $this->user_model->casesummary();
			$this->load->library('table');

               echo '<table><tr><td>';
			
			$tmpl = array (
                    'table_open'          => '<table class="curvedEdges">',

                    'heading_row_start'   => '<tr>',
                    'heading_row_end'     => '</tr>',
                    'heading_cell_start'  => '<th  style="background-color:lightblue;">',
                    'heading_cell_end'    => '</th>',

                    'row_start'           => '<tr>',
                    'row_end'             => '</tr>',
                    'cell_start'          => '<td class="standard">',
                    'cell_end'            => '</td>',

                    'row_alt_start'       => '<tr>',
                    'row_alt_end'         => '</tr>',
                    'cell_alt_start'      => '<td class="standard">',
                    'cell_alt_end'        => '</td>',

                    'table_close'         => '</table>'
              );
               echo "</td></tr> </table>" ;

               echo '<table> <tr><td width="50%">' ;
			$tmp2 = array (
                    'table_open'          => '<table class="curvedEdges">',

                    'heading_row_start'   => '<tr>',
                    'heading_row_end'     => '</tr>',
                    'heading_cell_start'  => '<th  style="background-color:lightblue;">',
                    'heading_cell_end'    => '</th>',

                    'row_start'           => '<tr>',
                    'row_end'             => '</tr>',
                    'cell_start'          => '<td class="standard">',
                    'cell_end'            => '</td>',

                    'row_alt_start'       => '<tr>',
                    'row_alt_end'         => '</tr>',
                    'cell_alt_start'      => '<td class= "standard">',
                    'cell_alt_end'        => '</td>',

                    'table_close'         => '</table>'
              );
              echo '</td><td width="50%">';

			$tmp3 = array (
                    'table_open'          => '<table class="curvedEdges">',

                    'heading_row_start'   => '<tr>',
                    'heading_row_end'     => '</tr>',
                    'heading_cell_start'  => '<th  style="background-color:lightblue;">',
                    'heading_cell_end'    => '</th>',

                    'row_start'           => '<tr>',
                    'row_end'             => '</tr>',
                    'cell_start'          => '<td class="standard">',
                    'cell_end'            => '</td>',

                    'row_alt_start'       => '<tr>',
                    'row_alt_end'         => '</tr>',
                    'cell_alt_start'      => '<td class="standard">',
                    'cell_alt_end'        => '</td>',

                    'table_close'         => '</table>'
              );

               echo "</td></tr></table>";


			$this->table->set_template($tmpl);
               //echo "<div id  =\"casesummarytitle\">Case Summary</div>";
			echo $this->table->generate($query);
			$this->table->set_template($tmp2);
               
			$query = $this->user_model->cases24();
               //echo "<div id = \"open24title\"> Cases Open in 24 Hours </div>";
			echo $this->table->generate($query);
			$this->table->set_template($tmp3);
			
               $query = $this->user_model->open24();
			
               //echo "<div id  =\"cases24title\"> Cases Worked on in the last 24 Hours</div>";
               echo $this->table->generate($query);




				# code..

			//$this->load->view('main',$data);	
				//$this->load->view('main',$query);
			
		}
          function update(){
               $this->load->view('header');
               $this->load->view('menu');
               $this->load->view('createa');
               $this->load->model('user_model');
               $data['query'] = $this->user_model->update();
               $this->load->library('table');
               $this->load->view('update',$data);

              /* $tmpl = array (
                    'table_open'          => '<div id="issues" style ="z-index:1; position:relative; top:155px;"><table border="1" cellpadding="4" style = "width:100%;border-collapse:collapse;font-family:Calibri;padding-left:6px; font-size:12px;">',

                    'heading_row_start'   => '<tr>',
                    'heading_row_end'     => '</tr>',
                    'heading_cell_start'  => '<th style="background-color:lightblue;white-space:nowrap;">',
                    'heading_cell_end'    => '</th>',

                    'row_start'           => '<tr>',
                    'row_end'             => '</tr>',
                    'cell_start'          => '<td style="word-wrap: break-word;">',
                    'cell_end'            => '</td>',

                    'row_alt_start'       => '<tr>',
                    'row_alt_end'         => '</tr>',
                    'cell_alt_start'      => '<td style="word-wrap: break-word;">',
                    'cell_alt_end'        => '</td>',

                    'table_close'         => '</table></div>'
              );


               $this->table->set_caption('<h2 class="tableheading">Create/Update</h2>');
               $this->table->set_template($tmpl);

               $statusreport = $this->table->generate($query);
               echo $statusreport; */
          }


		function create($id = ''){

			$this->load->view('header');
               $this->load->view('menu');
			$this->load->model('user_model');
                    
                    $query = $this->user_model->gbplist();     
                    if($query){

                         $gbplist = array();
                         foreach ($query  as $row) {
                          array_push($gbplist,$row['GBP']);
                         }
                          $data['gbplist'] = array();
                         foreach ($gbplist as $row ) {
                                                       
                              $data['gbplist'][$row] = $row;

                           # code...
                         }
                    }
                    // //print_r($data);
                    $analystquery = $this->user_model->analystlist();
                    if($analystquery){
                         $anallist = array();
                         foreach ($analystquery as $row) {
                              array_push($anallist,$row['ASSIGNED']);
                              # code...
                         }
                         $data['anallist'] = array();
                         foreach ($anallist as $row) {
                               $data['anallist'][$row] = $row;
                              # code...
                         }
                    
                    } 

                    $projectlistquery = $this->user_model->projectlist1();
                    if($projectlistquery){
                        
                         $prolist = array();
                         foreach ($projectlistquery as $row) {
                              array_push($prolist,$row['Project']);
                              # code...
                         }
                         $data['prolist'] = array();
                         foreach ($prolist as $row) {
                              $data['prolist'][$row] = $row;
                         }
                    }

                    

                    $this->load->view('create');
               if($id == '')
                    $this->load->view('createform',$data);
               	//$this->load->view('test');
               else{
                    $data['populate'] = $this->user_model->populate($id);

                    $this->load->view('createform',$data);

               }
			
		}

		function statusreports(){
			$this->load->view('header');
			$this->load->view('menu');
			$this->load->view('email');
			$this->load->model('user_model');  
			$query = $this->user_model->statusreport();
			$this->load->library('table');
			$tmpl = array (
                    'table_open'          => '<div id="issues" style ="z-index:1; position:relative; top:155px;"><table border="1" cellpadding="4" style = "width:100%;border-collapse:collapse;font-family:Calibri;padding-left:6px; font-size:12px;">',

                    'heading_row_start'   => '<tr>',
                    'heading_row_end'     => '</tr>',
                    'heading_cell_start'  => '<th style="background-color:lightblue;;white-space:nowrap;">',
                    'heading_cell_end'    => '</th>',

                    'row_start'           => '<tr>',
                    'row_end'             => '</tr>',
                    'cell_start'          => '<td>',
                    'cell_end'            => '</td>',

                    'row_alt_start'       => '<tr>',
                    'row_alt_end'         => '</tr>',
                    'cell_alt_start'      => '<td>',
                    'cell_alt_end'        => '</td>',

                    'table_close'         => '</table></div>'
              );
               $this->table->set_caption('<h2 class="tableheading">Issues Reported by GBP/Application Support team</h2>');
			$this->table->set_template($tmpl);
			$statusreport = $this->table->generate($query);
			echo $statusreport;

               $query = $this->user_model->perfapp();
               $this->load->library('table');
               $tmpl = array (
                    'table_open'          => '<div id="perfapp" style="z-index:2;position:relative;top:180px;"><table border="1" cellpadding="4" cellspacing="1"style = "white-space:nowrap;width:100%;border-collapse:collapse;font-family:Calibri;padding-left:6px; overflow:auto;font-size:12px;">',

                    'heading_row_start'   => '<tr>',
                    'heading_row_end'     => '</tr>',
                    'heading_cell_start'  => '<th  style="background-color:lightblue;">',
                    'heading_cell_end'    => '</th>',

                    'row_start'           => '<tr>',
                    'row_end'             => '</tr>',
                    'cell_start'          => '<td>',
                    'cell_end'            => '</td>',

                    'row_alt_start'       => '<tr>',
                    'row_alt_end'         => '</tr>',
                    'cell_alt_start'      => '<td>',
                    'cell_alt_end'        => '</td>',

                    'table_close'         => '</table></div></br>'
              );
               $this->table->set_caption('<h2 class="tableheading">Issues Reported by Application and Performance Support team</h2>');
               $this->table->set_template($tmpl);
               $perfapp = $this->table->generate($query);
               echo $perfapp;
			
			$query = $this->user_model->closed();
			$tmpl = array (
                    'table_open'          => '<div id="closed" style ="z-index:3; position:relative; top:200px;"><table border="1" cellpadding="4" cellspacing="1"style = "width:100%;border-collapse:collapse;font-family:Calibri;padding-left:6px;white-space:nowrap; font-size:12px;">',

                    'heading_row_start'   => '<tr>',
                    'heading_row_end'     => '</tr>',
                    'heading_cell_start'  => '<th  style="background-color:lightblue;">',
                    'heading_cell_end'    => '</th>',

                    'row_start'           => '<tr>',
                    'row_end'             => '</tr>',
                    'cell_start'          => '<td>',
                    'cell_end'            => '</td>',

                    'row_alt_start'       => '<tr>',
                    'row_alt_end'         => '</tr>',
                    'cell_alt_start'      => '<td>',
                    'cell_alt_end'        => '</td>',

                    'table_close'         => '</table></div>'
              );
               $this->table->set_caption('<h2 class="tableheading">Closed cases</h2>');
			$this->table->set_template($tmpl);
			$closed = $this->table->generate($query);
			
			echo $closed;
			$this->load->view('footer');
		}
		function releaseprojects(){
			$this->load->view('header');
			$this->load->view('menu');
			$this->load->model('user_model');
			$query = $this->user_model->projectlist();
               $rowcount = $query->num_rows();
               echo $rowcount;


			$this->load->library('table');
			$tmpl = array (
                    'table_open'          => '<div id="list"><table border="1" cellpadding="4" cellspacing="1"style = "border-collapse:collapse;font-family:Calibri;padding-left:6px; font-size:12px;">',

                    'heading_row_start'   => '<tr>',
                    'heading_row_end'     => '</tr>',
                    'heading_cell_start'  => '<th  style="background-color:lightblue;">',
                    'heading_cell_end'    => '</th>',

                    'row_start'           => '<tr>',
                    'row_end'             => '</tr>',
                    'cell_start'          => '<td>',
                    'cell_end'            => '</td>',

                    'row_alt_start'       => '<tr>',
                    'row_alt_end'         => '</tr>',
                    'cell_alt_start'      => '<td>',
                    'cell_alt_end'        => '</td>',

                    'table_close'         => '</table></div>'
              );
               $this->table->set_caption('<h2 class="tableheading">Release Projects</h2>');
			$this->table->set_template($tmpl);
			echo $this->table->generate($query);


			
		}

          function addform(){
               $this->load->model('user_model');
               $add = $this->user_model->add();
               if($add)
                    redirect('home/update');
               else
                    redirect('home');
          }

		function charts(){
			$this->load->view('header');
			$this->load->view('menu');
			$this->load->view('charts');
			
		}


		function email(){
               $this->load->model('user_model');
               $query = $this->user_model->perfapp();
               $this->load->library('table');
               $tmpl = array (
                    'table_open'          => '<div id="perfapp" style="z-index:1;position:relative;top:150px;"><table border="1" cellpadding="4" cellspacing="1"style = "width:100%;border-collapse:collapse;white-space:nowrap;text-wrap:none;font-family:Calibri;padding-left:6px; overflow:auto;font-size:12px;">',

                    'heading_row_start'   => '<tr>',
                    'heading_row_end'     => '</tr>',
                    'heading_cell_start'  => '<th style="background-color:lightblue;">',
                    'heading_cell_end'    => '</th>',

                    'row_start'           => '<tr>',
                    'row_end'             => '</tr>',
                    'cell_start'          => '<td>',
                    'cell_end'            => '</td>',

                    'row_alt_start'       => '<tr>',
                    'row_alt_end'         => '</tr>',
                    'cell_alt_start'      => '<td>',
                    'cell_alt_end'        => '</td>',

                    'table_close'         => '</table></div></br>'
              );
               $this->table->set_caption('<h2>Issues Reported by GBP/Application Support Team</h2>');
               $this->table->set_template($tmpl);
               $perfapp = $this->table->generate($query);
               $query = $this->user_model->statusreport();
               $this->load->library('table');
               $tmpl = array (
                    'table_open'          => '<div id="issues" style ="z-index:2; position:relative; top:180px;"><table border="1" cellpadding="4" cellspacing="1"style = "width:100%;border-collapse:collapse;white-space:nowrap;font-family:Calibri;padding-left:6px; font-size:12px;">',

                    'heading_row_start'   => '<tr>',
                    'heading_row_end'     => '</tr>',
                    'heading_cell_start'  => '<th style="background-color:lightblue;">',
                    'heading_cell_end'    => '</th>',

                    'row_start'           => '<tr>',
                    'row_end'             => '</tr>',
                    'cell_start'          => '<td>',
                    'cell_end'            => '</td>',

                    'row_alt_start'       => '<tr>',
                    'row_alt_end'         => '</tr>',
                    'cell_alt_start'      => '<td>',
                    'cell_alt_end'        => '</td>',

                    'table_close'         => '</table></div>'
              );
               $this->table->set_caption('<h2 class="tableheading">Issues Reported by Application and Performance Support Team</h2>');
               $this->table->set_template($tmpl);
               $statusreport = $this->table->generate($query);
               $query = $this->user_model->closed();
               $tmpl = array (
                    'table_open'          => '<div id="closed" style ="z-index:3; position:relative; top:200px;"><table border="1" cellpadding="4" cellspacing="1"style = "width:100%;border-collapse:collapse;white-space:nowrap;font-family:Calibri;padding-left:6px; font-size:12px;">',

                    'heading_row_start'   => '<tr>',
                    'heading_row_end'     => '</tr>',
                    'heading_cell_start'  => '<th style="background-color:lightblue; text-wrap:none;">',
                    'heading_cell_end'    => '</th>',

                    'row_start'           => '<tr>',
                    'row_end'             => '</tr>',
                    'cell_start'          => '<td style="text-wrap:none;">',
                    'cell_end'            => '</td>',

                    'row_alt_start'       => '<tr>',
                    'row_alt_end'         => '</tr>',
                    'cell_alt_start'      => '<td>',
                    'cell_alt_end'        => '</td>',

                    'table_close'         => '</table></div>'
              );
               $this->table->set_caption('<h2 class="tableheading">Closed Cases</h2><br/><br/>');
               $this->table->set_template($tmpl);
               $closed = $this->table->generate($query);
               
               $username = $this->session->userdata('username');

			
			$this->load->library('email');
			//$this->email->initialize($config);
			$this->email->set_newline("\r\n");
			$this->email->from($username.'@cisco.com', 'Padmakumar');
			$this->email->to($username.'@cisco.com', 'Padmakumar'); 
			$this->email->cc('venvemur@cisco.com','Cisco'); 
			//$this->email->bcc('venvemur@cisco.com','Cisco'); 

			$this->email->subject('Status Report for Normalization');
               $body = array('$perfapp','$statusreport','$closed');
			$this->email->message($statusreport.'<br/><br/>'.$perfapp.'<br/><br/>'.$closed."<br/>");


			if ($this->email->send())
				redirect('home/statusreports');
			else
				echo $this->email->print_debugger();

		}

          function logout(){
               $this->session->unset_userdata('username');
               $this->session->sess_destroy();
               redirect('login','refresh');
          }
	}
?>

