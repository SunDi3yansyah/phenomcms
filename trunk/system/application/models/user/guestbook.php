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
class Guestbook extends Model {

    function Guestbook()
    {
        parent::Model();
    }

	function get_guestbook($id='',$msg = '')
	{
		$this->load->helper('smiley');
		$this->load->library('table');
		$this->load->library('session');

		$query = $this->db->query("SELECT COUNT(gb_id) as jum FROM t_guestbook WHERE gb_approval = '1' ");
		$row = $query->row_array(0);
		$count = $row['jum'];

		$sql = "SELECT * FROM t_guestbook WHERE gb_approval = '1'  ORDER BY gb_date DESC";
		$result = $this->pagination_model->paging(config_item('index_page')."/guestbook/".$id."/",3, $sql, $count, 10, 2);

		if ($msg=='0') $data['guestbook_message'] = "Your message has been succesfully submitted but need confirmation.";
		if ($msg=='1') $data['guestbook_message'] = "Your message has been succesfully submitted.";
		if ($msg=='2') $data['guestbook_message'] = "Your message failed to submit.";

		$data['guestbook_url'] = reduce_double_slashes(config_item('base_url').config_item('index_page')."/send_guestbook/".$id);

				//-----verification code generator
				$this->session->set_userdata('code', rand(1,70));
				$data['verification'] = reduce_double_slashes(config_item('base_url').'/files/verification/cimg'. $this->session->userdata('code').".jpg");

				$image_array = get_clickable_smileys(config_item('base_url').'/files/smileys/');
				$col_array = $this->table->make_columns($image_array, 8);
				$data['smiley_table'] = $this->table->generate($col_array);

		if (!empty($result['result'])) {
		$i = 0;
		foreach ($result as $key=>$entry) {
			foreach ($entry as $row=>$value) 
			{
				$data['guestbook'][$i]['id'] = $value['gb_id'];
				$data['guestbook'][$i]['gb_date'] = $this->date->IndonesianDate($value['gb_date']);
				if (!empty($value['gb_site']))
					$data['guestbook'][$i]['gb_name'] = "<a href='".$value['gb_site']."' target='_blank'>".$value['gb_name']. "</a>";
				else 
					$data['guestbook'][$i]['gb_name'] = $value['gb_name'];
				$data['guestbook'][$i]['gb_email'] = $value['gb_email'];
				$data['guestbook'][$i]['gb_site'] = $value['gb_site'];
				$data['guestbook'][$i]['gb_email'] = $value['gb_email'];
				$data['guestbook'][$i]['gb_message'] = auto_link(parse_smileys(htmlspecialchars($value['gb_message']),config_item('base_url').'/files/smileys/'), 'both', TRUE);

				// Ambil data image avatar
				$email = $value['gb_email'];
				$default = reduce_double_slashes(config_item('base_url').'/files/images/avatar.jpg');
				$size = 40;
				$grav_url = "http://www.gravatar.com/avatar.php?gravatar_id=".md5( strtolower($email) )."&default=".urlencode($default)."&size=".$size;
				$data['guestbook'][$row]['avatar'] = "<img src='".$grav_url."' align='left' style='margin-right: 10px'>";
				$i++;
			}
		}
				$data['guestbook_page_nav'] = $this->pagination->create_links();
		}
		else {
				$data['guestbook'] = array();
				$data['guestbook_page_nav'] = '';
		}
		return ($data);
	}


	function comment_verification($data)
	{
		$query = $this->db->query("select count(verifikasi_id) as jum from t_verifikasi where verifikasi_text='".$data['verification_code']."'");
		$row = $query->row_array(0);
		$count = $row['jum'];
		if ($count<=0) return false;
		if (trim($data['gb_name'])=='' | trim($data['gb_message'])=='') return false;
		return true;
	}

	function send_guestbook($id='',$data)
	{
		$this->load->helper('url');

		$query = $this->db->query("SELECT * FROM t_application");
		$result = $query->result_array();
		if ($result[0]['app_gb_approval'] == '0') $confirm = '1';
		if ($result[0]['app_gb_approval'] == '1') $confirm = '0';

		$data['gb_date'] = date('Y-m-d H:i:s');
		if ($data['gb_site']=='http://') $data['gb_site']='';
		if ($this->comment_verification($data)) 
		{
			$this->db->query("INSERT INTO t_guestbook(gb_date, gb_name, gb_email, gb_site, gb_message, gb_approval)
							  VALUES(
							  '".$data['gb_date']."',
							  '".$this->db->escape_str($data['gb_name'])."',
							  '".$this->db->escape_str($data['gb_email'])."',
							  '".$this->db->escape_str($data['gb_site'])."',
							  '".$this->db->escape_str($data['gb_message'])."',
							  '".$confirm."'
							  );
							 ");			
		}
		else $confirm=2;
		$url = reduce_double_slashes(config_item('base_url').config_item('index_page').'/guestbook/'.$id.'/0/'.$confirm);
		return ($url);
	}


}
?>