<?php

declare(strict_types=1);

defined('TYPO3') or die;

(function () {
    /*******************************************************************************
     * TSConfig                                                               *
     ******************************************************************************/

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        '@import "EXT:rmnd_content/Configuration/TSConfig/Page/*.tsconfig"'
    );

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

    /*******************************************************************************
     * Route Enhancers                                                             *
     ******************************************************************************/

    $GLOBALS
        ['TYPO3_CONF_VARS']
        ['SYS']
        ['routing']
        ['enhancers']
        ['QueryExtbase'] = \Remind\Typo3Content\Routing\Enhancer\QueryExtbasePluginEnhancer::class;
})();
