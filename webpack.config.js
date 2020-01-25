const webpack = require('webpack');

const Dotenv = require('dotenv-webpack');

module.exports = {
    watch: true,
    watchOptions: {
        aggregateTimeout: 300,
        poll: 1000,
        ignored: /node_modules/
    },
    entry: {
        main: `${__dirname}/resources/runtime/index.js`
    },
    output: {
        path: `${__dirname}/public/dist`,
        filename: 'runtime.js'
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: [
                            '@babel/preset-env'
                        ],
                        plugins: [
                            '@babel/plugin-proposal-class-properties'
                        ]
                    }
                }
            }
        ]
    },
    plugins: [
        new Dotenv()
    ]
};
