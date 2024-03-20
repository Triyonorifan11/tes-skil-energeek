<template>
    <div>
        <app-landing-page-navbar></app-landing-page-navbar>
        <div class="content">
            <section>
                <div class="container">
                    <h4 class="fw-bold text-center pt-5 pb-5">E-Book</h4>
                    <template v-if="pageStatus == 'page-load'">
                        <div class="d-flex justify-content-center mt-5 mb-5">
                            <app-loader></app-loader>
                        </div>

                    </template>
                    <template v-else>
                        <div class="row">
                            <div class="col-lg-6 mb-5" v-for="a in list">
                                <div class="d-flex justify-content-between align-items-center p-3"
                                    style="border:1px #E4E6EF solid;border-radius: 15px;">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3 thumbnail-ebook">
                                            <img class="thumbnail-ebook" :src="`${a.ebookThumbnail?.link}`" @error="$setNoImageUrl"
                                                style="object-fit: cover;object-position: center;border-radius: 10px;">
                                        </div>
                                        <div>
                                            <div class="fs-5 fw-semibolder pb-3" style="color:#049C4F">{{a.name}}</div>
                                            <a v-if="a.ebookFile" :href="a.ebookFile.link" class="py-2 px-4 mt-2"
                                                style="color:#049C4F;border-radius: 10px;border:1px #049C4F solid;">Download</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-3" v-if="nextUrl && pageStatus != 'load-more'">
                            <button type="button" @click="getMoreData"
                                class="btn d-flex justify-content-center align-items-center c-primary-custom fs-6 mb-5 p-2 fw-semibolder"
                                style="border-radius: 100px;min-width: 150px;background-color: #E8FFF3;">
                                <div>
                                    Load More
                                </div>

                            </button>
                        </div>
                        <template v-if="pageStatus == 'load-more'">
                            <div class="d-flex mt-5 mb-5 justify-content-center align-items-center">
                                <app-loader></app-loader>
                            </div>
                        </template>
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
                pageStatus: 'page-load',
                list: [],
                nextUrl: null,
            }
        },
        mounted() {
            reinitPluginLandingPage(); 
            this.getData();
        },
        methods: {
            getData() {
                this.pageStatus = 'page-load'
                this.$axios().get(`travel-kit/ebook?limit=15`)
                    .then(response => {
                        this.pageStatus = 'standby';
                        this.list = response.data.data.data;
                        if (response.data.data.nextPageUrl) {
                            this.nextUrl = response.data.data.nextPageUrl;
                        } else {
                            this.nextUrl = null
                        }
                    })
            },
            getMoreData() {
                this.pageStatus = 'load-more';
                this.$axios().get(`${this.nextUrl}&limit=15`)
                    .then(response => {

                        let result = this.list.concat(response.data.data.data);

                        this.list = result;

                        if (response.data.data.nextPageUrl) {
                            this.nextUrl = response.data.data.nextPageUrl;
                        } else {
                            this.nextUrl = null
                        }

                    }).then(() => {
                        this.pageStatus = 'standby';
                    });
            },
        }
    }

</script>

<style scoped>
    .thumbnail-ebook {
        width: 170px;
        height: 230px
    }

    @media(max-width:991px) {
        .thumbnail-ebook {
            width: 130px;
            height: 170px
        }
    }

</style>
