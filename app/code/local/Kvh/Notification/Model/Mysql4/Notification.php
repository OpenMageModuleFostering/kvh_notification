<?php



class Kvh_Notification_Model_Mysql4_Notification extends Mage_Core_Model_Mysql4_Abstract

{

    public function _construct()

    {    

        // Note that the notification_id refers to the key field in your database table.

        $this->_init('notification/notification', 'notification_id');

    }

}