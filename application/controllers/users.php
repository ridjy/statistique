 <?php
class Users extends CI_Controller
{
	public function __construct()
	{
		// Obligatoire
		parent::__construct();
		// Maintenant, ce code sera exécuté chaque fois que ce contrôleur sera appelé.
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->database();
		$this->load->model('user_model');
		$this->load->library('form_validation');
		$data = array();
	}
	public function index()
	{
		$data['e']=$this->input->get('e');
		$this->load->view("user/index",$data);
	}

	public function redirect()
	{
			
		$data['row']=$this->user_model->test_login($this->input->post('log'),$this->input->post('mdp'));
		if (empty($data['row']))
		{
			$e='Utilisateur inexistant';
			redirect("users/index?e=$e");
		}
		else
		{	
			foreach($data['row'] as $item)
			{
				//on init ici tous les var de session
				$this->session->set_userdata('user_id', $item->user_id);
			    $this->session->set_userdata('user_login', $item->user_login);
				//$adresse_ip = $this->session->userdata('ip_address');
				$this->session->set_userdata('user_mdp', $item->user_mdp);
			    $this->session->set_userdata('user_niveau', $item->user_niveau);
				$this->session->set_userdata('last_actif', $item->user_lastActivity);
			    $this->session->set_userdata('ud_enr', $item->ud_enr);
				$this->session->set_userdata('ud_stat', $item->ud_stat);
			    $this->session->set_userdata('ud_stat_exp', $item->ud_stat_exp);
				$this->session->set_userdata('ud_enr_lecture', $item->ud_enr_lecture);
			    $this->session->set_userdata('ud_enr_tel', $item->ud_enr_tel);
				$this->session->set_userdata('user_delai', $item->user_delai);
			    $this->session->set_userdata('camp_chartres', $item->camp_chartres);
			    $this->session->set_userdata('camp_troyes', $item->camp_troyes);
			    $this->session->set_userdata('camp_chateauroux', $item->camp_chateauroux);
			    //$this->session->set_userdata('connect', TRUE);

			}    
			    //dernier activité
				$this->session->set_userdata('last_access', time());
				//$this->session->unset_userdata(array('pseudo' => '', 'email' => ''));	
				$delai=time()-$this->session->userdata('user_delai')*(30*24*60*60); // 30 jours; 24 heures; 60 minutes; 60 secondes
			    if( $this->session->userdata('last_actif') < $delai || $this->session->userdata('user_niveau')=='inactif')
			    {
			    	//on désactive son compte
			    	if($this->user_model->delai_activite($this->session->userdata('user_id')))
			    	{
			    		$e='Votre compte est désactivé';
			    		redirect("users/index?e=$e");
			    	}
			    		
			    }
			    else
			    {
			    	//on insère dans la base son dernier activité
			    	if($this->user_model->last_activite($this->session->userdata('user_id')))
			    	{
			    		$this->accueil();
			    	}
			    }
		}	
	
	}
	public function accueil()
	{
		//initizlisztion des droits
		$data['fenetre']='accueil';
		if ($this->session->userdata('user_login'))
		{
			$this->load->view('include/menu',$data);
			$this->load->view('include/contenu');
			$this->load->view('include/footer');	
		}
		else
		{	
			redirect('users/index');	
		}
	}

	public function deconnexion()
	{
		// Détruit la session
		$this->session->sess_destroy();
		// Redirige vers la page d'accueil
		redirect('users/index');
	}
}