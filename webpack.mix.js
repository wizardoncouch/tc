const mix = require('laravel-mix');
let fs = require('fs');

let getFiles = function (dir) {
    // get all 'files' in this directory
    // filter directories
    return fs.readdirSync(dir).filter(file => {
        return fs.statSync(`${dir}/${file}`).isFile();
    }).filter(file => !(/(^|\/)\.[^\/\.]/g).test(file));
};

mix.js('resources/js/app.js', 'public/js');
getFiles('resources/js/admin').forEach(function (filename) {
    mix.js('resources/js/admin/' + filename, 'public/js/admin');
});


mix.styles([
    'resources/theme/app.css'
], 'public/css/vendor.css');

getFiles('resources/sass/admin').forEach(function (filename) {
    mix.sass('resources/sass/admin/' + filename, 'public/css/admin');
});

