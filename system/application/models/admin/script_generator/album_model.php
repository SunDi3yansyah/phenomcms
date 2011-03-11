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
class Album_Model extends Model {

    function Album_Model()
    {
        parent::Model();
		$this->load->database('default');
    }
	
	function get_album_list($user)
	{
		$sql = "select * FROM t_album order by album_date desc";
		$query = $this->db->query("select count(album_id) as jum FROM t_album");
		$row = $query->row_array(0);
		$count = $row['jum'];
		$data = $this->pagination_model->paging('cpm/album/',3, $sql, $count, 10, 2);
		if (!empty($data['result'])) {
		foreach ($data as $key=>$entry) {
			foreach ($entry as $row=>$value) {
				$data['album'][$row]['no'] = ($row + 1);

				//$x = explode(".",$value['album_image']);
				//$ext = $x[count($x)-1];
				//$y = explode(".".$ext,$value['album_image']);
				//$thumbnail_file = config_item('base_url')."/userfiles/image/album/".$y[0]."_thumb.".$ext;
				//$data['album'][$row]['mrc_image'] = $thumbnail_file;

				$data['album'][$row]['album_date'] = $this->general->IndonesianDate($value['album_date']);
				$data['album'][$row]['album_title'] = $value['album_title'];
				$data['album'][$row]['album_posted_by'] = $value['album_posted_by'];

				$data['album'][$row]['album_thumbnail'] = $this->get_album_thumbnail($value['album_id']);

				$data['album'][$row]['url action'] = 
				"<a href='".reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/album_form_edit/'.$value['album_id']."/")."'>
				<img src='".config_item('base_url')."/files/admin/images/edit.gif'></a>
				<a href='".reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/album_delete/'.$value['album_id']."/")."' onClick=\"return confirm('Apakah Anda yakin akan menghapus album ini?')\">
				<img src='".config_item('base_url')."/files/admin/images/delete.gif'></a>";
				
				if ($value['album_visible']=='0') $data['album'][$row]['alert'] = 'table-common-alert';
				else $data['album'][$row]['alert'] = '';

				$data['album'][$row]['album_desc'] = $value['album_desc'];

				$data['page_nav'] = $this->pagination->create_links();
			}
		}
		}
		else {
			$data = array();
		}
		$data['url insert'] = reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/album_form_insert/');
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

	function get_album_detil($user,$id)
	{
		$query = $this->db->query("select * FROM t_album where album_id = '$id'");
		$result = $query->result_array();
		if (!empty($result)) {
			$data['album_id'] = $result[0]['album_id'];
			$data['album_date'] = $this->general->IndonesianDate($result[0]['album_date']);
			$data['album_title'] = $result[0]['album_title'];
			$data['album_desc'] = $result[0]['album_desc'];
			$data['album_posted_by'] = $result[0]['album_posted_by'];
			$data['album_visible'] = $result[0]['album_visible'];
			$data['album_thumbnail'] = $this->get_album_thumbnail($result[0]['album_id']);
		}
		else {
			$data['album_id'] = '';
			$data['album_date'] = '';
			$data['album_title'] = '';
			$data['album_desc'] = '';
			$data['album_posted_by'] = '';
			$data['album_visible'] = '';
		}
		$photo = $this->get_photo_list($user,$id);
		$return_data = array_merge($data,$photo);
		return $return_data;
	}

	function get_photo_list($user,$id)
	{
		$query = $this->db->query("select * FROM t_photo,t_album where photo_album_id = album_id and  photo_album_id = '$id'");
		$result = $query->result_array();
		if (!empty($result)) {
			foreach($result as $row=>$value)
			{
				$data['photo'][$row]['no'] = $row+1;
				$data['photo'][$row]['photo_id'] = $value['photo_id'];
				$data['photo'][$row]['photo_album_id'] = $value['photo_album_id'];
				$data['photo'][$row]['photo_date'] = $this->general->IndonesianDate($value['photo_date']);
				$data['photo'][$row]['photo_desc'] = $value['photo_desc'];

				$x = explode(".",$value['photo_image']);
				$ext = $x[count($x)-1];
				$y = explode(".".$ext,$value['photo_image']);
				$thumbnail_file = config_item('base_url')."/userfiles/image/album/".$y[0]."_thumb.".$ext;
				$data['photo'][$row]['photo_image'] = $thumbnail_file;

				$data['photo'][$row]['url action'] = 
				"<a href='".reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/photo_shiftup/'.$value['album_id']."/".$value['photo_id'])."'>
				<img src='".config_item('base_url')."/files/admin/images/uparrow.png'></a>
				<a href='".reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/photo_shiftdown/'.$value['album_id']."/".$value['photo_id'])."'>
				<img src='".config_item('base_url')."/files/admin/images/downarrow.png'></a>
				<a href='".reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/photo_delete/'.$value['album_id']."/".$value['photo_id'])."' onClick=\"return confirm('Apakah Anda yakin akan menghapus foto ini?')\">
				<img src='".config_item('base_url')."/files/admin/images/delete.gif'></a>
				<a href='".reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/photo_thumbnail/'.$value['album_id']."/".$value['photo_id'])."'>
				Set as Thumbnail</a>";
			}
		}
		else {
			return array();
		}
		return ($data);
	}



	function album_insert($user, $data)
	{
		if (trim($data['album_title'])=='') return;
		$data_album = array(
							'album_date' => date("Y-m-d H:i:s"),
							'album_title' => $data['album_title'],
							'album_desc' => $data['album_desc'],
							'album_visible' =>  $data['album_visible']
						);
		$query = $this->db->insert('t_album', $data_album);
		return ($query);
	}


	function album_edit($user, $data)
	{
		$id = $data['album_id'];
		if (trim($data['album_title'])=='') return;
		$data_album = array(
							'album_id' => $data['album_id'],
							'album_title' => $data['album_title'],
							'album_desc' => $data['album_desc'],
							'album_visible' =>  $data['album_visible']
						);
		$query = $this->db->update('t_album', $data_album, array('album_id' => $id));
		return ($query);
	}


	function album_delete($user, $id)
	{
		$query = $this->db->query("select photo_image FROM t_photo,t_album where photo_album_id = album_id and  photo_album_id = '$id'");
		$result = $query->result_array();
		if (!empty($result)) {
			foreach($result as $row=>$value)
			{
				$current_image = "./userfiles/image/album/".$value['photo_image'];
				$x = explode(".",$value['photo_image']);
				$ext = $x[count($x)-1];
				$y = explode(".".$ext,$value['photo_image']);
				$current_thumbnail = "./userfiles/image/album/".$y[0]."_thumb.".$ext;
				@unlink($current_image);
				@unlink($current_thumbnail);
			}
		}
 		$query = $this->db->delete('t_album', array('album_id' => $id)); 
		return;
	}






	function photo_insert($user, $data)
	{
		if (trim($_FILES['photo_image']['name'])=='') return;
		else $image = $_FILES['photo_image']['name'];

		$query = $this->db->query("select count(photo_id) as jum FROM t_photo where photo_album_id = '".$data['photo_album_id']."'");
		$row = $query->row_array(0);
		$count = $row['jum'];
		if ($count==0) $photo_thumbnail = '1';
		else $photo_thumbnail = '0';

		$data_photo = array(
							'photo_album_id' => $data['photo_album_id'],
							'photo_date' => date('Y-m-d H:i:s'),
							'photo_image' => $image,
							'photo_desc' =>  $data['photo_desc'],
							'photo_thumbnail' =>  $photo_thumbnail
						);
		$query = $this->db->insert('t_photo', $data_photo);
		if ($query) 
		{
				$filename = "./userfiles/image/album/".$image;
				copy($_FILES['photo_image']['tmp_name'], $filename);

				$x = explode(".",$image);
				$ext = $x[count($x)-1];
				$y = explode(".".$ext,$image);
				$thumbnail_file = "./userfiles/image/album/".$y[0]."_thumb.".$ext;
				copy($_FILES['photo_image']['tmp_name'], $thumbnail_file);

				$config['image_library'] = 'gd2';
				$config['source_image'] = $filename;
				$config['maintain_ratio'] = TRUE;
				$config['width'] = 600;
				$config['height'] = 600;
				$this->load->library('image_lib',$config);
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				@chmod($filename, 0777);

				$config['image_library'] = 'gd2';
				$config['source_image'] = $thumbnail_file;
				$config['maintain_ratio'] = TRUE;
				$config['width'] = 100;
				$config['height'] = 100;
				$this->load->library('image_lib',$config);
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				@chmod($thumbnail_file, 0777);
		}
		return;
	}


	function photo_process($user, $data)
	{
		if ($data['process_update'] == 'Update')
		{
			$i = 0;
			foreach($data['photo_id'] as $value)
			{
				$this->db->update('t_photo', array('photo_desc' => $data['photo_desc'][$i]), array('photo_id' => $value));
				$i++;
			}
		}
		else
		{
			foreach($data['check_id'] as $value)
			{
				$this->photo_delete($user,$value);
			}
		}
		return;
	}


	function photo_delete($user, $id)
	{
		$query = $this->db->query("select photo_image as image FROM t_photo where photo_id = '$id'");
		$row = $query->row_array(0);
		$current_image = "./userfiles/image/album/".$row['image'];
		$x = explode(".",$row['image']);
		$ext = $x[count($x)-1];
		$y = explode(".".$ext,$row['image']);
		$current_thumbnail = "./userfiles/image/album/".$y[0]."_thumb.".$ext;
		if (file_exists($current_image)) {
			@unlink($current_image);
			@unlink($current_thumbnail);
		}
 		$query = $this->db->delete('t_photo', array('photo_id' => $id)); 
		return;
	}


	function photo_shiftup($user, $album_id, $id)
	{
		$query = $this->db->query("select * FROM t_photo where photo_album_id = '$album_id' order by photo_id");
		$result = $query->result_array();
		$i = 0;
		foreach($result as $row=>$value)
		{
			$no[$i] = $value['photo_id'];
			if ($no[$i] == $id) 
			{
				$current_id = $no[$i];
				$swap_id = $no[$i-1];
				if ($i==0) 
				{
					return;
				}
				$query = $this->db->query("update t_photo set photo_id = 0 where photo_id = $swap_id");
				$query = $this->db->query("update t_photo set photo_id = $swap_id where photo_id = $current_id");
				$query = $this->db->query("update t_photo set photo_id = $current_id where photo_id = 0");
				return;
			}
			$i++;
		}
		return;
	}


	function photo_shiftdown($user, $album_id, $id)
	{
		$query = $this->db->query("select * FROM t_photo where photo_album_id = '$album_id' order by photo_id");
		$result = $query->result_array();
		$i = 0;
		foreach($result as $row=>$value)
		{
			$no[$i] = $value['photo_id'];
			if ($no[$i] == $id) 
			{
				$current_id = $no[$i];
				$j = $i;
			}
			$i++;
		}
		if ($j==$i-1) return;
		$swap_id = $no[$j+1];
		$query = $this->db->query("update t_photo set photo_id = 0 where photo_id = $swap_id");
		$query = $this->db->query("update t_photo set photo_id = $swap_id where photo_id = $current_id");
		$query = $this->db->query("update t_photo set photo_id = $current_id where photo_id = 0");
		return;
	}

	function photo_thumbnail($user, $album_id, $id)
	{
		$this->db->query("update t_photo set photo_thumbnail = '1' where photo_id = '$id'");
		$query = $this->db->query("select photo_id FROM t_photo where photo_album_id = '$album_id' and photo_id<>'$id' order by photo_id");
		$result = $query->result_array();
		foreach($result as $row=>$value)
		{
			$this->db->query("update t_photo set photo_thumbnail = '0' where photo_id = '".$value['photo_id']."'");
		}
		return;
	}




}
?>