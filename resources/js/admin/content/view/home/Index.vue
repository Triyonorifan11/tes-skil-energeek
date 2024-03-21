<template>
    <div>
        <div id="main-content">
            <div class="post d-flex flex-column-fluid" id="kt_post">
                <div id="kt_content_container" class="container-xxl">
                    <div class="card card-flush mt-5 mb-5 mb-xl-10" id="kt_profile_details_view">
                        <div class="card card-xl-stretch mb-5 mb-xl-8">
                            <div class="card-header border-0 pt-5 align-items-center">
                                <div class="judul">
                                    <h2 class="text-gray-700">Home About</h2>
                                    <span class="text-gray-700">Setting galeri pada home about pada aplikasi Tourism Surabaya - Disbudporapar Kota Surabaya</span>
                                </div>
                                <div class="button d-flex">
                                    <button class="btn btn-success btn-sm" @click="simpan()">Simpan</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="loader d-flex justify-content-center align-items-center" v-if="loading"><app-loader></app-loader></div>
                                <div class="konten" v-else>
                                    <div class="card card-wording" style="box-shadow:0px 0px 7px lightgray;">
                                        <div class="card-body">
                                            <div class="judul">
                                                <h2 class="text-gray-700">Wording</h2>
                                            </div>
                                            <br>
                                            <div class="formulir">
                                                <label for="label">Label</label>
                                                <br>
                                                <input v-model="form.data.wording.label" type="text" class="form-control my-3" placeholder="Masukkan label">
                                                <br>
                                                <label for="deskripsi">Deskripsi</label>
                                                <br>
                                                <textarea v-model="form.data.wording.description" class="form-control my-3" rows="10" placeholder="Masukkan label"></textarea>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="card card-wording" style="box-shadow:0px 0px 7px lightgray;">
                                        <div class="card-body">
                                            <div class="judul">
                                                <h2 class="text-gray-700">Radius Nearby Menu Map(KM)</h2>
                                            </div>
                                            <br>
                                            <div class="formulir">
                                                <input v-model="form.data.wording.radius" type="number" class="form-control my-3" placeholder="Masukkan angka">
                                            </div>
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="card card-foto" style="box-shadow:0px 0px 7px lightgray;">
                                        <div class="card-body">
                                            <div class="judul">
                                                <h2 class="text-gray-700">Foto Kiri dan Kanan</h2>
                                            </div>
                                            <div class="wrap-foto row">
                                                <div class="col-md-6">
                                                    <div class="card card-kiri" style="box-shadow:0px 0px 5px lightgray; border:2px solid lightgray;">
                                                        <div class="card-body">
                                                            <div class="foto-foto row" style="width:100%;">
                                                                <div class="col-3 p-2" style="position:relative;" v-for="(context, index) in form?.show?.fotoKiri">
                                                                    <div class="foto p-2" style="border:1px solid lightgray; border-radius:5px; height:85px;">
                                                                        <img @error="$setNoImageUrl" :src="`${context?.link}?token=${token}`" style="width:100%; height:100%; object-fit: cover;" alt="">
                                                                    </div>
                                                                    <div @click="deleteFile(context?.id)" style="background-color:white; position:absolute; right:20px; bottom:20px; border-radius:5px; cursor:pointer;"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16 9V19H8V9H16ZM14.5 3H9.5L8.5 4H5V6H19V4H15.5L14.5 3ZM18 7H6V19C6 20.1 6.9 21 8 21H16C17.1 21 18 20.1 18 19V7Z" fill="#F1416C"/></svg></div>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="dropzone mx-0 bg-light-primary" id="dropzone-foto-kiri" style="border:1px solid #78CCFB;">
                                                                <div class="dz-message needsclick pt-2 d-flex align-items-center">
                                                                    <svg width="43" height="43" viewBox="0 0 43 43" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M10.4941 3.58398H24.6112C25.2466 3.58398 25.8615 3.80917 26.3467 4.21956L34.8815 11.4385C35.4852 11.9492 35.8334 12.6998 35.8334 13.4905V35.9833C35.8334 39.1913 35.7968 39.4173 32.506 39.4173H10.4941C7.20338 39.4173 7.16675 39.1913 7.16675 35.9833V7.01801C7.16675 3.80996 7.20338 3.58398 10.4941 3.58398Z" fill="#009EF7"/><path fill-rule="evenodd" clip-rule="evenodd" d="M16.0377 24.7523H19.543V28.3494C19.543 28.8442 19.9441 29.2453 20.4389 29.2453H22.2723C22.767 29.2453 23.1681 28.8442 23.1681 28.3494V24.7523H26.6735C27.1682 24.7523 27.5693 24.3513 27.5693 23.8565C27.5693 23.6445 27.4941 23.4394 27.3572 23.2777L22.0393 16.9967C21.7196 16.6191 21.1543 16.5721 20.7767 16.8918C20.7389 16.9238 20.7039 16.9589 20.6719 16.9967L15.354 23.2777C15.0343 23.6552 15.0812 24.2205 15.4588 24.5402C15.6206 24.6772 15.8257 24.7523 16.0377 24.7523Z" fill="#009EF7"/></svg>
                                                                    <div class="tulisan">
                                                                        <div>Drop files here or click to upload.</div>
                                                                        <small class="text-primary">Only allowed upload up to 5 file with the format .jpg/.png</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="card card-kiri" style="box-shadow:0px 0px 5px lightgray; border:2px solid lightgray;">
                                                        <div class="card-body">
                                                            <div class="foto-foto row" style="width:100%;">
                                                                <div class="col-3 p-2" style="position:relative;" v-for="(context, index) in form?.show?.fotoKanan">
                                                                    <div class="foto p-2" style="border:1px solid lightgray; border-radius:5px; height:85px;">
                                                                        <img @error="$setNoImageUrl" :src="`${context?.link}?token=${token}`" style="width:100%; height:100%; object-fit: cover;" alt="">
                                                                    </div>
                                                                    <div @click="deleteFile(context?.id)" style="background-color:white; position:absolute; right:20px; bottom:20px; border-radius:5px; cursor:pointer;"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16 9V19H8V9H16ZM14.5 3H9.5L8.5 4H5V6H19V4H15.5L14.5 3ZM18 7H6V19C6 20.1 6.9 21 8 21H16C17.1 21 18 20.1 18 19V7Z" fill="#F1416C"/></svg></div>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="dropzone mx-0 bg-light-primary" id="dropzone-foto-kanan" style="border:1px solid #78CCFB;">
                                                                <div class="dz-message needsclick pt-2 d-flex align-items-center">
                                                                    <svg width="43" height="43" viewBox="0 0 43 43" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M10.4941 3.58398H24.6112C25.2466 3.58398 25.8615 3.80917 26.3467 4.21956L34.8815 11.4385C35.4852 11.9492 35.8334 12.6998 35.8334 13.4905V35.9833C35.8334 39.1913 35.7968 39.4173 32.506 39.4173H10.4941C7.20338 39.4173 7.16675 39.1913 7.16675 35.9833V7.01801C7.16675 3.80996 7.20338 3.58398 10.4941 3.58398Z" fill="#009EF7"/><path fill-rule="evenodd" clip-rule="evenodd" d="M16.0377 24.7523H19.543V28.3494C19.543 28.8442 19.9441 29.2453 20.4389 29.2453H22.2723C22.767 29.2453 23.1681 28.8442 23.1681 28.3494V24.7523H26.6735C27.1682 24.7523 27.5693 24.3513 27.5693 23.8565C27.5693 23.6445 27.4941 23.4394 27.3572 23.2777L22.0393 16.9967C21.7196 16.6191 21.1543 16.5721 20.7767 16.8918C20.7389 16.9238 20.7039 16.9589 20.6719 16.9967L15.354 23.2777C15.0343 23.6552 15.0812 24.2205 15.4588 24.5402C15.6206 24.6772 15.8257 24.7523 16.0377 24.7523Z" fill="#009EF7"/></svg>
                                                                    <div class="tulisan">
                                                                        <div>Drop files here or click to upload.</div>
                                                                        <small class="text-primary">Only allowed upload up to 5 file with the format .jpg/.png</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="card card-video" style="box-shadow:0px 0px 7px lightgray;">
                                        <div class="card-body">
                                            <div class="judul">
                                                <h2 class="text-gray-700">Video</h2>
                                            </div>
                                            <br>
                                            <div class="dropzone mx-0 bg-light-primary" id="dropzone-video" style="border:1px solid #78CCFB;">
                                                <div class="dz-message needsclick pt-2 d-flex align-items-center">
                                                    <svg width="43" height="43" viewBox="0 0 43 43" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M10.4941 3.58398H24.6112C25.2466 3.58398 25.8615 3.80917 26.3467 4.21956L34.8815 11.4385C35.4852 11.9492 35.8334 12.6998 35.8334 13.4905V35.9833C35.8334 39.1913 35.7968 39.4173 32.506 39.4173H10.4941C7.20338 39.4173 7.16675 39.1913 7.16675 35.9833V7.01801C7.16675 3.80996 7.20338 3.58398 10.4941 3.58398Z" fill="#009EF7"/><path fill-rule="evenodd" clip-rule="evenodd" d="M16.0377 24.7523H19.543V28.3494C19.543 28.8442 19.9441 29.2453 20.4389 29.2453H22.2723C22.767 29.2453 23.1681 28.8442 23.1681 28.3494V24.7523H26.6735C27.1682 24.7523 27.5693 24.3513 27.5693 23.8565C27.5693 23.6445 27.4941 23.4394 27.3572 23.2777L22.0393 16.9967C21.7196 16.6191 21.1543 16.5721 20.7767 16.8918C20.7389 16.9238 20.7039 16.9589 20.6719 16.9967L15.354 23.2777C15.0343 23.6552 15.0812 24.2205 15.4588 24.5402C15.6206 24.6772 15.8257 24.7523 16.0377 24.7523Z" fill="#009EF7"/></svg>
                                                    <div class="tulisan">
                                                        <div>Drop files here or click to upload.</div>
                                                        <small class="text-primary">Only allowed upload single file with the format .mp4, new uploaded video will replace existing video</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <video controls style="width:100%; border-radius:10px;">
                                                <source :src="`${form?.show?.video?.link}?token=${token}`">
                                            </video>
                                            <div class="judul">
                                                <h2 class="text-gray-700 mt-5">Thumbnail Video</h2>
                                            </div>
                                            <br>
                                            <div class="dropzone mx-0 bg-light-primary" id="dropzone-thumbnail-video" style="border:1px solid #78CCFB;">
                                                <div class="dz-message needsclick pt-2 d-flex align-items-center">
                                                    <svg width="43" height="43" viewBox="0 0 43 43" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M10.4941 3.58398H24.6112C25.2466 3.58398 25.8615 3.80917 26.3467 4.21956L34.8815 11.4385C35.4852 11.9492 35.8334 12.6998 35.8334 13.4905V35.9833C35.8334 39.1913 35.7968 39.4173 32.506 39.4173H10.4941C7.20338 39.4173 7.16675 39.1913 7.16675 35.9833V7.01801C7.16675 3.80996 7.20338 3.58398 10.4941 3.58398Z" fill="#009EF7"/><path fill-rule="evenodd" clip-rule="evenodd" d="M16.0377 24.7523H19.543V28.3494C19.543 28.8442 19.9441 29.2453 20.4389 29.2453H22.2723C22.767 29.2453 23.1681 28.8442 23.1681 28.3494V24.7523H26.6735C27.1682 24.7523 27.5693 24.3513 27.5693 23.8565C27.5693 23.6445 27.4941 23.4394 27.3572 23.2777L22.0393 16.9967C21.7196 16.6191 21.1543 16.5721 20.7767 16.8918C20.7389 16.9238 20.7039 16.9589 20.6719 16.9967L15.354 23.2777C15.0343 23.6552 15.0812 24.2205 15.4588 24.5402C15.6206 24.6772 15.8257 24.7523 16.0377 24.7523Z" fill="#009EF7"/></svg>
                                                    <div class="tulisan">
                                                        <div>Drop files here or click to upload.</div>
                                                        <small class="text-primary">Only allowed upload single file with the format .png/.jpg/.jpeg</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <img :src="form.show.thumbnail_video" class="mt-3" style="max-width:100%">
                                        </div>
                                    </div>
                                </div>
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
        data(){
            return {
                token: localStorage.getItem('tourism_token'),
                loading: false,
                form: {
                    data: {
                        wording: {
                            id: '',
                            label: '',
                            description: '',
                            radius: '',
                        },
                        fotoKiri: '',
                        fotoKanan: '',
                        video: '',
                        thumbnail_video: '',
                    },
                    show: {
                        fotoKanan: '',
                        fotoKiri: '',
                        video: '',
                        thumbnail_video: '',
                    }
                }
            }
        },
        mounted(){
            // this.getData();
        },
        methods: {
            initDropzone(){
                if(this.form.data.fotoKiri){
                    this.form.data.fotoKiri.destroy();
                }
                this.form.data.fotoKiri = new Dropzone("#dropzone-foto-kiri", {
                    url: "/",
                    dictCancelUpload: "Cancel",
                    maxFilesize: 50,
                    parallelUploads: 100,
                    uploadMultiple: true,
                    maxFiles: 5,
                    addRemoveLinks: true,
                    acceptedFiles: ".jpg,.jpeg,.png",
                    autoProcessQueue: false,
                    paramName: 'files',
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                        Authorization: "Bearer " + localStorage.getItem("tourism_token"),
                    },
                    init: function () {
                        this.on("error", function (file) {
                        if (!file.accepted) {
                            this.removeFile(file);
                            Swal.fire("Silahkan periksa file Anda lagi");
                        } else if (file.status == "error") {
                            this.removeFile(file);
                            Swal.fire("Terjadi kesalahan koneksi");
                        }
                        });
                            this.on("resetFiles", function (file) {
                            this.removeAllFiles();
                        });
                    },
                });

                if(this.form.data.fotoKanan){
                    this.form.data.fotoKanan.destroy();
                }
                this.form.data.fotoKanan = new Dropzone("#dropzone-foto-kanan", {
                    url: "/",
                    dictCancelUpload: "Cancel",
                    maxFilesize: 50,
                    parallelUploads: 100,
                    uploadMultiple: true,
                    maxFiles: 5,
                    addRemoveLinks: true,
                    acceptedFiles: ".jpg,.jpeg,.png",
                    autoProcessQueue: false,
                    paramName: 'files',
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                        Authorization: "Bearer " + localStorage.getItem("tourism_token"),
                    },
                    init: function () {
                        this.on("error", function (file) {
                        if (!file.accepted) {
                            this.removeFile(file);
                            Swal.fire("Silahkan periksa file Anda lagi");
                        } else if (file.status == "error") {
                            this.removeFile(file);
                            Swal.fire("Terjadi kesalahan koneksi");
                        }
                        });
                            this.on("resetFiles", function (file) {
                            this.removeAllFiles();
                        });
                    },
                });

                if(this.form.data.video){
                    this.form.data.video.destroy();
                }
                this.form.data.video = new Dropzone("#dropzone-video", {
                    url: "/",
                    dictCancelUpload: "Cancel",
                    maxFilesize: 50,
                    parallelUploads: 100,
                    uploadMultiple: true,
                    maxFiles: 1,
                    addRemoveLinks: true,
                    acceptedFiles: ".mp4",
                    autoProcessQueue: false,
                    paramName: 'files',
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                        Authorization: "Bearer " + localStorage.getItem("tourism_token"),
                    },
                    init: function () {
                        this.on("error", function (file) {
                        if (!file.accepted) {
                            this.removeFile(file);
                            Swal.fire("Silahkan periksa file Anda lagi");
                        } else if (file.status == "error") {
                            this.removeFile(file);
                            Swal.fire("Terjadi kesalahan koneksi");
                        }
                        });
                            this.on("resetFiles", function (file) {
                            this.removeAllFiles();
                        });
                    },
                });



                if(this.form.data.thumbnail_video){
                    this.form.data.thumbnail_video.destroy();
                }
                this.form.data.thumbnail_video = new Dropzone("#dropzone-thumbnail-video", {
                    url: "/",
                    dictCancelUpload: "Cancel",
                    maxFilesize: 50,
                    parallelUploads: 100,
                    uploadMultiple: true,
                    maxFiles: 1,
                    addRemoveLinks: true,
                    acceptedFiles: ".jpg,.jpeg,.png",
                    autoProcessQueue: false,
                    paramName: 'files',
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                        Authorization: "Bearer " + localStorage.getItem("tourism_token"),
                    },
                    init: function () {
                        this.on("error", function (file) {
                        if (!file.accepted) {
                            this.removeFile(file);
                            Swal.fire("Silahkan periksa file Anda lagi");
                        } else if (file.status == "error") {
                            this.removeFile(file);
                            Swal.fire("Terjadi kesalahan koneksi");
                        }
                        });
                            this.on("resetFiles", function (file) {
                            this.removeAllFiles();
                        });
                    },
                });
            },
            getData(){
                let that = this;

                this.loading = true;
                this.$axios().get('content-page')
                    .then(res => {
                        let data = res?.data?.data;
                        if(data){
                            this.form.data.wording = {
                                id: data?.id,
                                label: data?.label,
                                description: data?.description,
                                radius: data?.radius
                            };
                            this.form.show = {
                                fotoKanan: data?.rightSideAboutFiles,
                                fotoKiri: data?.leftSideAboutFiles,
                                video: data?.videoAboutFiles,
                                thumbnail_video: data.thumbnailVideoAboutFiles ? data.thumbnailVideoAboutFiles.link : ''
                            }
                        }
                    })
                    .catch(err => {
                        this.$axiosHandleError(err);
                    })
                    .then(() => {
                        this.loading = false;
                        setTimeout(function(){
                            that.initDropzone();
                        },200);
                    });
            },
            simpan(){
                let that = this;
                let data = this.form.data.wording;

                if((Number(this?.form?.show?.fotoKiri?.length)+Number(this?.form?.data?.fotoKiri?.files?.length)) > 5){
                    Swal.fire('Pastikan data sudah benar.','File foto kiri maksimal 5','warning');
                    return false;
                }
                if((Number(this?.form?.show?.fotoKanan?.length)+Number(this?.form?.data?.fotoKanan?.files?.length)) > 5){
                    Swal.fire('Pastikan data sudah benar.','File foto kanan maksimal 5','warning');
                    return false;
                }

                this.$ewpLoadingShow();
                this.$axios().put(`content-page`, data)
                    .then(res => {
                        let data = res?.data?.data;
                        if(this.form?.data?.fotoKiri?.files?.length){
                            this.uploadFotoKiri(data?.id);
                        }
                        else if(this.form?.data?.fotoKanan?.files?.length){
                            this.uploadFotoKanan(data?.id);
                        }
                        else if(this.form?.data?.video?.files?.length){
                            this.uploadVideo(data?.id);
                        } else if(that.form?.data?.thumbnail_video?.files?.length){
                            that.uploadThumbnailVideo(data?.id);
                        }
                        else{
                            this.$ewpLoadingHide();
                            Swal.fire('Berhasil','Data berhasil disimpan','success').then(() => {
                                that.getData();
                            });
                        }
                    })
                    .catch(err => {
                        this.$ewpLoadingHide();
                        this.$axiosHandleError(err);
                    })
                    .then(() => {});
            },
            uploadFotoKiri(id){
                let that = this;
                this.form?.data?.fotoKiri.on('processing', function(){
                    this.options.url = urlApi+`content-page/upload-leftside-files/${id}`;
                });
                this.form?.data?.fotoKiri.processQueue();
                this.form?.data?.fotoKiri.on('error', function(){
                    that.$ewpLoadingHide();
                });
                this.form?.data?.fotoKiri.on('success', function(){
                    if(that.form?.data?.fotoKanan?.files?.length){
                        that.uploadFotoKanan(id);
                    }
                    else if(that.form?.data?.video?.files?.length){
                        that.uploadVideo(id);
                    }else if(that.form?.data?.thumbnail_video?.files?.length){
                            that.uploadThumbnailVideo(id);
                    }
                    else{
                        that.$ewpLoadingHide();
                        Swal.fire('Berhasil','Data berhasil disimpan','success').then(() => {
                            that.getData();
                        });
                    }
                });
            },
            uploadFotoKanan(id){
                let that = this;
                this.form?.data?.fotoKanan.on('processing', function(){
                    this.options.url = urlApi+`content-page/upload-rightside-files/${id}`;
                });
                this.form?.data?.fotoKanan.processQueue();
                this.form?.data?.fotoKanan.on('error', function(){
                    that.$ewpLoadingHide();
                });
                this.form?.data?.fotoKanan.on('success', function(){
                    if(that.form?.data?.video?.files?.length){
                        that.uploadVideo(id);
                    }else if(that.form?.data?.thumbnail_video?.files?.length){
                            that.uploadThumbnailVideo(id);
                    }
                    else{
                        that.$ewpLoadingHide();
                        Swal.fire('Berhasil','Data berhasil disimpan','success').then(() => {
                            that.getData();
                        });
                    }
                });
            },
            uploadVideo(id){
                let that = this;
                this.form?.data?.video.on('processing', function(){
                    this.options.url = urlApi+`content-page/upload-video-files/${id}`;
                });
                this.form?.data?.video.processQueue();
                this.form?.data?.video.on('error', function(){
                    that.$ewpLoadingHide();
                });
                this.form?.data?.video.on('success', function(){
                    if(that.form?.data?.thumbnail_video?.files?.length){
                        that.uploadThumbnailVideo(id);
                    }else{
                        that.$ewpLoadingHide();
                            Swal.fire('Berhasil','Data berhasil disimpan','success').then(() => {
                            that.getData();
                        });
                    }
                    
                });
            },
            uploadThumbnailVideo(id){
                let that = this;
                this.form?.data?.thumbnail_video.on('processing', function(){
                    this.options.url = urlApi+`content-page/upload-thumbnail-video-files/${id}`;
                });
                this.form?.data?.thumbnail_video.processQueue();
                this.form?.data?.thumbnail_video.on('error', function(){
                    that.$ewpLoadingHide();
                });
                this.form?.data?.thumbnail_video.on('success', function(){
                    that.$ewpLoadingHide();
                    Swal.fire('Berhasil','Data berhasil disimpan','success').then(() => {
                        that.getData();
                    });
                });
            },
            deleteFile(id){
                let that = this;
                Swal.fire({
                    title: 'Hapus Foto yang Dipilih ?',
                    html: `Foto akan dihapus dari home about dan tidak dapat dikembalikan lagi.`,
                    icon: 'warning',
                    showCancelButton: true,
                    showConfirmButton: true,
                    confirmButtonColor: 'red',
                    cancelButtonColor: 'gray',
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batal',
                }).then(result => {
                    if(result.isConfirmed){
                        that.$ewpLoadingShow();
                        that.$axios().delete(`content-page/delete-file/${id}`)
                            .then(res => {
                                Swal.fire('Berhasil','File berhasi dihapus','success').then(() => {
                                    that.getData();
                                });
                            })
                            .catch(err => {
                                that.$axiosHandleError(err);
                            })
                            .then(() => {
                                that.$ewpLoadingHide();
                            });
                    }
                });
            }
        }
    }
</script>
