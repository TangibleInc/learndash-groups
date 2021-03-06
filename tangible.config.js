module.exports = {
  build: [
    {
      task: 'js',
      src: 'assets/src/admin/index.js',
      dest: 'assets/build/admin.min.js',
      watch: 'assets/src/admin/**/*.js'
    },
    {
      task: 'sass',
      src: 'assets/src/admin/index.scss',
      dest: 'assets/build/admin.min.css',
      watch: 'assets/src/admin/**/*.scss'
    },
    {
      task: 'sass',
      src: 'assets/src/shortcodes/index.scss',
      dest: 'assets/build/frontend.min.css',
      watch: 'assets/src/shortcodes/**/*.scss'
    }
  ]
}
