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
class Search extends Model {

    function Search()
    {
        parent::Model();
    }

	function get_search_param()
	{
		$data['search_input_name'] = 'keyword';
		$data['search_url'] = reduce_double_slashes(config_item('base_url').config_item('index_page').'/search/');
		return ($data);
	}

	function get_items($post)
	{
		$this->load->helper('text');
		$keyword = $this->db->escape_str($post['keyword']);
		//if (trim($keyword)=='') return array();
		$query = $this->db->query("SELECT * FROM t_posting
								   WHERE posting_title LIKE '%$keyword%'
								   OR posting_content LIKE '%$keyword%'
								   ORDER BY posting_date DESC
								   LIMIT 0,10");
		$result['search_items'] = $query->result_array();
		if (trim($keyword)!='' & !empty($result['search_items'])) {
			foreach($result['search_items'] as $row=>$value) 
			{
				$data['search_items'][$row]['posting_id'] = $value['posting_id'];
				$data['search_items'][$row]['posting_date'] = $this->date->IndonesianDate($value['posting_date']);
				$data['search_items'][$row]['posting_title'] = highlight_phrase($value['posting_title'], $keyword, '<span style="background:yellow">', '</span>');
   			    $mulai = strpos(strtolower(strip_tags(trim($value['posting_content']))),$keyword);
				$content = strtolower(substr(strip_tags($value['posting_content']),$mulai,400));
				$content = str_replace('&nbsp',' ',$content);
				$content = highlight_phrase($content, $keyword, '<span style="background:yellow">', '</span>'); 
				//$content = str_replace($keyword,'<u>'.$keyword.'</u>',$content);
				$data['search_items'][$row]['posting_content'] = $content;
				$data['search_items'][$row]['posting_link'] = reduce_double_slashes(config_item('base_url').config_item('index_page').'/posting/'.$value['posting_id']);
			}
		}
		if (trim($keyword)=='' | empty($result['search_items'])) {
				$data['search_items'] = array();
		}
		return ($data);
	}



}
?>