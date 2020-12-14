let mix = require('laravel-mix')

mix
  .setPublicPath('dist')
  .js('resources/js/dynamic-action-fields.js', 'js')
