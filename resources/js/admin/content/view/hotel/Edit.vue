<template>
    <div>
        <div id="main-content">
            <div class="post d-flex flex-column-fluid" id="kt_post">
                <div id="kt_content_container" class="container-xxl">
                    <div class="card card-flush mt-5 mb-5 mb-xl-10" id="kt_profile_details_view">
                        <div class="card card-xl-stretch mb-5 mb-xl-8">
                            <div class="card-header border-0 pt-5 align-items-center">
                                <div class="judul">
                                    <h2 class="text-gray-700">Edit Hotel</h2>
                                    <span class="text-gray-700">Lengkapi form dibawah ini untuk mengubah hotel</span>
                                </div>
                                <div class="button d-flex">
                                    <button class="btn btn-secondary" @click="$router.back()">
                                        <svg width="16" height="10" viewBox="0 0 16 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5.96839 8.82451L5.5 9.29289L1.20711 5L5.5 0.707107L5.96839 1.17549L3.33762 3.81361L2.48694 4.66667H3.69167H15V5.33333H3.69167H2.48694L3.33762 6.18639L5.96839 8.82451Z" fill="black" stroke="#0E5CA8"/></svg>
                                        Kembali
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <template v-if="loading">
                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                        <div class="loader justify-content-center align-items-center">
                                            <app-loader></app-loader>
                                        </div>
                                    </div>
                                </template>
                                <template v-else>
                                    <div class="info-global">
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
                                                <label for="name">Nama Hotel</label>
                                                <input v-model="form.data.name" id="name" type="text" class="form-control" placeholder="Masukkan nama tempat">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="category">Kategori</label>
                                                <app-select2 id="category" v-model="form.data.category" :loading="selectList.category.loading" :options="selectList?.category?.list" @get-options="getCategory" placeholder="Pilih kategori" :multiple="false"></app-select2>
                                            </div>
                                        </div>
                                        <br>
                                        <label for="address">Alamat Hotel</label>
                                        <textarea v-model="form.data.address" id="address" rows="5" class="form-control" placeholder="Masukkan alamat lengkap"></textarea>
                                        <br>
                                        <label for="address">Deskripsi Hotel</label>
                                        <textarea v-model="form.data.description" id="description" rows="5" class="form-control" placeholder="Masukkan deskripsi hotel"></textarea>
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
                                                <label for="phoneNumber">No Telepon</label>
                                                <input v-model="form.data.phoneNumber" id="phoneNumber" type="text" class="form-control" placeholder="Masukkan no telp">
                                            </div>
                                        </div>
                                        <br><br>
                                        <div class="btn-simpan d-flex justify-content-center align-items-center">
                                            <button class="btn btn-success btn-sm" @click="simpan()">Simpan Data</button>
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
</template>

<script>

    export default {
        data(){
            return {
                token: localStorage.getItem('tourism_token'),
                assetUrl: assetUrl,
                loading: false,
                superior: {
                    loading: false,
                    count: '',
                },
                selectList: {
                    category: {
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
                        category: '',
                        hotelCategoryId: '',
                        name: '',
                        address: '',
                        latitude:'',
                        longitude: '',
                        phoneNumber: '',
                        websiteLink: ''
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
            }
        },
        mounted(){
            let that = this;
            this.getData();
            setInterval(function(){
                that.dropzoneFileFiles = [];
                that.dropzoneFileFiles = that.dropzoneFile.files;
                $('.dropzone .dz-preview').remove();
            },1000);
        },
        methods: {
            getData(){
                let that = this;

                this.loading = true;
                this.$axios().get(`hotel/${this.$route?.params?.id}`)
                    .then(res => {
                        let data = res?.data?.data;
                        this.loading = false;
                        setTimeout(function(){
                            that.initDropzone(1, data?.hotelFiles);
                            that.initMap();
                            that.dropzoneFile.on('addedfile',function(){
                                that.dropzoneFileFiles = [];
                                that.dropzoneFileFiles = that.dropzoneFile.files;
                            });
                        },200);

                        this.map.surabaya.lat = Number(data?.latitude);
                        this.map.surabaya.lng = Number(data?.longitude);
                        this.form.data.latitude = data?.latitude;
                        this.form.data.description = data.description;
                        this.form.data.longitude = data?.longitude;
                        this.form.data.name = data?.name;
                        this.form.data.address = data?.address;
                        this.form.data.websiteLink = data?.websiteLink;
                        this.form.data.phoneNumber = data?.phoneNumber;
                        this.form.data.category = {id: data?.hotelCategory?.id, text: 'Bintang ' + data?.hotelCategory?.starNumber};
                    })
                    .catch(err => {                      
                        this.$axiosHandleError(err);
                    })
                    .then(() => {
                        this.loading = false;
                    })
            },
            initDropzone(isEdit = 0, data = ''){
                let that = this;
                if(this.dropzoneFile){
                    this.dropzoneFile.destroy();
                }

                if(isEdit == 1){
                    this.dropzoneFile = new Dropzone("#dropzoe-file", {
                        url: "/",
                        dictCancelUpload: "Cancel",
                        maxFilesize: 50,
                        parallelUploads: 100,
                        uploadMultiple: true,
                        maxFiles: 100,
                        addRemoveLinks: true,
                        acceptedFiles: ".jpg,.jpeg,.png",
                        autoProcessQueue: false,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                            Authorization: "Bearer " + localStorage.getItem("tourism_token"),
                        },
                        init: async function () {
                            let thisDz = this;
                            data.map(function(item){
                                return data.length ? item.link = `${item.link}?token=${that.token}` : '';
                            });

                            await $.each(data, function(i,val){
                                let file = {id: val?.id, name: val?.name, size: val?.size, dataURL: val?.link, url: `${val?.link}&preview=1`};                               
                                if(!thisDz.files.includes(file)){
                                    let url = file?.dataURL;
                                    //fetch untuk convert url image ke blob
                                    fetch(url)
                                        .then(response => response.blob())
                                        .then(blob => {
                                            //convert blob ke base64
                                            let base64data = '';
                                            let reader = new FileReader();
                                            reader.readAsDataURL(blob);
                                            reader.onloadend = function() {
                                                base64data = reader.result;
                                                //convert blob ke file
                                                let b = new File([blob], val?.name, { type: `image/*` });
                                                b.dataURL = base64data;
                                                // b.type = `image/${val?.ext}`;
                                                thisDz.files.push(b);
                                                if(val?.fileType == 'thumbnail'){   
                                                    that.indexFileThumbnails = thisDz.files.length - 1;
                                                }
                                            }
                                        });
                                }
                            });

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
                }
                else{
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
                }
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
                this.$axios().get(`select-list/hotel-category?search=${search}&limit=${limit}`)
                    .then(res => {
                        let data = res?.data?.data;
                        this.selectList.category.list = [];
                        $.each(data, function(i,val){
                            that.selectList.category.list.push({id: val?.id, text: `Bintang ${val?.starNumber}`});
                        });
                    })
                    .catch(err => {
                        this.$axiosHandleError(err);
                    })
                    .then(() => {
                        this.selectList.category.loading = false;
                    });
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
                data.hotelCategoryId = data.category?.id;

                this.$ewpLoadingShow();
                this.$axios().put(`hotel/${this.$route.params.id}`,data)
                .then(res => {
                    let data = res?.data?.data;
                    if(this.dropzoneFileFiles.length){
                        this.uploadFile(data?.id);
                    }
                    else{
                        Swal.fire('Berhasil','Data berhasil disimpan','success').then(result => {
                            that.$router.push({name: 'a-hotel'});
                        });
                    }
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

                this.$axios().post(`hotel/upload-file/${id}`,formData)
                    .then(res => {
                        Swal.fire('Berhasil','Data berhasil disimpan','success').then(result => {
                            that.$router.push({name: 'a-hotel'});
                        });
                    })
                    .catch(err => {
                        this.$axiosHandleError(err);
                        this.$router.push({name: 'a-hotel'});
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

