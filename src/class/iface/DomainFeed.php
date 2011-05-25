<?php
include_once("Feed.php");
class DomainFeed extends Feed {
	protected $_entryClassName = 'DomainEntry';
	const _AccountHandler = "order";
	public function transferFromString($data){
		parent::transferFromString($data, self::_AccountHandler);
	}
	
}
?>