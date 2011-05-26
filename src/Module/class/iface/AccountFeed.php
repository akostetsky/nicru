<?php
/*
 * AccountFeed.php - Класс AccountFeed
 * Release Date: 26/05/2011                                              *
 * Version 1.0 
 * Author: Alexander Kostetsky
 * Email: finster.seele@gmail.com       
 */
include_once("Feed.php");

class AccountFeed extends Feed {
	protected $_entryClassName = 'AccountEntry';
	const _AccountHandler = "account";
	public function transferFromString($data){
		parent::transferFromString($data, self::_AccountHandler);
	}
}

?>