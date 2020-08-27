var Encore = require('@symfony/webpack-encore');

// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .setManifestKeyPrefix('build')

    .addStyleEntry('css-backend', ['./easycontrol/backend/assets/scss/all.scss'])

    .splitEntryChunks()
    .enableSingleRuntimeChunk()

    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())

    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = 3;
    })

    .enableSassLoader()
    .autoProvidejQuery()
    .autoProvideVariables({
        $: 'jquery',
        jQuery: 'jquery',
        'window.jQuery': 'jquery',
    })

    .enablePostCssLoader((options) => {
        options.config = {
            path: 'postcss.config.js'
        };
    })

    .copyFiles({
        from: './easycontrol/backend/assets/vendor',
        to: 'backend/vendor/[path][name].[ext]',
    })
    .copyFiles({
        from: './easycontrol/backend/assets/images',
        to: 'backend/images/[path][name].[ext]',
    })
    .copyFiles({
        from: './easycontrol/backend/assets/js',
        to: 'backend/js/[path][name].[ext]',
    })
;

module.exports = Encore.getWebpackConfig();
