<?php if ( ! defined('BASEPATH')) exit('No direct script access
allowed');

class Ireflet_model extends CI_Model
{
	protected $table = '';
	public function __construct()
	{
		// Obligatoire
		parent::__construct();
		$this->load->database();	
	}
	
	public function supprimer_news($id)
	{
		return $this->db->where('id', (int) $id)->delete($this->table);
	}

	public function count($where = array())
	{
		return (int) $this->db->where($where)->count_all_results($this->table);
	}

}