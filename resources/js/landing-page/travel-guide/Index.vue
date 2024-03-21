<template>
    <div>
        <app-landing-page-navbar></app-landing-page-navbar>
        <div class="content pb-5">
            <section>
                <div class="container">
                    <h4 class="fw-bold text-center pt-5">Our Travel Guide</h4>
                    <div class="w-100 d-flex justify-content-center mt-4">
                        <div class="input-group input-group-travel mb-3 w-100" style="max-width:500px">
                            <input type="text" class="form-control" placeholder="Type" v-model="search" v-on:keyup.enter="getTravelGuide"
                                style="border-right: 0 !important;border-top-left-radius:12px;border-bottom-left-radius:12px;box-shadow:unset !important">
                            <span class="input-group-text"
                                style="background: #fff;border-top-right-radius:12px;border-bottom-right-radius:12px;padding:5px !important">
                                <button type="button" @click="getTravelGuide"
                                    class="btn bg-primary-custom fs-15px text-white px-4 py-2 rounded-patern">Search</button>
                            </span>
                        </div>
                    </div>
                    <template v-if="pageStatus == 'page-load'">
                        <div class="d-flex justify-content-center mt-5 mb-5">
                            <app-loader></app-loader>
                        </div>
                        
                    </template>
                    <template v-else>
                        <div class="row mb-5">
                            <div class="col-lg-12 mb-5 mt-5 text-center" v-if="list.length == 0">
                                Tidak Ada Data
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-6 mt-4" v-for="context in list">
                                <router-link :to="`/travel-guide/${context.id}`">
                                    <div class="d-flex justify-content-center mb-1">
                                        <img :src="`${context.tourGuideFiles?.link}`" @error="$setNoImageUrl"
                                            class="travel-list-image">
                                    </div>

                                    <div class="fw-bolder text-center fs-6">{{context.name}}</div>
                                    <div v-if="context.websiteLink" style="color:#0E5CA8;font-size: 13px;overflow-wrap:anywhere" class="fw-semibolder text-center">
                                        {{context.websiteLink}}</div>
                                </router-link>
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
    export default {
        data() {
            return {
                pageStatus: 'page-load',
                search: '',
                list: [],
            }
        },
        mounted() {
            reinitPluginLandingPage(); 
        this.getTravelGuide();
        },
        methods:{
            getTravelGuide(){
                this.pageStatus = 'page-load'
                this.$axios().get(`travel-kit/tour-guide`, {
                    params: {
                        search: this.search
                    }
                })
                .then(response => {
                    this.pageStatus = 'standby';
                    this.list = response.data.data;
                })
            }
        }
    }

</script>

<style scoped>
    .travel-list-image {
        width: 120px;
        height: 120px;
        border-radius: 100px;
        object-fit: cover;
        object-position: center;
    }

    @media(max-width:991px) {
        .input-group-travel {
            border: 1px solid #ced4da !important;
            display: block;
        }

        .input-group-travel .form-control {
            width: 100%;
            border-radius: 12px !important;
            border: 0 !important;
        }

        .input-group-travel .input-group-text {
            border: 0 !important;
            background-color: transparent !important;
        }

        .input-group-travel .input-group-text button {
            width: 100%;
            margin-top: 5px;
        }
    }

</style>
