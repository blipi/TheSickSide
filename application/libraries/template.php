<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template
{
	private $CI = null;
	static private $title = '';
	static private $module = '';
	static private $canonical = '';
	static private $redirects = array();
	
	public function __construct()
	{
		$this->CI =& get_instance();
	}
	
	public function setInformation($module, $canonical, $redirects)
	{
		$this::$title = $module . ' - The Sick Side';
		$this::$module = $module;
		$this::$canonical = $canonical;
		$this::$redirects = $redirects;
	}
	
	public function loadPage($page, $data = array())
	{
		if (isset($data['title']))
		{
			$this::$title = $data['title'] . ' - The Sick Side';
		}
		
		// Setup some data
		if (is_array($data))
		{
			$data = array_merge($data, array(
				'title' 			=> $this::$title,
				'redirects'			=> $this::$redirects,
				'canonical'			=> $this::$canonical,
				'base_url' 			=> $this->CI->config->item('base_url'),
				'current_module' 	=> strtolower($this::$module),
				'current_language'	=> $this->CI->user->getLanguage()
			));
		}
		
		return $this->CI->load->view($page, $data, TRUE);
	}
	
	public function view($content, $js = array(), $css = array())
	{
		if (!is_array($js))
		{
			$js = array();
		}
		
		if (!is_array($css))
		{
			$css = array();
		}
		
		$content = $this->parseMessage($js) . $content;		
		$output = '';
		if ($this->CI->input->is_ajax_request() && isset($_GET['is_json_ajax']) && $_GET['is_json_ajax'] == 1)
		{
			$output = $this->parseAjaxRequest($content, $js, $css);
		}
		else
		{
			$output = $this->parseNormalRequest($content, $js, $css);
		}
		
		die($output);
	}
	
	private function parseMessage(&$js)
	{		
		$output = '';
		
		$langMessage = $this->CI->session->flashdata('message_lang');
		if ($langMessage !== FALSE)
		{
			$js[] = 'message';			
			client_lang('lang');
		
			if ($langMessage == 1)
			{
				$output = $this->CI->load->view('templates/message', array(
					'result' => 'success',
					'header' => lang('lang_changed'),
					'body' => lang('lang_body')
				), true);
			}
			else
			{
				$output = $this->CI->load->view('templates/message', array(
					'result' => 'failure',
					'header' => lang('lang_failure'),
					'body' => lang('lang_body')
				), true);
			}
		}
		
		return $output;
	}
	
	private function parseAjaxRequest($content, $js, $css)
	{
		$ajax = array(
			'title'		=> utf8_encode($this::$title),
			'module' 	=> utf8_encode(strtolower($this::$module)),
			'content' 	=> utf8_encode($content),
			'js'		=> $js,
			'css'		=> $css,
			'language'	=> FALSE
		);
						
		return json_encode($ajax);
	}
	
	private function parseNormalRequest($content, $js, $css)
	{
		$data = array(
			'redirects'			=> $this::$redirects,
			'canonical'			=> $this::$canonical,
			'base_url' 			=> $this->CI->config->item('base_url'),
			'current_module' 	=> strtolower($this::$module),
			'js'				=> $js,
			'css'				=> $css,
			'useSlideShow'		=> TRUE,
		);
		
		// Parse header
		$header = $this->loadPage('templates/header', $data, true);
		
		// Parse footer
		$footer = $this->loadPage('templates/footer', $data, true);

		return $header . $content . $footer;
	}
}
