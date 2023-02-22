<?php
namespace CONSENTMANGER\ConsentmanagerV2\Domain\Repository;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;

/***
 *
 * This file is part of the "Consent Manager" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2021 consentmanager AB <info@consentmanager.net>, consentmanager AB
 *
 ***/
/**
 * The repository for Consentmanagers
 */
class ConsentmanagerRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    public function initializeObject() {
        $querySettings = $this->objectManager->get(\TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings::class);
        $querySettings->setRespectStoragePage(FALSE);
        $this->setDefaultQuerySettings($querySettings);
    }

    // Select DB values
    public function selectValue()
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_consentmanagerv2_domain_model_consentmanager');
        $statement = $queryBuilder
           ->select('uid','type','cmp_id','cdnurl','deliveryurl','cmpcodeid_str','custom_field')
           ->from('tx_consentmanagerv2_domain_model_consentmanager')
           ->execute();
           return $row = $statement->fetch();
    }

    // Update  DB values
    public function updateValue($data)
    {
       $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_consentmanagerv2_domain_model_consentmanager');
        $result = $queryBuilder
           ->update('tx_consentmanagerv2_domain_model_consentmanager')
           ->where(
                  $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($data['uid']))
               )
           ->set('cmp_id', $data['cmp_id'])
           ->set('type', $data['type'])
           ->set('cdnurl', $data['cdnurl'])
           ->set('deliveryurl', $data['deliveryurl'])
           ->set('cmpcodeid_str', $data['cmpcodeid_str'])
           ->set('custom_field', $data['custom_field'])
           ->execute();
           return("updated");
    }

    // Insert DB values
    public function insertValue($data)
    {
      $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_consentmanagerv2_domain_model_consentmanager');
      $result = $queryBuilder
          ->insert('tx_consentmanagerv2_domain_model_consentmanager')
          ->values([
              'cmp_id' => $data['cmp_id'],
              'type' => $data['type'],
              'cdnurl' => 'https://cdn.consentmanager.net',
              'deliveryurl' => 'https://delivery.consentmanager.net',
              'cmpcodeid_str' => $data['cmpcodeid_str'],
              'custom_field' => $data['custom_field']
          ])
          ->execute();
          return("saved");
    }
}
