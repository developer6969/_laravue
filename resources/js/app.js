/* STEP 1 : First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');
window.Vue = require('vue');
import VueRouter from "vue-router";



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

/* STEP 3b : Registring Individual Components
 */
Vue.component(
    "page-not-found",
    require("./components/error/PageNotFound.vue").default
);

Vue.component(
    "unauthorized-access",
    require("./components/error/UnauthorizedAccess.vue").default
);



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
