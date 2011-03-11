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
class User extends Controller {

	function User()
    {
        parent::Controller();
		$this->load->model('admin/script_generator/general');
		$this->load->model('admin/script_generator/user_model');
		$this->load->library('session');
		$this->load->library('parser');
    }

//------------------------------user------------------------------------------------------------------------------------------
	function user_list()
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$data = $this->general->get_script('user_list',$this->session->userdata('username'));
			$this->parser->parse('admin/atas', $data);
			$this->parser->parse('admin/user/user', $data);
		}
	}

	function user_form_insert()
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
			$this->parser->parse('admin/user/user_form_insert', $data);
		}
	}

	function user_form_edit($id)
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$data = $this->general->get_script('user_edit',$this->session->userdata('username'),$id);
			$this->parser->parse('admin/atas', $data);
			$this->parser->parse('admin/user/user_form_edit', $data);
		}
	}

	function user_insert()
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$result = $this->user_model->user_insert($this->session->userdata('username'),$_POST);
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/user/'));
		}
	}

	function user_edit()
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$result = $this->user_model->user_edit($this->session->userdata('username'),$_POST);
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/user/'));
		}
	}

	function user_delete($id)
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$result = $this->user_model->user_delete($this->session->userdata('username'),$id);
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/user/'));
		}
	}

//-------------------------------------------------------------------------------------------------------------------------------	

}
?>
