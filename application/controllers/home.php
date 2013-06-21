<?php
	if(!defined('BASEPATH'))
		exit('No Direct script would be allowed');
	class Home extends CI_Controller{

	     function index(){
               if(!isset($this->session->userdata['username']))
                    redirect('login');

               $this->load->view('header');
			$this->load->view('menu');
               $this->load->view('search');
               $this->load->view('email');
			$this->load->model('user_model');
			$query = $this->user_model->casesummary();
			$this->load->library('table');
			
			$tmpl = array (
                    'table_open'          => '<div id="casesummary"><table class="curvedEdges" style = "z-index:1; position:relative;width:auto; top:0px;">',

                    'heading_row_start'   => '<tr>',
                    'heading_row_end'     => '</tr>',
                    'heading_cell_start'  => '<th style="border-collapse:collapse;background-color:lightblue;white-space:nowrap;">',
                    'heading_cell_end'    => '</th>',

                    'row_start'           => '<tr class="hover">',
                    'row_end'             => '</tr>',
                    'cell_start'          => '<td class="standard" style ="padding-left:17px;">',
                    'cell_end'            => '</td>',

                    'row_alt_start'       => '<tr class="hover">',
                    'row_alt_end'         => '</tr>',
                    'cell_alt_start'      => '<td class="standard" style ="padding-left:17px;">',
                    'cell_alt_end'        => '</td>',

                    'table_close'         => '</table></div>'
               );
			$tmp2 = array (
                    'table_open'          => '<div id="open24"><table  class="curvedEdges" style = "z-index:2; position:relative; top:10px;">',

                    'heading_row_start'   => '<tr>',
                    'heading_row_end'     => '</tr>',
                    'heading_cell_start'  => '<th style="background-color:lightblue;white-space:nowrap;">',
                    'heading_cell_end'    => '</th>',

                    'row_start'           => '<tr class="hover">',
                    'row_end'             => '</tr>',
                    'cell_start'          => '<td class="standard">',
                    'cell_end'            => '</td>',

                    'row_alt_start'       => '<tr class="hover">',
                    'row_alt_end'         => '</tr>',
                    'cell_alt_start'      => '<td class="standard" >',
                    'cell_alt_end'        => '</td>',

                    'table_close'         => '</table></div>'
               );
			$tmp3 = array (
                    'table_open'          => '<div id="cases24"><table  class="curvedEdges" style = "z-index:3; position:relative;left:100px; width:auto;">',

                    'heading_row_start'   => '<tr>',
                    'heading_row_end'     => '</tr>',
                    'heading_cell_start'  => '<th style="background-color:lightblue;;white-space:nowrap;">',
                    'heading_cell_end'    => '</th>',

                    'row_start'           => '<tr class = "hover">',
                    'row_end'             => '</tr>',
                    'cell_start'          => '<td class="standard">',
                    'cell_end'            => '</td>',

                    'row_alt_start'       => '<tr class = "hover" >',
                    'row_alt_end'         => '</tr>',
                    'cell_alt_start'      => '<td class="standard">',
                    'cell_alt_end'        => '</td>',

                    'table_close'         => '</table></div>'
               );
               echo "<div style=\"width:45%;\" id  =\"casesummarytitle\">";
			$this->table->set_template($tmpl);
               $this->table->set_empty("0");
               $this->table->set_caption('Q1FY14-Issues Summary');
               if($query->num_rows() > 0)
			  echo $this->table->generate($query);
               else
                    echo "NO Projects";
               echo "</div>";
			$query = $this->user_model->open24();
               
               if($query->num_rows() > 0){
                    echo "<div style=\"width:auto;\" id = \"open24title\">";
                    $this->table->set_template($tmp2);
                    $this->table->set_empty("Not Defined");
                    $this->table->set_caption('Q1FY14-Issues open in the last 24 hours');
                    echo $this->table->generate($query);
               }
               else{
                    echo "<div style=\"width:300px;\" id = \"open24titleE\">";
                    //$this->table->set_template($tmp2);
                    //$this->table->set_caption('Cases open in the last 24 hours');
                    //echo $this->table->generate($query); 
                    echo "<h2 class=\"tableinside\"> No Issues were open in the last 24 hours</h2>";
               }
               echo "</div>";

               if($query->num_rows() > 0){
                    echo "<div style=\"width:60%;\" id  =\"cases24title\">";
                    $query = $this->user_model->cases24();
	         		$this->table->set_template($tmp3);
                    $this->table->set_empty("Not Defined");
                    $this->table->set_caption('Q1FY14-Issues worked on last 24 Hours');
                    //echo $this->curPageURL();
                    echo $this->table->generate($query);
               }
               else{
                    echo "<div style=\"width:300px;\" id  =\"cases24titleE\">";
                    echo "<h2 class=\"tableinside\"> No Issues were worked on in the last 24 hours</h2>";
               }

               //echo $this->table->generate($query);
               echo "</div>";
		}
          function update(){
               error_reporting(0);
               if(!isset($this->session->userdata['username']))
                    redirect('login');
               $this->load->view('header');
               $this->load->view('menu');
               $this->load->view('search');
               $this->load->view('createa');
               echo $this->session->userdata('sucesslog');
               echo $this->session->userdata('errorlog');
               $this->session->unset_userdata('sucesslog');
               $this->session->unset_userdata('errorlog');
               $this->load->model('user_model');
               $data['query'] = $this->user_model->update();
               $this->load->library('table');
               $this->load->view('update',$data);
          }
          function create($id = ''){
               if(!isset($this->session->userdata['username']))
                    redirect('login');

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
               if(!isset($this->session->userdata['username']))
                    redirect('login');
			$this->load->view('header');
			$this->load->view('menu');
               $this->load->view('search');
			$this->load->view('email');
               echo $this->session->userdata('sucesslog');
               $this->session->unset_userdata('sucesslog');
			$this->load->model('user_model');  
			$query = $this->user_model->statusreport();
			$this->load->library('table');
			$tmpl = array (
                    'table_open'          => '<div id="issues" style ="z-index:1; position:relative; top:200px;"><table style = "" class="curvedEdges">',

                    'heading_row_start'   => '<tr>',
                    'heading_row_end'     => '</tr>',
                    'heading_cell_start'  => '<th style="background-color:lightblue;text-align:left;white-space:nowrap;">',
                    'heading_cell_end'    => '</th>',

                    'row_start'           => '<tr class="hover">',
                    'row_end'             => '</tr>',
                    'cell_start'          => '<td class="standard"style="">',
                    'cell_end'            => '</td>',

                    'row_alt_start'       => '<tr class="hover">',
                    'row_alt_end'         => '</tr>',
                    'cell_alt_start'      => '<td class="standard"style="">',
                    'cell_alt_end'        => '</td>',

                    'table_close'         => '</table></div>'
                );
               $this->table->set_caption('<h2 class="tableheading">Issues Reported by GBP/Application Support Team</h2><p>'.$query->num_rows().' Records');
			$this->table->set_template($tmpl);
			$statusreport = $this->table->generate($query);
			echo $statusreport;

               $query = $this->user_model->perfapp();

               $this->load->library('table');
              
               $this->table->set_caption('<br/><br/><h2 class="tableheading">Issues Reported by Application and Performance Support team (Extended Version)</h2><p>'.$query->num_rows().' Records');
               $this->table->set_template($tmpl);
               $perfapp = $this->table->generate($query);
               echo $perfapp;
			$query = $this->user_model->closed();
			
               $this->table->set_caption('<br/><br/><h2 class="tableheading">Closed Issues</h2><p>'.$query->num_rows().' Records');
			$this->table->set_template($tmpl);
			$closed = $this->table->generate($query);
			echo $closed;
			echo "<br/>";
		}
		function releaseprojects(){
			$this->load->view('header');
			$this->load->view('menu');
               $this->load->view('search');
			$this->load->model('user_model');
			$query = $this->user_model->projectlist();
			$this->load->library('table');
			$tmpl = array (
                    'table_open'          => '<div id="list"><table class="curvedEdges" >',

                    'heading_row_start'   => '<tr>',
                    'heading_row_end'     => '</tr>',
                    'heading_cell_start'  => '<th  style="background-color:lightblue;">',
                    'heading_cell_end'    => '</th>',

                    'row_start'           => '<tr class="hover">',
                    'row_end'             => '</tr>',
                    'cell_start'          => '<td class="standard">',
                    'cell_end'            => '</td>',

                    'row_alt_start'       => '<tr class="hover">',
                    'row_alt_end'         => '</tr>',
                    'cell_alt_start'      => '<td class="standard">',
                    'cell_alt_end'        => '</td>',

                    'table_close'         => '</table></div>'
               );
               $this->table->set_caption('<h2 class="tableheading">Release Projects</h2>');
			$this->table->set_template($tmpl);
			echo $this->table->generate($query);
               echo $query->num_rows();	
		}
          function addform(){
               if(!isset($this->session->userdata['username']))
                    redirect('login');
               if($this->input->post('casenumber') == ''){
                    $this->session->set_userdata('error','<p class="errorlog">***Case Number Cannot be blank </p>');
                    redirect('home/create');
               }
               
               $this->load->model('user_model');
               $add = $this->user_model->add();
               if($add){
                     $this->session->set_userdata('sucesslog','<p class="sucesslog">'.$add.'</p>');
                     redirect('home/update');
                }
               else{
                    $this->session->set_userdata('errorlog','<p class="errorlog">There was an ERROR. Try again.</p>');
                    redirect('home/update');
               }
          }
		function charts(){
               if(!isset($this->session->userdata['username']))
                    redirect('login');
			$this->load->view('header');
			$this->load->view('menu');
			$this->load->view('charts');	
		}
		function email(){

               if(!isset($this->session->userdata['username']))
                    redirect('login');
               $this->load->model('user_model');
               $this->load->library('table');
               $tmp2 = array (
                              'table_open'          => '<div id="closed" style ="z-index:2; position:relative; top:200px;"><table style = "font-size:12px;font-family:calibri;line-height:14px;width:200%;white-space:nowrap; overflow:auto;border:1px solid">',

                              'heading_row_start'   => '<tr>',
                              'heading_row_end'     => '</tr>',
                              'heading_cell_start'  => '<th style="border-collapse:collapse;border:1px solid;padding-left:3px;background-color:lightblue;text-align:left;white-space:nowrap;">',
                              'heading_cell_end'    => '</th>',

                              'row_start'           => '<tr style="border-left:1px dotted;">',
                              'row_end'             => '</tr>',
                              'cell_start'          => '<td style=" width:auto;padding:5px;border:1px solid; align:left;vertical-align:top;">',
                              'cell_end'            => '</td>',

                              'row_alt_start'       => '<tr style="border-left:1px dotted;">',
                              'row_alt_end'         => '</tr>',
                              'cell_alt_start'      => '<td style="padding:5px;border:1px solid;align:left;vertical-align:top;">',
                              'cell_alt_end'        => '</td>',

                              'table_close'         => '</table></div>'
                         );
               $tmp1 = array (
                              'table_open'          => '<table style = "font-size:12px;font-family:calibri;line-height:14px;width:450px;white-space:nowrap; overflow:auto;border:1px solid">',

                              'heading_row_start'   => '<tr>',
                              'heading_row_end'     => '</tr>',
                              'heading_cell_start'  => '<th style="border-collapse:collapse;border:1px solid;padding-left:3px;background-color:lightblue;text-align:left;white-space:nowrap;">',
                              'heading_cell_end'    => '</th>',

                              'row_start'           => '<tr style="border-left:1px dotted;">',
                              'row_end'             => '</tr>',
                              'cell_start'          => '<td style=" width:auto;padding:5px;border:1px solid; align:left;vertical-align:top;">',
                              'cell_end'            => '</td>',

                              'row_alt_start'       => '<tr style="border-left:1px dotted;">',
                              'row_alt_end'         => '</tr>',
                              'cell_alt_start'      => '<td style="padding:5px;border:1px solid;align:left;vertical-align:top;">',
                              'cell_alt_end'        => '</td>',

                              'table_close'         => '</table>'
                         );
               if($this->input->post('emailform')){
               
                    if($this->input->post('casesummary')){

                         $query = $this->user_model->casesummary();
                         $casesummary = '<b>Case Summary </b> <br/>';
                         $this->table->set_template($tmp1);
                         $this->table->set_empty("0");
                         //$this->table->set_caption('Q1FY14-Issues Summary');
                         if($query->num_rows() > 0)
                           $casesummary .= $this->table->generate($query);
                         else
                         $casesummary =  "NO Projects";
                    }
                    if($this->input->post('statusreport')){
     
                         $query = $this->user_model->perfapp();
                         $this->table->set_template($tmp2);
                         $perfapp = '<b>Issues Reported by Application/Performance Team(Extended Version) </b><br/>';
                         $perfapp .= $this->table->generate($query);
                         $perfapp .='<br/>'.$query->num_rows().'Records.';

                         $query = $this->user_model->estatusreportinc();
                         $this->table->set_template($tmp2);
                         $estatusreportinc = '<b>Issues Reported by  Support Teams</b><br/>';
                         $estatusreportinc .= $this->table->generate($query);
                         $estatusreportinc .= '<br/>'.$query->num_rows().'Records.';

                         $query = $this->user_model->estatusreportpbi();
                         $this->table->set_template($tmp2);
                         $estatusreportpbi = '<b>Issues Reported by  Performance Team</b><br/>';
                         $estatusreportpbi .= $this->table->generate($query);
                         $estatusreportpbi .='<br/>'.$query->num_rows().'Records';

                         $query = $this->user_model->closed1();
                         $closed = '<b>Closed Issues</b><br/>';
                         $countclosed = $query->num_rows();
                         $query = $query->result();
                         $closed .= "<table style = \"font-size:14px;width:170%;white-space:nowrap; overflow:auto;border:1px solid\">
                                        <tr style=\"border-collapse:collapse;border:1px solid;padding-left:3px;background-color:lightblue;text-align:left;white-space:nowrap;\">
                                            <th style=\"white-space:nowrap;\">Issue Reported Date</th>
                                            <th style=\"white-space:nowrap;\">Issue Number</th>
                                            <th style=\"white-space:nowrap;\">Application</th>    
                                            <th style=\"white-space:nowrap;\">Priority</th>  
                                            <th style=\"white-space:nowrap;\">DB/FE</th>
                                            <th style=\"white-space:nowrap;\">Database</th>
                                            <th style=\"white-space:nowrap;\">Supported DB </th>
                                            <th style=\"white-space:nowrap;\">Analyst</th>
                                            <th style=\"white-space:nowrap;\">Status</th>
                                            <th style=\"white-space:nowrap;\">Release Related</th>
                                            <th style=\"white-space:nowrap;\">Recommendations</th>
                                            <th style=\"white-space:nowrap;\">Summary</th>
                                            <th style=\"white-space:nowrap;\">Case/PBI</th>    
                                        </tr>";
                         foreach ($query as $row) {
                                   $closed .= "<tr style=\"border:1px;\">
                                                    <td style=\"border:1px solid;\">". $row->IssueReportedDate ."</td>
                                                    <td style=\"border:1px solid;\" >". $row->CaseNo."</td>
                                                    <td style=\"border:1px solid;\" >". $row->Application ."</td>
                                                    <td style=\"border:1px solid;\" >". $row->Priority ."</td>
                                                    <td   style='border:1px solid;text-align:center;'>". $row->DBFE ."</td>
                                                    <td style=\"border:1px solid;\" >". $row->Database ."</td>
                                                    <td  style='border:1px solid;text-align:center;'>". $row->SupportedDB ."</td>
                                                    <td style=\"border:1px solid;\">". $row->Analyst ."</td>
                                                    <td style=\"border:1px solid;\">". $row->Status."</td>
                                                    <td  style='border:1px solid;text-align:center;'>". $row->ReleaseRelated ."</td>  
                                                    <td style=\"border:1px solid;\">".  $row->Recommendations."</td>
                                                    <td style=\"border:1px solid;\">".$row->Summary."</td>
                                                    <td style='border:1px solid;text-align:center;'>". $row->CasePBI ."</td>
                                                  </tr>";                            
                         }
                         $closed .="</table>";
                         $closed .= '<br/>'.$countclosed.'Records';
                    }
                    if($this->input->post('projectslist')){
                         $releaseprojects = '<b> Project List </b><br/>';
                         $query = $this->user_model->projectlist();
                         $this->table->set_template($tmp1);
                         $countprojects = $query->num_rows(); 
                         $releaseprojects .= $this->table->generate($query);
                    }

                         $username = $this->session->userdata('username');
          			$this->load->library('email');
          			$this->email->set_newline("\r\n");
          			$this->email->from($username.'@cisco.com', '');
          			$this->email->to($username.'@cisco.com', ''); 
          			$this->email->subject('Status Report for Normalization');
                         //$body = array('$perfapp','$statusreport','$closed');
                          if(!$this->input->post('casesummary')){
                              $casesummary = '';
                          }
                            elseif(!$this->input->post('projectslist')){
                              $releaseprojects = '';
                            }
                             elseif(!$this->input->post('statusreport')){
                              $estatusreportinc ='';
                              $estatusreportpbi ='';
                              $perfapp = '';
                              $closed = '';
                              $countperf = '';
                             }


                         $this->email->message('<html> 
                                                  <body>
                                                       '.$casesummary.'<br/><br/><br/>
                                                       '.$releaseprojects.'<br/><br/><br/>
                                                       '.$estatusreportinc.'<br/>
                                                       '.$estatusreportpbi.'<br/>
                                                       '.$perfapp.'<br/>
                                                       '.$closed.'
                                                   </body>
                                                 </html>

                                                  ');
               }
               if ($this->email->send()){
                    $this->session->set_userdata('sucesslog','<p class="sucesslog">Your Email has been sent!</p>');
				redirect('home/emails');
               }
			else
				echo $this->email->print_debugger();
          }
          function emails(){
                if(!isset($this->session->userdata['username']))
                    redirect('login');
               echo $this->session->userdata('sucesslog');
               $this->session->unset_userdata('sucesslog');
               $this->load->view('header');
               $this->load->view('menu');
               //$this->load->view('search');
               $this->load->view('emailform');

          }
          function search(){
               if(!isset($this->session->userdata['username']))
                    redirect('login');
               $this->load->view('header');
               $this->load->view('menu');
               $this->load->model('user_model');
               $query =  $this->user_model->search();
               $this->load->library('table');
               $tmpl = array (
                    'table_open'          => '<div id="issues" style ="z-index:1; position:relative; top:200px;"><table style = "" class="curvedEdges">',

                    'heading_row_start'   => '<tr>',
                    'heading_row_end'     => '</tr>',
                    'heading_cell_start'  => '<th style="background-color:lightblue;text-align:center;white-space:nowrap;font-size:14px;">',
                    'heading_cell_end'    => '</th>',

                    'row_start'           => '<tr class="hover">',
                    'row_end'             => '</tr>',
                    'cell_start'          => '<td class="standard"style="">',
                    'cell_end'            => '</td>',

                    'row_alt_start'       => '<tr class="hover">',
                    'row_alt_end'         => '</tr>',
                    'cell_alt_start'      => '<td class="standard"style="">',
                    'cell_alt_end'        => '</td>',

                    'table_close'         => '</table></div>'
              );
               $this->table->set_caption('<h2 class="tableheading">Your Search Results</h2>');
               $this->table->set_template($tmpl);
               $data['query'] = $query->result();
               if($query->num_rows()>0){
                     $this->load->view('update',$data);
                   // $this->load->view('search');
                   // echo $this->table->generate($query);
                    echo"<input type='button' id=\"button1\" value=\"Back\" onClick=\"window.history.back();\" /></div>";
               }
               else{
                    $this->load->view('search');
                    echo "<div id =\"error\"><p id =\"error\"> No records are found. Please Search Again <br/><br/>
                                             <b>Hint</b> :  Please try adding * at the start or end of the string.<br/><br/>
                                             Example: '<b>*YourStringHere*</b>' without the quotes for better results </p> "; 
                    echo"<input type='button' id=\"button\" value=\"Back\" onClick=\"window.history.back();\" /></div>"; 

               }              
          }
          function logout(){
               if(!isset($this->session->userdata['username']))
                    redirect('login');
               else{
                    $this->session->unset_userdata('username');
                    $this->session->sess_destroy();
                    redirect('login','refresh');
               }
          }
          function view($id = ''){
               error_reporting(0);
               if(!isset($this->session->userdata['username']))
                    redirect('login');
               $this->load->model('user_model');
               $query =  $this->user_model->view($id);
               $this->load->library('table');
               $tmpl = array (
                    'table_open'          => '<div id="list"><table border="1" cellpadding="4" cellspacing="1"style = "width:140%;font-size:14px; border-collapse:collapse;padding-left:6px;">',

                    'heading_row_start'   => '<tr>',
                    'heading_row_end'     => '</tr>',
                    'heading_cell_start'  => '<th  style="background-color:lightblue;white-space:nowrap;">',
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
               $this->table->set_caption('<h2 class="tableheading">AUDIT</h2>');
               $this->table->set_template($tmpl);
               

               if($query)
                    echo $this->table->generate($query);
               elseif(!$query) 
                    echo "<p>No changes were made. </p>";
          }
     }
     class CurrentPage {
         public  function curPageURL() {
               $pageURL = 'http';
               //    if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
               $pageURL .= "://";
               if ($_SERVER["SERVER_PORT"] != "80") {
               $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
               } else {
               $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
               }
               return $pageURL;
          }
     }
      

?>

