<?php
	class Encrypt{
	
		private static $nl =  array('1' => 'A',
									'2' => 'B',
									'3' => 'C',
									'4' => 'D',
									'5' => 'E',
									'6' => 'F',
									'7' => 'G',
									'8' => 'H',
									'9' => 'I',
									'0' => 'J');
		
		public function cyptText($password,$c = ''){
			preg_match('/([A-Z0-9]*)/',(($c == '') ? base64_encode(rand(20,99)) : base64_encode($c)),$c);
			return self::twoWayEncrypt($password,$c[1]);
		}
		
		public function cyptCard($n0){
			$n = str_replace(array(' ','-'),array('',''),$n0);
			$T = substr($n,0,4)+substr($n,4,4)+substr($n,8,4)+substr($n,12);
			return self::twoWayEncrypt($n0,$T);
		}
		
		public function dcyptCard($t){
			return self::dcyptText($t);
		}
		
		public function oneWayEncrypt($text){
			return md5(self::twoWayEncrypt($text,'0new4y',1));
		}
		
		private function twoWayEncrypt($text,$c,$r = 0){
			$text = base64_encode($text);
			preg_match('/([A-W]*)/',strtoupper($c.metaphone($text)),$c);
			$c = $c[1];
			$l = strlen($text);
			$r = $r <= 0 ? rand(0,$l) : $r;
			$text = substr(strrev($text),$r,$l).$c.substr(strrev($text),0,$r);
			$cl = str_replace(array_keys(self::$nl),array_values(self::$nl),strlen($c));
			$l = str_replace(array_keys(self::$nl),array_values(self::$nl),$l);
			$r = str_replace(array_keys(self::$nl),array_values(self::$nl),$r);
			return $text = $r.$text.'X'.$l.'X'.$cl;
		}
		
		public function dcyptText($text){
			$cl = str_replace(array_values(self::$nl),array_keys(self::$nl),substr($text,(strrpos($text,'X')+1),strlen($text)));
			$text = substr($text,0,strrpos($text,'X'));
			$l = str_replace(array_values(self::$nl),array_keys(self::$nl),substr($text,(strrpos($text,'X')+1),strlen($text)));
			$text = substr($text,0,strrpos($text,'X'));
			$r = str_replace(array_values(self::$nl),array_keys(self::$nl),substr($text,0,(strlen($text)-($cl+$l))));
			$text = substr($text,(strlen($text)-($cl+$l)),strlen($text));
			$text = substr($text,(strlen($text)-$r),strlen($text)).substr($text,0,(strlen($text)-($r+$cl)));
			return base64_decode(strrev($text));
		}
	}
	
	$Encrypt = new Encrypt();
	/*$Encrypt->dcyptText($Encrypt->cyptText('admin123'));
	$Encrypt->oneWayEncrypt('admin123');
	echo $Encrypt->cyptCard('5993 5498 4565 9854');*/

	
?>
