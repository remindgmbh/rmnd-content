<?php

declare(strict_types=1);

namespace Remind\Typo3Content\TCA;

use PDO;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class DisplayCond
{
    public function parentIsRoot(array $args): bool
    {
        ['record' => $record] = $args;

        /** @var QueryBuilder $queryBuilder */
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('pages');
        $statement = $queryBuilder
            ->select('is_siteroot')
            ->from('pages')
            ->where(
                $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($record['pid'], PDO::PARAM_INT))
            )
            ->execute();

        return (bool) $statement->fetchOne();
    }
}
