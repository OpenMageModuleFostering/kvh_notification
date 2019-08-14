<?php



class Kvh_Notification_Block_Adminhtml_Notification_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form

{

  protected function _prepareForm()

  {

      $form = new Varien_Data_Form();

      $this->setForm($form);

      $fieldset = $form->addFieldset('notification_form', array('legend'=>Mage::helper('notification')->__('Notification information')));

     

       $fieldset->addField('notification_name', 'text', array(
            'label' => Mage::helper('notification')->__('Name'),
            'name'  => 'notification_name',
            'required' => true,
            
	      ));
		  
		  $fieldset->addField('notification_content', 'editor', array(
		  'name'      => 'notification_content',
		  'label'     => Mage::helper('notification')->__('Content'),
		  'title'     => Mage::helper('notification')->__('Content'),
		  'style'     => 'width:900px; height:500px;',
		   'config'      => Mage::getSingleton('cms/wysiwyg_config')->getConfig(),
		  'wysiwyg'   => true,
		  'required'  => true,
		));
		
		
		

		$fieldset->addField('start_date', 'date', array(
			'name'               => 'start_date',
			'label'              => Mage::helper('notification')->__('Start Date'),
			'after_element_html' => '<small>Comments</small>',
			'tabindex'           => 1,
			'image'              => $this->getSkinUrl('images/grid-cal.gif'),
			'format'             => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT) ,
			'value'              => date( Mage::app()->getLocale()->getDateStrFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT),
										  strtotime('next weekday') )
		));
		
		
		$fieldset->addField('end_date', 'date', array(
			'name'               => 'end_date',
			'label'              => Mage::helper('notification')->__('End Date'),
			'after_element_html' => '<small>Comments</small>',
			'tabindex'           => 1,
			'image'              => $this->getSkinUrl('images/grid-cal.gif'),
			'format'             => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT) ,
			'value'              => date( Mage::app()->getLocale()->getDateStrFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT),
										  strtotime('next weekday') )
		));
		
		 $fieldset->addField('is_active', 'select', array(
            'label'     => Mage::helper('notification')->__('Status'),
            'title'     => Mage::helper('notification')->__('Status'),
            'name'      => 'is_active',
            'required'  => true,
            'options'   => array(
                '1' => Mage::helper('notification')->__('Enabled'),
                '0' => Mage::helper('notification')->__('Disabled'),
            ),
        ));
         
		
		

       

    

     

      if ( Mage::getSingleton('adminhtml/session')->getNotificationData() )

      {

          $form->setValues(Mage::getSingleton('adminhtml/session')->getNotificationData());

          Mage::getSingleton('adminhtml/session')->setNotificationData(null);

      } elseif ( Mage::registry('notification_data') ) {

          $form->setValues(Mage::registry('notification_data')->getData());

      }

      return parent::_prepareForm();

  }

}