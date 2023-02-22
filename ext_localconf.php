<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {
		$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
		
		$iconRegistry->registerIcon(
			'consent_manager-plugin-consentmanagers',
			\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
			['source' => 'EXT:consentmanager_v2/Resources/Public/Icons/user_plugin_consentmanagers.svg']
		);

        if (TYPO3_MODE === 'FE') {
            $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tslib/class.tslib_fe.php']['contentPostProc-all'][] = \CONSENTMANGER\ConsentmanagerV2\Hooks\GlobalSettings::class . '->cleanUncachedContent';
        }
    }
);
