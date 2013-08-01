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
			$this->load->model('user_model');
			$query = $this->user_model->casesummary();
			$this->load->library('table');
			
			$tmpl = array (
                    'table_open'          => '<div id="casesummary"><table class="curvedEdges" style = "z-index:1; position:relative;width:auto; top:0px;">',

                    'heading_row_start'   => '<tr>',
                    'heading_row_end'     => '</tr>',
                    'heading_cell_start'  => '<th style="border-collapse:collapse;background-color:lightblue;white-space:nowrap;">',
                    'heading_cell_end'    => '</th>',

                    'heading_row_alt_start'   => '<tr>',
                    'heading_row_alt_end'     => '</tr>',
                    'heading_cell_alt_start'  => '<th style="border-collapse:collapse;background-color:blue;white-space:nowrap;">',
                    'heading_cell_alt_end'    => '</th>',

                    'row_start'           => '<tr class="hover">',
                    'row_end'             => '</tr>',
                    'cell_start'          => '<td class="standard" style ="padding-left:17px;word-break:break-word;word-wrap:break-word;">',
                    'cell_end'            => '</td>',

                    'row_alt_start'       => '<tr class="hover">',
                    'row_alt_end'         => '</tr>',
                    'cell_alt_start'      => '<td class="standard" style ="padding-left:17px;word-break:break-word;word-wrap:break-word;">',
                    'cell_alt_end'        => '</td>',

                    'table_close'         => '</table></div>'
               );
			$tmp2 = array (
                    'table_open'          => '<div id="open24"><table  class="curvedEdges" style = "z-index:2;table-layout:fixed; position:relative; top:10px;">',

                    'heading_row_start'   => '<tr>',
                    'heading_row_end'     => '</tr>',
                    'heading_cell_start'  => '<th style="background-color:lightblue;white-space:nowrap;">',
                    'heading_cell_end'    => '</th>',

                    'row_start'           => '<tr class="hover">',
                    'row_end'             => '</tr>',
                    'cell_start'          => '<td class="standard" style ="word-break:break-word;word-wrap:break-word;">',
                    'cell_end'            => '</td>',

                    'row_alt_start'       => '<tr class="hover">',
                    'row_alt_end'         => '</tr>',
                    'cell_alt_start'      => '<td class="standard" style ="word-break: break-word;word-wrap:break-word;">',
                    'cell_alt_end'        => '</td>',

                    'table_close'         => '</table></div>'
               );
			$tmp3 = array (
                    'table_open'          => '<div id="cases24"><table  class="curvedEdges" style = "z-index:3;table-layout:fixed; position:relative;left:100px;">',

                    'heading_row_start'   => '<tr>',
                    'heading_row_end'     => '</tr>',
                    'heading_cell_start'  => '<th style="background-color:lightblue;white-space:nowrap;">',
                    'heading_cell_end'    => '</th>',

                    'row_start'           => '<tr class = "hover"  >',
                    'row_end'             => '</tr>',
                    'cell_start'          => '<td class="standard" style ="word-break:break-word;word-wrap:break-word;" >',
                    'cell_end'            => '</td>',

                    'row_alt_start'       => '<tr class = "hover" >',
                    'row_alt_end'         => '</tr>',
                    'cell_alt_start'      => '<td class="standard" style ="word-break:break-word; word-wrap:break-word;">',
                    'cell_alt_end'        => '</td>',

                    'table_close'         => '</table></div>'
               );
               echo"<div id ='leftpane'>";
			$this->table->set_template($tmpl);
               $this->table->set_empty("0");
               $this->table->set_caption('Q1FY14-Issues Summary');
               if($query->num_rows() > 0)
			  echo $this->table->generate($query);
               else
                    echo "NO Projects";
               echo " <br/><br/>";
			$query = $this->user_model->open24();
               
               if($query->num_rows() > 0){
                    echo "<div style=\"width:auto;\" id = \"open24title\"></div>";
                    $this->table->set_template($tmp2);
                    $this->table->set_empty("Not Defined");
                    $this->table->set_caption('Q1FY14-Issues open in the last 24 hours');
                    echo $this->table->generate($query);
               }
               else{
                    
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
               $data['openCount'] = $this->user_model->openCount();
               $data['closedCount'] = $this->user_model->closedCount();
               //$data['othersCount'] = $this->user_model->othersCount();
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
			//$this->load->view('email');
               echo $this->session->userdata('sucesslog');
               $this->session->unset_userdata('sucesslog');
			$this->load->model('user_model');  
			$query = $this->user_model->statusreport();
			$this->load->library('table');
			$tmpl = array (
                    'table_open'          => '<div id="issues" style ="z-index:1; position:relative; top:200px;"><table style = "table-layout:fixed;" class="curvedEdges">',

                    'heading_row_start'   => '<tr>',
                    'heading_row_end'     => '</tr>',
                    'heading_cell_start'  => '<th style="background-color:lightblue;text-align:left;white-space:nowrap;">',
                    'heading_cell_end'    => '</th>',

                    'row_start'           => '<tr class="hover">',
                    'row_end'             => '</tr>',
                    'cell_start'          => '<td class="standard"style="word-break:break-word">',
                    'cell_end'            => '</td>',

                    'row_alt_start'       => '<tr class="hover">',
                    'row_alt_end'         => '</tr>',
                    'cell_alt_start'      => '<td class="standard"style="word-break:break-word">',
                    'cell_alt_end'        => '</td>',

                    'table_close'         => '</table></div>'
                );
               $this->table->set_caption('<h2 class="tableheading">Issues Reported by GBP/Application Support Team</h2><p class ="count">'.$query->num_rows().' Records</p>');
			$this->table->set_template($tmpl);
			$statusreport = $this->table->generate($query);
			echo $statusreport;

               $query = $this->user_model->perfapp();

               $this->load->library('table');
              
               $this->table->set_caption('<br/><br/><h2 class="tableheading">Issues Reported by Application and Performance Support team (Extended Version)</h2><p class ="count">'.$query->num_rows().' Records');
               $this->table->set_template($tmpl);
               $perfapp = $this->table->generate($query);
               echo $perfapp;
			$query = $this->user_model->closed();
			
               $this->table->set_caption('<br/><br/><h2 class="tableheading">Closed Issues</h2><p class ="count">'.$query->num_rows().' Records');
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
                    'cell_start'          => '<td class="standard" style="word-break:break-word; padding-left:5px;">',
                    'cell_end'            => '</td>',

                    'row_alt_start'       => '<tr class="hover" style="word-break:break-word; padding-left:5px;">',
                    'row_alt_end'         => '</tr>',
                    'cell_alt_start'      => '<td class="standard">',
                    'cell_alt_end'        => '</td>',

                    'table_close'         => '</table></div>'
               );
               $this->table->set_caption('<h2 class="tableheading">Release Projects</h2><p class = "count">'.$query->num_rows().' Records</p>');
			$this->table->set_template($tmpl);
			echo $this->table->generate($query);
              	
		}
          function addform(){
               if(!isset($this->session->userdata['username']))
                    redirect('login');
               if($this->input->post('casenumber') == ''){
                    $this->session->set_userdata('error','<p class="errorlog">***Case Number Cannot be blank </p>');
                    redirect('home/create');
               }
               $path_parts = pathinfo($this->input->post('url'));

               $regularExpression = '/[^a-zA-Z\d\(\):]/';
               if(preg_match($regularExpression,$this->input->post('casenumber') )){
                    $this->session->set_userdata('error','<p class="errorlog">***Case Number Cannot have alpha numeric characters. </p>');
                    redirect('home/create/'.$path_parts['filename']);
               }
          




               
               $this->load->model('user_model');
               $add = $this->user_model->add();
               if($add){
                     $this->session->set_userdata('sucesslog','<p class="sucesslog">'.$add.'</p>');
                     redirect('home/update');
                }
               else{
                    $this->session->set_userdata('errorlog','<p class="errorlog">Case Id was already used. or Unable to Create.</p>'.$mes);
                    redirect('home/create');
               }
          }
		function charts(){
               if(!isset($this->session->userdata['username']))
                    redirect('login');

               $this->load->model('chart_model');
               $data['incidentSummary'] = $this->chart_model->incidentSummary();
               $data['incidentLoggedByProjects'] = $this->chart_model->incidentLoggedByProjects();
               $data['incidentLoggedByDate'] = $this->chart_model->incidentLoggedByDate();
               $data['incidentOpenByProject'] = $this->chart_model->incidentOpenByProject();
               $data['closedCasesByProject'] = $this->chart_model->closedCasesByProject();


			$this->load->view('header');
			$this->load->view('menu');
			$this->load->view('charts',$data);	
		}
		function email(){

               if(!isset($this->session->userdata['username']))
                    redirect('login');

               $this->load->model('user_model');
               $this->load->library('table');
               $tmp2 = array (
                              'table_open'          => '<table style = "font-size:12px;font-family:calibri;width:100%;table-layout:fixed;white-space:nowrap; border:1px solid">',

                              'heading_row_start'   => '<tr style="padding-left:5px">',
                              'heading_row_end'     => '</tr>',
                              'heading_cell_start'  => '<th style="border-collapse:collapse;border:1px solid;background-color:lightblue;text-align:center;white-space:nowrap;">',
                              'heading_cell_end'    => '</th>',

                              'row_start'           => '<tr style="border-left:1px">',
                              'row_end'             => '</tr>',
                              'cell_start'          => '<td style="padding:5px;border:1px solid; align:left;vertical-align:top;">',
                              'cell_end'            => '</td>',

                              'row_alt_start'       => '<tr style="border-left:1px">',
                              'row_alt_end'         => '</tr>',
                              'cell_alt_start'      => '<td style="padding:5px;border:1px solid;align:left;vertical-align:top;">',
                              'cell_alt_end'        => '</td>',

                              'table_close'         => '</table>'
                         );
               $tmp1 = array (
                              'table_open'          => '<table style = "font-size:12px;font-family:calibri;line-height:14px;width:450px;white-space:nowrap; overflow:auto;border:1px solid">',

                              'heading_row_start'   => '<tr>',
                              'heading_row_end'     => '</tr>',
                              'heading_cell_start'  => '<th style="border-collapse:collapse; border:1px solid;padding-left:5px; background-color:lightblue;text-align:center;white-space:nowrap;">',
                              'heading_cell_end'    => '</th>',

                              'row_start'           => '<tr style="border-left:1px dotted;">',
                              'row_end'             => '</tr>',
                              'cell_start'          => '<td style=" width:auto;border:1px solid;padding-left:13px; align:center;vertical-align:top;">',
                              'cell_end'            => '</td>',

                              'row_alt_start'       => '<tr style="border-left:1px dotted;">',
                              'row_alt_end'         => '</tr>',
                              'cell_alt_start'      => '<td style="padding:5px;border:1px solid;padding-left:13px; align:center;vertical-align:top;">',
                              'cell_alt_end'        => '</td>',

                              'table_close'         => '</table>'
                         );
               if($this->input->post('emailform')){
                    if(!$this->input->post('casesummary') && !$this->input->post('closed') && !$this->input->post('projectslist') && !$this->input->post('statusreport') ){
                         $this->session->set_userdata('errorlog','<p class="sucesslog">You should select atleast one Report !</p>');
                         redirect('home/emails');  
                    }

               
                    if($this->input->post('casesummary')){

                         $query = $this->user_model->ecasesummary();
                         $casesummary = '<b>Issue Summary </b> <br/>';
                         $this->table->set_template($tmp1);
                         $this->table->set_empty("0");
                         //$this->table->set_caption('Q1FY14-Issues Summary');
                         if($query->num_rows() > 0)
                           $casesummary .= $this->table->generate($query);
                         else
                         $casesummary =  "NO Projects";
                    }
                    if($this->input->post('statusreport')){
     
                        /* $query = $this->user_model->perfapp();
                         $this->table->set_template($tmp2);
                         $perfapp = '<b>Issues Reported by Application/Performance Team(Extended Version)  </b>'.$query->num_rows().' Records.<br/>';
                         $perfapp .= $this->table->generate($query);
                         //$perfapp .='<br/>'.$query->num_rows().'Records.'; */
                    

                         $query = $this->user_model->estatusreportinc(); 
                         $count = $query->num_rows();
                         $query = $query->result();

                         $estatusreportinc = '<b style=\"font-family:calibri;\">Issues Reported by  Support Teams  </b>    '.$count.' Records.<br/>';
                         $estatusreportinc .= "<table style = \"font-family:calibri;font-size:12px;line-height:14px;white-space:nowrap; border:1px solid;\">
                                        <tr style=\"border-collapse:collapse;border:1px solid;padding-left:6px;background-color:lightblue;text-align:left;white-space:nowrap;\">
                                            <th style=\"width:90px;text-align:left;white-space:nowrap;border:1px solid;\">Date</th>
                                            <th style=\"width:160px;text-align:left;white-space:nowrap;border:1px solid;\">Issue Number</th>
                                            <th style=\"width:100px;text-align:left;white-space:nowrap;border:1px solid;\">GBP</th>
                                            <th style=\"width:220px;text-align:left; white-space:nowrap;border:1px solid;\">Project</th>                                             
                                            <th style=\"width:220px;text-align:left;white-space:nowrap;border:1px solid;\">Application</th> 
                                            <th style=\"width:120px;text-align:left;white-space:nowrap;border:1px solid;\">Status</th>
                                            <th style=\"white-space:nowrap;text-align:left;border:1px solid;padding-right:3px;\">Release Related</th>
                                            <th style=\"width:235px;text-align:left;white-space:nowrap;border:1px solid;\">Summary</th>
                                            <th style=\"width:235px;text-align:left;white-space:nowrap;border:1px solid;\">Recommendations</th>
                                        </tr>";
                         foreach ($query as $row) {
                                   $estatusreportinc .= "<tr style=\"padding:5px;font-family:calibri;font-size:12px;line-height:14px; border:1px;\">
                                                    <td style=\"border:1px solid;\">". $row->ReportedDate ."</td>
                                                    <td style=\"width:160px;border:1px solid;\" >". $row->IssueNumber."</td>
                                                    <td style=\"border:1px solid;\" >". $row->GBP."</td>
                                                    <td style=\"width:180px;border:1px solid;white-space:pre-line; word-break:keep-all;\" >". $row->Project ."</td>
                                                    <td style=\"word-break:break-all;border:1px solid;word-break:keep-all;\" >". $row->Application ."</td>
                                                    <td style=\"border:1px solid;\">". $row->Status."</td>
                                                    <td style=\"border:1px solid;text-align:center;\">". $row->ReleaseRelated ."</td>  
                                                    <td style=\"width:235px;border:1px solid;white-space:pre-line; word-break:keep-all; \">".$row->Recommendations."</td> 
                                                    <td style=\"width:235px;border:1px solid;white-space:pre-line; word-break:keep-all; \">".$row->Summary."</td> 
                                                  </tr>";                           
                         }
                         $estatusreportinc .= "</table>";      

                         $query = $this->user_model->estatusreportpbi(); 
                         $count = $query->num_rows();
                         $query = $query->result();
                         $estatusreportpbi = '<b style=\"font-family:calibri;\">Issues Reported by  Performance Team  </b>    '.$count.' Records.<br/>';
                         $estatusreportpbi .= "<table style = \"font-family:calibri;font-size:12px;white-space:nowrap; border:1px solid;\">
                                        <tr style=\"border-collapse:collapse;border:1px solid;padding-left:6px;background-color:lightblue;text-align:left;white-space:nowrap;\">
                                            <th style=\"width:90px;text-align:left;white-space:nowrap;border:1px solid;\">Date</th>
                                            <th style=\"width:160px;text-align:left;white-space:nowrap;border:1px solid;\">Issue Number</th>
                                            <th style=\"width:100px;text-align:left;white-space:nowrap;border:1px solid;\">GBP</th>
                                            <th style=\"width:220px;text-align:left; white-space:nowrap;border:1px solid;\">Project</th>                                             
                                            <th style=\"width:220px;text-align:left;white-space:nowrap;border:1px solid;\">Application</th> 
                                            <th style=\"width:120px;text-align:left;white-space:nowrap;border:1px solid;\">Status</th>
                                            <th style=\"white-space:nowrap;text-align:left;border:1px solid;padding-right:3px;\">Release Related</th>
                                            <th style=\"width:235px;text-align:left;white-space:nowrap;border:1px solid;\">Summary</th>
                                            <th style=\"width:235px;text-align:left;white-space:nowrap;border:1px solid;\">Recommendations</th>
                                        </tr>";
                         foreach ($query as $row) {
                                   $estatusreportpbi .= "<tr style=\"padding:5px;font-family:calibri;font-size:12px;line-height:14px; border:1px;\">
                                                    <td style=\"border:1px solid;\">". $row->ReportedDate ."</td>
                                                    <td style=\"width:160px;border:1px solid;\" >". $row->IssueNumber."</td>
                                                    <td style=\"border:1px solid;\" >". $row->GBP."</td>
                                                    <td style=\"width:180px;border:1px solid;word-break:break-word;\" >". $row->Project ."</td>
                                                    <td style=\"word-break:break-all;border:1px solid;word-break:keep-all;\" >". $row->Application ."</td>
                                                    <td style=\"border:1px solid;\">". $row->Status."</td>
                                                    <td style=\"border:1px solid;text-align:center;\">". $row->ReleaseRelated ."</td>  
                                                    <td style=\"width:235px;border:1px solid;white-space:pre-line; \">".$row->Summary."</td>
                                                    <td style=\"width:235px;border:1px solid;white-space:pre-line; \">".  $row->Recommendations."</td> 
                                                  </tr>";                           
                         }
                         $estatusreportpbi .= "</table>";      





                    }
                    if($this->input->post('closed')){

                         $query = $this->user_model->closedforEmail();
                         $countclosed = $query->num_rows();
                         $closed = '<b>Closed Issues </b> '.$countclosed.' Records <br/>';
                         
                         $query = $query->result();
                         $closed .= "<table style = \"font-family:calibri; font-size:12px;line-height:14px;width:200%;white-space:nowrap; overflow:auto;border:1px solid\">
                                        <tr style=\"border-collapse:collapse;border:1px solid;padding-left:5px;background-color:lightblue;text-align:left;white-space:nowrap;\">
                                            <th style=\"width:90px;white-space:nowrap;border:1px solid;\">Date</th>
                                            <th style=\"width:160px;white-space:nowrap;border:1px solid;\">Issue Number</th>
                                            <th style=\"width:200px;white-space:pre-line; word-break:keep-all;border:1px solid;\">Application</th>    
                                            <th style=\"width:200px;white-space:nowrap;border:1px solid;\">Priority</th>  
                                            <th style=\"width:50px;white-space:nowrap;border:1px solid;\">DB/FE</th>
                                            <th style=\"width:100px;white-space:nowrap;border:1px solid;\">Database</th>
                                            <th style=\"white-space:nowrap;border:1px solid;\">Supported DB </th>
                                            <th style=\"width:90px;white-space:nowrap;border:1px solid;\">Analyst</th>
                                            <th style=\"width:90px;white-space:nowrap;border:1px solid;\">Status</th>
                                            <th style=\"white-space:nowrap;border:1px solid;\">Release Related</th>
                                            
                                            <th style=\"width:235px;text-align:left;white-space:nowrap;border:1px solid;\">Summary</th>
                                            <th style=\"width:235px;text-align:left;white-space:nowrap;border:1px solid;\">Recommendations</th>
                                            <th style=\"width:50px;white-space:nowrap;border:1px solid;\">Case/PBI</th>    
                                        </tr>";
                         foreach ($query as $row) {
                                   $closed .= "<tr style=\"border:1px;padding-left:5px;\">
                                                    <td style=\"width:90px;border:1px solid;\">". $row->IssueReportedDate ."</td>
                                                    <td style=\"border:1px solid;\" >". $row->CaseNo."</td>
                                                    <td style=\"width:200px;border:1px solid;white-space:pre-line;\" >". $row->Application ."</td>
                                                    <pre><td style=\"border:1px solid;width:200px; font-family:calibri;\" >". $row->Priority ."</td></pre>
                                                    <td  style='border:1px solid;text-align:center;width:50px;'>". $row->DBFE ."</td>
                                                    <td style=\"border:1px solid; width:100px; text-align:center;\">". $row->Database ."</td>
                                                    <td style=\"border:1px solid; width:80px; text-align:center;\">". $row->SupportedDB ."</td>
                                                    <td style=\"border:1px solid;text-align:center;\">". $row->Analyst ."</td>
                                                    <td style=\"border:1px solid;text-align:center;\">". $row->Status."</td>
                                                    <td style=\"border:1px solid; width:80px; text-align:center;\">". $row->ReleaseRelated ."</td>  
                                                    <td style=\" width:235px;border:1px solid;white-space:pre-line; \">".$row->Summary."</td>
                                                    <td style=\"width:235px;border:1px solid;white-space:pre-line; \">".  $row->Recommendations."</td> 
                                                    <td style='border:1px solid;text-align:center;'>". $row->CasePBI ."</td>
                                                  </tr>";                            
                         }
                         $closed .="</table>";
                         //$closed .= '<br/>'.$countclosed.'Records';
                    }
                    if($this->input->post('projectslist')){
                        
                         $query = $this->user_model->eprojectlist(); 
                         //$countprojects = $query->num_rows(); 
                         
                         $this->table->set_template($tmp1);
                         $releaseprojects = ' <b> Project List     </b> '.$query->num_rows().'  Projects<br/>';
                         $releaseprojects .= $this->table->generate($query);
                    }

                         $username = $this->session->userdata('username');
          			$this->load->library('email');
          			$this->email->set_newline("\r\n");
          			$this->email->from($username.'@cisco.com', '');
          			$this->email->to($username.'@cisco.com', ''); 
          			$this->email->subject('ATS Performance Normalization Report');
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
               
               if ($this->email->send()){
                    $this->session->set_userdata('sucesslog','<p class="sucesslog">Your Email has been sent!</p>');
				redirect('home/emails');
               }
			else
				echo $this->email->print_debugger();
          }
          }
          function emails(){
                if(!isset($this->session->userdata['username']))
                    redirect('login');
               echo $this->session->userdata('sucesslog');
               echo $this->session->userdata('errorlog');
               $this->session->unset_userdata('sucesslog');
               $this->session->unset_userdata('errorlog');

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
               //$this->load->view('search');
               $this->load->model('user_model');
               $query =  $this->user_model->search();
               $data['openCount'] = $this->user_model->Countopen();
               $data['closedCount'] = $this->user_model->Countclosed();
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
               $data['query'] = $query;
               if($query != false){
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
                    'cell_start'          => '<td style ="word-break:hyphenate;">',
                    'cell_end'            => '</td>',

                    'row_alt_start'       => '<tr>',
                    'row_alt_end'         => '</tr>',
                    'cell_alt_start'      => '<td style ="word-break:hyphenate;">',
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
          function curPageURL() {
               $pageURL = 'http';
               if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
               $pageURL .= "://";
               if ($_SERVER["SERVER_PORT"] != "80") {
               $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
               }
               else {
               $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
               }
               return $pageURL;
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

