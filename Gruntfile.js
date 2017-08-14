/**
 * @file
 * Tasks for building the styleguide an css.
 */

'use strict';

module.exports = function (grunt) {

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    watch: {
      sass: {
        files: ['**/*.{scss,sass}', 'sass/**/*.html'],
        tasks: ['sasslint', 'clean:styleguide', 'sass', 'postcss', 'shell', 'copy:main'],
        options: {
          livereload: true
        }
      },
      fonts: {
        files: ['fonts/europa-icons-src/*'],
        tasks: ['cacheBustAll'],
        options: {
          interrupt: true
        }
      }
    },
    clean: {
      styleguide: ['styleguide/assets'],
      fonts: ['fonts/europa-icons/*']
    },
    sass: {
      options: {
        sourceMap: true
      },
      dist: {
        files: {
          'css/europa_styleguide.css': 'sass/styleguide.scss',
          'css/style-sass-base.css': 'sass/app_base.scss',
          'css/style-sass-components.css' : 'sass/app_components.scss'
        }
      }
    },
    cacheBust: {
      fonts: {
        options: {
          baseDir: 'sass',
          assets: ['../fonts/europa-icons-src/*'],
          length: 8,
          outputDir: '../fonts/europa-icons',
          clearOutputDir: true
        },
        files: [{
          cwd: 'sass/components',
          src: ['_icon.scss']
        }]
      }
    },
    shell: {
      kss: {
        command: './node_modules/.bin/kss --config kss-config.json'
      }
    },
    sasslint: {
      options: {
        bench: true,
        config: '~/.sasslint.json'
      },
      target: ['sass/**/*.{scss,sass}', 'sass/*.{scss,sass}']
    },
    postcss: {
      options: {
        map: false,
        processors: [
          require('postcss-discard-comments'),
          require('autoprefixer')({browsers: 'last 2 versions'}),
          require('cssnano')()
        ]
      },
      dist: {
        src: 'css/*.css'
      }
    },
    replace: {
      prepare: {
        src: ['sass/components/_icon.scss'],
        dest: 'sass/components/_icon.scss',
        replacements: [{
          from: /fonts\/europa-icons\/europa-icons\.(.*?)\./g,
          to: 'fonts/europa-icons-src/europa-icons.'
        }]
      },
      restore: {
        src: ['sass/components/_icon.scss'],
        dest: 'sass/components/_icon.scss',
        replacements: [{
          from: 'europa-icons-src',
          to: 'europa-icons'
        }]
      }
    },
    copy: {
      main: {
        files: [
          // Includes files within path and its sub-directories.
          {expand: true, src: ['images/**'], dest: 'styleguide/assets/public/'},
          {expand: true, src: ['css/**'], dest: 'styleguide/assets/public/'},
          {expand: true, src: ['fonts/**'], dest: 'styleguide/assets/public/'},
          {expand: true, src: ['js/**'], dest: 'styleguide/assets/public/'},
          {expand: true, cwd: 'styleguide/public/js/', src: 'jquery.once.js', dest: 'styleguide/assets/public/js/'},
          {expand: true, cwd: 'styleguide/public/js/', src: '**', dest: 'styleguide/assets/public/js/'},
          {expand: true, cwd: 'bootstrap-sass/js/bootstrap/', src: 'collapse.js', dest: 'styleguide/assets/public/js/components/'},
          {expand: true, cwd: 'bootstrap-sass/js/bootstrap/', src: 'transition.js', dest: 'styleguide/assets/public/js/components/'},
          {expand: true, cwd: 'bootstrap-sass/js/bootstrap/', src: 'scrollspy.js', dest: 'styleguide/assets/public/js/'},
          {expand: true, cwd: 'styleguide/public/css/', src: 'jquery.ui.core.min.css', dest: 'styleguide/assets/public/css/'},
          {expand: true, cwd: 'styleguide/public/css/components/', src: '**', dest: 'styleguide/assets/public/css/components/'},
          {expand: true, cwd: '../../modules/ec-europa-theme-tools/nexteuropa_inpage_nav/js/', src: 'inpage_nav.js', dest: 'styleguide/assets/public/js/components/'}
        ]
      },
      all: {
        files: [
          // Includes files within path and its sub-directories.
          {expand: true, src: ['sass/**'], dest: 'styleguide/assets/public/'},
          {expand: true, src: ['bootstrap-sass/**'], dest: 'styleguide/assets/public/'},
          {expand: true, src: ['bootstrap/**'], dest: 'styleguide/assets/public/'},
          {expand: true, src: ['images/**'], dest: 'styleguide/assets/public/'},
          {expand: true, src: ['css/**'], dest: 'styleguide/assets/public/'}
        ]
      }
    }
  });

  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-sass-lint');
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-cache-bust');
  grunt.loadNpmTasks('grunt-shell');
  grunt.loadNpmTasks('grunt-postcss');
  grunt.loadNpmTasks('grunt-text-replace');

  grunt.registerTask('default', ['watch']);
  grunt.registerTask('fonts', ['watch']);
  grunt.registerTask('cacheBustAll', ['replace:prepare', 'clean:fonts', 'cacheBust:fonts', 'styleguide']);
  grunt.registerTask('styleguide', ['clean', 'sass', 'postcss', 'shell', 'copy:main']);
  grunt.registerTask('copyall', ['copy:all']);
  grunt.registerTask('copytest', ['copy:test']);
  grunt.registerTask('kss', ['shell']);
  grunt.registerTask('sass-lint', ['sasslint']);
};
