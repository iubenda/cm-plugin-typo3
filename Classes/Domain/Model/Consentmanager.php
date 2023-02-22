<?php
namespace CONSENTMANGER\ConsentmanagerV2\Domain\Model;


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
 * Consentmanager
 */
class Consentmanager extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * cmpId
     * 
     * @var string
     */
    protected $cmpId = '';

    /**
     * type
     * 
     * @var string
     */
    protected $type = '';

    /**
     * customField
     * 
     * @var string
     */
    protected $customField = '';

    /**
     * Returns the cmpId
     * 
     * @return string $cmpId
     */
    public function getCmpId()
    {
        return $this->cmpId;
    }

    /**
     * Sets the cmpId
     * 
     * @param string $cmpId
     * @return void
     */
    public function setCmpId($cmpId)
    {
        $this->cmpId = $cmpId;
    }

    /**
     * Returns the type
     * 
     * @return string $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets the type
     * 
     * @param string $type
     * @return void
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Returns the customField
     * 
     * @return string $customField
     */
    public function getCustomField()
    {
        return $this->customField;
    }

    /**
     * Sets the customField
     * 
     * @param string $customField
     * @return void
     */
    public function setCustomField($customField)
    {
        $this->customField = $customField;
    }
}
