<?php

declare(strict_types=1);

namespace Remind\Typo3Content\Backend\Preview;

use TYPO3\CMS\Backend\View\BackendLayout\Grid\GridColumnItem;
use TYPO3\CMS\Backend\Preview\StandardContentPreviewRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;

class ContentWithItemsPreviewRenderer extends StandardContentPreviewRenderer
{

    public function renderPageModulePreviewContent(GridColumnItem $item): string
    {
        $out = parent::renderPageModulePreviewContent($item);

        $record = $item->getRecord();

        if ($record['rmnd_content_items']) {
            $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('rmnd_content_items')->createQueryBuilder();
            $queryBuilder
                ->select('*')
                ->from('rmnd_content_items')
                ->where($queryBuilder->expr()->eq('tt_content', $record['uid']));

            $result = $queryBuilder->execute();
            $rmndContentItems = $result->fetchAllAssociative();

            $itemContent = '<br />';

            $lastKey = array_key_last($rmndContentItems);

            foreach ($rmndContentItems as $key => $rmndContentItem) {
                if ($rmndContentItem['header']) {
                    $itemContent .= $this->renderItemHeader($rmndContentItem);
                }

                if ($rmndContentItem['bodytext']) {
                    $itemContent .= $this->renderText($rmndContentItem['bodytext']) . '<br />';
                }

                if ($rmndContentItem['image']) {
                    $itemContent .= $this->getThumbCodeUnlinked($rmndContentItem, 'rmnd_content_items', 'image') . '<br />';
                }

                if ($lastKey !== $key) {
                    $itemContent .= '<br />';
                }
            }

            $out .= $this->linkEditContent($itemContent, $record);
        }

        return $out;
    }

    private function renderItemHeader(array $item): string
    {
        $outHeader = '';

        // Make header:
        if ($item['header']) {
            $hiddenHeaderNote = '';

            // If header layout is set to 'hidden', display an accordant note:
            if ($item['header_layout'] == 100) {
                $hiddenHeaderNote = ' <em>[' . htmlspecialchars($this->getLanguageService()->sL(
                    'LLL:EXT:core/Resources/Private/Language/locallang_core.xlf:labels.hidden'
                )) . ']</em>';
            }

            $outHeader .= '<strong>'
                        . $this->renderText($item['header'])
                        . $hiddenHeaderNote
                        . '</strong><br />';
        }

        return $outHeader;
    }
}
