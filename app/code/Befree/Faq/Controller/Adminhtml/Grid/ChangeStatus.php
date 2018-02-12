<?php
/**
 * Webkul Grid Record Delete Controller.
 * @category  Webkul
 * @package   Befree_Faq
 * @author    Webkul
 * @copyright Copyright (c) 2010-2017 Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
namespace Befree\Faq\Controller\Adminhtml\Grid;

use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Befree\Faq\Model\ResourceModel\Grid\CollectionFactory;
use \Magento\Backend\App\Action;

class ChangeStatus extends Action
{
	/**
	 * Massactions filter.
	 * @var Filter
	 */
	protected $_filter;

	/**
	 * @var CollectionFactory
	 */
	protected $_collectionFactory;

	/**
	 * @param Context           $context
	 * @param Filter            $filter
	 * @param CollectionFactory $collectionFactory
	 */
	public function __construct(
		Context $context,
		Filter $filter,
		CollectionFactory $collectionFactory
	) {

		$this->_filter = $filter;
		$this->_collectionFactory = $collectionFactory;
		parent::__construct($context);
	}

	public function execute()
	{
		$collection = $this->_filter->getCollection($this->_collectionFactory->create());
		$statusChanged = 0;
		foreach ($collection->getItems() as $record) {
			$record->setId($record->getEntityId());
			$record['is_active'] = $record['is_active'] == '0' ? '1' : '0';
			$record->save();
			$statusChanged++;
		}
		$this->messageManager->addSuccess(__('A total of %1 status(es) have been changed.', $statusChanged));

		return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/index');
	}

}
