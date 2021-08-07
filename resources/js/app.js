import Vue from 'vue'
import store from '~/store'
import router from '~/router'
import i18n from '~/plugins/i18n'
import App from '~/components/App'
import { BTable, BFormCheckbox } from "bootstrap-vue";
import VueToast from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";


Vue.use(VueToast);
Vue.component("b-table", BTable);
Vue.component("b-form-checkbox", BFormCheckbox);

import '~/plugins'
import '~/components'

Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
    i18n,
    store,
    router,
    ...App
})