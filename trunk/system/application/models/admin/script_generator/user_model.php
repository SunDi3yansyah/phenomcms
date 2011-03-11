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
class User_Model extends Model {

    function User_Model()
    {
        parent::Model();
		$this->load->database('default');
    }
	
	function get_user_list($user)
	{
		$query = $this->db->query("select * from t_user where userType='2'");
		$result['sr'] = $query->result_array();
		if (!empty($result['sr'])) {
		foreach($result['sr'] as $row=>$value) 
		{
			$data['user_list'][$row]['no'] = ($row+1).'.';
			$data['user_list'][$row]['userName'] = strip_tags($value['userName']);
			$data['user_list'][$row]['userCompleteName'] = $value['userCompleteName'];
			$data['user_list'][$row]['userEmail'] = strip_tags($value['userEmail']);
			$data['user_list'][$row]['url action'] = 
			"<a href='".reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/user_form_edit/'.$value['user_id']."/")."'>
			<img src='".config_item('base_url')."/files/admin/images/edit.gif'></a>
			<a href='".reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/user_delete/'.$value['user_id']."/")."' onClick=\"return confirm('Apakah Anda yakin akan menghapus user ini?')\">
			<img src='".config_item('base_url')."/files/admin/images/delete.gif'></a>";
		}
		}
		else {
			$data =  array();
		}
			$data['url insert'] = reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/user_form_insert/');
		return ($data);
	}

	function get_user_detil($user,$id)
	{
		$query = $this->db->query("select * FROM t_user where user_id = '$id'");
		$result['sr'] = $query->result_array();
		if (!empty($result['sr'])) {
			$data['user_id'] = $result['sr'][0]['user_id'];
			$data['userCompleteName'] = $result['sr'][0]['userCompleteName'];
			$data['userEmail'] = $result['sr'][0]['userEmail'];
			$data['userName'] = $result['sr'][0]['userName'];
			$data['userPassword'] = $result['sr'][0]['userPassword'];
			return ($data);
		}
		else {
			$data = array();
		}
		return ($data);
	}

	function user_insert($user, $data)
	{
		if (trim($data['userCompleteName'])=='' | trim($data['userName'])=='') return;
		$data_sr = array(
							'userCompleteName' => $data['userCompleteName'],
							'userEmail' => $data['userEmail'],
							'userName' => $data['userName'],
							'userPassword' => md5(trim($data['userPassword']))
						);
		$query = $this->db->insert('t_user', $data_sr);
		return ($query);
	}

	function user_edit($user, $data)
	{
		if (trim($data['userCompleteName'])=='' | trim($data['userName'])=='') return;
		$id = $data['user_id'];
		$query = $this->db->query("select userPassword as current_password FROM t_user where user_id = '$id' ");
		$row = $query->row_array(0);
		$current_password = $row['current_password'];
		if (trim($data['userPassword'])=='') $password = $current_password;
		else $password = md5(trim($data['userPassword']));
		$data_sr = array(
							'userCompleteName' => $data['userCompleteName'],
							'userEmail' => $data['userEmail'],
							'userName' => $data['userName'],
							'userPassword' => $password
						);
		$query = $this->db->update('t_user', $data_sr, array('user_id' => $id));
		return ($query);
	}

	function user_delete($user, $id)
	{
 		$query = $this->db->delete('t_user', array('user_id' => $id)); 
		return;
	}


//------------------------------------------------------------------------------------------------------------------------



}
?>