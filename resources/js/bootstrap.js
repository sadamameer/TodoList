window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

$(".overlay").hide();

window.axios.interceptors.request.use((config) => {
    $(".overlay").show();
    return config;
}, (error) => {
    $(".overlay").hide();
    return Promise.reject(error);
});

window.axios.interceptors.response.use((response) => {
    $(".overlay").hide();
    return response;
}, (error) => {
    $(".overlay").hide();
    return Promise.reject(error);
});