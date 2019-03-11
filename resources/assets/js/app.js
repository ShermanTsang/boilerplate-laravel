window._ = require('lodash');

try {
    window.$ = window.jQuery = require('jquery');
    window.toastr = require('toastr');
    window.lazyload = require('lazyload');
    window.fancybox = require('@fancyapps/fancybox');
} catch (e) {}