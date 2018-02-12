<?php

namespace Befree\Faq\Model\Config\Source;

use \Magento\Framework\Option\ArrayInterface;

class ListMode implements ArrayInterface
{
	public function toOptionArray()
	{
		return [
			['value' => '5', 'label' => __('5')],
			['value' => '10', 'label' => __('10')],
			['value' => '15', 'label' => __('15')],
			['value' => '20', 'label' => __('20')]
		];
	}
}