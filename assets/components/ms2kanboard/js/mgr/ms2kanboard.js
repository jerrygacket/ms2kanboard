var ms2Kanboard = function (config) {
    config = config || {};
    ms2Kanboard.superclass.constructor.call(this, config);
};
Ext.extend(ms2Kanboard, Ext.Component, {
    page: {}, window: {}, grid: {}, tree: {}, panel: {}, combo: {}, config: {}, view: {}, utils: {}
});
Ext.reg('ms2kanboard', ms2Kanboard);

ms2Kanboard = new ms2Kanboard();