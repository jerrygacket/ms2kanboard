ms2Kanboard.page.Home = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        components: [{
            xtype: 'ms2kanboard-panel-home',
            renderTo: 'ms2kanboard-panel-home-div'
        }]
    });
    ms2Kanboard.page.Home.superclass.constructor.call(this, config);
};
Ext.extend(ms2Kanboard.page.Home, MODx.Component);
Ext.reg('ms2kanboard-page-home', ms2Kanboard.page.Home);