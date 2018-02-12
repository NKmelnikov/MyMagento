<?php
/**
 * Grid Schema Setup.
 * @category  Webkul
 * @package   Befree_Faq
 * @author    Webkul
 * @copyright Copyright (c) 2010-2016 Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */

namespace Befree\Faq\Setup;

use \Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\App\Filesystem\DirectoryList;
use \Magento\Framework\DB\Ddl\Table;

class UpgradeSchema implements UpgradeSchemaInterface
{
	/**
	 * {@inheritdoc}
	 *
	 * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
	 */
	public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
	{
		$installer = $setup;
		$installer->startSetup();

		if (version_compare($context->getVersion(), '1.1.0', '<')) {
			$table = $installer->getConnection()->newTable(
				$installer->getTable('_befree_faq')
			)->addColumn(
				'entity_id',
				Table::TYPE_INTEGER,
				null,
				['identity' => true, 'nullable' => false, 'primary' => true],
				'Grid Record Id'
			)->addColumn(
				'priority',
				Table::TYPE_INTEGER,
				255,
				['nullable' => false],
				'Priority'
			)->addColumn(
				'question',
				Table::TYPE_TEXT,
				'2M',
				['nullable' => false],
				'Question'
			)->addColumn(
				'answer',
				Table::TYPE_TEXT,
				'2M',
				['nullable' => false],
				'Answer'
			)->addColumn(
				'publish_date',
				Table::TYPE_TIMESTAMP,
				null,
				[],
				'Publish Date'
			)->addColumn(
				'is_active',
				Table::TYPE_SMALLINT,
				null,
				[],
				'Active Status'
			)->addColumn(
				'created_at',
				Table::TYPE_TIMESTAMP,
				null,
				[
					'nullable' => false,
					'default' => Table::TIMESTAMP_INIT,
				],
				'Created At'
			)->addColumn(
				'update_time',
				Table::TYPE_TIMESTAMP,
				null,
				[
					'nullable' => false,
					'default' => Table::TIMESTAMP_INIT_UPDATE
				],
				'Updated At'
			)->setComment(
				'Row Data Table'
			);

			$installer->getConnection()->createTable($table);
			$installer->endSetup();
		}
	}
}
