<template>
    <div>
        <app-landing-page-navbar></app-landing-page-navbar>
        <div class="content">
            <section>
                <div class="container">

                    <h4 class="fw-bold text-center pt-5 pb-3">Map</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-flex flex-wrap justify-content-center filter-map-list">
                                <div class="c-pointer mx-4 list" @click="flag = 'destination'"
                                    :class="flag == 'destination' ? 'text-black fw-semibolder' : 'text-gray-500'">
                                    Destination</div>
                                <div class="c-pointer mx-4 list" @click="flag = 'event'"
                                    :class="flag == 'event' ? 'text-black fw-semibolder' : 'text-gray-500'">Event
                                </div>
                                <div class="mx-4 list c-pointer" @click="flag = 'hotel'"
                                    :class="flag == 'hotel' ? 'text-black fw-semibolder' : 'text-gray-500'">Hotel
                                </div>
                                <div class="mx-4 list c-pointer" @click="flag = 'culinary'"
                                    :class="flag == 'culinary' ? 'text-black fw-semibolder' : 'text-gray-500'">
                                    Culinary
                                </div>
                            </div>
                        </div>
                        <template v-if="pageStatus == 'page-load'">
                            <div class="d-flex col-lg-12 justify-content-center mt-5 mb-5">
                                <app-loader></app-loader>
                            </div>

                        </template>
                        <template v-else>
                            <div class="mb-3 col-lg-12 w-100 mt-5">
                                <div id="map"></div>
                            </div>
                        </template>
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
                pageStatus: 'standby',
                flag: 'destination',
                map: null,
                radius: 0,
                showContent: false,
                hasCoordinate: false,
                surabayaCoordinate: {
                    lat: -7.2702354,
                    lng: 112.7327132,
                    radius: null,
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
            this.getData()
        },
        methods: {
            getData() {
                this.pageStatus = 'page-load';

                let params = {
                    type: this.flag,
                }

                if (this.hasCoordinate && this.surabayaCoordinate.radius !== null) {
                    params.radius = this.surabayaCoordinate.radius;
                    params.latitude = this.surabayaCoordinate.lat;
                    params.longitude = this.surabayaCoordinate.lng;
                }

                this.$axios().get(`travel-kit/map`, {
                        params
                    })
                    .then(response => {
                        this.pageStatus = 'standby';

                        let pinPoint = '';
                        if (params.type == 'destination') {
                            pinPoint = this.$assetUrl() + 'assets/images/sample/icon-marker-destination.png';
                        } else if (params.type == 'event') {
                            pinPoint = this.$assetUrl() + 'assets/images/sample/icon-marker-event.png';
                        } else if (params.type == 'hotel') {
                            pinPoint = this.$assetUrl() + 'assets/images/sample/icon-marker-hotel.png';
                        } else if (params.type == 'culinary') {
                            pinPoint = this.$assetUrl() + 'assets/images/sample/icon-marker-culinary.png';
                        }
                        setTimeout(() => {
                            this.initMap();
                        }, 500);

                        setTimeout(() => {
                            let pinPointCurrentLocation = this.$assetUrl() +
                                'assets/images/sample/icon-current-location.png';
                            if (this.userCoordinate) {
                                this.addMarker({
                                    coordinates: {
                                        lat: Number(this.userCoordinate.lat),
                                        lng: Number(this.userCoordinate.lng)
                                    },
                                    id: 9999999,
                                    iconImage: pinPointCurrentLocation,
                                    url: null
                                });
                            }
                            if (params.type == 'destination') {
                                for (let i = 0; i < response.data.data.length; i++) {
                                    this.addMarker({
                                        name: this.$getTitleEventsOrDestination(response.data.data[
                                            i].touristDestinationLanguages),
                                        coordinates: {
                                            lat: Number(response.data.data[i].latitude),
                                            lng: Number(response.data.data[i].longitude)
                                        },
                                        id: response.data.data[i].id,
                                        iconImage: pinPoint,
                                        url: baseUrl + '/destination/' + response.data.data[i].id
                                    });
                                }
                            }

                            if (params.type == 'event') {
                                for (let i = 0; i < response.data.data.length; i++) {
                                    this.addMarker({
                                        name: this.$getTitleEventsOrDestination(response.data.data[
                                            i].eventLanguages),
                                        coordinates: {
                                            lat: Number(response.data.data[i].latitude),
                                            lng: Number(response.data.data[i].longitude)
                                        },
                                        id: response.data.data[i].id,
                                        iconImage: pinPoint,
                                        url: baseUrl + '/whats-on/' + response.data.data[i].id
                                    });
                                }
                            }

                            if (params.type == 'hotel') {
                                for (let i = 0; i < response.data.data.length; i++) {
                                    this.addMarker({
                                        name: response.data.data[i].name,
                                        coordinates: {
                                            lat: Number(response.data.data[i].latitude),
                                            lng: Number(response.data.data[i].longitude)
                                        },
                                        id: response.data.data[i].id,
                                        iconImage: pinPoint,
                                        url: baseUrl + '/hotel/' + response.data.data[i].id
                                    });
                                }
                            }

                            if (params.type == 'culinary') {
                                for (let i = 0; i < response.data.data.length; i++) {
                                    this.addMarker({
                                        name: response.data.data[i].name,
                                        coordinates: {
                                            lat: Number(response.data.data[i].latitude),
                                            lng: Number(response.data.data[i].longitude)
                                        },
                                        id: response.data.data[i].id,
                                        iconImage: pinPoint,
                                        url: baseUrl + '/cullnary/' + response.data.data[i].id
                                    });
                                }
                            }
                        }, 1000);
                    })
            },

            initMap() {

                var options = {
                    zoom: 12,
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

                if (prop.iconImage) {
                    marker.setIcon(prop.iconImage);
                }

                let name = prop.name;
                var information = new google.maps.InfoWindow({
                    content: '<div style="font-weight:600;font-size:14px">' + name +
                        '</div><br><br><a style="color:#049C4F !important;font-weight:600 !important;" target="_blank" href="' +
                        prop.url + '">Baca Selengkapnya</a>',
                    maxHeight: 300
                });

                google.maps.event.addListener(marker, 'click', function () {
                    if (prop.url) {
                        that.map.setZoom(15);
                        that.map.setCenter(marker.getPosition());
                        information.open(map, marker);
                    }
                });
            },
        }
    }

</script>

<style scoped>
    #map {
        height: 600px;
        width: 100%;
        border-radius: 10px;
        margin-bottom: 40px;
    }

</style>
