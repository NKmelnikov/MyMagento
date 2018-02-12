<?php
/**
 * Webkul Grid List Controller.
 * @category  Webkul
 * @package   Befree_Faq
 * @author    Webkul
 * @copyright Copyright (c) 2010-2017 Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
namespace Befree\Faq\Controller\Adminhtml\Grid;

use Magento\Framework\Controller\ResultFactory;
use Befree\Faq\Model\Grid as Grid;
use Magento\Backend\App\Action;
use \Magento\Backend\App\Action\Context;
use \Magento\Framework\Registry;
use \Befree\Faq\Model\GridFactory;


class DeleteRow extends Action
{
    private $coreRegistry;
    private $gridFactory;

    public function __construct(Context $context, Registry $coreRegistry, GridFactory $gridFactory) {
        parent::__construct($context);
        $this->coreRegistry = $coreRegistry;
        $this->gridFactory = $gridFactory;
    }

    public function execute()
    {
	    $id = $this->getRequest()->getParam('id');

	    if (!($row = $this->_objectManager->create(Grid::class)->load($id))) {
		    $this->messageManager->addError(__('Unable to proceed. Please, try again.'));
		    $resultRedirect = $this->resultRedirectFactory->create();
		    return $resultRedirect->setPath('*/*/index', array('_current' => true));
	    }
	    try{
		    $row->delete();
		    $this->messageManager->addSuccess(__('Your row has been deleted !'));
	    } catch (Exception $e) {
		    $this->messageManager->addError(__('Error while trying to delete a row: '));
		    $resultRedirect = $this->resultRedirectFactory->create();
		    return $resultRedirect->setPath('*/*/index', array('_current' => true));
	    }

	    $resultRedirect = $this->resultRedirectFactory->create();
	    return $resultRedirect->setPath('*/*/index', array('_current' => true));

    }

}
