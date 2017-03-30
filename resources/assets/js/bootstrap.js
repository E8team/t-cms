
window._ = require('lodash');

window.Vue = require('vue');

import  'normalize.css'

window.axios = require('axios');

window.axios.defaults.headers.common = {
    'X-CSRF-TOKEN': window.t_meta.csrfToken,
    'X-Requested-With': 'XMLHttpRequest'
};
