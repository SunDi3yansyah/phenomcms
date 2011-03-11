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
class Polling extends Model {

    function Polling()
    {
        parent::Model();
    }

	function get_polling()
	{
		$this->load->library('session');
		$query = $this->db->query("SELECT * FROM t_polling, t_polling_pil WHERE polling_id = polling_pil_polling_id AND polling_activate = '1'");
		$result = $query->result_array();
		if (empty($result)) return (array('polling_topic' => array()));
		$data['polling_topic'] = $result[0]['polling_topic'];
		$data['polling_url'] = reduce_double_slashes(config_item('base_url').config_item('index_page').'/main/send_polling');
		if ($this->session->userdata('polling')=='1') {
			$data['polling_disabled'] = 'disabled';
			$data['polling_hidden'] = 'hidden';
			}
		else {
			$data['polling_disabled'] = '';
			$data['polling_hidden'] = '';
		}
		if (!empty($result)) {
			$i = true;
			foreach($result as $row=>$value) 
			{
				$data['polling_selection'][$row]['id'] = $value['polling_pil_id'];
				$data['polling_selection'][$row]['name'] = $value['polling_pil_name'];
				if ($i & $this->session->userdata('polling')!='1') $data['polling_selection'][$row]['checked'] = 'checked';
				else $data['polling_selection'][$row]['checked'] = '';
				$i = false;
			}
		}
		else {
			return array();
		}
		return ($data);
	}

	function get_result()
	{
		$query = $this->db->query("SELECT * FROM t_polling, t_polling_pil WHERE polling_id = polling_pil_polling_id AND polling_activate = '1'");
		$result = $query->result_array();
		if (empty($result)) return (array('polling_topic' => array()));
		$data['polling_result_topic'] = $result[0]['polling_topic'];
		if (!empty($result)) {
			foreach($result as $row=>$value) 
			{
				$data['polling_selection_result'][$row]['id'] = $value['polling_pil_id'];
				$data['polling_selection_result'][$row]['name'] = str_replace(' ','&nbsp;',$value['polling_pil_name']);
				$data['polling_selection_result'][$row]['hits'] = $value['polling_pil_hits'];
			}
		}
		else {
			return array();
		}
		return ($data);
	}


	function send_polling($data)
	{
		$this->load->library('session');
		$this->load->helper('url');

		$url = reduce_double_slashes(config_item('base_url').config_item('index_page').'/polling/');
		
		if ($this->session->userdata('polling')=='1' | $data['submit']=='Result') return ($url);
		$query = $this->db->query("SELECT * FROM t_polling_pil WHERE polling_pil_id = '".$data['pil']."'");
		$row = $query->row_array(0);
		$hits = $row['polling_pil_hits'] + 1;

		$this->db->query("UPDATE t_polling_pil SET polling_pil_hits = '".$hits."' WHERE polling_pil_id = '".$data['pil']."'");			
		$this->session->set_userdata('polling', '1');
		return ($url);
	}




}
?>