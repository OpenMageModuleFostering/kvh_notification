<?php



class Kvh_Notification_Adminhtml_NotificationController extends Mage_Adminhtml_Controller_action

{ 



	protected function _initAction() {

		$this->loadLayout()

			->_setActiveMenu('notification/items')

			->_addBreadcrumb(Mage::helper('adminhtml')->__('Notifications Manager'), Mage::helper('adminhtml')->__('Notification Manager'));

		

	 



		

		return $this;

	}   

 

	public function indexAction() {

		$this->_initAction()

			->renderLayout();

	}



	public function editAction() {

		$id     = $this->getRequest()->getParam('id');

		$model  = Mage::getModel('notification/notification')->load($id);



		if ($model->getId() || $id == 0) {

			$data = Mage::getSingleton('adminhtml/session')->getFormData(true);

			if (!empty($data)) {

				$model->setData($data);

			}



			Mage::register('notification_data', $model);



			$this->loadLayout();

			$this->_setActiveMenu('notification/items');



			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Notification Manager'), Mage::helper('adminhtml')->__('Notification Manager'));

			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Notification News'), Mage::helper('adminhtml')->__('Notification News'));



			if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
					$this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
				}



			$this->_addContent($this->getLayout()->createBlock('notification/adminhtml_notification_edit'))

				->_addLeft($this->getLayout()->createBlock('notification/adminhtml_notification_edit_tabs'));



			$this->renderLayout();

		} else {

			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('notification')->__('Notification does not exist'));

			$this->_redirect('*/*/');

		}

	}

 

	public function newAction() {

		$this->_forward('edit');

	}

 

	public function saveAction() {	

	

		if ($data = $this->getRequest()->getPost()) { 
 
			$model = Mage::getModel('notification/notification');		

			$model->setData($data)

				->setId($this->getRequest()->getParam('id'));

			

			try {

				if ($model->getCreatedTime == NULL || $model->getUpdateTime() == NULL) {

					$model->setCreatedTime(now())

						->setUpdateTime(now());

				} else {

					$model->setUpdateTime(now());

				}	

				

				$model->save();

				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('notification')->__('Notification was successfully saved'));

				Mage::getSingleton('adminhtml/session')->setFormData(false);



				if ($this->getRequest()->getParam('back')) {

					$this->_redirect('*/*/edit', array('id' => $model->getId()));

					return;

				}

				$this->_redirect('*/*/');

				return;

            } catch (Exception $e) {

                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());

                Mage::getSingleton('adminhtml/session')->setFormData($data);

                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));

                return;

            }

        }

        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('notification')->__('Unable to find item to save'));

        $this->_redirect('*/*/');

	}

 

	public function deleteAction() {

		if( $this->getRequest()->getParam('id') > 0 ) {

			try {

				

				$model = Mage::getModel('notification/notification');

				 

				$model->setId($this->getRequest()->getParam('id'))

					->delete();

					 

				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Notification was successfully deleted'));

				$this->_redirect('*/*/');

			} catch (Exception $e) {

				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());

				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));

			}

		}

		$this->_redirect('*/*/');

	}

	

	

	

  

    public function massDeleteAction() {

        $notificationIds = $this->getRequest()->getParam('notification');

        if(!is_array($notificationIds)) {

			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));

        } else {

            try {

                foreach ($notificationIds as $notificationId) {

                    $notification = Mage::getModel('notification/notification')->load($notificationId);

                    $notification->delete();

                }

                Mage::getSingleton('adminhtml/session')->addSuccess(

                    Mage::helper('adminhtml')->__(

                        'Total of %d record(s) were successfully deleted', count($notificationIds)

                    )

                );

            } catch (Exception $e) {

                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());

            }

        }

        $this->_redirect('*/*/index');

    }

	

    public function massStatusAction()

    {

        $notificationIds = $this->getRequest()->getParam('notification');

        if(!is_array($notificationIds)) {

            Mage::getSingleton('adminhtml/session')->addError($this->__('Please select item(s)'));

        } else {

            try {

                foreach ($notificationIds as $notificationId) {

                    $notification = Mage::getSingleton('notification/notification')

                        ->load($notificationId)

                        ->setStatus($this->getRequest()->getParam('status'))

                        ->setIsMassupdate(true)

                        ->save();

                }

                $this->_getSession()->addSuccess(

                    $this->__('Total of %d record(s) were successfully updated', count($notificationIds))

                );

            } catch (Exception $e) {

                $this->_getSession()->addError($e->getMessage());

            }

        }

        $this->_redirect('*/*/index');

    }

}