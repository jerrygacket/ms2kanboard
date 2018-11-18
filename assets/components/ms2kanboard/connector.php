<?php
// For debug
ini_set('display_errors', 1);
ini_set('error_reporting', -1);
// Load MODX config
if (file_exists(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php')) {
    /** @noinspection PhpIncludeInspection */
    require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php';
} else {
    require_once dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/config.core.php';
}
/** @noinspection PhpIncludeInspection */
require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';
/** @noinspection PhpIncludeInspection */
require_once MODX_CONNECTORS_PATH . 'index.php';
/** @var ms2Kanboard $ms2Kanboard */
$ms2Kanboard = $modx->getService('ms2Kanboard', 'ms2Kanboard', MODX_CORE_PATH . 'components/ms2kanboard/model/');
$modx->lexicon->load('ms2kanboard:default');

// handle request
$corePath = $modx->getOption('ms2kanboard_core_path', null, $modx->getOption('core_path') . 'components/ms2kanboard/');
$path = $modx->getOption('processorsPath', $ms2Kanboard->config, $corePath . 'processors/');
$modx->getRequest();

/** @var modConnectorRequest $request */
$request = $modx->request;
$request->handleRequest([
    'processors_path' => $path,
    'location' => '',
]);