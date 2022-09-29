<?php
class Statistiques extends CI_Controller
{
	public function __construct()
	{
		// Obligatoire
		parent::__construct();
		// Maintenant, ce code sera exécuté chaque fois que ce contrôleur sera appelé.
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->database();
		$this->load->model('statistique_model');
		$data = array();
			
		//var globales utiles
	}

	//fonctions utiles
	private function get_year_du_mois_prec($m)
	{
		//$m=date('n');
		//$mois est le num de mois
		$y = date('Y');
		if ($m==1) {
			return $y-1;
		} else { 
			return $y;
		}
	}

	private function get_mois_prec($m)
	{
		if ($m==1) {
			return 12;
		} else {
			return $m-1;
		}
	}
	/*fin fonctions utiles*/

	public function index()
	{
		$data['titre']='Statistiques';
		$data['fenetre']='stat';
		if ($this->session->userdata('user_login'))
		{
			$this->load->view('include/menu',$data);
			$this->load->view('statistique/bornage',$data);
			$this->load->view('statistique/footer');	
		}
		else
		{	
			redirect('users/index');	
		}

	}

	public function today()
	{
		//NB : la base utilisée est tjrs statistique pour today
		if ($this->session->userdata('user_login'))
		{
			//traitement pour aujourd'hui
			$date_j = date('d-m-Y');
			$jours = array('','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche');
			$mois = array('','Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre');
			
			/*datas*/
			$data['campagne']=$this->input->get('c');
			$data['titre']='Statistique du jour';
			$data['libelle'] = $jours[Date('N',strtotime($date_j))].' '.date('d',strtotime($date_j)).' '.$mois[date('n',strtotime($date_j))].' '.date('Y',strtotime($date_j));
			$data['fenetre']='stat';
			$date_j = date('d-m-Y');
			/*base de données*/
			$id=$this->statistique_model->get_campagneID($data['campagne']);
			/*fin bdd*/
			if ($id!='')//soyons sûr que id campagne existe tjrs
			{
				//initialisation des variables
				$data['tout_global'] = 0;
				$data['total_traites'] = 0;						
				$data['total_abandon_parking'] = 0;
				$data['total_transferes'] = 0;
				$data['total_servis'] = 0;
				$data['total_s_attente'] = 0;
				$data['total_a_attente'] = 0;
				$data['total_abandonnes1'] = 0;
				$data['total_abandonnes2'] = 0;
				$data['total_trans_auto'] = 0;
				$data['total_perdu'] = 0;

				$data['total_traites_agt'] = 0;
				$data['total_abandon_parking_agt'] = 0;
				$data['total_transferes_agt'] = 0;
				$data['total_servis_agt'] = 0;
				$data['total_s_attente_agt'] = 0;
				$data['total_a_attente_agt'] = 0;

				$year = date("Y");
				$month = date("m");
				
				/*traitement base de données init des 2 params utiles*/
				$base='statistic';
				$datetraite = date('Y-m-d',time());
				$data['rowglobale']=$this->statistique_model->get_stat_jour($base,$id,$datetraite);

				$this->load->view('include/menu',$data);
				$this->load->view('include/tabletoexeljs');
				$this->load->view('statistique/today',$data);
				
				$exec_agent_query=$this->statistique_model->get_stat_agent($base,$id,$datetraite);
				while($result = mysql_fetch_array($exec_agent_query))
				{
					$data['total_traites_agt'] = $data['total_traites_agt'] + $result['QUALIFIES'];
					$data['total_abandon_parking_agt'] = $data['total_abandon_parking_agt'] + $result['ABANDONNE_PARKING'];
					$data['total_transferes_agt'] = $data['total_transferes_agt'] + $result['TRANSFERE_PARKING'];
					$data['total_servis_agt'] = $data['total_servis_agt'] + $result['SERVIS'];
					$data['total_s_attente_agt'] = $data['total_s_attente_agt'] + $result['SANS_ATTENTE'];
					$data['total_a_attente_agt'] = $data['total_a_attente_agt'] + $result['AVEC_ATTENTE'];
					$this->load->view('statistique/today_agent',$result);
				}
				//$data['rowagent']=$this->statistique_model-> get_stat_agent($base,$id,$datetraite);
				$this->load->view('statistique/total_agent',$data);
				$this->load->view('statistique/footer_tableau');	
			}	
		}
		else
		{	
			redirect('users/index');	
		}

	}

	public function yesterday()
	{
		//NB : la base utilisée est tjrs statistique pour today
		if ($this->session->userdata('user_login'))
		{
			//traitement pour aujourd'hui
			$jours = array('','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche');
			$mois = array('','Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre');
			/*datas*/
			$data['campagne']=$this->input->get('c');
			$data['titre']='Statistique du jour';
			$data['fenetre']='stat';
			$date_j = date('d-m-Y');
			/*base de données*/
			$data['id']=$this->statistique_model->get_campagneID($data['campagne']);
			/*fin bdd*/
			if ($data['id']!='')//soyons sûr que id campagne existe tjrs
			{
				//initialisation des variables
				$tout_global = 0;
				$total_traites = 0;						
				$total_abandon_parking = 0;
				$total_transferes = 0;
				$total_servis = 0;
				$total_s_attente = 0;
				$total_a_attente = 0;
				$total_abandonnes1 = 0;
				$total_abandonnes2 = 0;
				$total_trans_auto = 0;
				$total_perdu = 0;

				$total_traites_agt = 0;
				$total_abandon_parking_agt = 0;
				$total_transferes_agt = 0;
				$total_servis_agt = 0;
				$total_s_attente_agt = 0;
				$total_a_attente_agt = 0;

				$year = date("Y");
				$month = date("m");
				//
				$datedujour=mktime(0,0,0,date('n',time()),date('j',time()),date('Y',time()));
				$time1 = mktime(0, 0, 0, date('n',time()), 1, date('Y',time()));//pr 1er du mois
				$str_firstmonday = strtotime('monday', $time1);

				//test si on n'est pas encore passé au 1er lundi du mois alors l'archivage considéré est celle du 1er lundi mois précedent
				if ($str_firstmonday>$datedujour)
				{
					$premierdumoisprec  = mktime(0, 0, 0, $this->get_mois_prec($month), 1, $this->get_year_du_mois_prec($month));
					$prevfirstmonday = strtotime('monday', $premierdumoisprec);
					$str_firstmonday=$prevfirstmonday;
					//on met strfirstmonday du mois précédent, si l'archivage n'a pas encore eu lieu
				}

				/* débogage */
				//echo '1er lundi'.date('d-m-Y',$str_firstmonday).' et ddj :'.date('d-m-Y',$datedujour);
				/* fin débogage */

				//anticiper l'archivage de la base de données 
				/*if ($str_firstmonday <= $datedujour)
				{
					$base='statistic';
				}else
				{
					$base='statistichisto';
				}*/


			}
			//variables
			$data['libelle'] = $jours[Date('N',strtotime($date_j))].' '.date('d',strtotime($date_j)).' '.$mois[date('n',strtotime($date_j))].' '.date('Y',strtotime($date_j));
			//view
			$this->load->view('include/menu',$data);
			$this->load->view('include/tabletoexeljs');
			$this->load->view('statistique/today',$data);
			$this->load->view('include/footer');	
		}
		else
		{	
			redirect('users/index');	
		}

	}
	
	public function statperso()
	{
		//test si pas de session
		if ($this->session->userdata('user_login'))
		{

			$data['campagne']=$_POST['campagne'];
			$data['ddb']=$_POST['datedbt'];
			$data['fin']=$_POST['datefin'];
			$data['hdb']= (isset($_POST['heuredbt']) && $_POST['heuredbt']!='') ? htmlspecialchars($_POST['heuredbt']) : '00:00';
			$data['hfin']= (isset($_POST['heurefin']) && $_POST['heurefin']!='') ? htmlspecialchars($_POST['heurefin']) : '23:59';

			/* dbt chaine pr la requête */
			$chaine_debut=$data['ddb'].' '.$data['hdb'].':00';
			$chaine_fin=$data['fin'].' '.$data['hfin'].':00';
			/* chaine pr la requête */

			if (strtotime($chaine_fin) < strtotime($chaine_debut)) 
			{
				echo "<script>alert(\"La date de fin ne peut pas être inférieure à la date de début\"); 
				document.location.href = '".site_url('statistiques/index')."';
				</script>";
			}
		 	else 
			{
				//echo $chaine_fin.'et debut'.$chaine_debut;
			}

			$data['fenetre']='stat';
			/*a mettre pr le menu*/

			//init
			$date_debut=strtotime($data['ddb']); 
			$date_jour=time();
			$jours = array('','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche');
			$mois = array('','Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre');
			$mois_du_debut=date('n',strtotime($data['ddb']));
			$year_du_debut=date('Y',strtotime($data['ddb']));
			$mois_de_fin=date('n',strtotime($data['fin']));
			$year_de_fin=date('Y',strtotime($data['fin']));
			$mois_en_cours=date('n');
			$year_en_cours=date('Y'); 
			$mois_prec_debut=$this->get_mois_prec($mois_du_debut);
			$year_mois_prec_debut=$this->get_year_du_mois_prec($mois_du_debut);
			$mois_prec=$this->get_mois_prec($mois_en_cours);
			$year_mois_prec=$this->get_year_du_mois_prec($mois_en_cours);
			
			$time = mktime(0, 0, 0, $mois_du_debut, 1, $year_du_debut);//1er du mois du début
			$time_mois_prec= mktime(0, 0, 0, $mois_prec_debut, 1, $year_mois_prec);//1er du mois prec du début
			$str_firstmonday = strtotime('monday', $time);//moisdudebut
			$str_firstmonday_mois_prec= strtotime('monday', $time_mois_prec);//1er lundi du mois prec

			//echo date('Y-m-d',$time);

			/*on détecte les dates d'archivages par rapport à la date du jour*/
			/*si nous n'avons pas encore passé le 1er lundi or qu'on est dans le mois encours*/
			$premier_mois_encours=mktime(0, 0, 0, $mois_en_cours, 1, $year_en_cours);
			$str_firstmonday_mois=strtotime('monday', $premier_mois_encours);
			if(time()<$str_firstmonday_mois)
			{
				$archivage1=strtotime('monday', $premier_mois_prec);//archivage du mis dernier
				$mois2=$this->get_mois_prec($mois_prec);
				$year2=$this->get_year_du_mois_prec($mois_prec);		
				$premier_mois_prec=mktime(0, 0, 0, $mois2, 1, $year2); 
				$archivage2=strtotime('monday', $premier_mois_prec);
			}
			else
			{
				$archivage1=strtotime('monday', $premier_mois_encours);//archivage le plus récent
				$premier_mois_prec=mktime(0, 0, 0, $mois_prec, 1, $year_mois_prec); 
				$archivage2=strtotime('monday', $premier_mois_prec);//archivage du mis dernier	
			}
			/**/

			/* libelle tableau */
			if ($data['ddb']==$data['fin'])
			{
				if($data['hdb']=='00:00')
				{
					$data['libelle']=$jours[Date('N',strtotime($data['ddb']))].' '.date('d',strtotime($data['ddb'])).' '.$mois[date('n',strtotime($data['ddb']))].' '.date('Y',strtotime($data['ddb']));		
				}
				else { 
					$data['libelle']=$jours[Date('N',strtotime($data['ddb']))].' '.date('d',strtotime($data['ddb'])).' '.$mois[date('n',strtotime($data['ddb']))].' '.date('Y',strtotime($data['ddb'])).' de '.$data['hdb'].' &agrave '.$data['hfin']; 
					$plage=$data['ddb'].' de '.$data['hdb'].' à '.$data['hfin'];
				}	
			}
			else {
				if($data['hdb']=='00:00')
				{
					$data['libelle']=' '.$jours[Date('N',strtotime($data['ddb']))].' '.date('d',strtotime($data['ddb'])).' '.$mois[date('n',strtotime($data['ddb']))].' '.date('Y',strtotime($data['ddb'])).' au '.$jours[Date('N',strtotime($data['fin']))].' '.date('d',strtotime($data['fin'])).' '.$mois[date('n',strtotime($data['fin']))].' '.date('Y',strtotime($data['fin']));
				}
				else{
					$plage=$chaine_debut.' jusqu\'au '.$chaine_fin;
					$plage_lib=$data['hdb'].' et '.$data['hfin'];
					$data['libelle']=' '.$jours[Date('N',strtotime($data['ddb']))].' '.date('d',strtotime($data['ddb'])).' '.$mois[date('n',strtotime($data['ddb']))].' '.date('Y',strtotime($data['ddb'])).' au '.$jours[Date('N',strtotime($data['fin']))].' '.date('d',strtotime($data['fin'])).' '.$mois[date('n',strtotime($data['fin']))].' '.date('Y',strtotime($data['fin'])).' entre '.$plage_lib;
				}	
			}
			/* fin libelle tableau */

			/*base de données*/
			$id=$this->statistique_model->get_campagneID($data['campagne']);
			/*fin bdd*/
			if ($id!='')//soyons sûr qu'une campagne est bien selectionnée
			{
				//initialisation des variables
				$data['tout_global'] = 0;
				$data['total_traites'] = 0;						
				$data['total_abandon_parking'] = 0;
				$data['total_transferes'] = 0;
				$data['total_servis'] = 0;
				$data['total_s_attente'] = 0;
				$data['total_a_attente'] = 0;
				$data['total_abandonnes1'] = 0;
				$data['total_abandonnes2'] = 0;
				$data['total_trans_auto'] = 0;
				$data['total_perdu'] = 0;

				$data['total_traites_agt'] = 0;
				$data['total_abandon_parking_agt'] = 0;
				$data['total_transferes_agt'] = 0;
				$data['total_servis_agt'] = 0;
				$data['total_s_attente_agt'] = 0;
				$data['total_a_attente_agt'] = 0;


				/*affiche entete*/
				$this->load->view('include/menu',$data);
				$this->load->view('include/tabletoexeljs');
				//$this->load->view('statistique/statperso',$data);

				/*choix base par rapport à la date dbt*/
				if (strtotime($data['ddb']) >= $archivage1)
				{
					$base='statistic';
				}else if (strtotime($data['ddb']) >= $archivage2){
					$base='statistichisto';
				}else{
					$base='statistic'.date('Y',strtotime($data['ddb']));
				}
				/*fin choix base*/

				/*tests date*/
				if ($data['ddb']==$data['fin'])
				{
					$datetraite=date('Y-m-d',strtotime($data['ddb']));
					if($data['hdb']=='00:00' && $data['hfin']=='23:59')
					{
						$data['rowglobale']=$this->statistique_model->get_stat_jour($base,$id,$datetraite);
						$this->load->view('statistique/today',$data);
						$data['rowagent']=$this->statistique_model->get_stat_agent($base,$id,$datetraite);
						$exec_agent_query=$this->statistique_model->get_stat_agent($base,$id,$datetraite);
						while($result = mysql_fetch_array($exec_agent_query))
						{
							$data['total_traites_agt'] = $data['total_traites_agt'] + $result['QUALIFIES'];
							$data['total_abandon_parking_agt'] = $data['total_abandon_parking_agt'] + $result['ABANDONNE_PARKING'];
							$data['total_transferes_agt'] = $data['total_transferes_agt'] + $result['TRANSFERE_PARKING'];
							$data['total_servis_agt'] = $data['total_servis_agt'] + $result['SERVIS'];
							$data['total_s_attente_agt'] = $data['total_s_attente_agt'] + $result['SANS_ATTENTE'];
							$data['total_a_attente_agt'] = $data['total_a_attente_agt'] + $result['AVEC_ATTENTE'];
							$this->load->view('statistique/today_agent',$result);
						}
						//$data['rowagent']=$this->statistique_model-> get_stat_agent($base,$id,$datetraite);
						$this->load->view('statistique/total_agent',$data);
						$this->load->view('statistique/footer_tableau');
					}
					else //heure pris en compte
					{
						/*preparer les chaines*/
						$chainedeb=date('Y-m-d',strtotime($data['ddb'])).' '.$data['hdb'].':00';
						$chainefin=date('Y-m-d',strtotime($data['fin'])).' '.$data['hfin'].':00';
						/*prepare chaine*/

						$this->load->view('statistique/statperso',$data);
						$data['rowglobale']=$this->statistique_model->getstatglobalbeetween($plage,$base,$id,$chainedeb,$chainefin);
						/*libelle date*/
						$data['Date']=$jours[Date('N',strtotime($data['ddb']))].' '.date('d',strtotime($data['ddb'])).' '.$mois[date('n',strtotime($data['ddb']))].' '.date('Y',strtotime($data['ddb']));
      					$data['Date'].=' de '.$data['hdb'].' à '.$data['hfin']; //lib + heure
      					/**/
						$this->load->view('statistique/contentglobal',$data);
	                    /*total global*/
	                    $data['tout_global'] = $data['tout_global'] + $data['rowglobale']['TOUT'];
	                    $data['total_traites'] = $data['total_traites'] + $data['rowglobale']['QUALIFIES'];
	                    $data['total_abandon_parking'] = $data['total_abandon_parking'] + $data['rowglobale']['ABANDONNE_PARKING'];
	                    $data['total_transferes'] =  $data['total_transferes'] + $data['rowglobale']['TRANSFERE_PARKING'];
	                    $data['total_servis'] = $data['total_servis'] + $data['rowglobale']['SERVIS'];
	                    $data['total_s_attente'] =  $data['total_s_attente'] + $data['rowglobale']['SANS_ATTENTE'];
	                    $data['total_a_attente'] = $data['total_a_attente'] + $data['rowglobale']['AVEC_ATTENTE'];
	                    $data['total_abandonnes1'] =$data['total_abandonnes1'] + $data['rowglobale']['ABANDONNE_PERDU -15'];
	                    $data['total_abandonnes2'] = $data['total_abandonnes2'] + $data['rowglobale']['ABANDONNE_PERDU +15'];
	                    $data['total_trans_auto'] = $data['total_trans_auto'] + $data['rowglobale']['DISSUADE_PERDU'];
	                    $data['total_perdu'] = $data['total_perdu'] + $data['rowglobale']['PERDUS'];
	                    $this->load->view('statistique/totalglobal',$data);
	                    /*agent*/
                        $exec_agent_query=$this->statistique_model->getstatagentbeetween($plage,$base,$id,$chainedeb,$chainefin);
                        while($result = mysql_fetch_array($exec_agent_query))
						{
							$data['total_traites_agt'] = $data['total_traites_agt'] + $result['QUALIFIES'];
							$data['total_abandon_parking_agt'] = $data['total_abandon_parking_agt'] + $result['ABANDONNE_PARKING'];
							$data['total_transferes_agt'] = $data['total_transferes_agt'] + $result['TRANSFERE_PARKING'];
							$data['total_servis_agt'] = $data['total_servis_agt'] + $result['SERVIS'];
							$data['total_s_attente_agt'] = $data['total_s_attente_agt'] + $result['SANS_ATTENTE'];
							$data['total_a_attente_agt'] = $data['total_a_attente_agt'] + $result['AVEC_ATTENTE'];
							$this->load->view('statistique/today_agent',$result);
						}
						$this->load->view('statistique/total_agent',$data);
						$this->load->view('statistique/footer_tableau');	
                        /*fin agent*/               
					}
				}
				else//debut!=fin
				{
					$diff= strtotime($data['ddb']) - strtotime($data['fin']);
					$diff= $diff/86400;//nb de jours 

					$basepardf=$base;//manip base quand change date
					$ancienbase='';
					
					if(isset($_POST['contigu']) && $_POST['contigu']==1)//stat contigu
					{
						$chainedeb=date('Y-m-d',strtotime($data['ddb'])).' '.$data['hdb'].':00';
						$chainefin=date('Y-m-d',strtotime($data['fin'])).' '.$data['hfin'].':00';
						$this->load->view('statistique/statperso',$data);
						$data['rowglobale']=$this->statistique_model->getstatglobalbeetween($plage,$base,$id,$chainedeb,$chainefin);
						$data['Date']=$jours[Date('N',strtotime($data['ddb']))].' '.date('d',strtotime($data['ddb'])).' '.$mois[date('n',strtotime($data['ddb']))].' '.date('Y',strtotime($data['ddb']));
      					$data['Date'].=' de '.$data['hdb'].' à '.$data['hfin']; //lib + heure
      					/**/
						$this->load->view('statistique/contentglobal',$data);
	                    /*total global*/
	                    $data['tout_global'] = $data['tout_global'] + $data['rowglobale']['TOUT'];
	                    $data['total_traites'] = $data['total_traites'] + $data['rowglobale']['QUALIFIES'];
	                    $data['total_abandon_parking'] = $data['total_abandon_parking'] + $data['rowglobale']['ABANDONNE_PARKING'];
	                    $data['total_transferes'] =  $data['total_transferes'] + $data['rowglobale']['TRANSFERE_PARKING'];
	                    $data['total_servis'] = $data['total_servis'] + $data['rowglobale']['SERVIS'];
	                    $data['total_s_attente'] =  $data['total_s_attente'] + $data['rowglobale']['SANS_ATTENTE'];
	                    $data['total_a_attente'] = $data['total_a_attente'] + $data['rowglobale']['AVEC_ATTENTE'];
	                    $data['total_abandonnes1'] =$data['total_abandonnes1'] + $data['rowglobale']['ABANDONNE_PERDU -15'];
	                    $data['total_abandonnes2'] = $data['total_abandonnes2'] + $data['rowglobale']['ABANDONNE_PERDU +15'];
	                    $data['total_trans_auto'] = $data['total_trans_auto'] + $data['rowglobale']['DISSUADE_PERDU'];
	                    $data['total_perdu'] = $data['total_perdu'] + $data['rowglobale']['PERDUS'];
	                    $this->load->view('statistique/totalglobal',$data);
	                    /*agent*/
                        $exec_agent_query=$this->statistique_model->getstatagentbeetween($plage,$base,$id,$chainedeb,$chainefin);
                        while($result = mysql_fetch_array($exec_agent_query))
						{
							$data['total_traites_agt'] = $data['total_traites_agt'] + $result['QUALIFIES'];
							$data['total_abandon_parking_agt'] = $data['total_abandon_parking_agt'] + $result['ABANDONNE_PARKING'];
							$data['total_transferes_agt'] = $data['total_transferes_agt'] + $result['TRANSFERE_PARKING'];
							$data['total_servis_agt'] = $data['total_servis_agt'] + $result['SERVIS'];
							$data['total_s_attente_agt'] = $data['total_s_attente_agt'] + $result['SANS_ATTENTE'];
							$data['total_a_attente_agt'] = $data['total_a_attente_agt'] + $result['AVEC_ATTENTE'];
							$this->load->view('statistique/today_agent',$result);
						}
						$this->load->view('statistique/total_agent',$data);
						$this->load->view('statistique/footer_tableau');	
                        /*fin agent*/  

					}
					else//stat non contigu
					{

					}	

				}
				/**/
				
			}	

			/*fin traitement*/
		}
		else
		{
			redirect('users/index');
		}	
	}

}	