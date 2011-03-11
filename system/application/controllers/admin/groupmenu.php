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
class Groupmenu extends Controller {

	function Groupmenu()
    {
        parent::Controller();
		$this->load->model('admin/script_generator/general');
		$this->load->library('session');
		$this->load->library('parser');
    }

//------------------------------groupmenu------------------------------------------------------------------------------------------
	function groupmenu_list()
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$data = $this->general->get_script('groupmenu_list',$this->session->userdata('username'));
			$this->parser->parse('admin/atas', $data);
			$this->parser->parse('admin/groupmenu/groupmenu', $data);
		}
	}


	function groupmenu_form_insert()
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
			$this->parser->parse('admin/groupmenu/groupmenu_form_insert', $data);
		}
	}

	function groupmenu_form_edit($id)
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$data = $this->general->get_script('groupmenu_edit',$this->session->userdata('username'),$id);
			$this->parser->parse('admin/atas', $data);
			$this->parser->parse('admin/groupmenu/groupmenu_form_edit', $data);
		}
	}


	function groupmenu_insert()
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$result = $this->general->groupmenu_insert($this->session->userdata('username'),$_POST);
			header('location: '.reduce_double_slashes(config_item('base_url').'cpm/groupmenu/'));
		}
	}

	function groupmenu_edit()
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$result = $this->general->groupmenu_edit($this->session->userdata('username'),$_POST);
			header('location: '.reduce_double_slashes(config_item('base_url').'cpm/groupmenu/'));
		}
	}

	function groupmenu_delete($id)
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$result = $this->general->groupmenu_delete($this->session->userdata('username'),$id);
			header('location: '.reduce_double_slashes(config_item('base_url').'cpm/groupmenu/'));
		}
	}

	function groupmenu_shiftup($id)
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$result = $this->general->groupmenu_shiftup($this->session->userdata('username'),$id);
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/groupmenu/'));
		}
	}

	function groupmenu_shiftdown($id)
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$result = $this->general->groupmenu_shiftdown($this->session->userdata('username'),$id);
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/groupmenu/'));
		}
	}

//-------------------------------------------------------------------------------------------------------------------------------	


	

}
?>
