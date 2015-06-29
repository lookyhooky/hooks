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
        }
    })
    
    grunt.loadNpmTasks('grunt-contrib-clean')
    grunt.loadNpmTasks('grunt-contrib-copy')
    grunt.loadNpmTasks('grunt-contrib-sass')
    grunt.loadNpmTasks('grunt-contrib-coffee')

    grunt.registerTask('default', ['clean', 'copy'])
                     

}
