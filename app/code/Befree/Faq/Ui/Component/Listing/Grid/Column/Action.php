<?php
/**
 * Grid Ui Component Action.
 * @category  Webkul
 * @package   Befree_Faq
 * @author    Webkul
 * @copyright Copyright (c) 2010-2017 Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
namespace Befree\Faq\Ui\Component\Listing\Grid\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

class Action extends Column
{
    /** Url path */
    const ROW_EDIT_URL = 'grid/grid/addrow';
    const ROW_DELETE_URL = 'grid/grid/deleterow';
    /** @var UrlInterface */
    protected $_urlBuilder;

    /**
     * @var string
     */
    private $_editUrl;
    private $_deleteUrl;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = [],
        $editUrl = self::ROW_EDIT_URL,
        $deleteUrl = self::ROW_DELETE_URL
    ) {
        $this->_urlBuilder = $urlBuilder;
        $this->_editUrl = $editUrl;
        $this->_deleteUrl = $deleteUrl;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source.
     *
     * @param array $dataSource
     *
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {

	    if (isset($dataSource['data']['items'])) {
		    foreach ($dataSource['data']['items'] as &$item) {
			    $item[$this->getData('name')]['edit'] = [
				    'href' => $this->_urlBuilder->getUrl($this->_editUrl, ['id' => $item['entity_id']]),
				    'label' => __('Edit'),
				    'hidden' => false,
			    ];
			    $item[$this->getData('name')]['delete'] = [
				    'href' => $this->_urlBuilder->getUrl($this->_deleteUrl, ['id' => $item['entity_id']]),
				    'label' => __('Delete'),
				    'hidden' => false,
			    ];
		    }
	    }

        return $dataSource;
    }
}
