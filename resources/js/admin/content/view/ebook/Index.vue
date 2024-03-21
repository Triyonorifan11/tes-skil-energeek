<template>
    <div class="ebook dz-bulat">
        <div id="main-content">
            <div class="post d-flex flex-column-fluid" id="kt_post">
                <div id="kt_content_container" class="container-xxl">
                    <div class="card card-flush mt-5 mb-5 mb-xl-10" id="kt_profile_details_view">
                        <div class="card card-xl-stretch mb-5 mb-xl-8">
                            <div class="card-header border-0 pt-5 align-items-center">
                                <div class="judul">
                                    <h2 class="text-gray-700">E-Book</h2>
                                    <span class="text-gray-700">Daftar ebook pada aplikasi Tourism Surabaya - Disbudporapar Kota Surabaya</span>
                                </div>
                                <div class="button d-flex">
                                    <button class="btn btn-success" @click="modalTambah()">Tambah Data</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <app-data-table :table-config="tableConfig" @get-data="getDataTable">
                                    <template v-slot:body>
                                        <tr v-for="(context, index) in tableConfig?.data?.body">
                                            <td valign="middle">
                                                <div class="d-flex flex-column justify-content-center align-items-center">
                                                    <input type="checkbox" v-model="context.isChecklist" style="width:20px;height:20px;" @change="changeKominfoSelected(context.id, context.isChecklist, index)"/>
                                                </div>
                                            </td>
                                            <td valign="middle">
                                                <div class="d-flex align-items-center">
                                                    <img @error="$setNoImageUrl" :src="`${context?.ebookThumbnail?.link}?token=${token}`" class="me-2" alt="" style="width:50px; height:50px; border-radius:10px; object-fit: cover;">
                                                    <div class="d-flex flex-column">
                                                        <h6>{{ context?.name || '-' }}</h6>                                                        
                                                    </div>
                                                </div>
                                            </td>
                                            <td valign="middle text-center">
                                                <div class="d-flex flex-column justify-content-center align-items-center">
                                                    {{ $moment(context?.createdAt).format('DD-MM-YYYY') }}
                                                </div>
                                            </td>
                                            <td valign="middle">
                                                <div class="m-auto form-check form-switch form-check-custom form-check-solid">
                                                    <input class="m-auto form-check-input h-30px w-50px" type="checkbox" :checked="context?.isActive == 1 ? true : false" @change="switchStatus(context?.id)"/>
                                                </div>
                                            </td>
                                            <td valign="middle" class="text-center">
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Aksi</button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item p-2" href="javascript:void(0)" @click="edit(context)">Edit</a></li>
                                                        <li><a class="dropdown-item p-2" :href="`${context?.ebookFile?.link}?token=${token}`" >Download</a></li>
                                                    </ul>
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
                                <h1 class="modal-title text-gray-700">{{ !form.isEdit ? 'Tambah' : 'Edit' }} E-Book</h1>
                                <h6 class="text-gray-700 mt-3">Silahkan lengkapi form berikut untuk {{ form.isEdit ? 'mengubah' : 'menambah' }} data.</h6>
                            </div>
                        </div>
                        <!--begin::Close-->
                        <button type="button" class="btn-close m-2" data-bs-dismiss="modal" aria-label="Close"></button>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body">
                        <div class="cover my-3">
                            <span>Thumbnail/Cover</span>
                            <br><br>
                            <div class="dropzone" id="dropzone-cover" style="border:1px dashed green; background-color:#E8FFF3; border-radius: 100% !important; width:100px; height:95px;">
                                <div class="dz-message needsclick pt-2 d-flex align-items-center justify-content-center">
                                    <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M32.25 9.75H27.495L24.75 6.75H15.75V9.75H23.43L26.175 12.75H32.25V30.75H8.25V17.25H5.25V30.75C5.25 32.4 6.6 33.75 8.25 33.75H32.25C33.9 33.75 35.25 32.4 35.25 30.75V12.75C35.25 11.1 33.9 9.75 32.25 9.75ZM12.75 21.75C12.75 25.89 16.11 29.25 20.25 29.25C24.39 29.25 27.75 25.89 27.75 21.75C27.75 17.61 24.39 14.25 20.25 14.25C16.11 14.25 12.75 17.61 12.75 21.75ZM20.25 17.25C22.725 17.25 24.75 19.275 24.75 21.75C24.75 24.225 22.725 26.25 20.25 26.25C17.775 26.25 15.75 24.225 15.75 21.75C15.75 19.275 17.775 17.25 20.25 17.25ZM8.25 9.75H12.75V6.75H8.25V2.25H5.25V6.75H0.75V9.75H5.25V14.25H8.25V9.75Z" fill="#049C4F"/></svg>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="file">
                            <span>Upload File</span>
                            <br>
                            <div class="dropzone bg-light-primary" id="dropzone-file" style="border:1px solid #78CCFB;">
                                <div class="dz-message needsclick pt-2 d-flex align-items-center">
                                    <svg width="43" height="43" viewBox="0 0 43 43" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M10.4941 3.58398H24.6112C25.2466 3.58398 25.8615 3.80917 26.3467 4.21956L34.8815 11.4385C35.4852 11.9492 35.8334 12.6998 35.8334 13.4905V35.9833C35.8334 39.1913 35.7968 39.4173 32.506 39.4173H10.4941C7.20338 39.4173 7.16675 39.1913 7.16675 35.9833V7.01801C7.16675 3.80996 7.20338 3.58398 10.4941 3.58398Z" fill="#009EF7"/><path fill-rule="evenodd" clip-rule="evenodd" d="M16.0377 24.7523H19.543V28.3494C19.543 28.8442 19.9441 29.2453 20.4389 29.2453H22.2723C22.767 29.2453 23.1681 28.8442 23.1681 28.3494V24.7523H26.6735C27.1682 24.7523 27.5693 24.3513 27.5693 23.8565C27.5693 23.6445 27.4941 23.4394 27.3572 23.2777L22.0393 16.9967C21.7196 16.6191 21.1543 16.5721 20.7767 16.8918C20.7389 16.9238 20.7039 16.9589 20.6719 16.9967L15.354 23.2777C15.0343 23.6552 15.0812 24.2205 15.4588 24.5402C15.6206 24.6772 15.8257 24.7523 16.0377 24.7523Z" fill="#009EF7"/></svg>
                                    <div class="tulisan">
                                        <div>Drop files here or click to upload.</div>
                                        <small class="text-primary">Only allowed upload one file with the format .pdf/.word/.ppt</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="file-eksisting" v-if="form.previewFileEbook">
                            <span>File Ebook</span>
                            <br>
                            <a :href="`${form?.previewFileEbook?.link}?token=${token}&preview=1`" target="_blank">
                                <div class="card p-1" id="ebook-eksisting">
                                    <div class="card-body p-3">
                                        <h6 class="text-primary">{{ form?.previewFileEbook?.name }}</h6>
                                        <span class="text-muted">{{ $formatBytes(form?.previewFileEbook?.size) }}</span>
                                    </div>
                                </div>
                            </a>
                            <br>
                        </div>
                        <div class="name">
                            <label for="name">Nama</label>
                            <input type="text" v-model="form.data.name" placeholder="Masukkan nama ebook" id="name" class="form-control">
                        </div>
                        <br>                       
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
                dropzoneCover: '',
                dropzoneFile: '',
                form: {
                    isEdit: false,
                    idEdit: '',
                    previewFileEbook: '',
                    data: {
                        description: '-',
                        name: ''
                    },
                },
                tableConfig: {
                    data: {
                        header: [
                            {
                                text: '<input type="checkbox" id="checkfor-all-ebook" style="width:20px;height:20px;"/>',
                                sortBy: '',
                                sort: false,
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
                                text: 'Ebook',
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
                                text: 'Tanggal Posting',
                                sortBy: 'createdAt',
                                sort: false,
                                class: {
                                    column: 'text-center',
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
            let that = this;
            $("body").on('click','#checkfor-all-ebook',function(){                   
                that.changeKominfoAll();
            });
            this.getDataTable();
        },
        methods: {
            initDropzone(isEdit = 0,data){
                if(this.dropzoneCover){
                    this.dropzoneCover.destroy();
                }

                if(isEdit == 1){                                    
                    let initialFile = `${data?.link}?token=${this.token}`;
                    let mockFile = { name: data?.name, size: data?.size };
                    this.dropzoneCover = new Dropzone("#dropzone-cover", {
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
                    if(this.dropzoneCover){
                        this.dropzoneCover.destroy();
                    }
                    $('.dz-preview.dz-complete.dz-image-preview').remove();

                    this.dropzoneCover = new Dropzone("#dropzone-cover", {
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
                }

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
                    acceptedFiles: ".pdf,.doc,.docx,.ppt",
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
            checkCheckboxAll(){
                if(this.tableConfig.data.body.length > 0){
                    $("#checkfor-all-ebook").removeAttr('disabled');
                    if(!this.tableConfig.data.body.filter((e) => !e.isChecklist).length){
                        $("#checkfor-all-ebook").prop('checked',true); 
                    }else{
                        $("#checkfor-all-ebook").prop('checked',false); 
                    }
                }
            },
            getDataTable(){
                let that = this;
                this.tableConfig.config.loading = true;

                this.tableConfig.data.body = [];

                $("#checkfor-all-ebook").attr('disabled',true).prop('checked',false);

                this.$axios().get(`ebook`, {params: this.tableConfig?.config})
                    .then(res => {
                        let data = res?.data?.data;
                        this.tableConfig.data.body = res?.data?.data?.data;
                        this.tableConfig.config.currentPage = data?.currentPage;
                        this.tableConfig.config.limit = data?.perPage;
                        this.tableConfig.config.totalPage = data?.lastPage;
                        this.checkCheckboxAll();
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
                this.$axios().put(`ebook/switch-status/${id}`)
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
            resetModal(){
                this.form = {
                    isEdit: false,
                    idEdit: '',
                    previewFileEbook: '',
                    data: {
                        description: '-',
                        name: ''
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
                this.resetModal();
                this.form.isEdit = true;
                this.form.idEdit = data?.id;
                this.initDropzone(1,data?.ebookThumbnail);                
                this.form.data.name = data?.name;
                this.form.previewFileEbook = data?.ebookFile;
                $('#modal-form').modal('show');
            },
            simpan(){
                let that = this;

                if(!this.dropzoneCover.files.length && !this.dropzoneFile.files.length){
                    Swal.fire('Pastikan form sudah lengkap','File thumbnail/cover dan file ebook tidak boleh kosong');
                    return false;
                }

                this.$ewpLoadingShow();
                this.$axios().post(`ebook`, this.form.data)
                    .then(res => {
                        let data = res?.data?.data;
                        this.uploadFileCover(data?.id);
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

                this.$ewpLoadingShow();
                this.$axios().put(`ebook/${this.form.idEdit}`, this.form.data)
                    .then(res => {
                        let data = res?.data?.data;
                        if(this.dropzoneCover.files.length){
                            this.uploadFileCover(data?.id);
                        }
                        else if(this.dropzoneFile.files.length){
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
            uploadFileCover(id){
                let that = this;
                this.dropzoneCover.on('processing', function(){
                    this.options.url = urlApi+`ebook/upload-thumbnail/${id}`;
                });
                this.dropzoneCover.on("sending", function(file, xhr, formData) {
                    formData.append("fileType", "thumbnail");
                });
                this.dropzoneCover.processQueue();
                this.dropzoneCover.on('error', function(){
                    that.$ewpLoadingHide();
                });
                this.dropzoneCover.on('success', function(){
                    if(that?.dropzoneFile?.files?.length){
                        that.uploadFile(id);
                    }
                    else{
                        $('.modal').modal('hide');
                        that.$ewpLoadingHide();
                        Swal.fire('Berhasil','Data berhasil disimpan','success').then(()=>{
                            that.getDataTable();
                        });
                    }
                });
            },
            uploadFile(id){
                let that = this;
                this.dropzoneFile.on('processing', function(){
                    this.options.url = urlApi+`ebook/upload-file/${id}`;
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
            changeKominfoAll(){
                this.$ewpLoadingShow();
                setTimeout(() => {                  
                    let checklist = [];                
                    let isChecked = $("#checkfor-all-ebook").is(":checked") ? 1 : 0;
                    let mainChecked = $("#checkfor-all-ebook").is(":checked") ? true : false;
                    for(let i = 0; i < this.tableConfig.data.body.length; i++){
                        if(this.tableConfig.data.body[i].isChecklist != mainChecked){
                             checklist.push({
                                id: this.tableConfig.data.body[i].id,
                                isChecklist: isChecked
                            })
                        }
                       
                    }
                    let formData = {
                        checklists: checklist
                    }
                    this.$axios().put(`ebook/checklist-data`,formData)
                        .then(res => {                        
                            toastr.success('Status berhasil diubah'); 
                            for(let i = 0; i < this.tableConfig.data.body.length; i++){
                                this.tableConfig.data.body[i].isChecklist = isChecked == 1 ? true : false;
                            }
                            this.checkCheckboxAll();
                        })
                        .catch(err => {
                            this.$axiosHandleError(err);
                            this.getDataTable();
                        })
                        .then(() => {
                            this.$ewpLoadingHide();
                        });    
                }, 500);
              
            },
            changeKominfoSelected(id, selected, index){
                this.$ewpLoadingShow();
                let checklist = [];
                checklist.push({
                    id: id,
                    isChecklist: selected ? 1 : 0
                })
                let formData = {
                    checklists: checklist
                }
                this.$axios().put(`ebook/checklist-data`,formData)
                    .then(res => {                
                        this.checkCheckboxAll();        
                        toastr.success('Status berhasil diubah');                        
                    })
                    .catch(err => {
                        this.$axiosHandleError(err);
                        this.getDataTable();
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

    .dz-bulat >>> #dropzone-cover.dropzone{
        position:relative !important;
    }
    .ebook.dz-bulat >>> #dropzone-cover .dz-preview.dz-image-preview{
        position:absolute !important;
        top:0;
        left:0;
        margin-left:-10px;
        margin-top:-10px;
        background-color: transparent !important;
    }
    .ebook.dz-bulat >>> #dropzone-cover .dz-preview.dz-image-preview .dz-image{
        border-radius:100% !important;
        z-index:0 !important;
        background-color: transparent !important;
    }
    .ebook.dz-bulat >>> #dropzone-cover .dz-preview.dz-image-preview .dz-image img[data-dz-thumbnail]{
        object-fit: cover !important;
        width: 100%;
        height: 100%;
    }
    .ebook.dz-bulat >>> #dropzone-cover .dz-preview.dz-image-preview .dz-details{
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
</style>

