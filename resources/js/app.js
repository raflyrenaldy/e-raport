require('./bootstrap');

window.Vue = require('vue');

import iosAlertView         from 'vue-ios-alertview';
import VueApexCharts        from 'vue-apexcharts';
import VueIziToast          from "vue-izitoast";
import VueBootstrapDatetimepicker from 'vue-bootstrap-datetimepicker';
import ElementUI            from 'element-ui';
import Moment               from 'moment';
import VueMask              from 'v-mask'

import 'element-ui/lib/theme-chalk/index.css';
import locale from 'element-ui/lib/locale/lang/en'
import "izitoast/dist/css/iziToast.css";

Vue.use(VueIziToast);
Vue.use(VueApexCharts);
Vue.use(iosAlertView);
Vue.use(ElementUI, { locale });
Vue.use(VueBootstrapDatetimepicker);
Vue.use(Moment);
Vue.use(VueMask);

//Admin
import AdminDashboardComponent              from './components/Admin/DashboardComponent';
import AdminClassComponent                  from './components/Admin/ClassComponent';
import AdminStudentComponent                from './components/Admin/StudentComponent';

//Student
import StudentDashboardComponent        from './components/Student/DashboardComponent';

Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('apexchart', VueApexCharts);



//admin
Vue.component('admin-dashboard-component',              AdminDashboardComponent);
Vue.component('admin-class-component',                  AdminClassComponent);
Vue.component('admin-student-component',                AdminStudentComponent);

//student
Vue.component('student-dashboard-component',        StudentDashboardComponent);

window.Fire = new Vue();

const app = new Vue({
    el: '#app',
    data() {
        return {
            user: AuthUser
        }
    },
    methods: {
        getUser() {
            return this.user;
        },
        MakeUrl(path) {
            return BaseUrl(path);
        },
        custom_format(value, dates) {
            if (value) {
               return Moment(String(value)).format(dates)
              }
        },
        format_date(value){
             if (value) {
               return Moment(String(value)).format('YYYY-MM-DD')
              }
          },
        format_from(value) {
            if (value) {
                var today = new Date();
                return Moment(String(value)).from(Moment(today));
            }
        },
        format_time(value){
             if (value) {
               return Moment(String(value)).format('HH:mm:ss')
              }
          },
          searchit: _.debounce(()=>{
            Fire.$emit('searching');
          },500)
    }
});
