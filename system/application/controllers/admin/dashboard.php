<?php 
/**
 * PhenomCMS
 *
 * Open Source CodeIgniter CMS
 *
 * @package		PhenomCMS
 * @author		Yadi Utama
 * @copyright	Copyright (c) 2010, PhenomCMS.
 * @since		Version 1.0
 * @filesource
 */
// ------------------------------------------------------------------------
class Dashboard extends Controller {

	function Dashboard()
    {
        parent::Controller();
		$this->load->model('admin/script_generator/general');
		$this->load->library('session');
		$this->load->library('parser');
    }


//------------------------------PROFIL------------------------------------------------------------------------------------------
	function profile()
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.$this->config->item('base_url').config_item('index_page').'/cpm/');
		}
		else
		{
			$data = $this->general->get_script('profile',$this->session->userdata('username'));
			$this->parser->parse('admin/atas', $data);
			$this->parser->parse('admin/profile/profile', $data);
		}
	}

	function profile_edit()
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.$this->config->item('base_url').config_item('index_page').'/cpm/');
		}
		else
		{
			$result = $this->general->profile_edit($this->session->userdata('username'),$_POST);
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/profile'));
		}
	}
//-------------------------------------------------------------------------------------------------------------------------------	



//------------------------------BOTTOM CONTENT------------------------------------------------------------------------------------------
	function bottom()
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.$this->config->item('base_url').config_item('index_page').'/cpm/');
		}
		else
		{
			$data = $this->general->get_script('bottom_blog',$this->session->userdata('username'));
			$this->parser->parse('admin/atas', $data);
			$this->parser->parse('admin/bottom/bottom', $data);
		}
	}

	function bottom_edit()
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.$this->config->item('base_url').config_item('index_page').'/cpm/');
		}
		else
		{
			$result = $this->general->bottom_edit($this->session->userdata('username'),$_POST);
			header('location: '.$this->config->item('base_url').config_item('index_page').'/cpm/');
		}
	}
//-------------------------------------------------------------------------------------------------------------------------------	



//------------------------------THEMES------------------------------------------------------------------------------------------
	function themes()
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.$this->config->item('base_url').config_item('index_page').'/cpm/');
		}
		else
		{
			$data = $this->general->get_script('themes',$this->session->userdata('username'));
			$this->parser->parse('admin/atas', $data);
			$this->parser->parse('admin/themes/themes', $data);
		}
	}
	function theme_edit()
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.$this->config->item('base_url').config_item('index_page').'/cpm/');
		}
		else
		{
			$result = $this->general->theme_edit($this->session->userdata('username'),$_POST);
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/themes/'));
		}
	}
//-------------------------------------------------------------------------------------------------------------------------------	


//------------------------------PASSWORD------------------------------------------------------------------------------------------
	function password($status)
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.$this->config->item('base_url').config_item('index_page').'/cpm/');
		}
		else
		{
			$data = $this->general->get_script('password',$this->session->userdata('username'));
			if ($status=='0') $pesan['pesan'] = '';
			else $pesan['pesan'] = 'Password GAGAL di-update!';
			$data = array_merge($data,$pesan);
			$this->parser->parse('admin/atas', $data);
			$this->parser->parse('admin/password/password', $data);
		}
	}
	function password_edit()
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.$this->config->item('base_url').config_item('index_page').'/cpm/');
		}
		else
		{
			$result = $this->general->password_edit($this->session->userdata('username'),$_POST);
			header('location: '.$this->config->item('base_url').config_item('index_page').'/cpm/password/1/');
		}
	}
//-------------------------------------------------------------------------------------------------------------------------------	


	

}
?>
