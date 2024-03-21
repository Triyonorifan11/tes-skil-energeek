<template>
    <div>
        <app-landing-page-navbar></app-landing-page-navbar>
        <div class="content bg-content-custom">
            <div class="d-flex justify-content-center align-items-center flex-column p-5" v-if="header.show"
                :style="`background: rgba(0, 0, 0, .3) url('${header.background}')`"
                style="background-size:cover;width:100%;background-position:center;min-height:250px;background-blend-mode:darken">
                <div class="fw-bolder text-white text-center" style="font-size:30px">{{ header.title }}</div>
                <div class="pt-2 text-white text-center" style="font-size:14px">{{header.description}}</div>
            </div>
            <section class="pt-5 pb-5" v-if="showContent">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-1 mb-3">
                            <div class="fw-bolder fs-5">Hotels</div>
                        </div>
                        <div class="col-lg-5 mb-3">
                            <div class="d-flex align-items-center flex-wrap"
                                v-if="single.filter.latitude !== null && single.filter.longtitude !== null">
                                <div class="me-3" style="font-weight:500">Your current location</div>
                                <button type="button" class="btn fs-14px text-white" @click="showModalFilter"
                                    style="background:#0E5CA8;border-radius:5px;">Edit Radius
                                    ({{ single.filter.selectedRadius }}KM)</button>
                            </div>
                        </div>
                        <div class="col-lg-3 mb-3">
                            <app-landing-page-select-single v-model="single.filter.category" @option-open="getCategory" @option-change="currentPage = 1; totalData = 0; getData()"
                                :serverside="false" :loading="pageStatus == 'category-load'"
                                :placeholder="'All Categories'" :options="listCategory"
                                :class="'select-filter-categories'">
                            </app-landing-page-select-single>
                        </div>
                        <div class="col-lg-3 mb-3">
                            <div class="input-group input-group-travel w-100">
                                <input type="text" class="form-control" placeholder="Type"
                                    v-model="single.filter.search"
                                    v-on:keyup.enter="currentPage = 1; totalData = 0; getData()"
                                    style="border-right: 0 !important;border-top-left-radius:12px;border-bottom-left-radius:12px;box-shadow:unset !important">
                                <span class="input-group-text"
                                    style="background: #fff;border-top-right-radius:12px;border-bottom-right-radius:12px;padding:2px !important">
                                    <button type="button" style="background-color: #E8FFF3;font-weight: 500;"
                                        @click="currentPage = 1; totalData = 0; getData()"
                                        class="btn fs-15px c-primary-custom px-3 py-2 btn-filter-destination rounded-patern">Search</button>
                                </span>

                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <template v-if="pageStatus == 'page-load'">
                                <div class="d-flex justify-content-center mt-5 mb-5">
                                    <app-loader></app-loader>
                                </div>

                            </template>
                            <template v-else>
                                <div class="row">
                                    <div class="col-lg-12 mb-5 mt-5 text-center" v-if="listData.length == 0">
                                        Tidak Ada Data
                                    </div>
                                    <div class="col-lg-6 col-md-12 mb-3" v-for="a in listData">

                                        <div class="bg-white p-3" style="border:1px #E4E6EF solid;border-radius:10px;">
                                            <div class="d-flex">
                                                <div>
                                                    <img :src="a.hotelThumbnail?.link ?? '-'" @error="$setNoImageUrl" class="thumbnail-hotel" />
                                                </div>
                                                <div class="px-3 w-100">
                                                    <div class="title-hotel">{{ a.name }}</div>
                                                    <div class="d-flex mt-2 align-items-center">
                                                        <div style="width:15px;">
                                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M8.00001 1C6.54184 1.00172 5.1439 1.58174 4.11282 2.61281C3.08174 3.64389 2.50173 5.04184 2.50001 6.5C2.49826 7.69161 2.8875 8.85089 3.60801 9.8C3.60801 9.8 3.75801 9.9975 3.78251 10.026L8.00001 15L12.2195 10.0235C12.2415 9.997 12.392 9.8 12.392 9.8L12.3925 9.7985C13.1127 8.84981 13.5017 7.69107 13.5 6.5C13.4983 5.04184 12.9183 3.64389 11.8872 2.61281C10.8561 1.58174 9.45817 1.00172 8.00001 1ZM8.00001 8.5C7.60444 8.5 7.21776 8.3827 6.88886 8.16294C6.55997 7.94318 6.30362 7.63082 6.15225 7.26537C6.00087 6.89991 5.96126 6.49778 6.03843 6.10982C6.11561 5.72186 6.30609 5.36549 6.58579 5.08579C6.8655 4.80608 7.22186 4.6156 7.60982 4.53843C7.99779 4.46126 8.39992 4.50087 8.76537 4.65224C9.13082 4.80362 9.44318 5.05996 9.66294 5.38886C9.88271 5.71776 10 6.10444 10 6.5C9.99934 7.03023 9.78842 7.53855 9.41349 7.91348C9.03856 8.28841 8.53024 8.49934 8.00001 8.5Z"
                                                                    fill="black" />
                                                            </svg>
                                                        </div>
                                                        <div class="address-hotel">{{ a.address }}</div>
                                                    </div>
                                                    <div class="d-flex align-items-center flex-wrap mt-2">
                                                        <div class="p-2 text-star-hotel me-2"
                                                            style="color:#3F4254;background-color: #FFF8DD;">
                                                            Bintang {{a.hotelCategory.starNumber}}
                                                        </div>
                                                        <div class="d-flex align-items-center flex-wrap">
                                                            <div v-for="a in parseInt(a.hotelCategory.starNumber ?? 0)"
                                                                class="me-1 mb-1">
                                                                <svg width="25" height="24" viewBox="0 0 25 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M12.5 17.77L18.68 21.5L17.04 14.47L22.5 9.74L15.31 9.13L12.5 2.5L9.69 9.13L2.5 9.74L7.96 14.47L6.32 21.5L12.5 17.77Z"
                                                                        fill="#FFA800" />
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="description-hotel">{{ a.description }}</div>
                                                    <div class=" mt-3 w-100">
                                                        <router-link :to="`/hotel/${a.id}`">
                                                            <div class="w-100 px-3 py-2 text-white fs-14px text-center more-hotel"
                                                                style="background:#049C4F  !important;border-radius:100px">
                                                                Selengkapnya</div>
                                                        </router-link>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="d-flex justify-content-center mt-5">
                                    <app-landing-page-pagination @change-page="getData" :total_data="totalData"
                                        :limit="12" v-model:current_page="currentPage" :loading="false">
                                    </app-landing-page-pagination>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <app-landing-page-footer></app-landing-page-footer>
        <div class="modal fade" id="modal-filter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Set Radius</h5>
                        <button type="button" class="close" style="border:0 !important;background:#fff !important;"
                            data-bs-dismiss="modal" aria-label="Close">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M17.8799 15.9996L23.6132 10.2796C23.8643 10.0285 24.0054 9.688 24.0054 9.33293C24.0054 8.97786 23.8643 8.63733 23.6132 8.38626C23.3622 8.13519 23.0217 7.99414 22.6666 7.99414C22.3115 7.99414 21.971 8.13519 21.7199 8.38626L15.9999 14.1196L10.2799 8.38626C10.0288 8.13519 9.68832 7.99414 9.33325 7.99414C8.97818 7.99414 8.63766 8.13519 8.38659 8.38626C8.13551 8.63733 7.99446 8.97786 7.99446 9.33293C7.99446 9.688 8.13551 10.0285 8.38659 10.2796L14.1199 15.9996L8.38659 21.7196C8.26161 21.8435 8.16242 21.991 8.09473 22.1535C8.02704 22.316 7.99219 22.4902 7.99219 22.6663C7.99219 22.8423 8.02704 23.0166 8.09473 23.179C8.16242 23.3415 8.26161 23.489 8.38659 23.6129C8.51054 23.7379 8.658 23.8371 8.82048 23.9048C8.98296 23.9725 9.15724 24.0073 9.33325 24.0073C9.50927 24.0073 9.68354 23.9725 9.84602 23.9048C10.0085 23.8371 10.156 23.7379 10.2799 23.6129L15.9999 17.8796L21.7199 23.6129C21.8439 23.7379 21.9913 23.8371 22.1538 23.9048C22.3163 23.9725 22.4906 24.0073 22.6666 24.0073C22.8426 24.0073 23.0169 23.9725 23.1794 23.9048C23.3418 23.8371 23.4893 23.7379 23.6132 23.6129C23.7382 23.489 23.8374 23.3415 23.9051 23.179C23.9728 23.0166 24.0076 22.8423 24.0076 22.6663C24.0076 22.4902 23.9728 22.316 23.9051 22.1535C23.8374 21.991 23.7382 21.8435 23.6132 21.7196L17.8799 15.9996Z"
                                    fill="black" />
                            </svg>

                        </button>
                    </div>
                    <div class="modal-body" style="padding:0 !important;">
                        <div id="map"></div>
                    </div>
                    <div class="modal-footer">
                        <div class="d-flex justify-content-between w-100 align-items-center flex-wrap">
                            <div class="text-left" style="width:200px">
                                <div class="text-gray-600 pb-1" style="font-size:14px;">RADIUS
                                    ({{ single.filter.radius }}KM)</div>
                                <input type="range" class="form-range custom-range" min="1" @change="changeRadius"
                                    v-model="single.filter.radius" max="100" id="customRange2">
                                <div class="d-flex justify-content-between" style="font-size:14px;">
                                    <div>1KM</div>
                                    <div>100KM</div>
                                </div>
                            </div>
                            <div class="d-flex">
                                <button type="button" class="btn fs-15px me-3"
                                    style="background-color: #E4E6EF;border-radius:10px;"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn text-white bg-primary-custom fs-15px"
                                    @click="filterRadius()" style="border-radius:10px;">Select</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                pageStatus: 'standby',
                showContent: false,
                header: {
                    show: false,
                    background: '',
                    title: '',
                    description: ''
                },
                currentPage: 1,
                listCategory: [],
                listData: [],
                totalData: 0,
                circleMap: null,
                map: null,
                marker: null,
                showFilter: false,
                single: {
                    filter: {
                        category: {},
                        search: '',
                        latitude: null,
                        longtitude: null,
                        radius: 20,
                        selectedRadius: 20,
                    }
                }
            }
        },
        mounted() {
            reinitPluginLandingPage();
            this.$axios().get(`menu-header-web?headerType=hotel`)
                .then(response => {
                    this.header.show = true;
                    this.header.background = response.data.data.menuHeaderFile ? response.data.data.menuHeaderFile
                        .link : '';
                    this.header.title = response.data.data.heading;
                    this.header.description = response.data.data.description;
                })
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(this.successCallback, this.errorCallback);
            } else {
                this.showContent = true;
                this.getData();
            }
        },
        methods: {
            successCallback(position) {

                this.single.filter.latitude = Number(position.coords.latitude);
                this.single.filter.longtitude = Number(position.coords.longitude);

                this.initMap();

                this.showContent = true;
                this.getData();
            },

            errorCallback(error) {
                this.showContent = true;
                this.getData();
            },
            getData() {
                this.pageStatus = 'page-load';
                let params = {
                    search: this.single.filter.search,
                    page: this.currentPage,
                    limit: 12,
                }

                if (this.single.filter.category.id) {
                    params.categoryId = this.single.filter.category.id;
                }

                if (this.single.filter.latitude !== null && this.single.filter.longtitude !== null) {
                    params.latitude = this.single.filter.latitude;
                    params.longitude = this.single.filter.longtitude;
                    params.radius = this.single.filter.selectedRadius;
                    params.sortBy = this.single.filter.category.id ? 'name' : 'distance';
                    params.orderBy = 'asc';
                }
                this.$axios().get(`accomodation/hotel`, {
                        params
                    })
                    .then(response => {
                        this.pageStatus = 'standby';
                        this.totalData = response.data.data.total;

                        this.listData = response.data.data.data;
                    })
            },
            getCategory() {

                this.pageStatus = 'category-load';
                this.$axios().get(`select-list/hotel-category`)
                    .then(response => {
                        this.listCategory = [];
                        for (let i = 0; i < response.data.data.length; i++) {
                            this.listCategory.push({
                                id: response.data.data[i].id,
                                text: 'Bintang ' + response.data.data[i].starNumber
                            })
                        }
                        this.pageStatus = 'standby';
                    })
                    .catch(error => {
                        this.pageStatus = 'standby';
                    });
            },
            initMap() {
                var options = {
                    zoom: 10,
                    center: {
                        lat: this.single.filter.latitude,
                        lng: this.single.filter.longtitude
                    }
                }
                this.map = new google.maps.Map(document.getElementById('map'), options);

                let latLng = new google.maps.LatLng(this.single.filter.latitude, this.single.filter.longtitude)

                this.marker = new google.maps.Marker({
                    map: this.map,
                    position: latLng,
                    draggable: false,
                });

                const that = this;


                this.circleMap = new google.maps.Circle({
                    map: this.map,
                    center: latLng,
                    radius: parseInt(that.single.filter.radius) * 1000,
                    editable: true,
                    strokeColor: '#049C4F',
                    strokeOpacity: 1,
                    strokeWeight: 2,
                    fillColor: '#049C4F',
                    fillOpacity: 0.2
                });
            },
            changeRadius() {
                this.circleMap.setRadius(Number(this.single.filter.radius) * 1000);
            },
            filterRadius() {
                this.currentPage = 1;
                this.totalData = 0;
                this.listData = [];

                this.single.filter.selectedRadius = this.single.filter.radius;
                this.getData();
                $(".modal").modal('hide');
            },
            showModalFilter() {
                $("#modal-filter").modal('show');
            }
        }
    }

</script>

<style scoped>
    .bg-content-custom {
        background-color: #F5F6FA;
    }

    .filter-grid-item {
        position: sticky;
        top: 120px;
        margin-top: 15px;
    }

    #map {
        height: 400px;
        width: 100%;
        border-radius: 10px;
        margin-bottom: 40px;
    }

    .btn-show-filter-destination {
        display: none !important;
    }

    @media(max-width:991px) {
        .bg-content-custom {
            background-color: #fff
        }

        .input-group-travel {
            border: 1px solid #ced4da !important;
            display: block;
            padding: 10px;
        }

        .input-group-travel .form-control {
            width: 100%;
            border-radius: 12px !important;
            border: 0 !important;
            border-radius: 0 !important;
        }

        .input-group-travel .input-group-text {
            border: 0 !important;
            background-color: transparent !important;
            display: block;
        }

        .input-group-travel .input-group-text button {
            width: 100%;
            margin-top: 10px;
        }

        .btn-filter-destination {
            background-color: #049C4F !important;
            color: #fff !important;
        }

        .btn-show-filter-destination {
            display: block !important;
            border: 1px #049C4F solid !important;
            border-radius: 10px;
            color: #049C4F;
            width: 100%
        }

        .hide-filter-mobile {
            display: none !important;
        }
    }

    .custom-range::-webkit-slider-thumb {
        background: #049C4F;
    }

    .custom-range::-moz-range-thumb {
        background: #049C4F;
    }

    .custom-range::-ms-thumb {
        background: #049C4F;
    }

    .thumbnail-hotel {
        width: 170px;
        height: 240px;
        object-position: center;
        object-fit: cover;
        border-radius: 10px;
    }


    .title-hotel {
        font-size: 20px;
        font-weight: 600;
    }

    .address-hotel {
        padding-left: 10px;
        color: #7E8299;
        word-break: break-word;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
        font-size: 15px;
    }

    .description-hotel {
        color: #7E8299;
        word-break: break-word;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        margin-top: 5px;
        -webkit-box-orient: vertical;
        overflow: hidden;
        font-size: 15px;
    }
    .text-star-hotel{
        font-size: 13px;
    }

    @media(max-width:991px) {
        .thumbnail-hotel {
            width: 100px;
            height: 150px;
        }

        .title-hotel {
            font-size: 15px;
        }

        .address-hotel {
            font-size: 12px;
        }

        .description-hotel {
            font-size: 12px;
        }
        .text-star-hotel{
            font-size: 12px;
        }
        .more-hotel{
            font-size: 12px !important;
        }
    }
    @media(max-width:991px){
        .filter-grid-item{
            position: static !important;
        }
    }
</style>
