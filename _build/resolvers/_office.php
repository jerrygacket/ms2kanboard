<?php
/** @var xPDOTransport $transport */
/** @var array $options */
/** @var modX $modx */
if ($transport->xpdo) {
    $modx =& $transport->xpdo;
    /** @var Office $office */
    if ($Office = $modx->getService('Office', 'Office', MODX_CORE_PATH . 'components/office/model/office/')) {
        if (!($Office instanceof Office)) {
            $modx->log(xPDO::LOG_LEVEL_ERROR, '[ms2Kanboard] Could not register paths for Office component!');

            return true;
        } elseif (!method_exists($Office, 'addExtension')) {
            $modx->log(xPDO::LOG_LEVEL_ERROR,
                '[ms2Kanboard] You need to update Office for support of 3rd party packages!');

            return true;
        }

        /** @var array $options */
        switch ($options[xPDOTransport::PACKAGE_ACTION]) {
            case xPDOTransport::ACTION_INSTALL:
            case xPDOTransport::ACTION_UPGRADE:
                $Office->addExtension('ms2Kanboard', '[[++core_path]]components/ms2kanboard/controllers/office/');
                $modx->log(xPDO::LOG_LEVEL_INFO, '[ms2Kanboard] Successfully registered ms2Kanboard as Office extension!');
                break;

            case xPDOTransport::ACTION_UNINSTALL:
                $Office->removeExtension('ms2Kanboard');
                $modx->log(xPDO::LOG_LEVEL_INFO, '[ms2Kanboard] Successfully unregistered ms2Kanboard as Office extension.');
                break;
        }
    }
}

return true;