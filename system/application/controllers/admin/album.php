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
class Album extends Controller {

	function Album()
    {
        parent::Controller();
		$this->load->model('admin/script_generator/general');
		$this->load->library('session');
    }

//------------------------------album------------------------------------------------------------------------------------------
	function album_list()
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$data = $this->general->get_script('album_list',$this->session->userdata('username'));
			$this->parser->parse('admin/atas', $data);
			$this->parser->parse('admin/album/album', $data);
		}
	}

	function album_form_insert()
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
			$this->parser->parse('admin/album/album_form_insert', $data);
		}
	}

	function album_form_edit($id)
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$data = $this->general->get_script('album_edit',$this->session->userdata('username'),$id);
			$this->parser->parse('admin/atas', $data);
			$this->parser->parse('admin/album/album_form_edit', $data);
		}
	}


	function album_insert()
	{
		$this->load->model('admin/script_generator/album_model');
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$result = $this->album_model->album_insert($this->session->userdata('username'),$_POST);
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/album/'));
		}
	}



	function album_edit()
	{
		$this->load->model('admin/script_generator/album_model');
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$result = $this->album_model->album_edit($this->session->userdata('username'),$_POST);
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/album/'));
		}
	}


	function album_delete($id)
	{
		$this->load->model('admin/script_generator/album_model');
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$result = $this->album_model->album_delete($this->session->userdata('username'),$id);
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/album/'));
		}
	}

	function photo_process($album_id)
	{
		$this->load->model('admin/script_generator/album_model');
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$result = $this->album_model->photo_process($this->session->userdata('username'),$_POST);
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/album_form_edit/'.$album_id));
		}
	}

	function photo_insert($album_id)
	{
		$this->load->model('admin/script_generator/album_model');
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$result = $this->album_model->photo_insert($this->session->userdata('username'),$_POST);
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/album_form_edit/'.$album_id.'#new'));
		}
	}


	function photo_delete($album_id, $id)
	{
		$this->load->model('admin/script_generator/album_model');
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$result = $this->album_model->photo_delete($this->session->userdata('username'),$id);
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/album_form_edit/'.$album_id));
		}
	}

	function photo_thumbnail($album_id, $id)
	{
		$this->load->model('admin/script_generator/album_model');
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$result = $this->album_model->photo_thumbnail($this->session->userdata('username'),$album_id,$id);
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/album_form_edit/'.$album_id));
		}
	}


	function photo_shiftup($album_id, $id)
	{
		$this->load->model('admin/script_generator/album_model');
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$result = $this->album_model->photo_shiftup($this->session->userdata('username'),$album_id,$id);
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/album_form_edit/'.$album_id.'#'.$id));
		}
	}

	function photo_shiftdown($album_id, $id)
	{
		$this->load->model('admin/script_generator/album_model');
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$result = $this->album_model->photo_shiftdown($this->session->userdata('username'),$album_id,$id);
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/album_form_edit/'.$album_id.'#'.$id));
		}
	}

//-------------------------------------------------------------------------------------------------------------------------------	

	

}
?>
