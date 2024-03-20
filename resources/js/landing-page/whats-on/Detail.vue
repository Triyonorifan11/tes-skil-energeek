<template>
    <div>
        <app-landing-page-navbar></app-landing-page-navbar>
        <div class="content bg-content-custom pb-5">
            <section class="pt-5">
                <div class="container">
                    <div class="d-flex flex-wrap align-items-center">
                        <div style="font-weight:500">Detail Event</div>
                        <div class="mx-3" style="color:#B5B5C3">|</div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb" style="font-size:14px;margin-bottom: 0 !important;">
                                <li class="breadcrumb-item" style="color:#B5B5C3 !important">
                                    <router-link to="/">Home</router-link>
                                </li>
                                <li class="breadcrumb-item" style="color:#B5B5C3 !important">
                                    <router-link to="/whats-on">Events</router-link>
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
                        <div class="fs-3 pt-3 fw-bolder pb-3" style="color:#3F4254">
                            {{ $getTitleEventsOrDestination(data.eventLanguages) }}
                        </div>
                        <div class="d-flex flex-wrap align-items-center">
                            <div style="color:#7E8299;" class="d-flex flex-wrap align-items-center">
                                <div class="mb-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M19 4H18V2H16V4H8V2H6V4H5C3.89 4 3.01 4.9 3.01 6L3 20C3 21.1 3.89 22 5 22H19C20.1 22 21 21.1 21 20V6C21 4.9 20.1 4 19 4ZM19 20H5V10H19V20ZM19 8H5V6H19V8ZM12 13H17V18H12V13Z"
                                            fill="#7E8299" />
                                    </svg>&ensp;
                                    {{ $moment(data.startDate).locale('id').format('DD MMMM YYYY  HH:mm') }} -
                                    {{ $moment(data.endDate).locale('id').format('DD MMMM YYYY  HH:mm') }}
                                </div><span style="background:#F1416C;color:#fff;border-radius: 10px;"
                                    class="px-3 py-1 ms-3 mb-2" v-if="countDownEvent">{{ countDownEvent }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-7 mt-3">
                                <div class="d-flex justify-content-center"><img :src="`${mainPreviewImage}`"
                                        @error="$setNoImageUrl" class="mb-3"
                                        style="max-width:100%;object-fit:cover;object-position:center;">
                                </div>
                                <div class="slider-gallery-image">
                                    <img :src="`${a.link}`" v-for="a in data.eventFiles" @error="$setNoImageUrl"
                                        @click="mainPreviewImage = a.link" class="me-3 slider-option-detail-image">
                                </div>
                                <br><br><br>
                            </div>
                            <div class="col-lg-5 mt-3">

                                <div class="bg-white p-3 rounded-patern">
                                    <div class="d-flex flex-wrap mt-3">
                                        <router-link :to="`/whats-on?id=${a.id}&name=${a.name}`" class="p-2 me-2 mb-2"
                                            v-for="a in data.eventCategories"
                                            style="background:#E8FFF3;color:#049C4F;border-radius:5px">{{a.name}}
                                        </router-link>
                                    </div>
                                    <div style="color:#3F4254;line-height: 1.5;" class="fs-15px pt-3 pb-3">
                                        {{ $getDescriptionEventsOrDestination(data?.eventLanguages) }}</div>
                                    <div style="background-color: #F3F6F9;" class="p-3 rounded-patern mt-3">
                                        <div class="bg-white rounded-patern p-3">
                                            <div class="row">
                                                <div class="col-lg-4 fs-14px my-2">Alamat</div>
                                                <div class="col-lg-8 fs-14px my-2" style="font-weight: 500;">
                                                    {{data.address}}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-lg-12 mb-1 mt-2" v-if="data?.websiteLink">
                                            <a :href="data?.websiteLink" target="_blank"
                                                style="border: 1px #049C4F  solid;border-radius: 15px;padding:15px;"
                                                class="btn c-primary-custom text-center w-100 fs-15px mt-3">
                                                Information Desk</a>
                                        </div>
                                        <div class="col-lg-12 mb-1 mt-2">
                                            <router-link to="/hotel" style="border-radius: 15px;padding:15px;"
                                                class="btn bg-primary-custom text-white text-center w-100 fs-15px mt-3">
                                                <svg width="28" height="28" viewBox="0 0 28 28" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M5.23173 25.2349H2.98535C2.98535 22.1333 5.49969 20.7422 8.60129 20.7422H19.8332C22.9348 20.7422 25.4491 22.1333 25.4491 25.2349H23.2027C23.2027 23.374 21.6941 22.9886 19.8332 22.9886H8.60129C6.74033 22.9886 5.23173 23.374 5.23173 25.2349Z"
                                                        fill="white" />
                                                    <path
                                                        d="M25.4497 16.249H2.98598C2.36566 16.249 1.86279 16.7519 1.86279 17.3722V21.865C1.86279 22.4853 2.36566 22.9882 2.98598 22.9882H25.4497C26.0701 22.9882 26.5729 22.4853 26.5729 21.865V17.3722C26.5729 16.7519 26.0701 16.249 25.4497 16.249Z"
                                                        fill="white" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M15.3408 15.126H13.0944V14.0028C13.0944 13.3825 12.5915 12.8796 11.9712 12.8796H7.47845C6.85813 12.8796 6.35526 13.3825 6.35526 14.0028V15.126H5.23208C4.61176 15.126 4.10889 14.6231 4.10889 14.0028V9.51005C4.10889 8.26941 5.11462 7.26367 6.35526 7.26367H22.0799C23.3205 7.26367 24.3263 8.26941 24.3263 9.51005V14.0028C24.3263 14.6231 23.8234 15.126 23.2031 15.126H22.0799V14.0028C22.0799 13.3825 21.577 12.8796 20.9567 12.8796H16.464C15.8436 12.8796 15.3408 13.3825 15.3408 14.0028V15.126Z"
                                                        fill="white" />
                                                </svg>

                                                &ensp;Find Accomodation</router-link>
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
            </section>

        </div>
        <app-landing-page-footer></app-landing-page-footer>
    </div>
</template>
<script>
    import moment from 'moment/min/moment-with-locales';

    export default {
        data() {
            return {
                countDownEvent: '',
                disabledChangePage: false,
                countDownInterval: null,
                map: null,
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
            this.getDetailEvent();
            this.countDownInterval = setInterval(() => {
                this.reinitCountDownEvent();
            }, 1000)

        },
        beforeRouteLeave(to, from, next) {
            if (!this.disabledChangePage) {
                next();
            }

            if (this.countDownInterval) {
                clearInterval(this.countDownInterval);
            }

        },
        methods: {
            reinitCountDownEvent() {
                if (this.data) {
                    const availableDate = this.$moment(this.data.startDate);
                    const endDate = this.$moment(this.data.endDate);

                    const currentDate = this.$moment().format();
                    const diffTime = availableDate.diff(currentDate, 'seconds');

                    const diffEndTime = endDate.diff(currentDate);
                    if (diffEndTime < 0) {
                        this.countDownEvent = 'Sudah Berakhir';
                    } else {
                        if (diffTime < 0) {
                            this.countDownEvent = 'Sedang Berlangsung'
                        } else {
                            let duration = moment.duration(diffTime * 1000, 'milliseconds');

                            const hours = duration.hours() < 10 ? '0' + duration.hours() + ' Hours' : duration
                                .hours() + ' Hours';

                            const days = parseInt(duration.asDays()) < 10 ? '0' + parseInt(duration.asDays()) + ' Day' :
                                parseInt(duration
                                    .asDays()) + ' Day';
                            const minutes = duration.minutes() < 10 ? '0' + duration.minutes() + ' Minutes' : duration
                                .minutes() + ' Minutes';
                            const seconds = duration.seconds() < 10 ? '0' + duration.seconds() + ' Second' : duration
                                .seconds() + ' Second';

                            this.countDownEvent = days + ' : ' + hours + ' : ' + minutes + ' : ' + seconds
                        }
                    }

                }

            },
            getDetailEvent() {
                this.$axios().get(`whats-on/${this.$route.params.id}`)
                    .then(response => {
                        this.pageStatus = 'standby';
                        this.data = response.data.data;

                        this.mainPreviewImage = this.data.eventFiles.length > 0 ? this.data.eventFiles[0].link : '';
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

                let name = this.$getTitleEventsOrDestination(this.data.eventLanguages)
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
