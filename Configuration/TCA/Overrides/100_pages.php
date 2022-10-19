<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3_MODE') || die;

ExtensionManagementUtility::addTCAcolumns(
    'pages',
    [
        'overview_label' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:rmnd_content/Resources/Private/Language/locallang.xlf:pages.overview_label',
            'config' => [
                'type' => 'input',
            ],
        ],
    ]
);

ExtensionManagementUtility::addFieldsToPalette(
    'pages',
    'title',
    '--linebreak--,overview_label',
);
