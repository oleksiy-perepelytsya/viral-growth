const { VueLoaderPlugin } = require('vue-loader');
var Encore = require('@symfony/webpack-encore'); Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .enableSassLoader()
    .addEntry('js/vue-spinner', './node_modules/vue-spinner/dist/vue-spinner.js')
    .addEntry('js/app', './assets/js/app.js')
    // .addStyleEntry('css/app', './assets/css/app.scss')
    // .enableSassLoader()
    // .autoProvidejQuery()
    // Enable Vue loader
    //.enableVueLoader()
    .addLoader({
        test: /\.vue$/,
        loader: 'vue-loader'
    })
    .addPlugin(new VueLoaderPlugin())
    .addAliases({
        vue: 'vue/dist/vue.js'
    })
    .disableSingleRuntimeChunk()
;

module.exports = Encore.getWebpackConfig();