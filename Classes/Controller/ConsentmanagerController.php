<?php
namespace CONSENTMANGER\ConsentmanagerV2\Controller;

use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\PathUtility;
use TYPO3\CMS\Core\Utility\VersionNumberUtility;
use TYPO3\CMS\Core\Messaging\FlashMessage;

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
 * ConsentmanagerController
 */
class ConsentmanagerController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * consentmanagerRepository
     * 
     * @var \CONSENTMANGER\ConsentmanagerV2\Domain\Repository\ConsentmanagerRepository
     */
    protected $consentmanagerRepository = null;

    /**
     * @param \CONSENTMANGER\ConsentmanagerV2\Domain\Repository\ConsentmanagerRepository $consentmanagerRepository
     */
    public function injectConsentmanagerRepository(\CONSENTMANGER\ConsentmanagerV2\Domain\Repository\ConsentmanagerRepository $consentmanagerRepository)
    {
        $this->consentmanagerRepository = $consentmanagerRepository;
    }

    /**
     * action list
     * 
     * @return void
     */
    public function listAction()
    {
        $baseUrlToBackend = $this->request->getBaseUri();
        $baseUrl = str_replace('typo3/','',$baseUrlToBackend);
        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
        $filePaths = $this->includeFiles();
        $this->view->assignMultiple(
            [
                'filePaths' => $filePaths,
                'baseUrl' => $baseUrl
            ]
        );
    }

    /**
     * action edit
     * 
     * @return void
     */
    public function editAction()
    {
        $consentmanager = $this->consentmanagerRepository->selectValue();
        $filePaths = $this->includeFiles();
        $this->view->assignMultiple(
            [
                'filePaths' => $filePaths,
                'consentmanagers' => $consentmanager
            ]
        );
    }

    /**
     *To include files
     */
    public function includeFiles()
    {  
        $baseUrlToBackend = $this->request->getBaseUri();
        $baseUrl = str_replace('typo3/','',$baseUrlToBackend);
        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
        $extensionPath = PathUtility::stripPathSitePrefix(
            ExtensionManagementUtility::extPath($this->request->getControllerExtensionKey()));
        $prefixPath = $baseUrl.$extensionPath;
        $typo3ver = strstr(VersionNumberUtility::getNumericTypo3Version(), ".",true );
        if($typo3ver <= '11'){
            $customCheckerCss = $prefixPath.'Resources/Public/css/custom.css';
            $jsScript = $prefixPath . 'Resources/Public/js/jquery-3.3.1.min.js';
            $customScript = $prefixPath . 'Resources/Public/js/custom.js';
        } else {
            $customCheckerCss = $extensionPath.'Resources/Public/css/custom.css';
            $jsScript = $extensionPath . 'Resources/Public/js/jquery-3.3.1.min.js';
            $customScript = $extensionPath . 'Resources/Public/js/custom.js';
        }
        $filePaths = [
            'customCheckerCss' => $customCheckerCss,
            'jsScript' => $jsScript,
            'customScript' => $customScript
        ];
        return $filePaths;
    }

    /**
     * action check
     * 
     * @return void
     */
    public function checkAction()
    {
        $userData = $this->request->getArguments();
        if(!empty($userData['cmpId']) && !empty($userData['type'])) {
            $consentmanagers = $this->consentmanagerRepository->selectValue();

            // Check CMP Code ID value is string or integer for fallback
            $cmpcodeid_check = (is_numeric($userData['cmpId'])) ? 0 : 1;
            $cdnUrl = (!empty($userData['cdnurl'])) ? $userData['cdnurl'] : 'https://cdn.consentmanager.net';
            $deliveryUrl = (!empty($userData['deliveryurl'])) ? $userData['deliveryurl'] : 'https://delivery.consentmanager.net';
            
            // data array
            $updateData = [
                'cmp_id' => $userData['cmpId'],
                'type' => $userData['type'],
                'cdnurl' => $cdnUrl,
                'deliveryurl' => $deliveryUrl,
                'custom_field' => $userData['customField'],
                'uid' => $consentmanagers['uid'],
                'cmpcodeid_str' => $cmpcodeid_check
            ];

            //value update to DB
            if (!empty($consentmanagers['cmp_id']) && !empty($consentmanagers['type'])) {
                $updateValue = $this->consentmanagerRepository->updateValue($updateData);
                if($updateValue == "updated") {
                    $this->addFlashMessage('Your data has been updated successfully');
                } 
            } else {
                $insertValue = $this->consentmanagerRepository->insertValue($updateData);
                if($insertValue == "saved") {
                    $this->addFlashMessage('Your data has been saved successfully');
                }
            }
            $this->redirect('edit');
        } else {
            $this->redirect('edit');
        }
    }
}
