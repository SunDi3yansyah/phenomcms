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
class General extends Model {

    function General()
    {
        parent::Model();
		$this->load->model('pagination_model');
		$this->load->model('admin/script_generator/album_model');
		$this->load->model('admin/script_generator/polling_model');
		$this->load->model('admin/script_generator/user_model');
		$this->load->model('admin/script_generator/password_model');
		$this->load->library('session');
		$this->load->library('parser');
    }

	function IndonesianDay($day)
	{
		switch($day) {
			case 'Sun': $hari = 'Minggu';break;
			case 'Mon': $hari = 'Senin';break;
			case 'Tue': $hari = 'Selasa';break;
			case 'Wed': $hari = 'Rabu';break;
			case 'Thu': $hari = 'Kamis';break;
			case 'Fri': $hari = 'Jumat';break;
			case 'Sat': $hari = 'Sabtu';break;
			case 'Sunday': $hari = 'Minggu';break;
			case 'Monday': $hari = 'Senin';break;
			case 'Tuesday': $hari = 'Selasa';break;
			case 'Wednesday': $hari = 'Rabu';break;
			case 'Thursday': $hari = 'Kamis';break;
			case 'Friday': $hari = 'Jumat';break;
			case 'Saturday': $hari = 'Sabtu';break;
		}
		return $hari;
	}

	function IndonesianDate($date)
	{
		$month = substr($date,5,2)+'toint';
		switch($month){
		case  1: $month ='Januari';  break;
		case  2: $month ='Februari'; break;
		case  3: $month ='Maret';	 break;
		case  4: $month ='April'; 	 break;
		case  5: $month ='Mei'; 	 break;
		case  6: $month ='Juni'; 	 break;
		case  7: $month ='Juli'; 	 break;
		case  8: $month ='Agustus';  break;
		case  9: $month ='September';break;
		case 10: $month ='Oktober';  break;
		case 11: $month ='November'; break;
		case 12: $month ='Desember'; break;
		} // switch
		return substr($date,8,2).' '.$month.' '.substr($date,0,4);
	}

	function load_db($user)
	{
		$this->load->database('default');
	}

	function login_authentication($user,$pass)
	{
		$db_auth = $this->load->database('default',true);
		$query = $db_auth->query("SELECT * FROM t_user WHERE userName = '".$this->db->escape_str($user)."' AND userPassword = '$pass' ");
		if ($query->num_rows()>0) {
			$sessionArray = array('username' => $user,
								  'password' => $pass,
								  );
			$this->session->set_userdata($sessionArray);
			return true;
		}
		return false;
	}

	function page_authentication($user,$pass)
	{
		$db_auth = $this->load->database('default',true);
		$query = $db_auth->query("SELECT * FROM t_user WHERE userName = '$user' AND userPassword = '$pass' ");
		if ($query->num_rows()>0) {
			return true;
		}
		return false;
	}


//--------------------------------------PANEL-----------------------------------------------------------------------------
	function get_panel_list($user)
	{
		$this->load_db($user);
		$query = $this->db->query("select * from t_panel order by panel_id");
		$result['sr'] = $query->result_array();
		if (!empty($result['sr'])) {
		foreach($result['sr'] as $row=>$value) 
		{
			$data['panel_list'][$row]['no'] = ($row+1).'.';
			$data['panel_list'][$row]['panel_name'] = $value['panel_name'];
			$data['panel_list'][$row]['panel_label'] = strip_tags($value['panel_label']);

			if ($value['panel_visible']=='0') $data['panel_list'][$row]['alert'] = 'table-common-alert';
			else $data['panel_list'][$row]['alert'] = '';

			$data['panel_list'][$row]['url action'] = 
			"<a href='".reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/panel_form_edit/'.$value['panel_id']."/")."'>
			<img src='".config_item('base_url')."/files/admin/images/edit.gif'></a>";
		}
		}
		else {
			$data['panel_list'][0]['no'] = '';
			$data['panel_list'][0]['panel_name'] = '';
			$data['panel_list'][0]['panel_label'] = '';
			$data['panel_list'][0]['url action'] = '';
		}
			$data['url insert'] = reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/panel_form_insert/');
		return ($data);
	}

	function get_panel_detil($user,$id)
	{
		$this->load_db($user);
		$query = $this->db->query("select * FROM t_panel where panel_id = '$id'");
		$result['sr'] = $query->result_array();
		if (!empty($result['sr'])) {
			$data['panel_id'] = $result['sr'][0]['panel_id'];
			$data['panel_name'] = $result['sr'][0]['panel_name'];
			$data['panel_label'] = $result['sr'][0]['panel_label'];
			$data['panel_content'] = $result['sr'][0]['panel_content'];
			$data['panel_visible'] = $result['sr'][0]['panel_visible'];
			return ($data);
		}
		else {
			$data = array();
		}
		return ($data);
	}

	function panel_insert($user, $data)
	{
		$this->load_db($user);
		if (trim($data['panel_name'])=='') return;
		$data_sr = array(
							'panel_name' => $data['panel_name'],
							'panel_label' => $data['panel_label'],
							'panel_content' => $data['FCKeditor1']
						);
		$query = $this->db->insert('t_panel', $data_sr);
		return ($query);
	}

	function panel_edit($user, $data)
	{
		$this->load_db($user);
		if (trim($data['panel_name'])=='') return;
		$id = $data['panel_id'];
		$data_sr = array(
							'panel_name' => $data['panel_name'],
							'panel_label' => $data['panel_label'],
							'panel_content' => $data['FCKeditor1'],
							'panel_visible' => $data['panel_visible']
						);
		$query = $this->db->update('t_panel', $data_sr, array('panel_id' => $id));
		return ($query);
	}

	function panel_delete($user, $id)
	{
		$this->load_db($user);
 		$query = $this->db->delete('t_panel', array('panel_id' => $id)); 
		return;
	}


//------------------------------------------------------------------------------------------------------------------------


//--------------------------------------HALAMAN-----------------------------------------------------------------------------
	function get_halaman_list($user)
	{
		$this->load_db($user);
		$query = $this->db->query("select * from t_pages order by page_id");
		$result['sr'] = $query->result_array();
		if (!empty($result['sr'])) {
		foreach($result['sr'] as $row=>$value) 
		{
			$data['single record sidebar'][$row]['no'] = ($row+1).'.';
			$data['single record sidebar'][$row]['sr_name'] = $value['page_title'];

			if ($value['page_visible']=='0') $data['single record sidebar'][$row]['alert'] = 'table-common-alert';
			else $data['single record sidebar'][$row]['alert'] = '';

			$x = explode(".",$value['page_image']);
			$ext = $x[count($x)-1];
			$y = explode(".".$ext,$value['page_image']);
			$thumbnail_file = config_item('base_url')."/userfiles/image/page/".$y[0]."_thumb.".$ext;
			$data['single record sidebar'][$row]['sr_image'] = $thumbnail_file;


			$data['single record sidebar'][$row]['url action'] = 
			"<a href='".reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/halaman_shiftup/'.$value['page_id']."/")."'>
			<img src='".config_item('base_url')."/files/admin/images/uparrow.png'></a>
			<a href='".reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/halaman_shiftdown/'.$value['page_id']."/")."'>
			<img src='".config_item('base_url')."/files/admin/images/downarrow.png'></a>
			<a href='".reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/halaman_form_edit/'.$value['page_id']."/")."'>
			<img src='".config_item('base_url')."/files/admin/images/edit.gif'></a>
			<a href='".reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/halaman_delete/'.$value['page_id']."/")."' onClick=\"return confirm('Apakah Anda yakin akan menghapus halaman ini?')\">
			<img src='".config_item('base_url')."/files/admin/images/delete.gif'></a>";

			$content = strip_tags(trim(substr($value['page_content'],0,200)));
			$x = strpos(strrev($content)," ");
			$length = strlen($content) - $x - 1;
			$content = substr($content,0,$length)."...";

			if ($value['page_type'] == 'page') $data['single record sidebar'][$row]['content'] = $content;
			if ($value['page_type'] == 'module') $data['single record sidebar'][$row]['content'] = "MODULE: ".strtoupper($value['page_module']);
			if ($value['page_type'] == 'url') $data['single record sidebar'][$row]['content'] = "URL: ".$value['page_url'];
			if ($value['page_type'] == 'uri') $data['single record sidebar'][$row]['content'] = "URI: ".$value['page_uri'];

		}
		}
		else {
			$data['single record sidebar'][0]['no'] = '...';
			$data['single record sidebar'][0]['sr_name'] = '...';
			$data['single record sidebar'][0]['url action'] = '...';
			$data['single record sidebar'][0]['content'] = '...';
		}
			$data['url insert'] = reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/halaman_form_insert/');
		return ($data);
	}



	function get_halaman_detil($user,$id)
	{
		$this->load_db($user);
		$this->load->helper('smiley');
		$this->load->library('table');
		$image_array = get_clickable_smileys(config_item('base_url').'/files/smileys/');
		$col_array = $this->table->make_columns($image_array, 8);
		$query = $this->db->query("select * FROM t_pages where page_id = '$id'");
		$result['sr'] = $query->result_array();
		if (!empty($result['sr'])) {
			$data['single record id'] = $result['sr'][0]['page_id'];
			$data['single record title'] = $result['sr'][0]['page_title'];
			$data['single_record_type'] = $result['sr'][0]['page_type'];
			$data['single_record_content'] = $result['sr'][0]['page_content'];
			$data['single_record_module'] = $result['sr'][0]['page_module'];
			$data['single_record_uri'] = $result['sr'][0]['page_uri'];
			$data['single_record_url'] = $result['sr'][0]['page_url'];
			$data['single_record_target'] = $result['sr'][0]['page_target'];
			$data['single_record_mrc_thumbnail'] = $result['sr'][0]['page_image'];
			$data['single_record_visible'] = $result['sr'][0]['page_visible'];
			$data['smiley_table'] = $this->table->generate($col_array);
			$x = explode(".",$result['sr'][0]['page_image']);
			$ext = $x[count($x)-1];
			$y = explode(".".$ext,$result['sr'][0]['page_image']);
			$thumbnail_file = config_item('base_url')."/userfiles/image/page/".$y[0]."_thumb.".$ext;
			$data['src_image'] = $result['sr'][0]['page_image'];
			$data['src_thumbnail'] = $thumbnail_file;
			return ($data);
		}
		else {
			$data['single record title'] = '';
			$data['single_record_content'] = '';
			$data['single_record_module'] = '';
			$data['single_record_url'] = 'http://';
			$data['single_record_target'] = '';
			//exit;
		}
		return ($data);
	}


	function halaman_insert($user, $data)
	{
		$this->load_db($user);
		if (trim($data['sr_name'])=='') return;
		if (trim($_FILES['src_thumbnail']['name'])=='') $image = '';
		else $image = $_FILES['src_thumbnail']['name'];
		if ($data['sr_type'] == 'page') 
		{
			$page_content = $data['FCKeditor1'];
			$page_target = '_self';
		}
		else $page_content = '';
		if ($data['sr_type'] == 'module') 
		{ 
			$page_module = $data['page_module'];
			$page_target = '_self';
		}
		else $page_module = '';
		if ($data['sr_type'] == 'uri') 
		{
			$page_uri = $data['page_uri'];
			$page_target = '_self';
		}
		else $page_uri = '';
		if ($data['sr_type'] == 'url') 
		{
			$page_url = $data['page_url'];
			$page_target = $data['page_target'];
		}
		else $page_url = '';
		$data_sr = array(
							'page_title' => $data['sr_name'],
							'page_type' => $data['sr_type'],
							'page_content' => $page_content,
							'page_module' => $page_module,
							'page_uri' => $page_uri,
							'page_url' => $page_url,
							'page_target' => $page_target,
							'page_image' => $image,
							'page_visible' => $data['sr_visible']
						);
		$query = $this->db->insert('t_pages', $data_sr);
		if ($query) 
		{
			if (!empty($_FILES['src_thumbnail']['tmp_name'])) {
				$filename = "./userfiles/image/page/".$image;
				copy($_FILES['src_thumbnail']['tmp_name'], $filename);

				$x = explode(".",$image);
				$ext = $x[count($x)-1];
				$y = explode(".".$ext,$image);
				$thumbnail_file = "./userfiles/image/page/".$y[0]."_thumb.".$ext;
				copy($_FILES['src_thumbnail']['tmp_name'], $thumbnail_file);

				$config['image_library'] = 'gd2';
				$config['source_image'] = $filename;
				$config['maintain_ratio'] = TRUE;
				$config['width'] = 200;
				$config['height'] = 200;
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
		}
		return ($query);
	}

	function halaman_edit($user, $data)
	{
		$this->load_db($user);
		if (trim($data['sr_name'])=='') return;
		$id = $data['sr_id'];

		$query = $this->db->query("select page_image as image FROM t_pages where page_id = '".$id."'");
		$row = $query->row_array(0);
		$current_image = "./userfiles/image/page/".$row['image'];

		$x = explode(".",$row['image']);
		$ext = $x[count($x)-1];
		$y = explode(".".$ext,$row['image']);
		$current_thumbnail = "./userfiles/image/page/".$y[0]."_thumb.".$ext;

		if (trim($_FILES['src_thumbnail']['name'])=='') $image = $data['src_current_thumbnail'];
		else $image = $_FILES['src_thumbnail']['name'];

		if (trim($_FILES['src_thumbnail']['name'])=='') $image = '';
		else $image = $_FILES['src_thumbnail']['name'];

		if ($data['sr_type'] == 'page') 
		{
			$page_content = $data['FCKeditor1'];
			$page_target = '_self';
		}
		else $page_content = '';
		if ($data['sr_type'] == 'uri') 
		{
			$page_uri = $data['page_uri'];
		}
		else $page_uri = '';
		if ($data['sr_type'] == 'url') 
		{
			$page_url = $data['page_url'];
			$page_target = $data['page_target'];
		}
		else $page_url = '';
		if ($data['sr_type'] == 'module') 
		{ 
			$page_module = $data['page_module'];
			$page_target = '_self';
		}
		else $page_module = '';

		$data_sr = array(
							'page_title' => $data['sr_name'],
							'page_type' => $data['sr_type'],
							'page_content' => $page_content,
							'page_module' => $page_module,
							'page_uri' => $page_uri,
							'page_url' => $page_url,
							'page_target' => $page_target,
							'page_image' => $image,
							'page_visible' => $data['sr_visible']
						);
		$query = $this->db->update('t_pages', $data_sr, array('page_id' => $id));
		if ($query) 
		{
			if (!empty($_FILES['src_thumbnail']['tmp_name'])) {
				if (file_exists($current_image)) {
					@unlink($current_image);
					@unlink($current_thumbnail);
				}

				$filename = "./userfiles/image/page/".$image;
				copy($_FILES['src_thumbnail']['tmp_name'], $filename);

				$x = explode(".",$image);
				$ext = $x[count($x)-1];
				$y = explode(".".$ext,$image);
				$thumbnail_file = "./userfiles/image/page/".$y[0]."_thumb.".$ext;
				copy($_FILES['src_thumbnail']['tmp_name'], $thumbnail_file);

				$config['image_library'] = 'gd2';
				$config['source_image'] = $filename;
				$config['maintain_ratio'] = TRUE;
				$config['width'] = 200;
				$config['height'] = 200;
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
		}
		return ($query);
	}

	function halaman_delete($user, $id)
	{
		$this->load_db($user);
		$query = $this->db->query("select page_image as image FROM t_pages where page_id = '$id'");
		$row = $query->row_array(0);
		$current_image = "./userfiles/image/page/".$row['image'];
		$x = explode(".",$row['image']);
		$ext = $x[count($x)-1];
		$y = explode(".".$ext,$row['image']);
		$current_thumbnail = "./userfiles/image/page/".$y[0]."_thumb.".$ext;
		if (file_exists($current_image)) {
			@unlink($current_image);
			@unlink($current_thumbnail);
		}
 		$query = $this->db->delete('t_pages', array('page_id' => $id)); 
		return;
	}

	function halaman_delete_image($user, $id)
	{
		$this->load_db($user);
		$query = $this->db->query("select page_image as image FROM t_pages where page_id = '$id'");
		$row = $query->row_array(0);
		$current_image = "./userfiles/image/page/".$row['image'];
		$x = explode(".",$row['image']);
		$ext = $x[count($x)-1];
		$y = explode(".".$ext,$row['image']);
		$current_thumbnail = "./userfiles/image/page/".$y[0]."_thumb.".$ext;
		if (file_exists($current_image)) {
			@unlink($current_image);
			@unlink($current_thumbnail);
		}
 		$query = $this->db->update('t_pages', array('page_image' =>''), array('page_id' => $id)); 
		return;
	}

	function halaman_shiftup($user, $id)
	{
		$this->load_db($user);
		$query = $this->db->query("select * FROM t_pages order by page_id");
		$result = $query->result_array();
		$i = 0;
		foreach($result as $row=>$value)
		{
			$no[$i] = $value['page_id'];
			if ($no[$i] == $id) 
			{
				$current_id = $no[$i];
				$swap_id = $no[$i-1];
				if ($i==0) 
				{
					
					return;
				}
				$query = $this->db->query("update t_pages set page_id = -1 where page_id = $swap_id");
				$query = $this->db->query("update t_pages set page_id = $swap_id where page_id = $current_id");
				$query = $this->db->query("update t_pages set page_id = $current_id where page_id = -1");
				return;
			}
			$i++;
		}
		return;
	}

	function halaman_shiftdown($user, $id)
	{
		$this->load_db($user);
		$query = $this->db->query("select * FROM t_pages order by page_id");
		$result = $query->result_array();
		$i = 0;
		foreach($result as $row=>$value)
		{
			$no[$i] = $value['page_id'];
			if ($no[$i] == $id) 
			{
				$current_id = $no[$i];
				$j = $i;
			}
			$i++;
		}
		if ($j==$i-1) return;
		$swap_id = $no[$j+1];
		$query = $this->db->query("update t_pages set page_id = -1 where page_id = $swap_id");
		$query = $this->db->query("update t_pages set page_id = $swap_id where page_id = $current_id");
		$query = $this->db->query("update t_pages set page_id = $current_id where page_id = -1");
		return;
	}
//------------------------------------------------------------------------------------------------------------------------


//--------------------------------------GROUPMENU-----------------------------------------------------------------------------
	function get_groupmenu_list($user)
	{
		$this->load_db($user);
		$query = $this->db->query("select * from t_category where category_type='menu' order by category_id");
		$result = $query->result_array();
		if (!empty($result)) {
		foreach($result as $row=>$value) 
		{
			$data['multiple_record_sidebar'][$row]['no'] = ($row+1).'.';
			$data['multiple_record_sidebar'][$row]['groupmenu_nama'] = $value['category_name'];

			if ($value['category_visible']=='0') $data['multiple_record_sidebar'][$row]['alert'] = 'table-common-alert';
			else $data['multiple_record_sidebar'][$row]['alert'] = '';

			$data['multiple_record_sidebar'][$row]['url action'] = 
			"<a href='".reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/groupmenu_shiftup/'.$value['category_id']."/")."'>
			<img src='".config_item('base_url')."/files/admin/images/uparrow.png'></a>
			<a href='".reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/groupmenu_shiftdown/'.$value['category_id']."/")."'>
			<img src='".config_item('base_url')."/files/admin/images/downarrow.png'></a>
			<a href='".reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/groupmenu_form_edit/'.$value['category_id']."/")."'>
			<img src='".config_item('base_url')."/files/admin/images/edit.gif'></a>
			<a href='".reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/groupmenu_delete/'.$value['category_id']."/")."' onClick=\"return confirm('Menghapus groupmenu ini berarti menghapus seluruh item menu yang ada dalam group menu ini. Apakah Anda yakin akan menghapus groupmenu ini?')\">
			<img src='".config_item('base_url')."/files/admin/images/delete.gif'></a>";
		}
		}
		else {
			$data['multiple_record_sidebar'][0]['no'] = '...';
			$data['multiple_record_sidebar'][0]['groupmenu_nama'] = '...';
			$data['multiple_record_sidebar'][0]['url action'] = '...';
		}
			$data['url insert'] = reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/groupmenu_form_insert/');
		return ($data);
	}

	function get_groupmenu_detil($user,$id)
	{
		$this->load_db($user);
		$this->load->library('table');
		$query = $this->db->query("select * FROM t_category where category_id = '$id'");
		$result = $query->result_array();
		if (!empty($result)) {
			$data['multiple record id'] = $result[0]['category_id'];
			$data['multiple record name'] = $result[0]['category_name'];
			$data['multiple record jum'] = $result[0]['category_item_count'];
			$data['multiple_record_visible'] = $result[0]['category_visible'];
			return ($data);
		}
		else {
			$data['multiple record id'] = '';
			$data['multiple record name'] = '';
			exit;
		}
		return ($data);
	}

	function groupmenu_insert($user, $data)
	{
		$this->load_db($user);
		if (trim($data['mr_name'])=='') return;
		$data_mr = array(
							'category_type' => 'menu',
							'category_display_item' => 'ALL',
							'category_name' => $data['mr_name'],
							'category_visible' => $data['mr_visibile']
						);
		$query = $this->db->insert('t_category', $data_mr);
		return ($query);
	}

	function groupmenu_edit($user, $data)
	{
		$this->load_db($user);
		$id = $data['mr_id'];
		$data_mr = array(
							'category_name' => $data['mr_name'],
							'category_visible' => $data['mr_visibile']
						);
		$query = $this->db->update('t_category', $data_mr, array('category_id' => $id));
		return ($query);
	}

	function groupmenu_delete($user, $id)
	{
		$this->load_db($user);
 		$query = $this->db->delete('t_category', array('category_id' => $id)); 
		return;
	}

	function groupmenu_shiftup($user, $id)
	{
		$this->load_db($user);
		$query = $this->db->query("select * FROM t_category where category_type='menu' order by category_id");
		$result = $query->result_array();
		$i = 0;
		foreach($result as $row=>$value)
		{
			$no[$i] = $value['category_id'];
			if ($no[$i] == $id) 
			{
				$current_id = $no[$i];
				$swap_id = $no[$i-1];
				if ($i==0) 
				{
					
					return;
				}
				$query = $this->db->query("update t_category set category_id = -1 where category_id = $swap_id");
				$query = $this->db->query("update t_category set category_id = $swap_id where category_id = $current_id");
				$query = $this->db->query("update t_category set category_id = $current_id where category_id = -1");
				return;
			}
			$i++;
		}
		return;
	}

	function groupmenu_shiftdown($user, $id)
	{
		$this->load_db($user);
		$query = $this->db->query("select * FROM t_category where category_type='menu' order by category_id");
		$result = $query->result_array();
		$i = 0;
		foreach($result as $row=>$value)
		{
			$no[$i] = $value['category_id'];
			if ($no[$i] == $id) 
			{
				$current_id = $no[$i];
				$j = $i;
			}
			$i++;
		}
		if ($j==$i-1) return;
		$swap_id = $no[$j+1];
		$query = $this->db->query("update t_category set category_id = -1 where category_id = $swap_id");
		$query = $this->db->query("update t_category set category_id = $swap_id where category_id = $current_id");
		$query = $this->db->query("update t_category set category_id = $current_id where category_id = -1");
		return;
	}

//------------------------------------------------------------------------------------------------------------------------



//--------------------------------------KATEGORI-----------------------------------------------------------------------------
	function get_category_list($user)
	{
		$this->load_db($user);
		$query = $this->db->query("select * from t_category where category_type='post' order by category_id");
		$result = $query->result_array();
		if (!empty($result)) {
		foreach($result as $row=>$value) 
		{
			$data['multiple_record_sidebar'][$row]['no'] = ($row+1).'.';
			$data['multiple_record_sidebar'][$row]['category_name'] = $value['category_name'];
			$data['multiple_record_sidebar'][$row]['category_visible'] = $value['category_visible'];

			if ($value['category_visible']=='0') $data['multiple_record_sidebar'][$row]['alert'] = 'table-common-alert';
			else $data['multiple_record_sidebar'][$row]['alert'] = '';

			$data['multiple_record_sidebar'][$row]['url action'] = 
			"<a href='".reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/category_shiftup/'.$value['category_id']."/")."'>
			<img src='".config_item('base_url')."/files/admin/images/uparrow.png'></a>
			<a href='".reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/category_shiftdown/'.$value['category_id']."/")."'>
			<img src='".config_item('base_url')."/files/admin/images/downarrow.png'></a>
			<a href='".reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/category_form_edit/'.$value['category_id']."/")."'>
			<img src='".config_item('base_url')."/files/admin/images/edit.gif'></a>
			<a href='".reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/category_delete/'.$value['category_id']."/")."' onClick=\"return confirm('Menghapus kategori ini berarti menghapus seluruh posting yang ada dalam kategori ini. Apakah Anda yakin akan menghapus kategori ini?')\">
			<img src='".config_item('base_url')."/files/admin/images/delete.gif'></a>";
		}
		}
		else {
			$data['multiple_record_sidebar'][0]['no'] = '...';
			$data['multiple_record_sidebar'][0]['category_name'] = '...';
			$data['multiple_record_sidebar'][0]['category_visible'] = '...';
			$data['multiple_record_sidebar'][0]['url action'] = '...';
		}
			$data['url insert'] = reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/category_form_insert/');
		return ($data);
	}

	function get_category_detil($user,$id)
	{
		$this->load_db($user);
		$this->load->library('table');
		$query = $this->db->query("select * FROM t_category where category_id = '$id'");
		$result = $query->result_array();
		if (!empty($result)) {
			$data['multiple record id'] = $result[0]['category_id'];
			$data['multiple record name'] = $result[0]['category_name'];
			$data['multiple record jum'] = $result[0]['category_item_count'];
			$data['multiple_record_visible'] = $result[0]['category_visible'];
			return ($data);
		}
		else {
			$data['multiple record id'] = '';
			$data['multiple record name'] = '';
			exit;
		}
		return ($data);
	}


	function category_insert($user, $data)
	{
		$this->load_db($user);
		if (trim($data['mr_name'])=='') return;
		$data_mr = array(
							'category_type' => 'post',
							'category_display_item' => 'SPECIFIC',
							'category_name' => $data['mr_name'],
							'category_item_count' => $data['mr_records'],
							'category_visible' => $data['mr_visible']
						);
		$query = $this->db->insert('t_category', $data_mr);
		return ($query);
	}

	function category_edit($user, $data)
	{
		$this->load_db($user);
		$id = $data['mr_id'];
		$data_mr = array(
							'category_name' => $data['mr_name'],
							'category_item_count' => $data['mr_records'],
							'category_visible' => $data['mr_visibile']
						);
		$query = $this->db->update('t_category', $data_mr, array('category_id' => $id));
		return ($query);
	}

	function category_delete($user, $id)
	{
		$this->load_db($user);
 		$query = $this->db->delete('t_category', array('category_id' => $id)); 
		return;
	}


	function category_shiftup($user, $id)
	{
		$this->load_db($user);
		$query = $this->db->query("select * FROM t_category where category_type='post' order by category_id");
		$result = $query->result_array();
		$i = 0;
		foreach($result as $row=>$value)
		{
			$no[$i] = $value['category_id'];
			if ($no[$i] == $id) 
			{
				$current_id = $no[$i];
				$swap_id = $no[$i-1];
				if ($i==0) 
				{
					
					return;
				}
				$query = $this->db->query("update t_category set category_id = -1 where category_id = $swap_id");
				$query = $this->db->query("update t_category set category_id = $swap_id where category_id = $current_id");
				$query = $this->db->query("update t_category set category_id = $current_id where category_id = -1");
				return;
			}
			$i++;
		}
		return;
	}

	function category_shiftdown($user, $id)
	{
		$this->load_db($user);
		$query = $this->db->query("select * FROM t_category where category_type='post' order by category_id");
		$result = $query->result_array();
		$i = 0;
		foreach($result as $row=>$value)
		{
			$no[$i] = $value['category_id'];
			if ($no[$i] == $id) 
			{
				$current_id = $no[$i];
				$j = $i;
			}
			$i++;
		}
		if ($j==$i-1) return;
		$swap_id = $no[$j+1];
		$query = $this->db->query("update t_category set category_id = -1 where category_id = $swap_id");
		$query = $this->db->query("update t_category set category_id = $swap_id where category_id = $current_id");
		$query = $this->db->query("update t_category set category_id = $current_id where category_id = -1");
		return;
	}
//------------------------------------------------------------------------------------------------------------------------


//--------------------------------------MENU-----------------------------------------------------------------------------
	function get_menu_list($user)
	{
		$this->load_db($user);
		$sql = "select * FROM t_posting, t_category where posting_category_id = category_id and category_type='menu' order by posting_category_id";
		$query = $this->db->query("select count(posting_id) as jum FROM t_posting, t_category where posting_category_id = category_id and category_type='menu' order by posting_date desc");
		$row = $query->row_array(0);
		$count = $row['jum'];
		$data = $this->pagination_model->paging(config_item('index_page').'/cpm/menu/',3, $sql, $count, 10000, 2);
		if (!empty($data['result'])) {
		foreach ($data as $key=>$entry) {
			foreach ($entry as $row=>$value) {
				$data['multiple record last posted list index'][$row]['no'] = ($row + 1);
				$data['multiple record last posted list index'][$row]['mrc_date'] = $this->IndonesianDate($value['posting_date']);
				$data['multiple record last posted list index'][$row]['mrc_title'] = $value['posting_title'];
				$data['multiple record last posted list index'][$row]['mr_name'] = $value['category_name'];
				$data['multiple record last posted list index'][$row]['posted_by'] = $value['posting_by'];

				$x = explode(".",$value['posting_image']);
				$ext = $x[count($x)-1];
				$y = explode(".".$ext,$value['posting_image']);
				$thumbnail_file = config_item('base_url')."/userfiles/image/menu/".$y[0]."_thumb.".$ext;
				$data['multiple record last posted list index'][$row]['mrc_image'] = $thumbnail_file;

				$data['multiple record last posted list index'][$row]['url action'] = 
				"<a href='".reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/menu_shiftup/'.$value['posting_id']."/")."'>
				<img src='".config_item('base_url')."/files/admin/images/uparrow.png'></a>
				<a href='".reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/menu_shiftdown/'.$value['posting_id']."/")."'>
				<img src='".config_item('base_url')."/files/admin/images/downarrow.png'></a>
				<a href='".reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/menu_form_edit/'.$value['posting_id']."/")."'>
				<img src='".config_item('base_url')."/files/admin/images/edit.gif'></a>
				<a href='".reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/menu_delete/'.$value['posting_id']."/")."' onClick=\"return confirm('Apakah Anda yakin akan menghapus menu ini?')\">
				<img src='".config_item('base_url')."/files/admin/images/delete.gif'></a>";

				if ($value['posting_visible']=='0') $data['multiple record last posted list index'][$row]['alert'] = 'table-common-alert';
				else $data['multiple record last posted list index'][$row]['alert'] = '';				

				$content = strip_tags(trim(substr($value['posting_content'],0,200)));
				$x = strpos(strrev($content)," ");
			 	$length = strlen($content) - $x - 1;
	 			$content = substr($content,0,$length)."...";

				if ($value['posting_type'] == 'menu') $data['multiple record last posted list index'][$row]['mrc_content'] = $content;
				if ($value['posting_type'] == 'module') $data['multiple record last posted list index'][$row]['mrc_content'] = "MODUL: ".strtoupper($value['posting_module']);
				if ($value['posting_type'] == 'url') $data['multiple record last posted list index'][$row]['mrc_content'] = "URL: ".$value['posting_url'];
				if ($value['posting_type'] == 'uri') $data['multiple record last posted list index'][$row]['mrc_content'] = "URI: ".$value['posting_uri'];

				$data['page_nav'] = $this->pagination->create_links();
			}
		}
		}
		else {
				$data['multiple record last posted list index'][0]['no'] = '...';
				$data['multiple record last posted list index'][0]['url action'] = '...';
				$data['multiple record last posted list index'][0]['mr_name'] = '...';
				$data['multiple record last posted list index'][0]['mrc_mr_id '] = '';
				$data['multiple record last posted list index'][0]['mrc_date'] = '';
				$data['multiple record last posted list index'][0]['mrc_title'] ='...';
				$data['multiple record last posted list index'][0]['mrc_content'] ='...';
				$data['multiple record last posted list index'][0]['posted_by'] ='';
				$data['multiple record last posted list index'][0]['comment_count'] ='';
				$data['multiple record last posted list index'][0]['index_comment_count'] = '';
				$data['page_nav'] = $this->pagination->create_links();
		}
		$data['url insert'] = reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/menu_form_insert/');
		return ($data);
	}

	function get_menu_detil($user,$id)
	{
		$this->load_db($user);
		$this->load->helper('smiley');
		$this->load->library('table');
		$image_array = get_clickable_smileys(config_item('base_url').'/files/smileys/');
		$col_array = $this->table->make_columns($image_array, 8);
		$query = $this->db->query("select * FROM t_posting, t_category where posting_category_id = category_id and posting_id = '$id'");
		$result['mr'] = $query->result_array();
		if (!empty($result['mr'])) {
			$query2 = $this->db->query("select * FROM t_category where category_type='menu' order by category_id");
			$result['mr2'] = $query2->result_array();
			if (!empty($result['mr2'])) {
				foreach($result['mr2'] as $row=>$value) {
					if ($result['mr'][0]['posting_category_id'] == $value['category_id']) $selected = 'selected';
					else $selected = '';
					$data['multiple record category'][$row]['selected'] = $selected;
					$data['multiple record category'][$row]['mr_id'] = $value['category_id'];
					$data['multiple record category'][$row]['mr_name'] = $value['category_name'];
				}
			}

			$x = explode(".",$result['mr'][0]['posting_image']);
			$ext = $x[count($x)-1];
			$y = explode(".".$ext,$result['mr'][0]['posting_image']);
			$thumbnail_file = config_item('base_url')."/userfiles/image/menu/".$y[0]."_thumb.".$ext;
			$data['mrc_image'] = $result['mr'][0]['posting_image'];
			$data['mrc_thumbnail'] = $thumbnail_file;

			$data['multiple record mrc_id'] = $result['mr'][0]['posting_id'];
			$data['multiple record mrc_mr_id'] = $result['mr'][0]['category_id'];
			$data['multiple record mrc_title'] = $result['mr'][0]['posting_title'];

			$data['multiple_record_type'] = $result['mr'][0]['posting_type'];
			$data['multiple_record_content'] = $result['mr'][0]['posting_content'];
			$data['multiple_record_module'] = $result['mr'][0]['posting_module'];
			$data['multiple_record_uri'] = $result['mr'][0]['posting_uri'];
			$data['multiple_record_url'] = $result['mr'][0]['posting_url'];
			$data['multiple_record_target'] = $result['mr'][0]['posting_target'];

			$data['multiple_record_mrc_thumbnail'] = $result['mr'][0]['posting_image'];

			$data['multiple_record_mrc_visible'] = $result['mr'][0]['posting_visible'];
			$data['multiple_record_mrc_comment_status'] = $result['mr'][0]['posting_comment_status'];
			$data['smiley_table'] = $this->table->generate($col_array);
			//print_r($data);
			return ($data);
		}
		else {
			$data['multiple record mrc_id'] = '';
			$data['multiple record mrc_mr_id'] = '';
			$data['multiple record mrc_title'] = '';
			$data['multiple_record_uri'] = '/';
			$data['multiple_record_url'] = 'http://';
			$data['multiple_record_module'] = '';
			$data['multiple_record_target'] = '';
			$data['multiple_record_content'] = '';
			$data['multiple_record_mrc_thumbnail'] = '';
			$data['smiley_table'] = '';
		}
		return ($data);
	}

	function menu_insert($user, $data)
	{
		$this->load_db($user);
		if (trim($data['mrc_title'])=='') return;
		if (trim($_FILES['mrc_thumbnail']['name'])=='') $image = '';
		else $image = $_FILES['mrc_thumbnail']['name'];

		if ($data['mrc_type'] == 'menu') 
		{
			$posting_content = $data['FCKeditor1'];
			$posting_target = '_self';
		}
		else $posting_content = '';
		if ($data['mrc_type'] == 'module') 
		{ 
			$posting_module = $data['posting_module'];
			$posting_target = '_self';
		}
		else $posting_module = '';
		if ($data['mrc_type'] == 'url') 
		{
			$posting_url = $data['posting_url'];
			$posting_target = $data['posting_target'];
		}
		else $posting_url = '';
		if ($data['mrc_type'] == 'uri') 
		{
			$posting_uri = $data['posting_uri'];
			$posting_target = '_self';
		}
		else $posting_uri = '';

		$data_mr = array(
							'posting_category_id' => $data['mrc_mr_id'],
							'posting_date' => date('Y-m-d H:i:s'),
							'posting_title' => $data['mrc_title'],
							'posting_type' => $data['mrc_type'],
							'posting_content' => $posting_content,
							'posting_module' => $posting_module,
							'posting_uri' => $posting_uri,
							'posting_url' => $posting_url,
							'posting_target' => $posting_target,
							'posting_image' => $image,
							'posting_visible' =>  $data['mrc_visibile'],
							'posting_comment_status' =>  $data['mrc_comment_status']
						);
		$query = $this->db->insert('t_posting', $data_mr);
		if ($query) 
		{
			if (!empty($_FILES['mrc_thumbnail']['tmp_name'])) {
				$filename = "./userfiles/image/menu/".$image;
				copy($_FILES['mrc_thumbnail']['tmp_name'], $filename);

				$x = explode(".",$image);
				$ext = $x[count($x)-1];
				$y = explode(".".$ext,$image);
				$thumbnail_file = "./userfiles/image/menu/".$y[0]."_thumb.".$ext;
				copy($_FILES['mrc_thumbnail']['tmp_name'], $thumbnail_file);

				$config['image_library'] = 'gd2';
				$config['source_image'] = $filename;
				$config['maintain_ratio'] = TRUE;
				$config['width'] = 200;
				$config['height'] = 200;
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
		}
		return ($query);
	}

	function menu_edit($user, $data)
	{
		$this->load_db($user);

		$query = $this->db->query("select posting_image as image FROM t_posting where posting_id = '".$data['mrc_id']."'");
		$row = $query->row_array(0);
		$current_image = "./userfiles/image/menu/".$row['image'];

		$x = explode(".",$row['image']);
		$ext = $x[count($x)-1];
		$y = explode(".".$ext,$row['image']);
		$current_thumbnail = "./userfiles/image/menu/".$y[0]."_thumb.".$ext;

		$id = $data['mrc_id'];
		if (empty($data['mrc_mr_id']) | trim($data['mrc_mr_id']) == '') return;

		if (trim($_FILES['mrc_thumbnail']['name'])=='') $image = $data['mrc_current_thumbnail'];
		else $image = $_FILES['mrc_thumbnail']['name'];

		if ($data['mrc_type'] == 'menu') 
		{
			$posting_content = $data['FCKeditor1'];
			$posting_target = '_self';
		}
		else $posting_content = '';
		if ($data['mrc_type'] == 'module') 
		{ 
			$posting_module = $data['posting_module'];
			$posting_target = '_self';
		}
		else $posting_module = '';
		if ($data['mrc_type'] == 'url') 
		{
			$posting_url = $data['posting_url'];
			$posting_target = $data['posting_target'];
		}
		else $posting_url = '';
		if ($data['mrc_type'] == 'uri') 
		{
			$posting_uri = $data['posting_uri'];
			$posting_target = '_self';
		}
		else $posting_uri = '';

		$data_mr = array(
							'posting_category_id' => $data['mrc_mr_id'],
							'posting_title' => $data['mrc_title'],
							'posting_type' => $data['mrc_type'],
							'posting_content' => $posting_content,
							'posting_module' => $posting_module,
							'posting_uri' => $posting_uri,
							'posting_url' => $posting_url,
							'posting_target' => $posting_target,
							'posting_image' => $image,
							'posting_visible' =>  $data['mrc_visibile'],
							'posting_comment_status' =>  $data['mrc_comment_status']
						);
		$query = $this->db->update('t_posting', $data_mr, array('posting_id' => $id));
		if ($query) 
		{
			if (!empty($_FILES['mrc_thumbnail']['tmp_name'])) {
				if (file_exists($current_image)) {
					@unlink($current_image);
					@unlink($current_thumbnail);
				}

				$filename = "./userfiles/image/menu/".$image;
				copy($_FILES['mrc_thumbnail']['tmp_name'], $filename);

				$x = explode(".",$image);
				$ext = $x[count($x)-1];
				$y = explode(".".$ext,$image);
				$thumbnail_file = "./userfiles/image/menu/".$y[0]."_thumb.".$ext;
				copy($_FILES['mrc_thumbnail']['tmp_name'], $thumbnail_file);

				$config['image_library'] = 'gd2';
				$config['source_image'] = $filename;
				$config['maintain_ratio'] = TRUE;
				$config['width'] = 200;
				$config['height'] = 200;
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
		}
		return ($query);
	}

	function menu_delete($user, $id)
	{
		$this->load_db($user);
		$query = $this->db->query("select posting_image as image FROM t_posting where posting_id = '$id'");
		$row = $query->row_array(0);
		$current_image = "./userfiles/image/menu/".$row['image'];
		$x = explode(".",$row['image']);
		$ext = $x[count($x)-1];
		$y = explode(".".$ext,$row['image']);
		$current_thumbnail = "./userfiles/image/menu/".$y[0]."_thumb.".$ext;
		if (file_exists($current_image)) {
			@unlink($current_image);
			@unlink($current_thumbnail);
		}
 		$query = $this->db->delete('t_posting', array('posting_id' => $id)); 
		return;
	}

	function menu_delete_image($user, $id)
	{
		$this->load_db($user);
		$query = $this->db->query("select posting_image as image FROM t_posting where posting_id = '$id'");
		$row = $query->row_array(0);
		$current_image = "./userfiles/image/menu/".$row['image'];
		$x = explode(".",$row['image']);
		$ext = $x[count($x)-1];
		$y = explode(".".$ext,$row['image']);
		$current_thumbnail = "./userfiles/image/menu/".$y[0]."_thumb.".$ext;
		if (file_exists($current_image)) {
			@unlink($current_image);
			@unlink($current_thumbnail);
		}
 		$query = $this->db->update('t_posting', array('posting_image' => ''), array('posting_id' => $id)); 
		return;
	}

	function menu_shiftup($user, $id)
	{
		$this->load_db($user);
		$query = $this->db->query("select category_id as kategori FROM t_posting, t_category where posting_category_id = category_id and posting_id = '$id' and category_type='menu'");
		$row_kategori = $query->row_array(0);
		$kategori = $row_kategori['kategori'];
		$query = $this->db->query("select * FROM t_posting, t_category where posting_category_id = category_id AND category_id = '$kategori' AND category_type='menu' order by category_id");
		$result = $query->result_array();
		$i = 0;
		foreach($result as $row=>$value)
		{
			$no[$i] = $value['posting_id'];
			if ($no[$i] == $id) 
			{
				$current_id = $no[$i];
				$swap_id = $no[$i-1];
				if ($i==0) 
				{
					
					return;
				}
				$query = $this->db->query("update t_posting set posting_id = 0 where posting_id = $swap_id");
				$query = $this->db->query("update t_posting set posting_id = $swap_id where posting_id = $current_id");
				$query = $this->db->query("update t_posting set posting_id = $current_id where posting_id = 0");
				return;
			}
			$i++;
		}
		return;
	}

	function menu_shiftdown($user, $id)
	{
		$this->load_db($user);
		$query = $this->db->query("select category_id as kategori FROM t_posting, t_category where posting_category_id = category_id and posting_id = '$id' and category_type='menu'");
		$row_kategori = $query->row_array(0);
		$kategori = $row_kategori['kategori'];
		$query = $this->db->query("select * FROM t_posting, t_category where posting_category_id = category_id AND category_id = '$kategori' AND category_type='menu' order by category_id");
		$result = $query->result_array();
		$i = 0;
		foreach($result as $row=>$value)
		{
			$no[$i] = $value['posting_id'];
			if ($no[$i] == $id) 
			{
				$current_id = $no[$i];
				$j = $i;
			}
			$i++;
		}
		if ($j==$i-1) return;
		$swap_id = $no[$j+1];
		$query = $this->db->query("update t_posting set posting_id = 0 where posting_id = $swap_id");
		$query = $this->db->query("update t_posting set posting_id = $swap_id where posting_id = $current_id");
		$query = $this->db->query("update t_posting set posting_id = $current_id where posting_id = 0");
		return;
	}


//--------------------------------------POSTING-----------------------------------------------------------------------------
	function get_posting_list($user)
	{
		$this->load_db($user);
		if (trim($_POST['post_search'])!='') {
			$search = $_POST['post_search'];
			$post_search_string = " and (posting_title like '%$search%' or posting_content like '%$search%' or category_name like '%$search%') ";
			$this->session->set_userdata('post_search_string',$post_search_string);
			$this->session->set_userdata('post_search_key',$search);
		}
		if (!empty($_POST['post_search_submit']) & trim($_POST['post_search'])=='') {
			$this->session->unset_userdata('post_search_string');
			$this->session->unset_userdata('post_search_key');
		}
		$sql = "select * FROM t_posting, t_category where posting_category_id = category_id and category_type='post' ".$this->session->userdata('post_search_string')." order by posting_date desc";
		$query = $this->db->query("select count(posting_id) as jum FROM t_posting, t_category where posting_category_id = category_id and category_type='post' ".$this->session->userdata('post_search_string')." order by posting_date desc");
		$row = $query->row_array(0);
		$count = $row['jum'];
		$data = $this->pagination_model->paging(config_item('index_page').'/cpm/posting/',3, $sql, $count, 10, 2);
		if (!empty($data['result'])) {
		foreach ($data as $key=>$entry) {
			foreach ($entry as $row=>$value) {
				$data['multiple record last posted list index'][$row]['no'] = ($row + 1);

				$x = explode(".",$value['posting_image']);
				$ext = $x[count($x)-1];
				$y = explode(".".$ext,$value['posting_image']);
				$thumbnail_file = config_item('base_url')."/userfiles/image/posting/".$y[0]."_thumb.".$ext;
				$data['multiple record last posted list index'][$row]['mrc_image'] = $thumbnail_file;

				$data['multiple record last posted list index'][$row]['mrc_date'] = $this->IndonesianDate($value['posting_date']);
				$data['multiple record last posted list index'][$row]['mrc_title'] = $value['posting_title'];
				$data['multiple record last posted list index'][$row]['mr_name'] = $value['category_name'];
				$data['multiple record last posted list index'][$row]['posted_by'] = $value['posting_by'];

				// Ambil jumlah komentar
				$query_comment = $this->db->query("select count(comment_id) as jum from t_comments where comment_posting_id='".$value['posting_id']."'");
				$row_comment = $query_comment->row_array(0);
				$comment_count = $row_comment['jum'];
				if ($comment_count>0)
				{
					$comment_link = 
					"<a href='".reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/komentar_posting/'.$value['posting_id']."/")."'>
					<img src='".config_item('base_url')."/files/admin/images/comment.gif'> &nbsp;".$comment_count." Komentar</a>";
				}
				else
				{
					$comment_link = 
					"<a href='#'>
					<img src='".config_item('base_url')."/files/admin/images/comment.gif'> &nbsp;".$comment_count." Komentar</a>";
				}

				$data['multiple record last posted list index'][$row]['url action'] = 
				$comment_link.
				"<a href='".reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/posting_form_edit/'.$value['posting_id']."/")."'>
				<img src='".config_item('base_url')."/files/admin/images/edit.gif'></a>
				<a href='".reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/posting_delete/'.$value['posting_id']."/")."' onClick=\"return confirm('Apakah Anda yakin akan menghapus posting ini?')\">
				<img src='".config_item('base_url')."/files/admin/images/delete.gif'></a>";
				
				if ($value['posting_visible']=='0') $data['multiple record last posted list index'][$row]['alert'] = 'table-common-alert';
				else $data['multiple record last posted list index'][$row]['alert'] = '';

				$content = strip_tags(trim(substr($value['posting_content'],0,200)));
				$x = strpos(strrev($content)," ");
			 	$length = strlen($content) - $x - 1;
	 			$content = substr($content,0,$length);

				$data['multiple record last posted list index'][$row]['mrc_content'] = $content.'...';

				$data['page_nav'] = $this->pagination->create_links();
			}
		}
		}
		else {
				$data['multiple record last posted list index'][0]['no'] = '...';
				$data['multiple record last posted list index'][0]['url action'] = '...';
				$data['multiple record last posted list index'][0]['mr_name'] = '...';
				$data['multiple record last posted list index'][0]['mrc_mr_id '] = '';
				$data['multiple record last posted list index'][0]['mrc_date'] = '';
				$data['multiple record last posted list index'][0]['mrc_title'] ='...';
				$data['multiple record last posted list index'][0]['mrc_content'] ='...';
				$data['multiple record last posted list index'][0]['posted_by'] ='';
				$data['multiple record last posted list index'][0]['comment_count'] ='';
				$data['multiple record last posted list index'][0]['index_comment_count'] = '';
				$data['page_nav'] = $this->pagination->create_links();
		}
		$data['url insert'] = reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/posting_form_insert/');
		return ($data);
	}

	function get_posting_detil($user,$id)
	{
		$this->load_db($user);
		$query = $this->db->query("select * FROM t_posting, t_category where posting_category_id = category_id and posting_id = '$id'");
		$result['mr'] = $query->result_array();
		if (!empty($result['mr'])) {
			$query2 = $this->db->query("select * FROM t_category where category_type='post' order by category_id");
			$result['mr2'] = $query2->result_array();
			if (!empty($result['mr2'])) {
				foreach($result['mr2'] as $row=>$value) {
					if ($result['mr'][0]['posting_category_id'] == $value['category_id']) $selected = 'selected';
					else $selected = '';
					$data['multiple record category'][$row]['selected'] = $selected;
					$data['multiple record category'][$row]['mr_id'] = $value['category_id'];
					$data['multiple record category'][$row]['mr_name'] = $value['category_name'];
				}
			}

			$x = explode(".",$result['mr'][0]['posting_image']);
			$ext = $x[count($x)-1];
			$y = explode(".".$ext,$result['mr'][0]['posting_image']);
			$thumbnail_file = config_item('base_url')."/userfiles/image/posting/".$y[0]."_thumb.".$ext;
			$data['mrc_image'] = $result['mr'][0]['posting_image'];
			$data['mrc_thumbnail'] = $thumbnail_file;

			$data['multiple record mrc_id'] = $result['mr'][0]['posting_id'];
			$data['multiple record mrc_mr_id'] = $result['mr'][0]['category_id'];
			$data['multiple record mrc_title'] = $result['mr'][0]['posting_title'];
			$data['multiple record mrc_date'] = $result['mr'][0]['posting_date'];
			$data['multiple_record_mrc_content'] = $result['mr'][0]['posting_content'];
			$data['multiple_record_mrc_thumbnail'] = $result['mr'][0]['posting_image'];
			$data['multiple_record_mrc_visible'] = $result['mr'][0]['posting_visible'];
			$data['multiple_record_mrc_comment_status'] = $result['mr'][0]['posting_comment_status'];
			//print_r($data);

			//--------AMBIL TAG POSTING------------------------------------------------------------------------
			$query = $this->db->query("select * FROM t_posting_tag where tag_posting_id = '$id'");
			$result = $query->result_array();
			$tags = '';
			if (!empty($result)) {
			foreach($result as $row=>$value)
			{
				$tags = $tags . "," . $value['posting_tag'];
			}
			}
			$tags = trim($tags);
			$data['multiple record mrc_tags'] = $tags;


			$query = $this->db->query("select * FROM t_tags");
			$result = $query->result_array();
			if (!empty($result)) {
			foreach($result as $row=>$value)
			{
				$query = $this->db->query("select count(tag_posting_id) as jum FROM t_posting_tag where posting_tag = '".$value['tag_name']."'");
				$row_tag = $query->row_array(0);
				$count = $row_tag['jum'];
				$data['tag'][$row]['count'] = $count;
				$data['tag'][$row]['name'] = $value['tag_name'];
			}
			}
			//---------------------------------------------------------------------------------------------------
			return ($data);
		}
		else {
			$data['multiple record id'] = '';
			$data['multiple record mrc_mr_id'] = '';
			$data['multiple record mrc_title'] = '';
			$data['multiple_record_mrc_content'] = '';
			$data['multiple_record_mrc_thumbnail'] = '';
			$data['multiple_record_mrc_visible'] = '';
			$data['multiple_record_mrc_comment_status'] = '';
		}
		return ($data);
	}

	function posting_insert($user, $data)
	{
		$this->load_db($user);
		if (trim($data['mrc_title'])=='' | empty($data['mrc_mr_id']) | trim($data['mrc_mr_id']) == '') return;
		if (trim($_FILES['mrc_thumbnail']['name'])=='') $image = '';
		else $image = $_FILES['mrc_thumbnail']['name'];
		$data_mr = array(
							'posting_category_id' => $data['mrc_mr_id'],
							'posting_title' => $data['mrc_title'],
							'posting_type' => 'post',
							'posting_date' => $data['mrc_date'],
							'posting_content' => $data['FCKeditor1'],
							'posting_image' => $image,
							'posting_visible' =>  $data['mrc_visibile'],
							'posting_comment_status' =>  $data['mrc_comment_status']
						);
		$query = $this->db->insert('t_posting', $data_mr);
		if ($query) 
		{
			if (!empty($_FILES['mrc_thumbnail']['tmp_name'])) {
				$filename = "./userfiles/image/posting/".$image;
				copy($_FILES['mrc_thumbnail']['tmp_name'], $filename);

				$x = explode(".",$image);
				$ext = $x[count($x)-1];
				$y = explode(".".$ext,$image);
				$thumbnail_file = "./userfiles/image/posting/".$y[0]."_thumb.".$ext;
				copy($_FILES['mrc_thumbnail']['tmp_name'], $thumbnail_file);

				$config['image_library'] = 'gd2';
				$config['source_image'] = $filename;
				$config['maintain_ratio'] = TRUE;
				$config['width'] = 200;
				$config['height'] = 200;
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

			//------------INSERT TAG POSTING---------------------------------------------------------------
			$query = $this->db->query("select max(posting_id) as id FROM t_posting");
			$row = $query->row_array(0);
			$posting_id = $row['id'];
			$tags = explode(",",$data['posting_tag']);
			foreach($tags as $value)
			{
				if (trim($value)!='') {
				$query = $this->db->query("select count(tag_name) as jum FROM t_tags where tag_name = '".$value."'");
				$row = $query->row_array(0);
				$count = $row['jum'];
				if ($count==0)
				{
					$this->db->insert('t_tags', array('tag_name' => $value));
				}
				$this->db->insert('t_posting_tag', array('tag_posting_id' => $posting_id, 'posting_tag' => $value));
				}
			}
			//-----------------------------------------------------------------------------------------------
		}
		return;
	}

	function posting_edit($user, $data)
	{
		$this->load_db($user);

		$query = $this->db->query("select posting_image as image FROM t_posting where posting_id = '".$data['mrc_id']."'");
		$row = $query->row_array(0);
		$current_image = "./userfiles/image/posting/".$row['image'];

		$x = explode(".",$row['image']);
		$ext = $x[count($x)-1];
		$y = explode(".".$ext,$row['image']);
		$current_thumbnail = "./userfiles/image/posting/".$y[0]."_thumb.".$ext;

		$id = $data['mrc_id'];
		if (trim($data['mrc_title'])=='' | empty($data['mrc_mr_id']) | trim($data['mrc_mr_id']) == '') return;
		if (empty($data['mrc_mr_id']) | trim($data['mrc_mr_id']) == '') return;
		if (trim($_FILES['mrc_thumbnail']['name'])=='') $image = $data['mrc_current_thumbnail'];
		else $image = $_FILES['mrc_thumbnail']['name'];
		$data_mr = array(
							'posting_category_id' => $data['mrc_mr_id'],
							'posting_title' => $data['mrc_title'],
							'posting_date' => $data['mrc_date'],
							'posting_content' => $data['FCKeditor1'],
							'posting_image' => $image,
							'posting_visible' =>  $data['mrc_visibile'],
							'posting_comment_status' =>  $data['mrc_comment_status']
						);
		$query = $this->db->update('t_posting', $data_mr, array('posting_id' => $id));
		if ($query) 
		{
			if (!empty($_FILES['mrc_thumbnail']['tmp_name'])) {
				if (file_exists($current_image)) {
					@unlink($current_image);
					@unlink($current_thumbnail);
				}

				$filename = "./userfiles/image/posting/".$image;
				copy($_FILES['mrc_thumbnail']['tmp_name'], $filename);

				$x = explode(".",$image);
				$ext = $x[count($x)-1];
				$y = explode(".".$ext,$image);
				$thumbnail_file = "./userfiles/image/posting/".$y[0]."_thumb.".$ext;
				copy($_FILES['mrc_thumbnail']['tmp_name'], $thumbnail_file);

				$config['image_library'] = 'gd2';
				$config['source_image'] = $filename;
				$config['maintain_ratio'] = TRUE;
				$config['width'] = 200;
				$config['height'] = 200;
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

			//------------UPDATE TAG POSTING---------------------------------------------------------------
			$posting_id = $id;
			$tags = explode(",",$data['posting_tag']);
			$this->db->delete('t_posting_tag', array('tag_posting_id' => $id));
			foreach($tags as $value)
			{
				//INSERT TAG IF NOT EXISTS
				if (trim($value)!='') {
				$query = $this->db->query("select count(tag_name) as jum FROM t_tags where tag_name = '".$value."'");
				$row = $query->row_array(0);
				$count = $row['jum'];
				if ($count==0)
				{
					$this->db->insert('t_tags', array('tag_name' => $value));
				}
				$this->db->insert('t_posting_tag', array('tag_posting_id' => $posting_id, 'posting_tag' => $value));
				}
			}
			//-----------------------------------------------------------------------------------------------

		}
		return ($query);
	}

	function posting_delete($user, $id)
	{
		$this->load_db($user);
		$query = $this->db->query("select posting_image as image FROM t_posting where posting_id = '$id'");
		$row = $query->row_array(0);
		$current_image = "./userfiles/image/posting/".$row['image'];
		$x = explode(".",$row['image']);
		$ext = $x[count($x)-1];
		$y = explode(".".$ext,$row['image']);
		$current_thumbnail = "./userfiles/image/posting/".$y[0]."_thumb.".$ext;
		if (file_exists($current_image)) {
			@unlink($current_image);
			@unlink($current_thumbnail);
		}
 		$query = $this->db->delete('t_posting', array('posting_id' => $id)); 
		return;
	}

	function posting_delete_image($user, $id)
	{
		$this->load_db($user);
		$query = $this->db->query("select posting_image as image FROM t_posting where posting_id = '$id'");
		$row = $query->row_array(0);
		$current_image = "./userfiles/image/posting/".$row['image'];
		$x = explode(".",$row['image']);
		$ext = $x[count($x)-1];
		$y = explode(".".$ext,$row['image']);
		$current_thumbnail = "./userfiles/image/posting/".$y[0]."_thumb.".$ext;
		if (file_exists($current_image)) {
			@unlink($current_image);
			@unlink($current_thumbnail);
		}
 		$query = $this->db->update('t_posting', array('posting_image' => ''), array('posting_id' => $id)); 
		return;
	}

//------------------------------------------------------------------------------------------------------------------------



//--------------------------------------KOMENTAR POSTING-----------------------------------------------------------------------------
	function get_comments_posting_list($user,$posting_id)
	{
		$this->load->helper('url');
		$this->load->helper('smiley');
		$this->load_db($user);
		$sql = "select * from t_comments,t_posting,t_category where comment_posting_id=posting_id and posting_category_id=category_id and posting_id='$posting_id' order by comment_date desc";
		$query = $this->db->query("select count(comment_id) as jum from t_comments,t_posting where comment_posting_id=posting_id and posting_id='$posting_id' order by comment_date desc");
		$row = $query->row_array(0);
		$count = $row['jum'];
		$data = $this->pagination_model->paging(config_item('index_page')."/cpm/komentar_posting/".$posting_id,4, $sql, $count, 10, 2);
		if (!empty($data['result'])) {
		$data['komentar_category_posting'] = $data['result'][0]['category_name'];
		$data['comment_posting_id'] = $data['result'][0]['posting_id'];
		$data['komentar_posting_title'] = $data['result'][0]['posting_title'];
		$data['komentar_posting_selected_process'] = config_item('base_url').config_item('index_page').'/cpm/komentar_posting_selected_process';
		foreach ($data as $key=>$entry) {
			foreach($data['result'] as $row=>$value) 
			{
				$data['comment_posting'][$row]['id'] = $value['comment_id'];
				if (trim($value['comment_url'])!='http://' & trim($value['comment_url'])!='')
					$data['comment_posting'][$row]['name'] = "<a href='".$value['comment_url']."' target='_blank'><u>".$value['comment_name']."</u></a>";
				else 
					$data['comment_posting'][$row]['name'] = $value['comment_name'];
				$data['comment_posting'][$row]['url action'] = "<a href='".reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/komentar_posting_delete/'.$value['comment_id']."/")."' onClick=\"return confirm('Apakah Anda yakin akan menghapus komentar ini?')\"><img src='".config_item('base_url')."/files/admin/images/delete.gif'></a>";
				$data['comment_posting'][$row]['email_commentator'] = $value['comment_email'];

				if ($value['comment_approval']=='0') $data['comment_posting'][$row]['alert'] = 'table-common-alert';
				else $data['comment_posting'][$row]['alert'] = '';

				$comment = strip_tags(trim(substr($value['comment_content'],0,50)));
				$x = strpos(strrev($comment)," ");
			 	$length = strlen($comment) - $x - 1;
	 			$comment = substr($comment,0,$length);

				$data['comment_posting'][$row]['comment'] =  auto_link(parse_smileys(htmlspecialchars($value['comment_content']),config_item('base_url').'/files/smileys/'), 'both', TRUE);
				$date = explode(" ",$value['comment_date']);
				$time = explode(":",$date[1]);
				$data['comment_posting'][$row]['date'] = $this->IndonesianDate($date[0]). '<br /> Pukul '.$time[0].':'.$time[1];
				$email = $value['comment_email'];
				$default = config_item('base_url').'/files/images/avatar.jpg';
				$size = 50;
				$grav_url = "http://www.gravatar.com/avatar.php?gravatar_id=".md5( strtolower($email) )."&default=".urlencode($default)."&size=".$size;
				$data['comment_posting'][$row]['avatar'] = "<img src='".$grav_url."' align='middle' style='margin-right: 10px'>";
			}
		}
				$data['page_nav'] = $this->pagination->create_links();
		}
		else {
				$data['comment_posting'] = array();
		}
		return ($data);
	}

	function komentar_posting_selected_process($user, $data)
	{
		$this->load_db($user);
		foreach($data['confirm'] as $id) 
		{
		if (!empty($data['process_confirm'])) 
		{
			$query = $this->db->query("select comment_approval as current_confirm from t_comments where comment_id = '$id'");
			$row = $query->row_array(0);
			$current_confirm = $row['current_confirm'];
			if ($current_confirm=='0') $new_confirm = '1';
			if ($current_confirm=='1') $new_confirm = '0';
			$data_komentar = array(
								'comment_approval' => $new_confirm
							);
			$query = $this->db->update('t_comments', $data_komentar, array('comment_id' => $id));
		}
		else {
			$query = $this->db->delete('t_comments', array('comment_id' => $id));
		}
		}
		$return_value = array('posting_id' => $data['posting_id'], 'page' => $data['page']);
		return ($return_value);
	}

	function komentar_posting_delete($user, $id)
	{
		$this->load_db($user);
		$query = $this->db->query("select posting_id as posting_id from t_posting,t_comments where posting_id = comment_posting_id and comment_id = '$id'");
		$row = $query->row_array(0);
		$posting_id = $row['posting_id'];
 		$query = $this->db->delete('t_comments', array('comment_id' => $id)); 
		return $posting_id;
	}

//------------------------------------------------------------------------------------------------------------------------




//--------------------------------------PROFIL-----------------------------------------------------------------------------
	function get_profile($user)
	{
		$this->load_db($user);
		$query = $this->db->query("select * from t_application");
		$result = $query->result_array();
		if (!empty($result)) {
			$data['app_title'] = $result[0]['app_title'];
			$data['app_slogan'] = $result[0]['app_slogan'];
			$data['app_author'] = $result[0]['app_author'];
			$data['app_email'] = $result[0]['app_email'];
			$data['app_footer'] = $result[0]['app_footer'];

			if ($result[0]['app_use_loginform'] == '1') 
			{
				$data['app_use_loginform0'] = 'checked';
				$data['app_use_loginform1'] = '';
			}	
			else {
				$data['app_use_loginform0'] = '';
				$data['app_use_loginform1'] = 'checked';
			}

			if ($result[0]['app_use_tagscloud'] == '1') 
			{
				$data['app_use_tagscloud0'] = 'checked';
				$data['app_use_tagscloud1'] = '';
			}	
			else {
				$data['app_use_tagscloud0'] = '';
				$data['app_use_tagscloud1'] = 'checked';
			}

			if ($result[0]['app_use_polling'] == '1') 
			{
				$data['app_use_polling0'] = 'checked';
				$data['app_use_polling1'] = '';
			}	
			else {
				$data['app_use_polling0'] = '';
				$data['app_use_polling1'] = 'checked';
			}

			if ($result[0]['app_gb_approval'] == '0') 
			{
				$data['app_gb_approval0'] = 'checked';
				$data['app_gb_approval1'] = '';
			}	
			else {
				$data['app_gb_approval0'] = '';
				$data['app_gb_approval1'] = 'checked';
			}
			if ($result[0]['app_comment_approval'] == '0') 
			{
				$data['app_comment_approval0'] = 'checked';
				$data['app_comment_approval1'] = '';
			}	
			else {
				$data['app_comment_approval0'] = '';
				$data['app_comment_approval1'] = 'checked';
			}
			return ($data);
		}
		else {
			$data['app_title'] = '';
			$data['app_slogan'] = '';
			$data['app_email'] = '';
			$data['app_gb_approval'] = '';
		}
		return ($data);
	}

	function profile_edit($user, $data)
	{
		$this->load_db($user);
		$query = $this->db->update('t_application', $data);
		return ($query);
	}


//-------------------------------------------------------------------------------------------------------------------


//--------------------------------------GUESTBOOK-----------------------------------------------------------------------------
	function get_guestbook_list($user)
	{
		$this->load->helper('url');
		$this->load->helper('smiley');
		$this->load_db($user);
		$sql = "select * from t_guestbook order by gb_date desc";
		$query = $this->db->query("select count(gb_id) as jum from t_guestbook");
		$row = $query->row_array(0);
		$count = $row['jum'];
		$data = $this->pagination_model->paging(config_item('index_page')."/cpm/guestbook",3, $sql, $count, 10, 2);
		if (!empty($data['result'])) {
		$data['guestbook_selected_process'] = config_item('base_url').config_item('index_page').'/cpm/guestbook_selected_process';
		foreach ($data as $key=>$entry) {
			foreach($data['result'] as $row=>$value) 
			{
				$data['guestbook_list'][$row]['id'] = $value['gb_id'];
				if (trim($value['gb_site'])!='http://' & trim($value['gb_site'])!='')
					$data['guestbook_list'][$row]['name'] = "<a href='".$value['gb_site']."' target='_blank'><u>".$value['gb_name']."</u></a>";
				else 
					$data['guestbook_list'][$row]['name'] = $value['gb_name'];
				$data['guestbook_list'][$row]['url action'] = "<a href='".reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/guestbook_delete/'.$value['gb_id']."/")."' onClick=\"return confirm('Apakah Anda yakin akan menghapus data buku tamu ini?')\"><img src='".config_item('base_url')."/files/admin/images/delete.gif'></a>";
				$data['guestbook_list'][$row]['message'] = $value['gb_message'];

				if ($value['gb_approval']=='0') $data['guestbook_list'][$row]['alert'] = 'table-common-alert';
				else $data['guestbook_list'][$row]['alert'] = '';

				$message = strip_tags(trim(substr($value['gb_message'],0,50)));
				$x = strpos(strrev($message)," ");
			 	$length = strlen($message) - $x - 1;
	 			$message = substr($message,0,$length);

				$data['guestbook_list'][$row]['message'] =  auto_link(parse_smileys(htmlspecialchars($value['gb_message']),config_item('base_url').'/files/smileys/'), 'both', TRUE);
				$date = explode(" ",$value['gb_date']);
				$time = explode(":",$date[1]);
				$data['guestbook_list'][$row]['date'] = $this->IndonesianDate($date[0]). '<br /> Pukul '.$time[0].':'.$time[1];
				$email = $value['gb_email'];
				$data['guestbook_list'][$row]['email_guestbook'] = $value['gb_email'];
				$default = config_item('base_url').'/files/images/avatar.jpg';
				$size = 50;
				$grav_url = "http://www.gravatar.com/avatar.php?gravatar_id=".md5( strtolower($email) )."&default=".urlencode($default)."&size=".$size;
				$data['guestbook_list'][$row]['avatar'] = "<img src='".$grav_url."' align='middle' style='margin-right: 10px'>";
			}
		}
				$data['page_nav'] = $this->pagination->create_links();
		}
		else {
				$data['guestbook_list'] = array();
		}
		return ($data);
	}

	function guestbook_selected_process($user, $data)
	{
		$this->load_db($user);
		foreach($data['confirm'] as $id)
		{
		if (!empty($data['process_confirm'])) 
		{
			$query = $this->db->query("select gb_approval as current_confirm from t_guestbook where gb_id = '$id'");
			$row = $query->row_array(0);
			$current_confirm = $row['current_confirm'];
			if ($current_confirm=='0') $new_confirm = '1';
			if ($current_confirm=='1') $new_confirm = '0';
			$data_komentar = array(
								'gb_approval' => $new_confirm
							);
			$query = $this->db->update('t_guestbook', $data_komentar, array('gb_id' => $id));
		}
		else {
			$query = $this->db->delete('t_guestbook', array('gb_id' => $id));
		}
		}
		return ($data['page']);
	}

	function guestbook_delete($user, $id)
	{
		$this->load_db($user);
 		$query = $this->db->delete('t_guestbook', array('gb_id' => $id)); 
		return;
	}

//------------------------------------------------------------------------------------------------------------------------






//--------------------------------------DESKRIPSI BLOG-----------------------------------------------------------------------------
	function get_deskripsi_blog($user)
	{
		$this->load_db($user);
		$query = $this->db->query("select * from t_description where desc_username = '".$user."'");
		$result['description'] = $query->result_array();
		if (!empty($result['description'])) {
			$data['description'] = $result['description'][0]['desc_description'];
			return ($data);
		}
		else {
			$data['description'] = '';
			exit;
		}
		return ($data);
	}

	function deskripsi_edit($user, $data)
	{
		$this->load_db($user);
		if (empty($data['desc_description']) | trim($data['desc_description']) == '') return;
		$query = $this->db->update('t_description', $data, array('desc_username' => $user));
		return ($query);
	}

//------------------------------------------------------------------------------------------------------------------------


//--------------------------------------JUDUL BLOG-----------------------------------------------------------------------------
	function get_application_blog($user)
	{
		$this->load_db($user);
		$query = $this->db->query("select * from t_application where title_username = '".$user."'");
		$result['title'] = $query->result_array();
		if (!empty($result['title'])) {
			$data['title'] = $result['title'][0]['title_title'];
			return ($data);
		}
		else {
			$data['title'] = '';
			exit;
		}
		return ($data);
	}

	function title_edit($user, $data)
	{
		$this->load_db($user);
		if (empty($data['title_title']) | trim($data['title_title']) == '') return;
		$query = $this->db->update('t_application', $data, array('title_username' => $user));
		return ($query);
	}

//------------------------------------------------------------------------------------------------------------------------



//--------------------------------------SIDEBAR BLOG-----------------------------------------------------------------------------
	function get_sidebar_blog($user)
	{
		$this->load_db($user);
		$query = $this->db->query("select * from t_user where userName = '".$user."'");
		$result['sidebar'] = $query->result_array();
		if (!empty($result['sidebar'])) {
			$data['sidebar'] = htmlspecialchars($result['sidebar'][0]['userSidebar']);
			return ($data);
		}
		else {
			$data['sidebar'] = '';
			exit;
		}
		return ($data);
	}

	function sidebar_edit($user, $data)
	{
		$this->load_db($user);
		$query = $this->db->update('t_user', $data, array('userName' => $user));
		return ($query);
	}

//------------------------------------------------------------------------------------------------------------------------


//--------------------------------------BOTTOM BLOG-----------------------------------------------------------------------------
	function get_bottom_blog($user)
	{
		$this->load_db($user);
		$query = $this->db->query("select * from t_user where userName = '".$user."'");
		$result['bottom'] = $query->result_array();
		if (!empty($result['bottom'])) {
			$data['bottom'] = htmlspecialchars($result['bottom'][0]['userBottom']);
			return ($data);
		}
		else {
			$data['bottom'] = '';
			exit;
		}
		return ($data);
	}

	function bottom_edit($user, $data)
	{
		$this->load_db($user);
		$query = $this->db->update('t_user', $data, array('userName' => $user));
		return ($query);
	}

//------------------------------------------------------------------------------------------------------------------------




//--------------------------------------THEMES-----------------------------------------------------------------------------
	function get_themes($user)
	{
		$this->load->helper('directory');
		$this->load_db($user);
		$query = $this->db->query("select * from t_application");
		$result = $query->result_array();
		if (!empty($result)) {
			$data['current_theme'] = $result[0]['app_theme'];
		}
		else {
			$data['current_theme'] = '';
		}

		$themes = directory_map('./system/application/views/themes', TRUE);
		$i=0;
		foreach ($themes as $value) {
			if (is_dir('./system/application/views/themes/'.$value)) 
			{
				$data['themes'][$i]['app_theme'] = $value;
				if ($data['current_theme'] == $value) $data['themes'][$i]['selected'] = 'selected';
				else $data['themes'][$i]['selected'] = '';
				$i++;
			}
		}
		return ($data);
	}

	function theme_edit($user, $data)
	{
		$this->load_db($user);
		$query = $this->db->update('t_application', $data);
		return ($query);
	}

//------------------------------------------------------------------------------------------------------------------------

	function get_menu_category($user)
	{
		$this->load_db($user);
		$query2 = $this->db->query("select * FROM t_category where category_type='menu' order by category_id");
		$result['mr2'] = $query2->result_array();
		if (!empty($result['mr2'])) {
			foreach($result['mr2'] as $row=>$value) {
				$data['multiple record category'][$row]['mr_id'] = $value['category_id'];
				$data['multiple record category'][$row]['mr_name'] = $value['category_name'];
			}
		}
		else {
				$data['multiple record category'][0]['mr_id'] = '';
				$data['multiple record category'][0]['mr_name'] = '';
		}
		return ($data);
	}

	function get_post_category($user)
	{
		$this->load_db($user);
		$query2 = $this->db->query("select * FROM t_category where category_type='post' order by category_id");
		$result['mr2'] = $query2->result_array();
		if (!empty($result['mr2'])) {
			foreach($result['mr2'] as $row=>$value) {
				$data['multiple record category'][$row]['mr_id'] = $value['category_id'];
				$data['multiple record category'][$row]['mr_name'] = $value['category_name'];
			}
		}
		else {
				$data['multiple record category'][0]['mr_id'] = '';
				$data['multiple record category'][0]['mr_name'] = '';
		}

		$query = $this->db->query("select * FROM t_tags");
		$result = $query->result_array();
		if (!empty($result)) {
			foreach($result as $row=>$value)
			{
				$query = $this->db->query("select count(tag_posting_id) as jum FROM t_posting_tag where posting_tag = '".$value['tag_name']."'");
				$row_tag = $query->row_array(0);
				$count = $row_tag['jum'];
				$data['tag'][$row]['count'] = $count;
				$data['tag'][$row]['name'] = $value['tag_name'];
			}
		}
		return ($data);
	}

	function get_common_data($user)
	{
		$data['base_url'] = config_item('base_url');
		return ($data);
	}
	
	
//--------------------------------------Thuongdd------------------------------------------------------------------------------------
	
//--------------------------------------Services-----------------------------------------------------------------------------
	
	function get_services_list($user)
	{
		$this->load_db($user);
		if (trim($_POST['post_search'])!='') {
			$search = $_POST['post_search'];
			$post_search_string = " and (services_title like '%$search%' or services_content like '%$search%' ) ";
			$this->session->set_userdata('post_search_string',$post_search_string);
			$this->session->set_userdata('post_search_key',$search);
		}
		if (!empty($_POST['post_search_submit']) & trim($_POST['post_search'])=='') {
			$this->session->unset_userdata('post_search_string');
			$this->session->unset_userdata('post_search_key');
		}
		
		$sql = "select * FROM t_services where service_category_id >0  ". $this->session->userdata('post_search_string')." order by service_date desc";
		//echo $sql;
		//die;
		$query = $this->db->query("select count(service_id) as jum FROM t_services where service_category_id >0 ". $this->session->userdata('post_search_string')." order by service_date desc");
		$row = $query->row_array(0);
		$count = $row['jum'];
		$data = $this->pagination_model->paging(config_item('index_page').'/cpm/services/',3, $sql, $count, 10, 2);
		if (!empty($data['result'])) {
		foreach ($data as $key=>$entry) {
			foreach ($entry as $row=>$value) {
				$data['multiple record last posted list index'][$row]['no'] = ($row + 1);

				$x = explode(".",$value['service_image']);
				$ext = $x[count($x)-1];
				$y = explode(".".$ext,$value['service_image']);
				$thumbnail_file = config_item('base_url')."/userfiles/image/services/".$y[0]."_thumb.".$ext;
				$data['multiple record last posted list index'][$row]['mrc_image'] = $thumbnail_file;

				$data['multiple record last posted list index'][$row]['mrc_date'] = $this->IndonesianDate($value['service_date']);
				$data['multiple record last posted list index'][$row]['mrc_title'] = $value['service_title'];
				$data['multiple record last posted list index'][$row]['mr_name'] = $value['service_category_id'];
				$data['multiple record last posted list index'][$row]['posted_by'] = $value['service_by'];

				// Ambil jumlah komentar
				$query_comment = $this->db->query("select count(comment_id) as jum from t_comments where comment_posting_id='".$value['posting_id']."'");
				$row_comment = $query_comment->row_array(0);
				$comment_count = $row_comment['jum'];
				if ($comment_count>0)
				{
					$comment_link = 
					"<a href='".reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/komentar_posting/'.$value['posting_id']."/")."'>
					<img src='".config_item('base_url')."/files/admin/images/comment.gif'> &nbsp;".$comment_count." Comments</a>";
				}
				else
				{
					$comment_link = 
					"<a href='#'>
					<img src='".config_item('base_url')."/files/admin/images/comment.gif'> &nbsp;".$comment_count." Comments</a>";
				}

				$data['multiple record last posted list index'][$row]['url action'] = 
				$comment_link.
				"<a href='".reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/services_form_edit/'.$value['service_id']."/")."'>
				<img src='".config_item('base_url')."/files/admin/images/edit.gif'></a>
				<a href='".reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/services_delete/'.$value['service_id']."/")."' onClick=\"return confirm('Are you sure you want to delete this services?')\">
				<img src='".config_item('base_url')."/files/admin/images/delete.gif'></a>";
				
				if ($value['posting_visible']=='0') $data['multiple record last posted list index'][$row]['alert'] = 'table-common-alert';
				else $data['multiple record last posted list index'][$row]['alert'] = '';

				$content = strip_tags(trim(substr($value['service_content'],0,200)));
				$x = strpos(strrev($content)," ");
			 	$length = strlen($content) - $x - 1;
	 			$content = substr($content,0,$length);

				$data['multiple record last posted list index'][$row]['mrc_content'] = $content.'...';

				$data['page_nav'] = $this->pagination->create_links();
			}
		}
		}
		else {
				$data['multiple record last posted list index'][0]['no'] = '...';
				$data['multiple record last posted list index'][0]['url action'] = '...';
				$data['multiple record last posted list index'][0]['mr_name'] = '...';
				$data['multiple record last posted list index'][0]['mrc_mr_id '] = '';
				$data['multiple record last posted list index'][0]['mrc_date'] = '';
				$data['multiple record last posted list index'][0]['mrc_title'] ='...';
				$data['multiple record last posted list index'][0]['mrc_content'] ='...';
				$data['multiple record last posted list index'][0]['posted_by'] ='';
				$data['multiple record last posted list index'][0]['comment_count'] ='';
				$data['multiple record last posted list index'][0]['index_comment_count'] = '';
				$data['page_nav'] = $this->pagination->create_links();
		}
		$data['url insert'] = reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/services_form_insert/');
		return ($data);
	}

	function get_services_detil($user,$id)
	{
		$this->load_db($user);
		$query = $this->db->query("select * FROM t_services where service_id = '$id'");
		$result['mr'] = $query->result_array();
		if (!empty($result['mr'])) {
			$x = explode(".",$result['mr'][0]['service_image']);
			$ext = $x[count($x)-1];
			$y = explode(".".$ext,$result['mr'][0]['service_image']);
			$thumbnail_file = config_item('base_url')."/userfiles/image/services/".$y[0]."_thumb.".$ext;
			$data['mrc_image'] = $result['mr'][0]['service_image'];
			$data['mrc_thumbnail'] = $thumbnail_file;

			$data['multiple record mrc_id'] = $result['mr'][0]['service_id'];
			$data['multiple record mrc_mr_id'] = $result['mr'][0]['service_id'];
			$data['multiple record mrc_title'] = $result['mr'][0]['service_title'];
			$data['multiple record mrc_seo'] = $result['mr'][0]['service_seo'];
			$data['multiple record mrc_date'] = $result['mr'][0]['service_date'];
			$data['multiple_record_mrc_content'] = $result['mr'][0]['service_content'];
			$data['multiple_record_mrc_thumbnail'] = $result['mr'][0]['service_image'];
			$data['multiple_record_mrc_visible'] = $result['mr'][0]['service_visible'];
			$data['multiple_record_mrc_comment_status'] = $result['mr'][0]['service_comment_status'];
			//print_r($data);

			return ($data);
		}
		else {
			$data['multiple record id'] = '';
			$data['multiple record mrc_mr_id'] = '';
			$data['multiple record mrc_title'] = '';
			$data['multiple_record_mrc_content'] = '';
			$data['multiple_record_mrc_thumbnail'] = '';
			$data['multiple_record_mrc_visible'] = '';
			$data['multiple_record_mrc_comment_status'] = '';
		}
		return ($data);
	}

	function services_insert($user, $data)
	{
		$this->load_db($user);
		if (trim($data['mrc_title'])=='' | empty($data['mrc_mr_id']) | trim($data['mrc_mr_id']) == '') return;
		if (trim($_FILES['mrc_thumbnail']['name'])=='') $image = '';
		else $image = $_FILES['mrc_thumbnail']['name'];
		$data_mr = array(
							'service_category_id' => $data['mrc_mr_id'],
							'service_title' => $data['mrc_title'],
							'service_seo' => $data['mrc_seo'],
							'service_type' => 'post',
							'service_date' => $data['mrc_date'],
							'service_content' => $data['FCKeditor1'],
							'service_image' => $image,
							'service_visible' =>  $data['mrc_visibile'],
							'service_comment_status' =>  $data['mrc_comment_status']
						);
		//echo "<pre>"; print_r($data_mr); echo"</pre>";
						
		$query = $this->db->insert('t_services', $data_mr);
		if ($query) 
		{
			if (!empty($_FILES['mrc_thumbnail']['tmp_name'])) {
				$filename = "./userfiles/image/services/".$image;
				copy($_FILES['mrc_thumbnail']['tmp_name'], $filename);

				$x = explode(".",$image);
				$ext = $x[count($x)-1];
				$y = explode(".".$ext,$image);
				$thumbnail_file = "./userfiles/image/services/".$y[0]."_thumb.".$ext;
				copy($_FILES['mrc_thumbnail']['tmp_name'], $thumbnail_file);

				$config['image_library'] = 'gd2';
				$config['source_image'] = $filename;
				$config['maintain_ratio'] = TRUE;
				$config['width'] = 200;
				$config['height'] = 200;
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
			
		}
		return;
	}

	function services_edit($user, $data)
	{
		$this->load_db($user);

		$query = $this->db->query("select service_image as image FROM t_services where service_id = '".$data['mrc_id']."'");
		$row = $query->row_array(0);
		$current_image = "./userfiles/image/services/".$row['image'];

		$x = explode(".",$row['image']);
		$ext = $x[count($x)-1];
		$y = explode(".".$ext,$row['image']);
		$current_thumbnail = "./userfiles/image/services/".$y[0]."_thumb.".$ext;

		$id = $data['mrc_id'];
		if (trim($data['mrc_title'])=='' | empty($data['mrc_mr_id']) | trim($data['mrc_mr_id']) == '') return;
		if (empty($data['mrc_mr_id']) | trim($data['mrc_mr_id']) == '') return;
		if (trim($_FILES['mrc_thumbnail']['name'])=='') $image = $data['mrc_current_thumbnail'];
		else $image = $_FILES['mrc_thumbnail']['name'];
		$data_mr = array(
							'service_category_id' => $data['mrc_mr_id'],
							'service_title' => $data['mrc_title'],
							'service_seo' => $data['mrc_seo'],
							'service_date' => $data['mrc_date'],
							'service_content' => $data['FCKeditor1'],
							'service_image' => $image,
							'service_visible' =>  $data['mrc_visibile'],
							'service_comment_status' =>  $data['mrc_comment_status']
						);
		//echo "<pre>"; print_r($data_mr); echo"</pre>";
		$query = $this->db->update('t_services', $data_mr, array('service_id' => $id));
		if ($query) 
		{
			if (!empty($_FILES['mrc_thumbnail']['tmp_name'])) {
				if (file_exists($current_image)) {
					@unlink($current_image);
					@unlink($current_thumbnail);
				}

				$filename = "./userfiles/image/services/".$image;
				copy($_FILES['mrc_thumbnail']['tmp_name'], $filename);

				$x = explode(".",$image);
				$ext = $x[count($x)-1];
				$y = explode(".".$ext,$image);
				$thumbnail_file = "./userfiles/image/services/".$y[0]."_thumb.".$ext;
				copy($_FILES['mrc_thumbnail']['tmp_name'], $thumbnail_file);

				$config['image_library'] = 'gd2';
				$config['source_image'] = $filename;
				$config['maintain_ratio'] = TRUE;
				$config['width'] = 200;
				$config['height'] = 200;
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
		}
		return ($query);
	}

	function services_delete($user, $id)
	{
		$this->load_db($user);
		$query = $this->db->query("select service_image as image FROM t_services where service_id = '$id'");
		$row = $query->row_array(0);
			
		$current_image = "./userfiles/image/services/".$row['image'];
		$x = explode(".",$row['image']);
		$ext = $x[count($x)-1];
		$y = explode(".".$ext,$row['image']);
		$current_thumbnail = "./userfiles/image/services/".$y[0]."_thumb.".$ext;
		if (@file_exists($current_image)) {
			@unlink($current_image);
			@unlink($current_thumbnail);
		}
		$query = $this->db->delete('t_services', array('service_id' => $id)); 
		return;
	}
 #-----------------------------------------End module services-----------------------------------------------------------------
 
 #-----------------------------------------Load function off all module-----------------------------------------------------------------


	function get_script($ctype,$user,$id=0)
	{		
		$common_data = $this->get_common_data($user);
		
		if ($ctype=='panel_list') $panel_list = $this->get_panel_list($user);
		else $panel_list = array();

		if ($ctype=='panel_edit') $panel_detil = $this->get_panel_detil($user,$id);
		else $panel_detil = array();

		if ($ctype=='user_list') $user_list = $this->user_model->get_user_list($user);
		else $user_list = array();

		if ($ctype=='user_edit') $user_detil = $this->user_model->get_user_detil($user,$id);
		else $user_detil = array();

		if ($ctype=='halaman_list') $halaman_list = $this->get_halaman_list($user);
		else $halaman_list = array();

		if ($ctype=='halaman_edit') $halaman_detil = $this->get_halaman_detil($user,$id);
		else $halaman_detil = array();

		if ($ctype=='groupmenu_list') $groupmenu_list = $this->get_groupmenu_list($user);
		else $groupmenu_list = array();

		if ($ctype=='groupmenu_edit') $groupmenu_detil = $this->get_groupmenu_detil($user,$id);
		else $groupmenu_detil = array();

		if ($ctype=='category_list') $category_list = $this->get_category_list($user);
		else $category_list = array();

		if ($ctype=='category_edit') $category_detil = $this->get_category_detil($user,$id);
		else $category_detil = array();

		if ($ctype=='menu_list') $menu_list = $this->get_menu_list($user);
		else $menu_list = array();

		if ($ctype=='menu_form_insert') $menu_form_insert = $this->get_menu_category($user);
		else $menu_form_insert = array();

		if ($ctype=='menu_edit') $menu_detil = $this->get_menu_detil($user,$id);
		else $menu_detil = array();

		if ($ctype=='posting_list') $posting_list = $this->get_posting_list($user);
		else $posting_list = array();

		if ($ctype=='posting_form_insert') $posting_form_insert = $this->get_post_category($user);
		else $posting_form_insert = array();

		if ($ctype=='posting_edit') $posting_detil = $this->get_posting_detil($user,$id);
		else $posting_detil = array();

		if ($ctype=='komentar_posting') $komentar_posting_list = $this->get_comments_posting_list($user,$id);
		else $komentar_posting_list = array();

		if ($ctype=='komentar_halaman') $komentar_halaman_list = $this->get_comments_halaman_list($user);
		else $komentar_halaman_list = array();

		if ($ctype=='profile') $profile = $this->get_profile($user);
		else $profile = array();

		
		if ($ctype=='themes') $themes = $this->get_themes($user);
		else $themes = array();
		

		if ($ctype=='album_list') $album_list = $this->album_model->get_album_list($user);
		else $album_list = array();

		if ($ctype=='album_edit') {
			$album_detil = $this->album_model->get_album_detil($user,$id);
		}
		else {
			$album_detil = array();
		}

		if ($ctype=='guestbook') $guestbook = $this->get_guestbook_list($user);
		else $guestbook = array();
		
		//print_r($ctype);
		if ($ctype=='services_list') 
			$services_list = $this->get_services_list($user);
		else 
			$services_list = array();

		if ($ctype=='services_form_insert') 
			$services_form_insert = $this->get_post_category($user);
		else 
			$services_form_insert = array();

		if ($ctype=='services_edit') 
			$services_detil = $this->get_services_detil($user,$id);
		else 
			$services_detil = array();

		if ($ctype=='polling_list') $polling_list = $this->polling_model->get_polling_list($user);
		else $polling_list = array();

		if ($ctype=='polling_edit') {
			$polling_detil = $this->polling_model->get_polling_detil($user,$id);
		}
		else {
			$polling_detil = array();
		}


		$return_value = array_merge(
									$common_data,
									$menu_form_insert,
									$posting_form_insert,
									$panel_list,
									$panel_detil,
									$user_list,
									$user_detil,
									$halaman_list,
									$halaman_detil,
									$groupmenu_list,
									$groupmenu_detil,
									$category_list,
									$category_detil,
									$menu_list,
									$menu_detil,
									$posting_list,
									$posting_detil,
									$komentar_posting_list,
									$guestbook,
									$album_list,
									$album_detil,
									$polling_list,
									$polling_detil,
									$komentar_halaman_list,
									$profile,
									$themes,
									$services_list,
									$services_form_insert,
									$services_detil
									);
		return ($return_value);
	}

}
?>