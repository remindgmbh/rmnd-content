<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3_MODE') || die;

ExtensionManagementUtility::addStaticFile(
    'rmnd_content',
    'Configuration/TypoScript',
    'Remind Content'
);
