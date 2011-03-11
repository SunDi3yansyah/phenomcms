<?php 
class Pagination_Model extends Model {

    function Pagination_Model()
    {
        parent::Model();
		$this->load->library('pagination');
    }

	function get_data($sql, $offset, $num)
	{
		$query = $this->db->query($sql." LIMIT $offset, $num");
		return ($query->result_array());
	}

	function paging($base_uri, $uri_segment, $sql, $count, $per_page, $num_links)
	{
		$config['base_url'] = $this->config->item('base_url').$base_uri;
		$config['uri_segment'] = $uri_segment;
		$config['full_tag_open'] = '<div id=link align=left>';
		$config['full_tag_close'] = '</div>';
		$config['next_link'] = 'Next &raquo;';
		$config['prev_link'] = '&laquo; Prev';
		$config['num_links'] = $num_links;
		$config['total_rows'] = $count;
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config); 

		$offset = $this->uri->segment($config['uri_segment']);
		if (empty($offset)) $offset = 0;

		$data['result'] = $this->get_data($sql, $offset, $config['per_page']);
		//print_r($data['result']);
		return ($data);
	}

}

?>