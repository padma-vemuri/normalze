<?php
class Chart_model extends CI_Model{

	function incidentSummary(){
		$query =  $this->db->query("select case_history label, count# value from 
									(
										select 'Cases Logged/Reported' Case_History, 
										       count(1) count#, 1 sort_ord
										from   gdcp.release_status_report
										where  case_pbi = 'C'
										and release_related = 'Y'
										union
										select 'Cases Open' Case_History, 
										       count(1) count#, 2 sort_ord
										from   gdcp.release_status_report
										where  case_pbi = 'C'
										and    status <> 'Resolved'
										and release_related = 'Y'
										union
										select 'Cases Fixed' Case_History, 
										       count(1) count#, 3 sort_ord
										from   gdcp.release_status_report
										where  case_pbi = 'C'
										and    status = 'Resolved'
										and release_related = 'Y'
									)
									order by sort_ord");
		if($query){
			return $query->result_array();
		}
		else{
			return false;
		}
	}

	function incidentLoggedByProjects(){
		$query =  $this->db->query("select  project, value
										from 
											(select null link, project, count(1) value from 
											gdcp.release_status_report_v
											where case_pbi = 'C'
											and release_related = 'Y'
											--and status <> 'Resolved'
											group by project
											)"
									);
		if($query){
			return $query->result_array();
		}
		else{
			return false;
		}
	}

	function incidentLoggedByDate(){
		$query =  $this->db->query("select  to_char(issue_reported_date, 'DD-Mon') label, count(1) value 
										from   gdcp.release_status_report
										where  case_pbi = 'C'
										and release_related = 'Y'
										group by issue_reported_date
										order by issue_reported_date"
									);
		if($query){
			return $query->result_array();
		}
		else{
			return false;
		}
	}

	function incidentOpenByProject(){
		$query =  $this->db->query("select  Project label, count(1) value
										from   gdcp.release_status_report_v
										where  case_pbi = 'C'
										and    status in ('Open', 'WIP', 'Recommendations Provided')
										and release_related = 'Y'
										group by project");
		if($query){
			return $query->result_array();
		}
		else{
			return false;
		}
	}

	function closedCasesByProject(){
		$query =  $this->db->query("select null link, Project label, count(1) value
										from   gdcp.release_status_report_v
										where  case_pbi = 'C'
										and    status IN ('Resolved',  'Closed')
										and release_related = 'Y'
										group by project
");
		if($query){
			return $query->result_array();
		}
		else{
			return false;
		}
	}
}
