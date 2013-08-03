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
                             '<div style = \"width:330px;white-space:pre-line; word-break:keep-all;\"><a id = \"edit\" href=\"".base_url()."index.php/home/search?search=' || a.project_id||'&list=Project_id\">'||a.project||'</a></div>' as \"Project Name\",
                                 (  SELECT '<div>' ||COUNT (1)||'</div>'
                                    FROM gdcp.release_status_report_v b
                                   WHERE     case_pbi = 'C'
                                         AND release_related = 'Y'
                                         AND SUBSTR (UPPER (status), 1, 3) NOT IN ('CLO', 'RES')
                                         AND a.project = b.project
                                            GROUP BY project)
                                  as \"Open\",
                               (  SELECT '<div>' ||COUNT (1)||'</div>'
                                    FROM gdcp.release_status_report_v b
                                   WHERE     case_pbi = 'C'
                                         AND release_related = 'Y'
                                         AND SUBSTR (UPPER (status), 1, 3) IN ('CLO', 'RES')
                                         AND a.project = b.project
                                         GROUP BY project)
                                  as \"Closed\",
                               (  SELECT '<div style = \"font-weight:900;font-size:105%;color:black;\">' ||COUNT (1)||'</div>'
                                    FROM gdcp.release_status_report_v b
                                   WHERE     case_pbi = 'C'
                                         AND release_related = 'Y'
                                         AND a.project = b.project
                                            GROUP BY project)
                                  as \"Total\"
                                          FROM gdcp.release_status_report_v a
                                         WHERE case_pbi = 'C' AND release_related = 'Y'
                        UNION
                         SELECT '<p style =\"font-weight:900;font-size:105%;\"> Total </p>' as \"project\",
                               (SELECT '<div style = \"font-weight:900;font-size:105%;color:black;\">' ||COUNT (1)||'</div>'
                                  FROM gdcp.release_status_report_v b
                                 WHERE     case_pbi = 'C'
                                       AND release_related = 'Y'
                                       AND SUBSTR (UPPER (status), 1, 3) NOT IN ('CLO', 'RES'))
                                  open,
                               (SELECT'<div style = \"font-weight:900;font-size:105%;color:black;\">' ||COUNT (1)||'</div>'
                                  FROM gdcp.release_status_report_v b
                                 WHERE     case_pbi = 'C'
                                       AND release_related = 'Y'
                                       AND SUBSTR (UPPER (status), 1, 3) IN ('CLO', 'RES'))
                                  Closed,
                               (select '<div style = \"font-weight:900;font-size:105%;color:black;\">' ||COUNT (1)||'</div>' from gdcp.release_status_report_v b
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

	function ecasesummary(){
		$query =$this->db->query("SELECT DISTINCT
                             '<div>' || a.project||'</div>' as \"Project Name\",
                                 (  SELECT '<div>' ||COUNT (1)||'</div>'
                                    FROM gdcp.release_status_report_v b
                                   WHERE     case_pbi = 'C'
                                         AND release_related = 'Y'
                                         AND SUBSTR (UPPER (status), 1, 3) NOT IN ('CLO', 'RES')
                                         AND a.project = b.project
                                            GROUP BY project)
                                  as \"Open\",
                               (  SELECT '<div>' ||COUNT (1)||'</div>'
                                    FROM gdcp.release_status_report_v b
                                   WHERE     case_pbi = 'C'
                                         AND release_related = 'Y'
                                         AND SUBSTR (UPPER (status), 1, 3) IN ('CLO', 'RES')
                                         AND a.project = b.project
                                         GROUP BY project)
                                  as \"Closed\",
                               (  SELECT '<div style = \"font-weight:900;font-size:105%;color:black;\">' ||COUNT (1)||'</div>'
                                    FROM gdcp.release_status_report_v b
                                   WHERE     case_pbi = 'C'
                                         AND release_related = 'Y'
                                         AND a.project = b.project
                                            GROUP BY project)
                                  as \"Total\"
                                          FROM gdcp.release_status_report_v a
                                         WHERE case_pbi = 'C' AND release_related = 'Y'
                        UNION
                         SELECT '<p style =\"font-weight:900;font-size:105%;\"> Total </p>' as \"project\",
                               (SELECT '<div style = \"font-weight:900;font-size:105%;color:black;\">' ||COUNT (1)||'</div>'
                                  FROM gdcp.release_status_report_v b
                                 WHERE     case_pbi = 'C'
                                       AND release_related = 'Y'
                                       AND SUBSTR (UPPER (status), 1, 3) NOT IN ('CLO', 'RES'))
                                  open,
                               (SELECT'<div style = \"font-weight:900;font-size:105%;color:black;\">' ||COUNT (1)||'</div>'
                                  FROM gdcp.release_status_report_v b
                                 WHERE     case_pbi = 'C'
                                       AND release_related = 'Y'
                                       AND SUBSTR (UPPER (status), 1, 3) IN ('CLO', 'RES'))
                                  Closed,
                               (select '<div style = \"font-weight:900;font-size:105%;color:black;\">' ||COUNT (1)||'</div>' from gdcp.release_status_report_v b
                                    where
                            case_pbi = 'C'
                        and release_related = 'Y') Total
                        from gdcp.release_status_report_v a
                        where case_pbi = 'C'
                        and release_related = 'Y'
                        and rownum = 1");
		if($query){
			return $query;
		}else{
			return false;
		}

	}
	
	function open24(){
		$query =$this->db->query("SELECT 

									'<div style=\"word-break:break-all;width:90px;\">
										<a id = \"edit\" href=\"".base_url()."index.php/home/search?search='||case_no||'&list=CASE_NO\">'||case_no||'</a></div>' as \"Issue Number\", 

									'<div style=\"word-break:keep-all;width:160px;\">
										<a id = \"edit\" href=\"".base_url()."index.php/home/search?search='||Project_id||'&list=Project_id\">'||project||'<a/></div>' as\"Project Name\", 
									'<div style=\"word-break:keep-all;width:160px;\">'||APPLICATION||'</div>' as  \"Application\",
																						status as \"Status\"
										from gdcp.release_status_report_v
										where trunc(sysdate) - trunc(issue_reported_date) <= 1 and case_pbi = 'C'");
		if($query){
			return $query;
		}else{
			return false;
		}
	}

	function cases24(){
		$query =$this->db->query("SELECT 
									'<div style=\"word-break:break-all;width:90px;\">
										<a  id = \"edit\" href=\"".base_url()."index.php/home/search?search='||case_no||'&list=CASE_NO\">'||case_no||'</a></div>' as \"Issue Number\",
									'<div style=\"word-break:keep-all;width:160px;\">
										<a id = \"edit\" href=\"".base_url()."index.php/home/search?search='||Project_id||'&list=Project_id\">'||project||'<a/></div>' as\"Project Name\", 
									'<div style=\"word-break:keep-all;width:160px;\">'||APPLICATION||'</div>' as  \"Application\",
									status as \"Status\"
											from gdcp.release_status_report_v
 										where (trunc(sysdate) - trunc(last_update_date)) <= 1 and case_pbi = 'C'");
		if($query){
			return $query;
		}else{
			return false;
		}
	}

	function update(){
		$query =$this->db->query("SELECT ID, 

							'<div style=\"width:60px;\">'||ISSUE_REPORTED_DATE||'</div>' as \"IssueReportedDate\",
							CASE_NO as \"CaseNo\",
							'<div   style=\"width:60px;\">'||gbp||'</div>' as \"GBP\",
							
							'<div style=\"width:200px;white-space:pre-line; word-break:keep-all;\">'||project||'</div>' as \"Project\",
							'<div style=\"width:180px; word-break:hyphenate;\">'||APPLICATION||'</div>' as  \"Application\",
							'<div style=\"width:180px;white-space:pre-line; word-break:keep-all;\">'||PRIORITY||'</div>' as \"Priority\",
							DB_FE as \"DBFE\",
							'<div style=\"width:100px;white-space:pre-line; word-break:keep-all;\">'||DB||'</div>' as \"Database\",
							SUPPORTED_DB as \"SupportedDB\",
							ANALYST as \"Analyst\",
							STATUS as \"Status\",
							RELEASE_RELATED as \"ReleaseRelated\",
							'<div style=\"width:235px; word-break:hyphenate;white-space:pre-line;\">'||SUMMARY||'</div>'  as \"Summary\",
							'<div style=\"width:235px;white-space:pre-line; word-break:hyphenate;\">'||RECOMMENDATIONS||'</div>' as \"Recommendations\",CASE_PBI as \"CasePBI\"
							from gdcp.RELEASE_STATUS_REPORT_V
							order by CASE_PBI asc, release_related desc, decode(status,'Open',1),issue_reported_date desc,project 
							");
		if($query){
			return $query->result();
		}else{
			return false;
		}

	}
	function countPBI($rr,$status){
		if($status == 'Closed')
			$query =$this->db->query(" select count(Case_no) as \"CLOSED\" from gdcp.release_status_report_V where Status  in ('Closed','Resolved') and case_pbi = 'P'  and release_related = '".$rr."'");
		elseif($status == 'Open')
			$query =$this->db->query(" select count(Case_no) as \"OPEN\" from gdcp.release_status_report_V where Status not in ('Closed','Resolved') and case_pbi = 'P'  and release_related = '".$rr."'");

		if($query)
			return $query->result();
		else
			return false;
			}
	function countINC($rr,$status){

		
		if($status == 'Closed')
			$query =$this->db->query(" select count(Case_no) as \"CLOSED\" from gdcp.release_status_report_V where Status  in ('Closed','Resolved') and case_pbi = 'C'  and release_related = '".$rr."'");
		elseif($status == 'Open')
			$query =$this->db->query(" select count(Case_no) as \"OPEN\" from gdcp.release_status_report_V where Status not in ('Closed','Resolved') and case_pbi = ''  and release_related = '".$rr."'");

		if($query){
			return $query->result();
		}else
		return false;
	}




	function openCountR(){
		$query =$this->db->query(" select count(Case_no) as \"OPEN\" from gdcp.release_status_report_V where Status not in ('Closed','Resolved')  and release_related = 'Y' ");
		if($query){
			return $query->result();
		}else
		return false;
	}
	function closedCountR(){
		$query =$this->db->query(" select count(Case_no) as \"CLOSED\" from gdcp.release_status_report_V where Status in ('Closed','Resolved') and release_related = 'Y' ");
		if($query){
			return $query->result();
		}else
		return false;
	}


	function openCountNR(){
		$query =$this->db->query(" select count(Case_no) as \"OPEN\" from gdcp.release_status_report_V where Status not in ('Closed','Resolved')  and release_related = 'N' ");
		if($query){
			return $query->result();
		}else
		return false;
	}
	function closedCountNR(){
		$query =$this->db->query(" select count(Case_no) as \"CLOSED\" from gdcp.release_status_report_V where Status in ('Closed','Resolved') and release_related = 'N' ");
		if($query){
			return $query->result();
		}else
		return false;
	}
	/*function othersCount(){
		$query =$this->db->query(" select count(Case_no) as \"OTHERS\" from gdcp.release_status_report_V where Status <> 'Closed' and status <> 'Open'");
		if($query){
			return $query->result();
		}else
		return false;
	}*/

	function CountopenRelated(){

		$searchString = remove_characters($this->input->get('search'));
		$list  = $this->input->get('list');
		$collumns =  'count (status) as "OPEN" from  gdcp.RELEASE_STATUS_REPORT_V where';

			
		$query = $this->db->query("SELECT ".$collumns." Status <> 'Closed' and Status <>'Resolved'  and ".$list." = '".$searchString."' and release_related = 'Y'  order by ".$list );
		if($query){
			return $query->result();
		}else
		return false;

	}
	function CountclosedRelated(){

		$searchString = remove_characters($this->input->get('search'));
		$list  = $this->input->get('list');
		$collumns =  'count (status) as "CLOSED" from  gdcp.RELEASE_STATUS_REPORT_V where ';
			
		$query = $this->db->query("SELECT ".$collumns."  status in ('Closed','Resolved')  and ".$list." = '".$searchString."' and release_related = 'Y'  order by ".$list );
		if($query){
			return $query->result();
		}else
		return false;

	}

	function CountopenNotRelated(){

		$searchString = remove_characters($this->input->get('search'));
		$list  = $this->input->get('list');
		$collumns =  'count (status) as "OPEN" from  gdcp.RELEASE_STATUS_REPORT_V where';

			
		$query = $this->db->query("SELECT ".$collumns." Status <> 'Closed' and Status <>'Resolved'  and ".$list." = '".$searchString."' and release_related = 'N'  order by ".$list );
		if($query){
			return $query->result();
		}else
		return false;

	}

	function CountclosedNotRelated(){

		$searchString = remove_characters($this->input->get('search'));
		$list  = $this->input->get('list');
		$collumns =  'count (status) as "CLOSED" from  gdcp.RELEASE_STATUS_REPORT_V where ';
			
		$query = $this->db->query("SELECT ".$collumns."  status in ('Closed','Resolved')  and ".$list." = '".$searchString."' and release_related = 'N'   order by ".$list );
		if($query){
			return $query->result();
		}else
		return false;

	}








	function statusreport(){
		$query =$this->db->query("SELECT 
										'<div align=\"left\" style=\"width:60px\">'||ISSUE_REPORTED_DATE||'</div>'  as \"Date\",
										'<div style=\"width:140px\">'||CASE_NO||'</div>' as \"Issue Number\",
										'<div align=\"left\"style=\"width:100px\">'||DECODE(CASE_PBI,'C','Support','Performance')||'</div>' as \"Reported By\",
										'<div align=\"left\"style=\"width:100px\">'||GBP||'</div>' as \"GBP\",
										'<div style=\"width:200px;white-space:pre-line; word-break:keep-all;\">'||project||'</div>' as \"Project Name\",	
										'<div align=\"left\"style=\"width:180px;word-break:keep-all; white-space:pre-wrap;\">'||APPLICATION||'</div>' as \"Application\",
										'<div align=\"left\"style=\"width:160px\">'||STATUS||'</div>'as \"Status\",
										'<div align=\"center\">'||RELEASE_RELATED ||'</div>'as \"Release Related\",
										'<div style=\"width:235px;white-space:pre-line;word-break:keep-all;\">'||Summary||'</div>' as \"Summary\",
										'<div style=\"width:235px;white-space:pre-line; word-break:keep-all;\">'||recommendations||'</div>' as \"Recommendations\"
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
											'<div align=\"left\" style=\"white-space:nowrap;width:60px\">'||ISSUE_REPORTED_DATE||'</div>'  as \"Date\",	
											'<div style=\"width:140px\">'||CASE_NO||'</div>'  as \"Issue Number\",
											'<div align=\"left\" style =\"white-space:pre-line; word-break:keep-all;width:200px;\">'||project||'</div>' as \"Project Name\",
											'<div align=\"left\" style=\"width:100px;\">'||GBP||'</div>' as \"GBP\",
											'<div style=\"width:160px;white-space:pre-line; word-break:hyphenate;\">'||PRIORITY||'</div>' as \"Priority\",
											'<div align=\"left\"style=\"width:180px; word-break:keep-all;white-space:pre-wrap;\">'||APPLICATION||'</div>' as \"Application\",
											'<div align=\"left\"style=\"width:160px\">'||STATUS||'</div>'as \"Status\",
											'<div align=\"center\">'||RELEASE_RELATED ||'</div>'as \"Release Related\",
											'<div align=\"center\">'||DB_FE||'</div>' as \"DB/FE\",
											'<div align=\"center\" style=\"width:90px\">'||DB||'</div>' as \"DataBase\",
											'<div align=\"center\">'||SUPPORTED_DB||'</div>'  as \"Supported DB\" ,
											'<div align=\"left\" style=\"width:90px\">'||ANALYST||'</div>' as \"Analyst\",
											'<div style=\"width:235px;white-space:pre-line; word-break:keep-all;\">'|| SUMMARY||'</div>' as \"Summary\",
											'<div style=\"width:235px;white-space:pre-line; word-break:keep-all;\">'|| RECOMMENDATIONS||'</div>' as \"Recommendations\",
											'<div align=\"center\">'|| CASE_PBI ||'</div>'as \"Case/PBI\"
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
								'<div align=\"left\" style=\"width:60px\">'||ISSUE_REPORTED_DATE||'</div>'  as \"Date\",
								'<div style=\"width:140px\">'||CASE_NO||'</div>'  as \"Issue Number\",
								'<div align=\"left\" style=\"width:100px;\">'||GBP||'</div>' as \"GBP\",
								'<div align=\"left\"style=\"width:180px; white-space:pre-line; word-break:keep-all;\">'||APPLICATION||'</div>' as \"Application\",
								'<pre><div style=\"width:160px; font-family:calibri;\">'||priority||'</div></pre>'  as \"Priority\",
								'<div align=\"center\">'||DB_FE||'</div>' as \"DB/FE\",
								'<div align=\"center\" style=\"width:90px\">'||DB||'</div>' as \"DataBase\",
								'<div align=\"center\">'||SUPPORTED_DB||'</div>' as \"Supported DB\",
								'<div align=\"left\" style=\"width:90px\">'||ANALYST||'</div>' as \"Analyst\",
								'<div align=\"left\"style=\"width:160px\">'||STATUS||'</div>'as \"Status\",
								'<div align=\"center\">'||RELEASE_RELATED||'</div>' as \"Release Related\",
								'<div style=\"width:235px;white-space:pre-line;word-break:keep-all;\">'|| SUMMARY||'</div>' as \"Summary\",
								'<div style=\"width:235px;white-space:pre-line; word-break:keep-all;\">'|| RECOMMENDATIONS||'</div>' as \"Recommendations\",
								'<div align=\"center\">'||CASE_PBI||'</div>' as \"Case/PBI\"
								 from   gdcp.RELEASE_STATUS_REPORT 
								where SUBSTR(upper(status),1,3) IN ('CLO', 'RES')
								order by db, issue_reported_date asc");	
		if($query){
			return $query;
		}else{
			return false;
		}	
	}

	function closedforEmail(){
		$query =$this->db->query("SELECT
								ISSUE_REPORTED_DATE as \"IssueReportedDate\",
								CASE_NO as \"CaseNo\",
								'<div align=\"left\"style=\"width:200px; word-break:keep-all;\">'||APPLICATION||'</div>' as \"Application\",
								PRIORITY as \"Priority\",
								DB_FE as \"DBFE\",
								DB as \"Database\",
								SUPPORTED_DB as \"SupportedDB\",
								ANALYST as \"Analyst\",
								STATUS as \"Status\",
								'<div style=\"\">'||RELEASE_RELATED||'</div>' as \"ReleaseRelated\",
								'<div style=\"width:300px; \"><pre style =\"font-family:calibri; font-size:12px;\">'||SUMMARY||'</pre></div>'  as \"Summary\",
								'<div style=\"width:300px; \"><pre style =\"font-family:calibri; font-size:12px;\">'||RECOMMENDATIONS||'</pre></div>' as \"Recommendations\",
								CASE_PBI as \"CasePBI\"
								from gdcp.RELEASE_STATUS_REPORT
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
									'<a id = \"edit\" href=\"".base_url()."index.php/home/search?search=' ||Gbp||'&list=gbp\">'||GBP||'</a>' as \"GBP\",
									'<a id = \"edit\" href=\"".base_url()."index.php/home/search?search=' ||project_id||'&list=	Project_id\">'||project||'</a>' as \"Project Name\"
									from gdcp.RELEASE_PROJECTS order by GBP");
		if($query){
			return $query;
		}else{
			return false;
		}

	}
	function eprojectlist(){
		$query =$this->db->query("SELECT  
									GBP as \"GBP\",PROJECT as \"Project Name\" from gdcp.RELEASE_PROJECTS order by GBP");
		if($query){
			return $query;
		}else{
			return false;
		}

	}

	function projectlist1(){
		$query =$this->db->query("SELECT  
									GBP as \"GBP\",PROJECT as \"Project\" from gdcp.RELEASE_PROJECTS order by PROJECT");
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
		function remove_characters($str){
			$find =    array("+","*","%","/");
			$replace = array("%","%","%","/");
			return    str_replace($find, $replace, $str);
		}
		$searchString = remove_characters($this->input->get('search'));
		$list  = $this->input->get('list');
		
		$collumns =  'ID,
							\'<div   style="width:60px;">\'||ISSUE_REPORTED_DATE||\'</div>\'  as "IssueReportedDate",
							CASE_NO as "CaseNo",
							\'<div   style="width:60px;">\'||gbp||\'</div>\' as "GBP",
							\'<div style="width:200px;white-space:pre-line; word-break:keep-all;">\'||project||\'</div>\' as "Project",
							\'<div style="width:180px; word-break:hyphenate;\">\'||APPLICATION||\'</div>\' as  "Application",
							\'<div style="width:180px;white-space:pre-line; word-break:hyphenate;">\'||PRIORITY||\'</div>\' as "Priority",
							DB_FE as "DBFE",
							DB as "Database",
							SUPPORTED_DB as "SupportedDB",
							ANALYST as "Analyst",
							STATUS as "Status",
							RELEASE_RELATED as "ReleaseRelated",
							\'<div  style="width:235px;white-space:pre-line; word-break:hyphenate;">\'||SUMMARY||\'</div>\'  as "Summary",
							\'<div  style="width:235px;white-space:pre-line; word-break:hyphenate;">\'||RECOMMENDATIONS||\'</div>\' as "Recommendations",
							CASE_PBI as "CasePBI" from  gdcp.RELEASE_STATUS_REPORT_V where';
			
		$search = $this->db->query("SELECT ".$collumns." ".$list." like '".$searchString."' order by  CASE_PBI asc, release_related desc, decode(status,'Open',1),issue_reported_date desc,project" );
		
		if($search){
			if ($search->num_rows() < 1){
				$search = $this->db->query("SELECT ".$collumns." lower(".$list.") like '".$searchString."' order by ".$list );	
				if($search && $search->num_rows() < 1){
					$search = $this->db->query("SELECT ".$collumns." upper(".$list.") like '".$searchString."' order by ".$list );
					if($search && $search->num_rows() > 0)	
						return $search->result();
					elseif($search->num_rows() < 1){
						$search = $this->db->query("SELECT ".$collumns." lower(".$list.") like '".$searchString."%' order by ".$list );
						
						if($search && $search->num_rows() > 0)
							return $search->result();
						
						elseif($search->num_rows() < 1){
							$search = $this->db->query("SELECT ".$collumns." lower(".$list.") like '%".$searchString."%' order by ".$list );
							if($search && $search->num_rows() > 0)
								return $search->result();
							else
								return false;
						}
						else
							return false;
					}
					else
						return false;
				}elseif($search && $search->num_rows() > 0)
					return $search->result();
				else
					return false;
			}
			elseif($search && $search->num_rows() > 0)
				return $search->result();
			else
				return false;
		}
		
		else
			return false;
	}
	
	function add(){

		$noQuoteRecc = str_replace("'","''",$this->input->post('recommendations'));
		$noQuoteSumm = str_replace("'","''",$this->input->post('summary'));
		$noQuoteApp = str_replace("'","''",$this->input->post('application'));
		$noQuotePri = str_replace("'","''",$this->input->post('priority'));
		$noQuoteDb = str_replace("'","''",$this->input->post('db'));

		$no_spaces_case_num = preg_replace('/\ |\ /','',$this->input->post('casenumber'));
		  $search = preg_replace('/\(|\)/','',$no_spaces_case_num);
  		  $search = preg_replace('/\ |\ /','',$search);
     
    		 $pattern = '/PAGED/';
    		 $replacement = '';
  			 $incnumber = preg_replace($pattern,$replacement ,$search); 

		if($this->input->post('submit')){
			$s = 	$this->input->post('reporteddate');
			if($s){
				$date1 = strtotime($s);
				$date1 = date('d-M-y',$date1);
			}
			else
				$date1 = '';

			$checkCaseNumber = $this->db->query('select * from gdcp.release_status_report where  case_no =\''.$incnumber.'\'');
			$checkCaseNumber = $checkCaseNumber->num_rows();
			if($checkCaseNumber > 1 && $this->input->post('caseid') == ''){
				$message = 'Case ID/Issue has already used ';
				return $message;
			}
			elseif($checkCaseNumber > 0 && $this->input->post('caseid') != '' || $checkCaseNumber == 0    ){
					$addform  = $this->db->query("call gdcp.perf_norm_pkg.ins_upd_report('".$this->input->post('caseid')."',
					                                '".$date1."',
					                                '".strtoupper($no_spaces_case_num)."',
					                                '".$this->input->post('gbplist')."',
					                                '".$this->input->post('prolist')."',
					                               	'".$noQuoteApp."',
													'".$noQuotePri."',
													'".$this->input->post('dbfe')."',
													'".$noQuoteDb."',
					                                '".$this->input->post('supdb')."',
													'".$this->input->post('anallist')."',
													'".$this->input->post('status')."',
													'".$this->input->post('relrelated')."',
													'".$noQuoteRecc."',
													'".$noQuoteSumm."',
													'',
					                                '',
					                                '".$this->session->userdata['username']."',
					                                '".$this->session->userdata['username']."'
					                                )");
					if($addform){
						$message = 'Case/Issue has been Created/Updated.';
						return $message;
					}
					else 
						return false;
				}
		}
		elseif($this->input->post('delete')){
			$query = $this->db->query("delete from gdcp.release_status_report where case_no like '".$no_spaces_case_num."'");
			if($query)
				$query = $this->db->query("delete from gdcp.release_status_report_rev where case_no like '".$no_spaces_case_num."'");
			if($query){
				$message = "Case/Issue has been Deleted.";
				return $message; 
			}
			else{
				$message = "Issue/Case was not Deleted. Please try Again.";
				return $message;
			}
		}

	    

	}

	function populate($id){
		 
		$query = $this->db->query("select * from gdcp.RELEASE_STATUS_REPORT_V where case_no like '".$id."%'");
		if($query->num_rows() == 1)
			return $query->result();
		else
			return false;
	}

//	Audit...
	function view($id){
		$que = $this->db->query("select ID from gdcp.RELEASE_STATUS_REPORT where case_no like '".$id."%' ");
		 $que = $que->result_array();
		foreach ($que as $row) {
			$idid = $row['ID'];
		}

		 $query = $this->db->query("select ISSUE_REPORTED_DATE as \"Reported Date\",
										  CASE_NO as \"Issue Number\",
										  '<div style=\"width:160px; word-break:break-all; white-space:pre-line;\">'||APPLICATION||'</div>' as \"Application\",
										  '<div style=\"width:160px; word-break:break-all; white-space:pre-line;\">'||PRIORITY||'</div>' as \"Priority\",
										  '<div align=\"center\">'||DB_FE||'</div>'   as \"DB/FE\",

										  DB as \"Database\",
										  '<div align=\"center\">'||SUPPORTED_DB||'</div>'  as \"Supported DB\",
										  ANALYST as \"Analyst\",
										  STATUS as \"Status\",
										   '<div align=\"center\">'||RELEASE_RELATED||'</div>'   as \"ReleaseRelated\",
										  '<div style=\"width:300px; word-break:break-all; white-space:pre-line;\">'||summary||'</div>' as \"Summary\",
										  '<div style=\"width:300px; word-break:break-all; white-space:pre-line;\">'||recommendations||'</div>' as \"Recommendations\",
										 	to_char(last_update_date,'mm/dd/yyyy hh:mi:ss AM')  as \"Last Updated Date(PST)\",
										  CREATED_BY as \"Created By\",
										  LAST_UPDATED_BY as \"Last Updated By\",
										   '<div align=\"center\">'||REVS||'</div>' as \"Revisions.\"

									from gdcp.RELEASE_STATUS_REPORT_REV where ID like '".$idid."' order by REVS desc"); 
		if($query->num_rows() > 0)
			return $query;
		else
			return false;

	}


	function estatusreportinc(){

		$cols =  "SELECT 
										ISSUE_REPORTED_DATE as \"ReportedDate\",
										CASE_NO  as \"IssueNumber\",
										GBP as \"GBP\",
										PROJECT as \"Project \",
										APPLICATION as \"Application\",
										STATUS  as \"Status\",
										RELEASE_RELATED as \"ReleaseRelated\",
										'<pre style=\"font-family:calibri;font-size:12px;\">'||SUMMARY||'</pre>'  as \"Summary\",
										'<pre style=\"font-family:calibri;font-size:12px;\">'||RECOMMENDATIONS||'</pre>' as \"Recommendations\"
										 from   gdcp.RELEASE_STATUS_REPORT_V  
										where case_pbi IN ('C','P')
										and SUBSTR(upper(status),1,3) NOT IN ('CLO', 'RES')";

		$query =$this->db->query($cols." and  case_no like 'INC%'
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
		$cols =  "SELECT 
										ISSUE_REPORTED_DATE as \"ReportedDate\",
										CASE_NO  as \"IssueNumber\",
										GBP as \"GBP\",
										PROJECT as \"Project\",
										APPLICATION as \"Application\",
										STATUS  as \"Status\",
										RELEASE_RELATED as \"ReleaseRelated\",
										'<pre style=\"font-family:calibri;word-break:break-word; font-size:12px;\">'||SUMMARY||'</pre>'  as \"Summary\",
										'<pre style=\"font-family:calibri;word-break:break-word; font-size:12px;\">'||RECOMMENDATIONS||'</pre>' as \"Recommendations\"
										 from   gdcp.RELEASE_STATUS_REPORT_V  
										where case_pbi IN ('C','P')
										and SUBSTR(upper(status),1,3) NOT IN ('CLO', 'RES') ";

		$query =$this->db->query($cols." and  case_no like 'PBI%'
										
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