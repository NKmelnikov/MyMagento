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

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use \Magento\Framework\DB\Ddl\Table;


/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
	/**
	 * {@inheritdoc}
	 *
	 * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
	 */
	public function install(
		SchemaSetupInterface $setup,
		ModuleContextInterface $context
	)
	{
		$installer = $setup;

		$installer->startSetup();

		/*
		 * Create table 'wk_grid_records'
		 */

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
			'Creation Time'
		)->addColumn(
			'updated_at',
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
