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
class Feed extends Controller {

function Feed()
    {
        parent::Controller();
		$this->load->library('parser');
        $this->load->helper('xml');
        $this->load->model('user/feedmodel');
    }
    
    function index()
    {
        $recent = $this->feedmodel->get_recent_posts();  
		$feed_profile =  $this->feedmodel->get_feed_profile();
		$data = array_merge($recent, $feed_profile);
        header("Content-Type: application/rss+xml");
        $this->parser->parse('feed/feed', $data);
    }	

}
?>
