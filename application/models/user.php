<?php

class User extends CI_Model
{
	private $language = '';
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('session');
		
		// Set lenguage if none
		if ($this->session->userdata('language') === FALSE)
		{
			$CI =& get_instance();
			$this->session->set_userdata(array(
				'language' => $CI->config->item('language')
			));
		}

		// Set lenguage
		$this->language = $this->session->userdata('language');
		
		// Check if lenguage exists
		if (!$this->languageExists($this->language))
		{
			$CI =& get_instance();
			$this->language = $CI->config->item('language');
			$this->saveLanguage();
		}
	}
	
	public function getLanguage()
	{
		return $this->language;
	}

	public function saveLanguage($lang = FALSE)
	{
		if ($lang !== FALSE && !$this->languageExists($lang))
			return false;
		
		$this->session->set_userdata(array(
			'language' => ($lang === FALSE) ? $this->getLanguage() : $lang
		));
		
		return true;
	}
	
	private function languageExists($lang)
	{
		return file_exists(APPPATH . 'language/' . $lang);
	}
	
	public function setMessage($type, $value)
	{
		$this->session->set_flashdata('message_' . $type, $value);
	}
}
