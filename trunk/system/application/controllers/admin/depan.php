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
class Depan extends Controller {

	function Depan()
    {
        parent::Controller();
		$this->load->model('admin/script_generator/general');
		$this->load->library('session');
		$this->load->library('parser');
    }

	function login()	
	{
		$this->general->login_authentication($_POST['user'],md5($_POST['pass']));
		header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
	}

	function logout()	
	{
		$this->session->sess_destroy();
		header('location: '.reduce_double_slashes($this->config->item('base_url').config_item('index_page').'/cpm/'));
	}
	


	function index()
	{
		if (!$this->general->page_authentication($this->session->userdata('username'), $this->session->userdata('password')))
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			$this->parser->parse('admin/login', $data);
		}
		else
		{
			$data = $this->general->get_script('',$this->session->userdata('username'));
			$this->parser->parse('admin/atas', $data);
			$this->parser->parse('admin/index', $data);
		}
	}
	

}
?>
