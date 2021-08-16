import Vue from 'vue'
import moment from 'moment'

Vue.filter('timeformat',(arg)=>{
    return  moment(arg).format("MMM Do YYYY");
})
Vue.filter('setlength',(text,length,suffix)=>{
    return text.substring(0,length) + suffix;
})
