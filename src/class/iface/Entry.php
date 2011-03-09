<?php

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
}

?>