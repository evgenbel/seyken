/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.use(require('vue-moment'));
Vue.filter('rounded', function(value) {
    return (Math.round(value*100)/100).toFixed(2);
});

// Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('competition-component', require('./components/CompetitionComponent.vue'));
Vue.component('competition-round', require('./components/round.vue'));
Vue.component('competition-info', require('./components/info.vue'));
Vue.component('table-result', require('./components/result-table.vue'));

const app = new Vue({
    el: '#app',
    filters: {
        rounded: function(point){
            return (Math.round((point+0.0000001)*100)/100);//.toFixed(2);
        }
    }
});

var Slider = require('bootstrap-slider');
// require(/node_modules/bootstrap-slider/dist/css/bootstrap=slider.css);
$("input.slider").each(function () {
    var mySlider = new Slider(this, {
        // initial options object
        step: 0.1,
        precision: 1,
        min: 0,
        max: 10,
        tooltip: 'always'
    });


});
