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
class Direktori extends Controller {

	function Direktori()
    {
        parent::Controller();
		$this->load->model('admin/script_generator/general');
		$this->load->library('session');
    }

	function setting()
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			$this->parser->parse('admin/atas', $data);
			$this->parser->parse('admin/direktori/setting', $data);
		}
	}

	function menu()
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			$this->parser->parse('admin/atas', $data);
			$this->parser->parse('admin/direktori/menu', $data);
		}
	}

	function posting()
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			$this->parser->parse('admin/atas', $data);
			$this->parser->parse('admin/direktori/posting', $data);
		}
	}

	function modul()
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			$this->parser->parse('admin/atas', $data);
			$this->parser->parse('admin/direktori/modul', $data);
		}
	}

	function user()
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			$this->parser->parse('admin/atas', $data);
			$this->parser->parse('admin/direktori/user', $data);
		}
	}


}
?>
