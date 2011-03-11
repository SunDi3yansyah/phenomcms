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
class Pages extends Model {

	var $id;
	
	
    function Pages()
    {
        parent::Model();
		$this->load->library('session');
    }

	function get_list()
	{
		$this->load->helper('string');
		$query = $this->db->query("SELECT * FROM t_pages WHERE page_visible = '1' ORDER BY page_id");
		$result['page_list'] = $query->result_array();
		if (!empty($result['page_list'])) {
			foreach($result['page_list'] as $row=>$value) 
			{
				if ($this->session->userdata('page') == $value['page_id']) $data['page_list'][$row]['page_current'] = 'current';
				else $data['page_list'][$row]['page_current'] = '';
				$data['page_list'][$row]['page_id'] = $value['page_id'];
				$data['page_list'][$row]['page_title'] = $value['page_title'];

				if ($value['page_type'] == 'page')
				$data['page_list'][$row]['page_link'] = reduce_double_slashes(config_item('base_url').config_item('index_page').'/page/'.$value['page_id']);

				if ($value['page_type'] == 'module')
				$data['page_list'][$row]['page_link'] = reduce_double_slashes(config_item('base_url').config_item('index_page').'/'.$value['page_module'].'/'.$value['page_id']);

				if ($value['page_type'] == 'url')
				$data['page_list'][$row]['page_link'] = $value['page_url'];

				if ($value['page_type'] == 'uri')
				$data['page_list'][$row]['page_link'] = reduce_double_slashes(config_item('base_url').config_item('index_page').'/'.$value['page_uri']);

				$data['page_list'][$row]['page_target'] = $value['page_target'];

				$little_content = strip_tags(trim(substr($value['page_content'],0,200)));
				$middle_content = strip_tags(trim(substr($value['page_content'],0,1000)));
				$much_content = strip_tags(trim(substr($value['page_content'],0,2000)));

				$x = strpos(strrev($little_content)," ");
			 	$length = strlen($little_content) - $x - 1;
	 			$little_content = substr($little_content,0,$length).'...';
				$data['page_list'][$row]['page_little_content'] = $little_content;

				$x = strpos(strrev($middle_content)," ");
			 	$length = strlen($middle_content) - $x - 1;
	 			$middle_content = substr($middle_content,0,$length).'...';
				$data['page_list'][$row]['page_middle_content'] = $middle_content;

				$x = strpos(strrev($much_content)," ");
			 	$length = strlen($much_content) - $x - 1;
	 			$much_content = substr($much_content,0,$length).'...';
				$data['page_list'][$row]['page_much_content'] = $much_content;

				$data['page_list'][$row]['page_full_content'] = strip_tags(trim($value['page_content']));


				//------AMBIL IMAGE DAN THUMBNAIL---------------------
				if (file_exists("./userfiles/image/page/".$value['page_image']) & trim($value['page_image'])!='')
					$data['page_list'][$row]['page_image'] = reduce_double_slashes(config_item('base_url')."/userfiles/image/page/".$value['page_image']);
				else
					$data['page_list'][$row]['page_image'] = '';
				$x = explode(".",$value['page_image']);
				$ext = $x[count($x)-1];
				$y = explode(".".$ext,$value['page_image']);
				$thumbnail_file = $y[0]."_thumb.".$ext;
				if (file_exists("./userfiles/image/page/".$thumbnail_file) & trim($value['page_image'])!='')
					$data['page_list'][$row]['page_thumbnail'] = reduce_double_slashes(config_item('base_url')."/userfiles/image/page/".$thumbnail_file);
				else
					$data['page_list'][$row]['page_thumbnail'] = '';
				//----------------------------------------------------
			}
		}
		else {
			return (array('page_list' => array()));
		}
		return ($data);
	}

	function get_detail($id)
	{
		$this->session->set_userdata('page', $id);
		$query = $this->db->query("SELECT * FROM t_pages WHERE page_id = '$id' AND page_visible = '1'");
		$result = $query->result_array();
		if (!empty($result)) {
				$data['page_id'] = $result[0]['page_id'];
				$data['page_title'] = $result[0]['page_title'];
				$data['page_content'] = $result[0]['page_content'];

				//------AMBIL IMAGE DAN THUMBNAIL---------------------
				if (file_exists("./userfiles/image/page/".$result[0]['page_image']) & trim($result[0]['page_image'])!='')
					$data['page_image'] = reduce_double_slashes(config_item('base_url')."/userfiles/image/page/".$result[0]['page_image']);
				else
					$data['page_image'] = '';
				$x = explode(".",$result[0]['page_image']);
				$ext = $x[count($x)-1];
				$y = explode(".".$ext,$result[0]['page_image']);
				$thumbnail_file = $y[0]."_thumb.".$ext;
				if (file_exists("./userfiles/image/page/".$thumbnail_file) & trim($result[0]['page_image'])!='')
					$data['page_thumbnail'] = reduce_double_slashes(config_item('base_url')."/userfiles/image/page/".$thumbnail_file);
				else
					$data['page_thumbnail'] = '';
				//----------------------------------------------------

		}
		else {
				$data['page_id'] = '';
		}
		return ($data);
	}



}
?>