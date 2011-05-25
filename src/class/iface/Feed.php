<?php
include_once("FeedData.php");
class Feed extends FeedData implements Iterator, ArrayAccess {
	protected $_entryIndex = 0;
	protected $_entry = array();
	function __construct($aData = array()){
		parent::__construct($aData);
	}
	public function __get($var){
        switch ($var) {
            case 'entries':
                return $this;
            default:
                return parent::__get($var);
        }
    }
	public function current (){ 
		return $this->_entry[$this->_entryIndex];
	}
	public function key(){ 
		 return $this->_entryIndex;
	}
	public function next(){ 
		 ++$this->_entryIndex;
	}
	public function rewind(){
		$this->_entryIndex = 0;
	}
	public function valid(){ 
		return 0 <= $this->_entryIndex && $this->_entryIndex < $this->count();
	}
	public function offsetExists ( $offset ){ 
		die(__METHOD__);
	}
	public function offsetGet (  $offset ){ 
		die(__METHOD__);
	}
	public function offsetSet (  $offset ,  $value ){ 
		die(__METHOD__);
	}
	public function offsetUnset (  $offset ){ 
		die(__METHOD__);
	}
	public function count(){
        return count($this->_entry);
    }
    public function transferFromString($data, $_DataHandler = null){
    	parent::transferFromString($data);
    	include_once("$this->_entryClassName.php");
    	if(is_null($_DataHandler)){
    		throw new Exception("_DataHandler is null");
    	}else{
    		if(array_key_exists($_DataHandler, $this->_aFeedData)){
    			if(count($this->_aFeedData[$_DataHandler]) == 1){
    					$newEntry = new $this->_entryClassName($this->_aFeedData[$_DataHandler]);
						$this->_entry[] = $newEntry;	
    			}else{
    				foreach ($this->_aFeedData[$_DataHandler] as $entry) {
						$newEntry = new $this->_entryClassName($entry);
						$this->_entry[] = $newEntry;
    				} // foreach
    			} // if 
    		} // if
    	} // if		
    }
}

?>