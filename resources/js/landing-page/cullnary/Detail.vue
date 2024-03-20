<template>
    <div>
        <app-landing-page-navbar></app-landing-page-navbar>
        <div class="content bg-content-custom pb-5">
            <section class="pt-5">
                <div class="container">
                    <div class="d-flex flex-wrap align-items-center">
                        <div style="font-weight:500">Detail Eat & Drink</div>
                        <div class="mx-3" style="color:#B5B5C3">|</div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb" style="font-size:14px;margin-bottom: 0 !important;">
                                <li class="breadcrumb-item" style="color:#B5B5C3 !important">
                                    <router-link to="/">Home</router-link>
                                </li>
                                <li class="breadcrumb-item" style="color:#B5B5C3 !important">
                                    <router-link to="/cullnary">Eat & Drink</router-link>
                                </li>
                                <li class="breadcrumb-item active" style="color:#B5B5C3 !important" aria-current="page">
                                    Detail</li>
                            </ol>
                        </nav>
                    </div>
                    <template v-if="pageStatus == 'page-load'">
                        <div class="d-flex justify-content-center mt-5 mb-5">
                            <app-loader></app-loader>
                        </div>

                    </template>
                    <template v-else>
                        <div class="row">
                            <div class="col-lg-7 mt-3">
                                <div class="d-flex justify-content-center"><img :src="`${mainPreviewImage}`"
                                        @error="$setNoImageUrl" class="mb-3"
                                        style="max-width:100%;object-fit:cover;object-position:center;">
                                </div>
                                <div class="slider-gallery-image">
                                    <img :src="`${a.link}`" @error="$setNoImageUrl" v-for="a in data.culinaryFiles"
                                        @click="mainPreviewImage = a.link" class="me-3 slider-option-detail-image">
                                </div>
                                <div class="fw-bolder fs-3 pt-3">{{ data.name }}</div>
                                <div style="color:#3F4254" class="pt-3">
                                    <div v-html="$getDescriptionEventsOrDestination(data.culinaryLanguages)">
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mt-3 mb-5">
                                    <div class="pe-3">Share</div>
                                    <div class="d-flex align-items-center">
                                        <ShareNetwork class="me-3" network="facebook" :url="currentUrl"
                                            :title="data.name">
                                            <svg width="33" height="32" viewBox="0 0 33 32" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M29.8332 16.0003C29.8332 8.64032 23.8598 2.66699 16.4998 2.66699C9.13984 2.66699 3.1665 8.64032 3.1665 16.0003C3.1665 22.4537 7.75317 27.827 13.8332 29.067V20.0003H11.1665V16.0003H13.8332V12.667C13.8332 10.0937 15.9265 8.00032 18.4998 8.00032H21.8332V12.0003H19.1665C18.4332 12.0003 17.8332 12.6003 17.8332 13.3337V16.0003H21.8332V20.0003H17.8332V29.267C24.5665 28.6003 29.8332 22.9203 29.8332 16.0003Z"
                                                    fill="#3699FF" />
                                            </svg></ShareNetwork>
                                        <ShareNetwork class="me-3" network="twitter" :url="currentUrl"
                                            :title="data.name">
                                            <svg width="33" height="32" viewBox="0 0 33 32" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M30.4466 7.99967C29.4199 8.46634 28.3132 8.77301 27.1666 8.91967C28.3399 8.21301 29.2466 7.09301 29.6732 5.74634C28.5666 6.41301 27.3399 6.87967 26.0466 7.14634C24.9932 5.99967 23.5132 5.33301 21.8332 5.33301C18.6999 5.33301 16.1399 7.89301 16.1399 11.053C16.1399 11.5063 16.1932 11.9463 16.2866 12.3597C11.5399 12.1197 7.31322 9.83967 4.49989 6.38634C4.00656 7.22634 3.72656 8.21301 3.72656 9.25301C3.72656 11.2397 4.72656 12.9997 6.27322 13.9997C5.32656 13.9997 4.44656 13.733 3.67322 13.333V13.373C3.67322 16.1463 5.64656 18.4663 8.25989 18.9863C7.42086 19.216 6.54002 19.2479 5.68656 19.0797C6.0487 20.2163 6.75794 21.2109 7.71458 21.9236C8.67122 22.6363 9.82715 23.0313 11.0199 23.053C8.99806 24.6536 6.49188 25.5188 3.91322 25.5063C3.45989 25.5063 3.00656 25.4797 2.55322 25.4263C5.08656 27.053 8.09989 27.9997 11.3266 27.9997C21.8332 27.9997 27.6066 19.2797 27.6066 11.7197C27.6066 11.4663 27.6066 11.2263 27.5932 10.973C28.7132 10.173 29.6732 9.15967 30.4466 7.99967Z"
                                                    fill="#3699FF" />
                                            </svg>

                                        </ShareNetwork>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 mt-3">
                                <div class="bg-white p-3 rounded-patern">
                                    <div class="d-flex flex-wrap mt-3">
                                        <router-link :to="`/cullnary?id=${a.id}&name=${a.name}`" class="p-2 me-2 mb-2"
                                            v-for="a in data.culinaryCategories"
                                            style="background:#E8FFF3;color:#049C4F;border-radius:5px">
                                            {{a.name}}
                                        </router-link>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-lg-4 fs-14px mb-3">Alamat</div>
                                        <div class="col-lg-8 fs-14px mb-3" style="color:#0E5CA8;font-weight:500">
                                            {{data.address}}
                                        </div>
                                        <div class="col-lg-4 fs-14px mb-3">Jam Buka</div>
                                        <div class="col-lg-8 fs-14px mb-3">
                                            <ul style="list-style-type: none !important;padding:0 !important">
                                                <li v-for="a in data.culinaryOpeningHours" class="mt-2">
                                                    {{a.day}}&ensp;{{a.startTime}} - {{ a.endTime }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-lg-12 mb-1" v-if="data?.websiteLink">
                                            <a :href="data?.websiteLink" target="_blank"
                                                style="border: 1px #049C4F  solid;border-radius: 15px;padding:15px;"
                                                class="btn c-primary-custom text-center w-100 fs-15px mt-3">
                                                Information Desk</a>
                                        </div>
                                        <div class="col-lg-12 mb-1" v-if="data?.phoneNumber">
                                            <a :href="`tel:${data?.phoneNumber}`"
                                                style="border-radius: 15px;padding:15px;"
                                                class="btn bg-primary-custom text-white text-center w-100 fs-15px mt-3"><svg
                                                    width="28" height="28" viewBox="0 0 28 28" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M13.7192 25.2333C7.51599 25.2333 2.4873 20.2046 2.4873 14.0014C2.4873 7.79822 7.51599 2.76953 13.7192 2.76953C19.9224 2.76953 24.9511 7.79822 24.9511 14.0014C24.9511 20.2046 19.9224 25.2333 13.7192 25.2333ZM13.2856 15.3639C12.7856 15.8638 12.0218 15.9878 11.3894 15.6716C10.757 15.3554 9.99325 15.4793 9.4933 15.9793L7.79615 17.6764C7.7345 17.7381 7.68805 17.8132 7.66048 17.8959C7.5624 18.1902 7.72142 18.5082 8.01566 18.6063L9.53626 19.1132C10.9965 19.5999 12.6064 19.2199 13.6948 18.1315L18.1867 13.6396C19.1866 12.6397 19.4345 11.1121 18.8021 9.84734L18.0916 8.42635C18.0646 8.37236 18.0291 8.32308 17.9864 8.2804C17.7671 8.06108 17.4115 8.06108 17.1922 8.2804L15.4035 10.0691C14.9035 10.5691 14.7796 11.3329 15.0958 11.9652C15.412 12.5976 15.288 13.3614 14.7881 13.8614L13.2856 15.3639Z"
                                                        fill="white" />
                                                </svg>
                                                &ensp;Hubungi Via Telefon</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div id="map"></div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
                <div class="container mt-5" v-if="listTopDestination.length > 0 && pageStatus != 'page-load'">
                    <div class="row align-items-center">
                        <div class="col-lg-10">
                            <div class="fs-3 fw-bolder">Nearby Destination</div>
                        </div>
                        <div class="col-lg-2 d-flex justify-content-end">
                            <div class="d-flex">
                                <button type="button" class="btn me-2" @click="prevDestinationScroll"
                                    style="padding:5px 3px !important;border:1px #EBEDF3 solid !important;box-shadow:unset !important;"><svg
                                        width="33" height="32" viewBox="0 0 33 32" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M21.4401 22.12L15.3334 16L21.4401 9.88L19.5601 8L11.5601 16L19.5601 24L21.4401 22.12Z"
                                            fill="#5E6278" />
                                    </svg>
                                </button>
                                <button type="button" class="btn" @click="nextDestinationScroll"
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
                    </div>
                </div>
                <div class="px-2 mt-5 mb-5" v-if="listTopDestination.length > 0 && pageStatus != 'page-load'">
                    <div class="slider-destination">
                        <div v-for="a in listTopDestination">
                            <router-link :to="`/destination/${a.id}`">
                                <div class="list-destination"
                                    :style="`background-image:linear-gradient(359.32deg, rgba(0, 0, 0, 0.5) 10%, rgba(0, 0, 0, 0) 99.42%), url('${a.touristDestinationFiles.length > 0 ? a.touristDestinationFiles[0].link : '-'}'), url('${$noImageUrl()}');`">
                                    <div v-if="a.isSuperior" class="recomended"><svg width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M12 17.9999L7.91565 20.1472C7.42681 20.4042 6.82218 20.2163 6.56518 19.7274C6.46284 19.5328 6.42753 19.3098 6.4647 19.0931L7.24475 14.545L3.94042 11.3241C3.54493 10.9386 3.53684 10.3055 3.92234 9.91001C4.07585 9.75252 4.27699 9.65004 4.49463 9.61841L9.06111 8.95486L11.1033 4.81693C11.3477 4.32168 11.9473 4.11834 12.4426 4.36276C12.6398 4.46009 12.7994 4.61972 12.8968 4.81693L14.939 8.95486L19.5054 9.61841C20.052 9.69783 20.4307 10.2053 20.3512 10.7518C20.3196 10.9695 20.2171 11.1706 20.0596 11.3241L16.7553 14.545L17.5354 19.0931C17.6287 19.6374 17.2631 20.1544 16.7188 20.2477C16.502 20.2849 16.2791 20.2496 16.0844 20.1472L12 17.9999Z"
                                                fill="#FFA800" />
                                        </svg>&ensp;
                                        <span>Recommended</span>
                                    </div>
                                    <router-link :to="`/destination/${a.id}`" class="title">
                                        {{$getTitleEventsOrDestination(a.touristDestinationLanguages)}}</router-link>
                                    <router-link :to="`/destination/${a.id}`" class="view-more">
                                        Visit&ensp;<svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M9 3L7.9425 4.0575L12.1275 8.25H3V9.75H12.1275L7.9425 13.9425L9 15L15 9L9 3Z"
                                                fill="white" />
                                        </svg>

                                    </router-link>
                                </div>
                            </router-link>

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
                disabledChangePage: false,
                currentUrl: window.location.href,
                map: null,
                listTopDestination: [],
                surabayaCoordinate: {
                    lat: -7.250445,
                    lng: 112.768845,
                },
                pageStatus: 'page-load',
                mainPreviewImage: null,
                data: null,
            }
        },
        mounted() {
            reinitPluginLandingPage();
            this.getDetail();
        },
        beforeRouteLeave(to, from, next) {
            if (!this.disabledChangePage) {
                next();
            }

        },
        methods: {
            getDetail() {
                this.$axios().get(`web-culinary/${this.$route.params.id}`)
                    .then(response => {
                        this.pageStatus = 'standby';
                        this.data = response.data.data;

                        this.mainPreviewImage = this.data.culinaryFiles.length > 0 ? this.data.culinaryFiles[0]
                            .link : '';
                        this.surabayaCoordinate = {
                            lat: Number(this.data.latitude),
                            lng: Number(this.data.longitude)
                        }
                        setTimeout(() => {
                            this.initMap();

                            this.initSlider();
                        }, 500);

                        setTimeout(() => {
                            this.addMarker({
                                coordinates: {
                                    lat: Number(this.data.latitude),
                                    lng: Number(this.data.longitude)
                                },
                                id: 1,
                            });
                        }, 1000);

                        this.getTopDestination();

                    })
            },
            initSlider() {
                $('.slider-gallery-image').slick({
                    dots: false,
                    infinite: false,
                    arrows: false,
                    speed: 300,
                    slidesToScroll: 2,
                    centerMode: false,
                    variableWidth: true,
                    responsive: [{
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 1
                        }
                    }, ]
                });
            },
            initMap() {

                var options = {
                    zoom: 10,
                    center: this.surabayaCoordinate
                }
                this.map = new google.maps.Map(document.getElementById('map'), options);
            },
            addMarker(prop) {

                let that = this;

                let myLatLng = new google.maps.LatLng(prop.coordinates.lat, prop.coordinates.lng);

                var marker = new google.maps.Marker({
                    position: myLatLng,
                    map: that.map,
                    animation: google.maps.Animation.DROP,
                });

                let name = this.data.name;
                let linkGoogleMaps =
                    `https://www.google.com/maps/dir/?api=1&destination=${prop.coordinates.lat},${prop.coordinates.lng}`
                var information = new google.maps.InfoWindow({
                    content: '<div style="text-align:center;font-weight:600;font-size:14px">' + name +
                        '</div><br><div style="display:flex;justify-content:center"><a style="background:#049C4F;color:#fff;padding:8px 15px;border-radius:10px;font-size:12px;font-weight:500;" href="' +
                        linkGoogleMaps + '" target="_blank">Get Directions</a></div>',
                    maxHeight: 300
                });

                google.maps.event.addListener(marker, 'click', function () {
                    information.open(map, marker);
                    that.map.setZoom(15);
                    that.map.setCenter(marker.getPosition());
                });

                setTimeout(() => {
                    new google.maps.event.trigger(marker, 'click');
                }, 300);
            },
            getTopDestination() {
                let params = {
                    page: 1,
                    limit: 10,
                    latitude: this.data.latitude,
                    longitude: this.data.longitude,
                    sortBy: 'distance',
                    orderBy: 'asc'
                }
                this.$axios().get(`stroll-shop`, {
                        params
                    })
                    .then(response => {

                        this.listTopDestination = response.data.data.data;

                        setTimeout(() => {
                            this.initSliderDestination();
                        }, 300);
                    })
            },
            initSliderDestination() {
                $('.slider-destination').slick({
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
                $('.slider-destination').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
                    that.disabledChangePage = true;
                });
                // On swipe event
                $('.slider-destination').on('swipe', function (event, slick, direction) {
                    that.disabledChangePage = true;
                    setTimeout(() => {
                        that.disabledChangePage = false;
                    }, 1000);
                    // left
                });
            },
            nextDestinationScroll() {
                $('.slider-destination').slick('slickNext');
            },
            prevDestinationScroll() {
                $('.slider-destination').slick('slickPrev');
            }
        }
    }

</script>

<style scoped>
    .breadcrumb-item+.breadcrumb-item::before {
        content: '-' !important;
        color: #B5B5C3 !important;
    }

    .bg-content-custom {
        background-color: #F5F6FA;
    }

    .slider-option-detail-image {
        width: 230px;
        height: 150px;
        object-fit: cover;
        object-position: center;
        border-radius: 10px;
        cursor: pointer;
    }

    .text-right {
        text-align: right;
    }

    @media(max-width:991px) {
        .slider-option-detail-image {
            width: 170px;
            height: 120px;
            object-fit: cover;
            object-position: center;
        }
    }

    #map {
        height: 250px;
        width: 100%;
        border-radius: 10px;
        margin-bottom: 40px;
    }

    @media(max-width:991px) {
        .bg-content-custom {
            background-color: #fff
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


    @media(max-width:480px) {
        .list-destination {
            width: 280px !important;
            height: 380px !important;
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

</style>
