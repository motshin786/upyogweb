const path = require("path");

module.exports = {
  entry: "./assets/js/admin.js",
  output: {
    path: path.resolve(__dirname, "assets/js"),
    filename: "admin.min.js",
  },  
  mode: "production",
};
