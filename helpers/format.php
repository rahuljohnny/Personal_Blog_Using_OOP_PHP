<?php 

	/**
	* Format class
	*/
	class format 
	{
		public function formatDate($date){
			return date('F j,Y,g:i a',strtotime($date));
		}

		public function text_shorten($text,$limit=230){
			$text=$text." ";
			$text=substr($text, 0,$limit);
			$text=substr($text, 0,strrpos($text, ' '));
			$text=$text."......";
			return $text;
		}
		public function validation($data){
			$data=trim($data);
			$data=stripcslashes($data);
			$data=htmlspecialchars($data);
			return $data;
		}
	}

 ?>