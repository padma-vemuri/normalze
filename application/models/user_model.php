<?php
class User_model extends CI_Model{

	function validate(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$validate =  $this->db->query("select gdcp.perf_norm_pkg.validate_user('".$username."','".$password."') as valid from dual");

		if($validate)
			return $validate->result_array();
		else
			return false;
			# code...
	}

	function first_time_flag(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$flag = $this->db->query("select first_time_flag from gdcp.perf_assignments where assigned_to ='".$username."'");
		if($flag)
			return $flag->result_array();
		else
			return false;
	}		  

	function setpassword(){
		//$username = $this->input->post('username');
		$password = $this->input->post('password');
		$conpassword = $this->input->post('conpassword');
		$query = $this->db->query("call gdcp.perf_norm_pkg.user_op('".$this->session->userdata('username')."','".$password."')");
		if($query)
			return true;
		else
			return false;
	}

	function casesummary(){
		$query =$this->db->query("SELECT DISTINCT
						       a.project as \"Project\",
						       (  SELECT COUNT (1)
						            FROM gdcp.release_status_report_v b
						           WHERE     case_pbi = 'C'
						                 AND release_related = 'Y'
						                 AND SUBSTR (UPPER (status), 1, 3) NOT IN ('CLO', 'RES')
						                 AND a.project = b.project
						       			 GROUP BY project)
						          as \"Open\",
						       (  SELECT COUNT (1)
						            FROM gdcp.release_status_report_v b
						           WHERE     case_pbi = 'C'
						                 AND release_related = 'Y'
						                 AND SUBSTR (UPPER (status), 1, 3) IN ('CLO', 'RES')
						                 AND a.project = b.project
						        		 GROUP BY project)
						          as \"Closed\",
						       (  SELECT COUNT (1)
						            FROM gdcp.release_status_report_v b
						           WHERE     case_pbi = 'C'
						                 AND release_related = 'Y'
						                 AND a.project = b.project
						        			GROUP BY project)
						          as \"Total\"
						  				FROM gdcp.release_status_report_v a
										 WHERE case_pbi = 'C' AND release_related = 'Y'
						UNION
						SELECT 'Total' project,
						       (SELECT COUNT (1)
						          FROM gdcp.release_status_report_v b
						         WHERE     case_pbi = 'C'
						               AND release_related = 'Y'
						               AND SUBSTR (UPPER (status), 1, 3) NOT IN ('CLO', 'RES'))
						          open,
						       (SELECT COUNT (1)
						          FROM gdcp.release_status_report_v b
						         WHERE     case_pbi = 'C'
						               AND release_related = 'Y'
						               AND SUBSTR (UPPER (status), 1, 3) IN ('CLO', 'RES'))
						          Closed,
						       (select COUNT(1) from gdcp.release_status_report_v b
									where
							case_pbi = 'C'
						and release_related = 'Y') Total
						from gdcp.release_status_report_v a
						where case_pbi = 'C'
						and release_related = 'Y'
						and rownum = 1"
						);
		if($query){
			return $query;
		}else{
			return false;
		}
	}
	
	function open24(){
		$query =$this->db->query("SELECT case_no as \"Case No\", project as\"Project\", application as \"Application\", status as \"Status\"
								from gdcp.release_status_report_v
								where trunc(sysdate) - trunc(issue_reported_date) <= 1
								and case_pbi = 'C'");
		if($query){
			return $query;
		}else{
			return false;
		}
	}

	function cases24(){
		$query =$this->db->query("SELECT case_no as \"Case No\", project as\"Project\", application as \"Application\", status as \"Status\"
								from gdcp.release_status_report_v
 								where (trunc(sysdate) - trunc(last_update_date)) <= 1
								and case_pbi = 'C'");
		if($query){
			return $query;
		}else{
			return false;
		}
	}

	function update(){
		$query =$this->db->query("SELECT null as \"Update\", 

							ISSUE_REPORTED_DATE as \"IssueReportedDate\",
							CASE_NO as \"CaseNo\",

							APPLICATION as  \"Application\",
							PRIORITY as \"Priority\",
							DB_FE as \"DBFE\",
							DB as \"Database\",
							SUPPORTED_DB as \"SupportedDB\",
							ANALYST as \"Analyst\",
							STATUS as \"Status\",
							RELEASE_RELATED as \"ReleaseRelated\",
							'<div style=\"width:300px\">'||RECOMMENDATIONS||'</div>' as \"Recommendations\",
							SUMMARY  as \"Summary\",
							CASE_PBI as \"CasePBI\"
							from gdcp.RELEASE_STATUS_REPORT_V
							order by issue_reported_date desc,CASE_PBI asc, release_related desc 
							");
		if($query){
			return $query->result();
		}else{
			return false;
		}

	}

	function statusreport(){
		$query =$this->db->query("SELECT 
										'<div align=\"center\" style=\"width:90px\">'||ISSUE_REPORTED_DATE||'</div>'  as \"Reported Date\",
										'<div style=\"width:130px\">'||CASE_NO||'</div>' as \"Case No\",
										'<div align=\"center\"style=\"width:100px\">'||DECODE(CASE_PBI,'C','Support','Performance')||'</div>' as \"Reported By\",
										'<div align=\"center\"style=\"width:100px\">'||GBP||'</div>' as \"GBP\",
										'<div style=\"width:340px\">'||project||'</div>' as \"Project\",	
										'<div align=\"center\"style=\"width:140px; white-space:pre-wrap;\">'||APPLICATION||'</div>' as \"Application\",
										'<div align=\"center\"style=\"width:200px\">'||STATUS||'</div>'as \"Status\",
										'<div align=\"center\"style=\"width:60px\">'||RELEASE_RELATED ||'</div>'as \"Release Related\",
										'<div style=\"width:300px\">'||Summary||'</div>' as \"Issue Description\",
										'<div style=\"width:300px\">'||recommendations||'</div>' as \"Recommendation\"
										 from   gdcp.RELEASE_STATUS_REPORT_V  
										where case_pbi IN ('C','P')
										and SUBSTR(upper(status),1,3) NOT IN ('CLO', 'RES')
										--and release_related = 'Y'
										order by case_pbi asc, release_related desc, status asc,
										issue_reported_date desc
										");
		if($query){
			return $query;
		}else{
			return false;
		}

	}
	function perfapp(){
		$query =$this->db->query("SELECT 
											'<div align=\"center\" style=\"white-space:nowrap;width:130px\">'||ISSUE_REPORTED_DATE||'</div>'  as \"Reported Date\",
											'<div align=\"left\" style =\" white-space:wrap;width:340px;\">'||project||'</div>' as \"Project\",	
											'<div style=\"width:130px\">'||CASE_NO||'</div>'  as \"Case No\",
											'<div align=\"center\" style=\"width:100px;\">'||GBP||'</div>' as \"GBP\",
											'<div style=\"width:160px\">'||priority||'</div>'  as \"Priority\",
											'<div align=\"center\"style=\"width:140px; white-space:pre-wrap;\">'||APPLICATION||'</div>' as \"Application\",
											'<div align=\"center\"style=\"width:200px\">'||STATUS||'</div>'as \"Status\",
											'<div align=\"center\">'||RELEASE_RELATED ||'</div>'as \"Release Related\",
											'<div align=\"center\">'||DB_FE||'</div>' as \"DB/FE\",
											'<div align=\"center\" style=\"width:90px\">'||DB||'</div>' as \"DataBase\",
											'<div align=\"center\">'||SUPPORTED_DB||'</div>'  as \"Supported DB\" ,
											'<div align=\"center\" style=\"width:90px\">'||ANALYST||'</div>' as \"Analyst\",
											'<div style=\"width:300px\">'|| SUMMARY||'</div>' as \"Summary\",
											'<div style=\"width:300px\">'|| RECOMMENDATIONS||'</div>' as \"Recommendations\",
											'<div align=\"center\">'|| CASE_PBI ||'</div>'as \"Case PBI\"
											 from   gdcp.RELEASE_STATUS_REPORT_V 
											where case_pbi IN ('C','P')
											and SUBSTR(upper(status),1,3) NOT IN ('CLO', 'RES')
											--and release_related = 'Y'
											order by case_pbi asc, release_related desc, status asc,
											issue_reported_date desc
							");
		if($query){
			return $query;
		}else{
			return false;
		}

	}

	function closed(){
		$query =$this->db->query("SELECT 
								'<div align=\"center\" style=\"width:90px\">'||ISSUE_REPORTED_DATE||'</div>'  as \"Reported Date\",
								'<div style=\"width:130px\">'||CASE_NO||'</div>'  as \"Case No\",
								'<div align=\"center\" style=\"width:100px;\">'||GBP||'</div>' as \"GBP\",
								'<div align=\"center\"style=\"width:200px; white-space:pre-wrap;\">'||APPLICATION||'</div>' as \"Application\",
								'<div style=\"width:160px\"white-space:pre;>'||priority||'</div>'  as \"Priority\",
								'<div align=\"center\">'||DB_FE||'</div>' as \"DB/FE\",
								'<div align=\"center\" style=\"width:90px\">'||DB||'</div>' as \"DataBase\",
								'<div align=\"center\">'||SUPPORTED_DB||'</div>' as \"Supported DB\",
								'<div align=\"center\" style=\"width:90px\">'||ANALYST||'</div>' as \"Analyst\",
								'<div align=\"center\"style=\"width:200px\">'||STATUS||'</div>'as \"Status\",
								'<div align=\"center\">'||RELEASE_RELATED||'</div>' as \"Release Related\",
								'<div style=\"width:300px\">'|| RECOMMENDATIONS||'</div>' as \"Recommendations\",
								'<div style=\"width:300px\">'|| SUMMARY||'</div>' as \"Summary\",
								'<div align=\"center\">'||CASE_PBI||'</div>' as \"Case PBI\"
								 from   gdcp.RELEASE_STATUS_REPORT 
								where SUBSTR(upper(status),1,3) IN ('CLO', 'RES')
								order by db, issue_reported_date asc");	
		if($query){
			return $query;
		}else{
			return false;
		}	
		 }
	
	function projectlist(){
		$query =$this->db->query("SELECT  
									GBP as \"GBP\",PROJECT as \"Project\" from gdcp.RELEASE_PROJECTS order by GBP");
		if($query){
			return $query;
		}else{
			return false;
		}

	}
	function projectlist1(){
		$query =$this->db->query("SELECT  
									GBP as \"GBP\",PROJECT as \"Project\" from gdcp.RELEASE_PROJECTS order by GBP");
		if($query){
			return $query->result_array();
		}else{
			return false;
		}

	}

	function gbplist(){
		$gbp = $this->db->query("select distinct GBP from gdcp.RELEASE_PROJECTS order by gbp");
		if($gbp)
			return $gbp->result_array();
		else
			return false;
	}

	function analystlist(){
		$analyst = $this->db->query("select distinct assigned_to as assigned from gdcp.perf_assignments  order by assigned_to");
		if($analyst)
			return $analyst->result_array();
		else
			return false;

	}
	function search(){

		$search = $this->db->query("SELECT 
										'<div align=\"center\" style=\"width:90px\">'||ISSUE_REPORTED_DATE||'</div>'  as \"Reported Date\",
										'<div style=\"width:130px\">'||CASE_NO||'</div>' as \"Case No\",
										'<div align=\"center\"style=\"width:140px; white-space:pre-wrap;\">'||APPLICATION||'</div>' as \"Application\",
										'<div style=\"width:160px\">'||priority||'</div>'  as \"Priority\",
										'<div align=\"center\">'||DB_FE||'</div>' as \"DB/FE\",
										'<div align=\"center\" style=\"width:90px\">'||DB||'</div>' as \"DataBase\",
										'<div align=\"center\">'||SUPPORTED_DB||'</div>'  as \"Supported DB\" ,
										'<div align=\"center\" style=\"width:90px\">'||ANALYST||'</div>' as \"Analyst\",
										'<div align=\"center\"style=\"width:200px\">'||STATUS||'</div>'as \"Status\",
										'<div align=\"center\">'||RELEASE_RELATED ||'</div>'as \"Release Related\",
										'<div style=\"width:300px\">'|| RECOMMENDATIONS||'</div>' as \"Recommendations\",
										'<div style=\"width:300px\">'|| SUMMARY||'</div>' as \"Summary\",
										CASE_PBI as \"Case PBI\"
										 from  gdcp.RELEASE_STATUS_REPORT_V where ".$this->input->post('list')."= '".$this->input->post('search')."' order by ".$this->input->post('list') );
		if($search)
			return $search;
		else
			return false;

	}
	
	function add(){

		$s = $this->input->post('reporteddate');
		$date1 = strtotime($s);

		$old = $this->input->post('reporteddate1');
		$date1old = strtotime($old);

		$date1 = date('d-M-y',$date1);


				//select to_date(val, 'DD-MON-YYYY HH24:MI:SS') INTO l_date from dual;
	  			//	if($date1 != ''){
			$addform  = $this->db->query("call gdcp.perf_norm_pkg.ins_upd_report(
                                    '".$date1."',
                                    '".$this->input->post('casenumber')."',
                                    '".$this->input->post('gbplist')."',
                                    '".$this->input->post('prolist')."',
                                   	'".$this->input->post('application')."',
									'".$this->input->post('priority')."',
									'".$this->input->post('dbfe')."',
									'".$this->input->post('db')."',
                                    '".$this->input->post('supdb')."',
									'".$this->input->post('anallist')."',
									'".$this->input->post('status')."',
									'".$this->input->post('relrelated')."',
									'".$this->input->post('recommendations')."',
									'".$this->input->post('summary')."',
									'',
                                    '',
                                    '".$this->session->userdata['username']."',
                                    '".$this->session->userdata['username']."'
                                    )");
	    /*	}
		 else{
			
			$this->session->set_userdata('error','<p class="errorlog">** Your Date is invalid. Please follow MM-DD-YYYY format</p>');
			redirect('home/create');
		 }*/



				/*$addform  = $this->db->query(" call gdcp.perf_norm_pkg.ins_upd_report(
															 
															 '',
												             '$this->input->post('casenumber')',               
												             '$this->input->post('gbp')',                   
												             '$this->input->post('application')',           
												             '$this->input->post('priority')',             
												             '$this->input->post('dbfe')',
												             '$this->input->post('db')',                 
												             '$this->input->post('supporteddb')',
												             '$this->input->post('anallist')',
												             '$this->input->post('relrelated')',
												             '$this->input->post('recommendations')',
												             '$this->input->post('summary'),
												             '',
												             '',
												             '',
												             '',
												             '',
												             'venvemur',
												             'venvemur')");  */

	}

	function populate($id){
		 
		$query = $this->db->query("select * from gdcp.RELEASE_STATUS_REPORT_V where case_no like '".$id."%'");
		if($query->num_rows() == 1)
			return $query->result();
		else
			return false;
	}

//	function view($id){
	function view($id){
		
		$query = $this->db->query("select ISSUE_REPORTED_DATE as \"Reported Date\",
										  CASE_NO as \"Case No\",
										  APPLICATION as \"Application\",
										  PRIORITY as \"Priority\",
										  DB_FE as \"DB/FE\",

										  DB as \"Database\",
										  SUPPORTED_DB as \"Supported DB\",
										  ANALYST as \"Analyst\",
										  STATUS as \"Status\",
										  RELEASE_RELATED as \"ReleaseRelated\",
										  recommendations as \"Recommendations\",
										  summary as \"Summary\",
										  
										  LAST_UPDATE_DATE  as \"Last Updated Date\",
										  CREATED_BY as \"Created By\",
										  LAST_UPDATED_BY as \"Last Updated By\",
										  REVS as \"Revisions.\"

									from gdcp.RELEASE_STATUS_REPORT_REV where case_no like '".$id."%' order by REVS desc"); 
		if($query->num_rows() > 0)
			return $query;
		else
			return false;

	}


	function estatusreportinc(){
		$query =$this->db->query("SELECT 
										'<div align=\"center\" style=\"width:90px\">'||ISSUE_REPORTED_DATE||'</div>'  as \"Reported Date\",
										'<div style=\"width:130px\">'||CASE_NO||'</div>'  as \"Case No\",
										'<div align=\"center\" style=\"width:100px;\">'||GBP||'</div>' as \"GBP\",
										'<div style=\"width:340px\">'||project||'</div>' as \"Project\",	
										'<div align=\"center\"style=\"width:200px; white-space:pre-wrap;\">'||APPLICATION||'</div>' as \"Application\",
										'<div align=\"center\"style=\"width:200px\">'||STATUS||'</div>'as \"Status\",
										'<div align=\"center\">'||RELEASE_RELATED||'</div>' as \"Release Related\",
										'<div style=\"width:300px\">'|| SUMMARY||'</div>' as \"Summary\",
										'<div style=\"width:300px\">'|| RECOMMENDATIONS||'</div>' as \"Recommendations\"
										 from   gdcp.RELEASE_STATUS_REPORT_V  
										where case_pbi IN ('C','P')
										and SUBSTR(upper(status),1,3) NOT IN ('CLO', 'RES') and  case_no like 'INC%'
										--and release_related = 'Y'
										order by case_pbi asc, release_related desc, status asc,
										issue_reported_date desc
										");
		if($query){
			return $query;
		}else{
			return false;
		}
	}

	function estatusreportpbi(){
		$query =$this->db->query("SELECT 
										'<div align=\"center\" style=\"width:90px\">'||ISSUE_REPORTED_DATE||'</div>'  as \"Reported Date\",
										'<div style=\"width:130px\">'||CASE_NO||'</div>'  as \"Case No\",
										'<div align=\"center\" style=\"width:100px;\">'||GBP||'</div>' as \"GBP\",
										'<div style=\"width:340px\">'||project||'</div>' as \"Project\",	
										'<div align=\"center\"style=\"width:200px; white-space:pre-wrap;\">'||APPLICATION||'</div>' as \"Application\",
										'<div align=\"center\"style=\"width:200px\">'||STATUS||'</div>'as \"Status\",
										'<div align=\"center\">'||RELEASE_RELATED||'</div>' as \"Release Related\",
										'<div style=\"width:300px\">'|| SUMMARY||'</div>' as \"Summary\",
										'<div style=\"width:300px\">'|| RECOMMENDATIONS||'</div>' as \"Recommendations\"
										 from   gdcp.RELEASE_STATUS_REPORT_V  
										where case_pbi IN ('C','P')
										and SUBSTR(upper(status),1,3) NOT IN ('CLO', 'RES') and  case_no like 'PBI%'
										--and release_related = 'Y'
										order by case_pbi asc, release_related desc, status asc,
										issue_reported_date desc
										");
		if($query){
			return $query;
		}else{
			return false;
		}
	}

}


?>