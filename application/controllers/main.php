<?php

class Main extends CI_Controller 
{
	private $url_mappings = array();
	private $url_redirects = array();
	
	private function buildUrlMappings()
	{
		$query = $this->db->query('SELECT * FROM `url_mappings`');
		$lang = $this->get_instance()->user->getLanguage();
		foreach ($query->result() as $row)
		{
			$this->url_mappings[$row->esp] = $row->url;
			$this->url_mappings[$row->cat] = $row->url;
			$this->url_mappings[$row->eng] = $row->url;
			
			$this->url_redirects[$row->url] = $row->{$lang};
		}
	}
	
	private function getPageUrl($page)
	{
		if (isset($this->url_mappings[$page]))
			return $this->url_mappings[$page];
		
		return $page;
	}

	public function view($module = 'news')
	{
		// Load libraries
		$this->load->helper('language');
		$this->load->helper('url');
		
		// Load database
		$this->load->database();
		
		// Load languages
		client_lang('error');
		client_lang('menu');
		
		// Load mappings
		$this->buildUrlMappings();

		// Convert to lower as to find paths
		$module = strtolower($module);
		
		// Get real name
		$canonical = '';
		$page = $this->getPageUrl($module);
		if ($module != $page)
			$canonical = $page;
		
		// Check for the controllers and templates
		$controller_path = APPPATH . 'modules/' . $page . '/controllers/' . $page . '.php';
		$templates_path = APPPATH . 'modules/' . $page . '/templates/';
		$language_path = APPPATH . 'modules/' . $page . '/';
		$page = ucfirst($page);
						
		// Does the controller exist?
		if (!file_exists($controller_path))
		{
			$virtual_path = APPPATH . 'modules/virtualizer/views/' . $page . '.cch';
			$virtualizer = APPPATH . 'modules/virtualizer/controllers/virtualizer.php';
			
			require($virtualizer);
			$controller = new Virtualizer($virtual_path);
			
			// It may be a virtual page!
			if (!$controller->load())
			{
				show_error(lang('error_controller_not_found'), 500, lang('error_error_occurred'));
			}
			else
			{
				$templates_path = APPPATH . 'modules/virtualizer/templates/';
				$language_path = APPPATH . 'modules/virtualizer/';
			}
		}
		else
		{		
			// Include the controller
			require($controller_path);
		
			// Load the real controller
			$controller = new $page;		
		}
		
		// Set the template library variables
		$this->template->setInformation($module, $canonical, $this->url_redirects);

		// Set call arguments
		$arguments = func_get_args();
		array_shift($arguments);

		// Should we call view or another function?
		$function = 'view';
		if (sizeof($arguments) >= 2)
		{
			if (method_exists($controller, $arguments[0]))
			{
				$function = $arguments[0];
				array_shift($arguments);
			}
		}
		
		// Set templates path if any
		// TODO Allow some configuration
		if (file_exists($templates_path))
		{
			$this->load->addTemplateDir($templates_path);
		}
		else /*if (config->item('show_template_folder_error'))*/
		{
			show_error(lang('error_template_not_found'), 500, lang('error_error_occurred'));
		}
		
		// Add language path if any
		if (file_exists($language_path . 'language/'))
		{
			$this->lang->addAltPath($language_path);
		}
		
		// Call controller function
		call_user_func_array(array($controller, $function), $arguments);
	}
}
