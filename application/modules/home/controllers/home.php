<?php

class Home extends CI_Controller
{
	public function view()
	{
		client_lang('home');
		
		$data = array(
			'title' => lang('home_title')
		);
		
		$content = $this->template->loadPage('home', $data);
		$this->template->view($content);
	}

	public function lang($lang = FALSE, $route = FALSE)
	{
		$result = $this->user->saveLanguage($lang);
		$this->user->setMessage('lang', (int)$result);
		
		header("Location: " . site_url($route == FALSE ? 'home' : $route));
		die();
	}
}