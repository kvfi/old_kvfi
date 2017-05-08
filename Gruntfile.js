module.exports = function(grunt) {
    require('load-grunt-tasks')(grunt);
    grunt.initConfig({
        concat: {
            js: {
                src: ['src/js/**/*.js'],
                dest: 'static/dist/js/scripts.js',
            }
        },
        uglify: {
            my_target: {
                files: {
                    'static/dist/js/scripts.js': ['static/dist/js/scripts.js']
                }
            }
        },
        sass: {
            dist: {
                files: {
                    'static/dist/css/app.css': 'src/css/main.scss'
                }
            }
        },
        cssmin: {
            options: {
                shorthandCompacting: false,
                roundingPrecision: -1
            },
            target: {
                files: {
                  'static/dist/css/app.css': ['static/dist/css/app.css']
                }
            }
        },
        watch: {
            js: {
                files: 'src/js/**/*.js',
                tasks: ['concat:js', 'uglify'],
            },
            sass: {
                files: 'src/css/**/*.scss',
                tasks: ['sass', 'cssmin']
            }
           
        }
    });

    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.registerTask('default', ['concat', 'uglify', 'sass', 'cssmin', 'watch']);

};