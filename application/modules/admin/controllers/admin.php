<?php

class Admin extends CI_Controller
{
	public function view()
	{		
		$content = $this->template->loadPage('admin', array(
			'hidden_name' => $this->security->get_csrf_token_name(),
			'hidden_value' => $this->security->get_csrf_hash()
		));
		$this->template->view($content, array('tinymce/tinymce.min', 'tinymce/jquery.tinymce.min', 'plupload/plupload.full.min', 'plupload/i18n/ca', 'Admin'), array('admin'));
	}
	
	private function aempty($o = array())
	{
		foreach ($o as $a)
			if (!empty($a))
				return false;
			
		return true;
	}
	
	public function news($mode = '')
	{
		if (empty($mode))
		{
			exit('0');
		}

		$this->load->database();
		$names = array();
		$values = array();
		$data = $this->input->post('data');
		$data = json_decode($data, true);
		switch ($mode)
		{
			case 'add':
				foreach ($data as $lang => $null)
				{
					$names[] = '`title_' . $lang . '`';
					$names[] = '`text_' . $lang . '`';
					$values[] = $data[$lang]['title'];
					$values[] = $data[$lang]['text'];
				}
				break;
		}
		
		if ($this->aempty($values))
			exit('2');
		
		$sql = 'INSERT INTO `news` (' . implode(',', $names) . ') VALUES (' . implode(',', array_fill(0, count($values), '?')) . ');';
		$this->db->query($sql, $values);
		exit('1');
	}
	
	public function upload()
	{
		if (empty($_FILES) || $_FILES["file"]["error"]) {
			die('{"result": 0, "error": ' . utf8_encode($_FILES["file"]["error"]) . '}');
		}

		$this->config->load('uploads');
		$filename = $_FILES["file"]["name"];
		move_uploaded_file($_FILES["file"]["tmp_name"], $this->config->item('uploads_folder') . $filename);
		
		die('{"result": 1,"filename": "' . $filename . '", "path": "'. $this->config->item('uploads_folder') . $filename . '"}');
	}
}