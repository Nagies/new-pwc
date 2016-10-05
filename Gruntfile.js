module.exports = function(grunt) {
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-watch');

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    less: {
      development: {
        options: {
          paths: 'css/less',
          yuicompress: true
        },
        files: {
          "css/main.css": "css/less/main.less"
        }
      }
    },
    watch: {
      less: {
        files: 'css/less/*.less',
        tasks: 'less'
      }
    }
  });

  // Default task(s) => these run with just the 'grunt' command
  grunt.registerTask('default', ['less']);

};
