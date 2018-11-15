Ext.onReady(function () {
    ms2Kanboard.config.connector_url = OfficeConfig.actionUrl;

    var grid = new ms2Kanboard.panel.Home();
    grid.render('office-ms2kanboard-wrapper');

    var preloader = document.getElementById('office-preloader');
    if (preloader) {
        preloader.parentNode.removeChild(preloader);
    }
});