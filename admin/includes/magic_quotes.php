<?php
	if(version_compare(phpversion(), '6.0.0-dev', '<'))
	{
		// Dla PHP 5 i wcześniejszych wyłączmy magic quotes

		function removeSlashes(&$value){
			if(is_array($value))
			{
				return array_map('removeSlashes', $value);
			}
			else
			{
				return stripslashes($value);
			}
		} // end rmGpc();

		set_magic_quotes_runtime(0);

		if(get_magic_quotes_gpc())
		{
			$_POST = array_map('removeSlashes', $_POST);
			$_GET = array_map('removeSlashes', $_GET);
			$_COOKIE = array_map('removeSlashes', $_COOKIE);
		}
	}

?>
