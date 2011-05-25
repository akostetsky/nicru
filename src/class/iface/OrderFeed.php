<?php
/*
 * OrderFeed.php - Класс OrderFeed
 * Release Date: 26/05/2011                                              *
 * Version 1.0 
 * Author: Alexander Kostetsky
 * Email: finster.seele@gmail.com       
 */

include_once("Feed.php");
include_once("OrderItem.php");
/**
 * 
 * Получение данных о заказах
 * @author Alexander Kostetsky
 *
 */
class OrderFeed extends Feed {
	protected $_entryClassName = 'OrderEntry';
	const _OrderHandler = "order";
	public function transferFromString($data){
		parent::transferFromString($data, self::_OrderHandler);
	}
	public function GetOrdersLimit(){ return $this->orders_list[0]["orders_limit"]; }
	public function GetOrdersFound(){ return $this->orders_list[0]["orders_found"]; }
	public function GetOrdersFirst(){ return $this->orders_list[0]["orders_first"]; }
	public function GetOrderItem(){
		
		$oOrderItem = new OrderItem($this->order_item);
		
		return $oOrderItem;
	}
}
?>