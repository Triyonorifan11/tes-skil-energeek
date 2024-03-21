<template>
    <div>
        <app-landing-page-navbar></app-landing-page-navbar>
        <div class="content" style="background-color:#F5F6FA;">
            <div class="wrap-landing" style="position:relative;">
                <div class="d-flex justify-content-center">
                    <div class="wrap-tulisan d-flex justify-content-center align-items-center"
                        style="width:100%; position:absolute; bottom:0; top:0; z-index:2;">
                        <div class="tulisan container m-auto"
                            style="padding:0px 30px; max-width:800px; position: relative;">
                            <h1 style="color:white; font-weight: 700;text-align:center">You will love every corner of it
                            </h1>
                            <div class="d-flex justify-content-center mt-2">
                            <router-link to="/nearby" class="btn btn-success py-2 px-3" style="background:#049C4F !important;">
                                <svg width="21" height="21" viewBox="0 0 21 21" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11.0868 11.4983L10.8333 11.6419V11.9333V18.3333H10.1666V11.9333V11.6461L9.91856 11.5014C9.56145 11.2931 9.33329 10.9267 9.33329 10.5C9.33329 9.85944 9.85944 9.33329 10.5 9.33329C11.1405 9.33329 11.6666 9.85944 11.6666 10.5C11.6666 10.9306 11.4354 11.3007 11.0868 11.4983ZM5.99996 10.5C5.99996 8.01777 8.01777 5.99996 10.5 5.99996C12.9822 5.99996 15 8.01777 15 10.5C15 11.6318 14.5767 12.668 13.8805 13.4567L13.4048 12.981C13.9799 12.3162 14.3333 11.4522 14.3333 10.5C14.3333 8.38215 12.6178 6.66663 10.5 6.66663C8.38215 6.66663 6.66663 8.38215 6.66663 10.5C6.66663 11.4522 7.02006 12.3162 7.5951 12.981L7.11941 13.4567C6.42326 12.668 5.99996 11.6318 5.99996 10.5ZM2.66663 10.5C2.66663 6.1761 6.1761 2.66663 10.5 2.66663C14.8238 2.66663 18.3333 6.1761 18.3333 10.5C18.3333 12.5555 17.5365 14.4194 16.2386 15.8232L15.7633 15.3478C16.9386 14.0724 17.6666 12.3688 17.6666 10.5C17.6666 6.54882 14.4511 3.33329 10.5 3.33329C6.54882 3.33329 3.33329 6.54882 3.33329 10.5C3.33329 12.3688 4.06132 14.0724 5.23666 15.3478L4.76129 15.8232C3.46342 14.4194 2.66663 12.5555 2.66663 10.5Z"
                                        fill="white" stroke="white" /></svg>
                                Near Me
                            </router-link>
                        </div>
                        </div>
                    </div>
                </div>
                <video style="width:100%; position:relative;" autoplay muted loop>
                    <source :src="`${assetUrl}assets/videos/surabaya-28.mp4`" type="video/mp4">
                </video>
            </div>
            <br><br><br><br>
            <div class="wrap-about">
                <div class="loader d-flex justify-content-center align-items-center" v-if="about?.loading"><app-loader></app-loader></div>
                <div class="about container-fluid px-5" v-else>
                    <div class="tulisan-mobile px-2 text-center">
                        <h1>{{ about?.data?.label || '-' }}</h1>
                        <p>{{ about?.data?.description || '-' }}</p>
                    </div>
                    <div class="row d-flex align-items-center justify-content-center">
                        <div class="col-md-3">
                            <div class="wrap-kiri d-flex" style="flex-wrap:nowrap; position:relative;">
                                <div class="kiri-kiri" style="flex:1; position:relative !important; left:0; top:0;">
                                    <template v-for="(context, index) in about?.data?.fotoKiri?.kiri">
                                        <img class="p-2" style="width:150px; border-radius: 25px !important; object-fit:cover; height:150px;" :src="`${context?.link}?preview=1`" @error="$setNoImageUrl" alt="">
                                    </template>
                                </div>
                                <div class="kiri-kanan pt-4" style="flex:1; position:relative !important; right:0 !important; bottom:0 !important;">
                                    <template v-for="(context, index) in about?.data?.fotoKiri?.kanan">
                                        <img class="p-2" style="width:150px; border-radius: 25px !important; object-fit:cover; height:150px;" :src="`${context?.link}?preview=1`" @error="$setNoImageUrl" alt="">
                                    </template>
                                </div>
                            </div>
                            <div class="kiri-tengah d-flex justify-content-center" style="flex:1; position:relative !important; right:0 !important; bottom:0 !important;">
                                <template v-for="(context, index) in about?.data?.fotoKiri?.tengah">
                                    <img class="p-2" style="width:150px; border-radius: 25px !important; object-fit:cover; height:150px;" :src="`${context?.link}?preview=1`" @error="$setNoImageUrl" alt="">
                                </template>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex justify-content-center align-items-center">
                            <div class="tulisan px-2 text-center">
                                <h1>{{ about?.data?.label || '-' }}</h1>
                                <p>{{ about?.data?.description || '-' }}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="wrap-kiri d-flex" style="flex-wrap:nowrap; position:relative;">
                                <div class="kiri-kiri" style="flex:1; position:relative !important; left:0; top:0;">
                                    <template v-for="(context, index) in about?.data?.fotoKanan?.kiri">
                                        <img class="p-2" style="width:150px; border-radius: 25px !important; object-fit:cover; height:150px;" :src="`${context?.link}?preview=1`" @error="$setNoImageUrl" alt="">
                                    </template>
                                </div>
                                <div class="kiri-kanan pt-4" style="flex:1; position:relative !important; right:0 !important; bottom:0 !important;">
                                    <template v-for="(context, index) in about?.data?.fotoKanan?.kanan">
                                        <img class="p-2" style="width:150px; border-radius: 25px !important; object-fit:cover; height:150px;" :src="`${context?.link}?preview=1`" @error="$setNoImageUrl" alt="">
                                    </template>
                                </div>
                            </div>
                            <div class="kiri-tengah d-flex justify-content-center" style="flex:1; position:relative !important; right:0 !important; bottom:0 !important;">
                                <template v-for="(context, index) in about?.data?.fotoKanan?.tengah">
                                    <img class="p-2" style="width:150px; border-radius: 25px !important; object-fit:cover; height:150px;" :src="`${context?.link}?preview=1`" @error="$setNoImageUrl" alt="">
                                </template>
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <div class="wrap-video d-flex justify-content-center align-items-center">
                        <div class="vidio" style="max-width:700px;">
                                <video style="width:100%; border-radius:20px;" :poster="about.data.thumbnailVideo" controls>
                                    <source :src="`${about?.data?.video?.link}?preview=1`">
                                </video>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
            <div class="wrap-watson py-5" style="background-color:white;">
                <br>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 d-flex align-items-center">
                            <div>
                                <h3 class="fw-bold">{{headerEvent.title ? headerEvent.title : 'What’s on In Surabaya'}}</h3>
                                <div>{{ headerEvent.description ? headerEvent.description : ''  }}</div>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="loader d-flex align-items-center justify-content-center" v-if="whatsOn.loading">
                                <div class="d-flex justify-content-center mt-3 mb-3">
                                    <app-loader></app-loader>
                                </div>
                            </div>
                            <div class="w-100" v-else>
                                <div class="d-flex justify-content-between align-items-center w-100 mb-3">
                                    <div class="d-flex">
                                        <button type="button" v-if="whatsOn.data.length > 0" class="btn me-2"
                                            @click="prevEventScroll"
                                            style="padding:5px 3px !important;border:1px #EBEDF3 solid !important;box-shadow:unset !important;"><svg
                                                width="33" height="32" viewBox="0 0 33 32" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M21.4401 22.12L15.3334 16L21.4401 9.88L19.5601 8L11.5601 16L19.5601 24L21.4401 22.12Z"
                                                    fill="#5E6278" />
                                            </svg>
                                        </button>
                                        <button type="button" v-if="whatsOn.data.length > 0" class="btn"
                                            @click="nextEventScroll"
                                            style="padding:5px 3px !important;border:1px #EBEDF3 solid !important;box-shadow:unset !important;"><svg
                                                width="33" height="32" viewBox="0 0 33 32" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M11.5601 22.12L17.6667 16L11.5601 9.88L13.4401 8L21.4401 16L13.4401 24L11.5601 22.12Z"
                                                    fill="#5E6278" />
                                            </svg>

                                        </button>
                                    </div>
                                    <router-link v-if="whatsOn.data.length > 0" to="/whats-on" class="c-primary-custom fw-semibolder">See All
                                    </router-link>
                                </div>
                                <div class="text-center pt-3 pb-3" v-if="whatsOn.data.length == 0">Tidak Ada Data</div>
                                <div class="slider-events-home">
                                    <div v-for="(context, index) in whatsOn.data ?? []" class="list-whats-on">
                                        <div class="image-box mb-2">
                                            <img :src="`${renderFileEvent(context)}`" @error="$setNoImageUrl">
                                            <div class="d-flex justify-content-center">
                                                <div class="badge-timer">{{ context?.countdown }}</div>
                                            </div>
                                        </div>
                                        <div class="pt-2 text-gray-600" style="font-size:11px;font-weight: 900;">
                                            {{$moment(context.startDate).format('DD/MM/YYYY  HH:mm')}}
                                            -
                                            {{$moment(context.endDate).format('DD/MM/YYYY  HH:mm')}}
                                        </div>
                                        <router-link :to="`/whats-on/${context.id}`" class="title pt-2">
                                            {{ $getTitleEventsOrDestination(context.eventLanguages) }}</router-link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </div>
                <!-- cak ning static -->
               <!-- <div class="wrap-around py-3" style="background-color:white;">
                <br>
                <div class="container">
                    <div style="background:#04954D;border-radius: 40px;" class="px-5 box-cakning py-4">
                        <div class="row align-items-center">
                            <div class="col-lg-3 my-2">
                                <img :src="`${assetUrl}assets/images/cakning-2023/logo.png`" class="w-100"/>
                            </div>
                            <div class="col-lg-8 my-2">
                                <div class="text-white fs-1 title" style="font-weight:bold;">Daftar Cak Ning Yuk</div>
                                <div class="text-white mb-4 pb-1 desc fs-5 pt-1">Dapatkan banyak benefit menjadi Cak Ning Surabaya 2023</div>
                                <router-link to="/cakning-2023" style="background:#fff;color:#04954D;border-radius: 10px;padding-top: 13px;padding-bottom: 13px;" class="link px-5">Lihat Syarat&ensp;<svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_2535_6)">
                                <path d="M4.66671 9.66659C4.20647 9.66659 3.83337 10.0397 3.83337 10.4999C3.83337 10.9602 4.20647 11.3333 4.66671 11.3333H10.5C10.9603 11.3333 11.3334 10.9602 11.3334 10.4999C11.3334 10.0397 10.9603 9.66659 10.5 9.66659H4.66671Z" fill="#049C4F"/>
                                <path d="M9.91078 14.9107C9.58535 15.2361 9.58535 15.7637 9.91078 16.0892C10.2362 16.4146 10.7639 16.4146 11.0893 16.0892L16.0893 11.0892C16.4048 10.7737 16.4158 10.2657 16.1143 9.93681L11.531 4.93681C11.22 4.59755 10.6929 4.57463 10.3536 4.88562C10.0143 5.19662 9.99142 5.72376 10.3024 6.06302L14.3466 10.4749L9.91078 14.9107Z" fill="#049C4F"/>
                                </g>
                                <defs>
                                <clipPath id="clip0_2535_6">
                                <rect width="20" height="20" fill="white" transform="translate(0.5 0.5)"/>
                                </clipPath>
                                </defs>
                                </svg>
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="wrap-around py-5" style="background-color:white;">
                <br>
                <div class="container">
                    <div class="head d-flex justify-content-between align-items-center" style="flex-wrap:wrap;">
                        <div class="py-2 kiri">
                            <h3 class="fw-bold">Let’s Stroll Around</h3>
                        </div>
                        <div class="py-2 d-flex justify-content-between align-items-center flex-arrow-mobile-see-all-article">
                            <div class="group-arrow-mobile-articel d-none">
                                <div class="d-flex">
                                    <button type="button" v-if="strollAround.data.length > 0" class="btn me-2"
                                        @click="prevArticleScroll"
                                        style="padding:5px 3px !important;border:1px #EBEDF3 solid !important;box-shadow:unset !important;"><svg
                                            width="33" height="32" viewBox="0 0 33 32" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M21.4401 22.12L15.3334 16L21.4401 9.88L19.5601 8L11.5601 16L19.5601 24L21.4401 22.12Z"
                                                fill="#5E6278" />
                                        </svg>
                                    </button>
                                    <button type="button" v-if="strollAround.data.length > 0" class="btn"
                                        @click="nextArticleScroll"
                                        style="padding:5px 3px !important;border:1px #EBEDF3 solid !important;box-shadow:unset !important;"><svg
                                            width="33" height="32" viewBox="0 0 33 32" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.5601 22.12L17.6667 16L11.5601 9.88L13.4401 8L21.4401 16L13.4401 24L11.5601 22.12Z"
                                                fill="#5E6278" />
                                        </svg>

                                    </button>
                                </div>
                            </div>
                            <router-link :to="'/stroll-around'" v-if="strollAround.data.length > 0" class="text-success fw-bolder" style="cursor:pointer;">See All</router-link>
                        </div>
                    </div>
                    <div class="loader d-flex justify-content-center align-items-center" v-if="strollAround?.loading">
                        <app-loader></app-loader>
                    </div>
                    <div class="isi" v-else>
                        <div class="emptys d-flex align-items-center justify-content-center" v-if="!strollAround?.data?.length">
                            <span class="text-gray-700">Tidak ada data</span>
                        </div>
                        <template v-else>
                            <div class="mobile-group-article">
                            <div class="slider-article-home">
                                <div class="card" v-for="(context, index) in strollAround?.data" style="box-shadow:0px 0px 10px rgba(0, 0, 0, 0.09); border-radius:10px;">
                                    <div class="card-body">
                                        <div class="card-body py-2" style="background-color:white; border-bottom:none;">
                                            <h5 class="title-article"><b>{{ context?.title || '-' }}</b></h5>
                                            <b @click="$router.push({path: `/stroll-around/${context?.id}`})" class="text-success read-more-article" style="cursor:pointer;">
                                                Read More
                                                <svg width="13" height="12" viewBox="0 0 13 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.5 0L5.4425 1.0575L9.6275 5.25H0.5V6.75H9.6275L5.4425 10.9425L6.5 12L12.5 6L6.5 0Z" fill="#049C4F"/></svg>
                                            </b>
                                        </div>
                                    </div>
                                    <img :src="`${context?.articleThumbnail?.link}?preview=1`" @error="$setNoImageUrl" style="width:100%;height:250px; object-fit:cover; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="desktop-group-article">
                            <div class="row">
                                <template  v-for="(context, index) in strollAround?.data">
                                    <div class="col-md-4 py-3" v-if="index < 3">
                                        <div class="card" style="box-shadow:0px 0px 10px rgba(0, 0, 0, 0.09); border-radius:10px;">
                                            <div class="card-body">
                                                <div class="card-body py-2" style="background-color:white; border-bottom:none;">
                                                    <h5 class="title-article"><b>{{ context?.title || '-' }}</b></h5>
                                                    <b @click="$router.push({path: `/stroll-around/${context?.id}`})" class="text-success read-more-article" style="cursor:pointer;">
                                                        Read More
                                                        <svg width="13" height="12" viewBox="0 0 13 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.5 0L5.4425 1.0575L9.6275 5.25H0.5V6.75H9.6275L5.4425 10.9425L6.5 12L12.5 6L6.5 0Z" fill="#049C4F"/></svg>
                                                    </b>
                                                </div>
                                            </div>
                                            <img :src="`${context?.articleThumbnail?.link}?preview=1`" @error="$setNoImageUrl" style="width:100%;height:250px; object-fit:cover; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;" alt="">
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                        </template>
                    </div>
                </div>
                <br>
            </div>
            <div class="bg-white pb-5">
                <div class="loader d-flex align-items-center justify-content-center" v-if="bus?.loading">
                    <div class="d-flex justify-content-center mt-3 mb-3">
                        <app-loader></app-loader>
                    </div>
                </div>
                <div v-else class="container mb-5">
                    <div class="row">
                        <div class="col-lg-6 mb-3 border-surabaya-sight">
                            <h4 class="fw-bold pt-5">{{ bus?.data?.heading || '' }}</h4>
                            <div class="pt-2" style="color:#181C32;line-height: 2;">{{ bus?.data?.description || '' }}</div>
                            <div class="mt-5 mb-5">
                                <router-link to="/bus-ssct" class="bg-primary-custom text-white py-2 px-3 rounded-patern">More Information&ensp;&ensp;<i class="fa fa-arrow-right"></i></router-link>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3" style="background:#F1FAFF;">
                            <img :src="`${assetUrl}assets/images/sample/ssct-2.png`" class="w-100 mt-5 mb-5"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wrap-virtual-tourism py-5" style="background-color:#F1FAFF;">
                <br>
                <div class="container">
                    <div class="head d-flex justify-content-between align-items-center" style="flex-wrap:wrap;">
                        <div class="py-2 kiri">
                            <h3 class="fw-bold">Virtual Tourism</h3>
                        </div>
                        <div class="py-2 kanan">
                            <a href="https://virtualtourism.surabaya.go.id/" target="_blank" class="text-primary fw-bolder"
                                style="cursor:pointer;">Visit Virtual Tourism Surabaya</a>
                        </div>
                    </div>
                    <br>
                    <div class="gambar">
                        <img :src="`${assetUrl}assets/images/virtual_tourism.svg`" style="width:100%;" alt="">
                    </div>
                </div>
                <br>
            </div>
            <div class="wrap-super-destination-5" style="background-color:white;">
                <br>
                <div class="container">
                    <div class="head d-flex justify-content-between align-items-center" style="flex-wrap:wrap;">
                        <div class="py-2 kiri">
                            <h3 class="fw-bold">10 Super Destination</h3>
                        </div>
                        <div class="py-2 kanan" v-if="superDestination.data.length.length > 0">
                            <h6 class="text-success" style="cursor:pointer;"
                                @click="$router.push({name: 'destination'})">See All Destinations</h6>
                        </div>
                    </div>
                </div>
                <br>
                <div class="loader d-flex align-items-center justify-content-center" v-if="superDestination.loading">
                    <div class="d-flex justify-content-center mt-3 mb-3">
                        <app-loader></app-loader>
                    </div>
                </div>
                <div class="w-100 pb-5 pt-3" v-else>

                    <div class="text-center pt-3 pb-3" v-if="superDestination.data.length == 0">Tidak Ada Data</div>
                    <div class="slider-destination px-2">
                        <div v-for="(context, index) in superDestination.data">
                            <router-link :to="`/destination/${context?.id}`">
                            <div class="list-destination"
                                :style="`background-image:linear-gradient(359.32deg, rgba(0, 0, 0, 0.5) 10%, rgba(0, 0, 0, 0) 99.42%), url('${renderFileDestination(context)}'), url('${$noImageUrl()}');`">
                                <router-link :to="`/destination/${context?.id}`" class="title">
                                    {{ $getTitleEventsOrDestination(context.touristDestinationLanguages) }}
                                </router-link>
                                <router-link :to="`/destination/${context?.id}`" class="view-more">
                                    Visit&ensp;
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9 3L7.9425 4.0575L12.1275 8.25H3V9.75H12.1275L7.9425 13.9425L9 15L15 9L9 3Z" fill="white" /></svg>
                                </router-link>
                            </div>
                        </router-link>
                        </div>
                    </div>

                </div>
            </div>
            <div class="wrap instagram py-5" style="background-color:white">
                <br>
                <div class="container">
                    <div class="head d-flex justify-content-between align-items-center" style="flex-wrap:wrap;">
                        <div class="py-2 kiri">
                            <h3 class="fw-bold">Our Instagram</h3>
                        </div>
                    </div>
                    <div class="loading d-flex align-items-center justify-content-center" v-if="instagram.loading">
                        <app-loader></app-loader>
                    </div>
                    <div class="gambar">
                        <div class="row">
                            <div class="col-lg-3 col-md-4 col-sm-6 col-6 py-3 column-instagram" v-for="(context, index) in instagram?.data">
                                <a :href="context?.permalink" target="_blank">
                                    <img :src="`${context.type == 'VIDEO' ? context.thumbnail : context?.path}`" style="width:100%;object-fit: cover;object-position: center; border-radius:10px;" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </div>
            <div class="wrap-gallery d-flex py-5" id="wrap-gallery"
                style="background-color:white; overflow-x: auto; width:100%;">
                <br>
                <div class="loader d-flex align-items-center justify-content-center w-100" v-if="gallery.loading">
                    <app-loader></app-loader>
                </div>
                <div v-else class="gallery d-flex flex-column" style="max-height:700px; flex-wrap:wrap;">

                    <div v-for="(val, i) in gallery.data" class="wrap-gambar p-2 m-2" style="border-radius:10px; box-shadow:0px 0px 5px lightgray; width:200px;">
                        <a :href="`${val?.link}?preview=1`" data-fancybox="gallery" fancybox="gallery">
                            <img v-if="val?.fileType == 'photo'" :src="`${val?.link}?preview=1`" @error="$setNoImageUrl" style="width:100%; border-radius:10px;" alt="">
                            <video v-else controls style="width:100%;">
                                <source :src="`${val?.link}?preview=1`">
                            </video>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <app-landing-page-footer></app-landing-page-footer>

        <div class="w-100 box-iklan d-none" @click="showIklanFlag = false" :class="showIklanFlag ? 'show-iklan' : ''">
            <div style="min-height: 100%;
    display: flex;
    align-items: center;
    padding: 20px;
    justify-content: center;">
            <div class="width-iklan" @click.stop="">
                <div class="c-pointer" @click="showIklanFlag = false" style="box-shadow:0px 0px 10px rgba(0, 0, 0, 0.09);display:flex;align-items:center;justify-content:center;position:absolute;right:-10px;width:30px;height:30px;top:-10px;z-index: 9;background:#fff;border-radius: 100px;"><i class="fa fa-times"></i></div>
                <div v-show="showSliderIklan">
                <div class="slider-iklan">
                    <div v-for="context in listIklan">
                        <div class="row" style="padding:0 !important;margin:0 !important;">
                            <div class="col-lg-6 column-left-iklan">

                                    <img :src="context.advertisementFile?.link ?? '-'" @error="$setNoImageUrl"/>

                            </div>
                            <div class="col-lg-6 column-right-iklan">
                                <div class="title">{{context.title}}</div>
                                <a :href="context.buttonLink" target="_blank" class="btn btn-primary w-100 target"
                                    style="background:#049C4F !important">{{context.buttonText}}&ensp;<i class="fa fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slick-slider-dots"></div>
            </div>
        </div>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from "moment";

    export default {
        components: {},
        data() {
            return {
                showIklanFlag: false,
                showSliderIklan: false,
                headerEvent: {
                    title: '',
                    description: ''
                },
                headerBusssct:{
                    description: ''
                },
                listIklan: [],
                disabledChangePage: false,
                assetUrl: assetUrl,
                countDownInterval: null,
                about: {
                    loading: false,
                    data: {
                        fotoKiri: {
                            kiri: [],
                            kanan: [],
                            tengah: []
                        },
                        fotoKanan: {
                            kiri: [],
                            kanan: [],
                            tengah: []
                        },
                        video: null,
                        thumbnailVideo: '',
                        label: '',
                        description: ''
                    }
                },
                gallery: {
                    loading: false,
                    data: []
                },
                strollAround: {
                    loading: false,
                    data: []
                },
                superDestination: {
                    loading: true,
                    data: []
                },
                whatsOn: {
                    loading: true,
                    data: []
                },
                instagram: {
                    loading: false,
                    data: []
                },
                bus: {
                    loading: false,
                    data: '',
                },
            }
        },
        beforeRouteLeave(to, from, next) {
            if(!this.disabledChangePage){
                if (this.countDownInterval) {
                    clearInterval(this.countDownInterval);
                }

                next();
            }

        },
        watch:{
            'showIklanFlag'(){
                if(this.showIklanFlag){
                    setTimeout(() => {
                        $("body").addClass('overflow-hidden');
                    }, 1);

                }else{
                    setTimeout(() => {
                        $("body").removeClass('overflow-hidden');
                    }, 1);

                }
            }
        },
        mounted() {
            reinitPluginLandingPage();
            this.getAbout();
            this.showIklan();
            this.$axios().get(`menu-header-web?headerType=event`)
                .then(response => {
                    this.headerEvent.title = response.data.data.heading;
                    this.headerEvent.description = response.data.data.description;
                })

            this.getWhatsOn();
            this.getSuperDestination();
            this.getStrollAround();
            this.getGallery();
            this.getInstagram();
            this.getBus();

            let elGallery = document.getElementById('wrap-gallery');
            let triggerStop = 0;
            let kanan = true;
            self.setInterval(() => {
                if (triggerStop == elGallery.scrollLeft && elGallery.scrollLeft > 0) {
                    if (kanan) {
                        kanan = false;
                    } else {
                        kanan = true;
                    }
                } else if (elGallery.scrollLeft < 1) {
                    kanan = true;
                }

                triggerStop = elGallery.scrollLeft;

                if (kanan) {
                    elGallery.scrollTo(elGallery.scrollLeft + 1, 0);
                } else {
                    elGallery.scrollTo(elGallery.scrollLeft - 1, 0);
                }
            }, 25);

            this.countDownInterval = setInterval(() => {
                this.reinitCountDownEvent();
            }, 1000)
        },
        methods: {
            showIklan(){
                let that = this;
                this.$axios().get(`pop-up-advertisement`)
                    .then(response => {

                        this.listIklan = response.data.data;
                        if(this.listIklan.length > 0){
                            let img1 = new Image();
                            img1.src = this.listIklan[0].advertisementFile ? this.listIklan[0].advertisementFile.link : this.$noImageUrl();
                            img1.onload = function() {
                                that.initSliderIklan();
                            };
                            img1.onerror = function() {
                               that.initSliderIklan();
                            };
                        }
                    })

            },
            initSliderIklan()       {
                let that = this;
                that.showIklanFlag = true;
                if ($('.slider-iklan').hasClass('slick-initialized')) {
                    $('.slider-iklan').slick('destroy');
                }
                that.showSliderIklan = true;
                setTimeout(() => {
                    $('.slider-iklan').slick({
                        dots: true,
                        infinite: true,
                        arrows: false,
                        autoplaySpeed: 2000,
                        autoplay: true,
                        centerMode: false,
                        slidesToScroll: 1,
                        slidesToShow: 1,
                        adaptiveHeight: true,
                    });
                }, 50);
            },
            reinitCountDownEvent() {
                for (let i = 0; i < this.whatsOn.data.length; i++) {
                    const availableDate = this.$moment(this.whatsOn.data[i].startDate);

                    const currentDate = this.$moment().format();
                    const diffTime = availableDate.diff(currentDate, 'seconds');

                    if (diffTime < 0) {
                        this.whatsOn.data[i].countdown = 'Sedang Berlangsung'
                    } else {
                        let duration = moment.duration(diffTime * 1000, 'milliseconds');

                        const hours = duration.hours() < 10 ? '0' + duration.hours() + 'h' : duration
                            .hours() + 'h';

                        const days = parseInt(duration.asDays()) < 10 ? '0' + parseInt(duration.asDays()) + 'd' :
                            parseInt(duration
                                .asDays()) + 'd';
                        const minutes = duration.minutes() < 10 ? '0' + duration.minutes() + 'm' : duration
                            .minutes() + 'm';
                        const seconds = duration.seconds() < 10 ? '0' + duration.seconds() + 's' : duration
                            .seconds() + 's';

                        this.whatsOn.data[i].countdown = days + ' : ' + hours + ' : ' + minutes + ' : ' + seconds
                    }
                }
            },
            getAbout(){
                let that = this;

                this.about.loading = true;
                this.$axios().get(`homepage/about-surabaya`)
                    .then(res => {
                        let data = res?.data?.data;
                        this.about.data = {
                            fotoKiri: {
                                kiri: [],
                                kanan: [],
                                tengah: []
                            },
                            fotoKanan: {
                                kiri: [],
                                kanan: [],
                                tengah: []
                            },
                            video: data?.videoAboutFiles,
                            thumbnailVideo: data?.thumbnailVideoAboutFiles?.link,
                            label: data?.label,
                            description: data?.description
                        };

                        $.each(data?.leftSideAboutFiles, function(i,val){
                            if(i < 2){
                                that.about.data.fotoKiri.kiri.push(val);
                            }
                            else if(i >= 2 && i < 4){
                                that.about.data.fotoKiri.kanan.push(val);
                            }
                            else{
                                that.about.data.fotoKiri.tengah.push(val);
                            }
                        });
                        $.each(data?.rightSideAboutFiles, function(i,val){
                            if(i < 2){
                                that.about.data.fotoKanan.kiri.push(val);
                            }
                            else if(i >= 2 && i < 4){
                                that.about.data.fotoKanan.kanan.push(val);
                            }
                            else{
                                that.about.data.fotoKanan.tengah.push(val);
                            }
                        });
                         this.about.loading = false;
                    })
                    .catch(err => {
                    });
            },
            getStrollAround(){
                let that = this;

                this.strollAround.loading = true;
                let params = {
                    sort_by: 'created_at',
                    order_by: 'desc'
                }

                this.$axios().get(`web-article?limit=10`,{
                    params
                })
                    .then(res => {
                        let data = res?.data?.data.data;
                        this.strollAround.data = [];
                        $.each(data, function(i, val){
                            that.strollAround.data.push(val);
                        });
                        this.strollAround.loading = false;

                        setTimeout(() => {
                            $('.slider-article-home').slick({
                                dots: false,
                                infinite: true,
                                arrows: false,
                                speed: 300,
                                autoplay: false,
                                centerMode: false,
                                slidesToScroll: 1,
                                slidesToShow: 3,
                                responsive: [{
                                        breakpoint: 991,
                                        settings: {
                                            slidesToShow: 2,
                                            slidesToScroll: 1,
                                        }
                                    },
                                    {
                                        breakpoint: 576,
                                        settings: {
                                            slidesToShow: 1,
                                            slidesToScroll: 1,
                                        }
                                    },
                                ]
                            });
                        }, 500);
                    });
            },
            getSuperDestination() {
                let that = this;
                this.$axios().get(`stroll-shop?isSuperior=1&page=1&limit=10`)
                    .then(res => {
                        let data = res.data.data.data;
                        this.superDestination.data = data;
                        this.superDestination.loading = false;

                        setTimeout(() => {
                            $('.slider-destination').slick({
                                swipeToSlide: true,
                                dots: false,
                                accessibility: false,
                                infinite: false,
                                arrows: false,
                                speed: 300,
                                autoplay: false,
                                centerMode: false,
                                variableWidth: true,
                                slidesToScroll: 1,
                                responsive: [{
                                        breakpoint: 991,
                                        settings: {
                                            slidesToScroll: 1,
                                        }
                                    },
                                    {
                                        breakpoint: 576,
                                        settings: {
                                            slidesToScroll: 1,
                                        }
                                    },
                                ]
                            });

                            let that = this;
                            // On before slide change
                            $('.slider-destination').on('beforeChange', function(event, slick, currentSlide, nextSlide){
                                that.disabledChangePage = true;
                            });
                            // On swipe event
                            $('.slider-destination').on('swipe', function(event, slick, direction){
                                that.disabledChangePage = true;
                                setTimeout(() => {
                                    that.disabledChangePage = false;
                                }, 1000);
                            // left
                            });
                        }, 500);
                    });
            },
            getWhatsOn() {
                let that = this;
                this.$axios().get(`whats-on?isActive=1&page=1&limit=10&hide=1`)
                    .then(res => {
                        let data = res.data.data.data;
                        this.whatsOn.loading = false;

                        let dataEvent = data.map(function (el) {
                            const o = Object.assign({}, el);
                            o.countdown = '0d : 0h : 0m : 0s';
                            return o;
                        });

                        this.whatsOn.data = dataEvent;

                        setTimeout(() => {
                            $('.slider-events-home').slick({
                                dots: false,
                                infinite: true,
                                arrows: false,
                                speed: 300,
                                autoplay: true,
                                centerMode: false,
                                slidesToScroll: 1,
                                slidesToShow: 3,
                                responsive: [{
                                        breakpoint: 991,
                                        settings: {
                                            slidesToShow: 2,
                                            slidesToScroll: 1,
                                        }
                                    },
                                    {
                                        breakpoint: 576,
                                        settings: {
                                            slidesToShow: 1,
                                            slidesToScroll: 1,
                                        }
                                    },
                                ]
                            });
                        }, 500);
                    });
            },
            getBus(){
                this.bus.loading = true;
                this.$axios().get(`menu-header-web?headerType=bus_ssct`)
                .then(response => {
                    let data = response?.data?.data;
                    console.log(data);
                    this.bus.data = data;
                    this.bus.loading = false;
                });
            },
            getGallery(){
                let that = this;

                this.gallery.loading = true;
                this.$axios().get(`homepage/gallery`)
                .then(res => {
                        let data = res.data;

                        this.gallery.data = data;
                         this.gallery.loading = false;
                    })
                    .catch(err => {
                    });
            },
            getInstagram(){
                let that = this;

                this.instagram.loading = true;
                this.$axios().get(`instagram/feeds`)
                    .then(res => {
                        let data = res?.data?.data;
                        this.instagram.data = [];
                        $.each(data, function(i,val){
                            if(i > 7){
                                return false;
                            }
                            that.instagram.data.push(val);
                        });

                        this.instagram.loading = false;
                    })
                    .catch(err => {
                    });
            },
            nextEventScroll() {
                $('.slider-events-home').slick('slickNext');
            },
            prevEventScroll() {
                $('.slider-events-home').slick('slickPrev');
            },
            nextArticleScroll() {
                $('.slider-article-home').slick('slickNext');
            },
            prevArticleScroll() {
                $('.slider-article-home').slick('slickPrev');
            },
            renderFileDestination(data) {
                let link = data.touristDestinationFiles.find(val => val.fileType == 'thumbnail');
                return `${link?.link}`;
            },
            renderFileEvent(data) {
                return `${data?.eventThumbnail?.link ? data?.eventThumbnail?.link : '-'}`;
            },
        },
    }

</script>

<style scoped>
    .wrap-tulisan .tulisan h1 {
        font-size: 5em;
    }

    .wrap-about .tulisan-mobile {
        display: none;
    }

    .wrap-about .wrap-video .vidio {
        width: 100% !important;
        position: relative;
    }

    .wrap-about .wrap-video iframe {
        width: 100% !important;
        height: 400px !important;
    }

    .wrap-gallery::-webkit-scrollbar {
        scrollbar-width: none !important;
        display: none !important;
    }

    .wrap-gallery {
        -ms-overflow-style: none !important;
        /* IE and Edge */
        scrollbar-width: none !important;
        /* Firefox */
    }

    .list-whats-on {
        border: 1px solid #E4E6EF;
        border-radius: 12px;
        padding: 10px;
    }

    .list-whats-on .title {
        font-size: 17px;
        font-weight: 600;
        color: #049C4F;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        height: 60px;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .list-whats-on .image-box {
        position: relative;
    }

    .list-whats-on .image-box img {
        width: 100%;
        object-fit: cover;
        object-position: center;
        height: 230px;
        border-radius: 10px;
    }

    @media(max-width:991px) {
        .list-whats-on .title {
            font-size: 15px;
        }
    }

    .list-whats-on .badge-timer {
        background-color: rgba(126, 130, 153, 0.82);
        color: #fff;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        position: absolute;
        bottom: 20px;
        letter-spacing: 1.5px;
        padding: 5px 15px;
        font-size: 12px;
    }
    .slider-article-home{
        margin-top: 15px;
    }
    .slider-article-home .slick-slide {
        margin: 0 10px;
    }

    /* the parent */
    .slider-article-home .slick-list {
        margin: 0 -10px;
    }


    .slider-events-home .slick-slide {
        margin: 0 10px;
    }

    /* the parent */
    .slider-events-home .slick-list {
        margin: 0 -10px;
    }

    @media(max-width:576px) {
        .list-whats-on {
            width: 250px;
        }

        .slider-events-home .slick-slide {
            margin: 0 10px;
        }

        /* the parent */
        .slider-events-home .slick-list {
            margin: 0 -10px;
        }
    }




    /* //destination */

    .slider-destination .slick-slide {
        margin: 0 10px;
    }

    /* the parent */
    .slider-destination .slick-list {
        margin: 0;
    }

    .list-destination {
        width: 380px;
        height: 500px;
        background-size: cover;
        border-radius: 10px;
        background-position: center;
        padding: 15px;
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: end;
    }

    @media(max-width:480px){
        .list-destination {
            width: 280px;
            height: 380px;
        }
    }

    .list-destination .title {
        font-size: 20px;
        font-weight: 500;
        padding-bottom: 10px;
        color: #fff;
    }

    .list-destination .view-more {
        color: #fff;
        font-size: 16px;
        margin-top: 5px;
    }

    .list-destination .recomended {
        background-color: #fff;
        font-size: 14px;
        position: absolute;
        display: flex;
        align-items: center;
        top: 15px;
        padding: 3px 10px;
        border-radius: 10px;

    }

    .list-destination .recomended span {
        color: #5E6278;
        font-size: 12px !important;
    }

    @media screen and (max-width:1100px) {
        .wrap-about .tulisan-mobile {
            display: block;
        }

        .wrap-about .row {
            display: none !important;
        }
    }

    @media screen and (max-width:700px) {
        .wrap-tulisan .tulisan h1 {
            font-size: 3em;
        }

        .wrap-about .wrap-video iframe {
            height: 320px !important;
        }
    }

    @media screen and (max-width:500px) {
        .wrap-about .wrap-video iframe {
            height: 250px !important;
        }
    }

    @media screen and (max-width:400px) {
        .wrap-tulisan .tulisan h1 {
            font-size: 1.7em;
        }

        .wrap-about .wrap-video iframe {
            height: 170px !important;
        }
    }

    @media(max-width:991px){
        .group-arrow-mobile-articel{
            display: block !important;
        }
        .flex-arrow-mobile-see-all-article{
            width:100%;
        }
        .title-article{
            font-size: 17px !important;
        }
        .read-more-article{
            font-size: 15px !important;
        }
    }

    .mobile-group-article{
        display: none !important;
    }
    .desktop-group-article{
        display: block !important;
    }
    @media(max-width:991px){
        .mobile-group-article{
        display: block !important;
    }
    .desktop-group-article{
        display: none !important;
    }
    }


    .column-left-iklan{
        min-height:450px;
        padding: 0 !important;
    }
    .column-left-iklan img{
        width: 100%;
        min-height:450px;
        object-position: center;
    }
    .column-right-iklan{
        min-height:450px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 50px 30px;
    }
    .column-right-iklan .title{
        font-size: 24px;
        line-height: 2;
        font-weight: 600;
        word-break: break-word;
        display: -webkit-box;
        -webkit-line-clamp: 5;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

        .column-left-iklan img{
        border-top-left-radius: 15px;
        border-bottom-left-radius: 15px;
    }

    @media(max-width:567px){
        .box-cakning{
            padding: 30px 15px !important;
            border-radius: 15px !important;
        }
        .box-cakning .title{
            font-size: 24px !important;
        }
        .box-cakning .desc{
            font-size: 15px !important;
        }
        .box-cakning .link{
            padding: 10px 15px !important;
        }
    }
    @media(max-width:991px){
        #modal-iklan.show{
            align-items: unset !important;
        }
        .column-left-iklan{
            min-height:unset !important;
            padding: 0 !important;
        }
        .column-left-iklan img{
            min-height:unset !important;
        }
        .column-right-iklan{
            min-height:unset !important;
            padding: 15px !important;
        }
        .column-right-iklan .title{
            font-size: 17px;
        }
        .column-right-iklan .target{
            margin-top:40px !important;
            margin-bottom: 50px !important;
        }
        .column-left-iklan img{
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            border-bottom-left-radius: 0px !important;
        }

    }
    /* .slider-iklan .slick-slide {
        max-width: 750px;
        width: 100% !important;
    } */
    @media(max-width:991px){
        /* .slider-iklan .slick-slide {
            width: 100% !important;
        }    */

        .modal { display: block; visibility: hidden; pointer-events: none; }
        .modal.show { visibility: visible; pointer-events: auto; }
    }
    .width-iklan{
        width: 100%;
        max-width: 750px;
        background-color: #fff;
        position: relative;
        border-radius: 15px;
        transform: translateY(0);
    }
    .box-iklan{
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        background:#0000004d;
        overflow: auto;
        height: 100vh;
        z-index: 99999999999999 !important;
    }
    .box-iklan.show-iklan{

        display: block !important;
    }
    @media(max-width:991px){
        .box-iklan.show-iklan{
            align-items: flex-start !important;
        }
    }

    .buss-desktop{
        display: block;
    }
    .buss-mobile{
        display: none;
    }
    @media(max-width:991px){
        .buss-desktop{
        display: none !important;
    }
    .buss-mobile{
        display: block;
    }
    }


    .border-surabaya-sight{
        border: 1px #f2f2f2 solid;
        border-right: 0;
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
    }

    @media(max-width:991px){
        .border-surabaya-sight{
           border: 0 !important;
        }
    }

    .column-instagram img{
        aspect-ratio: 1/1;
    }

    /* @media(max-width:1200px){
        .column-instagram img{
            height: 260px;
        }
    }

    @media(max-width:991px){
        .column-instagram img{
            height: 250px;
        }
    }

    @media(max-width:450px){
        .column-instagram img{
            height: 200px;
        }
    }

    @media(max-width:390px){
        .column-instagram img{
            height: 170px;
        }
    }

    @media(max-width:360px){
        .column-instagram img{
            height: 160px;
        }
    }
    @media(max-width:320px){
        .column-instagram img{
            height: 150px;
        }
    } */
</style>
