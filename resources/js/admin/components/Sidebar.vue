<template>
    <div>
        <!--begin::Aside-->
        <div id="kt_aside" class="aside aside-light aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
            <!--begin::Brand-->
            <div class="aside-logo flex-column-auto" id="kt_aside_logo">
                <!--begin::Logo-->
                <a href="" class="d-flex justify-content-center align-items-center" style="align-items:center; justify-content: center;">
                    <img alt="Logo" :src="`${assetUrl}assets/images/logo.svg`" class="h-25px logo" />
                    <!-- <h6 class="mx-5 my-0 text-success">Visit Surabaya</h6> -->
                </a>
                <!--end::Logo-->
                <!--begin::Aside toggler-->
                <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="aside-minimize">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr079.svg-->
                    <span class="svg-icon svg-icon-1 rotate-180">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.5" d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z" fill="black"></path>
                            <path d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z" fill="black"></path>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Aside toggler-->
            </div>
            <!--end::Brand-->
            <!--begin::Aside menu-->
            <div class="aside-menu flex-column-fluid">
                <!--begin::Aside Menu-->
                <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
                    <!--begin::Menu-->
                    <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true">
                        <div class="menu-item">
                            <div class="menu-content pb-2">
                                <span class="menu-section text-muted text-uppercase fs-8 ls-1">HOME</span>
                            </div>
                        </div>
                        <div class="menu-item">
                            <a :class="`menu-link btn btn-sm mx-5 ${pageActive(['a-home', 'a-home-tambah','a-home-edit'])}`" href="javascript:;" @click="this.$router.push({name: 'a-home'})">
                                <span class="menu-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M3 4H20C20.5523 4 21 4.44772 21 5V7C21 7.55228 20.5523 8 20 8H3C2.44772 8 2 7.55228 2 7V5C2 4.44772 2.44772 4 3 4ZM10 10H20C20.5523 10 21 10.4477 21 11V19C21 19.5523 20.5523 20 20 20H10C9.44772 20 9 19.5523 9 19V11C9 10.4477 9.44772 10 10 10Z" fill="#B5B5C3"/><path opacity="0.3" d="M6 10H3C2.44772 10 2 10.4477 2 11V19C2 19.5523 2.44772 20 3 20H6C6.55228 20 7 19.5523 7 19V11C7 10.4477 6.55228 10 6 10Z" fill="#B5B5C3"/></svg>
                                </span>
                                <span class="menu-title">Dashboard</span>
                            </a>
                        </div>
                        
                        
                        <div class="menu-item">
                            <div class="menu-content pt-8 pb-2">
                                <span class="menu-section text-muted text-uppercase fs-8 ls-1">MASTER</span>
                            </div>
                        </div>
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                            <span class="menu-link toggle-accordion">
                                <span class="menu-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.9336 16.0724L19.36 10.9564L19.5182 10.8312C20.1676 10.3169 20.2772 9.3735 19.7629 8.72404C19.6917 8.63411 19.6104 8.55264 19.5206 8.48124L12.9337 3.24252C12.3871 2.80783 11.6129 2.80783 11.0663 3.24252L4.47482 8.48483C3.82645 9.00049 3.71886 9.94413 4.23452 10.5925C4.305 10.6811 4.38527 10.7615 4.47382 10.832L4.62999 10.9564L11.0659 16.073C11.6127 16.5077 12.3871 16.5074 12.9336 16.0724Z" fill="#B5B5C3"/><path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd" d="M11.0564 18.6709L5.33594 14.1231C4.94555 13.8127 4.37748 13.8776 4.06711 14.268C4.06473 14.271 4.06236 14.274 4.06001 14.277C3.75258 14.674 3.82518 15.245 4.22216 15.5525C4.2236 15.5536 4.22504 15.5547 4.22649 15.5558L11.0873 20.8033C11.6251 21.2146 12.3718 21.2147 12.9096 20.8035L19.7678 15.56C20.1693 15.253 20.246 14.6786 19.939 14.2771C19.9377 14.2753 19.9363 14.2736 19.935 14.2719C19.6267 13.8745 19.0546 13.8023 18.6572 14.1106C18.6544 14.1129 18.6515 14.1151 18.6486 14.1174L12.9235 18.6707C12.377 19.1053 11.6029 19.1054 11.0564 18.6709Z" fill="#B5B5C3"/></svg>
                                </span>
                                <span class="menu-title">Data Master</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <div class="menu-sub menu-sub-accordion">
                                <div class="menu-item">
                                    <a :class="`menu-link btn mx-5 btn-sm ${pageActive('a-m-skilll')}`" @click="$router.push({name: 'a-m-skill'})" href="javascript:;">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Skill</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a :class="`menu-link btn mx-5 btn-sm ${pageActive('a-m-jobs')}`" @click="$router.push({name: 'a-m-jobs'})" href="javascript:;">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Jobs</span>
                                    </a>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                    <!--end::Menu-->
                </div>
                <!--end::Aside Menu-->
            </div>
        </div>
        <!--end::Aside-->
    </div>
</template>

<script>
    export default {
        data(){
            return {
                assetUrl: assetUrl
            }
        },
        mounted(){

        },
        methods: {
            pageActive(menu){
                let active = '';
                if(typeof Array.isArray(menu)){
                    active = menu.includes(this.$route.name) ? 'active' : '';
                }
                else{
                    active = this.$route.name == menu ? 'active' : '';
                }
                return active;
            }
        }
    }
</script>

<style scoped>
    .menu-state-title-primary .menu-item.hover:not(.here) > .menu-link:not(.disabled):not(.active):not(.here) .menu-title, .menu-state-title-primary .menu-item:not(.here) .menu-link:hover:not(.disabled):not(.active):not(.here) .menu-title {
        color:#9c3204 !important;
    }
    .menu-item .active{
        background-color:#9c3204 !important;
        color:white !important;
    }
    .menu-item .active *{
        color:white !important;
    }
    .menu-item .active .menu-bullet span{
        background-color:white !important;
    }
    .menu-item .active .menu-icon svg path{
        background-color:white !important;
        fill:white !important;
    }
</style>
