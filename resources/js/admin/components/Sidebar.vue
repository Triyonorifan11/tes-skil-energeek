<template>
    <div>
        <!--begin::Aside-->
        <div id="kt_aside" class="aside aside-light aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
            <!--begin::Brand-->
            <div class="aside-logo flex-column-auto" id="kt_aside_logo">
                <!--begin::Logo-->
                <a href="" class="d-flex align-items-center" style="align-items:center;">
                    <img alt="Logo" :src="`${assetUrl}assets/images/logo_app.svg`" class="h-25px logo" />
                    <h6 class="mx-5 my-0 text-success">Visit Surabaya</h6>
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
                                <span class="menu-title">Home About</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a :class="`menu-link btn btn-sm mx-5 ${pageActive(['a-gallery', 'a-gallery-tambah','a-gallery-edit'])}`" href="javascript:;" @click="this.$router.push({name: 'a-gallery'})">
                                <span class="menu-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M22 16V4C22 2.9 21.1 2 20 2H8C6.9 2 6 2.9 6 4V16C6 17.1 6.9 18 8 18H20C21.1 18 22 17.1 22 16ZM11 12L13.03 14.71L16 11L20 16H8L11 12ZM2 6V20C2 21.1 2.9 22 4 22H18V20H4V6H2Z" fill="#B5B5C3"/></svg>
                                </span>
                                <span class="menu-title">Gallery</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a :class="`menu-link btn btn-sm mx-5 ${pageActive(['a-artikel', 'a-artikel-tambah','a-artikel-edit'])}`" href="javascript:;" @click="this.$router.push({name: 'a-artikel'})">
                                <span class="menu-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16 3H5C3.9 3 3 3.9 3 5V19C3 20.1 3.9 21 5 21H19C20.1 21 21 20.1 21 19V8L16 3ZM7 7H12V9H7V7ZM17 17H7V15H17V17ZM17 13H7V11H17V13ZM15 9V5L19 9H15Z" fill="#B5B5C3"/></svg>
                                </span>
                                <span class="menu-title">Artikel</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a :class="`menu-link btn btn-sm mx-5 ${pageActive(['a-popup-iklan','a-popup-iklan-edit','a-popup-iklan-tambah'])}`" href="javascript:;" @click="this.$router.push({name: 'a-popup-iklan'})">
                                <span class="menu-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.455 17.74C8.27499 17.59 5.745 14.97 5.745 11.75C5.745 8.44 8.435 5.75 11.745 5.75C14.965 5.75 17.585 8.28 17.735 11.46L15.635 10.83C15.225 9.06 13.635 7.75 11.745 7.75C9.535 7.75 7.745 9.54 7.745 11.75C7.745 13.64 9.055 15.23 10.825 15.64L11.455 17.74ZM21.745 11.75C21.745 12.05 21.735 12.35 21.705 12.65L19.735 12.06C19.745 11.96 19.745 11.85 19.745 11.75C19.745 7.33 16.165 3.75 11.745 3.75C7.325 3.75 3.745 7.33 3.745 11.75C3.745 16.17 7.325 19.75 11.745 19.75C11.845 19.75 11.955 19.75 12.055 19.74L12.645 21.71C12.345 21.74 12.045 21.75 11.745 21.75C6.225 21.75 1.745 17.27 1.745 11.75C1.745 6.23 6.225 1.75 11.745 1.75C17.265 1.75 21.745 6.23 21.745 11.75ZM17.975 16.01L21.745 14.75L11.745 11.75L14.745 21.75L16.005 17.98L20.275 22.25L22.255 20.27L17.975 16.01Z" fill="#B5B5C3"/>
                                    </svg>

                                </span>
                                <span class="menu-title">Pop Up Iklan</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <div class="menu-content pb-2">
                                <span class="menu-section text-muted text-uppercase fs-8 ls-1">ATTRACTION</span>
                            </div>
                        </div>
                        <div class="menu-item">
                            <a :class="`menu-link btn btn-sm mx-5 ${pageActive(['a-destinasi', 'a-destinasi-tambah','a-destinasi-edit'])}`" href="javascript:;" @click="this.$router.push({name: 'a-destinasi'})">
                                <span class="menu-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 1C5.9 1 1 5.9 1 12C1 18.1 5.9 23 12 23C18.1 23 23 18.1 23 12C23 5.9 18.1 1 12 1ZM12 21C7.01 21 3 16.99 3 12C3 7.01 7.01 3 12 3C16.99 3 21 7.01 21 12C21 16.99 16.99 21 12 21Z" fill="#B5B5C3"/><path d="M19.73 11.42L12.54 4.2C12.18 3.93 11.74 3.93 11.39 4.2L4.2 11.42C3.93 11.78 3.93 12.22 4.2 12.58L11.39 19.8C11.75 20.07 12.19 20.07 12.54 19.8L19.73 12.58C20.09 12.22 20.09 11.69 19.73 11.42ZM13.5 14.5L12.09 13.09L13.17 12H10V15H8V11C8 10.4 8.4 10 9 10H13.17L12.08 8.91L13.5 7.5L17 11L13.5 14.5Z" fill="#B5B5C3"/></svg>
                                </span>
                                <span class="menu-title">Destinasi Wisata</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a :class="`menu-link btn btn-sm mx-5 ${pageActive(['a-event', 'a-event-tambah','a-event-edit'])}`" href="javascript:;" @click="this.$router.push({name: 'a-event'})">
                                <span class="menu-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19.482 12.6016C17.912 8.52161 12.322 8.3016 13.672 2.37161C13.772 1.93161 13.302 1.59161 12.922 1.82161C9.29195 3.96161 6.68195 8.25161 8.87195 13.8716C9.05195 14.3316 8.51195 14.7616 8.12195 14.4616C6.31195 13.0916 6.12195 11.1216 6.28195 9.71161C6.34195 9.19161 5.66195 8.94161 5.37195 9.3716C4.69195 10.4116 4.00195 12.0916 4.00195 14.6216C4.38195 20.2216 9.11195 21.9416 10.812 22.1616C13.242 22.4716 15.872 22.0216 17.762 20.2916C19.842 18.3616 20.602 15.2816 19.482 12.6016ZM10.202 17.6316C11.642 17.2816 12.382 16.2416 12.582 15.3216C12.912 13.8916 11.622 12.4916 12.492 10.2316C12.822 12.1016 15.762 13.2716 15.762 15.3116C15.842 17.8416 13.102 20.0116 10.202 17.6316Z" fill="#B5B5C3"/></svg>
                                </span>
                                <span class="menu-title">Event</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a :class="`menu-link btn btn-sm mx-5 ${pageActive(['a-culinary', 'a-culinary-tambah','a-culinary-edit'])}`" href="javascript:;" @click="this.$router.push({name: 'a-culinary'})">
                                <span class="menu-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 3L4 9V21H20V9L12 3ZM12.5 12.5C12.5 13.33 11.83 14 11 14V18H10V14C9.17 14 8.5 13.33 8.5 12.5V9.5H9.5V12.5H10V9.5H11V12.5H11.5V9.5H12.5V12.5ZM15 18H14V14.5H13V11.5C13 10.4 13.9 9.5 15 9.5V18Z" fill="#B5B5C3"/></svg>                                </span>
                                <span class="menu-title">Eat & Drink</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <div class="menu-content pb-2">
                                <span class="menu-section text-muted text-uppercase fs-8 ls-1">ACCOMODATION</span>
                            </div>
                        </div>
                        <div class="menu-item">
                            <a :class="`menu-link btn btn-sm mx-5 ${pageActive(['a-hotel', 'a-hotel-tambah','a-hotel-edit'])}`" href="javascript:;" @click="this.$router.push({name: 'a-hotel'})">
                                <span class="menu-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20 10V7C20 5.9 19.1 5 18 5H6C4.9 5 4 5.9 4 7V10C2.9 10 2 10.9 2 12V17H3.33L4 19H5L5.67 17H18.34L19 19H20L20.67 17H22V12C22 10.9 21.1 10 20 10ZM11 10H6V7H11V10ZM18 10H13V7H18V10Z" fill="#B5B5C3"/></svg>
                                </span>
                                <span class="menu-title">Hotel</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a :class="`menu-link btn btn-sm mx-5 ${pageActive(['a-ebook', 'a-ebook-tambah','a-ebook-edit'])}`" href="javascript:;" @click="this.$router.push({name: 'a-ebook'})">
                                <span class="menu-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M21 4C19.89 3.65 18.67 3.5 17.5 3.5C15.55 3.5 13.45 3.9 12 5C10.55 3.9 8.45 3.5 6.5 3.5C4.55 3.5 2.45 3.9 1 5V19.65C1 19.9 1.25 20.15 1.5 20.15C1.6 20.15 1.65 20.1 1.75 20.1C3.1 19.45 5.05 19 6.5 19C8.45 19 10.55 19.4 12 20.5C13.35 19.65 15.8 19 17.5 19C19.15 19 20.85 19.3 22.25 20.05C22.35 20.1 22.4 20.1 22.5 20.1C22.75 20.1 23 19.85 23 19.6V5C22.4 4.55 21.75 4.25 21 4ZM21 17.5C19.9 17.15 18.7 17 17.5 17C15.8 17 13.35 17.65 12 18.5V7C13.35 6.15 15.8 5.5 17.5 5.5C18.7 5.5 19.9 5.65 21 6V17.5Z" fill="#B5B5C3"/><path d="M17.5 9.5C18.38 9.5 19.23 9.59 20 9.76V8.24C19.21 8.09 18.36 8 17.5 8C15.8 8 14.26 8.29 13 8.83V10.49C14.13 9.85 15.7 9.5 17.5 9.5Z" fill="#B5B5C3"/><path d="M13 11.49V13.15C14.13 12.51 15.7 12.16 17.5 12.16C18.38 12.16 19.23 12.25 20 12.42V10.9C19.21 10.75 18.36 10.66 17.5 10.66C15.8 10.66 14.26 10.96 13 11.49Z" fill="#B5B5C3"/><path d="M17.5 13.33C15.8 13.33 14.26 13.62 13 14.16V15.82C14.13 15.18 15.7 14.83 17.5 14.83C18.38 14.83 19.23 14.92 20 15.09V13.57C19.21 13.41 18.36 13.33 17.5 13.33Z" fill="#B5B5C3"/></svg>
                                </span>
                                <span class="menu-title">E-Book</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a :class="`menu-link btn btn-sm mx-5 ${pageActive(['a-bus', 'a-bus-tambah','a-bus-edit'])}`" href="javascript:;" @click="this.$router.push({name: 'a-bus'})">
                                <span class="menu-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 2.5C8 2.5 4 3 4 6.5V16C4 16.95 4.38 17.81 5 18.44V20.5C5 21.05 5.45 21.5 6 21.5H7C7.55 21.5 8 21.05 8 20.5V19.5H16V20.5C16 21.05 16.45 21.5 17 21.5H18C18.55 21.5 19 21.05 19 20.5V18.44C19.62 17.81 20 16.95 20 16V6.5C20 3 16.42 2.5 12 2.5ZM8.5 16.5C7.67 16.5 7 15.83 7 15C7 14.17 7.67 13.5 8.5 13.5C9.33 13.5 10 14.17 10 15C10 15.83 9.33 16.5 8.5 16.5ZM15.5 16.5C14.67 16.5 14 15.83 14 15C14 14.17 14.67 13.5 15.5 13.5C16.33 13.5 17 14.17 17 15C17 15.83 16.33 16.5 15.5 16.5ZM18 10.5H6V7.5H18V10.5Z" fill="#B5B5C3"/></svg>
                                </span>
                                <span class="menu-title">Bus SSCT</span>
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
                                    <a :class="`menu-link btn mx-5 btn-sm ${pageActive('a-m-kategori-wisata')}`" @click="$router.push({name: 'a-m-kategori-wisata'})" href="javascript:;">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Kategori Wisata</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a :class="`menu-link btn mx-5 btn-sm ${pageActive('a-m-kategori-event')}`" @click="$router.push({name: 'a-m-kategori-event'})" href="javascript:;">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Kategori Event</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a :class="`menu-link btn mx-5 btn-sm ${pageActive('a-m-kategori-hotel')}`" @click="$router.push({name: 'a-m-kategori-hotel'})" href="javascript:;">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Kategori Hotel</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a :class="`menu-link btn mx-5 btn-sm ${pageActive('a-m-kategori-makanan-minuman')}`" @click="$router.push({name: 'a-m-kategori-makanan-minuman'})" href="javascript:;">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Kategori Makanan Minuman</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a :class="`menu-link btn mx-5 btn-sm ${pageActive('a-m-bahasa')}`" @click="$router.push({name: 'a-m-bahasa'})" href="javascript:;">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Bahasa</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a :class="`menu-link btn mx-5 btn-sm ${pageActive('a-m-tour-guide')}`" @click="$router.push({name: 'a-m-tour-guide'})" href="javascript:;">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Tour Guide</span>
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
        color:#049C4F !important;
    }
    .menu-item .active{
        background-color:#049C4F !important;
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
