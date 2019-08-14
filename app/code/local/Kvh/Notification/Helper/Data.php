<?php



class Kvh_Notification_Helper_Data extends Mage_Core_Helper_Abstract

{

	public function getNotification()
	{
		$collection = Mage::getModel('notification/notification')->getCollection()
					->addfieldtofilter('start_date', 
									array(
									 array('to' => Mage::getModel('core/date')->gmtDate()),
											 array('start_date', 'null'=>'')))
							   ->addfieldtofilter('end_date',
									array(
									 array('gteq' => Mage::getModel('core/date')->gmtDate()),
										 array('end_date', 'null'=>''))
											  );
											  
		 	$collection->addfieldtoFilter('is_active',array('eq'=>1));
			
		 
			
			
		return $collection;	
					
	
	}
	
	public function checkCookie()
	{
		 
		$enable_disable=$subent_id = Mage::getStoreConfig('kvh/notification/enable_pop');
		
		if(!$enable_disable)
			return false;
		
		if(Mage::getModel('core/cookie')->get('popup'))
		{ 
			Mage::getModel('core/cookie')->get('popup');
			return false;
		}
			
	    $timeinterval= (Mage::getStoreConfig('kvh/notification/repeatinterval')!="")?Mage::getStoreConfig('kvh/notification/repeatinterval'):3600; 
		  
		 Mage::getModel('core/cookie')->set("popup",1, $timeinterval);
		
		return true;	
	
	
	}
	
	
	
	



}