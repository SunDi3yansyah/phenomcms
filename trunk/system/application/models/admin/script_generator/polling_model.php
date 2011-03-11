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
class Polling_Model extends Model {

    function Polling_Model()
    {
        parent::Model();
		$this->load->database('default');
    }
	
//--------------------------------------POLLING-----------------------------------------------------------------------------
	function get_polling_list($user)
	{
		$sql = "select * FROM t_polling order by polling_date desc";
		$query = $this->db->query("select count(polling_id) as jum from t_polling");
		$row = $query->row_array(0);
		$count = $row['jum'];
		$data = $this->pagination_model->paging('cpm/polling/',3, $sql, $count, 10, 2);
		if (!empty($data['result'])) {
		foreach ($data as $key=>$entry) {
			foreach ($entry as $row=>$value) {
				$data['multiple record last posted list index'][$row]['no'] = ($row + 1);
				$data['multiple record last posted list index'][$row]['polling_date'] = $this->general->IndonesianDate($value['polling_date']);
				$data['multiple record last posted list index'][$row]['polling_topic'] = $value['polling_topic'];
				$data['multiple record last posted list index'][$row]['polling_activate'] = $value['polling_activate'];

				if ($value['polling_activate'] == '0')
				$activate = "<a href='".config_item('base_url').config_item('index_page').'/cpm/polling_activate/'.$value['polling_id']."/"."'>Activate</a>";
				else $activate = '';
				
				$data['multiple record last posted list index'][$row]['url action'] = 
				$activate.
				"<a href='".reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/polling_form_edit/'.$value['polling_id']."/")."'>
				<img src='".config_item('base_url')."/files/admin/images/edit.gif'></a>
				<a href='".reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/polling_delete/'.$value['polling_id']."/")."' onClick=\"return confirm('Apakah Anda yakin akan menghapus polling ini?')\">
				<img src='".config_item('base_url')."/files/admin/images/delete.gif'></a>";
				
				if ($value['polling_activate']=='0') $data['multiple record last posted list index'][$row]['alert'] = 'table-common-alert';
				else $data['multiple record last posted list index'][$row]['alert'] = '';

			}
		}
				$data['page_nav'] = $this->pagination->create_links();
		}
		else {
				$data['multiple record last posted list index'][0]['no'] = '...';
				$data['multiple record last posted list index'][0]['url action'] = '...';
				$data['multiple record last posted list index'][0]['polling_topic'] = '...';
				$data['page_nav'] = '';
		}
		$data['url insert'] = reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/polling_form_insert/');
		return ($data);
	}

	function get_polling_detil($user,$id)
	{
		$query = $this->db->query("select * FROM t_polling where polling_id = '$id'");
		$result = $query->result_array();
		if (!empty($result)) {
			$data['polling_id'] = $result[0]['polling_id'];
			$data['polling_date'] = $this->general->IndonesianDate($result[0]['polling_date']);
			$data['polling_topic'] = $result[0]['polling_topic'];
			$data['polling_activate'] = $result[0]['polling_activate'];
		}
		else {
			$data['polling_id'] = '';
			$data['polling_date'] = '';
			$data['polling_topic'] = '';
			$data['polling_activate'] = '';
		}
		$pil = $this->get_pil_list($user,$id);
		$return_data = array_merge($data,$pil);
		return $return_data;
	}


	function get_pil_list($user,$id)
	{
		$query = $this->db->query("select * FROM t_polling_pil,t_polling where polling_pil_polling_id = polling_id and polling_pil_polling_id = '$id'");
		$result = $query->result_array();
		if (!empty($result)) {
			foreach($result as $row=>$value)
			{
				$data['pil'][$row]['no'] = $row+1;
				$data['pil'][$row]['polling_pil_id'] = $value['polling_pil_id'];
				$data['pil'][$row]['polling_pil_polling_id'] = $value['polling_pil_polling_id'];
				$data['pil'][$row]['polling_pil_name'] = $value['polling_pil_name'];
				$data['pil'][$row]['polling_pil_hits'] = $value['polling_pil_hits'];

				$data['pil'][$row]['url action'] = 
				"<a href='".reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/polling_pil_shiftup/'.$value['polling_id']."/".$value['polling_pil_id'])."'>
				<img src='".config_item('base_url')."/files/admin/images/uparrow.png'></a>
				<a href='".reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/polling_pil_shiftdown/'.$value['polling_id']."/".$value['polling_pil_id'])."'>
				<img src='".config_item('base_url')."/files/admin/images/downarrow.png'></a>
				<a href='".reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/polling_pil_delete/'.$value['polling_id']."/".$value['polling_pil_id'])."' onClick=\"return confirm('Apakah Anda yakin akan menghapus pilihan ini?')\">
				<img src='".config_item('base_url')."/files/admin/images/delete.gif'></a>";
			}
		}
		else {
			return array();
		}
		return ($data);
	}


	function polling_insert($user, $data)
	{
		if (trim($data['polling_topic'])=='') return;
		$data_polling = array(
							'polling_date' => date("Y-m-d H:i:s"),
							'polling_topic' => $data['polling_topic']
						);
		$query = $this->db->insert('t_polling', $data_polling);
		return ($query);
	}

	function polling_edit($user, $data)
	{
		$id = $data['polling_id'];
		if (trim($data['polling_topic'])=='') return;
		$data_album = array(
							'polling_topic' => $data['polling_topic']
						);
		$query = $this->db->update('t_polling', $data_album, array('polling_id' => $id));
		return ($query);
	}

	function polling_delete($user, $id)
	{
 		$query = $this->db->delete('t_polling', array('polling_id' => $id)); 
		return;
	}

	function polling_activate($user, $id)
	{
		$this->db->update('t_polling', array('polling_activate' => '1'), array('polling_id' => $id));
		$this->db->query("UPDATE t_polling SET polling_activate = '0' WHERE polling_id <> '$id'");
		return;
	}


	function polling_pil_process($user, $data)
	{
		if ($data['process_update'] == 'Update')
		{
			$i = 0;
			foreach($data['polling_pil_id'] as $value)
			{
				$this->db->update('t_polling_pil', array('polling_pil_hits' => $data['polling_pil_hits'][$i]), array('polling_pil_id' => $value));
				$i++;
			}
		}
		else
		{
			foreach($data['check_id'] as $value)
			{
				$this->polling_pil_delete($user,$value);
			}
		}
		return;
	}

	function polling_pil_delete($user, $id)
	{
 		$query = $this->db->delete('t_polling_pil', array('polling_pil_id' => $id)); 
		return;
	}


	function polling_pil_insert($user, $data)
	{
		if (trim($data['polling_pil_name']) == '') return;

		$data_polling_pil = array(
							'polling_pil_polling_id' => $data['polling_pil_polling_id'],
							'polling_pil_name' =>  $data['polling_pil_name'],
							'polling_pil_hits' =>  $data['polling_pil_hits']
						);
		$query = $this->db->insert('t_polling_pil', $data_polling_pil);
		return;
	}


	function polling_pil_shiftup($user, $polling_id, $id)
	{
		$query = $this->db->query("select * FROM t_polling_pil where polling_pil_polling_id = '$polling_id' order by polling_pil_id");
		$result = $query->result_array();
		$i = 0;
		foreach($result as $row=>$value)
		{
			$no[$i] = $value['polling_pil_id'];
			if ($no[$i] == $id) 
			{
				$current_id = $no[$i];
				$swap_id = $no[$i-1];
				if ($i==0) 
				{
					return;
				}
				$query = $this->db->query("update t_polling_pil set polling_pil_id = 0 where polling_pil_id = $swap_id");
				$query = $this->db->query("update t_polling_pil set polling_pil_id = $swap_id where polling_pil_id = $current_id");
				$query = $this->db->query("update t_polling_pil set polling_pil_id = $current_id where polling_pil_id = 0");
				return;
			}
			$i++;
		}
		return;
	}

	function polling_pil_shiftdown($user, $polling_id, $id)
	{
		$query = $this->db->query("select * FROM t_polling_pil where polling_pil_polling_id = '$polling_id' order by polling_pil_id");
		$result = $query->result_array();
		$i = 0;
		foreach($result as $row=>$value)
		{
			$no[$i] = $value['polling_pil_id'];
			if ($no[$i] == $id) 
			{
				$current_id = $no[$i];
				$j = $i;
			}
			$i++;
		}
		if ($j==$i-1) return;
		$swap_id = $no[$j+1];
		$query = $this->db->query("update t_polling_pil set polling_pil_id = 0 where polling_pil_id = $swap_id");
		$query = $this->db->query("update t_polling_pil set polling_pil_id = $swap_id where polling_pil_id = $current_id");
		$query = $this->db->query("update t_polling_pil set polling_pil_id = $current_id where polling_pil_id = 0");
		return;
	}
//----------------------------------------------------------------------------------------------------------------------------------



}
?>