import { js } from 'laravel-mix';

js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .copy('node_modules/daterangepicker/daterangepicker.css', 'public/css')
   .copy('node_modules/select2/dist/css/select2.min.css', 'public/css')
   .copy('node_modules/chart.js/dist/chart.min.js', 'public/js')
   .copy('node_modules/pivot.js/dist/pivot.min.js', 'public/js');

