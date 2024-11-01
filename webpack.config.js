// webpack.config.js
const path = require("path");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

module.exports = {
  entry: "./public/assets/scss/main.scss",
  output: {
    path: path.resolve(__dirname, "public/assets/css"),
    filename: "main.js", // Tên file JS giả định
  },
  module: {
    rules: [
      {
        test: /\.scss$/,
        use: [MiniCssExtractPlugin.loader, "css-loader", "sass-loader"],
      },
    ],
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: "main.css", // Tên file CSS đầu ra
    }),
  ],
  mode: "development",
};
