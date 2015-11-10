module.exports = {
      readme_txt: {
        src: [ 'readme.txt' ],
        overwrite: true,
        replacements: [{
          from: /Stable tag: (.*)/,
          to: "Stable tag: <%= pkg.version %>"
        }]
      },
      main_php: {
        src: [ '<%= pkg.pot.src %>' ],
        overwrite: true,
        replacements: [{
          from: /define(.*)_VER'.*/,
          to: "define( '<%= pkg.constant.ver %>' , '<%= pkg.version %>' );"
        },{
          from: / Version:\s*(.*)/,
          to: " Version: <%= pkg.version %>"
        },{
          from: / Description:\s*(.*)/,
          to: " Description:     <%= pkg.description %>"
        },{
          from: / Text Domain:\s*(.*)/,
          to: " Text Domain:     <%= pkg.pot.textdomain %>"
        }]
      }
    };