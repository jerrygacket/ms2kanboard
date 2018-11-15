<?php
/** @var xPDOTransport $transport */
/** @var array $options */
/** @var modX $modx */
if ($transport->xpdo) {
    $modx =& $transport->xpdo;

    $dev = MODX_BASE_PATH . 'Extras/ms2Kanboard/';
    /** @var xPDOCacheManager $cache */
    $cache = $modx->getCacheManager();
    if (file_exists($dev) && $cache) {
        if (!is_link($dev . 'assets/components/ms2kanboard')) {
            $cache->deleteTree(
                $dev . 'assets/components/ms2kanboard/',
                ['deleteTop' => true, 'skipDirs' => false, 'extensions' => []]
            );
            symlink(MODX_ASSETS_PATH . 'components/ms2kanboard/', $dev . 'assets/components/ms2kanboard');
        }
        if (!is_link($dev . 'core/components/ms2kanboard')) {
            $cache->deleteTree(
                $dev . 'core/components/ms2kanboard/',
                ['deleteTop' => true, 'skipDirs' => false, 'extensions' => []]
            );
            symlink(MODX_CORE_PATH . 'components/ms2kanboard/', $dev . 'core/components/ms2kanboard');
        }
    }
}

return true;