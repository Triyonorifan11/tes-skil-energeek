<template>
    <div>
        <app-landing-page-navbar></app-landing-page-navbar>
        <div class="content">
            <section>
                <div class="container">
                    <template v-if="showContent">
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
                    </template>
                    <template v-else>
                        <div class="d-flex justify-content-center mt-5 mb-5">
                            <app-loader></app-loader>
                        </div>
                    </template>

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

            this.checkPosition();
        },
        methods: {
            checkPosition() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(this.successCallback, this.errorCallback);
                } else {
                    this.showContent = true;
                    this.getData();
                }
            },
            getRadius() {

                let that = this;
                this.$axios().get(`select-list/radius?limit=1`)
                    .then(res => {
                        if (res.data.data && res.data.data.radius) {
                            this.surabayaCoordinate.radius = res.data.data.radius;
                        }
                    })
                    .catch(err => {
                        this.$axiosHandleError(err);
                    })
                    .then(() => {
                        setTimeout(() => {
                            this.showContent = true;
                            this.getData()
                        }, 500);
                    });


            },
            successCallback(position) {

                this.surabayaCoordinate.lat = Number(position.coords.latitude);
                this.surabayaCoordinate.lng = Number(position.coords.longitude);

                this.hasCoordinate = true;

                this.getRadius();
            },

            errorCallback(error) {
                this.showContent = true;
                this.getData();
            },

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
                    zoom: this.hasCoordinate ? 16 : 12,
                    center: this.surabayaCoordinate
                }
                this.map = new google.maps.Map(document.getElementById('map'), options);


                if (this.hasCoordinate) {
                    let latLng = new google.maps.LatLng(this.surabayaCoordinate.lat, this.surabayaCoordinate.lng)

                    this.marker = new google.maps.Marker({
                        map: this.map,
                        position: latLng,
                        draggable: false,
                    });

                    const that = this;

                    if (this.surabayaCoordinate.radius !== null) {
                        this.circleMap = new google.maps.Circle({
                            map: this.map,
                            center: latLng,
                            radius: Number(that.surabayaCoordinate.radius) * 1000,
                            editable: true,
                            strokeColor: '#049C4F',
                            strokeOpacity: 1,
                            strokeWeight: 2,
                            fillColor: '#049C4F',
                            fillOpacity: 0.2
                        });
                    }

                }



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
