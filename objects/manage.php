<?php
	 class Format{
		

	 	//$input = "SmackFactory";

		//$encrypted = encryptIt( $input );
		//$decrypted = decryptIt( $encrypted );

		//echo $encrypted . '<br />' . $decrypted;

		/*public  function encryptIt( $q ) {
		    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
		    $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
		    return( $qEncoded );
		}

		public  function decryptIt( $q ) {
		    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
		    $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
		    return( $qDecoded );
		}*/

		public static function getFormat($i){
			return sprintf('%02s',$i);
		}

		public static function getTextDate($date){
			$d = date_parse_from_format("Y-m-d", $date);
		    return self::getFormat($d["day"])."-".self::getFormat($d["month"])."-".$d["year"];
		}

		public static function getSystemDate($date){
			$d = date_parse_from_format("Y-m-d", $date);
		    return $d["year"]."-".self::getFormat($d["month"])."-".self::getFormat($d["day"]);
		}
	}

?>