<?php
	/**
 * @author: Tanveer Noman
 * @description: This function can limit word from any paragraph
 * @license http://opensource.org/licenses/mit-license.html MIT
 * @copyright (c) 2010, Tanveer Noman
 * @version 1.0
 * */
 
 
define("STRING_DELIMITER", " ");
 
/*
 * @params: String, Integer
 * @return: String
 */
function word_limiter($str, $limit=10) {
    $str = strip_tags($str); // Updated from Ivan Dimov
    if (stripos($str, STRING_DELIMITER)) {
        $ex_str = explode(STRING_DELIMITER, $str);
        if (count($ex_str) > $limit) {
            for ($i = 0; $i < $limit; $i++) {
                $str_s=$ex_str[$i]."";
            }
            return $str_s;
        }else {
            return $str;
        }
    } else {
        return $str;
    }
}

	$string = "This diagram shows Address Types, which are an example of Reference Data. This kind of data has";
	echo str_word_count($string);
	echo word_limiter($string,6)."...";

	echo strpos($string," ");
?>