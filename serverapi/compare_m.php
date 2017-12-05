<?php
class Compares {
	var $compare_info;
	function Compares(){
		return true;
	}
	function reg($marketname, $total_buy, $total_sell, $price){
		global $__db;
		$querycheck='SELECT 1 FROM `'.$marketname.'`';
		$checked = $__db->ExecuteSQL($querycheck);
		if(!$checked){
			$querycreate = "CREATE TABLE ".$marketname." (id int(11) AUTO_INCREMENT,marketname varchar(255) NOT NULL,price float NOT NULL,buy float NOT NULL,
              sell float NOT NULL,time int(255) NOT NULL, PRIMARY KEY  (id))";
			$__db->ExecuteSQL($querycreate);
			$query = "INSERT INTO `".$marketname."` ( `marketname`,`price`, `buy`,`sell`,`time`) VALUES ('".$marketname."','".$price."', '".$total_buy."', '".$total_sell."', '".time()."')";
			$__db->ExecuteSQL($query);
		}else{
			$query = "INSERT INTO `".$marketname."` ( `marketname`,`price`, `buy`,`sell`,`time`) VALUES ('".$marketname."','".$price."', '".$total_buy."', '".$total_sell."', '".time()."')";
			$__db->ExecuteSQL($query);
		}
	}
	function getAll(){
		global $__db;
		$query_table = "SELECT TABLE_ROWS,TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'market_compare'";
		$__db->ExecuteSQL($query_table);
		$results_table = $__db->ArrayResults();
		//return $results;
		if(count($results_table)){
			$returnArray = array();
			foreach($results_table as $key_table=>$value_table) {
				if((int)$value_table['TABLE_ROWS']>=2){
					$return_detail_data =  array ();
					$five_price = 0;$five_buy=0;$five_sell=0;$ten_price=0;$ten_buy=0; $ten_sell=0;$fifteen_price=0;$fifteen_buy=0;$fifteen_sell=0;$twenty_price=0;$twenty_buy=0;$twenty_sell=0;$twentyfive_price=0;$twentyfive_buy=0;$twentyfive_sell=0;$thirty_price=0;$thirty_buy=0;$thirty_sell=0; $hour_price=0;$hour_buy=0;$hour_sell=0;						
					//return $value_table['TABLE_NAME'];
					$query_all = "SELECT * FROM `".$value_table['TABLE_NAME']."` ORDER BY id DESC LIMIT 13";	
					$__db->ExecuteSQL($query_all);
					$result_all = $__db->ArrayResults();
					if($result_all[1]['price']!=0) $five_price = round((($result_all[0]['price'] - $result_all[1]['price'])/$result_all[1]['price'])*100,2) ;
					if($result_all[1]['buy']!=0) $five_buy = round((($result_all[0]['buy'] - $result_all[1]['buy'])/$result_all[1]['buy'])*100,2) ;
					if($result_all[1]['sell']!=0) $five_sell = round((($result_all[0]['sell'] - $result_all[1]['sell'])/$result_all[1]['sell'])*100,2) ;

					if(isset($result_all[2])){
						if($result_all[2]['price']!=0) $ten_price = round((($result_all[0]['price'] - $result_all[2]['price'])/$result_all[2]['price'])*100,2) ;
						if($result_all[2]['buy']!=0) $ten_buy = round((($result_all[0]['buy'] - $result_all[2]['buy'])/$result_all[2]['buy'])*100,2) ;
						if($result_all[2]['sell']!=0) $ten_sell = round((($result_all[0]['sell'] - $result_all[2]['sell'])/$result_all[2]['sell'])*100,2) ;
					}

					if(isset($result_all[3])){
						if($result_all[3]['price']!=0) $fifteen_price = round((($result_all[0]['price'] - $result_all[3]['price'])/$result_all[3]['price'])*100,2) ;
						if($result_all[3]['buy']!=0) $fifteen_buy = round((($result_all[0]['buy'] - $result_all[3]['buy'])/$result_all[3]['buy'])*100,2) ;
						if($result_all[3]['sell']!=0) $fifteen_sell = round((($result_all[0]['sell'] - $result_all[3]['sell'])/$result_all[3]['sell'])*100,2) ;
					}

					if(isset($result_all[4])){
						if($result_all[4]['price']!=0) $twenty_price = round((($result_all[0]['price'] - $result_all[4]['price'])/$result_all[4]['price'])*100,2) ;
						if($result_all[4]['buy']!=0) $twenty_buy = round((($result_all[0]['buy'] - $result_all[4]['buy'])/$result_all[4]['buy'])*100,2) ;
						if($result_all[4]['sell']!=0) $twenty_sell = round((($result_all[0]['sell'] - $result_all[4]['sell'])/$result_all[4]['sell'])*100,2) ;
					}

					if(isset($result_all[5])){
						if($result_all[5]['price']!=0) $twentyfive_price = round((($result_all[0]['price'] - $result_all[5]['price'])/$result_all[5]['price'])*100,2) ;
						if($result_all[5]['buy']!=0) $twentyfive_buy = round((($result_all[0]['buy'] - $result_all[5]['buy'])/$result_all[5]['buy'])*100,2) ;
						if($result_all[5]['sell']!=0) $twentyfive_sell = round((($result_all[0]['sell'] - $result_all[5]['sell'])/$result_all[5]['sell'])*100,2) ;	
					}
					
					if(isset($result_all[6])){
						if($result_all[6]['price']!=0) $thirty_price = round((($result_all[0]['price'] - $result_all[6]['price'])/$result_all[6]['price'])*100,2) ;
						if($result_all[6]['buy']!=0) $thirty_buy = round((($result_all[0]['buy'] - $result_all[6]['buy'])/$result_all[6]['buy'])*100,2) ;
						if($result_all[6]['sell']!=0) $thirty_sell = round((($result_all[0]['sell'] - $result_all[6]['sell'])/$result_all[6]['sell'])*100,2) ;
					}

					if(isset($result_all[12])){
						if($result_all[12]['price']!=0) $hour_price = round((($result_all[0]['price'] - $result_all[12]['price'])/$result_all[12]['price'])*100,2) ;
						if($result_all[12]['buy']!=0) $hour_buy = round((($result_all[0]['buy'] - $result_all[12]['buy'])/$result_all[12]['buy'])*100,2) ;
						if($result_all[12]['sell']!=0) $hour_sell = round((($result_all[0]['sell'] - $result_all[12]['sell'])/$result_all[12]['sell'])*100,2) ;
					}
					array_push($return_detail_data,$five_price,$ten_price,$fifteen_price,$twenty_price,$twentyfive_price,$thirty_price,$hour_price,$five_buy,$ten_buy,$fifteen_buy,$twenty_buy,$twentyfive_buy,$thirty_buy,$hour_buy,$five_sell,$ten_sell,$fifteen_sell,$twenty_sell,$twentyfive_sell,$thirty_sell,$hour_sell);
					$returnArray[$value_table['TABLE_NAME']] = $return_detail_data;
				}
			}
			return $returnArray;
		}
		/*$query_count = "SELECT COUNT(*) FROM `omg`";
		$__db->ExecuteSQL($query_count);
		$result = $__db->ArrayResult();
		$five_price = 0;$five_buy=0;$five_sell=0;$ten_price=0;$ten_buy=0; $ten_sell=0;$fifteen_price=0;$fifteen_buy=0;$fifteen_sell=0;$twenty_price=0;$twenty_buy=0;$twenty_sell=0;$twentyfive_price=0;$twentyfive_buy=0;$twentyfive_sell=0;$thirty_price=0;$thirty_buy=0;$thirty_sell=0; $hour_price=0;$hour_buy=0;$hour_sell=0;
		if((int)$result["COUNT(*)"]>=2){
			$query_all = "SELECT * FROM `omg` ORDER BY id DESC LIMIT 13";	
			$__db->ExecuteSQL($query_all);
			$result_all = $__db->ArrayResults();

			$five_price = round((($result_all[0]['price'] - $result_all[1]['price'])/$result_all[1]['price'])*100,2) ;
			$five_buy = round((($result_all[0]['buy'] - $result_all[1]['buy'])/$result_all[1]['buy'])*100,2) ;
			$five_sell = round((($result_all[0]['sell'] - $result_all[1]['sell'])/$result_all[1]['sell'])*100,2) ;

			if(isset($result_all[2])){
				$ten_price = round((($result_all[0]['price'] - $result_all[2]['price'])/$result_all[2]['price'])*100,2) ;
				$ten_buy = round((($result_all[0]['buy'] - $result_all[2]['buy'])/$result_all[2]['buy'])*100,2) ;
				$ten_sell = round((($result_all[0]['sell'] - $result_all[2]['sell'])/$result_all[2]['sell'])*100,2) ;
			}

			if(isset($result_all[3])){
				$fifteen_price = round((($result_all[0]['price'] - $result_all[3]['price'])/$result_all[3]['price'])*100,2) ;
				$fifteen_buy = round((($result_all[0]['buy'] - $result_all[3]['buy'])/$result_all[3]['buy'])*100,2) ;
				$fifteen_sell = round((($result_all[0]['sell'] - $result_all[3]['sell'])/$result_all[3]['sell'])*100,2) ;
			}

			if(isset($result_all[4])){
				$twenty_price = round((($result_all[0]['price'] - $result_all[4]['price'])/$result_all[4]['price'])*100,2) ;
				$twenty_buy = round((($result_all[0]['buy'] - $result_all[4]['buy'])/$result_all[4]['buy'])*100,2) ;
				$twenty_sell = round((($result_all[0]['sell'] - $result_all[4]['sell'])/$result_all[4]['sell'])*100,2) ;
			}

			if(isset($result_all[5])){
				$twentyfive_price = round((($result_all[0]['price'] - $result_all[5]['price'])/$result_all[5]['price'])*100,2) ;
				$twentyfive_buy = round((($result_all[0]['buy'] - $result_all[5]['buy'])/$result_all[5]['buy'])*100,2) ;
				$twentyfive_sell = round((($result_all[0]['sell'] - $result_all[5]['sell'])/$result_all[5]['sell'])*100,2) ;	
			}
			
			if(isset($result_all[6])){
				$thirty_price = round((($result_all[0]['price'] - $result_all[6]['price'])/$result_all[6]['price'])*100,2) ;
				$thirty_buy = round((($result_all[0]['buy'] - $result_all[6]['buy'])/$result_all[6]['buy'])*100,2) ;
				$thirty_sell = round((($result_all[0]['sell'] - $result_all[6]['sell'])/$result_all[6]['sell'])*100,2) ;
			}

			if(isset($result_all[12])){
				$hour_price = round((($result_all[0]['price'] - $result_all[12]['price'])/$result_all[12]['price'])*100,2) ;
				$hour_buy = round((($result_all[0]['buy'] - $result_all[12]['buy'])/$result_all[12]['buy'])*100,2) ;
				$hour_sell = round((($result_all[0]['sell'] - $result_all[12]['sell'])/$result_all[12]['sell'])*100,2) ;
			}
		}
		$return_detail_data =  array ();
		array_push($return_detail_data,$five_price,$ten_price,$fifteen_price,$twenty_price,$twentyfive_price,$thirty_price,$hour_price,$five_buy,$ten_buy,$fifteen_buy,$twenty_buy,$twentyfive_buy,$thirty_buy,$hour_buy,$five_sell,$ten_sell,$fifteen_sell,$twenty_sell,$twentyfive_sell,$thirty_sell,$hour_sell);
	    $returnArray = array();
	    $returnArray['omg'] = $return_detail_data;
	    return $returnArray;*/
	}
}
?>