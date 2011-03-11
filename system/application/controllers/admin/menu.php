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
class Menu extends Controller {

	function Menu()
    {
        parent::Controller();
		$this->load->model('admin/script_generator/general');
		$this->load->library('session');
		$this->load->library('parser');
    }

//------------------------------menu------------------------------------------------------------------------------------------
	function menu_list()
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$data = $this->general->get_script('menu_list',$this->session->userdata('username'));
			$this->parser->parse('admin/atas', $data);
			$this->parser->parse('admin/menu/menu', $data);
		}
	}

	function menu_form_insert()
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$data = $this->general->get_script('menu_form_insert',$this->session->userdata('username'));
			$this->parser->parse('admin/atas', $data);
			$this->parser->parse('admin/menu/menu_form_insert', $data);
		}
	}

	function menu_form_insert_html()
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$data = $this->general->get_script('menu_form_insert',$this->session->userdata('username'));
			$this->parser->parse('admin/atas', $data);
			$this->parser->parse('admin/menu/menu_form_insert_html', $data);
		}
	}

	function menu_form_edit($id)
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$data = $this->general->get_script('menu_edit',$this->session->userdata('username'),$id);
			$this->parser->parse('admin/atas', $data);
			$this->parser->parse('admin/menu/menu_form_edit', $data);
		}
	}

	function menu_form_edit_html($id)
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$data = $this->general->get_script('menu_edit',$this->session->userdata('username'),$id);
			$this->parser->parse('admin/atas', $data);
			$this->parser->parse('admin/menu/menu_form_edit_html', $data);
		}
	}

	function menu_insert()
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$result = $this->general->menu_insert($this->session->userdata('username'),$_POST);
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/menu/'));
		}
	}

	function menu_edit()
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$result = $this->general->menu_edit($this->session->userdata('username'),$_POST);
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/menu/'));
		}
	}

	function menu_delete($id)
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$result = $this->general->menu_delete($this->session->userdata('username'),$id);
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/menu/'));
		}
	}

	function menu_delete_image($id)
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$result = $this->general->menu_delete_image($this->session->userdata('username'),$id);
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/menu_form_edit/'.$id.'#image'));
		}
	}

	function menu_shiftup($id)
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$result = $this->general->menu_shiftup($this->session->userdata('username'),$id);
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/menu/'));
		}
	}

	function menu_shiftdown($id)
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$result = $this->general->menu_shiftdown($this->session->userdata('username'),$id);
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/menu/'));
		}
	}



	function menu_input($id)
	{
		$data = $this->general->get_script('menu_edit',$this->session->userdata('username'),$id);
		$this->parser->parse('admin/menu/menu.input.php',$data);
	}

	function menu_link_edit($id)
	{
		$data = $this->general->get_script('menu_edit',$this->session->userdata('username'),$id);
		$this->parser->parse('admin/menu/menu.edit.php',$data);
	}

	function menu_url_input($id)
	{
		$data = $this->general->get_script('menu_edit',$this->session->userdata('username'),$id);
		$this->parser->parse('admin/menu/url.input.php',$data);
	}

	function menu_uri_input($id)
	{
		$data = $this->general->get_script('menu_edit',$this->session->userdata('username'),$id);
		$this->parser->parse('admin/menu/uri.input.php',$data);
	}

	function menu_module_input($id)
	{
		$data = $this->general->get_script('menu_edit',$this->session->userdata('username'),$id);
		$this->parser->parse('admin/menu/module.input.php',$data);
	}

//-------------------------------------------------------------------------------------------------------------------------------	
	

}
?>
