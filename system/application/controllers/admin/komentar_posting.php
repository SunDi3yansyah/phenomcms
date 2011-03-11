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
class Komentar_Posting extends Controller {

	function Komentar_Posting()
    {
        parent::Controller();
		$this->load->model('admin/script_generator/general');
		$this->load->library('session');
    }

//------------------------------KOMENTAR POSTING------------------------------------------------------------------------------------------
	function komentar_posting_list($posting_id)
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$data = $this->general->get_script('komentar_posting',$this->session->userdata('username'),$posting_id);
			$this->parser->parse('admin/atas', $data);
			$this->parser->parse('admin/komentar_posting/komentar', $data);
		}
	}

	function komentar_posting_selected_process()
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$result = $this->general->komentar_posting_selected_process($this->session->userdata('username'),$_POST);
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/komentar_posting/'.$result['posting_id']."/".$result['page']));
		}
	}

	function komentar_posting_delete($id)
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
		}
		else
		{
			$result = $this->general->komentar_posting_delete($this->session->userdata('username'),$id);
			header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/komentar_posting/'.$result['posting_id']));
		}
	}

//-------------------------------------------------------------------------------------------------------------------------------	

	

}
?>
