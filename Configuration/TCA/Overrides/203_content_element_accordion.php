<?php

defined('TYPO3_MODE') || die;

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'LLL:EXT:rmnd_content/Resources/Private/Language/locallang.xlf:content_element.accordion.title',
        'accordion',
        'content-accordion',
    ],
    'header',
    'after'
);

$GLOBALS['TCA']['tt_content']['types']['accordion'] = [
    'showitem' => '
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
            --palette--;;general,
            --palette--;;headers,
            rmnd_content_items,
        --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
            --palette--;;frames,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
            --palette--;;language,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
            --palette--;;hidden,
            --palette--;;access,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
            categories,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
            rowDescription,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
    ',
    'columnsOverrides' => [
        'rmnd_content_items' => [
            'config' => [
                'overrideChildTca' => [
                    'types' => [
                        '0' => [
                            'showitem' => '
                                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                                    --palette--;;headers,
                                    title;LLL:EXT:rmnd_content/Resources/Private/Language/locallang.xlf:content_element.accordion.columns.title,
                                    bodytext;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:bodytext_formlabel,
                                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
                                    --palette--;;frames,
                                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                                    --palette--;;hidden,
                                    --palette--;;access,
                                --palette--;;hiddenLanguagePalette,
                            ',
                        ],
                    ],
                ],
            ],
        ],
    ],
];
