<?php

/**
 * The home manager controller for ms2Kanboard.
 *
 */
class ms2KanboardHomeManagerController extends modExtraManagerController
{
    /** @var ms2Kanboard $ms2Kanboard */
    public $ms2Kanboard;


    /**
     *
     */
    public function initialize()
    {
        $this->ms2Kanboard = $this->modx->getService('ms2Kanboard', 'ms2Kanboard', MODX_CORE_PATH . 'components/ms2kanboard/model/');
        parent::initialize();
    }


    /**
     * @return array
     */
    public function getLanguageTopics()
    {
        return ['ms2kanboard:default'];
    }


    /**
     * @return bool
     */
    public function checkPermissions()
    {
        return true;
    }


    /**
     * @return null|string
     */
    public function getPageTitle()
    {
        return $this->modx->lexicon('ms2kanboard');
    }


    /**
     * @return void
     */
    public function loadCustomCssJs()
    {
        $this->addCss($this->ms2Kanboard->config['cssUrl'] . 'mgr/main.css');
        $this->addJavascript($this->ms2Kanboard->config['jsUrl'] . 'mgr/ms2kanboard.js');
        $this->addJavascript($this->ms2Kanboard->config['jsUrl'] . 'mgr/misc/utils.js');
        $this->addJavascript($this->ms2Kanboard->config['jsUrl'] . 'mgr/misc/combo.js');
        $this->addJavascript($this->ms2Kanboard->config['jsUrl'] . 'mgr/widgets/items.grid.js');
        $this->addJavascript($this->ms2Kanboard->config['jsUrl'] . 'mgr/widgets/items.windows.js');
        $this->addJavascript($this->ms2Kanboard->config['jsUrl'] . 'mgr/widgets/home.panel.js');
        $this->addJavascript($this->ms2Kanboard->config['jsUrl'] . 'mgr/sections/home.js');

        $this->addHtml('<script type="text/javascript">
        ms2Kanboard.config = ' . json_encode($this->ms2Kanboard->config) . ';
        ms2Kanboard.config.connector_url = "' . $this->ms2Kanboard->config['connectorUrl'] . '";
        Ext.onReady(function() {MODx.load({ xtype: "ms2kanboard-page-home"});});
        </script>');
    }


    /**
     * @return string
     */
    public function getTemplateFile()
    {
        $this->content .= '<div id="ms2kanboard-panel-home-div"></div>';

        return '';
    }
}