<?php

class News extends CI_Controller
{
	private function findForLang($news, $search, $lang)
	{
		foreach ($search as $what)
		{
			if (!empty($news->{$what . '_' . $lang}))
				$news->{$what} = $news->{$what . '_' . $lang};
			else
			{
				foreach (array('cat','esp','eng') as $l)
					if (!empty($news->{$what . '_' . $l}))
						$news->{$what} = $news->{$what . '_' . $l};
			}
			if (!property_exists($news, $what))
				$news->{$what} = '';
		}
		
		
		return $news;
	}
	
	public function view()
	{		
		client_lang('news');
		
		$this->load->database();
		$news = $this->db->query('SELECT * FROM `news` ORDER BY `id` DESC LIMIT 10')->result();
		
		$lang = $this->user->getLanguage();
		
		for ($i = 0; $i < count($news); $i++)
		{
			$news[$i] = $this->findForLang($news[$i], array('title', 'text'), $lang);
		}
		
		$data = array(
			'title' => lang('news_title'),
			'news'	=> $news
		);
		
		$content = $this->template->loadPage('news', $data);
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