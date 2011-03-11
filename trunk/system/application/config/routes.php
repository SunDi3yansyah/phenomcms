<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
| 	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['scaffolding_trigger'] = 'scaffolding';
|
| This route lets you set a "secret" word that will trigger the
| scaffolding feature for added security. Note: Scaffolding must be
| enabled in the controller in which you intend to use it.   The reserved 
| routes must come before any wildcard or regular expression routes.
|
*/

$route['default_controller'] = "main";
$route['scaffolding_trigger'] = "";

$route['page/(:num)'] = "main/page/$1";

$route['menu/(:num)'] = "main/posting/$1";

$route['posting/(:num)'] = "main/posting/$1";
$route['posting/(:num)/(:num)'] = "main/posting/$1/$2";  // paging
$route['posting/(:num)/(:num)/(:any)'] = "main/posting/$1/$2/$3";  // paging

$route['tagged/(:any)'] = "main/tag/$1";
$route['tagged/(:any)/(:num)'] = "main/tag/$1/$2";  // paging
$route['tagged/(:any)/(:num)/(:any)'] = "main/tag/$1/$2/$3";  // paging

$route['category/(:num)'] = "main/category/$1/0";
$route['category/(:num)/(:num)'] = "main/category/$1";

$route['search'] = "main/search/";
$route['polling'] = "main/polling/";
$route['polling/(:num)'] = "main/polling/$1";

$route['gallery'] = "main/gallery";
$route['gallery/(:num)'] = "main/gallery/$1";
$route['album/(:num)'] = "main/album/$1";

$route['guestbook/(:num)'] = "main/guestbook/$1/0";
$route['guestbook/(:num)/(:num)'] = "main/guestbook/$1/$2";
$route['guestbook/(:num)/(:num)/(:any)'] = "main/guestbook/$1/$2/$3";

$route['send_comment'] = "main/insert_comment";
$route['send_polling'] = "main/send_polling";
$route['send_guestbook/(:num)'] = "main/send_guestbook/$1";




//------------------------Admin----------------------------------------------------
$route['cpm/login'] = "admin/depan/login";
$route['cpm/logout'] = "admin/depan/logout";


$route['cpm/directory/setting'] = "admin/direktori/setting";
$route['cpm/directory/menu'] = "admin/direktori/menu";
$route['cpm/directory/posting'] = "admin/direktori/posting";
$route['cpm/directory/modul'] = "admin/direktori/modul";
$route['cpm/directory/user'] = "admin/direktori/user";

$route['cpm/halaman'] = "admin/halaman/halaman_list";
$route['cpm/halaman_form_insert'] = "admin/halaman/halaman_form_insert";
$route['cpm/halaman_form_edit/(:num)'] = "admin/halaman/halaman_form_edit/$1";
$route['cpm/halaman_insert'] = "admin/halaman/halaman_insert";
$route['cpm/halaman_edit'] = "admin/halaman/halaman_edit";
$route['cpm/halaman_delete/(:num)'] = "admin/halaman/halaman_delete/$1";
$route['cpm/halaman_delete_image/(:num)'] = "admin/halaman/halaman_delete_image/$1";
$route['cpm/halaman_shiftup/(:num)'] = "admin/halaman/halaman_shiftup/$1";
$route['cpm/halaman_shiftdown/(:num)'] = "admin/halaman/halaman_shiftdown/$1";
$route['cpm/page_input/(:num)'] = "admin/halaman/page_input/$1";
$route['cpm/page_edit/(:num)'] = "admin/halaman/page_edit/$1";
$route['cpm/page_url_input/(:num)'] = "admin/halaman/page_url_input/$1";
$route['cpm/page_uri_input/(:num)'] = "admin/halaman/page_uri_input/$1";
$route['cpm/page_module_input/(:num)'] = "admin/halaman/page_module_input/$1";

$route['cpm/panel'] = "admin/panel/panel_list";
$route['cpm/panel_form_insert'] = "admin/panel/panel_form_insert";
$route['cpm/panel_form_edit/(:num)'] = "admin/panel/panel_form_edit/$1";
$route['cpm/panel_insert'] = "admin/panel/panel_insert";
$route['cpm/panel_edit'] = "admin/panel/panel_edit";
$route['cpm/panel_delete/(:num)'] = "admin/panel/panel_delete/$1";

$route['cpm/user'] = "admin/user/user_list";
$route['cpm/user_form_insert'] = "admin/user/user_form_insert";
$route['cpm/user_form_edit/(:num)'] = "admin/user/user_form_edit/$1";
$route['cpm/user_insert'] = "admin/user/user_insert";
$route['cpm/user_edit'] = "admin/user/user_edit";
$route['cpm/user_delete/(:num)'] = "admin/user/user_delete/$1";

$route['cpm/kategori'] = "admin/kategori/category_list";
$route['cpm/category_form_insert'] = "admin/kategori/category_form_insert";
$route['cpm/category_form_edit/(:num)'] = "admin/kategori/category_form_edit/$1";
$route['cpm/category_insert'] = "admin/kategori/category_insert";
$route['cpm/category_edit'] = "admin/kategori/category_edit";
$route['cpm/category_delete/(:num)'] = "admin/kategori/category_delete/$1";
$route['cpm/category_shiftup/(:num)'] = "admin/kategori/category_shiftup/$1";
$route['cpm/category_shiftdown/(:num)'] = "admin/kategori/category_shiftdown/$1";

$route['cpm/posting'] = "admin/posting/posting_list";
$route['cpm/posting/(:num)'] = "admin/posting/posting_list/$1";  // paging
$route['cpm/posting_form_insert'] = "admin/posting/posting_form_insert";
$route['cpm/posting_form_insert_html'] = "admin/posting/posting_form_insert_html";
$route['cpm/posting_form_edit/(:num)'] = "admin/posting/posting_form_edit/$1";
$route['cpm/posting_form_edit_html/(:num)'] = "admin/posting/posting_form_edit_html/$1";
$route['cpm/posting_insert'] = "admin/posting/posting_insert";
$route['cpm/posting_edit'] = "admin/posting/posting_edit";
$route['cpm/posting_delete/(:num)'] = "admin/posting/posting_delete/$1";
$route['cpm/posting_delete_image/(:num)'] = "admin/posting/posting_delete_image/$1";
$route['cpm/komentar_posting/(:num)'] = "admin/komentar_posting/komentar_posting_list/$1";
$route['cpm/komentar_posting/(:num)/(:num)'] = "admin/komentar_posting/komentar_posting_list/$1/$2";  // paging
$route['cpm/komentar_posting_selected_process'] = "admin/komentar_posting/komentar_posting_selected_process";
$route['cpm/komentar_posting_delete/(:num)'] = "admin/komentar_posting/komentar_posting_delete/$1";


$route['cpm/groupmenu'] = "admin/groupmenu/groupmenu_list";
$route['cpm/groupmenu_form_insert'] = "admin/groupmenu/groupmenu_form_insert";
$route['cpm/groupmenu_form_edit/(:num)'] = "admin/groupmenu/groupmenu_form_edit/$1";
$route['cpm/groupmenu_insert'] = "admin/groupmenu/groupmenu_insert";
$route['cpm/groupmenu_edit'] = "admin/groupmenu/groupmenu_edit";
$route['cpm/groupmenu_delete/(:num)'] = "admin/groupmenu/groupmenu_delete/$1";
$route['cpm/groupmenu_shiftup/(:num)'] = "admin/groupmenu/groupmenu_shiftup/$1";
$route['cpm/groupmenu_shiftdown/(:num)'] = "admin/groupmenu/groupmenu_shiftdown/$1";

$route['cpm/menu'] = "admin/menu/menu_list";
$route['cpm/menu/(:num)'] = "admin/menu/menu_list/$1";  // paging
$route['cpm/menu_form_insert'] = "admin/menu/menu_form_insert";
$route['cpm/menu_form_insert_html'] = "admin/menu/menu_form_insert_html";
$route['cpm/menu_form_edit/(:num)'] = "admin/menu/menu_form_edit/$1";
$route['cpm/menu_form_edit_html/(:num)'] = "admin/menu/menu_form_edit_html/$1";
$route['cpm/menu_insert'] = "admin/menu/menu_insert";
$route['cpm/menu_edit'] = "admin/menu/menu_edit";
$route['cpm/menu_delete/(:num)'] = "admin/menu/menu_delete/$1";
$route['cpm/menu_delete_image/(:num)'] = "admin/menu/menu_delete_image/$1";
$route['cpm/menu_shiftup/(:num)'] = "admin/menu/menu_shiftup/$1";
$route['cpm/menu_shiftdown/(:num)'] = "admin/menu/menu_shiftdown/$1";
$route['cpm/menu_input/(:num)'] = "admin/menu/menu_input/$1";
$route['cpm/menu_link_edit/(:num)'] = "admin/menu/menu_link_edit/$1";
$route['cpm/menu_url_input/(:num)'] = "admin/menu/menu_url_input/$1";
$route['cpm/menu_uri_input/(:num)'] = "admin/menu/menu_uri_input/$1";
$route['cpm/menu_module_input/(:num)'] = "admin/menu/menu_module_input/$1";

$route['cpm/guestbook'] = "admin/guestbook/guestbook_list";
$route['cpm/guestbook/(:num)'] = "admin/guestbook/guestbook_list/$1";  // paging
$route['cpm/guestbook_selected_process'] = "admin/guestbook/guestbook_selected_process";
$route['cpm/guestbook_delete/(:num)'] = "admin/guestbook/guestbook_delete/$1";

$route['cpm/album'] = "admin/album/album_list";
$route['cpm/album/(:num)'] = "admin/album/album_list/$1";  // paging
$route['cpm/album_form_insert'] = "admin/album/album_form_insert";
$route['cpm/album_form_edit/(:num)'] = "admin/album/album_form_edit/$1";
$route['cpm/album_insert'] = "admin/album/album_insert";
$route['cpm/album_edit'] = "admin/album/album_edit";
$route['cpm/album_delete/(:num)'] = "admin/album/album_delete/$1";

$route['cpm/photo_insert/(:num)'] = "admin/album/photo_insert/$1";
$route['cpm/photo_process/(:num)'] = "admin/album/photo_process/$1";
$route['cpm/photo_delete/(:num)/(:num)'] = "admin/album/photo_delete/$1/$2";
$route['cpm/photo_thumbnail/(:num)/(:num)'] = "admin/album/photo_thumbnail/$1/$2";
$route['cpm/photo_shiftup/(:num)/(:num)'] = "admin/album/photo_shiftup/$1/$2";
$route['cpm/photo_shiftdown/(:num)/(:num)'] = "admin/album/photo_shiftdown/$1/$2";


$route['cpm/polling'] = "admin/polling/polling_list";
$route['cpm/polling/(:num)'] = "admin/polling/polling_list/$1";  // paging
$route['cpm/polling_form_insert'] = "admin/polling/polling_form_insert";
$route['cpm/polling_form_edit/(:num)'] = "admin/polling/polling_form_edit/$1";
$route['cpm/polling_insert'] = "admin/polling/polling_insert";
$route['cpm/polling_edit'] = "admin/polling/polling_edit";
$route['cpm/polling_delete/(:num)'] = "admin/polling/polling_delete/$1";
$route['cpm/polling_activate/(:num)'] = "admin/polling/polling_activate/$1";

$route['cpm/polling_pil_insert/(:num)'] = "admin/polling/polling_pil_insert/$1";
$route['cpm/polling_pil_process/(:num)'] = "admin/polling/polling_pil_process/$1";
$route['cpm/polling_pil_delete/(:num)/(:num)'] = "admin/polling/polling_pil_delete/$1/$2";
$route['cpm/polling_pil_shiftup/(:num)/(:num)'] = "admin/polling/polling_pil_shiftup/$1/$2";
$route['cpm/polling_pil_shiftdown/(:num)/(:num)'] = "admin/polling/polling_pil_shiftdown/$1/$2";

$route['cpm/password'] = "admin/password/get_password";
$route['cpm/password_edit'] = "admin/password/password_edit";













$route['cpm/komentar_halaman'] = "admin/komentar_halaman/komentar_halaman_list";
$route['cpm/komentar_halaman/(:num)'] = "admin/komentar_halaman/komentar_halaman_list/$1";  // paging
$route['cpm/komentar_halaman_delete/(:num)'] = "admin/komentar_halaman/komentar_halaman_delete/$1";



$route['cpm/profile'] = "admin/dashboard/profile";
$route['cpm/profile_edit'] = "admin/dashboard/profile_edit";

$route['cpm/title'] = "admin/dashboard/title";
$route['cpm/title_edit'] = "admin/dashboard/title_edit";

$route['cpm/desc'] = "admin/dashboard/desc";
$route['cpm/desc_edit'] = "admin/dashboard/desc_edit";

$route['cpm/sidebar'] = "admin/dashboard/sidebar";
$route['cpm/sidebar_edit'] = "admin/dashboard/sidebar_edit";

$route['cpm/bottom'] = "admin/dashboard/bottom";
$route['cpm/bottom_edit'] = "admin/dashboard/bottom_edit";

$route['cpm/themes'] = "admin/dashboard/themes";
$route['cpm/theme_edit'] = "admin/dashboard/theme_edit";

$route['cpm'] = "admin/depan";




/* End of file routes.php */
/* Location: ./system/application/config/routes.php */