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
class Halaman extends Controller {

	function Halaman()
    {
        parent::Controller();
		$this->load->model('admin/script_generator/general');
		$this->load->library('session');
		$this->load->library('parser');
    }

//------------------------------HALAMAN------------------------------------------------------------------------------------------
	function halaman_list()
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.$this->config->item('base_url').config_item('index_page').'/cpm/');
		}
		else
		{
			$data = $this->general->get_script('halaman_list',$this->session->userdata('username'));
			$this->parser->parse('admin/atas', $data);
			$this->parser->parse('admin/halaman/halaman', $data);
		}
	}

	function halaman_form_insert()
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
			$this->parser->parse('admin/halaman/halaman_form_insert', $data);
		}
	}

	function halaman_form_edit($id)
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.$this->config->item('base_url').config_item('index_page').'/cpm/');
		}
		else
		{
			$data = $this->general->get_script('halaman_edit',$this->session->userdata('username'),$id);
			$this->parser->parse('admin/atas', $data);
			$this->parser->parse('admin/halaman/halaman_form_edit', $data);
		}
	}

	function halaman_insert()
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$result = $this->general->halaman_insert($this->session->userdata('username'),$_POST);
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/halaman/'));
		}
	}

	function halaman_edit()
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$result = $this->general->halaman_edit($this->session->userdata('username'),$_POST);
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/halaman/'));
		}
	}

	function halaman_delete($id)
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$result = $this->general->halaman_delete($this->session->userdata('username'),$id);
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/halaman/'));
		}
	}

	function halaman_delete_image($id)
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$result = $this->general->halaman_delete_image($this->session->userdata('username'),$id);
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/halaman_form_edit/'.$id.'#image'));
		}
	}

	function halaman_shiftup($id)
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$result = $this->general->halaman_shiftup($this->session->userdata('username'),$id);
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/halaman/'));
		}
	}

	function halaman_shiftdown($id)
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$result = $this->general->halaman_shiftdown($this->session->userdata('username'),$id);
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/halaman/'));
		}
	}


	function page_input($id)
	{
		$data = $this->general->get_script('halaman_edit',$this->session->userdata('username'),$id);
		$this->parser->parse('admin/halaman/page.input.php',$data);
	}

	function page_edit($id)
	{
		$data = $this->general->get_script('halaman_edit',$this->session->userdata('username'),$id);
		$this->parser->parse('admin/halaman/page.edit.php',$data);
	}

	function page_url_input($id)
	{
		$data = $this->general->get_script('halaman_edit',$this->session->userdata('username'),$id);
		$this->parser->parse('admin/halaman/url.input.php',$data);
	}

	function page_uri_input($id)
	{
		$data = $this->general->get_script('halaman_edit',$this->session->userdata('username'),$id);
		$this->parser->parse('admin/halaman/uri.input.php',$data);
	}

	function page_module_input($id)
	{
		$data = $this->general->get_script('halaman_edit',$this->session->userdata('username'),$id);
		$this->parser->parse('admin/halaman/module.input.php',$data);
	}

//-------------------------------------------------------------------------------------------------------------------------------	




}
?>
