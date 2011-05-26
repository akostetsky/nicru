<?php
/*
 * DomainFeed.php - Класс DomainFeed
 * Release Date: 26/05/2011                                              *
 * Version 1.0 
 * Author: Alexander Kostetsky
 * Email: finster.seele@gmail.com       
 */
include_once("Feed.php");
class DomainFeed extends Feed {
	protected $_entryClassName = 'DomainEntry';
	const _AccountHandler = "order";
	public function transferFromString($data){
		parent::transferFromString($data, self::_AccountHandler);
	}
	
}
?>