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
class Main extends Controller {

	function Main()
	{
		parent::Controller();	
		$this->load->library('parser');
		$this->load->model('user/main_data');
		$this->load->model('user/polling');
	}
	
	function index()
	{
		$main_data = $this->main_data->get_data('index');
		$this->parser->parse('themes/'.$main_data['theme'].'/index',$main_data);
	}

	function page($id)
	{
		$main_data = $this->main_data->get_data('page',$id);
		if ($main_data['page_id']) $this->parser->parse('themes/'.$main_data['theme'].'/page',$main_data);
		else header("location: ".config_item('base_url'));
	}

	function posting($id, $page='',$msg='')
	{
		$main_data = $this->main_data->get_data('posting',$id,$msg);
		if ($main_data['posting_id']) $this->parser->parse('themes/'.$main_data['theme'].'/posting',$main_data);
		else header("location: ".config_item('base_url'));
	}

	function category($id)
	{
		$main_data = $this->main_data->get_data('all_posts_by_category',$id);
		if ($main_data['all_posts_by_category']) $this->parser->parse('themes/'.$main_data['theme'].'/category',$main_data);
		else header("location: ".config_item('base_url'));
	}

	function tag($tag)
	{
		$main_data = $this->main_data->get_data('all_posts_by_tag',$tag);
		if ($main_data['all_posts_by_tag']) $this->parser->parse('themes/'.$main_data['theme'].'/tag',$main_data);
		else header("location: ".config_item('base_url'));
	}

	function search()	
	{
		$main_data = $this->main_data->get_data('search',$_POST);
		$this->parser->parse('themes/'.$main_data['theme'].'/search',$main_data);
	}


	function album($id)
	{
		$main_data = $this->main_data->get_data('album',$id);
		$this->parser->parse('themes/'.$main_data['theme'].'/album',$main_data);
	}

	function gallery($id = '')
	{
		$main_data = $this->main_data->get_data('gallery',$id);
		$this->parser->parse('themes/'.$main_data['theme'].'/gallery',$main_data);
	}

	function polling($id = '')
	{
		$main_data = $this->main_data->get_data('polling',$id);
		if ($main_data['polling_topic']) $this->parser->parse('themes/'.$main_data['theme'].'/polling',$main_data);
		else header("location: ".config_item('base_url'));
	}

	function guestbook($page_id,$page,$msg='')
	{
		$main_data = $this->main_data->get_data('guestbook',$page_id, $msg);
		$this->parser->parse('themes/'.$main_data['theme'].'/guestbook',$main_data);
	}

	function insert_comment()
	{
		$url = $this->main_data->insert_comment_process($_POST);
		header("location: ".$url);
	}

	function send_polling()
	{
		$url = $this->polling->send_polling($_POST);
		header("location: ".$url);
	}

	function send_guestbook($id)
	{
		$url = $this->guestbook->send_guestbook($id,$_POST);
		header("location: ".$url);
	}


}

?>