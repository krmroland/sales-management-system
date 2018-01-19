
import "./bootstrap";


import "./layout";

import helpers from "./Helpers";


//Vue.component("DataFetcher",require("./components/DataFetcher"));
//Vue.component("search",require("./components/search"));


//global components
Vue.component("modal",require("./components/modal"));
Vue.component("counter", require("./components/countingNumber"));
Vue.component('card', require('./components/Card.vue'));
Vue.component('zoom', require('./components/Zoom.vue'));
Vue.component('AnimationList',require('./components/AnimationList.vue'))
Vue.component('flash', require('./components/Flash.vue'));
Vue.component("hoverable",require("./components/hoverable"));

Vue.component("calculator",require("./components/calculator"));


//general components
//search
Vue.component("SearchSelector",require("./selectors/selector"));
Vue.component("SearchAttribute",require("./selectors/attribute"));
//tables
Vue.component("vue-table",require("./tables/VueTable"));
Vue.component("table-cell",require("./tables/TableCell"));


//general pages
Vue.component("dashboard",require("./components/dashboard"));
Vue.component("configuration",require("./configuration/index"));
Vue.component("accomodation",require("./accomodation/index"));
Vue.component("parking",require("./parking/index"));
Vue.component("employees",require("./employees/index"));
Vue.component("reports",require("./reports/index"));
Vue.component("transaction",require("./transactions/transaction"));
Vue.component("EmployeeProfile",require("./employees/show"));
Vue.component("expenditures",require("./expenditures/index"));
Vue.component("OtherIncomes",require("./otherIncomes/index"));
//items
Vue.component("items",require("./items/index"));
Vue.component("ItemDetails",require("./items/show"));

//vehicle
Vue.component("VehicleDetails",require("./vehicles/show"));

const app = new Vue({
    el: '#app',
    mixins:[helpers]
});
