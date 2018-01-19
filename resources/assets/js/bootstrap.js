
import lodash from "lodash";

import Vue from "vue";


window._=lodash;


window.axios = require('axios');

window.Vue= Vue;

window.events = new Vue();

window.flash = function (message,type="success") {
    window.events.$emit('flash', {message,type});
};

axios.interceptors.response.use(function (response) {
    // Do something with response data
    return response;
  }, function (error) {
    	if(error.hasOwnProperty("message")){
    		flash(error.message,"danger");
    	}
    return Promise.reject(error);
  });