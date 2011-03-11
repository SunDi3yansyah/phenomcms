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
class Panel extends Model {

    function Panel()
    {
        parent::Model();
    }

	function get_panel()
	{
		$query = $this->db->query("SELECT * FROM t_panel");
		$result = $query->result_array();
		if (!empty($result)) {
			foreach($result as $row=>$value) 
			{
				$nama = $value['panel_name'];
				$data[$nama.'_title'] = $value['panel_label'];
				$data[$nama.'_content'] = $value['panel_content'];
				$data[$nama.'_visible'] = $value['panel_visible'];
			}
		}
		else {
			return array();
		}
		return ($data);
	}




}
?>