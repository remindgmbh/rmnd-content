<?php

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('@import "EXT:rmnd_content/Configuration/TSConfig/Page/*.tsconfig"');

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem']['items'] = \Remind\Content\Hooks\PageLayoutView\ItemsPreviewRenderer::class;
