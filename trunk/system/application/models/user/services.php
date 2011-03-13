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
class Services extends Model {

    function Services()
    {
        parent::Model();
		$this->load->model('date');
		$this->load->model('pagination_model');
    }

	// thuongdd
	function get_services()
	{
		$query = $this->db->query("SELECT * FROM t_services WHERE service_visible='1' ORDER BY service_id ASC LIMIT 0,5");
		$result['recent_services'] = $query->result_array();
		if (!empty($result['recent_services'])) {
			foreach($result['recent_services'] as $row=>$value) 
			{
				$data['recent_services'][$row]['service_id'] = $value['service_id'];
				$data['recent_services'][$row]['service_date'] = $this->date->IndonesianDate($value['service_date']);
				$data['recent_services'][$row]['service_title'] = $value['service_title'];
				$data['recent_services'][$row]['service_date'] = $this->date->IndonesianDate($value['service_date']);
				$data['recent_services'][$row]['service_hits'] = $value['service_hits'];

				$little_content = strip_tags(trim(substr($value['service_content'],0,200)));
				$middle_content = strip_tags(trim(substr($value['service_content'],0,500)));
				$much_content = strip_tags(trim(substr($value['service_content'],0,1000)));

				$x = strpos(strrev($little_content)," ");
			 	$length = strlen($little_content) - $x - 1;
	 			$little_content = substr($little_content,0,$length).'...';
				$data['recent_services'][$row]['service_little_content'] = $little_content;

				$x = strpos(strrev($middle_content)," ");
			 	$length = strlen($middle_content) - $x - 1;
	 			$middle_content = substr($middle_content,0,$length).'...';
				$data['recent_services'][$row]['service_middle_content'] = $middle_content;

				$x = strpos(strrev($much_content)," ");
			 	$length = strlen($much_content) - $x - 1;
	 			$much_content = substr($much_content,0,$length).'...';
				$data['recent_services'][$row]['service_much_content'] = $much_content;

				$data['recent_services'][$row]['service_full_content'] = strip_tags(trim($value['posting_content']));

				//------AMBIL IMAGE DAN THUMBNAIL---------------------
				if (file_exists("./userfiles/image/services/".$value['service_image']) & trim($value['service_image'])!='')
					$data['recent_services'][$row]['service_image'] = reduce_double_slashes(config_item('base_url')."/userfiles/image/services/".$value['service_image']);
				else
					$data['recent_services'][$row]['service_image'] = '';
				$x = explode(".",$value['service_image']);
				$ext = $x[count($x)-1];
				$y = explode(".".$ext,$value['service_image']);
				$thumbnail_file = $y[0]."_thumb.".$ext;
				if (file_exists("./userfiles/image/services/".$thumbnail_file) & trim($value['service_image'])!='')
					$data['recent_services'][$row]['service_thumbnail'] = reduce_double_slashes(config_item('base_url')."/userfiles/image/services/".$thumbnail_file);
				else
					$data['recent_services'][$row]['serviece_thumbnail'] = '';
				//----------------------------------------------------
				$data['recent_services'][$row]['service_url'] = reduce_double_slashes(config_item('base_url').config_item('index_page').'/services/'.$value['service_seo'].'/');
				// Ambil jumlah komentar
				$query = $this->db->query("select count(comment_id) as jum from t_comments where comment_posting_id='".$value['service_id']."' AND comment_approval='1'");
				$jum = $query->row_array(0);
				$count = $jum['jum'];
				$data['recent_services'][$row]['posting_comment_count'] = $count;
			}
		}
		else {
				$data['recent_services']=array();
				
		}
		return ($data);
	}
	// thuongdd end

	function get_service_detail($id)
	{
		$this->load->helper('smiley');
		$this->load->library('table');
		$this->load->library('session');
		$image_array = get_clickable_smileys(config_item('base_url').'/files/smileys/');
		$col_array = $this->table->make_columns($image_array, 8);

		//-------UPDATE HITS------------------------
		if(!is_numeric($id)){
			$query_get_id = $this->db->query("SELECT service_id  FROM t_services WHERE service_seo = '$id' ");	
			$row = $query_get_id->row_array(0);
			$id=$row['service_id'];
		}
		//print_r($query_get_id->row_array());
		//die;
		$query = $this->db->query("SELECT service_hits as jum FROM t_services WHERE service_id = '$id' ");
		$row = $query->row_array(0);
		$hits = $row['jum'] + 1;
		$this->db->query("UPDATE t_services set service_hits = '$hits' WHERE service_id = '$id'");

		$query = $this->db->query("SELECT * FROM t_services where  service_id = '$id' AND service_visible='1'");
		$result = $query->result_array();

		$data['posting_comment_url'] = reduce_double_slashes(config_item('base_url').config_item('index_page')."/send_comment/");

		if (!empty($result)) {
				$data['service_id'] = $result[0]['service_id'];
				$data['service_category_type'] = $result[0]['category_type'];
				$data['service_date'] = $this->date->IndonesianDate($result[0]['service_date']);
				$data['service_title'] = $result[0]['service_title'];
				$data['service_content'] = $result[0]['service_content'];
				$data['service_hits'] = $result[0]['service_hits'];
				$data['service_image'] = $result[0]['service_image'];
				$data['service_visible'] = $result[0]['service_visible'];
				$data['service_comment_status'] = $result[0]['service_comment_status'];
				$data['service_detail_id'] = $result[0]['service_id'];

				if ($result[0]['category_type'] == 'menu') {
					if (file_exists("./userfiles/image/menu/".$result[0]['service_image']) & trim($result[0]['service_image'])!='')
						$data['service_image'] = reduce_double_slashes(config_item('base_url')."/userfiles/image/menu/".$result[0]['service_image']);
					else
						$data['service_image'] = '';
				}
				else {
					if (file_exists("./userfiles/image/services/".$result[0]['service_image']) & trim($result[0]['service_image'])!='')
						$data['service_image'] = reduce_double_slashes(config_item('base_url')."/userfiles/image/services/".$result[0]['service_image']);
					else
						$data['service_image'] = '';
				}

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
}
?>