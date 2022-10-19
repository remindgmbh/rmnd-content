<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die;

(function () {
    ExtensionManagementUtility::allowTableOnStandardPages('rmnd_content_items');
})();
