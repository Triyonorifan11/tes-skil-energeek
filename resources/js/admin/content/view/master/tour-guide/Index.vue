<template>
    <div class="tour-guide dz-bulat">
        <div id="main-content">
            <div class="post d-flex flex-column-fluid" id="kt_post">
                <div id="kt_content_container" class="container-xxl">
                    <div class="card card-flush mt-5 mb-5 mb-xl-10" id="kt_profile_details_view">
                        <div class="card card-xl-stretch mb-5 mb-xl-8">
                            <div class="card-header border-0 pt-5 align-items-center">
                                <div class="judul">
                                    <h2 class="text-gray-700">Master Tour Guide</h2>
                                    <span class="text-gray-700">Daftar tour guide pada aplikasi Tourism Surabaya - Disbudporapar Kota Surabaya</span>
                                </div>
                                <div class="button">
                                    <button class="btn btn-success" @click="showModalAdd">Tambah Data</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <app-data-table :table-config="tableConfig" @get-data="getDataTable">
                                    <template v-slot:body>
                                        <tr v-for="(context, index) in tableConfig?.data?.body">
                                            <td valign="middle">
                                                <div class="d-flex flex-column justify-content-center align-items-center">
                                                    {{ index+1 + ((tableConfig?.config?.currentPage-1) * tableConfig?.config?.limit) }}
                                                </div>
                                            </td>
                                            <td valign="middle">
                                                <h6>{{ context?.name }}</h6>
                                                <small class="text-muted">{{ context?.address }}</small>
                                            </td>
                                            <td valign="middle">
                                                <h6>{{ context?.websiteLink }}</h6>
                                                <small class="text-muted">{{ context?.instagramLink }}</small>
                                            </td>
                                            <td valign="middle">
                                                <b>{{ context?.phoneNumber }}</b>
                                            </td>
                                            <td valign="middle">
                                                <div class="m-auto form-check form-switch form-check-custom form-check-solid">
                                                    <input class="m-auto form-check-input h-30px w-50px" type="checkbox" :checked="context?.isActive == 1 ? true : false" @change="switchStatus(context?.id)"/>
                                                </div>
                                            </td>
                                            <td valign="middle" class="text-center">
                                                <button class="btn btn-secondary btn-sm" @click="edit(context)">Edit</button>
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
                                <h2 class="modal-title text-gray-700">{{ form.isEdit ? 'Edit' : 'Tambah' }} Tour Guide</h2>
                                <span class="text-muted">Silahkan lengkapi form berikut untuk {{ form.isEdit ? 'mengubah' : 'menambahkan' }} data.</span>
                            </div>
                        </div>
                        <!--begin::Close-->
                        <button type="button" class="btn-close m-2" data-bs-dismiss="modal" aria-label="Close"></button>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body">
                        <div class="file my-3">
                            <span>Logo</span>
                            <br><br>
                            <div class="dropzone" id="dropzoe-file" style="border:1px dashed green; background-color:#E8FFF3; border-radius: 100% !important; width:100px; height:95px;">
                                <div class="dz-message needsclick pt-2 d-flex align-items-center justify-content-center">
                                    <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M32.25 9.75H27.495L24.75 6.75H15.75V9.75H23.43L26.175 12.75H32.25V30.75H8.25V17.25H5.25V30.75C5.25 32.4 6.6 33.75 8.25 33.75H32.25C33.9 33.75 35.25 32.4 35.25 30.75V12.75C35.25 11.1 33.9 9.75 32.25 9.75ZM12.75 21.75C12.75 25.89 16.11 29.25 20.25 29.25C24.39 29.25 27.75 25.89 27.75 21.75C27.75 17.61 24.39 14.25 20.25 14.25C16.11 14.25 12.75 17.61 12.75 21.75ZM20.25 17.25C22.725 17.25 24.75 19.275 24.75 21.75C24.75 24.225 22.725 26.25 20.25 26.25C17.775 26.25 15.75 24.225 15.75 21.75C15.75 19.275 17.775 17.25 20.25 17.25ZM8.25 9.75H12.75V6.75H8.25V2.25H5.25V6.75H0.75V9.75H5.25V14.25H8.25V9.75Z" fill="#049C4F"/></svg>
                                </div>
                            </div>
                        </div>
                        <br>
                        <label for="name">Nama</label>
                        <input v-model="form.data.name" type="text" id="name" class="form-control" placeholder="Masukkan nama tour guide">
                        <br>
                        <label for="address">Alamat</label>
                        <textarea v-model="form.data.address" id="address" class="form-control" rows="3" placeholder="Masukkan alamat lengkap"></textarea>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="web">Website</label>
                                <input v-model="form.data.websiteLink" type="text" class="form-control" placeholder="cth:https://www.google.com/" id="web">
                            </div>
                            <div class="col-md-6">
                                <label for="ig">Link Instagram</label>
                                <input v-model="form.data.instagramLink" type="text" class="form-control" placeholder="cth:https://www.google.com/" id="ig">
                            </div>
                        </div>
                        <br>
                        <label for="phoneNumber">Telepon</label>
                        <input v-model="form.data.phoneNumber" type="text" id="phoneNumber" class="form-control" placeholder="Masukkan nomor telpon tour guide">
                        <br>
                        <label for="description">Deskripsi</label>
                        <textarea v-model="form.data.description" id="description" class="form-control" rows="3" placeholder="Masukkan deskripsi selengkap mungkin"></textarea>
                    </div>
                    <div class="modal-footer d-flex justify-content-center align-items-center">
                        <button class="btn btn-secondary btn-sm me-4" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-success btn-sm" @click="this.form.isEdit ? update() : simpan()">Simpan</button>
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
                selectList: {},
                dropzoneFile: '',
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
                                text: 'Nama & Alamat',
                                sortBy: 'name',
                                sort: true,
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
                                text: 'Website',
                                sortBy: 'websiteLink',
                                sort: true,
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
                                text: 'Telepon',
                                sortBy: 'phoneNumber',
                                sort: true,
                                class: {
                                    column: '',
                                    wrap: '',
                                    text: ''
                                },
                                style: {
                                    column: 'width:15%;',
                                    wrap: '',
                                    text: '',
                                }
                            },
                            {
                                text: 'Status',
                                sortBy: 'isActive',
                                sort: true,
                                class: {
                                    column: '',
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
                        search: ''
                    }
                },
                form: {
                    isEdit: false,
                    idEdit: '',
                    data: {
                        name: '',
                        address: '',
                        websiteLink: '',
                        instagramLink: '',
                        phoneNumber: '',
                        description: ''
                    }
                }
            }
        },
        mounted(){
            this.getDataTable();
        },
        methods: {
            initDropzone(isEdit = 0,data){
                if(this.dropzoneFile){
                    this.dropzoneFile.destroy();
                    $('.dz-preview.dz-complete.dz-image-preview').remove();
                }

                if(isEdit == 1){
                    let initialFile = `${data?.link}?token=${this.token}`;
                    let mockFile = { name: data?.name, size: data?.size };
                    this.dropzoneFile = new Dropzone("#dropzoe-file", {
                        url: "/",
                        dictCancelUpload: "Cancel",
                        maxFilesize: 50,
                        parallelUploads: 100,
                        uploadMultiple: false,
                        maxFiles: 100,
                        addRemoveLinks: true,
                        acceptedFiles: ".jpg,.jpeg,.png",
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
                }
                else{
                    this.dropzoneFile = new Dropzone("#dropzoe-file", {
                        url: "/",
                        dictCancelUpload: "Cancel",
                        maxFilesize: 50,
                        parallelUploads: 100,
                        uploadMultiple: false,
                        maxFiles: 100,
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
                }

            },
            getDataTable(){
                let that = this;
                this.tableConfig.config.loading = true;
                this.$axios().get(`master/tour-guide`, {params: this.tableConfig?.config})
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
            resetModal(){
                this.form = {
                    isEdit: false,
                    idEdit: '',
                    data: {
                        name: '',
                        address: '',
                        websiteLink: '',
                        instagramLink: '',
                        phoneNumber: '',
                        description: ''
                    }
                }
            },
            showModalAdd(){
                this.resetModal();
                this.initDropzone();
                $(`#modal-form`).modal('show');
            },
            edit(data){
                this.resetModal();
                this.initDropzone(1,data?.tourGuideFiles);
                this.form.isEdit = true;
                this.form.idEdit = data?.id;
                this.form.data.name = data?.name;
                this.form.data.address = data?.address;
                this.form.data.websiteLink = data?.websiteLink;
                this.form.data.instagramLink = data?.instagramLink;
                this.form.data.phoneNumber = data?.phoneNumber;
                this.form.data.description = data?.description;
                $(`#modal-form`).modal('show');
            },
            simpan(){
                let that = this;

                if(this.dropzoneFile?.files?.length < 1){
                    toastr.warning('File logo tidak boleh kosong');
                    return false;
                }

                this.$ewpLoadingShow();
                this.$axios().post(`master/tour-guide`, this?.form?.data)
                    .then(res => {
                        let data = res?.data?.data;                      
                        this.uploadFile(data?.id);
                    })
                    .catch(err => {
                        this.$axiosHandleError(err);
                    })
                    .then(() => {
                        this.$ewpLoadingHide();
                    });
            },
            update(){
                let that = this;

                // if(this.dropzoneFile?.files?.length < 1){
                //     toastr.warning('File logo tidak boleh kosong');
                //     return false;
                // }

                this.$ewpLoadingShow();
                this.$axios().put(`master/tour-guide/${this?.form?.idEdit}`, this?.form?.data)
                    .then(res => {
                        if(this.dropzoneFile?.files?.length < 1){
                            this.$ewpLoadingHide();
                            $('.modal').modal('hide');
                            Swal.fire('Berhasil','Data berhasil disimpan','success');
                            this.getDataTable();
                        }
                        else{
                            this.uploadFile(this?.form?.idEdit);
                        }
                    })
                    .catch(err => {
                        this.$axiosHandleError(err);
                    })
                    .then(() => {
                    });
            },
            switchStatus(id){
                let that = this;

                this.$ewpLoadingShow();
                this.$axios().put(`master/tour-guide/switch-status/${id}`)
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
            uploadFile(id){
                let that = this;
                this.dropzoneFile.on('processing', function(){
                    this.options.url = urlApi+`master/tour-guide/upload-file/${id}`;
                });
                this.dropzoneFile.processQueue();
                this.dropzoneFile.on('success', function(){
                    $('.modal').modal('hide');
                    that.$ewpLoadingHide();
                    Swal.fire('Berhasil', 'Data berhasil disimpan.','success').then(()=>{
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

    .dz-bulat >>> .dropzone{
        position:relative !important;
    }
    .dz-bulat >>> .dz-preview.dz-image-preview{
        position:absolute !important;
        top:0;
        left:0;
        margin-left:-10px;
        margin-top:-10px;
        background-color: transparent !important;
    }
    .dz-bulat >>> .dz-preview.dz-image-preview .dz-image{
        border-radius:100% !important;
        z-index:0 !important;
        background-color: transparent !important;
    }
    .dz-bulat >>> .dz-preview.dz-image-preview .dz-image img[data-dz-thumbnail]{
        object-fit: cover !important;
        width: 100%;
        height: 100%;
    }
    .dz-bulat >>> .dz-preview.dz-image-preview .dz-details{
        background-color: transparent !important;
    }
</style>

