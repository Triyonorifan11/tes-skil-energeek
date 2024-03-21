import {createRouter, createWebHistory} from 'vue-router';

import ModuleRouterLandingPage from "@/router/landing-page/index.js"
import store from '@/vuex';
import {axios, axiosHandleError} from '@/global-plugins';

import NotFound from '@/components/Not-found.vue';
import Admin from '@/admin/components/Admin.vue';

import AdminLogin from '@/admin/login/Index.vue';
import AdminContent from '@/admin/content/Index.vue';

import AdminHome from '@/admin/content/view/home/Index.vue';
import AdminCandidate from '@/admin/content/view/home/Candidate.vue';

// master
import AdminMasterSkill from '@/admin/content/view/master/skill/index.vue';
import AdminMasterJobs from '@/admin/content/view/master/jobs/index.vue';

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
                        component: AdminCandidate,
                    },
                    {
                        path: 'master-jobs',
                        name: 'a-m-jobs',
                        component: AdminMasterJobs,
                    },
                    {
                        path: 'master-skill',
                        name: 'a-m-skill',
                        component: AdminMasterSkill,
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
