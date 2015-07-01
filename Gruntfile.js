module.exports = function(grunt) {

    grunt.initConfig({
        clean: {
            build: ['public/css', 'public/js', 'public/fonts']
        },
        copy: {
            main: {
                files: [
                    {
                        expand: true,
                        flatten: true,
                        src: ['bower_components/bootstrap/dist/css/bootstrap.css'],
                        dest: 'public/css/'
                    },
                    {
                        expand: true,
                        flatten: true,
                        src: ['bower_components/bootstrap/dist/js/bootstrap.js',
                              'bower_components/jquery/dist/jquery.js'],
                        dest: 'public/js/'
                    },
                    {
                        expand: true,
                        flatten: true,
                        src: ['bower_components/bootstrap/dist/fonts/*'],
                        dest: 'public/fonts'
                    }
                ]
            }
        },
        sass: {
            dist: {
                options: {
                    style: 'expanded'
                },
                files: {
                    'public/css/main.css': 'source/sass/main.scss'
                }
            }
        },
        coffee: {
            compile: {
                options: {
                    sourceMaps: true
                },
                files: {
                    'public/js/main.js': 'source/coffee/main.coffee'
                }
            }
        },
        watch: {
            style: {
                files: ['source/sass/*.scss'],
                tasks: ['sass'],
                options: {
                    spawn: false
                }
            },
            scripts: {
                files: ['source/coffee/*.coffee'],
                tasks: ['coffee'],
                options: {
                    spawn: false
                }
            }
        }
        
    })
    
    grunt.loadNpmTasks('grunt-contrib-clean')
    grunt.loadNpmTasks('grunt-contrib-copy')
    grunt.loadNpmTasks('grunt-contrib-sass')
    grunt.loadNpmTasks('grunt-contrib-coffee')
    grunt.loadNpmTasks('grunt-contrib-watch')

    grunt.registerTask('default', ['clean', 'copy', 'sass', 'coffee', 'watch'])
                     

}
