<?php
defined('TYPO3_MODE') || die('Access denied.');
use TYPO3\CMS\Core\Utility\VersionNumberUtility;

call_user_func(
    function()
    {
        $typo3ver = strstr(VersionNumberUtility::getNumericTypo3Version(), ".",true );
        if($typo3ver <= '9'){ 
            if (TYPO3_MODE === 'BE') {
                \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
                    'CONSENTMANGER.ConsentmanagerV2',
                    'web', // Make module a submodule of 'web'
                    'consentmanagerv2', // Submodule key
                    '', // Position
                    [
                        'Consentmanager' => 'list, check, edit',
                    ],
                    [
                        'access' => 'user,group',
                        'icon'   => 'EXT:consentmanager_v2/Resources/Public/Icons/user_mod_consentmanagerv2.svg',
                        'labels' => 'LLL:EXT:consentmanager_v2/Resources/Private/Language/locallang_consentmanagerv2.xlf',
                    ]
                );
            }
        } else {
            if (TYPO3_MODE === 'BE') {
                \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
                    'CONSENTMANGER.ConsentmanagerV2',
                    'web', // Make module a submodule of 'web'
                    'consentmanagerv2', // Submodule key
                    '', // Position
                    [
                        CONSENTMANGER\ConsentmanagerV2\Controller\ConsentmanagerController::class => 'list, check, edit',
                    ],
                    [
                        'access' => 'user,group',
                        'icon'   => 'EXT:consentmanager_v2/Resources/Public/Icons/user_mod_consentmanagerv2.svg',
                        'labels' => 'LLL:EXT:consentmanager_v2/Resources/Private/Language/locallang_consentmanagerv2.xlf',
                    ]
                );
            }
        }

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('consentmanager_v2', 'Configuration/TypoScript', 'Consent Manager');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_consentmanagerv2_domain_model_consentmanager', 'EXT:consentmanager_v2/Resources/Private/Language/locallang_csh_tx_consentmanagerv2_domain_model_consentmanager.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_consentmanagerv2_domain_model_consentmanager');

    }
);
