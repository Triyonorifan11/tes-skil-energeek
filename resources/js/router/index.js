import {createRouter, createWebHistory} from 'vue-router';

import ModuleRouterLandingPage from "@/router/landing-page/index.js"
import store from '@/vuex';
import {axios, axiosHandleError} from '@/global-plugins';

import NotFound from '@/components/Not-found.vue';
import Admin from '@/admin/components/Admin.vue';

import AdminLogin from '@/admin/login/Index.vue';
import AdminContent from '@/admin/content/Index.vue';

import AdminPopUpIklan from '@/admin/content/view/popup-iklan/Index.vue';
import AdminPopUpIklanForm from '@/admin/content/view/popup-iklan/Form.vue';

import AdminHome from '@/admin/content/view/home/Index.vue';
import AdminGallery from '@/admin/content/view/gallery/Index.vue';
import AdminArtikel from '@/admin/content/view/artikel/Index.vue';
import AdminArtikelTambah from '@/admin/content/view/artikel/Tambah.vue';
import AdminArtikelEdit from '@/admin/content/view/artikel/Edit.vue';

import AdminDestinasi from '@/admin/content/view/destinasi/Index.vue';
import AdminDestinasiTambah from '@/admin/content/view/destinasi/Tambah.vue';
import AdminDestinasiEdit from '@/admin/content/view/destinasi/Edit.vue';
import AdminEvent from '@/admin/content/view/event/Index.vue';
import AdminEventTambah from '@/admin/content/view/event/Tambah.vue';
import AdminEventEdit from '@/admin/content/view/event/Edit.vue';
import AdminCulinary from '@/admin/content/view/culinary/Index.vue';
import AdminCulinaryTambah from '@/admin/content/view/culinary/Tambah.vue';
import AdminCulinaryEdit from '@/admin/content/view/culinary/Edit.vue';
import AdminHotel from '@/admin/content/view/hotel/Index.vue';
import AdminHotelTambah from '@/admin/content/view/hotel/Tambah.vue';
import AdminHotelEdit from '@/admin/content/view/hotel/Edit.vue';
import AdminEbook from '@/admin/content/view/ebook/Index.vue';
import AdminBus from '@/admin/content/view/bus/Index.vue';

import AdminMasterKategoriWisata from '@/admin/content/view/master/kategori-wisata/Index.vue';
import AdminMasterKategoriEvent from '@/admin/content/view/master/kategori-event/Index.vue';
import AdminMasterKategoriHotel from '@/admin/content/view/master/kategori-hotel/Index.vue';
import AdminMasterKategoriMakananMinuman from '@/admin/content/view/master/kategori-makanan-minuman/Index.vue';
import AdminMasterBahasa from '@/admin/content/view/master/bahasa/Index.vue';
import AdminMasterTourGuide from '@/admin/content/view/master/tour-guide/Index.vue';

let routes = [
    {
        path: '/admin',
        name: 'admin',
        component: Admin,
        meta: {
            auth: false
        },
        children: [
            {
                path: '',
                name: 'a-login',
                component: AdminLogin,
                meta: {
                    auth: false
                },
            },
            {
                path: '',
                name: 'a-content',
                component: AdminContent,
                meta: {
                    auth: true
                },
                children: [
                    //home
                    {
                        path: 'home',
                        name: 'a-home',
                        component: AdminHome,
                    },
                    //gallery
                    {
                        path: 'gallery',
                        name: 'a-gallery',
                        component: AdminGallery,
                    },
                    {
                        path: 'popup-iklan',
                        name: 'a-popup-iklan',
                        component: AdminPopUpIklan,
                    },
                    {
                        path: 'popup-iklan/tambah',
                        name: 'a-popup-iklan-tambah',
                        component: AdminPopUpIklanForm,
                    },
                    {
                        path: 'popup-iklan/edit/:id',
                        name: 'a-popup-iklan-edit',
                        component: AdminPopUpIklanForm,
                    },
                    //artikel
                    {
                        path: 'artikel',
                        name: 'a-artikel',
                        component: AdminArtikel,
                    },
                    {
                        path: 'artikel/tambah',
                        name: 'a-artikel-tambah',
                        component: AdminArtikelTambah,
                    },
                    {
                        path: 'artikel/edit/:id',
                        name: 'a-artikel-edit',
                        component: AdminArtikelEdit,
                    },
                    //destinasi
                    {
                        path: 'destinasi',
                        name: 'a-destinasi',
                        component: AdminDestinasi,
                    },
                    {
                        path: 'destinasi/tambah',
                        name: 'a-destinasi-tambah',
                        component: AdminDestinasiTambah,
                    },
                    {
                        path: 'destinasi/edit/:id',
                        name: 'a-destinasi-edit',
                        component: AdminDestinasiEdit,
                    },
                    //event
                    {
                        path: 'event',
                        name: 'a-event',
                        component: AdminEvent,
                    },
                    {
                        path: 'event/tambah',
                        name: 'a-event-tambah',
                        component: AdminEventTambah,
                    },
                    {
                        path: 'event/edit/:id',
                        name: 'a-event-edit',
                        component: AdminEventEdit,
                    },
                    //culinary
                    {
                        path: 'culinary',
                        name: 'a-culinary',
                        component: AdminCulinary,
                    },
                    {
                        path: 'culinary/tambah',
                        name: 'a-culinary-tambah',
                        component: AdminCulinaryTambah,
                    },
                    {
                        path: 'culinary/edit/:id',
                        name: 'a-culinary-edit',
                        component: AdminCulinaryEdit,
                    },
                    //hotel
                    {
                        path: 'hotel',
                        name: 'a-hotel',
                        component: AdminHotel,
                    },
                    {
                        path: 'hotel/tambah',
                        name: 'a-hotel-tambah',
                        component: AdminHotelTambah,
                    },
                    {
                        path: 'hotel/edit/:id',
                        name: 'a-hotel-edit',
                        component: AdminHotelEdit,
                    },
                    //ebook
                    {
                        path: 'ebook',
                        name: 'a-ebook',
                        component: AdminEbook,
                    },
                    //bus
                    {
                        path: 'bus',
                        name: 'a-bus',
                        component: AdminBus,
                    },
                    //master
                    {
                        path: 'master/kategori-wisata',
                        name: 'a-m-kategori-wisata',
                        component: AdminMasterKategoriWisata,
                    },
                    {
                        path: 'master/kategori-event',
                        name: 'a-m-kategori-event',
                        component: AdminMasterKategoriEvent,
                    },
                    {
                        path: 'master/kategori-hotel',
                        name: 'a-m-kategori-hotel',
                        component: AdminMasterKategoriHotel,
                    },
                    {
                        path: 'master/kategori-makanan-minuman',
                        name: 'a-m-kategori-makanan-minuman',
                        component: AdminMasterKategoriMakananMinuman,
                    },
                    {
                        path: 'master/bahasa',
                        name: 'a-m-bahasa',
                        component: AdminMasterBahasa,
                    },
                    {
                        path: 'master/tour-guide',
                        name: 'a-m-tour-guide',
                        component: AdminMasterTourGuide,
                    },
                ]
            },
        ]
    },
    {
        path: '/:pathMatch(.*)*',
        component: NotFound,
        name: 'not-found',
    },
];

routes = routes.concat(ModuleRouterLandingPage);
let router = createRouter({
    history: createWebHistory(SUBPATH_DOMAIN),
    routes,
    scrollBehavior(to, from, savedPosition) {
        return {
            top: 0
        }
    }
});

router.beforeEach((to, from, next) => {
    // google analytics manual
    // window.dataLayer = window.dataLayer || [];
    // function gtag(){dataLayer.push(arguments);}
    // gtag('js', new Date());

    // gtag('config', import.meta.env.VITE_GOOGLE_ANALYTICS_ID || '');

    if(to.meta.auth){
        if(store.state.auth.authenticated){
            next();
        }
        else{
            axios().post('auth/me')
                .then(res => {
                    store.commit('setAuth', res?.data?.data);
                    next();
                })
                .catch(err => {
                    axiosHandleError(err);
                })
                .then(()=>{});
        }
    }
    else{
        next();
    }
});

export default router;
