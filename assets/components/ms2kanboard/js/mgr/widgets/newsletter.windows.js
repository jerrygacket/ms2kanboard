ms2Kanboard.window.Createnewsletter = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'ms2kanboard-newsletter-window-create';
    }
    Ext.applyIf(config, {
        title: _('ms2kanboard_newsletter_create'),
        width: 550,
        autoHeight: true,
        url: ms2Kanboard.config.connector_url,
        action: 'mgr/newsletter/create',
        fields: this.getFields(config),
        keys: [{
            key: Ext.EventObject.ENTER, shift: true, fn: function () {
                this.submit()
            }, scope: this
        }]
    });
    ms2Kanboard.window.Createnewsletter.superclass.constructor.call(this, config);
};
Ext.extend(ms2Kanboard.window.Createnewsletter, MODx.Window, {

    getFields: function (config) {
        return [{
            xtype: 'textfield',
            fieldLabel: _('ms2kanboard_newsletter_name'),
            name: 'name',
            id: config.id + '-name',
            anchor: '99%',
            allowBlank: false,
        }, {
            xtype: 'textarea',
            fieldLabel: _('ms2kanboard_newsletter_description'),
            name: 'description',
            id: config.id + '-description',
            height: 150,
            anchor: '99%'
        }, {
            xtype: 'xcheckbox',
            boxLabel: _('ms2kanboard_newsletter_active'),
            name: 'active',
            id: config.id + '-active',
            checked: true,
        }];
    },

    loadDropZones: function () {
    }

});
Ext.reg('ms2kanboard-newsletter-window-create', ms2Kanboard.window.Createnewsletter);


ms2Kanboard.window.Updatenewsletter = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'ms2kanboard-newsletter-window-update';
    }
    Ext.applyIf(config, {
        title: _('ms2kanboard_newsletter_update'),
        width: 550,
        autoHeight: true,
        url: ms2Kanboard.config.connector_url,
        action: 'mgr/newsletter/update',
        fields: this.getFields(config),
        keys: [{
            key: Ext.EventObject.ENTER, shift: true, fn: function () {
                this.submit()
            }, scope: this
        }]
    });
    ms2Kanboard.window.Updatenewsletter.superclass.constructor.call(this, config);
};
Ext.extend(ms2Kanboard.window.Updatenewsletter, MODx.Window, {

    getFields: function (config) {
        return [{
            xtype: 'hidden',
            name: 'id',
            id: config.id + '-id',
        }, {
            xtype: 'textfield',
            fieldLabel: _('ms2kanboard_newsletter_name'),
            name: 'name',
            id: config.id + '-name',
            anchor: '99%',
            allowBlank: false,
        }, {
            xtype: 'textarea',
            fieldLabel: _('ms2kanboard_newsletter_description'),
            name: 'description',
            id: config.id + '-description',
            anchor: '99%',
            height: 150,
        }, {
            xtype: 'xcheckbox',
            boxLabel: _('ms2kanboard_newsletter_active'),
            name: 'active',
            id: config.id + '-active',
        }];
    },

    loadDropZones: function () {
    }

});
Ext.reg('ms2kanboard-newsletter-window-update', ms2Kanboard.window.Updatenewsletter);