<template>
    <div>
        <app-landing-page-navbar></app-landing-page-navbar>
        <div class="content">
            <div class="d-flex justify-content-center align-items-center flex-column p-5" v-if="header.show"
                :style="`background: rgba(0, 0, 0, .3) url('${header.background}'); background-size:cover;width:100%;background-position:center;min-height:250px;`">
            </div>
            <div class="wrap-desc-bus py-3 container">
                <div class="fw-bolder text-center" style="font-size:30px">{{ header.title }}</div>
                <div class="pt-2 text-center" style="font-size:14px">{{header.description}}</div>
            </div>
            <section>
                <div class="container">
                    <h4 class="fw-bold pt-5">Jadwal & Rute</h4>
                    <template v-if="pageStatus == 'page-load'">
                        <div class="d-flex justify-content-center mt-5 mb-5">
                            <app-loader></app-loader>
                        </div>

                    </template>
                    <template v-else>
                        <div class="row mt-3">
                            <div class="col-lg-4 col-md-6 mb-5" v-for="a in list">
                                <div class="border border-1 mt-4 shadow-patern" style="border-radius: 12px;">
                                    <img :src="`${a.busSsctThumbnail?.link ?? '-'}`" @error="$setNoImageUrl" class="w-100"
                                        style="border-top-left-radius: 12px;border-top-right-radius: 12px;">
                                    <div class="p-3">
                                        <div class="fw-semibolder pt-1 fs-5">{{a.day}}</div>
                                        <ol class="text-gray-600 mt-3"
                                            style="padding:0 !important;font-size: 15px;padding-left:15px !important">
                                            <li class="mt-1" v-for="c in a.touristDestinationBusSscts"><router-link :to="`/destination/${c.id}`">{{$getTitleEventsOrDestination(c.touristDestinationLanguages)}}</router-link></li>
                                        </ol>
                                        <a
                                    :href="a.linkPurchaceTicket" target="_blank"
                                    class="btn bg-primary-custom text-white rounded-patern px-4 w-100 fs-15px py-2">Pesan
                                    Tiket </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </section>
            <section :style="`background: url('${$assetUrl()}assets/images/sample/map.png');`"
                class="explore-map-wrapper mt-5">
                <div class="container">
                    <div class="d-flex justify-content-center">
                        <div class="bg-white shadow-patern d-flex flex-column align-items-center justify-content-center w-100 px-5 py-5 rounded-patern"
                            style="max-width:580px;min-height:250px">
                            <div class="fw-bold text-center fs-4">Makin Mudah Explore Surabaya</div>
                            <div class="text-center text-gray-500 pt-3">Pesan tiket sekarang juga untuk berbagai benefit
                            </div>
                            <div class="d-flex justify-content-center mt-3"><a
                                    href="https://tiketwisata.surabaya.go.id/" target="_blank"
                                    class="btn bg-primary-custom text-white rounded-patern px-4 fs-15px py-2">Pesan
                                    Tiket </a></div>
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
                header: {
                    show: false,
                    background: '',
                    title: '',
                    description: ''
                },
                list: [],
            }
        },
        mounted() {
            reinitPluginLandingPage();
            this.$axios().get(`menu-header-web?headerType=bus_ssct`)
                .then(response => {
                    this.header.show = true;
                    this.header.background = response.data.data.menuHeaderFile ? response.data.data.menuHeaderFile
                        .link : '';
                    this.header.title = response.data.data.heading;
                    this.header.description = response.data.data.description;
                })

            this.getData();
        },
        methods: {
            getData() {
                this.pageStatus = 'page-load'
                this.$axios().get(`travel-kit/bus-ssct`)
                    .then(response => {
                        this.pageStatus = 'standby';
                        this.list = response.data.data;
                    })
            }
        }
    }

</script>

<style scoped>
    .explore-map-wrapper {
        background-size: cover !important;
        background-position: center !important;
        padding: 80px 0;
    }

    @media(max-width:991px) {
        .explore-map-wrapper {
            background: #fff !important;
            padding: 0 !important;
        }

    }

</style>
