<?php

class MY_Lang extends CI_Lang {
	private $alt_path = array();
	
	public function addAltPath($path = array())
	{
		if (is_array($path))
		{
			$this->alt_path = array_merge($this->alt_path, $path);
		}
		else
		{
			$this->alt_path[] = $path;
		}
	}
	
	/**
	 * Load a language file
	 *
	 * @access	public
	 * @param	mixed	the name of the language file to be loaded. Can be an array
	 * @param	string	the language (english, etc.)
	 * @param	bool	return loaded array of translations
	 * @param 	bool	add suffix to $langfile
	 * @param 	string	alternative path to look for language file
	 * @return	mixed
	 */
	function load($langfile = '', $idiom = '', $return = FALSE, $add_suffix = TRUE, $alt_path = '')
	{
		$langfile = str_replace('.php', '', $langfile);
	
		if ($add_suffix == TRUE)
		{
			$langfile = str_replace('_lang.', '', $langfile).'_lang';
		}
	
		$langfile .= '.php';
	
		if (in_array($langfile, $this->is_loaded, TRUE))
		{
			return;
		}
	
		$config =& get_config();
	
		if ($idiom == '')
		{
			$deft_lang = ( ! isset($config['language'])) ? 'english' : $config['language'];
			$idiom = ($deft_lang == '') ? 'english' : $deft_lang;
		}
		
		$found = FALSE;
		
		if ($alt_path != '')
		{
			$this->alt_path[] = $alt_path;
		}
		
		foreach ($this->alt_path as $path)
		{
			if (file_exists($path.'language/'.$idiom.'/'.$langfile))
			{
				include($path.'language/'.$idiom.'/'.$langfile);
				$found = TRUE;
			}
		}
	
		// Determine where the language file is and load it
		if ($found !== TRUE)
		{	
			foreach (get_instance()->load->get_package_paths(TRUE) as $package_path)
			{
				if (file_exists($package_path.'language/'.$idiom.'/'.$langfile))
				{
					include($package_path.'language/'.$idiom.'/'.$langfile);
					$found = TRUE;
					break;
				}
			}
	
			if ($found !== TRUE)
			{
				show_error('Unable to load the requested language file: language/'.$idiom.'/'.$langfile);
			}
		}
	
	
		if ( ! isset($lang))
		{
			log_message('error', 'Language file contains no data: language/'.$idiom.'/'.$langfile);
			return;
		}
	
		if ($return == TRUE)
		{
			return $lang;
		}
	
		$this->is_loaded[] = $langfile;
		$this->language = array_merge($this->language, $lang);
		unset($lang);
	
		log_message('debug', 'Language file loaded: language/'.$idiom.'/'.$langfile);
		return TRUE;
	}
}
