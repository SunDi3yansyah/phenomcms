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
class main_data extends Model {

    function main_data()
    {
        parent::Model();
		$this->load->database('default');
		$this->load->model('user/pages');
		$this->load->model('user/posting');
		$this->load->model('user/services');
		$this->load->model('user/tag');
		$this->load->model('user/panel');
		$this->load->model('user/search');
		$this->load->model('user/feedmodel');
		$this->load->model('user/gallery');
		$this->load->model('user/polling');
		$this->load->model('user/guestbook');
    }


	function get_url()
	{
		$data['base_url'] = config_item('base_url').config_item('index_page');
		$data['gallery_url'] = reduce_double_slashes(config_item('base_url').config_item('index_page').'/gallery/');
		$data['guestbook_url'] = reduce_double_slashes(config_item('base_url').config_item('index_page').'/guestbook/');
		$data['services_url'] = reduce_double_slashes(config_item('base_url').config_item('index_page').'/services/');
		return $data;
	}

	function get_app($title='')
	{
		$query = $this->db->query("SELECT * FROM t_application");
		$result = $query->result_array();
		if (!empty($result)) {
				if (trim($title)!='') $title = $title." | ";
				else $title = "Home | ";
				$data['app_version'] = '1.0.1';
				$data['app_title'] = $title.$result[0]['app_title'];
				$data['app_sitename'] = $result[0]['app_title'];
				$data['app_slogan'] = $result[0]['app_slogan'];
				$data['app_author'] = $result[0]['app_author'];
				$data['app_footer'] = $result[0]['app_footer'];

				$data['app_use_loginform'] = $result[0]['app_use_loginform'];
				$data['app_use_tagscloud'] = $result[0]['app_use_tagscloud'];
				$data['app_use_polling'] = $result[0]['app_use_polling'];

				$data_keywords = $this->tag->get_list();
				if (!empty($data_keywords['tags']))
				{
					foreach($data_keywords['tags'] as $row=>$value) $keywords[] = $value['tag_name'];
					$data['app_keywords'] = implode(", ",$keywords);
				}
				else $data['app_keywords'] = array();

				$data['app_email'] = $result[0]['app_email'];
				$data['app_theme'] = $result[0]['app_theme'];
				$data['app_gb_approval'] = $result[0]['app_gb_approval'];
				$data['app_comment_approval'] = $result[0]['app_comment_approval'];
		}
		else {
				return array();
		}
		return ($data);
	}

	function get_theme()
	{
		$query = $this->db->query("SELECT * FROM t_application");
		$result = $query->result_array();
		$data['theme'] = $result[0]['app_theme'];
		$data['theme_url'] = reduce_double_slashes(config_item('base_url').'/system/application/views/themes/'.$result[0]['app_theme']);
		return ($data);
	}

	function get_data($act, $id='', $msg='')
	{
		
		$title = '';
		
		if ($act!='album') $this->session->set_userdata('page', '');

		if ($act=='index') {
			$home_current = array('home_current'=>'current');
		}
		else $home_current = array('home_current'=>'');

		// Ambil semua data
		$theme = $this->get_theme();
		$kategori = $this->posting->get_category();
		$recent_posting = $this->posting->get_recents();
		$recent_services=$this->services->get_services();
//		echo "<pre>"; print_r($recent_services); echo "</pre>";
		$menu = $this->posting->get_all_menu();

		$recent_posts_by_all_category = $this->posting->get_recent_posts_by_all_category();
		
		// Ambil data panel posting berdasarkan kategori
		$query = $this->db->query("SELECT category_id FROM t_category WHERE category_visible='0'");
		$result = $query->result_array();
		$recent_posts_by_one_category=array();
		foreach ($result as $row=>$value)
		{
			$recent_posts_by_one_category = array_merge($recent_posts_by_one_category,$this->posting->get_recent_posts_by_one_category($value['category_id']));
		}

		$newest_posting = $this->posting->get_newest();
		$recent_comments = $this->posting->get_recent_comments();
		$panel = $this->panel->get_panel();
		$base_url = $this->get_url();
		$search_url = $this->search->get_search_param();
		$feed_url = $this->feedmodel->get_url();
		$gallery = $this->gallery->get_album_list();
		$polling = $this->polling->get_polling();
		$tag_list = $this->tag->get_list();

		if ($act=='gallery' | $act=='album') 
		{
			if ($act=='gallery') $title = 'Gallery';
			if ($act=='album') $title = 'Album';
			if ($act=='gallery') $this->session->set_userdata('page', $id);
			if ($act=='album') $photo_list = $this->gallery->get_photo_list($id);
			else $photo_list = array();
			//$gallery_current = array('gallery_current'=>'current');
			//$this->session->set_userdata('page', '');
		}
		else {
			$gallery = array();
			$photo_list = array();
			//$gallery_current = array('gallery_current'=>'');
		}

		if ($act=='polling') 
		{
			$title = 'Polling';
			$this->session->set_userdata('page', $id);
			$polling_result = $this->polling->get_result();
		}
		else $polling_result = array();

		if ($act=='guestbook') 
		{
			
			$title = 'Guestbook';
			$this->session->set_userdata('page', $id);
			$guestbook = $this->guestbook->get_guestbook($id, $msg);
			//$guestbook_current = array('guestbook_current'=>'current');
			//$this->session->set_userdata('page', '');
		}else {
			$guestbook = array();
			//$guestbook_current = array('guestbook_current'=>'');
		}
		if ($act=='services') {
			$this->session->set_userdata('page', 3);
			$service_detail = $this->services->get_service_detail($id);			
			$title = $service_detail['service_title'];
		}else{
			
			$service_detail = array();
		}
		
		if ($act=='page') 
		{
			$page = $this->pages->get_detail($id);
			$title = $page['page_title'];
		}
		else $page = array();
		
		$page_list = $this->pages->get_list();

		if ($act=='posting') {
			$posting = $this->posting->get_detail($id);
			$comment_list = $this->posting->get_post_comments($id,$msg);
			$title = $posting['posting_title'];
		}
		else {
			$posting = array();
			$comment_list = array();
		}

		if ($act=='all_posts_by_category') {
			$posting_by_category = $this->posting->get_all_posts_by_category($id);
			$title = $posting_by_category['all_posts_by_category_name'];
		}
		else {
			$posting_by_category = array();
		}

		if ($act=='all_posts_by_tag') {
			$posting_by_tag = $this->tag->get_all_posts_by_tag($id);
			$title = $posting_by_tag['all_posts_by_tag_name'];
		}
		else {
			$posting_by_tag = array();
		}

		if ($act=='search') {
			$search = $this->search->get_items($_POST);
			$title = 'Search';
		}
		else {
			$search = array();
		}

		$app_title = $this->get_app($title);
		//echo "<pre>";print_r($page_list);echo "</pre>";
		
		
		
		// Gabungkan semua data dalam sebuah array
		$return_value = array_merge($theme,
									$home_current,
									$page_list,
									$recent_posting,
									$recent_services,
									$recent_posts_by_all_category,
									$recent_posts_by_one_category,
									$newest_posting,
									$recent_comments,
									$panel,
									$page,
									$menu,
									$tag_list,
									$kategori,
									$posting,
									$posting_by_category,
									$posting_by_tag,
									$search,
									$comment_list,
									$base_url,
									$search_url,
									$feed_url,
									$gallery,
									$photo_list,
									$polling,
									$polling_result,
									$guestbook,
									$app_title,
								//	$service_list,
									$service_detail
									);
		//print_r($return_value);
		//exit;
		return ($return_value);
	}


	function comment_verification($data)
	{
		$query = $this->db->query("select count(verifikasi_id) as jum from t_verifikasi where verifikasi_text='".$data['verification_code']."'");
		$row = $query->row_array(0);
		$count = $row['jum'];
		if ($count<=0) return false;
		if (trim($data['comment_name'])=='' | trim($data['comment_content'])=='') return false;
		return true;
	}

	function insert_comment_process($data)
	{
		$this->load->helper('url');

		$app_comment = $this->get_app();
		if ($app_comment['app_comment_approval'] == '0') $confirm = '1';
		if ($app_comment['app_comment_approval'] == '1') $confirm = '0';
		$data['comment_date'] = date('Y-m-d H:i:s');
		if ($data['comment_url']=='http://') $data['comment_url']='';
		if ($this->comment_verification($data)) 
		{
			$this->db->query("INSERT INTO t_comments(comment_posting_id, comment_date, comment_name, comment_email, comment_url, comment_content, comment_approval)
							  VALUES(
							  '".$data['comment_posting_id']."',
							  '".$data['comment_date']."',
							  '".$this->db->escape_str($data['comment_name'])."',
							  '".$this->db->escape_str($data['comment_email'])."',
							  '".$this->db->escape_str($data['comment_url'])."',
							  '".$this->db->escape_str($data['comment_content'])."',
							  '".$confirm."'
							  );
							 ");			
		}
		else $confirm = 2;
		$url = reduce_double_slashes(config_item('base_url').config_item('index_page').'/posting/'.$data['comment_posting_id']."/0/".$confirm."#comment_list");
		return ($url);
	}


}
?>