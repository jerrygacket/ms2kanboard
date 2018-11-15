ms2Kanboard.panel.Home = function (config) {
    config = config || {};
    Ext.apply(config, {
        baseCls: 'modx-formpanel',
        layout: 'anchor',
        /*
         stateful: true,
         stateId: 'ms2kanboard-panel-home',
         stateEvents: ['tabchange'],
         getState:function() {return {activeTab:this.items.indexOf(this.getActiveTab())};},
         */
        hideMode: 'offsets',
        items: [{
            xtype: 'modx-tabs',
            defaults: {border: false, autoHeight: true},
            border: false,
            hideMode: 'offsets',
            items: [{
                title: _('ms2kanboard_items'),
                layout: 'anchor',
                items: [{
                    html: _('ms2kanboard_intro_msg'),
                    cls: 'panel-desc',
                }, {
                    xtype: 'ms2kanboard-grid-items',
                    cls: 'main-wrapper',
                }]
            }]
        }]
    });
    ms2Kanboard.panel.Home.superclass.constructor.call(this, config);
};
Ext.extend(ms2Kanboard.panel.Home, MODx.Panel);
Ext.reg('ms2kanboard-panel-home', ms2Kanboard.panel.Home);
