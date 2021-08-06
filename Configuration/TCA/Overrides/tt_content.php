<?php
defined('TYPO3_MODE') || die;

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
    'tt_content',
    [
        'rmnd_content_items' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:rmnd_content/Resources/Private/Language/locallang_db.xlf:tt_content.rmnd_content_items',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'rmnd_content_items',
                'foreign_field' => 'tt_content',
            ]
        ],
    ]
);
