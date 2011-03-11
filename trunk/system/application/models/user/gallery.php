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
class Gallery extends Model {

	var $id;
	
	
    function Gallery()
    {
        parent::Model();
		$this->load->model('date');
    }

	function get_album_list()
	{
		$this->load->helper('string');
		$query = $this->db->query("SELECT * FROM t_album WHERE album_visible = '1' ORDER BY album_date DESC");
		$result['album_list'] = $query->result_array();
		if (!empty($result['album_list'])) {
			foreach($result['album_list'] as $row=>$value) 
			{
				$data['album_list'][$row]['album_id'] = $value['album_id'];
				$data['album_list'][$row]['album_date'] = $this->date->IndonesianDate($value['album_date']);
				$data['album_list'][$row]['album_title'] = $value['album_title'];
				$data['album_list'][$row]['album_desc'] = $value['album_desc'];
				$data['album_list'][$row]['album_thumbnail'] = $this->get_album_thumbnail($value['album_id']);
				$data['album_list'][$row]['album_url'] = reduce_double_slashes(config_item('base_url').config_item('index_page')."/album/".$value['album_id']);
			}
		}
		else {
			return (array('album_list' => array()));
		}
		return ($data);
	}

	function get_album_thumbnail($id)
	{
		$query = $this->db->query("select photo_image as thumbnail FROM t_photo,t_album where photo_album_id = album_id and album_id = '$id' and photo_thumbnail = '1'");
		$row = $query->row_array(0);
		if (!empty($row)) $thumbnail = $row['thumbnail'];
		else $thumbnail = '';
		$x = explode(".",$thumbnail);
		$ext = $x[count($x)-1];
		$y = explode(".".$ext,$thumbnail);
		$thumbnail_file = config_item('base_url')."/userfiles/image/album/".$y[0]."_thumb.".$ext;
		if (empty($thumbnail)) $thumbnail_file='';
		return ($thumbnail_file);
	}


	function get_photo_list($id)
	{

		$query = $this->db->query("SELECT * FROM t_album WHERE album_visible = '1' and album_id = '$id' ORDER BY album_date DESC");
		$result = $query->result_array();
		$data['album_title'] = $result[0]['album_title'];
		$data['album_date'] = $this->date->IndonesianDate($result[0]['album_date']);
		$data['album_desc'] = $result[0]['album_desc'];

		$query = $this->db->query("select * FROM t_photo,t_album where photo_album_id = album_id and  photo_album_id = '$id'");
		$result = $query->result_array();
		if (!empty($result)) {
			foreach($result as $row=>$value)
			{
				$data['photo'][$row]['no'] = $row+1;
				$data['photo'][$row]['photo_id'] = $value['photo_id'];
				$data['photo'][$row]['photo_album_id'] = $value['photo_album_id'];
				$data['photo'][$row]['photo_date'] = $this->date->IndonesianDate($value['photo_date']);
				if (trim($value['photo_desc'])!='') $data['photo'][$row]['photo_desc'] = $value['photo_desc'];
				else $data['photo'][$row]['photo_desc'] = '&nbsp;';

				$x = explode(".",$value['photo_image']);
				$ext = $x[count($x)-1];
				$y = explode(".".$ext,$value['photo_image']);
				$thumbnail_file = reduce_double_slashes(config_item('base_url')."/userfiles/image/album/".$y[0]."_thumb.".$ext);
				$data['photo'][$row]['photo_thumbnail'] = $thumbnail_file;
				$data['photo'][$row]['photo_image'] = reduce_double_slashes(config_item('base_url')."/userfiles/image/album/".$value['photo_image']);

			}
		}
		else {
			return array();
		}
		return ($data);
	}




}
?>