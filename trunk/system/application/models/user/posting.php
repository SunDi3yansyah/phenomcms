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
class Posting extends Model {

    function Posting()
    {
        parent::Model();
		$this->load->model('date');
		$this->load->model('pagination_model');
    }

	function get_category()
	{
		$query = $this->db->query("SELECT * FROM t_category WHERE category_type='post' AND category_visible='1' ORDER BY category_id");
		$result['kategori'] = $query->result_array();
		if (!empty($result['kategori'])) {
			foreach($result['kategori'] as $row=>$value) 
			{
				$data['category_list'][$row]['category_id'] = $value['category_id'];
				$data['category_list'][$row]['category_name'] = $value['category_name'];
				$data['category_list'][$row]['category_url'] = reduce_double_slashes(config_item('base_url').config_item('index_page').'/category/'.$value['category_id']);
			}
		}
		else {
				$data['category_list'] = array();
		}
		return ($data);
	}


	function get_newest()
	{
		// Ambil posting_id terbaru
		$query = $this->db->query("SELECT MAX(posting_id) as newest_id FROM t_posting, t_category WHERE posting_category_id = category_id AND category_type='post' AND posting_visible='1'  AND category_visible='1'");
		$result = $query->result_array();
		$newest_id = $result[0]['newest_id'];

		// Ambil jumlah komentar
		$query = $this->db->query("select count(comment_id) as jum from t_comments where comment_posting_id='$newest_id' AND comment_approval='1'");
		$row = $query->row_array(0);
		$count = $row['jum'];
		$data['new_posting_comment_count'] = $count;

		// Ambil 1 record posting terbaru
		$query = $this->db->query("SELECT * FROM t_posting WHERE posting_id = '$newest_id'");
		$result = $query->result_array();
		if (!empty($result)) {
				$data['new_posting_id'] = $result[0]['posting_id'];
				$data['new_posting_title'] = $result[0]['posting_title'];
				$data['new_posting_date'] = $this->date->IndonesianDate($result[0]['posting_date']);
				$data['new_posting_hits'] = $result[0]['posting_hits'];

				$content = strip_tags(trim(substr($result[0]['posting_content'],0,1000)));

				$little_content = strip_tags(trim(substr($result[0]['posting_content'],0,200)));
				$middle_content = strip_tags(trim(substr($result[0]['posting_content'],0,500)));
				$much_content = strip_tags(trim(substr($result[0]['posting_content'],0,1000)));

				$x = strpos(strrev($little_content)," ");
			 	$length = strlen($little_content) - $x - 1;
	 			$little_content = substr($little_content,0,$length).'...';
				$data['new_posting_little_content'] = $little_content;

				$x = strpos(strrev($middle_content)," ");
			 	$length = strlen($middle_content) - $x - 1;
	 			$middle_content = substr($middle_content,0,$length).'...';
				$data['new_posting_middle_content'] = $middle_content;

				$x = strpos(strrev($much_content)," ");
			 	$length = strlen($much_content) - $x - 1;
	 			$much_content = substr($much_content,0,$length).'...';
				$data['new_posting_much_content'] = $much_content;

				$data['new_posting_full_content'] = strip_tags(trim($result[0]['posting_content']));

				$data['new_posting_date'] = $this->date->IndonesianDate($result[0]['posting_date']);
				$data['new_posting_url'] = reduce_double_slashes(config_item('base_url').config_item('index_page').'/posting/'.$result[0]['posting_id']);
				if (file_exists("./userfiles/image/posting/".$result[0]['posting_image']) & trim($result[0]['posting_image'])!='')
					$data['new_posting_image'] = reduce_double_slashes(config_item('base_url')."/userfiles/image/posting/".$result[0]['posting_image']);
				else
					$data['new_posting_image'] = '';

				$x = explode(".",$result[0]['posting_image']);
				$ext = $x[count($x)-1];
				$y = explode(".".$ext,$result[0]['posting_image']);
				$thumbnail_file = $y[0]."_thumb.".$ext;
				if (file_exists("./userfiles/image/posting/".$thumbnail_file) & trim($result[0]['posting_image'])!='')
					$data['new_posting_thumbnail'] = reduce_double_slashes(config_item('base_url')."/userfiles/image/posting/".$thumbnail_file);
				else
					$data['new_posting_thumbnail'] = '';
		}
		else {
				$data['new_posting_id'] = '';
				$data['new_posting_title'] = '';
				$data['new_posting_content'] = '';
				$data['new_posting_date'] = '';
				$data['new_posting_image'] = '';
				$data['new_posting_comment_count'] = '';
				$data['new_posting_url'] = '';
		}
		return ($data);
	}

	function get_recents()
	{
		// Ambil 6 record posting terbaru
		$query = $this->db->query("SELECT * FROM t_posting, t_category WHERE posting_category_id = category_id AND category_type='post' AND posting_visible='1' AND category_visible='1' ORDER BY posting_date DESC LIMIT 0,5");
		$result['recent_posting'] = $query->result_array();
		if (!empty($result['recent_posting'])) {
			foreach($result['recent_posting'] as $row=>$value) 
			{
				$data['recent_posts'][$row]['posting_id'] = $value['posting_id'];
				$data['recent_posts'][$row]['posting_date'] = $this->date->IndonesianDate($value['posting_date']);
				$data['recent_posts'][$row]['posting_title'] = $value['posting_title'];
				$data['recent_posts'][$row]['posting_date'] = $this->date->IndonesianDate($value['posting_date']);
				$data['recent_posts'][$row]['posting_hits'] = $value['posting_hits'];

				$data['recent_posts'][$row]['posting_category'] = $value['category_name'];
				$data['recent_posts'][$row]['posting_category_url'] = reduce_double_slashes(config_item('base_url').config_item('index_page').'/category/'.$value['category_id']);

				$little_content = strip_tags(trim(substr($value['posting_content'],0,200)));
				$middle_content = strip_tags(trim(substr($value['posting_content'],0,500)));
				$much_content = strip_tags(trim(substr($value['posting_content'],0,1000)));

				$x = strpos(strrev($little_content)," ");
			 	$length = strlen($little_content) - $x - 1;
	 			$little_content = substr($little_content,0,$length).'...';
				$data['recent_posts'][$row]['posting_little_content'] = $little_content;

				$x = strpos(strrev($middle_content)," ");
			 	$length = strlen($middle_content) - $x - 1;
	 			$middle_content = substr($middle_content,0,$length).'...';
				$data['recent_posts'][$row]['posting_middle_content'] = $middle_content;

				$x = strpos(strrev($much_content)," ");
			 	$length = strlen($much_content) - $x - 1;
	 			$much_content = substr($much_content,0,$length).'...';
				$data['recent_posts'][$row]['posting_much_content'] = $much_content;

				$data['recent_posts'][$row]['posting_full_content'] = strip_tags(trim($value['posting_content']));

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
					$data['recent_posts'][$row]['posting_thumbnail'] = reduce_double_slashes(config_item('base_url')."/userfiles/image/posting/".$thumbnail_file);
				else
					$data['recent_posts'][$row]['posting_thumbnail'] = '';
				//----------------------------------------------------
				$data['recent_posts'][$row]['posting_url'] = reduce_double_slashes(config_item('base_url').config_item('index_page').'/posting/'.$value['posting_id']);
				// Ambil jumlah komentar
				$query = $this->db->query("select count(comment_id) as jum from t_comments where comment_posting_id='".$value['posting_id']."' AND comment_approval='1'");
				$jum = $query->row_array(0);
				$count = $jum['jum'];
				$data['recent_posts'][$row]['posting_comment_count'] = $count;
			}
		}
		else {
				$data['recent_posts']=array();
		}
		return ($data);
	}


	function get_all_menu()
	{
		$query = $this->db->query("SELECT * FROM t_category WHERE category_type = 'menu' AND category_visible='1'");
		$result =  $query->result_array();
		if (!empty($result)) {
		foreach ($result as $row=>$value)
		{
			$item=array();
			$data['menu'][$row]['menu_name'] = $value['category_name'];
			$query_item = $this->db->query("SELECT * FROM t_posting WHERE posting_category_id = ".$value['category_id']." AND posting_visible='1' ORDER BY posting_id");
			$result_item =  $query_item->result_array();
			foreach ($result_item as $baris=>$nilai) 
			{
				$item[$baris]['menu_id'] = $nilai['posting_id'];
				$item[$baris]['menu_title'] = $nilai['posting_title'];
				$item[$baris]['menu_content'] = $nilai['posting_content'];

				if ($nilai['posting_type'] == 'menu')
				$item[$baris]['menu_link'] = reduce_double_slashes(config_item('base_url').config_item('index_page').'/menu/'.$nilai['posting_id']);

				if ($nilai['posting_type'] == 'module')
				$item[$baris]['menu_link'] = reduce_double_slashes(config_item('base_url').config_item('index_page').'/'.$nilai['posting_module'].'/0');

				if ($nilai['posting_type'] == 'url')
				$item[$baris]['menu_link'] = $nilai['posting_url'];

				if ($nilai['posting_type'] == 'uri')
				$item[$baris]['menu_link'] = reduce_double_slashes(config_item('base_url').config_item('index_page').'/'.$nilai['posting_uri']);

				$item[$baris]['menu_target'] = $nilai['posting_target'];
			}
			$data['menu'][$row]['menu_data'] = $item;
		}
		}
		else $data = array();
		return ($data);
	}

	function get_recent_posts_by_all_category()
	{
		$query = $this->db->query("SELECT * FROM t_category WHERE category_type = 'post' AND category_visible='1'");
		$result =  $query->result_array();
		if (!empty($result)) {
		foreach ($result as $row=>$value)
		{
			$item=array();
			$data['posting'][$row]['posting_category'] = $value['category_name'];

			$display_item = $value['category_display_item'];
			$limit = "LIMIT 0,".$value['category_item_count'];

			$query_item = $this->db->query("SELECT * FROM t_posting WHERE posting_category_id = ".$value['category_id']." AND posting_visible='1' ORDER BY posting_date DESC $limit");
			$result_item =  $query_item->result_array();
			foreach ($result_item as $baris=>$nilai) 
			{
				$item[$baris]['posting_id'] = $nilai['posting_id'];
				$date = explode(",",$this->date->IndonesianDate($nilai['posting_date']));
				$item[$baris]['posting_date'] = $date[0];
				$item[$baris]['posting_time'] = $date[1];
				$item[$baris]['posting_title'] = $nilai['posting_title'];


				$little_content = strip_tags(trim(substr($nilai['posting_content'],0,200)));
				$middle_content = strip_tags(trim(substr($nilai['posting_content'],0,500)));
				$much_content = strip_tags(trim(substr($nilai['posting_content'],0,1000)));

				$x = strpos(strrev($little_content)," ");
			 	$length = strlen($little_content) - $x - 1;
	 			$little_content = substr($little_content,0,$length).'...';
				$item[$baris]['posting_little_content'] = $little_content;

				$x = strpos(strrev($middle_content)," ");
			 	$length = strlen($middle_content) - $x - 1;
	 			$middle_content = substr($middle_content,0,$length).'...';
				$item[$baris]['posting_middle_content'] = $middle_content;

				$x = strpos(strrev($much_content)," ");
			 	$length = strlen($much_content) - $x - 1;
	 			$much_content = substr($much_content,0,$length).'...';
				$item[$baris]['posting_much_content'] = $much_content;

				$item[$baris]['posting_full_content'] = strip_tags(trim($nilai['posting_content']));



				//------AMBIL IMAGE DAN THUMBNAIL---------------------
				if (file_exists("./userfiles/image/posting/".$nilai['posting_image']) & trim($nilai['posting_image'])!='')
					$item[$baris]['posting_image'] = reduce_double_slashes(config_item('base_url')."/userfiles/image/posting/".$nilai['posting_image']);
				else
					$item[$baris]['posting_image'] = '';
				$x = explode(".",$nilai['posting_image']);
				$ext = $x[count($x)-1];
				$y = explode(".".$ext,$nilai['posting_image']);
				$thumbnail_file = $y[0]."_thumb.".$ext;
				if (file_exists("./userfiles/image/posting/".$thumbnail_file) & trim($nilai['posting_image'])!='')
					$item[$baris]['posting_thumbnail'] = reduce_double_slashes(config_item('base_url')."/userfiles/image/posting/".$thumbnail_file);
				else
					$item[$baris]['posting_thumbnail'] = '';
				//----------------------------------------------------


				$item[$baris]['posting_url'] = reduce_double_slashes(config_item('base_url').config_item('index_page').'/posting/'.$nilai['posting_id']);

				// Ambil jumlah komentar
				$query = $this->db->query("select count(comment_id) as jum from t_comments where comment_posting_id='".$nilai['posting_id']."' AND comment_approval='1'");
				$jum = $query->row_array(0);
				$count = $jum['jum'];
				$item[$baris]['posting_comment_count'] = $count;
			}
			$data['posting'][$row]['posting_data'] = $item;
		}
		}
		else $data = array();
		return ($data);
	}

	function get_recent_posts_by_one_category($id)
	{
		$this->load->helper('url');
		$query = $this->db->query("SELECT * FROM t_category WHERE category_id = '$id' AND category_visible='1'");
		$row = $query->row_array(0);
		$label = $row['category_type']."_label_".$row['category_id'];
		$template = $row['category_type'].'_data_'.$row['category_id'];
		$type = $row['category_type'];

		if ($type=='menu') $orderby='ASC';
		else $orderby='DESC';

		$display_item = $row['category_display_item'];
		if ($display_item=='SPECIFIC') $limit = "LIMIT 0,".$row['category_item_count'];
		else $limit = '';

		$data[$label] = $row['category_name'];
		$data['archieve_url'] = reduce_double_slashes(config_item('base_url').config_item('index_page').'/category/'.$id);

		$query = $this->db->query("SELECT * FROM t_posting WHERE posting_category_id = '$id' AND posting_visible='1' ORDER BY posting_id $orderby $limit");
		$result['recent_posting'] = $query->result_array();
		if (!empty($result['recent_posting'])) {
			foreach($result['recent_posting'] as $row=>$value) 
			{
				$data[$template][$row]['posting_id'] = $value['posting_id'];
				$data[$template][$row]['posting_date'] = $this->date->IndonesianDate($value['posting_date']);
				$data[$template][$row]['posting_title'] = $value['posting_title'];
				$data[$template][$row]['posting_content'] = $value['posting_content'];
				$data[$template][$row]['posting_url'] = reduce_double_slashes(config_item('base_url').config_item('index_page').'/posting/'.$value['posting_id']);

				// Ambil jumlah komentar
				$query = $this->db->query("select count(comment_id) as jum from t_comments where comment_posting_id='".$value['posting_id']."' AND comment_approval='1'");
				$jum = $query->row_array(0);
				$count = $jum['jum'];
				$data[$template][$row]['posting_comment_count'] = $count;
			}
		}
		else {
				return array();
		}
		return ($data);
	}



	function get_all_posts_by_category($id)
	{
		$query = $this->db->query("SELECT COUNT(posting_id) as jum FROM t_posting WHERE posting_category_id = '$id' AND posting_visible='1'");
		$row = $query->row_array(0);
		$count = $row['jum'];

		// Ambil data kategori
		$query = $this->db->query("SELECT category_name AS nama FROM t_category WHERE category_id = '$id' AND category_visible='1'");
		$row = $query->row_array(0);
		if (!empty($row)>0) $nama = $row['nama'];
		else $nama='';
		$data['all_posts_by_category_name'] = $nama;

		$sql = "SELECT * FROM t_posting,t_category WHERE posting_category_id = category_id AND posting_category_id = '$id' AND posting_visible='1' AND category_visible='1' ORDER BY posting_id DESC";
		$result = $this->pagination_model->paging("/category/".$id."/",3, $sql, $count, 5, 2);
		if (!empty($result['result'])) {
		$i = 0;
		foreach ($result as $key=>$entry) {
			foreach ($entry as $row=>$value) 
			{
				$data['all_posts_by_category'][$i]['posting_id'] = $value['posting_id'];
				$data['all_posts_by_category'][$i]['posting_date'] = $this->date->IndonesianDate($value['posting_date']);
				$data['all_posts_by_category'][$i]['posting_title'] = $value['posting_title'];

				$little_content = strip_tags(trim(substr($value['posting_content'],0,200)));
				$middle_content = strip_tags(trim(substr($value['posting_content'],0,500)));
				$much_content = strip_tags(trim(substr($value['posting_content'],0,1000)));

				$x = strpos(strrev($little_content)," ");
			 	$length = strlen($little_content) - $x - 1;
	 			$little_content = substr($little_content,0,$length).'...';
				$data['all_posts_by_category'][$i]['posting_little_content'] = $little_content;

				$x = strpos(strrev($middle_content)," ");
			 	$length = strlen($middle_content) - $x - 1;
	 			$middle_content = substr($middle_content,0,$length).'...';
				$data['all_posts_by_category'][$i]['posting_middle_content'] = $middle_content;

				$x = strpos(strrev($much_content)," ");
			 	$length = strlen($much_content) - $x - 1;
	 			$much_content = substr($much_content,0,$length).'...';
				$data['all_posts_by_category'][$i]['posting_much_content'] = $much_content;

				$data['all_posts_by_category'][$i]['posting_full_content'] = strip_tags(trim($value['posting_content']));


				//------AMBIL IMAGE DAN THUMBNAIL---------------------
				if (file_exists("./userfiles/image/posting/".$value['posting_image']) & trim($value['posting_image'])!='')
					$data['all_posts_by_category'][$i]['posting_image'] = reduce_double_slashes(config_item('base_url')."/userfiles/image/posting/".$value['posting_image']);
				else
					$data['all_posts_by_category'][$i]['posting_image'] = '';
				$x = explode(".",$value['posting_image']);
				$ext = $x[count($x)-1];
				$y = explode(".".$ext,$value['posting_image']);
				$thumbnail_file = $y[0]."_thumb.".$ext;
				if (file_exists("./userfiles/image/posting/".$thumbnail_file) & trim($value['posting_image'])!='')
					$data['all_posts_by_category'][$i]['posting_thumbnail'] = reduce_double_slashes(config_item('base_url')."/userfiles/image/posting/".$thumbnail_file);
				else
					$data['all_posts_by_category'][$i]['posting_thumbnail'] = '';
				//----------------------------------------------------


				$data['all_posts_by_category'][$i]['posting_url'] = reduce_double_slashes(config_item('base_url').config_item('index_page').'/posting/'.$value['posting_id']);
				// Ambil jumlah komentar
				$query = $this->db->query("select count(comment_id) as jum from t_comments where comment_posting_id='".$value['posting_id']."' AND comment_approval='1'");
				$jum = $query->row_array(0);
				$count = $jum['jum'];
				$data['all_posts_by_category'][$i]['posting_comment_count'] = $count;
				$i++;
			}
				$data['all_posts_by_category_page_nav'] = $this->pagination->create_links();
		}
		}
		else {
				$data['all_posts_by_category'] = array();
				$data['all_posts_by_category_page_nav'] = array();
		}
		return ($data);
	}


	function get_detail($id)
	{
		$this->load->helper('smiley');
		$this->load->library('table');
		$this->load->library('session');
		$image_array = get_clickable_smileys(config_item('base_url').'/files/smileys/');
		$col_array = $this->table->make_columns($image_array, 8);

		//-------UPDATE HITS------------------------
		$query = $this->db->query("SELECT posting_hits as jum FROM t_posting WHERE posting_id = '$id' ");
		$row = $query->row_array(0);
		$hits = $row['jum'] + 1;
		$this->db->query("UPDATE t_posting set posting_hits = '$hits' WHERE posting_id = '$id'");

		$query = $this->db->query("SELECT * FROM t_posting,t_category WHERE posting_category_id = category_id AND posting_id = '$id' AND posting_visible='1'");
		$result = $query->result_array();

		$data['posting_comment_url'] = reduce_double_slashes(config_item('base_url').config_item('index_page')."/send_comment/");

		if (!empty($result)) {
				$data['posting_id'] = $result[0]['posting_id'];
				$data['posting_category_type'] = $result[0]['category_type'];
				$data['posting_date'] = $this->date->IndonesianDate($result[0]['posting_date']);
				$data['posting_title'] = $result[0]['posting_title'];
				$data['posting_content'] = $result[0]['posting_content'];
				$data['posting_hits'] = $result[0]['posting_hits'];
				$data['posting_image'] = $result[0]['posting_image'];
				$data['posting_visible'] = $result[0]['posting_visible'];
				$data['posting_comment_status'] = $result[0]['posting_comment_status'];

				if ($result[0]['category_type'] == 'menu') {
					if (file_exists("./userfiles/image/menu/".$result[0]['posting_image']) & trim($result[0]['posting_image'])!='')
						$data['posting_image'] = reduce_double_slashes(config_item('base_url')."/userfiles/image/menu/".$result[0]['posting_image']);
					else
						$data['posting_image'] = '';
				}
				else {
					if (file_exists("./userfiles/image/posting/".$result[0]['posting_image']) & trim($result[0]['posting_image'])!='')
						$data['posting_image'] = reduce_double_slashes(config_item('base_url')."/userfiles/image/posting/".$result[0]['posting_image']);
					else
						$data['posting_image'] = '';
				}

				//-------AMBIL TAGS-------------------------
				$query_tag = $this->db->query("SELECT posting_tag FROM t_posting_tag WHERE tag_posting_id = '$id'");
				$result_tag = $query_tag->result_array();
				if (!empty($result_tag))
				{
					foreach ($result_tag as $row=>$value)
					{
						$tag[] = "<a href='".reduce_double_slashes(config_item('base_url').config_item('index_page')."/tagged/".$value['posting_tag'])."'>".$value['posting_tag']."</a>";
					}
					$tags = implode(", ",$tag);
					$data['posting_tags'] = "<span class='tags'>&nbsp;".$tags."</span>";
				}
				else $data['posting_tags'] = '';

				$data['smiley_table'] = $this->table->generate($col_array);
				
				//-----verification code generator
				$this->session->set_userdata('code', rand(1,70));
				$data['verification'] = reduce_double_slashes(config_item('base_url').'/files/verification/cimg'. $this->session->userdata('code').".jpg");
		}
		else {
				$data['posting_id'] = '';
		}
		return ($data);
	}


	function get_post_comments($id,$msg='')
	{
		$this->load->helper('url');

		$query = $this->db->query("SELECT COUNT(comment_id) as jum FROM t_comments WHERE comment_posting_id = '$id' AND comment_approval='1' ");
		$row = $query->row_array(0);
		$count = $row['jum'];

		$sql = "SELECT * FROM t_comments WHERE comment_posting_id = '$id' AND comment_approval='1' ORDER BY comment_date DESC";
		$result = $this->pagination_model->paging(config_item('index_page')."/posting/".$id."/",3, $sql, $count, 10, 2);

		if ($msg=='0') $data['comment_message'] = "Your comment has been succesfully submitted but need confirmation.";
		if ($msg=='1') $data['comment_message'] = "Your comment has been succesfully submitted.";
		if ($msg=='2') $data['comment_message'] = "Failed to send comment.";
		
		if (!empty($result['result'])) {
		$i = 0;
		foreach ($result as $key=>$entry) {
			foreach ($entry as $row=>$value) 
			{
				$data['post_comments'][$i]['id'] = "<a id='".$value['comment_id']."'></a>";
				if (!empty($value['comment_url']))
					$data['post_comments'][$i]['name'] = "<a href='".$value['comment_url']."' target='_blank'>".$value['comment_name']. "</a>";
				else 
					$data['post_comments'][$i]['name'] = $value['comment_name'];
				$data['post_comments'][$i]['date'] = $this->date->IndonesianDate($value['comment_date']);
				$data['post_comments'][$i]['content'] = auto_link(parse_smileys(htmlspecialchars($value['comment_content']),config_item('base_url').'/files/smileys/'), 'both', TRUE);

				// Ambil data image avatar
				$email = $value['comment_email'];
				$default = reduce_double_slashes(config_item('base_url').'/files/images/avatar.jpg');
				$size = 40;
				$grav_url = "http://www.gravatar.com/avatar.php?gravatar_id=".md5( strtolower($email) )."&default=".urlencode($default)."&size=".$size;
				$data['post_comments'][$row]['avatar'] = "<img src='".$grav_url."' align='left' style='margin-right: 10px'>";
				$i++;
			}
		}
				$data['comments_page_nav'] = $this->pagination->create_links();
		}
		else {
				$data['post_comments'] = array();
				$data['comments_page_nav'] = '';
		}
		return ($data);
	}


	function get_recent_comments()
	{
		$this->load->helper('url');

		// Ambil 5 komentar terakhir
		$query = $this->db->query("SELECT * FROM t_comments,t_posting,t_category WHERE comment_posting_id=posting_id AND posting_category_id=category_id AND posting_visible='1' AND category_visible='1' AND comment_approval='1' ORDER BY comment_date DESC LIMIT 0,5");
		$result['recent_comment'] = $query->result_array();
		if (!empty($result['recent_comment'])) {
			foreach($result['recent_comment'] as $row=>$value) 
			{
				$data['recent_comments'][$row]['id'] = "<a id='".$value['comment_id']."'></a>";
				$data['recent_comments'][$row]['date'] = $this->date->IndonesianDate($value['comment_date']);
				$data['recent_comments'][$row]['name'] = $value['comment_name'];
				$data['recent_comments'][$row]['comment'] = $value['comment_content'];
				$data['recent_comments'][$row]['comment_url'] = reduce_double_slashes("<a href='".config_item('base_url').config_item('index_page')."/posting/".$value['posting_id']."'>".$value['posting_title']."</a>");

				// Ambil data image avatar
				$email = $value['comment_email'];
				$default = reduce_double_slashes(config_item('base_url').'/files/images/avatar.jpg');
				$size = 40;
				$grav_url = "http://www.gravatar.com/avatar.php?gravatar_id=".md5( strtolower($email) )."&default=".urlencode($default)."&size=".$size;
				$data['recent_comments'][$row]['avatar'] = "<img src='".$grav_url."' align='left' style='margin-right: 10px'>";
			}
		}
		else {
				$data['recent_comments']= array();
		}
		return ($data);
	}


}
?>