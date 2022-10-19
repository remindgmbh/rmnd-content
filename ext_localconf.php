<?php

declare(strict_types=1);

use Remind\Typo3Content\Routing\Enhancer\QueryExtbasePluginEnhancer;
use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;
use TYPO3\CMS\Core\Imaging\IconRegistry;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

defined('TYPO3') or die;

(function () {
    /*******************************************************************************
     * TSConfig                                                               *
     ******************************************************************************/

    ExtensionManagementUtility::addPageTSConfig(
        '@import "EXT:rmnd_content/Configuration/TSConfig/Page/*.tsconfig"'
    );

    /*******************************************************************************
     * Icon registry                                                               *
     ******************************************************************************/

    /* @var $iconRegistry \TYPO3\CMS\Core\Imaging\IconRegistry */
    $iconRegistry = GeneralUtility::makeInstance(IconRegistry::class);

    $iconRegistry->registerIcon(
        'content-footer',
        SvgIconProvider::class,
        ['source' => 'EXT:rmnd_content/Resources/Public/Icons/content-footer.svg']
    );

    /*******************************************************************************
     * Route Enhancers                                                             *
     ******************************************************************************/

    $GLOBALS
        ['TYPO3_CONF_VARS']
        ['SYS']
        ['routing']
        ['enhancers']
        ['QueryExtbase'] = QueryExtbasePluginEnhancer::class;
})();
