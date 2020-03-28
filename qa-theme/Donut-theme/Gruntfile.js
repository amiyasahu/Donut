module.exports = function(grunt) {
    require('jit-grunt')(grunt);
  
    grunt.initConfig({
      uglify: {
        production: {
          files: {
           'js/donut.min.js': ['js/donut.js'] // destination file and source file
          }
        }
      },
      less: {
        development: {
          files: {
            "css/donut.css": "less/donut.less" // destination file and source file
          }
        },
        production: {
            options: {
              compress: true,
              yuicompress: true,
              optimization: 2
            },
            files: {
              "css/donut.min.css": "less/donut.less" // destination file and source file
            }
          }
      },
      watch: {
        styles: {
          files: ['less/**/*.less', 'js/**/*.js'], // which files to watch
          tasks: ['less', 'uglify'],
          options: {
            nospawn: true
          }
        }
      }
    });
  
    grunt.registerTask('default', ['uglify', 'less', 'watch']);
  };