<?php

declare(strict_types=1);

namespace Remind\Content\Hooks\PageLayoutView;

use Doctrine\DBAL\Driver\Statement;
use TYPO3\CMS\Backend\View\PageLayoutView;
use TYPO3\CMS\Backend\View\PageLayoutViewDrawItemHookInterface;
use TYPO3\CMS\Core\Localization\LanguageService;

/**
 * ItemsPreviewRenderer
 */
class ItemsPreviewRenderer implements PageLayoutViewDrawItemHookInterface
{
    /**
     * Preprocesses the preview rendering of the content element "text".
     *
     * @param PageLayoutView $parentObject Calling parent object
     * @param bool $drawItem Whether to draw the item using the default functionalities
     * @param string $headerContent Header content
     * @param string $itemContent Item content
     * @param array $row Record row of tt_content
     */
    public function preProcess(
        PageLayoutView &$parentObject,
        &$drawItem,
        &$headerContent,
        &$itemContent,
        array &$row
    ) {
        if ($row['rmnd_content_items'] > 0) {
            $queryBuilder = $parentObject->getQueryBuilder('rmnd_content_items', $parentObject->id);
            $queryBuilder->where($queryBuilder->expr()->eq('tt_content', $row['uid']));

            /** @var Statement $result */
            $result = $queryBuilder->execute();
            $items = $parentObject->getResult($result);

            $lastKey = end(array_keys($items));

            foreach ($items as $key => $item) {
                if ($item['header']) {
                    $itemContent .= $this->renderItemHeader($item, $row, $parentObject);
                }

                if ($item['bodytext']) {
                    $itemContent .= $parentObject->linkEditContent(
                        $parentObject->renderText($item['bodytext']),
                        $row
                    ) . '<br />';
                }

                if ($item['image']) {
                    $itemContent .= $parentObject->linkEditContent(
                        $parentObject->getThumbCodeUnlinked($item, 'rmnd_content_items', 'image'),
                        $row
                    ) . '<br />';
                }

                if ($key !== $lastKey) {
                    $itemContent .= '<br />';
                }
            }

            $drawItem = false;
        }
    }

    /**
     *
     * @param array $item
     * @param array $row
     * @param PageLayoutView $parentObject
     * @return string
     */
    public function renderItemHeader(array $item, array $row, PageLayoutView &$parentObject): string
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
                        . $parentObject->linkEditContent($parentObject->renderText($item['header']), $row)
                        . $hiddenHeaderNote
                        . '</strong><br />';
        }

        return $outHeader;
    }

    /**
     *
     * @todo check type safety
     *
     * @return LanguageService
     */
    protected function getLanguageService(): LanguageService
    {
        return $GLOBALS['LANG'];
    }
}
