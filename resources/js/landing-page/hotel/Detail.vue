<template>
    <div>
        <app-landing-page-navbar></app-landing-page-navbar>
        <div class="content bg-content-custom pb-5">
            <section class="pt-5">
                <div class="container">
                    <div class="d-flex flex-wrap align-items-center">
                        <div style="font-weight:500">Detail Hotel</div>
                        <div class="mx-3" style="color:#B5B5C3">|</div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb" style="font-size:14px;margin-bottom: 0 !important;">
                                <li class="breadcrumb-item" style="color:#B5B5C3 !important">
                                    <router-link to="/">Home</router-link>
                                </li>
                                <li class="breadcrumb-item" style="color:#B5B5C3 !important">
                                    <router-link to="/hotel">Hotel</router-link>
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
                        <div class="fw-bolder fs-3 pt-3">{{data.name}}</div>
                        <div class="row">
                            <div class="col-lg-7 mt-3">
                                <div class="d-flex justify-content-center w-100"><img :src="`${mainPreviewImage}`" @error="$setNoImageUrl"
                                        class="mb-3" style="max-width:100%;object-fit:cover;object-position:center;">
                                </div>
                                <div class="slider-gallery-image">
                                    <img :src="`${a.link}`" @error="$setNoImageUrl" v-for="a in data.hotelFiles"
                                        @click="mainPreviewImage = a.link" class="me-3 slider-option-detail-image">
                                </div>
                            </div>
                            <div class="col-lg-5 mt-3">
                                <div class="bg-white p-3 rounded-patern">
                                    <div class="d-flex align-items-center mt-3 flex-wrap">
                                        <div class="p-2 fs-15px me-3" style="color:#3F4254;background-color: #FFF8DD;">
                                            Bintang {{data.hotelCategory.starNumber}}
                                        </div>
                                        <div class="d-flex align-items-center flex-wrap">
                                            <div v-for="a in parseInt(data.hotelCategory.starNumber ?? 0)" class="me-1 mb-1">
                                                <svg width="25" height="24" viewBox="0 0 25 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M12.5 17.77L18.68 21.5L17.04 14.47L22.5 9.74L15.31 9.13L12.5 2.5L9.69 9.13L2.5 9.74L7.96 14.47L6.32 21.5L12.5 17.77Z"
                                                        fill="#FFA800" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-gray-600 pt-3 pb-3">
                                            {{ data.description }}
                                        </div>
                                    <div style="background-color: #F3F6F9;" class="p-3 rounded-patern mt-3">
                                        <div class="bg-white rounded-patern p-3">
                                            <div class="row">
                                                <div class="col-lg-4 my-1 fs-14px">Alamat</div>
                                                <div class="col-lg-8 my-1 fs-14px fw-bolder text-left"
                                                    style="color:#0E5CA8">{{data.address}}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-lg-12 mb-1" v-if="data?.websiteLink">
                                            <a :href="data.websiteLink" target="_blank"
                                                style="border: 1px #049C4F  solid;border-radius: 15px;padding:15px;"
                                                class="btn c-primary-custom text-center w-100 fs-15px mt-3">
                                                Information Desk</a>
                                        </div>
                                        <div class="col-lg-12 mb-1" v-if="data?.phoneNumber">
                                            <a :href="`tel:${data.phoneNumber}`"
                                                style="border-radius: 15px;padding:15px;"
                                                class="btn bg-primary-custom text-white text-center w-100 fs-15px mt-3"><svg
                                                    width="28" height="28" viewBox="0 0 28 28" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M13.7192 25.2333C7.51599 25.2333 2.4873 20.2046 2.4873 14.0014C2.4873 7.79822 7.51599 2.76953 13.7192 2.76953C19.9224 2.76953 24.9511 7.79822 24.9511 14.0014C24.9511 20.2046 19.9224 25.2333 13.7192 25.2333ZM13.2856 15.3639C12.7856 15.8638 12.0218 15.9878 11.3894 15.6716C10.757 15.3554 9.99325 15.4793 9.4933 15.9793L7.79615 17.6764C7.7345 17.7381 7.68805 17.8132 7.66048 17.8959C7.5624 18.1902 7.72142 18.5082 8.01566 18.6063L9.53626 19.1132C10.9965 19.5999 12.6064 19.2199 13.6948 18.1315L18.1867 13.6396C19.1866 12.6397 19.4345 11.1121 18.8021 9.84734L18.0916 8.42635C18.0646 8.37236 18.0291 8.32308 17.9864 8.2804C17.7671 8.06108 17.4115 8.06108 17.1922 8.2804L15.4035 10.0691C14.9035 10.5691 14.7796 11.3329 15.0958 11.9652C15.412 12.5976 15.288 13.3614 14.7881 13.8614L13.2856 15.3639Z"
                                                        fill="white" />
                                                </svg>
                                                &ensp;Hubungi
                                                Via Telefon</a>
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
                this.$axios().get(`accomodation/hotel/${this.$route.params.id}`)
                    .then(response => {
                        this.pageStatus = 'standby';
                        this.data = response.data.data;

                        this.mainPreviewImage = this.data.hotelFiles.length > 0 ? this.data.hotelFiles[0]
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
