<?php
/*
 * FeedData.php - Класс FeedData
 * Release Date: 26/05/2011                                              *
 * Version 1.0 
 * Author: Alexander Kostetsky
 * Email: finster.seele@gmail.com       
 */
class FeedData {
	protected $_aFeedData = array();

	function __construct($aData = array()){
		$this->_aFeedData = $aData;
	}
	
	public function __get($var){
		return $this->_aFeedData[$var];
	}
		
	public function	transferFromString($sData){
		$this->_aFeedData = $this->aRecursionArray($sData, true);
	}
/**
 * 
 * Преобразование строк в массив
 * @param string $str данные полученные от nic.ru 
 * @param boolean $ProcessSections 
 * TODO: есть бага с разбором многострочных полей
 */
	public function aRecursionArray($str, $ProcessSections=false){
        $lines  = explode("\n", $str);
        $return = Array();
        $inSect = false;
        $SectEnd = false;
        $aSectArray = array();
        foreach($lines as $line){
        	$line = trim($line);
            
        	if(!$line || $line[0] == "#" || $line[0] == ";"){
                if($inSect) $SectEnd = true;
                if($SectEnd){
                	$return[$inSect][] = $aSectArray;
                }
                continue;
            }
            
            if($line[0] == "[" && $endIdx = strpos($line, "]")){
            	$SectEnd = false;
            	$aSectArray = array();
            	$inSect = str_replace('-', '_',substr($line, 1, $endIdx-1));
                continue;
            }
            
            if(!strpos($line, ':')) continue;
            
            $tmp = explode(":", $line, 2);
            $tmp[0] = str_replace('-', '_', $tmp[0]);
            
            if($ProcessSections && $inSect) $aSectArray[strtolower(trim($tmp[0]))] = ltrim($tmp[1]); 
            else $return[strtolower(trim($tmp[0]))] = ltrim($tmp[1]);
          
        }
        // Приведение массива в нормальный вид
        //foreach($return as $key => $val){
		//	if(is_array($val) && (count($val) == 1) ) $return[$key] = $val[0];
        //}      
        return $return;
    }
	
}

?>