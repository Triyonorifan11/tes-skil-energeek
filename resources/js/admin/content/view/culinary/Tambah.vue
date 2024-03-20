<template>
    <div>
        <div id="main-content">
            <div class="post d-flex flex-column-fluid" id="kt_post">
                <div id="kt_content_container" class="container-xxl">
                    <div class="card card-flush mt-5 mb-5 mb-xl-10" id="kt_profile_details_view">
                        <div class="card card-xl-stretch mb-5 mb-xl-8">
                            <div class="card-header border-0 pt-5 align-items-center">
                                <div class="judul">
                                    <h2 class="text-gray-700">Tambah Eat & Drink</h2>
                                    <span class="text-gray-700">Lengkapi form dibawah ini untuk menambah eat & drink</span>
                                </div>
                                <div class="button d-flex">
                                    <button class="btn btn-secondary" @click="$router.back()">
                                        <svg width="16" height="10" viewBox="0 0 16 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5.96839 8.82451L5.5 9.29289L1.20711 5L5.5 0.707107L5.96839 1.17549L3.33762 3.81361L2.48694 4.66667H3.69167H15V5.33333H3.69167H2.48694L3.33762 6.18639L5.96839 8.82451Z" fill="black" stroke="#0E5CA8"/></svg>
                                        Kembali
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="info-global">
                                    <div class="card" style="border:2px dashed lightgray;">
                                        <div class="card-body">
                                            <div class="button-bahasa">
                                                <template v-for="(context, index) in form?.data?.culinaries">
                                                    <button :class="`btn btn-outline-success me-5 my-3 ${context?.language?.id == form?.langSelectedId ? 'active' : ''}`" style="position:relative;" @click="clickActiveLanguage(context?.language?.id)">
                                                        <button class="btn-close-lang" v-if="index != 0" @click="removeCulinaries(index)">x</button>
                                                        {{ context?.language?.text || 'Pilih bahasa' }}
                                                    </button>
                                                </template>
                                                <button class="btn btn-outline-success" :disabled="form.data.culinaries.findIndex(value => !value?.language?.id) != -1 ? true : false" @click="addCulinaries">
                                                    <svg width="20" height="19" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10.0001 9.50008H1.66675M10.0001 1.16675V9.50008V1.16675ZM10.0001 9.50008V17.8334V9.50008ZM10.0001 9.50008H18.3334H10.0001Z" stroke="#049C4F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                                    Tambah
                                                </button>
                                            </div>
                                            <br>
                                            <template v-for="(context, index) in form?.data?.culinaries">
                                                <template v-if="form.langSelectedId == context?.language?.id">
                                                    <div class="div-select-bahasa">
                                                        <label for="lang">Bahasa</label>
                                                        <app-select2 id="lang" v-model="context.language" :disabled="index == 0" :options="selectList.language.list" :loading="selectList.language.loading" @get-options="getLanguage" placeholder="Pilih bahasa" @change-options="changeLanguage" :multiple="false"></app-select2>
                                                    </div>
                                                    <br>
                                                    <label for="desc">Deskripsi</label>
                                                    <QuillEditor theme="snow" :toolbar="toolbarOptions" v-model:content="context.description" contentType="html"/>
                                                    <!-- <app-tinymce v-model="context.description"></app-tinymce> -->
                                                </template>
                                            </template>
                                        </div>
                                    </div>
                                    <br>
                                    <span>Foto</span>
                                    <div class="foto d-flex align-items-center my-4" style="flex-wrap:wrap;">
                                            <div v-for="(context,index) in dropzoneFileFiles" class="item-foto me-5 my-5" style="border-radius:10px; width:115px; height:105px; background-color:transparent; position:relative;">
                                                <img :id="`image-item-${index}`" :src="context.dataURL" style="width:100%; height:100%; border-radius:10px; object-fit:cover !important;" alt="item">
                                                <div class="wrap-tumbl p-1" style="background-color:white; border-radius:20px; position:absolute !important; margin-top:-40%; margin-right:-50px;">
                                                    <div class="form-check form-check-custom form-check-solid d-flex align-itemx-center">
                                                        <label class="form-check-label me-2" :for="`type-file-${index}`">Thumbnail</label>
                                                        <input v-model="indexFileThumbnails" class="form-check-input" name="is_tumbnail" type="radio" :value="index" :id="`type-file-${index}`"/>
                                                    </div>
                                                </div>
                                                <button class="close-item-foto" @click="removeImageItem(index)" style="border-radius:100%; height:20px; width:20px; color:white; background-color:red; display:flex; justify-content: center; align-items:center; position:absolute; top:0; right:0; margin-right:-7px; margin-top:-10px; border:none;">x</button>
                                            </div>
                                        <div class="dropzone" id="dropzoe-file" style="border:1px dashed green; background-color:#E8FFF3; border-radius: 10px !important; width:115px; height:105px;">
                                            <div class="dz-message needsclick pt-2 d-flex align-items-center justify-content-center">
                                                <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M32.25 9.75H27.495L24.75 6.75H15.75V9.75H23.43L26.175 12.75H32.25V30.75H8.25V17.25H5.25V30.75C5.25 32.4 6.6 33.75 8.25 33.75H32.25C33.9 33.75 35.25 32.4 35.25 30.75V12.75C35.25 11.1 33.9 9.75 32.25 9.75ZM12.75 21.75C12.75 25.89 16.11 29.25 20.25 29.25C24.39 29.25 27.75 25.89 27.75 21.75C27.75 17.61 24.39 14.25 20.25 14.25C16.11 14.25 12.75 17.61 12.75 21.75ZM20.25 17.25C22.725 17.25 24.75 19.275 24.75 21.75C24.75 24.225 22.725 26.25 20.25 26.25C17.775 26.25 15.75 24.225 15.75 21.75C15.75 19.275 17.775 17.25 20.25 17.25ZM8.25 9.75H12.75V6.75H8.25V2.25H5.25V6.75H0.75V9.75H5.25V14.25H8.25V9.75Z" fill="#049C4F"/></svg>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="name">Nama Tempat</label>
                                            <input v-model="form.data.name" id="name" type="text" class="form-control" placeholder="Masukkan nama tempat">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="category">Kategori</label>
                                            <app-select2 id="category" v-model="form.data.category" :loading="selectList.category.loading" :options="selectList?.category?.list" @get-options="getCategory" placeholder="Pilih kategori" :multiple="true"></app-select2>
                                        </div>
                                    </div>
                                    <br>
                                    <label for="address">Alamat</label>
                                    <textarea v-model="form.data.address" id="address" rows="5" class="form-control" placeholder="Masukkan alamat lengkap"></textarea>
                                    <br>
                                    <div class="open">
                                        <span>Jam Buka</span>
                                        <div class="card" style="border:1px dashed green;">
                                            <div class="card-body">
                                                <div class="row my-3" v-for="(context, index) in form.data.openingHours">
                                                    <div class="col-md-4">
                                                        <input v-model="context.day" type="text" class="form-control" placeholder="Contoh: Senin">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <app-datepicker v-model:value="context.startTime" type="time" input-class="form-control" input-style="width:100%;" format="HH:mm:ss" value-type="HH:mm:ss" placeholder="Jam mulai"></app-datepicker>
                                                    </div>
                                                    <div class="col-md-1 d-flex align-items-center justify-content-center">s/d</div>
                                                    <div class="col-md-3">
                                                        <app-datepicker v-model:value="context.endTime" type="time" input-class="form-control" input-style="width:100%;" format="HH:mm:ss" value-type="HH:mm:ss" placeholder="Jam Tutup"></app-datepicker>
                                                    </div>
                                                    <div class="col-md-1 d-flex justify-content-center align-items-center">
                                                        <button class="btn btn-light-danger btn-sm" v-if="index > 0" @click="removeOpening(index)">
                                                            <i class="bi bi-trash fa-2x"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-outline-success active my-2" @click="addOpening">
                                            <svg width="20" height="19" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10.0001 9.50008H1.66675M10.0001 1.16675V9.50008V1.16675ZM10.0001 9.50008V17.8334V9.50008ZM10.0001 9.50008H18.3334H10.0001Z" stroke="#049C4F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                            Tambah Jam Buka
                                        </button>
                                    </div>
                                    <br>
                                    <div class="wrap-maps">
                                        <div id="" class="" style="position:static !important;">
                                            <div id="pac-container flex" style="position:relative !important;">
                                                <div class="flex">
                                                    <input id="pac-input" v-model="map.map_search" type="text" placeholder="Cari Lokasi...">
                                                </div>
                                            </div>
                                            <div class="mb-2" style="top:0;" id="map"></div>
                                            <div class="text-gray-700 pb-5" style="font-size:12px;">Note:
                                                Drag & Drop marker untuk mengganti titik lokasi
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="latitude">Latitude</label>
                                                <input v-model="map.playload.latitude" type="text" disabled class="form-control" placeholder="Latitude">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="longitude">Longitude</label>
                                                <input v-model="map.playload.longitude" type="text" disabled class="form-control" placeholder="Longitude">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="web">Website Official(opsional)</label>
                                            <input v-model="form.data.websiteLink" id="web" type="text" class="form-control" placeholder="cth:https://www.google.com/">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="phone">No Telepon</label>
                                            <input v-model="form.data.phone" id="phone" type="text" class="form-control" placeholder="Masukkan no telp">
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="btn-simpan d-flex justify-content-center align-items-center">
                                        <button class="btn btn-success btn-sm" @click="simpan()">Simpan Data</button>
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
                assetUrl: assetUrl,
                selectList: {
                    language: {
                        loading: false,
                        list: []
                    },
                    category: {
                        loading: false,
                        list: []
                    },
                    jurisdiction: {
                        loading: false,
                        list: []
                    },
                },
                dropzoneFile: '',
                dropzoneFileFiles: '',
                indexFileThumbnails: '',
                map: {
                    playload: {
                        latitude: '',
                        longitude: '',
                    },
                    surabaya: {
                        lat: -7.250445,
                        lng: 112.768845,
                    },
                    map: null,
                    marker: null,
                    map_search:'',
                },
                form: {
                    isEdit: false,
                    idEdit: '',
                    data: {
                        photos: [
                            {
                                file: '',
                                fileType: ''
                            }
                        ],
                        category: [],
                        categories: [],
                        openingHours: [
                            {
                                day: '',
                                startTime: '',
                                endTime: ''
                            }
                        ],
                        name: '',
                        address: '',
                        latitude:'',
                        longitude: '',
                        phone: '',
                        websiteLink: '',
                        langSelectedId: '',
                        culinaries: [
                            {
                                language: {id: VITE_INDONESIAN_LANGUAGE_ID, code: 'ID', text: 'Indonesia'},
                                languangeId: '',
                                description: '',
                            }
                        ],
                    },
                },
                money3: {
                    masked: false,
                    prefix: '',
                    suffix: '',
                    thousands: '.',
                    decimal: ',',
                    precision: 0,
                    disableNegative: false,
                    disabled: false,
                    min: null,
                    max: null,
                    allowBlank: true,
                    minimumNumberOfCharacters: 0,
                },
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
            }
        },
        mounted(){
            let that = this;
            this.initDropzone();
            this.initMap();
            this.dropzoneFile.on('addedfile',function(){
                that.dropzoneFileFiles = [];
                that.dropzoneFileFiles = that.dropzoneFile.files;
                setTimeout(function(){
                    that.dropzoneFileFiles = [];
                    that.dropzoneFileFiles = that.dropzoneFile.files;
                    $('.dropzone .dz-preview').remove();
                },500);
                setTimeout(function(){
                    that.dropzoneFileFiles = [];
                    that.dropzoneFileFiles = that.dropzoneFile.files;
                    $('.dropzone .dz-preview').remove();
                },1000);
                setTimeout(function(){
                    that.dropzoneFileFiles = [];
                    that.dropzoneFileFiles = that.dropzoneFile.files;
                    $('.dropzone .dz-preview').remove();
                },2000);
            });
        },
        methods: {
            clickActiveLanguage(id){
                this.form.langSelectedId = id;
            },
            addCulinaries(){
                this?.form?.data?.culinaries?.push({
                    language: '',
                    languangeId: '',
                    description: '',
                });
            },
            removeCulinaries(index){
                this.form?.data?.culinaries?.splice(index,1);
            },
            getLanguage(search, limit){
                let that = this;

                this.selectList.language.loading = true;
                this.$axios().get(`select-list/language?search=${search}&limit=${limit}`)
                    .then(res => {
                        let data = res?.data?.data;
                        this.selectList.language.list = [];
                        $.each(data, function(i,val){
                            let findExist = that.form.data.culinaries?.findIndex(value => value?.language?.id == val?.id);
                            if(findExist == -1){
                                that.selectList.language.list.push({id: val?.id, code: val?.code, text: val?.name});
                            }
                        });
                    })
                    .catch(err => {
                        this.$axiosHandleError(err);
                    })
                    .then(() => {
                        this.selectList.language.loading = false;
                    });
            },
            changeLanguage(data){
                this.form.langSelectedId = data?.id;
            },
            initDropzone(){
                let that = this;
                if(this.dropzoneFile){
                    this.dropzoneFile.destroy();
                }

                this.dropzoneFile = new Dropzone("#dropzoe-file", {
                    url: "/",
                    dictCancelUpload: "Cancel",
                    maxFilesize: 50,
                    parallelUploads: 100,
                    uploadMultiple: true,
                    maxFiles: 100,
                    addRemoveLinks: true,
                    acceptedFiles: ".jpg,.jpeg,.png,.gif",
                    autoProcessQueue: false,
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
            initMap() {
                this.map.playload.latitude = this.map.surabaya.lat;
                this.map.playload.longitude = this.map.surabaya.lng;

                var options = {
                    zoom: 10,
                    center: this.map.surabaya
                }
                this.map.map = new google.maps.Map(document.getElementById('map'), options);

                const card = document.getElementById('pac-card');
                const input = document.getElementById('pac-input');


                this.map.map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

                const autocomplete = new google.maps.places.Autocomplete(input);


                const latLng = new google.maps.LatLng(this.map.surabaya.lat, this.map.surabaya.lng);

                this.map.marker = new google.maps.Marker({
                    map: this.map.map,
                    position: latLng,
                    draggable: true,
                });

                const that = this;

                google.maps.event.addListener(that.map.marker, 'dragend', function () {
                    that.map.playload.latitude = that.map.marker.getPosition().lat();
                    that.map.playload.longitude = that.map.marker.getPosition().lng();
                });

                google.maps.event.addListener(that.map.map, 'click', function (event) {
                    that.map.marker.setPosition(event.latLng);
                    that.map.playload.latitude = event.latLng.toJSON().lat;
                    that.map.playload.longitude = event.latLng.toJSON().lng;
                });

                autocomplete.addListener('place_changed', function () {
                    const place = autocomplete.getPlace();
                    if (!place.geometry) {
                        return false;
                    }
                    that.map.marker.setVisible(false);
                    that.map.map_search = place.formatted_address;
                    that.map.map.fitBounds(place.geometry.viewport);
                    that.map.marker.setPosition(place.geometry.location);
                    that.map.marker.setVisible(true);

                    that.map.playload.latitude = place.geometry.location.lat();
                    that.map.playload.longitude = place.geometry.location.lng();
                });

            },
            getCategory(search, limit){
                let that = this;

                this.selectList.category.loading = true;
                this.$axios().get(`select-list/culinary-category?search=${search}&limit=${limit}`)
                    .then(res => {
                        let data = res?.data?.data;
                        this.selectList.category.list = [];
                        $.each(data, function(i,val){
                            that.selectList.category.list.push({id: val?.id, text: val?.name});
                        });
                    })
                    .catch(err => {
                        this.$axiosHandleError(err);
                    })
                    .then(() => {
                        this.selectList.category.loading = false;
                    });
            },
            addOpening(){
                this.form.data.openingHours.push({
                    day: '',
                    startTime: '',
                    endTime: ''
                });
            },
            removeOpening(index){
                this.form.data.openingHours.splice(index,1);
            },
            removeImageItem(index){
                this.dropzoneFile.files.splice(index,1);
                this.dropzoneFileFiles = [];
                this.dropzoneFileFiles = this.dropzoneFile.files;
            },
            simpan(){
                let that = this;
                let data = this.form.data;
                data.latitude = this.map.playload.latitude;
                data.longitude = this.map.playload.longitude;
                data.categories = [];
                $.each(data.category, function(i,val){
                    data.categories.push(val?.id);
                });
                $.each(data?.culinaries, function(i,val){
                    val.languageId=val?.language?.id;
                });

                if(!this.dropzoneFileFiles.length){
                    Swal.fire('Harap isi dengan benar.','File foto wajib di isi','warning');
                    return false;
                }

                this.$ewpLoadingShow();
                this.$axios().post(`culinary`,data)
                .then(res => {
                    let data = res?.data?.data;
                    this.uploadFile(data?.id);
                })
                .catch(err => {
                    this.$ewpLoadingHide();
                    this.$axiosHandleError(err);
                })
                .then(() => {});
            },
            uploadFile(id){
                let that = this;
                let formData = new FormData();
                $.each(this.dropzoneFileFiles, function(i, val){
                    formData.append(`photos[${i}][file]`, val);
                    if(i == that.indexFileThumbnails){
                        formData.append(`photos[${i}][fileType]`, 'thumbnail');
                    }
                    else{
                        formData.append(`photos[${i}][fileType]`, 'gallery');
                    }
                });

                this.$axios().post(`culinary/upload-file/${id}`,formData)
                    .then(res => {
                        Swal.fire('Berhasil','Data berhasil disimpan','success').then(result => {
                            that.$router.push({name: 'a-culinary'});
                        });
                    })
                    .catch(err => {
                        this.$axiosHandleError(err);
                        this.$router.push({name: 'a-culinary'});
                    })
                    .then(() => {
                        this.$ewpLoadingHide();
                    });
            }
        },
    }
</script>

<style scoped>
    .table-pomdes table thead,.table-pomdes table tbody,.table-pomdes table tr td,.table-pomdes table tr th{
        border:1px solid black !important;
    }
    .table-pomdes table tr td,.table-pomdes table tr th{
        padding:10px !important;
    }
    .form-check-custom.form-check-solid .form-check-input:checked{
        background-color: #50CD89;
    }

    .dropzone{
        position:relative !important;
    }

    .dropzone .dz-preview.dz-image-preview{
        display:none !important;
        position:relative !important;
        top:0;
        left:0;
        margin-left:-1px;
        margin-top:0px;
        background-color: transparent !important;
    }
    .dropzone .dz-preview.dz-image-preview .dz-image{
        border-radius:10px !important;
        z-index:0 !important;
        background-color: transparent !important;
        width:115px;
        height:105px;
    }
    .dropzone .dz-preview.dz-image-preview .dz-image img[data-dz-thumbnail]{
        object-fit: cover !important;
        width: 100%;
        height: 100%;
    }
    .dz-preview.dz-image-preview .dz-details{
        background-color: transparent !important;
    }

    .btn-outline-success.active{
        border:1px solid #3DB578 !important;
        background-color:#F1FAFF !important;
        color:#3DB578 !important;
    }
    .btn-outline-success{
        border:1px solid #3DB578 !important;
        color:#3DB578 !important;
    }
    .btn-close-lang{
        position:absolute;
        top:0;
        right:0;
        border-radius:100%;
        width:20px;
        height:20px;
        border:none;
        color:white;
        background-color:red;
        margin-top:-15px;
        margin-right:-10px;
        display:flex;
        align-items:center;
    }
    #map {
        height: 400px;
        width: 100%;
    }
</style>

