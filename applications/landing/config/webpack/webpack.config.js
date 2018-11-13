const webpack = require( 'webpack' );
const {resolve} = require( 'path' );
const paths = require( './paths' );
const CleanWebpackPlugin = require( 'clean-webpack-plugin' );
const ExtractTextWebpackPlugin = require( 'extract-text-webpack-plugin' );
const IconFontWebpackPlugin = require( 'icon-font-loader' ).Plugin;
const UglifyJsWebpackPlugin = require( 'uglifyjs-webpack-plugin' );
const CopyWebpackPlugin = require( 'copy-webpack-plugin' );
const variables = require( `./variables.${process.env.NODE_ENV}` );
const isDevelopmentEnvironment = process.env.NODE_ENV === 'dev';
const excludedModules = [
    /node_modules/
];

const extractTextPlugin = new ExtractTextWebpackPlugin( {
    filename: "[name].css"
} );

const iconFontPlugin = new IconFontWebpackPlugin( {
    fontName: 'iconfont',
    output: './fonts/',
    property: 'fmicon',
    auto: false,
    mergeDuplicates: true
} );

let config = {
    entry: {
        homePage: `${paths.basePath}pages/home`
    },
    output: {
        filename: '[name].js',
        chunkFilename: '[name].[chunkhash].js',
        path: paths.distPath
    },

    module: {
        rules: [
            {
                test: /\.js$/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['env'],
                        cacheDirectory: isDevelopmentEnvironment,
                        sourceMap: isDevelopmentEnvironment
                    }
                },
                exclude: excludedModules
            },
            {
                test: /\.scss$/,
                use: extractTextPlugin.extract( {
                    use: [{
                        loader: 'css-loader',
                        options: {
                            minimize: !isDevelopmentEnvironment
                        }
                    }, {
                        loader: 'icon-font-loader'
                    }, {
                        loader: 'resolve-url-loader',
                        options: {
                            attempts: 1
                        }
                    }, {
                        loader: "sass-loader",
                        options: {
                            sourceMap: true
                        }
                    }],
                    fallback: 'style-loader'
                } )
            },
            {
                test: /\.(ttf|eot|svg|woff|woff2|ico|png|gif|jpg|jpeg)/,
                use: {
                    loader: 'file-loader',
                    options: {
                        name: '[path][name].[ext]',
                        context: paths.basePath
                    }
                }
            },
            {
                test: require.resolve('jquery'),
                use: [{
                    loader: 'expose-loader',
                    options: '$'
                }]
            },
            {
                test: /bootstrap[\/\\]dist[\/\\]js[\/\\]umd[\/\\]/,
                use: [{
                    loader: 'imports-loader',
                    options: {jQuery: 'jquery'}
                }]
            }
        ]
    },

    plugins: [
        new webpack.DefinePlugin( {
            'process.env': JSON.stringify( variables )
        } ),
        new UglifyJsWebpackPlugin( {
            sourceMap: isDevelopmentEnvironment,
            exclude: excludedModules,
            cache: true,
            parallel: 4,
            uglifyOptions: {
                output: {
                    ascii_only: true,
                    comments: false,
                    beautify: false
                },
                warnings: false
            }
        } ),
        new webpack.optimize.ModuleConcatenationPlugin(),
        new CleanWebpackPlugin( [paths.relativeDistPath], {root: paths.root} ),
        new CopyWebpackPlugin( [
            {from: paths.imagesPath, to: paths.imagesDistPath}
        ] ),
        new webpack.ProvidePlugin({
            'window.jQuery': 'jquery',
            '$': 'jquery',
            jQuery: 'jquery',
            Popper: ['popper.js', 'default'],
            'Util': "exports-loader?Util!bootstrap/js/dist/util",
            'Tooltip': "exports-loader?Tooltip!bootstrap/js/dist/tooltip"
        }),
        extractTextPlugin,
        iconFontPlugin
    ],

    devtool: isDevelopmentEnvironment ? 'source-map' : false,

};

module.exports = config;
