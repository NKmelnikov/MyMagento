<?php

namespace Befree\Faq\Controller\Index;

use \Magento\Framework\App\Action\Action;
use \Magento\Framework\App\Action\Context;
use \Befree\Faq\Helper\Data;

class Config extends Action
{

	protected $helperData;

	public function __construct(Context $context, Data $helperData)
	{
		$this->helperData = $helperData;
		return parent::__construct($context);
	}

	public function execute()
	{

		echo $this->helperData->getGeneralConfig('number_of_faq');
		exit();

	}
}