<?php

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('@import "EXT:rmnd_content/Configuration/TSConfig/Page/*.tsconfig"');

/*******************************************************************************
 * Overrides                                                                   *
 ******************************************************************************/

$GLOBALS
    ['TYPO3_CONF_VARS']
    ['SC_OPTIONS']
    ['cms/layout/class.tx_cms_layout.php']
    ['tt_content_drawItem']
    ['items'] = \Remind\Typo3Content\Hooks\PageLayoutView\ItemsPreviewRenderer::class;

/*******************************************************************************
 * Icon registry                                                               *
 ******************************************************************************/

/* @var $iconRegistry \TYPO3\CMS\Core\Imaging\IconRegistry */
$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);

$iconRegistry->registerIcon(
    'content-footer',
    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
    ['source' => 'EXT:rmnd_content/Resources/Public/Icons/content-footer.svg']
);
