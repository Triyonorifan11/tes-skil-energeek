<template>
    <div>
        <div id="main-content">
            <div class="post d-flex flex-column-fluid" id="kt_post">
                <div id="kt_content_container" class="container-xxl">
                    <div class="card card-flush mt-5 mb-5 mb-xl-10" id="kt_profile_details_view">
                        <div class="card card-xl-stretch mb-5 mb-xl-8">
                            <div class="card-header border-0 pt-5 align-items-center">
                                <div class="judul">
                                    <h2 class="text-gray-700">{{ flag == 'insert' ? 'Buat Iklan' : 'Edit Iklan' }}</h2>
                                    <span class="text-gray-700">Iklan pada aplikasi Tourism Surabaya - Disbudporapar
                                        Kota Surabaya</span>
                                </div>
                                <div class="button d-flex">
                                    <button class="btn btn-secondary" @click="$router.back()">
                                        <svg width="16" height="10" viewBox="0 0 16 10" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M5.96839 8.82451L5.5 9.29289L1.20711 5L5.5 0.707107L5.96839 1.17549L3.33762 3.81361L2.48694 4.66667H3.69167H15V5.33333H3.69167H2.48694L3.33762 6.18639L5.96839 8.82451Z"
                                                fill="black" stroke="#0E5CA8" /></svg>
                                        Kembali
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <template v-if="pageStatus == 'page-load'">
                                    <div class="d-flex justify-content-center mt-10 mb-10">
                                        <app-loader></app-loader>
                                    </div>
                                </template>
                                <div class="row" v-else>
                                    <div class="col-lg-5">
                                        <div class="mb-3">
                                            <label for="name">Judul Iklan</label>
                                            <input v-model="single.title" type="text" id="name" class="form-control"
                                                placeholder="Cth: 4000 Siswa akan ikut memeriahkan Karnaval 2022 Kota Surabaya, ">

                                        </div>
                                        <div class="mb-3">
                                            <label for="name">Periode Penayangan</label>
                                            <app-datepicker v-model:value="single.periode" type="datetime"
                                                input-class="form-control" input-style="width:100% !important;"
                                                format="DD-MM-YYYY HH:mm:ss" value-type="YYYY-MM-DD HH:mm:ss" range>
                                            </app-datepicker>

                                        </div>
                                        <div class="mb-3">
                                            <label for="name">Text pada Tombol</label>
                                            <input v-model="single.text" type="text" id="name" class="form-control"
                                                placeholder="Cth: Lihat Detail">

                                        </div>
                                        <div class="mb-3">
                                            <label for="name">Link pada Tombol</label>
                                            <input v-model="single.url" type="text" id="name" class="form-control"
                                                placeholder="Masukkan link, cth: https://www.youtube.com/">

                                        </div>
                                        <div class="mb-3">
                                            <label for="name">Gambar Banner</label>
                                            <div style="width:230px;height:320px;background:#ddd"
                                                class="d-flex justify-content-center align-items-center"
                                                @click="choosePhoto">
                                                <img v-if="single.bannerBase64" :src="single.bannerBase64"
                                                    style="width:230px;height:320px;" />
                                                <div class="text-gray-800 text-center p-3" v-if="!single.bannerBase64">
                                                    Belum ada thumbnail, klik untuk menambah thumbnail</div>
                                            </div>
                                            <input :id="'input-photo'" type="file" class="d-none" accept="image/*"
                                                @change="imageChange($event)">

                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="fs-2 pb-3">Preview Hasil</div>
                                        <div class="d-flex w-100">
                                            <div style="width:230px;height:320px;">
                                                <div style="width:230px;height:320px;background:#ddd"
                                                    class="d-flex justify-content-center align-items-center">
                                                    <img v-if="single.bannerBase64" :src="single.bannerBase64"
                                                        style="width:230px;height:320px;" />
                                                    <div class="text-gray-800 text-center p-3"
                                                        v-if="!single.bannerBase64">Gambar banner tampil disini</div>
                                                </div>
                                            </div>
                                            <div class="p-3 d-flex flex-column justify-content-between w-100">
                                                <div class="fs-3 fw-bolder pt-5">
                                                    {{ single.title ? single.title : '{Judul iklan akan ditampilkan disini}' }}
                                                </div>
                                                <button class="btn btn-primary mb-5 w-100"
                                                    style="background:#049C4F !important">{{ single.text ? single.text : '{Text pada tombol akan ditampilkan disni}' }}&ensp;<i
                                                        class="fa fa-arrow-right"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer text-center justify-content-center d-flex">
                                <button class="btn btn-secondary m-2" @click="save('draft')">Simpan Draft</button>
                                <button class="btn btn-primary m-2" @click="save('publish')"
                                    style="background:#049C4F !important">Publikasi Iklan</button>
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
                token: localStorage.getItem('tourism_token'),
                assetUrl: assetUrl,
                pageStatus: 'standby',
                flag: 'insert',
                single: {
                    id: '',
                    title: '',
                    periode: [],
                    text: '',
                    url: '',
                    bannerBase64: '',
                    bannerFile: null
                }
            }
        },
        mounted() {
            if (this.$route.params.id) {
                this.flag = 'update';
                this.getData();
            }
        },
        methods: {
            getData() {
                this.pageStatus = 'page-load';
                this.$axios().get('advertisement/' + this.$route.params.id)
                    .then(response => {
                        let context = response.data.data;
                        this.single.id = context.id;
                        this.single.title = context.title;
                        this.single.periode = [context.startDate, context.endDate],
                            this.single.text = context.buttonText,
                            this.single.url = context.buttonLink,
                            this.single.bannerBase64 = context.advertisementFile ? context.advertisementFile.link :
                            '';
                        this.pageStatus = 'standby';
                    })
                    .catch(error => {
                        this.$axiosHandleError(error);
                    });
            },
            save(statusType) {
                let that = this;
                let data = {
                    title: this.single.title,
                    startDate: this.single.periode.length > 0 ? this.single.periode[0] : '',
                    endDate: this.single.periode.length > 0 ? this.single.periode[1] : '',
                    buttonText: this.single.text,
                    buttonLink: this.single.url,
                    statusType: statusType
                }

                let formData = new FormData();
                for (var key in data) {
                    formData.append(key, data[key]);
                }

                if (this.single.bannerFile) {
                    formData.append('file', this.single.bannerFile);
                }

                this.$ewpLoadingShow();

                let urlX = 'advertisement';
                if (this.flag == 'update') {
                    urlX = 'advertisement/' + this.single.id;
                }
                this.$axios().post(urlX, formData)
                    .then(response => {
                        setTimeout(() => {
                            this.$router.back();
                        toastr.success(this.flag == 'insert' ? 'Menambahkan data pop up iklan' :
                            'Memperbarui data pop up iklan');                            
                        }, 300);
                        
                        
                    })
                    .catch(error => {                      
                        this.$axiosHandleError(error);
                    }).then(() => {
                        this.$ewpLoadingHide();
                    });
            },
            choosePhoto() {
                this.single.bannerBase64 = '';
                this.single.bannerFile = '';

                $('#input-photo').val('');
                setTimeout(() => {
                    $('#input-photo').click();
                }, 500);

            },
            imageChange(evt) {
                evt.preventDefault();
                evt.stopImmediatePropagation();

                const conteks = window.$(evt.target)
                const that = this;
                if (window.FileReader) {
                    const fileReader = new FileReader();
                    const files = document.getElementById(conteks.attr('id')).files;
                    if (!files.length) {
                        return;
                    }
                    const file = files[0];
                    if (/^image\/\w+$/.test(file.type)) {
                        fileReader.readAsDataURL(file);
                        fileReader.onload = function () {
                            var files = evt.target.files || event.dataTransfer.files;
                            if (!files.length) {
                                return;
                            }

                            const size = file.size;

                            that.single.bannerBase64 = fileReader.result;
                            that.single.bannerFile = files[0];
                        };
                    } else {
                        this.$swal({
                            title: 'Peringatan!',
                            text: 'File yang anda pilih belum termasuk gambar!',
                            icon: 'warning',
                        })
                    }
                }
            }
        },
    }

</script>

<style scoped>
    .mx-datepicker {
        width: 100% !important;
    }

</style>
