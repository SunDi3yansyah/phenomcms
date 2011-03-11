<?php 
class Date extends Model {

    function Date()
    {
        parent::Model();
    }

	function IndonesianDate($date)
	{
		$split = explode(" ",$date);
		$date = $split[0];
		$time = substr($split[1],0,5);
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
		return substr($date,8,2).' '.$month.' '.substr($date,0,4).', '.$time;
	}

	function StandardDate($date)
	{
		$split = explode(" ",$date);
		$date = $split[0];
		$time = substr($split[1],0,5);
		$month = substr($date,5,2)+'toint';
		switch($month){
		case  1: $month ='Jan';  break;
		case  2: $month ='Feb'; break;
		case  3: $month ='Mar';	 break;
		case  4: $month ='Apr'; 	 break;
		case  5: $month ='May'; 	 break;
		case  6: $month ='Jun'; 	 break;
		case  7: $month ='Jul'; 	 break;
		case  8: $month ='Aug';  break;
		case  9: $month ='Sept';break;
		case 10: $month ='Oct';  break;
		case 11: $month ='Nov'; break;
		case 12: $month ='Dec'; break;
		} // switch
		return substr($date,8,2).' '.$month.' '.substr($date,0,4).' '.$time;
	}

}
?>