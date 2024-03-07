let jsConfig = {
  resolve: {
    modules: [
      './node_modules',
      __dirname + '/assets/ts',
      __dirname + '/assets',
      __dirname + '/include/classes'
    ],
    extensions: [".ts", ".tsx", ".js", ".json"],
  },
  name: 'js',

  entry: {
    javascript: __dirname + '/assets/js/index.js',
  },

  output: {
    path: __dirname + '/html/javascript/',
    publicPath: '/javascript/',
    filename: 'main.js',
  },

  module: {
    rules: [
      {
        test: /\.tsx?$/,
        loader: 'ts-loader',
        exclude: /node_modules/,
      },
      {
        test: /\.s[ac]ss$/i,
        use: [
          // Creates `style` nodes from JS strings
          "style-loader",
          // Translates CSS into CommonJS
          "css-loader",
          // Compiles Sass to CSS
          "sass-loader",
        ],
      },
    ]
  }
};

let cssConfig = {
  entry: {
    style: __dirname + '/assets/scss/style.scss',
  },

  output: {
    path: __dirname + '/html/css/',
    filename: 'style.css',
  },

  module: {
    rules: [
      {
        test: /\.s[ac]ss$/i,
        use: [
          // Creates `style` nodes from JS strings
          "style-loader",
          // Translates CSS into CommonJS
          "css-loader",
          // Compiles Sass to CSS
          "sass-loader",
        ],
      },
    ],
  },
};

module.exports = [jsConfig, cssConfig];
