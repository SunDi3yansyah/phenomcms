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
class Polling extends Controller {

	function Polling()
    {
        parent::Controller();
		$this->load->model('admin/script_generator/general');
		$this->load->library('session');
		$this->load->library('parser');
    }

//------------------------------POSTING------------------------------------------------------------------------------------------
	function polling_list()
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$data = $this->general->get_script('polling_list',$this->session->userdata('username'));
			$this->parser->parse('admin/atas', $data);
			$this->parser->parse('admin/polling/polling', $data);
		}
	}

	function polling_form_insert()
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
			$this->parser->parse('admin/polling/polling_form_insert', $data);
		}
	}


	function polling_form_edit($id)
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$data = $this->general->get_script('polling_edit',$this->session->userdata('username'),$id);
			$this->parser->parse('admin/atas', $data);
			$this->parser->parse('admin/polling/polling_form_edit', $data);
		}
	}

	function polling_insert()
	{
		$this->load->model('admin/script_generator/polling_model');
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$result = $this->polling_model->polling_insert($this->session->userdata('username'),$_POST);
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/polling/'));
		}
	}

	function polling_edit()
	{
		$this->load->model('admin/script_generator/polling_model');
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$result = $this->polling_model->polling_edit($this->session->userdata('username'),$_POST);
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/polling/'));
		}
	}

	function polling_delete($id)
	{
		$this->load->model('admin/script_generator/polling_model');
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$result = $this->polling_model->polling_delete($this->session->userdata('username'),$id);
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/polling/'));
		}
	}

	function polling_activate($id)
	{
		$this->load->model('admin/script_generator/polling_model');
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$result = $this->polling_model->polling_activate($this->session->userdata('username'),$id);
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/polling/'));
		}
	}

	function polling_pil_process($polling_id)
	{
		$this->load->model('admin/script_generator/polling_model');
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$result = $this->polling_model->polling_pil_process($this->session->userdata('username'),$_POST);
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/polling_form_edit/'.$polling_id));
		}
	}

	function polling_pil_insert($polling_id)
	{
		$this->load->model('admin/script_generator/polling_model');
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$result = $this->polling_model->polling_pil_insert($this->session->userdata('username'),$_POST);
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/polling_form_edit/'.$polling_id.'#new'));
		}
	}

	function polling_pil_delete($polling_id, $id)
	{
		$this->load->model('admin/script_generator/polling_model');
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$result = $this->polling_model->polling_pil_delete($this->session->userdata('username'),$id);
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/polling_form_edit/'.$polling_id));
		}
	}

	function polling_pil_shiftup($polling_id, $id)
	{
		$this->load->model('admin/script_generator/polling_model');
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$result = $this->polling_model->polling_pil_shiftup($this->session->userdata('username'),$polling_id,$id);
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/polling_form_edit/'.$polling_id.'#'.$id));
		}
	}

	function polling_pil_shiftdown($polling_id, $id)
	{
		$this->load->model('admin/script_generator/polling_model');
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$result = $this->polling_model->polling_pil_shiftdown($this->session->userdata('username'),$polling_id,$id);
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/polling_form_edit/'.$polling_id.'#'.$id));
		}
	}



//-------------------------------------------------------------------------------------------------------------------------------	
	

}
?>
