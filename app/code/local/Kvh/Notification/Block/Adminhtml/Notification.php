<?php

class Kvh_Notification_Block_Adminhtml_Notification extends Mage_Adminhtml_Block_Widget_Grid_Container

{

  public function __construct()

  {

    $this->_controller = 'adminhtml_notification';

    $this->_blockGroup = 'notification';

    $this->_headerText = Mage::helper('notification')->__('Notification Manager');

    $this->_addButtonLabel = Mage::helper('notification')->__('Add Notification');

    parent::__construct();

  }

}