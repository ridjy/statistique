<?php
class Enregistrements extends CI_Controller
{
	public function __construct()
	{
		// Obligatoire
		parent::__construct();
		// Maintenant, ce code sera exécuté chaque fois que ce contrôleur sera appelé.
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->database();
		$this->load->model('enregistrement_model');
		$data = array();
		//pour email
	}
	public function index()
	{
		$data['e']=$this->input->get('e');
		$data['titre']='Enregistrements';
		$data['fenetre']='enr';
		if ($this->session->userdata('user_login'))
		{
			$this->load->view('include/menu',$data);
			$this->load->view('enregistrement/bornage',$data);
			$this->load->view('enregistrement/footer_enr');	
		}
		else
		{	
			redirect('users/index');	
		}
	}


	private function AppendLine($fichier, $chemin, $nom_fichier, $date, $heure, $campagne, $agent, $qualif)
	{
		$line_name=explode('_',$nom_fichier);
		$fdate=date("d/m/Y",filemtime($fichier));
		$fduree1 = str_replace('(','',$line_name[5]);
		$fduree2 = str_replace(')','',$fduree1);
		
		$data['date']=$fdate;
		$data['heure']=$heure;
		$data['agent']=$agent;
		$data['tel']=$line_name[2];
		$data['duree']=$fduree2;

		$data['fichier']=$fichier;
		$data['chemin']=$chemin;
		$data['nom_fichier']=$nom_fichier;
		
		
		$data['campagne']=$campagne;
		
		$data['qualif']=$qualif;
		$this->load->view('enregistrement/content_tableau',$data);
	} 

	public function traitement()
	{ 

		$data['titre']='Enregistrements';
		$data['fenetre']='enr';
		if ($this->session->userdata('user_login'))
		{
			// define variables and set to empty values
			$DateErr = $HeureErr = "";
			$recherche_date_debut = $recherche_date_fin = $recherche_heure_debut = $recherche_heure_fin = "";
			$debug = 0;

			//traitement des var envoyés post
			$chaine_tel = $this->input->post('recherche_tel');
			$chaine_date_debut = str_replace("-", "", Date('Y-m-d',strtotime($this->input->post('recherche_date_debut'))));
			$chaine_date_fin = str_replace("-", "", Date('Y-m-d',strtotime($this->input->post('recherche_date_fin'))));
			$chaine_heure_debut =  str_replace(":", "", ($this->input->post('recherche_heure_debut')));
			$chaine_heure_fin =  str_replace(":", "", ($this->input->post('recherche_heure_fin')));
			$chaine_campagne = $this->input->post('recherche_campagne');

			//test si les données sont cohérents
			if ($chaine_date_fin < $chaine_date_debut) 
			{
				$e='La date de début ne doit pas être inférieur à la date de fin';
				redirect("enregistrements/index?e=$e");
			}
			else if ($chaine_heure_fin < $chaine_heure_debut) 
			{
				$e='L\'heure de début ne doit pas être inférieur à l\'heure de fin';
				redirect("enregistrements/index?e=$e");
			} 
			else 
			{ 
				$dir_source = ('/usr/local/ireflet/shared/records');
				$dir_iterator = new RecursiveDirectoryIterator($dir_source);
				$iterator = new RecursiveIteratorIterator($dir_iterator);
				
				$count=0; 
				$tableau_resultats=array();

				//boucle dans le dossier
				foreach ($iterator as $file) 
				{
					//déclaration des variables et parsing
					$dir_date=$dir_iterator;
					$dir_file=$file;
					$dir_part=substr($dir_file, strlen($dir_source)+1);
					
					$string_exploded = explode('/',$dir_part);

					$dir_date = $string_exploded[0];
					$dir_campagne = $string_exploded[1];
					$dir_agent = $string_exploded[2];
					$file_name = $string_exploded[3];
					$dir_heure=str_replace("_",":",substr($file_name, 24, strpos($file_name, "_")-3));
					$dir_heure2=str_replace("_","",substr($file_name, 24, strpos($file_name, "_")-3));
					$dir_tel=substr($file_name, 13, strpos($file_name, "_")+2);
					$full_dir_path = $dir_source."/".$dir_date."/".$dir_campagne."/".$dir_agent;
					$full_file_name = $dir_source."/".$dir_date."/".$dir_campagne."/".$dir_agent."/".$file_name;
					$dir_url = "/Temp/".$file_name;
							
					$Result=0;
					
					if ($debug == 1)
					{
						echo "Repertoire :".$full_file_name."<br>";
						echo "Fichier :".$file_name."<br>";
						echo "Datedebut :".$chaine_date_debut." (".$dir_date.").<br>";
						echo "Datefin :".$chaine_date_fin." (".$dir_date.")<br>";
						echo "Heuredebut :".$chaine_heure_debut." (".$dir_heure2.")<br>";
						echo "Heurefin :".$chaine_heure_fin." (".$dir_heure2.")<br>";
						echo "Campagne :".$chaine_campagne." (".$dir_campagne.")<br>";
						//echo "Qualification :".$chaine_qualification." (".$dir_qualif.")<br>";
						echo "Agent :".$chaine_agent." (".$dir_agent.")<br>";
						echo "Telephone :".$chaine_tel." (".$dir_tel.")<br>";
					}
					
					//verification du critère date
					if ($chaine_date_debut <= $dir_date && $chaine_date_fin >= $dir_date)
					{
						$Result=1;
						if ($debug==1) {echo " date correcte ";}
					} else if ($debug==1) {echo " date incorrecte ";}
					
					
					//vérification du critère heure
					if ($Result==1)
					{				
						if ($chaine_heure_debut > $dir_heure2 || $chaine_heure_fin < $dir_heure2)
						{
							$Result=0;
							if ($debug==1) {echo " heure incorrecte ";}
						} else if ($debug==1) {echo " heure correcte ";
						}
					}
					
					//vérification du critère campagne
					if ($Result==1)
					{
						if (strtoupper($chaine_campagne) != strtoupper($dir_campagne))
						{
							$Result=0;
							if ($debug==1) {echo " campagne incorrecte ";}
						} else if ($debug==1) {echo " campagne correcte ";
						}
					}

					//vérification du critère agent
					if ($Result==1)
					{
						if ( !empty($chaine_agent) && ( stripos($dir_agent, $chaine_agent)===false ) )
						{
							$Result=0;
							if ($debug==1) {echo " agent incorrecte ";}
						} else if ($debug==1) {echo " agent correcte ";
						}
					}
					
					//vérification du critère qualification
					/*if ($Result==1)
					{
						if ( !empty($chaine_qualification) && ( stripos($dir_qualif, $chaine_qualification)===false  ) )
						{
							$Result=0;
							if ($debug==1) {echo " qualif incorrecte ";}
						} else if ($debug==1) {echo " qualif correcte ";
						}
					}
					*/	
					//vérification du critère téléphone
					if ($Result==1)
					{
						if ( !empty($chaine_tel) && ( stripos($dir_tel, $chaine_tel)===false ) )
						{
							$Result=0;
							if ($debug==1) {echo " tel incorrecte ";}
						} else if ($debug==1) {echo " tel correcte ";
						}
					}

					
					if ($Result==1) 
					{
						$tableau_resultats[$count] = array('fichier' => $file,
						 'chemin' => $dir_url,
						 'nom_fichier' => $file_name,
						 'date' => $dir_date,
						 'heure' => $dir_heure,
						 'campagne' => $dir_campagne,
						 'agent' => $dir_agent,
						 'qualif' => $dir_qualif);
						$count = $count + 1;
					}
				}

				foreach($tableau_resultats as $k => $v) {
				   $heure[$k] = $v['heure'];
				}

				foreach($tableau_resultats as $k => $v) {
					$a=strtotime($v['date']);
					//$datetemp = date("Y-m-d",$a);		
				    $date_tab[$k] = $a;

				}
				//

				array_multisort($date_tab, SORT_ASC, $heure, SORT_ASC, $tableau_resultats);
				//print_r($heure);

				$fin=$count;
				//loadview
				$this->load->view('include/menu',$data);
				$this->load->view('enregistrement/traitement',$data);
				for($i=0;$i<$fin;$i++)
				{
					$this->AppendLine($tableau_resultats[$i]['fichier'], $tableau_resultats[$i]['chemin'], $tableau_resultats[$i]['nom_fichier'], $tableau_resultats[$i]['date'], $tableau_resultats[$i]['heure'], $tableau_resultats[$i]['campagne'], $tableau_resultats[$i]['agent'], $tableau_resultats[$i]['qualif']);
				}		
				$this->load->view('enregistrement/footer_enr');	
			}
		}
		else
		{	
			redirect('users/index');	
		}
	}
}