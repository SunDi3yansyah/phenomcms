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
class Password_Model extends Model {

    function Password_Model()
    {
        parent::Model();
		$this->load->database('default');
    }
	
//--------------------------------------PASSWORD-----------------------------------------------------------------------------
	function password_edit($user, $data)
	{
		if (empty($data['userPassword1']) | trim($data['userPassword1']) == '' | empty($data['userPassword2']) | trim($data['userPassword2']) == '') return;
		if ($data['userPassword1'] != $data['userPassword2']) return;
		$new_password['userPassword'] = md5($data['userPassword1']);
		$query = $this->db->update('t_user', $new_password, array('userName' => $user));
		return ($query);
	}

//------------------------------------------------------------------------------------------------------------------------


}
?>