module.exports = function(grunt) {
    require('load-grunt-tasks')(grunt);
    grunt.initConfig({
        concat: {
            js: {
                src: ['public/static/src/js/**/*.js'],
                dest: 'public/static/dist/js/scripts.js',
            }
        },
        uglify: {
            my_target: {
                files: {
                    'public/static/dist/js/scripts.js': ['public/static/dist/js/scripts.js']
                }
            }
        },
        sass: {
            dist: {
                files: {
                    'public/static/dist/css/app.css': 'public/static/src/css/main.scss'
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
                  'public/static/dist/css/app.css': ['public/static/dist/css/app.css']
                }
            }
        },
        watch: {
            js: {
                files: 'public/static/src/js/**/*.js',
                tasks: ['concat:js', 'uglify'],
            },
            sass: {
                files: 'public/static/src/css/**/*.scss',
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