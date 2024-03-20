<template>
    <div>
        <app-landing-page-navbar></app-landing-page-navbar>
        <br><br>
        <div class="loader d-flex align-items-center justify-content-center pt-5 mt-5" v-if="article?.loading"><app-loader></app-loader></div>
        <div class="content content-landingpage pb-5 container" style="max-width:800px;" v-else>
            <div class="ndas text-center" style="border-bottom:1px solid lightgray;">
                <h2><b>{{ article?.data?.title }}</b></h2>
                <span>{{ article?.data?.heading }}</span>
                <br><br>
            </div>
            <div class="thumbnail py-4">
                <div class="d-flex justify-content-center">
                    <img :src="`${article?.data?.articleThumbnail?.link}?token=${token}&preview=1`" @error="$setNoImageUrl" style="max-width:100%; border-radius:10px !important;" alt="">
                </div>
            </div>
            <div class="desc" v-html="article?.data?.description"></div>
            <div class="share py-5">
                <div class="pe-3 d-flex align-items-center">
                    <h6 class="me-3"><b>Share</b></h6>
                    <div class="d-flex align-items-center">
                        <ShareNetwork class="me-3" network="facebook" :url="currentUrl"
                            :title="article?.data?.title"
                            :description="article?.data?.heading">
                            <svg width="33" height="32" viewBox="0 0 33 32" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M29.8332 16.0003C29.8332 8.64032 23.8598 2.66699 16.4998 2.66699C9.13984 2.66699 3.1665 8.64032 3.1665 16.0003C3.1665 22.4537 7.75317 27.827 13.8332 29.067V20.0003H11.1665V16.0003H13.8332V12.667C13.8332 10.0937 15.9265 8.00032 18.4998 8.00032H21.8332V12.0003H19.1665C18.4332 12.0003 17.8332 12.6003 17.8332 13.3337V16.0003H21.8332V20.0003H17.8332V29.267C24.5665 28.6003 29.8332 22.9203 29.8332 16.0003Z"
                                    fill="#3699FF" />
                            </svg></ShareNetwork>
                        <ShareNetwork class="me-3" network="twitter" :url="currentUrl"
                            :title="article?.data?.title"
                            :description="article?.data?.heading">
                            <svg width="33" height="32" viewBox="0 0 33 32" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M30.4466 7.99967C29.4199 8.46634 28.3132 8.77301 27.1666 8.91967C28.3399 8.21301 29.2466 7.09301 29.6732 5.74634C28.5666 6.41301 27.3399 6.87967 26.0466 7.14634C24.9932 5.99967 23.5132 5.33301 21.8332 5.33301C18.6999 5.33301 16.1399 7.89301 16.1399 11.053C16.1399 11.5063 16.1932 11.9463 16.2866 12.3597C11.5399 12.1197 7.31322 9.83967 4.49989 6.38634C4.00656 7.22634 3.72656 8.21301 3.72656 9.25301C3.72656 11.2397 4.72656 12.9997 6.27322 13.9997C5.32656 13.9997 4.44656 13.733 3.67322 13.333V13.373C3.67322 16.1463 5.64656 18.4663 8.25989 18.9863C7.42086 19.216 6.54002 19.2479 5.68656 19.0797C6.0487 20.2163 6.75794 21.2109 7.71458 21.9236C8.67122 22.6363 9.82715 23.0313 11.0199 23.053C8.99806 24.6536 6.49188 25.5188 3.91322 25.5063C3.45989 25.5063 3.00656 25.4797 2.55322 25.4263C5.08656 27.053 8.09989 27.9997 11.3266 27.9997C21.8332 27.9997 27.6066 19.2797 27.6066 11.7197C27.6066 11.4663 27.6066 11.2263 27.5932 10.973C28.7132 10.173 29.6732 9.15967 30.4466 7.99967Z" fill="#3699FF" /></svg>
                        </ShareNetwork>
                    </div>
                </div>
            </div>
        </div>
        <div class="related container pb-5">
            <h4><b>Related Article</b></h4>
                <div class="loader d-flex justify-content-center align-items-center" v-if="related?.loading">
                <app-loader></app-loader>
            </div>
            <div class="isi" v-else>
                <div class="emptys d-flex align-items-center justify-content-center" v-if="!related?.data?.length">
                    <span class="text-gray-700">Tidak ada data</span>
                </div>
                <div class="row" v-else>
                    <div class="col-md-4 py-3" v-for="(context, index) in related?.data">
                        <div class="card" style="box-shadow:0px 0px 10px rgba(0, 0, 0, 0.09); border-radius:10px; height:360px;">
                            <div class="card-body">
                                <div class="card-body py-2" style="background-color:white; border-bottom:none;">
                                    <h5><b>{{ context?.title || '-' }}</b></h5>
                                    <b @click="reload(context?.id)" class="text-success" style="cursor:pointer;">
                                        Read More
                                        <svg width="13" height="12" viewBox="0 0 13 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.5 0L5.4425 1.0575L9.6275 5.25H0.5V6.75H9.6275L5.4425 10.9425L6.5 12L12.5 6L6.5 0Z" fill="#049C4F"/></svg>
                                    </b>
                                </div>
                            </div>
                            <img :src="`${context?.articleThumbnail?.link}?preview=1`" @error="$setNoImageUrl" style="width:100%;height:250px; object-fit:cover; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <app-landing-page-footer></app-landing-page-footer>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                assetUrl: assetUrl,
                token: localStorage.getItem('tourism_token'),
                currentUrl: window.location.href,
                article: {
                    loading: false,
                    data: ''
                },
                related: {
                    loading: false,
                    data: []
                }
            }
        },
        mounted(){
            reinitPluginLandingPage(); 
            this.getData();
            this.getRelated();
        },
        methods: {
            getData(){
                this.article.loading = true;
                this.$axios().get(`web-article/${this?.$route?.params?.id}`)
                    .then(res => {
                        let data = res?.data?.data;
                        this.article.data = data;
                        this.article.loading = false;
                    });
            },
            getRelated(){
                this.related.loading = true;
                let params = {
                    sort_by: 'created_at',
                    order_by: 'desc'
                }
                this.$axios().get(`web-article?limit=3&ignoreId[]=${this?.$route?.params?.id}`,{
                    params
                })
                    .then(res => {
                        let data = res?.data?.data;
                        this.related.data = data?.data;
                        this.related.loading = false;
                    });
            },
            reload(id){
                let that = this;
                this.$router.push({path: `/stroll-around/${id}`});
                setTimeout(function(){
                    that.getData();
                    that.getRelated()
                },200)
            }
        }
    }
</script>

<style scoped>
.bg-content-custom {
    background-color: #F5F6FA;
}
</style>
