<template>
    <div>
        <app-landing-page-navbar></app-landing-page-navbar>
        <div class="content">
            <section class="pt-5">
                <div class="container">
                    <div class="d-flex flex-wrap align-items-center">
                        <div style="font-weight:500">Detail Travel Guide</div>
                        <div class="mx-3" style="color:#B5B5C3">|</div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb" style="font-size:14px;margin-bottom: 0 !important;">
                                <li class="breadcrumb-item" style="color:#B5B5C3 !important">
                                    <router-link to="/">Home</router-link>
                                </li>
                                <li class="breadcrumb-item" style="color:#B5B5C3 !important">
                                    <router-link to="/travel-guide">Travel Guide</router-link>
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
                        <div class="fs-3 pt-3 fw-bolder" style="color:#3F4254">{{ data.name }}</div>
                        <div class="d-flex align-items-center mt-3">
                            <div class="me-3">
                                <img :src="`${data.tourGuideFiles?.link}`" @error="$setNoImageUrl"
                                    style="border-radius:100px;width:100px;height:100px;">
                            </div>
                            <div>
                                <div style="color:#3F4254">{{ data.phoneNumber }}</div>
                                <div style="color:#5E6278">{{data.address}}</div>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap align-items-center mt-5">
                            <a :href="data.websiteLink" v-if="data.websiteLink" class="me-3 mb-3"
                                style="color:#0E5CA8;font-weight: 500;">
                                {{data.websiteLink}}&ensp;<svg width="19" height="18" viewBox="0 0 19 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7.625 3.375V4.875H12.5675L3.875 13.5675L4.9325 14.625L13.625 5.9325V10.875H15.125V3.375H7.625Z"
                                        fill="#0E5CA8" />
                                </svg>

                            </a>
                            <a v-if="data.instagramLink" :href="data.instagramLink" class="mb-3"
                                style="color:#F64E60;font-weight: 500;">
                                {{data.instagramLink}}&ensp;<svg width="19" height="18" viewBox="0 0 19 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7.625 3.375V4.875H12.5675L3.875 13.5675L4.9325 14.625L13.625 5.9325V10.875H15.125V3.375H7.625Z"
                                        fill="#F64E60" />
                                </svg>


                            </a>
                        </div>
                        <div class="pt-3 mt-3 pb-5" style="color:#3F4254;line-height: 2;border-top:1px #ddd solid;">
                            {{data.description}}</div>
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
                data: null,
            }
        },
        mounted() {
            reinitPluginLandingPage(); 
            this.getDetailTravelGuide();
        },
        methods: {
            getDetailTravelGuide() {
                this.$axios().get(`travel-kit/tour-guide/${this.$route.params.id}`)
                    .then(response => {
                        this.pageStatus = 'standby';
                        this.data = response.data.data;
                    })
            }
        }
    }

</script>

<style scoped>
    .breadcrumb-item+.breadcrumb-item::before {
        content: '-' !important;
        color: #B5B5C3 !important;
    }

</style>
