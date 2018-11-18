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
            html: '<h2>' + _('ms2kanboard') + '</h2>',
            cls: '',
            style: {margin: '15px 0'}
        }, {
            xtype: 'modx-tabs',
            defaults: {border: false, autoHeight: true},
            border: true,
            hideMode: 'offsets',
            items: [{
                title: _('ms2kanboard_newsletters'),
                layout: 'anchor',
                items: [{
                    html: _('ms2kanboard_newsletters_intro'),
                    cls: 'panel-desc',
                }, {
                    xtype: 'ms2kanboard-grid-newsletters',
                    cls: 'main-wrapper',
                }]
            }]
        }]
    });
    ms2Kanboard.panel.Home.superclass.constructor.call(this, config);
};
Ext.extend(ms2Kanboard.panel.Home, MODx.Panel);
Ext.reg('ms2kanboard-panel-home', ms2Kanboard.panel.Home);
