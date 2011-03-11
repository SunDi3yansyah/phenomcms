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
class FeedModel extends Model {

    function FeedModel()
    {
        parent::Model();
		$this->load->model('date');
		$this->load->database('default');
		$this->load->helper('string');
    }

	function get_url()
	{
		$data['feed_img'] = reduce_double_slashes(config_item('base_url').'/files/images/icon_feed.png');
		$data['feed_url'] = reduce_double_slashes(config_item('base_url').'/feed/');
		return ($data);
	}

	function get_feed_profile()
	{
        $data['encoding'] = 'utf-8';
		$query = $this->db->query("SELECT * FROM t_application");
		$result = $query->result_array();
		$data['feed_name'] = $result[0]['app_title'];
        $data['feed_url'] = config_item('base_url').config_item('index_page');
        $data['page_description'] = $result[0]['app_slogan'];
        $data['page_language'] = 'en-ca';
        $data['rights'] = 'Copyright by '.$result[0]['app_email'];
        $data['creator_email'] = $result[0]['app_email'];
		return ($data);
	}

	function get_recent_posts()
	{
		$this->load->helper('date');
		$query = $this->db->query("SELECT * FROM t_posting, t_category WHERE posting_category_id = category_id AND category_type='post' ORDER BY posting_date DESC LIMIT 0,10");
		$result['RecentPosts'] = $query->result_array();
		foreach($result['RecentPosts'] as $row=>$value) {
			$result['RecentPosts'][$row]['posting_date'] = xml_convert($this->date->StandardDate($value['posting_date'])." "."+0700");
			$result['RecentPosts'][$row]['posting_title'] = xml_convert($value['posting_title']);
			$result['RecentPosts'][$row]['posting_url'] = reduce_double_slashes(config_item('base_url').config_item('index_page').'/posting/'.$value['posting_id']."/");
			$content = substr(strip_tags(trim($value['posting_content'])),0,800);
			$x = strpos(strrev($content)," ");
		 	$length = strlen($content) - $x - 1;
 			$content = substr($content,0,$length);
			$result['RecentPosts'][$row]['posting_content'] = $content.' [...]';
		}
        return $result;
	}  




}
?>