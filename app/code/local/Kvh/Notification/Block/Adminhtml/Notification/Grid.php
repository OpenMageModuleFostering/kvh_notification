<?php



class Kvh_Notification_Block_Adminhtml_Notification_Grid extends Mage_Adminhtml_Block_Widget_Grid

{

  public function __construct()

  {

      parent::__construct();

      $this->setId('notificationGrid');

      $this->setDefaultSort('notification_id');

      $this->setDefaultDir('ASC');

      $this->setSaveParametersInSession(true);

  }



  protected function _prepareCollection()

  {

      $collection = Mage::getModel('notification/notification')->getCollection();

      $this->setCollection($collection);

      return parent::_prepareCollection();

  }



  protected function _prepareColumns()

  {

      $this->addColumn('notification_id', array(

          'header'    => Mage::helper('notification')->__('ID'),

          'align'     =>'right',

          'width'     => '50px',

          'index'     => 'notification_id',

      ));



      $this->addColumn('notification_name', array(

          'header'    => Mage::helper('notification')->__('Name'),

          'align'     =>'left',

          'index'     => 'notification_name',

      )); 

	  

      $this->addColumn('start_date', array(

          'header'    => Mage::helper('notification')->__('Start Date'),

          'align'     =>'left',

          'index'     => 'start_date',
		'type' =>'datetime',	
		
      ));	
	  
	   $this->addColumn('end_date', array(

          'header'    => Mage::helper('notification')->__('End Date'),

          'align'     =>'left',
		  'type' =>'datetime',

          'index'     => 'end_date',

      ));	

	  

	   

      $this->addColumn('is_active', array(

          'header'    => Mage::helper('notification')->__('Status'),

          'align'     => 'left',

          'width'     => '80px',

          'index'     => 'is_active',

          'type'      => 'options',

          'options'   => array(

              1 => 'Enabled',

              2 => 'Disabled',

          ),

      ));

	  

        $this->addColumn('action',

            array(

                'header'    =>  Mage::helper('notification')->__('Action'),

                'width'     => '100',

                'type'      => 'action',

                'getter'    => 'getId',

                'actions'   => array(

                    array(

                        'caption'   => Mage::helper('notification')->__('Edit'),

                        'url'       => array('base'=> '*/*/edit'),

                        'field'     => 'id'

                    )

                ),

                'filter'    => false,

                'sortable'  => false,

                'index'     => 'stores',

                'is_system' => true,

        ));

		

	 

	  

      return parent::_prepareColumns();

  }



    protected function _prepareMassaction()

    {

      

    }



  public function getRowUrl($row)

  {

      return $this->getUrl('*/*/edit', array('id' => $row->getId()));

  }



}