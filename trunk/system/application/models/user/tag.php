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
class Tag extends Model {

    function Tag()
    {
        parent::Model();
		$this->load->model('date');
		$this->load->model('pagination_model');
    }

	function get_list()
	{
		$query = $this->db->query("SELECT tag_name FROM t_tags, t_posting_tag WHERE tag_name = posting_tag GROUP BY tag_name");
		$result = $query->result_array();
		if (!empty($result)) {
			foreach($result as $row=>$value) 
			{
				$data['tags'][$row]['tag_name'] = $value['tag_name'];
				$data['tags'][$row]['tag_url'] = reduce_double_slashes(config_item('base_url').config_item('index_page').'/tagged/'.$value['tag_name']);
			}
		}
		else {
				$data['category_list'] = array();
		}
		return ($data);
	}

	function get_all_posts_by_tag($id)
	{
		$query = $this->db->query("SELECT COUNT(posting_id) as jum FROM t_posting,t_tags,t_posting_tag WHERE posting_id=tag_posting_id AND posting_tag=tag_name AND tag_name='$id' AND posting_visible='1'");
		$row = $query->row_array(0);
		$count = $row['jum'];

		// Ambil data kategori
		$query = $this->db->query("SELECT tag_name AS nama FROM t_tags WHERE tag_name = '$id' ");
		$row = $query->row_array(0);
		if (!empty($row)>0) $nama = $row['nama'];
		else $nama='';
		$data['all_posts_by_tag_name'] = $nama;

		$sql = "SELECT * FROM t_posting,t_tags,t_posting_tag WHERE posting_id=tag_posting_id AND posting_tag=tag_name AND tag_name='$id' AND posting_visible='1' ORDER BY posting_date DESC";
		$result = $this->pagination_model->paging("/tagged/".$id."/",3, $sql, $count, 5, 2);
		if (!empty($result['result'])) {
		$i = 0;
		foreach ($result as $key=>$entry) {
			foreach ($entry as $row=>$value) 
			{
				$data['all_posts_by_tag'][$i]['posting_id'] = $value['posting_id'];
				$data['all_posts_by_tag'][$i]['posting_date'] = $this->date->IndonesianDate($value['posting_date']);
				$data['all_posts_by_tag'][$i]['posting_title'] = $value['posting_title'];

				$little_content = strip_tags(trim(substr($value['posting_content'],0,200)));
				$middle_content = strip_tags(trim(substr($value['posting_content'],0,500)));
				$much_content = strip_tags(trim(substr($value['posting_content'],0,1000)));

				$x = strpos(strrev($little_content)," ");
			 	$length = strlen($little_content) - $x - 1;
	 			$little_content = substr($little_content,0,$length).'...';
				$data['all_posts_by_tag'][$row]['posting_little_content'] = $little_content;

				$x = strpos(strrev($middle_content)," ");
			 	$length = strlen($middle_content) - $x - 1;
	 			$middle_content = substr($middle_content,0,$length).'...';
				$data['all_posts_by_tag'][$row]['posting_middle_content'] = $middle_content;

				$x = strpos(strrev($much_content)," ");
			 	$length = strlen($much_content) - $x - 1;
	 			$much_content = substr($much_content,0,$length).'...';
				$data['all_posts_by_tag'][$row]['posting_much_content'] = $much_content;

				$data['all_posts_by_tag'][$row]['posting_full_content'] = strip_tags(trim($value['posting_content']));


				//------AMBIL IMAGE DAN THUMBNAIL---------------------
				if (file_exists("./userfiles/image/posting/".$value['posting_image']) & trim($value['posting_image'])!='')
					$data['recent_posts'][$row]['posting_image'] = reduce_double_slashes(config_item('base_url')."/userfiles/image/posting/".$value['posting_image']);
				else
					$data['recent_posts'][$row]['posting_image'] = '';
				$x = explode(".",$value['posting_image']);
				$ext = $x[count($x)-1];
				$y = explode(".".$ext,$value['posting_image']);
				$thumbnail_file = $y[0]."_thumb.".$ext;
				if (file_exists("./userfiles/image/posting/".$thumbnail_file) & trim($value['posting_image'])!='')
					$data['all_posts_by_tag'][$row]['posting_thumbnail'] = reduce_double_slashes(config_item('base_url')."/userfiles/image/posting/".$thumbnail_file);
				else
					$data['all_posts_by_tag'][$row]['posting_thumbnail'] = '';
				//----------------------------------------------------



				$data['all_posts_by_tag'][$i]['posting_url'] = reduce_double_slashes(config_item('base_url').config_item('index_page').'/posting/'.$value['posting_id']);
				// Ambil jumlah komentar
				$query = $this->db->query("select count(comment_id) as jum from t_comments where comment_posting_id='".$value['posting_id']."' AND comment_approval='1'");
				$jum = $query->row_array(0);
				$count = $jum['jum'];
				$data['all_posts_by_tag'][$i]['posting_comment_count'] = $count;
				$i++;
			}
				$data['all_posts_by_tag_page_nav'] = $this->pagination->create_links();
		}
		}
		else {
				$data['all_posts_by_tag'] = array();
				$data['all_posts_by_tag_page_nav'] = array();
		}
		return ($data);
	}




}
?>