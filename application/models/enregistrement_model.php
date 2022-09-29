<?php if ( ! defined('BASEPATH')) exit('No direct script access
allowed');

class Enregistrement_model extends CI_Model
{
	protected $table = 'campaign';
	public function __construct()
	{
		// Obligatoire
		parent::__construct();
		$DB1=$this->load->database('base1',TRUE);
		$DB2=$this->load->database('default',TRUE);
	}
	
	public function test()
	{
		
	}

} 