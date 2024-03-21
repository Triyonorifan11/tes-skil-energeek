<template>
    <div class="bg-content-custom ">
        <app-landing-page-navbar></app-landing-page-navbar>
        <div class="content pb-5 container">
            <div class="ndas align-items-center justify-content-center text-center py-5 my-3">
                <h3><b>Let’s Stroll Around</b></h3>               
                <br><br>
                <div class="search d-flex justify-content-center">
                    <div class="input-group input-group-travel" style="max-width:500px;">
                        <input type="text" v-model="strollAround.search" class="form-control" placeholder="Type" style="border-right: 0 !important;border-top-left-radius:12px;border-bottom-left-radius:12px;box-shadow:unset !important">
                        <span class="input-group-text" style="background: #fff;border-top-right-radius:12px;border-bottom-right-radius:12px;padding:2px !important">
                            <button @click="getData()" type="button" class="btn btn-success" style="border-radius:10px;">Search</button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="body">
                <div class="loader d-flex justify-content-center align-items-center" v-if="strollAround?.loading">
                    <app-loader></app-loader>
                </div>
                <div class="isi" v-else>
                    <div class="emptys d-flex align-items-center justify-content-center" v-if="!strollAround?.data?.length">
                        <span class="text-gray-700">Tidak ada data</span>
                    </div>
                    <div class="wrap" v-else>
                        <div class="row">
                            <div class="col-md-4 py-3" v-for="(context, index) in strollAround?.data">
                                <div class="card" style="box-shadow:0px 0px 10px rgba(0, 0, 0, 0.09); border-radius:10px; height:360px;">
                                    <div class="card-body">
                                        <div class="card-body py-2" style="background-color:white; border-bottom:none;">
                                            <h5><b>{{ context?.title || '-' }}</b></h5>
                                            <b @click="$router.push({path: `/stroll-around/${context?.id}`})" class="text-success" style="cursor:pointer;">
                                                Read More
                                                <svg width="13" height="12" viewBox="0 0 13 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.5 0L5.4425 1.0575L9.6275 5.25H0.5V6.75H9.6275L5.4425 10.9425L6.5 12L12.5 6L6.5 0Z" fill="#049C4F"/></svg>
                                            </b>
                                        </div>
                                    </div>
                                    <img :src="`${context?.articleThumbnail?.link}?preview=1`" @error="$setNoImageUrl" style="width:100%; height:250px; object-fit:cover; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;" alt="">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="next d-flex justify-content-center">
                            <button v-if="strollAround?.cursor" class="btn btn-success d-flex" :disabled="strollAround.loadingNext" @click="getData(true)">
                                <app-loader class="me-2" v-if="strollAround.loadingNext" style="width:25px; height:25px;"></app-loader>
                                Load More
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <app-landing-page-footer></app-landing-page-footer>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                strollAround: {
                    loading: false,
                    loadingNext: false,
                    search: '',
                    cursor: '',
                    data: []
                }
            }
        },
        mounted(){
            reinitPluginLandingPage(); 
            this.getData();
        },
        methods: {
            getData(isNext = false){
                let that = this;

                if(isNext){
                    this.strollAround.loadingNext = true;
                    if(!this.strollAround.cursor){
                        this.strollAround.cursor = '';
                    }
                }
                else{
                    this.strollAround.cursor = '';
                    this.strollAround.loading = true;
                }

                let params = {
                    sort_by: 'created_at',
                    order_by: 'desc'
                }
                this.$axios().get(`web-article?limit=9&search=${this?.strollAround?.search}&cursor=${this?.strollAround?.cursor}`,{
                    params
                })
                    .then(res => {
                        let data = res?.data?.data;
                        this.strollAround.cursor = data?.nextCursor;
                        if(isNext){
                            $.each(data?.data, function(i,val){
                                that.strollAround.data.push(val);
                            });
                        }
                        else{
                            this.strollAround.data = data?.data;
                        }
                        this.strollAround.loading = false;
                        this.strollAround.loadingNext = false;
                    });
            }
        }
    }
</script>

<style scoped>
.bg-content-custom {
    background-color: #F5F6FA;
}
</style>
