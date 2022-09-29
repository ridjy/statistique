<?php if ( ! defined('BASEPATH')) exit('No direct script access
allowed');

class Statistique_model extends CI_Model
{
	protected $table = 'campaign';
	public function __construct()
	{
		// Obligatoire
		parent::__construct();
		//$this->load->database('base1',TRUE);
		//$DB2=$this->load->database('default',TRUE);
		$host = "10.0.1.34";
		$user = "root";
		$pass = "";
		$db = "ireflet";
		$con = mysql_connect($host,$user,$pass);
		$select_bd = mysql_select_db($db);
	}
	
	public function get_campagneID($c)
	{
		//$db1=$this->load->database('ireflet',TRUE);
		//$DB1=$this->load->database('ireflet',TRUE);
		/*$query = $DB1->query("SELECT Id FROM campaign WHERE Name='".$c."'");
		$query = $DB1->get();
		$row=$query->result();
		return $row;
		$this->db->select('Id');
		$this->db->from('campaign');
		$this->db->where('Name',$c);
		$this->db->limit(1);
		$query = $this->db->get();
		$row=$query->result();
		return $row;*/
		
		$select_id_campagne = 'SELECT c.Id AS "id" FROM ireflet.campaign AS C WHERE C.`Name`="'.$c.'"';
		$id_campagne = mysql_query($select_id_campagne);
		$idcampagne = mysql_fetch_array($id_campagne);
		return $idcampagne['id'];
	}

	public function get_stat_jour($base,$id,$datetraite)
	{
		$globale_query = 'SELECT
			FROM_UNIXTIME(S.CreationDate/1000,"%d-%m-%Y") AS "Date",
			COUNT(S.CallerAddress) AS "TOUT",
			COALESCE(SUM(Q.Label NOT IN ("HORS PLAGE"))) AS "EN_PLAGE",
			COALESCE(SUM(Q.LABEL LIKE "%ABAN%" AND ROUND((S.WaitingImrDuration / 1000),2)=0) - SUM(Q.LABEL LIKE "%aband%" AND S.FirstAgentId IS NOT NULL AND ROUND((S.WaitingImrDuration / 1000),2)=0)) AS "ABANDONNE_PERDU -15",
			COALESCE(SUM(Q.LABEL LIKE "%ABAN%" AND ROUND((S.WaitingImrDuration / 1000),2)>0) - SUM(Q.LABEL LIKE "%aband%" AND S.FirstAgentId IS NOT NULL AND ROUND((S.WaitingImrDuration / 1000),2)>0)) AS "ABANDONNE_PERDU +15",
			COALESCE(SUM(Q.LABEL IN ("HORS PLAGE"))) AS "DISSUADE_PERDU",
			COALESCE((SUM(Q.LABEL LIKE "%ABAN%") - SUM(Q.LABEL LIKE "%abandonn%" AND S.FirstAgentId IS NOT NULL)) + (SUM(Q.LABEL IN ("HORS PLAGE")))) AS "PERDUS",
			COALESCE(SUM(Q.LABEL="Qualification automatique")) AS "QUALIFIES",
			COALESCE(SUM(Q.LABEL LIKE "%Aband%" AND S.FirstAgentId IS NOT NULL)) AS "ABANDONNE_PARKING",
			COALESCE(SUM(Q.Label LIKE "%Dissua%" AND S.FirstAgentId IS NOT NULL)) AS "TRANSFERE_PARKING",
			COALESCE(SUM(Q.LABEL="Qualification automatique") + SUM(Q.LABEL LIKE "%Aband%" AND S.FirstAgentId IS NOT NULL) + SUM(Q.Label LIKE "%Dissua%" AND S.FirstAgentId IS NOT NULL)) AS "SERVIS",
									
			COALESCE(SUM(Q.LABEL = "Qualification automatique" AND S.FirstAgentId IS NOT NULL AND ROUND((S.WaitingImrDuration / 1000),2)=0)
			+ SUM(Q.LABEL LIKE "%Abandon%" AND S.FirstAgentId IS NOT NULL AND ROUND((S.WaitingImrDuration / 1000),2)=0)
			+ SUM(Q.LABEL LIKE "%DISSUA%" AND S.FirstAgentId IS NOT NULL AND ROUND((S.WaitingImrDuration / 1000),2)=0)) AS "SANS_ATTENTE",
							
			COALESCE(SUM(Q.LABEL = "Qualification automatique" AND S.FirstAgentId IS NOT NULL AND ROUND((S.WaitingImrDuration / 1000),2)>0)
			+ SUM(Q.LABEL LIKE "%Abandon%" AND S.FirstAgentId IS NOT NULL AND ROUND((S.WaitingImrDuration / 1000),2)>0)
			+ SUM(Q.LABEL LIKE "%DISSUA%" AND S.FirstAgentId IS NOT NULL AND ROUND((S.WaitingImrDuration / 1000),2)>0)) AS "AVEC_ATTENTE",
									
			COALESCE(SEC_TO_TIME(SUM(S.CommunicationWithAgentsDuration/1000) / (SUM(Q.LABEL="Qualification automatique") + SUM(Q.LABEL LIKE "%Abandon%" AND S.FirstAgentId IS NOT NULL) + SUM(Q.LABEL LIKE "%DISSU%" AND S.FirstAgentId IS NOT NULL)))) AS "DMT",
			COALESCE(ROUND(((SUM(Q.LABEL="Qualification automatique") + SUM(Q.LABEL LIKE "%Abandon%" AND S.FirstAgentId IS NOT NULL) + SUM(Q.LABEL LIKE "%Dissua%" 
			AND S.FirstAgentId IS NOT NULL)) / (SUM(Q.Label NOT IN ("HORS PLAGE")) - SUM(Q.LABEL LIKE "%Dissua%" AND S.FirstAgentId IS NOT NULL)-SUM(Q.LABEL LIKE "%Aban%" AND S.FirstAgentId IS NOT NULL)))*100,2)) AS "QS"
			FROM '.$base.'.sessiondigest AS S
			INNER JOIN ireflet.campaign AS C ON C.Id = S.CampaignId
			INNER JOIN ireflet.qualification AS Q ON Q.Id = S.QualificationId
			WHERE C.Id = "'.$id.'" AND FROM_UNIXTIME(S.CreationDate/1000,"%Y-%m-%d")="'.$datetraite.'"';
		$exec_globale_query = mysql_query($globale_query);
		/*while ($data = mysql_fetch_array($exec_globale_query))
		{	
			return $data;
		}*/
		$data = mysql_fetch_array($exec_globale_query);
		return $data;
		//return $exec_globale_query;
	}

	public function get_stat_agent($base,$id,$dates)
	{
		$agent_query = 'SELECT
			CASE 
				WHEN A.Login="RAA" THEN "ENZO (ANDREAS)"
				WHEN A.Login="RNA" THEN "NATHIE (NATHIE)"
				WHEN A.Login="RAN" THEN "NANCY (NANCY)"
				WHEN A.Login="RJN" THEN "JENNY (JENNY)"
				WHEN A.Login="RSO" THEN "SOPHIE (SANTATRA)"
				WHEN A.Login="RAS" THEN "ANNA (ANNA)"
				WHEN A.Login="RIK" THEN "ERICA (ERICA)"
				WHEN A.Login="CHR" THEN "CHRISTIAN (CHRISTIAN)"
				WHEN A.Login="SEM" THEN "MARIE-CLAIRE (MARIE-CLAIRE)"
				WHEN A.Login="RIE" THEN "CATHIE (MENDRIKA)"
				WHEN A.Login="RIA" THEN "SONIA (HORTENSIA)"
				WHEN A.Login="RLI" THEN "LILI (LILIANAH)"
				WHEN A.Login="RAM" THEN "MAËLLE (MAËLLE)"
				WHEN A.Login="RAE" THEN "ERIC (ERIC)"
				WHEN A.Login="RSH" THEN "TINA(SHAKILA)"
			END AS "AGENT",
			COALESCE(SUM(Q.Label NOT IN ("HORS PLAGE"))) AS "EN_PLAGE",
			COALESCE(SUM(Q.LABEL="Qualification automatique")) AS "QUALIFIES",
			COALESCE(SUM(Q.LABEL LIKE "%Abandonn%" AND S.FirstAgentId IS NOT NULL)) AS "ABANDONNE_PARKING",
			COALESCE(SUM(Q.Label LIKE "%Dissuad%" AND S.FirstAgentId IS NOT NULL)) AS "TRANSFERE_PARKING",
			COALESCE(SUM(Q.LABEL="Qualification automatique") + SUM(Q.LABEL LIKE "%Abandon%" AND S.FirstAgentId IS NOT NULL) + SUM(Q.Label LIKE "%Dissua%" AND S.FirstAgentId IS NOT NULL)) AS "SERVIS",
			COALESCE(SUM(Q.LABEL = "Qualification automatique" AND S.FirstAgentId IS NOT NULL AND ROUND((S.WaitingImrDuration / 1000),2)=0)
			+ SUM(Q.LABEL LIKE "%Abandon%" AND S.FirstAgentId IS NOT NULL AND ROUND((S.WaitingImrDuration / 1000),2)=0)
			+ SUM(Q.LABEL LIKE "%DISSUA%" AND S.FirstAgentId IS NOT NULL AND ROUND((S.WaitingImrDuration / 1000),2)=0)) AS "SANS_ATTENTE",
			COALESCE(SUM(Q.LABEL = "Qualification automatique" AND S.FirstAgentId IS NOT NULL AND ROUND((S.WaitingImrDuration / 1000),2)>0)
			+ SUM(Q.LABEL LIKE "%Abandon%" AND S.FirstAgentId IS NOT NULL AND ROUND((S.WaitingImrDuration / 1000),2)>0)
			+ SUM(Q.LABEL LIKE "%DISSUA%" AND S.FirstAgentId IS NOT NULL AND ROUND((S.WaitingImrDuration / 1000),2)>0)) AS "AVEC_ATTENTE",
			COALESCE(SEC_TO_TIME(SUM(S.CommunicationWithAgentsDuration/1000) / (SUM(Q.LABEL="Qualification automatique") + SUM(Q.LABEL LIKE "%Abandon%" AND S.FirstAgentId IS NOT NULL) + SUM(Q.LABEL LIKE "%DISSU%" AND S.FirstAgentId IS NOT NULL)))) AS "DMT",
			COALESCE(ROUND(((SUM(Q.LABEL="Qualification automatique") + SUM(Q.LABEL LIKE "%Abandon%" AND S.FirstAgentId IS NOT NULL) + SUM(Q.LABEL LIKE "%Dissua%" AND S.FirstAgentId IS NOT NULL)) / SUM(Q.Label NOT IN ("HORS PLAGE")))*100,2)) AS "QS"
			FROM '.$base.'.sessiondigest AS S
			INNER JOIN ireflet.campaign AS C ON C.Id = S.CampaignId
			INNER JOIN ireflet.qualification AS Q ON Q.Id = S.QualificationId
			LEFT JOIN ireflet.agent AS A ON A.Id = S.FirstAgentId
			WHERE C.Id = "'.$id.'" AND FROM_UNIXTIME(S.CreationDate/1000,"%Y-%m-%d")="'.$dates.'"
			AND A.Login IS NOT NULL GROUP BY A.Login';

		$exec_agent_query = mysql_query($agent_query);
		return $exec_agent_query;
		
	}

	public function join()
	{
		/*$this->db->select('users.id, users.username, users_groups.group_id');
		$this->db->join('users_groups', 'users.id = users_groups.user_id');*/

	}

	public function getstatglobalbeetween($plage,$base,$id,$chainedeb,$chainefin)
	{
		$globale_query = 'SELECT
			CONCAT("'.$plage.'") AS "Date",
			COUNT(S.CallerAddress) AS "TOUT",
			COALESCE(SUM(Q.Label NOT IN ("HORS PLAGE"))) AS "EN_PLAGE",
			COALESCE(SUM(Q.LABEL LIKE "%ABAN%" AND ROUND((S.WaitingImrDuration / 1000),2)=0) - SUM(Q.LABEL LIKE "%aband%" AND S.FirstAgentId IS NOT NULL AND ROUND((S.WaitingImrDuration / 1000),2)=0)) AS "ABANDONNE_PERDU -15",
			COALESCE(SUM(Q.LABEL LIKE "%ABAN%" AND ROUND((S.WaitingImrDuration / 1000),2)>0) - SUM(Q.LABEL LIKE "%aband%" AND S.FirstAgentId IS NOT NULL AND ROUND((S.WaitingImrDuration / 1000),2)>0)) AS "ABANDONNE_PERDU +15",
			COALESCE(SUM(Q.LABEL LIKE "%DISSUADE%") - SUM(Q.LABEL LIKE "%Dissua%" AND S.FirstAgentId IS NOT NULL))+COALESCE(SUM(Q.LABEL IN ("HORS PLAGE"))) AS "DISSUADE_PERDU",
			COALESCE((SUM(Q.LABEL LIKE "%ABAN%") - SUM(Q.LABEL LIKE "%abandonn%"
 			AND S.FirstAgentId IS NOT NULL)) + COALESCE(SUM(Q.LABEL LIKE "%DISSUADE%") - SUM(Q.LABEL LIKE "%Dissua%" AND S.FirstAgentId IS NOT NULL)) + (SUM(Q.LABEL IN ("HORS PLAGE")))) AS "PERDUS",
			COALESCE(SUM(Q.LABEL="Qualification automatique")) AS "QUALIFIES",
			COALESCE(SUM(Q.LABEL LIKE "%Aband%" AND S.FirstAgentId IS NOT NULL)) AS "ABANDONNE_PARKING",
			COALESCE(SUM(Q.Label LIKE "%Dissua%" AND S.FirstAgentId IS NOT NULL)) AS "TRANSFERE_PARKING",
			COALESCE(SUM(Q.LABEL="Qualification automatique") + SUM(Q.LABEL LIKE "%Aband%" AND S.FirstAgentId IS NOT NULL) + SUM(Q.Label LIKE "%Dissua%" AND S.FirstAgentId IS NOT NULL)) AS "SERVIS",
									
			COALESCE(SUM(Q.LABEL = "Qualification automatique" AND S.FirstAgentId IS NOT NULL AND ROUND((S.WaitingImrDuration / 1000),2)=0)
			+ SUM(Q.LABEL LIKE "%Abandon%" AND S.FirstAgentId IS NOT NULL AND ROUND((S.WaitingImrDuration / 1000),2)=0)
			+ SUM(Q.LABEL LIKE "%DISSUA%" AND S.FirstAgentId IS NOT NULL AND ROUND((S.WaitingImrDuration / 1000),2)=0)) AS "SANS_ATTENTE",
							
			COALESCE(SUM(Q.LABEL = "Qualification automatique" AND S.FirstAgentId IS NOT NULL AND ROUND((S.WaitingImrDuration / 1000),2)>0)
			+ SUM(Q.LABEL LIKE "%Abandon%" AND S.FirstAgentId IS NOT NULL AND ROUND((S.WaitingImrDuration / 1000),2)>0)
			+ SUM(Q.LABEL LIKE "%DISSUA%" AND S.FirstAgentId IS NOT NULL AND ROUND((S.WaitingImrDuration / 1000),2)>0)) AS "AVEC_ATTENTE",
									
			COALESCE(SEC_TO_TIME(SUM(S.CommunicationWithAgentsDuration/1000) / (SUM(Q.LABEL="Qualification automatique") + SUM(Q.LABEL LIKE "%Abandon%" AND S.FirstAgentId IS NOT NULL) + SUM(Q.LABEL LIKE "%DISSU%" AND S.FirstAgentId IS NOT NULL)))) AS "DMT",
			COALESCE(ROUND((SUM(Q.LABEL="Qualification automatique")/COUNT(S.CallerAddress))*100,2)) AS "QS"
			FROM '.$base.'.sessiondigest AS S
			INNER JOIN ireflet.campaign AS C ON C.Id = S.CampaignId
			INNER JOIN ireflet.qualification AS Q ON Q.Id = S.QualificationId
			WHERE C.Id = "'.$id.'" AND FROM_UNIXTIME(S.CreationDate/1000) BETWEEN "'.$chainedeb.'" AND "'.$chainefin.'"';
		$exec_globale_query = mysql_query($globale_query);
		$data = mysql_fetch_array($exec_globale_query);
		return $data;


	}	

	public function getstatagentbeetween($plage,$base,$id,$chainedeb,$chainefin)
	{
		$agent_query = 'SELECT
			CONCAT("'.$plage.'") AS "Date",
			CASE 
				WHEN A.Login="RAA" THEN "ENZO (ANDREAS)"
				WHEN A.Login="RNA" THEN "NATHIE (NATHIE)"
				WHEN A.Login="RAN" THEN "NANCY (NANCY)"
				WHEN A.Login="RJN" THEN "JENNY (JENNY)"
				WHEN A.Login="RSO" THEN "SOPHIE (SANTATRA)"
				WHEN A.Login="RAS" THEN "ANNA (ANNA)"
				WHEN A.Login="RIK" THEN "ERICA (ERICA)"
				WHEN A.Login="CHR" THEN "CHRISTIAN (CHRISTIAN)"
				WHEN A.Login="SEM" THEN "MARIE-CLAIRE (MARIE-CLAIRE)"
				WHEN A.Login="RIE" THEN "CATHIE (MENDRIKA)"
				WHEN A.Login="RIA" THEN "SONIA (HORTENSIA)"
				WHEN A.Login="RLI" THEN "LILI (LILIANAH)"
				WHEN A.Login="RAM" THEN "MAËLLE (MAËLLE)"
				WHEN A.Login="RAE" THEN "ERIC (ERIC)"
				WHEN A.Login="RSH" THEN "TINA(SHAKILA)"
			END AS "AGENT",
			COALESCE(SUM(Q.Label NOT IN ("HORS PLAGE"))) AS "EN_PLAGE",
			COALESCE(SUM(Q.LABEL="Qualification automatique")) AS "QUALIFIES",
			COALESCE(SUM(Q.LABEL LIKE "%Abandonn%" AND S.FirstAgentId IS NOT NULL)) AS "ABANDONNE_PARKING",
			COALESCE(SUM(Q.Label LIKE "%Dissuad%" AND S.FirstAgentId IS NOT NULL)) AS "TRANSFERE_PARKING",
			COALESCE(SUM(Q.LABEL="Qualification automatique") + SUM(Q.LABEL LIKE "%Abandon%" AND S.FirstAgentId IS NOT NULL) + SUM(Q.Label LIKE "%Dissua%" AND S.FirstAgentId IS NOT NULL)) AS "SERVIS",
			COALESCE(SUM(Q.LABEL = "Qualification automatique" AND S.FirstAgentId IS NOT NULL AND ROUND((S.WaitingImrDuration / 1000),2)=0)
			+ SUM(Q.LABEL LIKE "%Abandon%" AND S.FirstAgentId IS NOT NULL AND ROUND((S.WaitingImrDuration / 1000),2)=0)
			+ SUM(Q.LABEL LIKE "%DISSUA%" AND S.FirstAgentId IS NOT NULL AND ROUND((S.WaitingImrDuration / 1000),2)=0)) AS "SANS_ATTENTE",
			COALESCE(SUM(Q.LABEL = "Qualification automatique" AND S.FirstAgentId IS NOT NULL AND ROUND((S.WaitingImrDuration / 1000),2)>0)
			+ SUM(Q.LABEL LIKE "%Abandon%" AND S.FirstAgentId IS NOT NULL AND ROUND((S.WaitingImrDuration / 1000),2)>0)
			+ SUM(Q.LABEL LIKE "%DISSUA%" AND S.FirstAgentId IS NOT NULL AND ROUND((S.WaitingImrDuration / 1000),2)>0)) AS "AVEC_ATTENTE",
			COALESCE(SEC_TO_TIME(SUM(S.CommunicationWithAgentsDuration/1000) / (SUM(Q.LABEL="Qualification automatique") + SUM(Q.LABEL LIKE "%Abandon%" AND S.FirstAgentId IS NOT NULL) + SUM(Q.LABEL LIKE "%DISSU%" AND S.FirstAgentId IS NOT NULL)))) AS "DMT",
			COALESCE(ROUND(((SUM(Q.LABEL="Qualification automatique")) / SUM(Q.Label NOT IN ("HORS PLAGE")))*100,2)) AS "QS"
			FROM '.$base.'.sessiondigest AS S
			INNER JOIN ireflet.campaign AS C ON C.Id = S.CampaignId
			INNER JOIN ireflet.qualification AS Q ON Q.Id = S.QualificationId
			LEFT JOIN ireflet.agent AS A ON A.Id = S.FirstAgentId
			WHERE C.Id = "'.$id.'" AND FROM_UNIXTIME(S.CreationDate/1000) BETWEEN "'.$chainedeb.'" AND "'.$chainefin.'"
			AND A.Login IS NOT NULL GROUP BY A.Login';
		$exec_agent_query = mysql_query($agent_query);
		return $exec_agent_query;
	}

} 