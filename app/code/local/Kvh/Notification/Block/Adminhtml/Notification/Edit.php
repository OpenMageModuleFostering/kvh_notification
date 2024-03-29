<?php



class Kvh_Notification_Block_Adminhtml_Notification_Edit extends Mage_Adminhtml_Block_Widget_Form_Container

{

    public function __construct()

    {

        parent::__construct();

                 

        $this->_objectId = 'id';

        $this->_blockGroup = 'notification';

        $this->_controller = 'adminhtml_notification';

        

        $this->_updateButton('save', 'label', Mage::helper('notification')->__('Save Notification'));

        $this->_updateButton('delete', 'label', Mage::helper('notification')->__('Delete Notification'));

		

        $this->_addButton('saveandcontinue', array(

            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),

            'onclick'   => 'saveAndContinueEdit()',

            'class'     => 'save',

        ), -100);



        $this->_formScripts[] = "

            function toggleEditor() {

                if (tinyMCE.getInstanceById('notification_content') == null) {

                    tinyMCE.execCommand('mceAddControl', false, 'notification_content');

                } else {

                    tinyMCE.execCommand('mceRemoveControl', false, 'notification_content');

                }

            }



            function saveAndContinueEdit(){

                editForm.submit($('edit_form').action+'back/edit/');

            }

        ";

    }



    public function getHeaderText()

    {

        if( Mage::registry('notification_data') && Mage::registry('notification_data')->getId() ) {

            return Mage::helper('notification')->__("Edit Notification '%s'", $this->htmlEscape(Mage::registry('notification_data')->getTitle()));

        } else {

            return Mage::helper('notification')->__('Add Notification');

        }

    }

}