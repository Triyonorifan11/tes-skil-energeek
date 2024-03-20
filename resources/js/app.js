import './bootstrap';

import {createApp} from 'vue';

import App from '@/components/App.vue';
import Router from '@/router';
import Vuex from '@/vuex';
import GlobalPlugins from '@/global-plugins';
import { Money3 } from 'v-money3'
import DatePicker from 'vue-datepicker-next';
import 'vue-datepicker-next/index.css';
import VueQrcode from 'vue-qrcode';
import Editor from '@tinymce/tinymce-vue';
import VueGtag from "vue-gtag";
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import '@vueup/vue-quill/dist/vue-quill.bubble.css';

import Select2 from '@/admin/components/UI/Select2.vue';
import Loader from '@/admin/components/UI/Loader.vue';
import DataTable from '@/admin/components/UI/DataTable.vue';

// import LandingNavbar from '@/view/landing/component/Navbar.vue';
// import LandingFootbar from '@/view/landing/component/Footbar.vue';
import AdminNavbar from '@/admin/components/Navbar.vue';
import AdminSidebar from '@/admin/components/Sidebar.vue';

import LandingPageNavbar from '@/components/landing-page/Navbar.vue';
import LandingPageFooter from '@/components/landing-page/Footer.vue';
import LandingPageSelectSingle from '@/components/landing-page/SelectSingle.vue';
import LandingPagePagination from '@/components/landing-page/Pagination.vue';

import VueSocialSharing from 'vue-social-sharing'


const app = createApp(App);

app.component('app-select2', Select2);
app.component('app-loader', Loader);
app.component('app-data-table', DataTable);
app.component('app-money3', Money3);
app.component('app-datepicker', DatePicker);
app.component('vue-qrcode', VueQrcode);
app.component('app-tinymce', Editor);

// app.component('app-landing-navbar',LandingNavbar);
// app.component('app-landing-footbar',LandingFootbar);
app.component('app-admin-navbar',AdminNavbar);
app.component('app-admin-sidebar',AdminSidebar);
app.component('app-landing-page-navbar',LandingPageNavbar);
app.component('app-landing-page-footer',LandingPageFooter);
app.component('app-landing-page-select-single',LandingPageSelectSingle);
app.component('app-landing-page-pagination',LandingPagePagination);
app.component('QuillEditor', QuillEditor);


app.use(Router);
app.use(Vuex);
app.use(GlobalPlugins);
app.use(VueGtag, {
    pageTrackerTemplate(to) {
        return {
            page_title: to?.meta?.title || '',
            page_path: to.path
        }
    },
    config: {
        id: import.meta.env.VITE_GOOGLE_ANALYTICS_ID || '',
    },
}, Router);

app.use(VueSocialSharing);

app.mount('#app');
