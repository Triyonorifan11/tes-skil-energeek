<template>
    <div>
        <app-landing-page-navbar></app-landing-page-navbar>
        <div class="content pb-5">
            <section class="mt-5">
                <div class="container">
                    <div class="fs-4 fw-bold pb-3 title-heading-page-transport"><span
                            class="public-transport">Public&nbsp;</span>Transportation</div>
                    <div class="row filter-map-transportation-group">
                        <div class="col-lg-8 mt-3">
                            <template v-if="pageStatus == 'page-load'">
                                <div class="d-flex justify-content-center mt-5 mb-5">
                                    <app-loader></app-loader>
                                </div>

                            </template>
                            <template v-else>
                                <div id="map"></div>
                            </template>
                        </div>
                        <div class="col-lg-4 mt-3">
                            <div style="overflow-y: auto;">
                                <div class="filter-transportation-group">
                                    <div class="list" @click="flag = 1" :class="flag == 1 ? 'active' : ''">
                                        <div class="icon">
                                            <svg width="25" height="24" viewBox="0 0 25 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M22.5 16V14L14 9V3.5C14 2.67 13.33 2 12.5 2C11.67 2 11 2.67 11 3.5V9L2.5 14V16L11 13.5V19L8.5 20.5V22L12.5 21L16.5 22V20.5L14 19V13.5L22.5 16Z"
                                                    fill="#B5B5C3" />
                                            </svg>
                                        </div>
                                        <div class="title">Bandar udara</div>
                                    </div>
                                    <div class="list" @click="flag = 2" :class="flag == 2 ? 'active' : ''">
                                        <div class="icon">
                                            <svg width="25" height="24" viewBox="0 0 25 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M12.5 2.5C8.5 2.5 4.5 3 4.5 6.5V16C4.5 17.93 6.07 19.5 8 19.5L6.5 21V21.5H8.73L10.73 19.5H14.5L16.5 21.5H18.5V21L17 19.5C18.93 19.5 20.5 17.93 20.5 16V6.5C20.5 3 16.92 2.5 12.5 2.5ZM8 17.5C7.17 17.5 6.5 16.83 6.5 16C6.5 15.17 7.17 14.5 8 14.5C8.83 14.5 9.5 15.17 9.5 16C9.5 16.83 8.83 17.5 8 17.5ZM11.5 10.5H6.5V6.5H11.5V10.5ZM13.5 10.5V6.5H18.5V10.5H13.5ZM17 17.5C16.17 17.5 15.5 16.83 15.5 16C15.5 15.17 16.17 14.5 17 14.5C17.83 14.5 18.5 15.17 18.5 16C18.5 16.83 17.83 17.5 17 17.5Z"
                                                    fill="#B5B5C3" />
                                            </svg>

                                        </div>
                                        <div class="title">Stasiun</div>
                                    </div>
                                    <div class="list" @click="flag = 3" :class="flag == 3 ? 'active' : ''">
                                        <div class="icon">
                                            <svg width="25" height="24" viewBox="0 0 25 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M12.5 2.5C8.5 2.5 4.5 3 4.5 6.5V16C4.5 16.95 4.88 17.81 5.5 18.44V20.5C5.5 21.05 5.95 21.5 6.5 21.5H7.5C8.05 21.5 8.5 21.05 8.5 20.5V19.5H16.5V20.5C16.5 21.05 16.95 21.5 17.5 21.5H18.5C19.05 21.5 19.5 21.05 19.5 20.5V18.44C20.12 17.81 20.5 16.95 20.5 16V6.5C20.5 3 16.92 2.5 12.5 2.5ZM9 16.5C8.17 16.5 7.5 15.83 7.5 15C7.5 14.17 8.17 13.5 9 13.5C9.83 13.5 10.5 14.17 10.5 15C10.5 15.83 9.83 16.5 9 16.5ZM16 16.5C15.17 16.5 14.5 15.83 14.5 15C14.5 14.17 15.17 13.5 16 13.5C16.83 13.5 17.5 14.17 17.5 15C17.5 15.83 16.83 16.5 16 16.5ZM18.5 10.5H6.5V7.5H18.5V10.5Z"
                                                    fill="#B5B5C3" />
                                            </svg>

                                        </div>
                                        <div class="title">Terminal</div>
                                    </div>
                                    <div class="list" @click="flag = 4" :class="flag == 4 ? 'active' : ''">
                                        <div class="icon">
                                            <svg width="25" height="24" viewBox="0 0 25 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M20.5011 21C19.1111 21 17.7211 20.53 16.5011 19.68C14.0611 21.39 10.9411 21.39 8.50111 19.68C7.28111 20.53 5.89111 21 4.50111 21H2.50111V23H4.50111C5.88111 23 7.24111 22.65 8.50111 22.01C11.0211 23.3 13.9811 23.3 16.5011 22.01C17.7611 22.66 19.1211 23 20.5011 23H22.5011V21H20.5011ZM4.45111 19H4.50111C6.10111 19 7.52111 18.12 8.50111 17C9.48111 18.12 10.9011 19 12.5011 19C14.1011 19 15.5211 18.12 16.5011 17C17.4811 18.12 18.9011 19 20.5011 19H20.5511L22.4411 12.32C22.5211 12.06 22.5011 11.78 22.3811 11.54C22.2611 11.3 22.0411 11.12 21.7811 11.04L20.5011 10.62V6C20.5011 4.9 19.6011 4 18.5011 4H15.5011V1H9.50111V4H6.50111C5.40111 4 4.50111 4.9 4.50111 6V10.62L3.21111 11.04C2.95111 11.12 2.73111 11.3 2.61111 11.54C2.49111 11.78 2.46111 12.06 2.55111 12.32L4.45111 19ZM6.50111 6H18.5011V9.97L12.5011 8L6.50111 9.97V6Z"
                                                    fill="#B5B5C3" />
                                            </svg>

                                        </div>
                                        <div class="title">Pelabuhan</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mt-3">
                            <div style="border: 1px solid #E4E6EF;border-radius:10px" class="p-3">
                                <div class="row">
                                    <div class="col-lg-6 my-3">
                                        <img :src="`${$assetUrl()}assets/images/sample/transportation-2.png`"
                                            class="image-transportation-widget">
                                        <img :src="`${$assetUrl()}assets/images/sample/transportation-1.png`"
                                            class="mt-4 image-transportation-widget">
                                    </div>

                                    <div class="col-lg-6 my-3">
                                        <div style="color:#181C32" class="fw-bolder fs-4 pt-3">Suroboyo Bus</div>
                                        <div class="fs-14px pt-3" style="color:#181C32">Suroboyo Bus merupakan layanan
                                            transportasi bus berfasilitas modern milik
                                            Pemerintah Kota Surabaya yang diperuntukkan sebagai transportasi umum serupa
                                            bus
                                            kota di kawasan metropolitan Kota Surabaya.</div>
                                        <a href="https://www.instagram.com/suroboyobus/?hl=id" target="_blank"
                                            class="d-flex align-items-center mt-3">
                                            <div>
                                                <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M8.3 2.72656H16.7C19.9 2.72656 22.5 5.32656 22.5 8.52656V16.9266C22.5 18.4648 21.8889 19.9401 20.8012 21.0278C19.7135 22.1155 18.2383 22.7266 16.7 22.7266H8.3C5.1 22.7266 2.5 20.1266 2.5 16.9266V8.52656C2.5 6.98831 3.11107 5.51305 4.19878 4.42534C5.28649 3.33763 6.76174 2.72656 8.3 2.72656ZM8.1 4.72656C7.14522 4.72656 6.22955 5.10585 5.55442 5.78098C4.87928 6.45611 4.5 7.37178 4.5 8.32656V17.1266C4.5 19.1166 6.11 20.7266 8.1 20.7266H16.9C17.8548 20.7266 18.7705 20.3473 19.4456 19.6721C20.1207 18.997 20.5 18.0813 20.5 17.1266V8.32656C20.5 6.33656 18.89 4.72656 16.9 4.72656H8.1ZM17.75 6.22656C18.0815 6.22656 18.3995 6.35826 18.6339 6.59268C18.8683 6.8271 19 7.14504 19 7.47656C19 7.80808 18.8683 8.12603 18.6339 8.36045C18.3995 8.59487 18.0815 8.72656 17.75 8.72656C17.4185 8.72656 17.1005 8.59487 16.8661 8.36045C16.6317 8.12603 16.5 7.80808 16.5 7.47656C16.5 7.14504 16.6317 6.8271 16.8661 6.59268C17.1005 6.35826 17.4185 6.22656 17.75 6.22656ZM12.5 7.72656C13.8261 7.72656 15.0979 8.25335 16.0355 9.19103C16.9732 10.1287 17.5 11.4005 17.5 12.7266C17.5 14.0526 16.9732 15.3244 16.0355 16.2621C15.0979 17.1998 13.8261 17.7266 12.5 17.7266C11.1739 17.7266 9.90215 17.1998 8.96447 16.2621C8.02678 15.3244 7.5 14.0526 7.5 12.7266C7.5 11.4005 8.02678 10.1287 8.96447 9.19103C9.90215 8.25335 11.1739 7.72656 12.5 7.72656ZM12.5 9.72656C11.7044 9.72656 10.9413 10.0426 10.3787 10.6052C9.81607 11.1679 9.5 11.9309 9.5 12.7266C9.5 13.5222 9.81607 14.2853 10.3787 14.8479C10.9413 15.4105 11.7044 15.7266 12.5 15.7266C13.2956 15.7266 14.0587 15.4105 14.6213 14.8479C15.1839 14.2853 15.5 13.5222 15.5 12.7266C15.5 11.9309 15.1839 11.1679 14.6213 10.6052C14.0587 10.0426 13.2956 9.72656 12.5 9.72656Z"
                                                        fill="#F64E60" />
                                                </svg>
                                            </div>
                                            <div class="text-gray-600 fs-15px ms-1">Suroboyobus</div>

                                        </a>
                                        <div class="d-flex justify-content-center mt-3">
                                            <img :src="`${$assetUrl()}assets/images/sample/suroboyo-bus-logo.png`"
                                                style="width:100px">
                                        </div>
                                        <div class="text-center pt-3 fs-15px">Available on Mobile APPS</div>
                                        <div class="d-flex align-items-center justify-content-center mt-3">
                                            <a href="https://apps.apple.com/se/app/gobis-surabaya-bus/id1475054553"
                                                target="_blank" class="me-2">
                                                <img :src="`${$assetUrl()}assets/images/sample/logo-app-store.png`"
                                                    style="width:120px">
                                            </a>
                                            <a href="https://play.google.com/store/apps/details?id=com.dishub.gobissurabaya&hl=id&gl=US"
                                                target="_blank" class="ms-2">
                                                <img :src="`${$assetUrl()}assets/images/sample/logo-google-play.png`"
                                                    style="width:120px">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 mt-3">
                            <div style="border: 1px solid #E4E6EF;border-radius:10px" class="p-3">
                                <div class="row">
                                    <div class="col-lg-6 my-3">
                                        <img :src="`${$assetUrl()}assets/images/sample/transsemanggi.jpg`"
                                            class="image-transportation-widget">
                                    </div>
                                    <div class="col-lg-6 my-3">
                                        <div style="color:#181C32" class="fw-bolder fs-4">Trans Semanggi</div>
                                        <div class="fs-14px pt-3" style="color:#181C32">Kehadiran TEMAN BUS di kota
                                            Surabaya
                                            merupakan implementasi program Buy The Service (BTS) yang kesembilan
                                            oleh
                                            Kementerian Perhubungan Republik Indonesia dengan PT. Seduluran Bus
                                            Suroboyo
                                            menjadi
                                            operator yang menjalankan operasional TEMAN BUS.<br><br>

                                            Angkutan Bus Rapid Transit (BRT) di perkotaan ini diharapkan dapat
                                            mempermudah
                                            mobilisasi masyarakat di Surabaya karena terkoneksi dengan Terminal
                                            Purabaya,
                                            Tanjung Perak, Raya Lidah Wetan, Karang Menjangan dan UNAIR.<br><br>

                                            TEMAN BUS Surabaya tersedia sebanyak 45 unit dengan rute layanan di 3
                                            Koridor,
                                            yaitu:<br>
                                            Koridor 1 : Terminal Purabaya – Tanjung Perak via Raya Darmo<br>
                                            Koridor 2 : Raya Lidah Wetan – Karang Menjangan – ITS<br>
                                            Koridor 3 : Terminal Purabaya – Kenjeran Park – MERR<br>
                                            Koridor 6 : Terminal Purabaya – UNAIR Kampus C</div>
                                        <a href="https://www.instagram.com/transsemanggisbs.official/" target="_blank"
                                            class="d-flex align-items-center mt-3">
                                            <div>
                                                <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M8.3 2.72656H16.7C19.9 2.72656 22.5 5.32656 22.5 8.52656V16.9266C22.5 18.4648 21.8889 19.9401 20.8012 21.0278C19.7135 22.1155 18.2383 22.7266 16.7 22.7266H8.3C5.1 22.7266 2.5 20.1266 2.5 16.9266V8.52656C2.5 6.98831 3.11107 5.51305 4.19878 4.42534C5.28649 3.33763 6.76174 2.72656 8.3 2.72656ZM8.1 4.72656C7.14522 4.72656 6.22955 5.10585 5.55442 5.78098C4.87928 6.45611 4.5 7.37178 4.5 8.32656V17.1266C4.5 19.1166 6.11 20.7266 8.1 20.7266H16.9C17.8548 20.7266 18.7705 20.3473 19.4456 19.6721C20.1207 18.997 20.5 18.0813 20.5 17.1266V8.32656C20.5 6.33656 18.89 4.72656 16.9 4.72656H8.1ZM17.75 6.22656C18.0815 6.22656 18.3995 6.35826 18.6339 6.59268C18.8683 6.8271 19 7.14504 19 7.47656C19 7.80808 18.8683 8.12603 18.6339 8.36045C18.3995 8.59487 18.0815 8.72656 17.75 8.72656C17.4185 8.72656 17.1005 8.59487 16.8661 8.36045C16.6317 8.12603 16.5 7.80808 16.5 7.47656C16.5 7.14504 16.6317 6.8271 16.8661 6.59268C17.1005 6.35826 17.4185 6.22656 17.75 6.22656ZM12.5 7.72656C13.8261 7.72656 15.0979 8.25335 16.0355 9.19103C16.9732 10.1287 17.5 11.4005 17.5 12.7266C17.5 14.0526 16.9732 15.3244 16.0355 16.2621C15.0979 17.1998 13.8261 17.7266 12.5 17.7266C11.1739 17.7266 9.90215 17.1998 8.96447 16.2621C8.02678 15.3244 7.5 14.0526 7.5 12.7266C7.5 11.4005 8.02678 10.1287 8.96447 9.19103C9.90215 8.25335 11.1739 7.72656 12.5 7.72656ZM12.5 9.72656C11.7044 9.72656 10.9413 10.0426 10.3787 10.6052C9.81607 11.1679 9.5 11.9309 9.5 12.7266C9.5 13.5222 9.81607 14.2853 10.3787 14.8479C10.9413 15.4105 11.7044 15.7266 12.5 15.7266C13.2956 15.7266 14.0587 15.4105 14.6213 14.8479C15.1839 14.2853 15.5 13.5222 15.5 12.7266C15.5 11.9309 15.1839 11.1679 14.6213 10.6052C14.0587 10.0426 13.2956 9.72656 12.5 9.72656Z"
                                                        fill="#F64E60" />
                                                </svg>
                                            </div>
                                            <div class="text-gray-600 fs-15px ms-1">transsemanggisbs.official</div>

                                        </a>
                                        <div class="d-flex justify-content-center mt-3">
                                            <img :src="`${$assetUrl()}assets/images/sample/logo-trans-semanggis.png`"
                                                style="width:100px">
                                        </div>
                                        <div class="text-center pt-3 fs-15px">Available on Mobile APPS</div>
                                        <div class="d-flex align-items-center justify-content-center mt-3">
                                            <a href="https://apps.apple.com/id/app/teman-bus/id1518723802"
                                                target="_blank" class="me-2">
                                                <img :src="`${$assetUrl()}assets/images/sample/logo-app-store.png`"
                                                    style="width:120px">
                                            </a>
                                            <a href="https://play.google.com/store/apps/details?id=com.dhs.bts&hl=in&gl=US"
                                                target="_blank" class="ms-2">
                                                <img :src="`${$assetUrl()}assets/images/sample/logo-google-play.png`"
                                                    style="width:120px">
                                            </a>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="col-lg-12 mt-3">
                            <div style="border: 1px solid #E4E6EF;border-radius:10px" class="p-3">
                                <div class="row">
                                    <div class="col-lg-6 my-3">
                                        <img :src="`${$assetUrl()}assets/images/sample/wira-wiri.png`"
                                            class="image-transportation-widget">
                                    </div>
                                    <div class="col-lg-6 my-3">
                                        <div style="color:#181C32" class="fw-bolder fs-4">WiraWiri Suroboyo</div>
                                        <div class="fs-14px pt-3" style="color:#181C32">WiraWiri ini merupakan
                                            transportasi umum berukuran kecil atau yang disebut “Feeder”. Freeder
                                            beroperasi di beberapa rute di Kota Surabaya. <br><br>

                                            Dilengkapi dengan beberapa fasilitas seperti AC, CCTV, GPS, Tool Keamanan
                                            (Apar & Pemecah Kaca), dan bangku khusus wanita, lansia/prioritas hingga
                                            umum yang pastinya akan membuat penumpang merasa aman dan nyaman selama
                                            perjalanan. </div>
                                        <a href="https://www.instagram.com/wirawirisuroboyo/" target="_blank"
                                            class="d-flex align-items-center mt-3">
                                            <div>
                                                <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M8.3 2.72656H16.7C19.9 2.72656 22.5 5.32656 22.5 8.52656V16.9266C22.5 18.4648 21.8889 19.9401 20.8012 21.0278C19.7135 22.1155 18.2383 22.7266 16.7 22.7266H8.3C5.1 22.7266 2.5 20.1266 2.5 16.9266V8.52656C2.5 6.98831 3.11107 5.51305 4.19878 4.42534C5.28649 3.33763 6.76174 2.72656 8.3 2.72656ZM8.1 4.72656C7.14522 4.72656 6.22955 5.10585 5.55442 5.78098C4.87928 6.45611 4.5 7.37178 4.5 8.32656V17.1266C4.5 19.1166 6.11 20.7266 8.1 20.7266H16.9C17.8548 20.7266 18.7705 20.3473 19.4456 19.6721C20.1207 18.997 20.5 18.0813 20.5 17.1266V8.32656C20.5 6.33656 18.89 4.72656 16.9 4.72656H8.1ZM17.75 6.22656C18.0815 6.22656 18.3995 6.35826 18.6339 6.59268C18.8683 6.8271 19 7.14504 19 7.47656C19 7.80808 18.8683 8.12603 18.6339 8.36045C18.3995 8.59487 18.0815 8.72656 17.75 8.72656C17.4185 8.72656 17.1005 8.59487 16.8661 8.36045C16.6317 8.12603 16.5 7.80808 16.5 7.47656C16.5 7.14504 16.6317 6.8271 16.8661 6.59268C17.1005 6.35826 17.4185 6.22656 17.75 6.22656ZM12.5 7.72656C13.8261 7.72656 15.0979 8.25335 16.0355 9.19103C16.9732 10.1287 17.5 11.4005 17.5 12.7266C17.5 14.0526 16.9732 15.3244 16.0355 16.2621C15.0979 17.1998 13.8261 17.7266 12.5 17.7266C11.1739 17.7266 9.90215 17.1998 8.96447 16.2621C8.02678 15.3244 7.5 14.0526 7.5 12.7266C7.5 11.4005 8.02678 10.1287 8.96447 9.19103C9.90215 8.25335 11.1739 7.72656 12.5 7.72656ZM12.5 9.72656C11.7044 9.72656 10.9413 10.0426 10.3787 10.6052C9.81607 11.1679 9.5 11.9309 9.5 12.7266C9.5 13.5222 9.81607 14.2853 10.3787 14.8479C10.9413 15.4105 11.7044 15.7266 12.5 15.7266C13.2956 15.7266 14.0587 15.4105 14.6213 14.8479C15.1839 14.2853 15.5 13.5222 15.5 12.7266C15.5 11.9309 15.1839 11.1679 14.6213 10.6052C14.0587 10.0426 13.2956 9.72656 12.5 9.72656Z"
                                                        fill="#F64E60" />
                                                </svg>
                                            </div>
                                            <div class="text-gray-600 fs-15px ms-1">wirawirisuroboyo</div>

                                        </a>
                                        <div class="d-flex justify-content-center mt-3">
                                            <img :src="`${$assetUrl()}assets/images/sample/suroboyo-bus-logo.png`"
                                                style="width:100px">
                                        </div>
                                        <div class="text-center pt-3 fs-15px">Available on Mobile APPS</div>
                                        <div class="d-flex align-items-center justify-content-center mt-3">
                                            <a href="https://apps.apple.com/se/app/gobis-surabaya-bus/id1475054553"
                                                target="_blank" class="me-2">
                                                <img :src="`${$assetUrl()}assets/images/sample/logo-app-store.png`"
                                                    style="width:120px">
                                            </a>
                                            <a href="https://play.google.com/store/apps/details?id=com.dishub.gobissurabaya&hl=id&gl=US"
                                                target="_blank" class="ms-2">
                                                <img :src="`${$assetUrl()}assets/images/sample/logo-google-play.png`"
                                                    style="width:120px">
                                            </a>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <app-landing-page-footer></app-landing-page-footer>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                pageStatus: 'page-load',
                flag: 1,
                map: null,
                surabayaCoordinate: {
                    lat: -7.2702354,
                    lng: 112.7327132,
                }
            }
        },
        watch: {
            'flag'() {
                this.getData();
            }
        },
        mounted() {
            reinitPluginLandingPage();
            this.getData();
        },
        methods: {
            getData() {
                this.pageStatus = 'page-load'
                this.$axios().get(`accomodation/transportation`, {
                        params: {
                            category_id: this.flag
                        }
                    })
                    .then(response => {
                        this.pageStatus = 'standby';
                        setTimeout(() => {
                            this.initMap();
                            for (let i = 0; i < response.data.data.length; i++) {
                                this.addMarker({
                                    name: response.data.data[i].name,
                                    coordinates: {
                                        lat: Number(response.data.data[i].latitude),
                                        lng: Number(response.data.data[i].longitude)
                                    },
                                    id: response.data.data[i].id,
                                });
                            }
                        }, 500);


                    })
            },
            initMap() {

                var options = {
                    zoom: 11,
                    center: this.surabayaCoordinate
                }
                this.map = new google.maps.Map(document.getElementById('map'), options);
            },
            addMarker(prop) {

                let that = this;

                let myLatLng = new google.maps.LatLng(prop.coordinates.lat, prop.coordinates.lng);

                var marker = new google.maps.Marker({
                    position: myLatLng,
                    map: that.map, //Map that we need to add                 
                    animation: google.maps.Animation.DROP,
                });

                let name = prop.name;
                let linkGoogleMaps =
                    `https://www.google.com/maps/dir/?api=1&destination=${prop.coordinates.lat},${prop.coordinates.lng}`
                var information = new google.maps.InfoWindow({
                    content: '<div style="text-align:center;font-weight:600;font-size:14px">' + name +
                        '</div><br><div style="display:flex;justify-content:center"><a style="background:#049C4F;color:#fff;padding:8px 15px;border-radius:10px;font-size:12px;font-weight:500;" href="' +
                        linkGoogleMaps + '" target="_blank">Get Directions</a></div>',
                    maxHeight: 300
                });

                google.maps.event.addListener(marker, 'click', function () {
                    that.map.setZoom(15);
                    that.map.setCenter(marker.getPosition());
                    information.open(map, marker);
                });
            },
        }
    }

</script>

<style scoped>
    #map {
        height: 350px;
        width: 100%;
        border-radius: 10px;
        margin-bottom: 40px;
    }

    .image-transportation-widget {
        width: 100%;
        object-fit: cover;
        object-position: center;
        border-radius: 10px;
    }

    .filter-transportation-group .list {
        display: flex;
        align-items: center;
        padding: 17px 15px;
        margin-bottom: 15px;
        border: 1px solid #E4E6EF;
        border-radius: 10px;
    }

    .filter-transportation-group .list {
        cursor: pointer;
    }

    .filter-transportation-group .list .title {
        font-size: 18px;
        margin-left: 15px;
        color: #7E8299
    }

    .filter-transportation-group .list.active {
        background-color: #049C4F !important;
    }

    .filter-transportation-group .list.active .title {
        color: #fff !important;
        font-weight: 500;
    }

    .filter-transportation-group .list.active .icon svg [fill]:not(.permanent):not(g) {
        fill: #fff !important;
    }

    @media(max-width:991px) {
        .filter-map-transportation-group {
            display: flex;
            flex-direction: column-reverse;
        }

        .filter-transportation-group {
            display: flex;
            align-items: center;
            min-width: 660px;
            padding-bottom: 10px;
        }

        .filter-transportation-group .list {
            width: 150px !important;
            margin-right: 15px;
            margin-bottom: 0 !important;
            padding: 10px 5px;
        }

        .filter-transportation-group .list .title {
            font-size: 14px !important;
        }
    }

    .title-heading-page-transport .public-transport {
        display: none !important;
    }

    @media(max-width: 991px) {
        .title-heading-page-transport {
            display: flex;
            flex-wrap: wrap;
        }

        .title-heading-page-transport .public-transport {
            display: block !important;
        }
    }

</style>
