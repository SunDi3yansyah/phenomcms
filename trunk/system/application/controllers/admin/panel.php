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
class Panel extends Controller {

	function Panel()
    {
        parent::Controller();
		$this->load->model('admin/script_generator/general');
		$this->load->library('session');
		$this->load->library('parser');
    }

//------------------------------PANEL------------------------------------------------------------------------------------------
	function panel_list()
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.$this->config->item('base_url').config_item('index_page').'/cpm/');
		}
		else
		{
			$data = $this->general->get_script('panel_list',$this->session->userdata('username'));
			$this->parser->parse('admin/atas', $data);
			$this->parser->parse('admin/panel/panel', $data);
		}
	}

	function panel_form_insert()
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.$this->config->item('base_url').config_item('index_page').'/cpm/');
		}
		else
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			$this->parser->parse('admin/atas', $data);
			$this->parser->parse('admin/panel/panel_form_insert', $data);
		}
	}

	function panel_form_edit($id)
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.$this->config->item('base_url').config_item('index_page').'/cpm/');
		}
		else
		{
			$data = $this->general->get_script('panel_edit',$this->session->userdata('username'),$id);
			$this->parser->parse('admin/atas', $data);
			$this->parser->parse('admin/panel/panel_form_edit', $data);
		}
	}

	function panel_insert()
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$result = $this->general->panel_insert($this->session->userdata('username'),$_POST);
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/panel/'));
		}
	}

	function panel_edit()
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$result = $this->general->panel_edit($this->session->userdata('username'),$_POST);
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/panel/'));
		}
	}

	function panel_delete($id)
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$result = $this->general->panel_delete($this->session->userdata('username'),$id);
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/panel/'));
		}
	}

	function panel_shiftup($id)
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$result = $this->general->panel_shiftup($this->session->userdata('username'),$id);
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/panel/'));
		}
	}

	function panel_shiftdown($id)
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$result = $this->general->panel_shiftdown($this->session->userdata('username'),$id);
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/panel/'));
		}
	}
//-------------------------------------------------------------------------------------------------------------------------------	




}
?>
