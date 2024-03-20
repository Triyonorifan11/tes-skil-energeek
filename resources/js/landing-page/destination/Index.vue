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
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="fw-bolder fs-5">Destinations</div>
                        </div>
                        <div class="col-lg-9">
                            <div class="row align-items-center">
                                <div class="col-lg-7 mb-3">
                                    <div class="d-flex align-items-center"
                                        v-if="single.filter.latitude !== null && single.filter.longtitude !== null">
                                        <div class="me-3" style="font-weight:500">Your current location</div>
                                        <button type="button" class="btn fs-14px text-white" @click="showModalFilter"
                                            style="background:#0E5CA8;border-radius:5px;">Edit Radius
                                            ({{ single.filter.selectedRadius }}KM)</button>
                                    </div>
                                </div>
                                <div class="col-lg-5 mb-3">
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
                                            <button type="button" @click="showFilter = !showFilter"
                                                class="btn fs-14px btn-show-filter-destination">{{ showFilter ? 'Tutup Filter' : 'Filter' }}</button>
                                        </span>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="bg-white w-100 p-3 filter-grid-item mb-3"
                                :class="showFilter ? '' : 'hide-filter-mobile'"
                                style="border-radius:10px;border: 1px solid #E4E6EF;">
                                <div style="font-size:12px;font-weight:500;" class="pb-1 text-gray-500">CATEGORY
                                </div>
                                <app-landing-page-select-single v-model="single.filter.category"
                                    @change-search="getCategory" @option-change="getData(true)" :serverside="true"
                                    :loading="pageStatus == 'category-load'" :placeholder="'All Categories'"
                                    :options="listCategory" :class="'select-filter-categories'">
                                </app-landing-page-select-single>
                                <div class="d-flex mt-3 justify-content-center">
                                    <!-- <button type="button" class="btn fs-14px"
                                        @click="currentPage = 1; totalData = 0;single.filter.selectedCategoryId = single.filter.category.id; getData()"
                                        style="background:#E8FFF3;color:#049C4F;border-radius: 10px;">Apply
                                        Filter</button> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9">
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
                                    <div class="col-lg-4 col-md-6" v-for="a in listData">
                                        <router-link :to="`/destination/${a.id}`">
                                            <div class="list-item-grid"
                                                :style="`background-image:linear-gradient(359.32deg, rgba(0, 0, 0, 0.5) 10%, rgba(0, 0, 0, 0) 99.42%), url('${a.touristDestinationFiles.length > 0 ? a.touristDestinationFiles[0].link : ''}'), url('${$noImageUrl()}');`">
                                                <div v-if="a.isSuperior" class="recomended"><svg width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M12 17.9999L7.91565 20.1472C7.42681 20.4042 6.82218 20.2163 6.56518 19.7274C6.46284 19.5328 6.42753 19.3098 6.4647 19.0931L7.24475 14.545L3.94042 11.3241C3.54493 10.9386 3.53684 10.3055 3.92234 9.91001C4.07585 9.75252 4.27699 9.65004 4.49463 9.61841L9.06111 8.95486L11.1033 4.81693C11.3477 4.32168 11.9473 4.11834 12.4426 4.36276C12.6398 4.46009 12.7994 4.61972 12.8968 4.81693L14.939 8.95486L19.5054 9.61841C20.052 9.69783 20.4307 10.2053 20.3512 10.7518C20.3196 10.9695 20.2171 11.1706 20.0596 11.3241L16.7553 14.545L17.5354 19.0931C17.6287 19.6374 17.2631 20.1544 16.7188 20.2477C16.502 20.2849 16.2791 20.2496 16.0844 20.1472L12 17.9999Z"
                                                            fill="#FFA800" />
                                                    </svg>&ensp;
                                                    <span>Recommended</span>
                                                </div>
                                                <div class="title">
                                                    {{ $getTitleEventsOrDestination(a.touristDestinationLanguages) }}
                                                </div>
                                                <div class="view-more">
                                                    Visit&ensp;<svg width="18" height="18" viewBox="0 0 18 18"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M9 3L7.9425 4.0575L12.1275 8.25H3V9.75H12.1275L7.9425 13.9425L9 15L15 9L9 3Z"
                                                            fill="white" />
                                                    </svg>

                                                </div>
                                            </div>
                                        </router-link>
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
                        selectedCategoryId: '',
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
            if(this.$route.query.id && this.$route.query.name){
                this.single.filter.category = {
                    id: this.$route.query.id,
                    text: this.$route.query.name
                }

                this.single.filter.selectedCategoryId = this.$route.query.id;
            }
            this.$axios().get(`menu-header-web?headerType=tourist_destination`)
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
            getData(fromSelect = false) {
                if(fromSelect){
                    this.currentPage = 1;
                    this.totalData = 0;
                    this.single.filter.selectedCategoryId = this.single.filter.category.id;
                }

                this.pageStatus = 'page-load';
                let params = {
                    search: this.single.filter.search,
                    page: this.currentPage,
                    limit: 12,
                }

                if (this.single.filter.selectedCategoryId) {
                    params.categoryId = this.single.filter.selectedCategoryId;
                }

                if (this.single.filter.latitude !== null && this.single.filter.longtitude !== null) {
                    params.latitude = this.single.filter.latitude;
                    params.longitude = this.single.filter.longtitude;
                    params.radius = this.single.filter.selectedRadius;
                    params.sortBy = 'distance';
                    params.orderBy = 'asc';

                }
                this.$axios().get(`stroll-shop`, {
                        params
                    })
                    .then(response => {
                        this.pageStatus = 'standby';
                        this.totalData = response.data.data.total;

                        this.listData = response.data.data.data;
                    })
            },
            getCategory(keyword, limit) {

                this.pageStatus = 'category-load';

                let params = {
                    search: keyword,
                    limit: limit
                }
                this.$axios().get(`select-list/tourism-category`, {
                        params
                    })
                    .then(response => {
                        this.listCategory = [];
                        for (let i = 0; i < response.data.data.length; i++) {
                            this.listCategory.push({
                                id: response.data.data[i].id,
                                text: response.data.data[i].name
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

    .list-item-grid {
        width: 100%;
        height: 250px;
        background-size: cover;
        border-radius: 10px;
        margin-top: 15px;
        background-position: center;
        padding: 15px;
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: end;
    }

    .list-item-grid .title {
        font-size: 17px;
        font-weight: 500;
        padding-bottom: 10px;
        color: #fff;
    }

    .list-item-grid .view-more {
        color: #fff;
        font-size: 13px;
        margin-top: 5px;
    }

    .list-item-grid .recomended {
        background-color: #fff;
        font-size: 14px;
        position: absolute;
        display: flex;
        align-items: center;
        top: 15px;
        padding: 3px 10px;
        border-radius: 10px;

    }

    .list-item-grid .recomended span {
        color: #5E6278;
        font-size: 12px !important;
    }

    #map {
        height: 400px;
        width: 100%;
        border-radius: 10px;
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
    @media(max-width:991px){
        .filter-grid-item{
            position: static !important;
        }
    }
</style>
