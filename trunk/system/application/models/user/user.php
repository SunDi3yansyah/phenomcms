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
				$data[$nama.' title'] = $value['panel_label'];
				$data[$nama.' content'] = $value['panel_content'];
			}
		}
		else {
			return;
		}
		return ($data);
	}




}
?>