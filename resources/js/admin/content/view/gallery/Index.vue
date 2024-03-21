<template>
    <div>
        <div id="main-content">
            <div class="post d-flex flex-column-fluid" id="kt_post">
                <div id="kt_content_container" class="container-xxl">
                    <div class="card card-flush mt-5 mb-5 mb-xl-10" id="kt_profile_details_view">
                        <div class="card card-xl-stretch mb-5 mb-xl-8">
                            <div class="card-header border-0 pt-5 align-items-center">
                                <div class="judul">
                                    <h2 class="text-gray-700">Gallery</h2>
                                    <span class="text-gray-700">Daftar galley pada aplikasi Tourism Surabaya - Disbudporapar Kota Surabaya</span>
                                </div>
                                <div class="button d-flex">
                                    <button class="btn btn-success btn-sm" @click="modalTambah()">Tambah Data</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="loader d-flex justify-content-center align-items-center" v-if="loading"><app-loader></app-loader></div>
                                <div class="konten" v-else>
                                    <div class="wrap-gallery d-flex py-5" id="wrap-gallery" style="background-color:white; width:100%;">
                                        <template v-for="(context,index) in gallery">
                                            <div class="gallery d-flex flex-column mx-2" style="flex: 1 !important;">
                                                <div v-for="(val, i) in  context" class="wrap-gambar p-2 m-2" style="border-radius:10px; box-shadow:0px 0px 5px lightgray; width:100%; position:relative;">
                                                    <a class="fancybox" :href="`${val?.link}?token=${token}&preview=1`" data-fancybox="gallery" fancybox="gallery">
                                                        <img @error="$setNoImageUrl" v-if="val?.fileType == 'photo'" :src="`${val?.link}?token=${token}&preview=1`" style=" border-radius:10px; width:100%;" alt="">
                                                        <video v-else controls style="width:100%;">
                                                            <source :src="`${val?.link}?token=${token}`">
                                                        </video>
                                                    </a>
                                                    <div @click="deleteFile(val?.id)" style="background-color:white; position:absolute; right:20px; bottom:20px; border-radius:5px; cursor:pointer;"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16 9V19H8V9H16ZM14.5 3H9.5L8.5 4H5V6H19V4H15.5L14.5 3ZM18 7H6V19C6 20.1 6.9 21 8 21H16C17.1 21 18 20.1 18 19V7Z" fill="#F1416C"/></svg></div>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" id="modal-tambah" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="m-auto" style="width:100%;">
                            <div class="d-flex flex-column justify-content-center align-items-center">
                                <h1 class="modal-title text-gray-700">Tambah Aset Gallery</h1>
                                <span class="text-gray-700 mt-3">Silahkan lengkapi form berikut untuk menambahkan data.</span>
                            </div>
                        </div>
                        <!--begin::Close-->
                        <button type="button" class="btn-close m-2" data-bs-dismiss="modal" aria-label="Close"></button>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body">
                        <div class="file">
                            <div class="my-2">Tipe</div>
                            <div class="wrap-button">
                                <button :class="`btn ${form?.isFoto ? 'btn-light-success' : 'btn-secondary btn-tipe'} btn-sm me-3`" @click="form.isFoto = true">Photos</button>
                                <button :class="`btn ${!form?.isFoto ? 'btn-light-success' : 'btn-secondary btn-tipe'} btn-sm`" @click="form.isFoto = false">Videos</button>
                            </div>
                            <br>
                            <div v-show="form?.isFoto" class="dropzone bg-light-primary" id="dropzone-foto" style="border:1px solid #78CCFB;">
                                <div class="dz-message needsclick pt-2 d-flex align-items-center">
                                    <svg width="43" height="43" viewBox="0 0 43 43" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M10.4941 3.58398H24.6112C25.2466 3.58398 25.8615 3.80917 26.3467 4.21956L34.8815 11.4385C35.4852 11.9492 35.8334 12.6998 35.8334 13.4905V35.9833C35.8334 39.1913 35.7968 39.4173 32.506 39.4173H10.4941C7.20338 39.4173 7.16675 39.1913 7.16675 35.9833V7.01801C7.16675 3.80996 7.20338 3.58398 10.4941 3.58398Z" fill="#009EF7"/><path fill-rule="evenodd" clip-rule="evenodd" d="M16.0377 24.7523H19.543V28.3494C19.543 28.8442 19.9441 29.2453 20.4389 29.2453H22.2723C22.767 29.2453 23.1681 28.8442 23.1681 28.3494V24.7523H26.6735C27.1682 24.7523 27.5693 24.3513 27.5693 23.8565C27.5693 23.6445 27.4941 23.4394 27.3572 23.2777L22.0393 16.9967C21.7196 16.6191 21.1543 16.5721 20.7767 16.8918C20.7389 16.9238 20.7039 16.9589 20.6719 16.9967L15.354 23.2777C15.0343 23.6552 15.0812 24.2205 15.4588 24.5402C15.6206 24.6772 15.8257 24.7523 16.0377 24.7523Z" fill="#009EF7"/></svg>
                                    <div class="tulisan">
                                        <div>Drop files here or click to upload.</div>
                                        <small class="text-primary">Allowed to upload multiple photos with the format .jpg/.jpeg/.png/.webp</small>
                                    </div>
                                </div>
                            </div>
                            <div v-show="!form?.isFoto" class="dropzone bg-light-primary" id="dropzone-video" style="border:1px solid #78CCFB;">
                                <div class="dz-message needsclick pt-2 d-flex align-items-center">
                                    <svg width="43" height="43" viewBox="0 0 43 43" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M10.4941 3.58398H24.6112C25.2466 3.58398 25.8615 3.80917 26.3467 4.21956L34.8815 11.4385C35.4852 11.9492 35.8334 12.6998 35.8334 13.4905V35.9833C35.8334 39.1913 35.7968 39.4173 32.506 39.4173H10.4941C7.20338 39.4173 7.16675 39.1913 7.16675 35.9833V7.01801C7.16675 3.80996 7.20338 3.58398 10.4941 3.58398Z" fill="#009EF7"/><path fill-rule="evenodd" clip-rule="evenodd" d="M16.0377 24.7523H19.543V28.3494C19.543 28.8442 19.9441 29.2453 20.4389 29.2453H22.2723C22.767 29.2453 23.1681 28.8442 23.1681 28.3494V24.7523H26.6735C27.1682 24.7523 27.5693 24.3513 27.5693 23.8565C27.5693 23.6445 27.4941 23.4394 27.3572 23.2777L22.0393 16.9967C21.7196 16.6191 21.1543 16.5721 20.7767 16.8918C20.7389 16.9238 20.7039 16.9589 20.6719 16.9967L15.354 23.2777C15.0343 23.6552 15.0812 24.2205 15.4588 24.5402C15.6206 24.6772 15.8257 24.7523 16.0377 24.7523Z" fill="#009EF7"/></svg>
                                    <div class="tulisan">
                                        <div>Drop files here or click to upload.</div>
                                        <small class="text-primary">Allowed to upload multiple videos with the format .mp4</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center align-items-center">
                        <button class="btn btn-secondary btn-sm me-4" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-sm btn-success me-4" @click="upload()">Upload</button>
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
                assetUrl: assetUrl,
                loading: false,
                gallery: [],
                form: {
                    isFoto: true,
                    data: {
                        foto: '',
                        video: ''
                    },
                }
            }
        },
        mounted(){
            this.getData();
        },
        methods: {
            initDropzone(){
                if(this.form.data.foto){
                    this.form.data.foto.destroy();
                    $('.dz-preview.dz-complete.dz-image-preview').remove();
                }
                this.form.data.foto = new Dropzone("#dropzone-foto", {
                    url: "/",
                    dictCancelUpload: "Cancel",
                    maxFilesize: 50,
                    parallelUploads: 100,
                    uploadMultiple: true,
                    maxFiles: 100,
                    addRemoveLinks: true,
                    acceptedFiles: ".jpg,.jpeg,.png,.webp,.svg",
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
                    maxFiles: 100,
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
            },
            getData(){
                let that = this;

                this.loading = true;
                this.$axios().get(`gallery`)
                    .then(res => {
                        let data = res?.data?.data;
                        this.gallery = [[],[],[],[],[]];
                        if(data?.length){
                            let tampung = [];
                            let index = 0;
                            $.each(data, function(i,val){
                                that.gallery[index].push(val);
                                index++;
                                if((Number(i)+1) % 5 == 0){
                                    index = 0;
                                }
                            });
                        }
                    })
                    .catch(err => {                     
                        this.$axiosHandleError(err);
                    })
                    .then(() => {
                        this.loading = false;
                    });
            },
            modalTambah(){
                this.initDropzone();
                $('#modal-tambah').modal('show');
            },
            upload(){
                if(this?.form?.data?.foto?.files?.length){
                    this.uploadFoto();
                }
                else if(this?.form?.data?.video?.files?.length){
                    this.uploadVideo();
                }
                else{
                    toastr.error('Isi file di salah satu form upload!');
                    return false;
                }
            },
            uploadFoto(){
                let that = this;
                this.$ewpLoadingShow();
                this.form?.data?.foto.on('processing', function(){
                    this.options.url = urlApi+`gallery/upload-photos`;
                });
                this.form?.data?.foto.processQueue();
                this.form?.data?.foto.on('error', function(){
                    that.$ewpLoadingHide();
                });
                this.form?.data?.foto.on('success', function(){
                    if(that.form?.data?.video?.files?.length){
                        that.uploadVideo();
                    }
                    else{
                        that.$ewpLoadingHide();
                        $('.modal').modal('hide');
                        Swal.fire('Berhasil','Data berhasil disimpan','success').then(() => {
                            that.getData();
                        });
                    }
                });
            },
            uploadVideo(){
                let that = this;
                this.$ewpLoadingShow();
                this.form?.data?.video.on('processing', function(){
                    this.options.url = urlApi+`gallery/upload-videos`;
                });
                this.form?.data?.video.processQueue();
                this.form?.data?.video.on('error', function(){
                    that.$ewpLoadingHide();
                });
                this.form?.data?.video.on('success', function(){
                    that.$ewpLoadingHide();
                    $('.modal').modal('hide');
                    Swal.fire('Berhasil','Data berhasil disimpan','success').then(() => {
                        that.getData();
                    });
                });
            },
            deleteFile(id){
                let that = this;
                Swal.fire({
                    title: 'Hapus Foto yang Dipilih ?',
                    html: `Foto akan dihapus dari gallery dan tidak dapat dikembalikan lagi.`,
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
                        that.$axios().delete(`gallery/delete-file/${id}`)
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

<style scoped>
    .btn-light-success{
        border:1px solid #50cd89 !important;
        border-radius:12px;
    }
    .btn-secondary.btn-tipe{
        border-radius:12px;
        background-color:white !important;
        border:1px solid lightgray  !important;
    }
</style>
