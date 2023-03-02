const Encore = require('@symfony/webpack-encore');
Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .addEntry('app', './assets/js/app.js')
    .enableSingleRuntimeChunk()
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    .enableSassLoader()
    .enablePostCssLoader()
    .enableVueLoader()
    .autoProvidejQuery()
    .enableStimulusBridge('./assets/controllers.json')
    .enableForkedTypeScriptTypesChecking()
;

module.exports = Encore.getWebpackConfig();