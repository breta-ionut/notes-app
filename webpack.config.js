const Encore = require('@symfony/webpack-encore');
const dotenv = require('dotenv')

if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore.setOutputPath('public/build/')
    .setPublicPath('/build')
    .addEntry('app', './assets/app.js')
    .splitEntryChunks()
    .enableSingleRuntimeChunk()
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    .configureBabel((config) => {
        config.plugins.push('@babel/plugin-proposal-class-properties');
    })
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = 3;
    })
    .configureDefinePlugin(options => {
        const env = dotenv.config()

        if (env.error) {
            throw env.error
        }

        options['process.env'].API_BASE_URL = JSON.stringify(env.parsed.API_BASE_URL)
    })
    .enableVueLoader(() => {}, {runtimeCompilerBuild: false});

module.exports = Encore.getWebpackConfig();
