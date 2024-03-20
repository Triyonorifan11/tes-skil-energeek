<template>
    <div class="bus dz-bulat">
        <div id="main-content">
            <div class="post d-flex flex-column-fluid" id="kt_post">
                <div id="kt_content_container" class="container-xxl">
                    <div class="card card-flush mt-5 mb-5 mb-xl-10" id="kt_profile_details_view">
                        <div class="card card-xl-stretch mb-5 mb-xl-8">
                            <div class="card-header border-0 pt-5 align-items-center">
                                <div class="judul">
                                    <h2 class="text-gray-700">Bus SSCT</h2>
                                    <span class="text-gray-700">Daftar galeri Bus SSCT pada aplikasi Tourism Surabaya - Disbudporapar Kota Surabaya</span>
                                </div>
                                <div class="button d-flex">
                                    <button class="btn btn-success" @click="modalTambah()">Tambah Data</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="card setting-header mb-5" style="box-shadow:0px 0px 5px lightgray;">
                                    <div class="card-body index-setting-header">
                                        <div class="loader d-flex align-items-center justify-content-center" v-if="formHeader.loading"><app-loader></app-loader></div>
                                        <div class="wrap" v-else>
                                            <h3 class="text-gray-600">Setting Header</h3>
                                            <br>
                                            <div class="dropzone bg-light-primary" id="dropzone-header" style="background-color:#F3F6F9 !important; border:none; height:100%; position:relative;">
                                                <div class="dz-message needsclick pt-2 d-flex align-items-center" style="height:200px;">
                                                    <div class="tulisan m-auto text-center" style="width:100% !important;">
                                                        <h5>Belum Ada Foto</h5>
                                                        <span class="text-gray-700">Silahkan Upload Foto</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="inputan">
                                                <label for="heading">Heading</label>
                                                <input v-model="formHeader.data.heading" type="text" class="form-control" placeholder="Masukkan heading">
                                            </div>
                                            <br>
                                            <div class="inputan">
                                                <label for="uraian">Uraian</label>
                                                <input v-model="formHeader.data.description" type="text" class="form-control" placeholder="Masukkan uraian">
                                            </div>
                                            <br>
                                            <button class="btn btn-light-success" @click="simpanHeader()">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                                <app-data-table :table-config="tableConfig" @get-data="getDataTable">
                                    <template v-slot:body>
                                        <tr v-for="(context, index) in tableConfig?.data?.body">
                                            <td valign="middle">
                                                <div class="d-flex flex-column justify-content-center align-items-center">
                                                    {{ index+1 + ((tableConfig?.config?.currentPage-1) * tableConfig?.config?.limit) }}
                                                </div>
                                            </td>
                                            <td valign="middle">
                                                <div class="d-flex align-items-center">
                                                    <img @error="$setNoImageUrl" :src="`${context?.busSsctThumbnail?.link}?token=${token}`" class="me-2" alt="" style="width:50px; height:50px; border-radius:10px; object-fit: cover;">
                                                    <div class="d-flex flex-column">
                                                        <h6>{{ context?.day || '-' }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td valign="middle">
                                                <ol type="1" class="px-5">
                                                    <li v-for="(val, i) in context?.touristDestinationBusSscts">{{ val?.touristDestinationLanguages[0]?.name }}</li>
                                                </ol>
                                            </td>
                                            <td valign="middle">
                                                <div class="m-auto form-check form-switch form-check-custom form-check-solid">
                                                    <input class="m-auto form-check-input h-30px w-50px" type="checkbox" :checked="context?.isActive == 1 ? true : false" @change="switchStatus(context?.id)"/>
                                                </div>
                                            </td>
                                            <td valign="middle" class="text-center">
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary btn-sm" @click="edit(context)">Edit</button>
                                                </div>
                                            </td>
                                        </tr>
                                    </template>
                                </app-data-table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" id="modal-form">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="m-auto" style="width:100%;">
                            <div class="d-flex flex-column justify-content-center align-items-center">
                                <h1 class="modal-title text-gray-700">{{ !form.isEdit ? 'Tambah' : 'Edit' }} Galeri Bus SSCT</h1>
                                <h6 class="text-gray-700 mt-3">Silahkan lengkapi form berikut untuk {{ form.isEdit ? 'mengubah' : 'menambah' }} data.</h6>
                            </div>
                        </div>
                        <!--begin::Close-->
                        <button type="button" class="btn-close m-2" data-bs-dismiss="modal" aria-label="Close"></button>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body">
                        <div class="file">
                            <span>Upload File</span>
                            <br>
                            <div class="dropzone bg-light-primary" id="dropzone-file" style="border:1px solid #78CCFB;">
                                <div class="dz-message needsclick pt-2 d-flex align-items-center">
                                    <svg width="43" height="43" viewBox="0 0 43 43" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M10.4941 3.58398H24.6112C25.2466 3.58398 25.8615 3.80917 26.3467 4.21956L34.8815 11.4385C35.4852 11.9492 35.8334 12.6998 35.8334 13.4905V35.9833C35.8334 39.1913 35.7968 39.4173 32.506 39.4173H10.4941C7.20338 39.4173 7.16675 39.1913 7.16675 35.9833V7.01801C7.16675 3.80996 7.20338 3.58398 10.4941 3.58398Z" fill="#009EF7"/><path fill-rule="evenodd" clip-rule="evenodd" d="M16.0377 24.7523H19.543V28.3494C19.543 28.8442 19.9441 29.2453 20.4389 29.2453H22.2723C22.767 29.2453 23.1681 28.8442 23.1681 28.3494V24.7523H26.6735C27.1682 24.7523 27.5693 24.3513 27.5693 23.8565C27.5693 23.6445 27.4941 23.4394 27.3572 23.2777L22.0393 16.9967C21.7196 16.6191 21.1543 16.5721 20.7767 16.8918C20.7389 16.9238 20.7039 16.9589 20.6719 16.9967L15.354 23.2777C15.0343 23.6552 15.0812 24.2205 15.4588 24.5402C15.6206 24.6772 15.8257 24.7523 16.0377 24.7523Z" fill="#009EF7"/></svg>
                                    <div class="tulisan">
                                        <div>Drop files here or click to upload.</div>
                                        <small class="text-primary">Only one file type .jpg/.jpeg/.png</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="file-eksisting" v-if="form.previewCover">
                            <span>Cover</span>
                            <br>
                            <img :src="`${form?.previewCover?.link}?token=${token}&preview=1`" style="width:200px; height:200px; border-radius:10px; object-fit:cover;" alt="">
                            <br>
                        </div>
                        <br>
                        <div class="name">
                            <label for="name">Hari</label>
                            <input type="text" v-model="form.data.day" placeholder="Masukkan nama hari" id="name" class="form-control">
                        </div>
                        <br>
                        <div class="name">
                            <label for="name">Link Pembelian Tiket</label>
                            <input type="text" v-model="form.data.linkPurchaceTicket" placeholder="cth:https://www.google.com/" id="name" class="form-control">
                        </div>
                        <br>
                        <div class="destinasi">
                            <label for="des">Rute Destinasi</label>
                            <br>
                            <div class="wrap-select2 my-2" v-for="(context, index) in form.data.destination">
                                <div class="row" style="width:100%;">
                                    <div class="col-md-10">
                                        <app-select2 id="destinasi" v-model="context.value" :loading="selectList.destination.loading" :options="selectList?.destination?.list" @get-options="getDestination" placeholder="Pilih rute destinasi" :multiple="false"></app-select2>
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-light-danger btn-sm" @click="form.data.destination.splice(index,1)" v-if="index != 0">
                                            <svg width="23" height="25" viewBox="0 0 23 25" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M21.5285 1.86837H15.7428L15.2896 0.980848C15.1936 0.791106 15.0457 0.631499 14.8626 0.519983C14.6794 0.408467 14.4683 0.349466 14.253 0.349618H8.74209C8.52724 0.348805 8.3165 0.407586 8.13402 0.519226C7.95153 0.630866 7.80469 0.79085 7.71031 0.980848L7.25709 1.86837H1.47138C1.26678 1.86837 1.07057 1.94837 0.925897 2.09078C0.781226 2.23319 0.699951 2.42634 0.699951 2.62774L0.699951 4.14649C0.699951 4.34789 0.781226 4.54104 0.925897 4.68345C1.07057 4.82586 1.26678 4.90587 1.47138 4.90587H21.5285C21.7331 4.90587 21.9293 4.82586 22.074 4.68345C22.2187 4.54104 22.2999 4.34789 22.2999 4.14649V2.62774C22.2999 2.42634 22.2187 2.23319 22.074 2.09078C21.9293 1.94837 21.7331 1.86837 21.5285 1.86837ZM3.26495 22.5139C3.30174 23.0922 3.56106 23.6351 3.99012 24.0318C4.41918 24.4286 4.98572 24.6495 5.57442 24.6496H17.4255C18.0142 24.6495 18.5807 24.4286 19.0098 24.0318C19.4388 23.6351 19.6982 23.0922 19.7349 22.5139L20.7571 6.42462H2.24281L3.26495 22.5139Z" fill="#F64E60"/></svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-light-success" @click="form.data.destination.push({value: ''})">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10.0001 9.99935H1.66675M10.0001 1.66602V9.99935V1.66602ZM10.0001 9.99935V18.3327V9.99935ZM10.0001 9.99935H18.3334H10.0001Z" stroke="#049C4F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                Tambah
                            </button>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center align-items-center">
                        <button class="btn btn-secondary btn-sm me-4">Batal</button>
                        <button class="btn btn-sm btn-success me-4" @click="form?.isEdit ? update() : simpan()">Simpan</button>
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
                dropzoneFile: '',
                selectList: {
                    destination: {
                        loading: false,
                        list: []
                    }
                },
                form: {
                    isEdit: false,
                    idEdit: '',
                    previewCover: '',
                    data: {
                        day: '',
                        destination: [{value: ''}],
                        destinationRoutes: [],
                    },
                },
                formHeader: {
                    loading: false,
                    dzHeader: '',
                    dzHeaderView: '',
                    data: {
                        id: '',
                        heading: '',
                        description: '',
                        linkPurchaceTicket: ''
                    }
                },
                tableConfig: {
                    data: {
                        header: [
                            {
                                text: 'No',
                                sortBy: 'id',
                                sort: true,
                                class: {
                                    column: '',
                                    wrap: '',
                                    text: 'text-center'
                                },
                                style: {
                                    column: 'width:10%;',
                                    wrap: '',
                                    text: '',
                                }
                            },
                            {
                                text: 'Hari',
                                sortBy: 'day',
                                sort: true,
                                class: {
                                    column: '',
                                    wrap: '',
                                    text: ''
                                },
                                style: {
                                    column: 'width:20%;',
                                    wrap: '',
                                    text: '',
                                }
                            },
                            {
                                text: 'Rute',
                                sortBy: 'createdAt',
                                sort: false,
                                class: {
                                    column: '',
                                    wrap: '',
                                    text: ''
                                },
                                style: {
                                    column: '',
                                    wrap: '',
                                    text: '',
                                }
                            },
                            {
                                text: 'Status',
                                sortBy: 'isActive',
                                sort: true,
                                class: {
                                    column: 'text-center',
                                    wrap: '',
                                    text: ''
                                },
                                style: {
                                    column: 'width:10%;',
                                    wrap: '',
                                    text: '',
                                }
                            },
                            {
                                text: 'Aksi',
                                sortBy: '',
                                sort: false,
                                class: {
                                    column: '',
                                    wrap: '',
                                    text: 'text-center'
                                },
                                style: {
                                    column: 'width:20%;',
                                    wrap: '',
                                    text: '',
                                }
                            },
                        ],
                        body: []
                    },
                    config: {
                        orderBy: 'desc',
                        sortBy: 'id',
                        loading: false,
                        limit: 10,
                        currentPage: 1,
                        totalPage: 20,
                        search: '',
                        categoryId: ''
                    }
                },
            }
        },
        mounted(){
            this.getDataTable();
            this.getHeader();
        },
        methods: {
            initDropzoneHeader(data = false){
                let that = this;
                if(this.formHeader.dzHeader){
                    this.formHeader.dzHeader.destroy();
                }

                let initialFile = '';
                let mockFile = '';
                if(data){
                    initialFile = `${data?.link}?token=${this.token}`;
                    mockFile = { name: data?.name, size: data?.size };
                }
                this.formHeader.dzHeader = new Dropzone("#dropzone-header", {
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
                        if(data){
                            this.emit("addedfile", mockFile);
                            this.emit("thumbnail", mockFile, initialFile);
                            this.emit("complete", mockFile);
                        }
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
            getHeader(){
                let that = this;

                this.formHeader.loading = true;
                this.$axios().get(`menu-header?headerType=bus_ssct`)
                    .then(res => {
                        let data = res?.data?.data;
                        this.formHeader.data = {
                            id: data?.id,
                            heading: data?.heading,
                            description: data?.description,
                        };
                        this.formHeader.dzHeaderView = data?.menuHeaderFile;
                    })
                    .catch(err => {
                        this.$axiosHandleError(err);
                    })
                    .then(() => {
                        this.formHeader.loading = false;
                        setTimeout(function(){
                            that.initDropzoneHeader(that.formHeader?.dzHeaderView);
                        }, 200);
                    });
            },
            simpanHeader(){
                let that = this;

                let data = this?.formHeader?.data;
                data.headerType = 'bus_ssct';

                this.$ewpLoadingShow();
                this.$axios().put(`menu-header`,data)
                    .then(res => {
                        let data = res?.data?.data;
                        if(this?.formHeader?.dzHeader?.files?.length){
                            this.uploadFileHeader(data?.id);
                        }
                        else{
                            this.$ewpLoadingHide();
                            Swal.fire('Berhasil', 'Data berhasil disimpan', 'success');
                            that.getHeader();
                        }
                    })
                    .catch(err => {
                        this.$ewpLoadingHide();
                        this.$axiosHandleError(err);
                    });
            },
            uploadFileHeader(id){
                let that = this;
                this.formHeader.dzHeader.on('processing', function(){
                    this.options.url = urlApi+`menu-header/upload-file/${id}`;
                });
                this.formHeader.dzHeader.processQueue();
                this.formHeader.dzHeader.on('error', function(){
                    that.$ewpLoadingHide();
                });
                this.formHeader.dzHeader.on('success', function(){
                    that.$ewpLoadingHide();
                    Swal.fire('Berhasil','Data berhasil disimpan','success').then(()=>{
                        that.getHeader();
                    });
                });
            },
            initDropzone(){
                if(this.dropzoneFile){
                    this.dropzoneFile.destroy();
                    $('.dz-preview.dz-complete.dz-image-preview').remove();
                }
                this.dropzoneFile = new Dropzone("#dropzone-file", {
                    url: "/",
                    dictCancelUpload: "Cancel",
                    maxFilesize: 50,
                    parallelUploads: 100,
                    uploadMultiple: false,
                    maxFiles: 1,
                    addRemoveLinks: true,
                    acceptedFiles: ".jpg,.jpeg,.png",
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
            getDataTable(){
                let that = this;
                this.tableConfig.config.loading = true;
                this.$axios().get(`bus-ssct?language=ID`, {params: this.tableConfig?.config})
                    .then(res => {
                        let data = res?.data?.data;
                        this.tableConfig.data.body = res?.data?.data?.data;
                        this.tableConfig.config.currentPage = data?.currentPage;
                        this.tableConfig.config.limit = data?.perPage;
                        this.tableConfig.config.totalPage = data?.lastPage;
                    })
                    .catch(err => {
                        this.$axiosHandleError(err);
                    })
                    .then(() => {
                        this.tableConfig.config.loading = false;
                    })
            },
            switchStatus(id){
                let that = this;

                this.$ewpLoadingShow();
                this.$axios().put(`bus-ssct/switch-status/${id}`)
                    .then(res => {
                        $(`.modal`).modal('hide');
                        toastr.success('Status berhasil diubah');
                        this.getDataTable();
                    })
                    .catch(err => {
                        this.$axiosHandleError(err);
                    })
                    .then(() => {
                        this.$ewpLoadingHide();
                    });
            },
            getDestination(search, limit){
                let that = this;

                this.selectList.destination.loading = true;
                this.$axios().get(`select-list/tourist-destination?search=${search}&limit=${limit}`)
                    .then(res => {
                        let data = res?.data?.data;
                        this.selectList.destination.list = [];
                        $.each(data, function(i,val){
                            let exist = that.form.data.destination.findIndex(value => value?.value?.id == val?.id);
                            if(exist == -1){
                                that.selectList.destination.list.push({id: val?.id, text: val?.touristDestinationLanguages[0]?.name});
                            }
                        });
                    })
                    .catch(err => {
                        this.$axiosHandleError(err);
                    })
                    .then(() => {
                        this.selectList.destination.loading = false;
                    });
            },
            resetModal(){
                this.form = {
                    isEdit: false,
                    idEdit: '',
                    previewCover: '',
                    data: {
                        day: '',
                        destination: [{id: '', text: ''}],
                        destinationRoutes: [],
                    },
                };
            },
            modalTambah(){
                let that = this;
                this.resetModal();
                this.form.isEdit = false;
                this.initDropzone();
                $('#modal-form').modal('show');
            },
            edit(data){
                let that = this;
                this.resetModal();
                this.form.isEdit = true;
                this.form.idEdit = data?.id;
                this.initDropzone();
                this.form.data.day = data?.day;
                this.form.previewCover = data?.busSsctThumbnail;
                this.form.data.destination = [];
                $.each(data?.touristDestinationBusSscts, function(i, val){
                    that.form.data.destination.push({value: {id: val?.id, text: val?.touristDestinationLanguages[0]?.name}});
                });
                this.form.data.linkPurchaceTicket = data.linkPurchaceTicket;

                $('#modal-form').modal('show');
            },
            simpan(){
                let that = this;

                if(!this.dropzoneFile.files.length){
                    Swal.fire('Pastikan form sudah lengkap','File thumbnail/cover dan file ebook tidak boleh kosong','warning');
                    return false;
                }

                let data = this.form.data;
                data.destinationRoutes = [];
                $.each(data.destination, function(i,val){
                    data.destinationRoutes.push(val?.value?.id);
                });

                this.$ewpLoadingShow();
                this.$axios().post(`bus-ssct`, data)
                    .then(res => {
                        let data = res?.data?.data;
                        this.uploadFile(data?.id);
                    })
                    .catch(err => {                      
                        this.$ewpLoadingHide();
                        this.$axiosHandleError(err);
                    })
                    .then(() => {

                    });
            },
            update(){
                let that = this;

                let data = this.form.data;
                data.destinationRoutes = [];
                $.each(data.destination, function(i,val){
                    data.destinationRoutes.push(val?.value?.id);
                });

                this.$ewpLoadingShow();
                this.$axios().put(`bus-ssct/${this.form.idEdit}`, data)
                    .then(res => {
                        let data = res?.data?.data;
                        if(this.dropzoneFile.files.length){
                            this.uploadFile(data?.id);
                        }
                        else{
                            $('.modal').modal('hide');
                            this.$ewpLoadingHide();
                            Swal.fire('Berhasil','Data berhasil disimpan','success').then(()=>{
                                that.getDataTable();
                            });
                        }
                    })
                    .catch(err => {
                        this.$ewpLoadingHide();
                        this.$axiosHandleError(err);
                    })
                    .then(() => {

                    });
            },
            uploadFile(id){
                let that = this;
                this.dropzoneFile.on('processing', function(){
                    this.options.url = urlApi+`bus-ssct/upload-file/${id}`;
                });
                this.dropzoneFile.processQueue();
                this.dropzoneFile.on('error', function(){
                    that.$ewpLoadingHide();
                });
                this.dropzoneFile.on('success', function(){
                    $('.modal').modal('hide');
                    that.$ewpLoadingHide();
                    Swal.fire('Berhasil','Data berhasil disimpan','success').then(()=>{
                        that.getDataTable();
                    });
                });
            },
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

    .dz-bulat >>> #dropzone-cover.dropzone{
        position:relative !important;
    }
    .dz-bulat >>> #dropzone-cover .dz-preview.dz-image-preview{
        position:absolute !important;
        top:0;
        left:0;
        margin-left:-10px;
        margin-top:-10px;
        background-color: transparent !important;
    }
    .dz-bulat >>> #dropzone-cover .dz-preview.dz-image-preview .dz-image{
        border-radius:100% !important;
        z-index:0 !important;
        background-color: transparent !important;
    }
    .dz-bulat >>> #dropzone-cover .dz-preview.dz-image-preview .dz-image img[data-dz-thumbnail]{
        object-fit: cover !important;
        width: 100%;
        height: 100%;
    }
    .dz-bulat >>> #dropzone-cover .dz-preview.dz-image-preview .dz-details{
        background-color: transparent !important;
    }

    .btn-outline-info{
        border:1px solid #0E5CA8 !important;
        background-color:#F1FAFF !important;
    }

    #ebook-eksisting{
        box-shadow: 0px 0px 5px lightgray;
        width:200px;
        min-width:200px;
        cursor:pointer;
    }
    #ebook-eksisting:hover{
        box-shadow: 0px 0px 10px lightgray;
    }


    #dropzone-header {
        position: relative;
    }
    .index-setting-header >>> .dz-preview{
        position:absolute;
        top: 0;
        left:0;
        right:0;
        bottom: 0;
    }
    .index-setting-header >>> .dz-preview .dz-image, .index-setting-header >>> .dz-preview .dz-image img{
        width: 100% !important;
        height: 100% !important;
        object-fit:cover;
    }
    .index-setting-header >>> .dz-preview .dz-remove{
        top:5px;
        right:5px;
        z-index:21 !important;
    }
    .index-setting-header >>> .dz-preview .dz-remove::after{
        background-color: red !important;
        z-index:21 !important;
    }
</style>

