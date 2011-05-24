<?php
include_once("Feed.php");

class AccountFeed extends Feed {
	protected $_entryClassName = 'AccountEntry';
	const _AccountHandler = "account";
	public function transferFromString($data){
		parent::transferFromString($data, self::_AccountHandler);
		
		
		
		//var_dump($this->_aFeedData = );
	}
}

?>