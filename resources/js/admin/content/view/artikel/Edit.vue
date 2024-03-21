<template>
    <div id="artikel">
        <div id="main-content">
            <div class="post d-flex flex-column-fluid" id="kt_post">
                <div id="kt_content_container" class="container-xxl">
                    <div class="card card-flush mt-5 mb-5 mb-xl-10" id="kt_profile_details_view">
                        <div class="card card-xl-stretch mb-5 mb-xl-8">
                            <div class="card-header border-0 pt-5 align-items-center">
                                <div class="judul">
                                    <h2 class="text-gray-700">Edit Artikel</h2>
                                    <span class="text-gray-700">Edit artikel pada aplikasi Tourism Surabaya - Disbudporapar Kota Surabaya</span>
                                </div>
                                <div class="button d-flex">
                                    <button class="btn btn-secondary" @click="$router.back()">
                                        <svg width="16" height="10" viewBox="0 0 16 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5.96839 8.82451L5.5 9.29289L1.20711 5L5.5 0.707107L5.96839 1.17549L3.33762 3.81361L2.48694 4.66667H3.69167H15V5.33333H3.69167H2.48694L3.33762 6.18639L5.96839 8.82451Z" fill="black" stroke="#0E5CA8"/></svg>
                                        Kembali
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="loader d-flex align-items-center justify-content-center" v-if="loading"><app-loader></app-loader></div>
                                <div class="konten" v-else>
                                    <div class="row wrap-heading">
                                        <div class="col-md-8">
                                            <div class="judul">
                                                <label for="title">Judul</label>
                                                <input v-model="form.data.title" type="text" id="title" class="form-control" placeholder="Masukkan judul artikel">
                                            </div>
                                            <br>
                                            <div class="heading">
                                                <label for="heading">Heading</label>
                                                <input v-model="form.data.heading" type="text" id="heading" class="form-control" placeholder="Masukkan judul artikel">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <span>Thumbnail</span>
                                            <div class="dropzone bg-light-primary" id="dropzone-thumbnail" style="background-color:lightgray !important; border:none; height:100%; position:relative;">
                                                <div class="dz-message needsclick pt-2 d-flex align-items-center" style="height:100%;">
                                                    <div class="tulisan d-flex align-items-center justify-content-center text-center" style="width:100% !important; height:100% !important;">
                                                        Belum ada thumbnail, klik untuk menambah thumbnail
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br><br>
                                    <QuillEditor theme="snow" :toolbar="toolbarOptions" v-model:content="form.data.description" contentType="html"/>
                                    <!-- <editor :api-key="tinyApiKey" v-if="initTiny" v-model="form.data.description"
                                    :init="initTiny" /> -->
                                    <!-- <app-tinymce v-model="form.data.description" :init="initTiny"></app-tinymce> -->
                                    <br><br>
                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                        <button class="btn btn-success btn-sm" @click="simpan()">Update Artikel</button>
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


import Editor from '@tinymce/tinymce-vue'
    export default {
        components: {
            'editor': Editor
        },
        data(){
            return {
                tinyApiKey: import.meta.env.VITE_API_KEY_EDITOR,
                token: localStorage.getItem('tourism_token'),
                assetUrl: assetUrl,
                loading: false,
                initTiny:null,
                toolbarOptions: [
                    ['bold', 'italic', 'underline', 'strike'],        // toggled buttons

                    [{ 'header': 1 }, { 'header': 2 }],               // custom button values
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
                    [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
                    [{ 'direction': 'rtl' }],                         // text direction

                    [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
                    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

                    [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
                    [{ 'font': [] }],
                    [{ 'align': [] }],
                    ['image'],
                    ['clean']                                         // remove formatting button
                ],
                form: {
                    previewThumbnail: '',
                    thumbnail: '',
                    data: {
                        title: '',
                        heading: '',
                        description: ''
                    }
                },               
            }
        },
        mounted(){            
            let that = this;
            this.initTiny = {
                height: 400,
                plugins: 'table image fullscreen lists wordcount advlist link',
                toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | table tabledelete | tableprops tablerowprops tablecellprops | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol',
                image_uploadtab: true,
                images_upload_handler: function (blobInfo, success, failure) {
                    var xhr, formData;
                    xhr = new XMLHttpRequest();
                    xhr.open('POST', urlApi + 'helper/convert-to-base64 ');
                    xhr.onload = function () {
                        var json;
                        if (xhr.status != 200) {
                            alert('Gagal Coba Lagi');
                            return;
                        }
                        
                        json = JSON.parse(xhr.responseText);                        
                        success(json.data);
                    };
                    formData = new FormData();
                    formData.append('file', blobInfo.blob(), blobInfo.filename());
                    xhr.send(formData);
                },
            }
            this.getData();
        },
        methods: {
            initDropzone(data = ''){
                let that = this;
                if(this.form.thumbnail){
                    this.form.thumbnail.destroy();
                }

                let initialFile = `${data?.link}?token=${this.token}`;
                let mockFile = { name: data?.name, size: data?.size };
                this.form.thumbnail = new Dropzone("#dropzone-thumbnail", {
                    url: "/",
                    dictCancelUpload: "Cancel",
                    maxFilesize: 50,
                    parallelUploads: 100,
                    uploadMultiple: false,
                    maxFiles: 1,
                    addRemoveLinks: true,
                    acceptedFiles: ".jpg,.jpeg,.png,.gif",
                    autoProcessQueue: false,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                        Authorization: "Bearer " + localStorage.getItem("tourism_token"),
                    },
                    init: function () {
                        this.emit("addedfile", mockFile);
                        this.emit("thumbnail", mockFile, initialFile);
                        this.emit("complete", mockFile);
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
                this.$axios().get(`article/${this?.$route?.params?.id}`)
                    .then(res => {
                        let data = res?.data?.data;
                        this.form.previewThumbnail = data?.articleThumbnail;
                        this.form.data = {
                            title: data?.title,
                            heading: data?.heading,
                            description: data?.description
                        }
                    })
                    .catch(err=>{
                        this.$axiosHandleError(err);
                    })
                    .then(() => {
                        this.loading = false;
                        setTimeout(function(){
                            that.initDropzone(that?.form?.previewThumbnail);
                        },200);
                    });
            },
            simpan(){
                let that = this;

                this.$ewpLoadingShow();
                this.$axios().put(`article/${this?.$route?.params?.id}`, this.form?.data)
                    .then(res => {
                        let data = res?.data?.data;
                        if(this?.form?.thumbnail?.files?.length){
                            this.uploadFile(data?.id);
                        }
                        else{
                            this.$ewpLoadingHide();
                            Swal.fire('Berhasil','Data berhasil disimpan','success').then(()=>{
                                that.$router.push({name: 'a-artikel'});
                            });
                        }
                    })
                    .catch(err=> {
                        this.$ewpLoadingHide();
                        this.$axiosHandleError(err);
                    });
            },
            uploadFile(id){
                let that = this;
                this.form.thumbnail.on('processing', function(){
                    this.options.url = urlApi+`article/upload-thumbnail/${id}`;
                });
                this.form.thumbnail.processQueue();
                this.form.thumbnail.on('error', function(){
                    that.$ewpLoadingHide();
                });
                this.form.thumbnail.on('success', function(){
                    that.$ewpLoadingHide();
                    Swal.fire('Berhasil','Data berhasil disimpan','success').then(()=>{
                        that.$router.push({name: 'a-artikel'});
                    });
                });
            }
        },
    }
</script>

<style scoped>
    #artikel >>> .dz-preview{
        position:absolute;
        top:0;
        right:0;
        left:0;
        bottom:0;
    }
    #artikel >>> .dz-preview .dz-image{
        width:100% !important;
        height:100% !important;
    }
    #artikel >>> .dz-preview .dz-image img{
        width:100% !important;
        height:100% !important;
        object-fit: cover !important;
    }
    #artikel >>> .dz-preview a.dz-remove{
        background-color:#D45774 !important;
        color:white !important;
        fill: white !important;
    }
</style>

