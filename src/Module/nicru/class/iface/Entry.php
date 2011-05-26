<?php
/*
 * Entry.php - Класс Entry
 * Release Date: 26/05/2011                                              *
 * Version 1.0 
 * Author: Alexander Kostetsky
 * Email: finster.seele@gmail.com       
 */
class Entry extends FeedData {
    protected $_baseAttributes = array();
    public function __construct($element = null)
    {
        parent::__construct($element);
    }
    
	public function getGbaseAttributes() {
        return $this->_baseAttributes;
    }
	public function __get($var){
		return $this->_data[$var];
    }
    public function aGetData(){ return $this->_data; }
}

?>