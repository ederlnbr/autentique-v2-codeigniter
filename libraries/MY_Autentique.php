<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Autentique 
{
 
	var $ci;
	var $config;
	var $autentique;
	
	public function __construct($param=array())
	{
		$this->ci =& get_instance();
		
		$this->initialize($param);

		include_once APPPATH.'/third_party/autentique/Autentique.php';

		$this->autentique = new Autentique($this->config);

		log_message('info', 'Autentique class is loaded.');
	}
	
	public function initialize($config = array())
	{
		$this->ci->config->load('autentique');	

		if(count($config) == 0)
		{
			$this->config['token']    = $this->ci->config->item('autentique_token');
			$this->config['endpoint'] = $this->ci->config->item('autentique_endpoint');
			$this->config['env']      = $this->ci->config->item('autentique_env');
		}
		else 
		{
			$this->config['token']    = $config['token'];
			$this->config['endpoint'] = isset($config['endpoint']) && $config['endpoint'] != "" ? $config['endpoint'] : $this->ci->config->item('autentique_endpoint');
			$this->config['env']      = isset($config['env']) && $config['env'] != "" ? $config['env'] : $this->ci->config->item('autentique_env');
		}
	}

	public function folder()
	{
		return $this->autentique->folder();
	}

	public function document()
	{
		return $this->autentique->document();
	}
}