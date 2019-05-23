/* STEP 1 : First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');
window.Vue = require('vue');
import VueRouter from "vue-router";

// Import v-form packages [Class 11]
// https://www.youtube.com/watch?v=ezUVsuGNUnU&list=PLB4AdipoHpxaHDLIaMdtro1eXnQtl_UvE&index=11
import { Form, HasError, AlertError } from "vform";

// Import moment (Date Display Library) [Class 16]
// https://www.youtube.com/watch?v=bV9YsIi-FUU&list=PLB4AdipoHpxaHDLIaMdtro1eXnQtl_UvE&index=16
import moment from "moment";

// Import vue-progressbar [Class 17]
// https://www.youtube.com/watch?v=-Hl4A5cMH_I&list=PLB4AdipoHpxaHDLIaMdtro1eXnQtl_UvE&index=17
import VueProgressBar from "vue-progressbar";

// Import sweat-alert [Class 18]
// https://www.youtube.com/watch?v=qJt6EfbQu6E&list=PLB4AdipoHpxaHDLIaMdtro1eXnQtl_UvE&index=18
import Swal from "sweetalert2";
window.Swal = Swal;

// Import resources/js/gate.js
import Gate from "./gate";
// Make Gate globally accessible
// https://www.youtube.com/watch?v=sW6MStdkFJE&list=PLB4AdipoHpxaHDLIaMdtro1eXnQtl_UvE&index=44
// Class 44 at 8:50
Vue.prototype.$gate = new Gate(window.user);



// Registring Global Component [i.e. Can be accessed anywhere]
window.Form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);


/* STEP 2 : 
 */
Vue.use(VueRouter);



/* STEP 3a : Registering Group Components
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 * Eg. ./components/ExComponent.vue -> <ex-component></ex-component>
 */
const routes = [
    {
        path: "/dashboard",
        component: require("./components/Dashboard.vue").default
    },
    {
        path: "/profile",
        component: require("./components/Profile.vue").default
    },
    {
        path: "/users",
        component: require("./components/Users.vue").default
    },
    {
        path: "/products",
        component: require("./components/Products.vue").default
    },
    {
        path: "/developer",
        component: require("./components/Developer.vue").default
    },
    {
        path: "*",
        component: require("./components/error/PageNotFound.vue").default
    }
];

/* STEP 3b : Registring Individual Components [Globally]
 */
Vue.component(
    "page-not-found",
    require("./components/error/PageNotFound.vue").default
);

Vue.component(
    "unauthorized-access",
    require("./components/error/UnauthorizedAccess.vue").default
);


/* STEP 3c : Registring Filters [Globally]
 */
Vue.filter("capFirst", function(value) {
    if (!value) return "";
    value = value.toString();
    return value.charAt(0).toUpperCase() + value.slice(1);
});

Vue.filter("shortDate", function(date) {
    return moment(date).format("DD MMM'YY");
});


/* STEP 3d : Registring Vue-ProgressBar [Globally]
 */
const options = {
    color: "#bffaf3",
    failedColor: "#874b4b",
    thickness: "5px",
    transition: {
        speed: "0.2s",
        opacity: "0.6s",
        termination: 300
    },
    autoRevert: true,
    location: "top",
    inverse: false
};
Vue.use(VueProgressBar, options);


/* STEP 3e : Registering sweat-alert toast
 */
const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000
});
window.Toast = Toast;


/* STEP 3f : Create a global event listener for 
 * inter-component communication, i.e. CustomEvent
 * [Class 20]
 */
let Fire = new Vue();
window.Fire = Fire;


/* STEP 3G : Register Passport Components
 */
Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);


/* STEP 3H : Register Other Components
 */
Vue.component(
    "page-not-found",
    require("./components/error/PageNotFound.vue").default
);

Vue.component(
    "unauthorized-access",
    require("./components/error/UnauthorizedAccess.vue").default
);

Vue.component(
    "user-list-item",
    require("./components/UserRecyclerView.vue").default
);


/* STEP 3I : Register Laravel Vue Pagination Component
 */
Vue.component("pagination", require("laravel-vue-pagination"));



/* STEP 4 :
 */
const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
});



/* STEP 5 :
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const app = new Vue({
    el: '#app',
    router,
});
