<template>
    <div class="index-setting-header">
        <div id="main-content">
            <div class="post d-flex flex-column-fluid" id="kt_post">
                <div id="kt_content_container" class="container-xxl">
                    <div class="card card-flush mt-5 mb-5 mb-xl-10" id="kt_profile_details_view">
                        <div class="card card-xl-stretch mb-5 mb-xl-8">
                            <div class="card-header border-0 pt-5 align-items-center">
                                <div class="judul">
                                    <h2 class="text-gray-700">Eat & Drink</h2>
                                    <span class="text-gray-700">Daftar artikel pada aplikasi Tourism Surabaya - Disbudporapar Kota Surabaya</span>
                                </div>
                                <div class="button d-flex">
                                    <button class="btn btn-success" @click="$router.push({name: 'a-culinary-tambah'})">Tambah Data</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="card setting-header" style="box-shadow:0px 0px 5px lightgray;">
                                    <div class="card-body">
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
                                <br>
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
                                                    <img @error="$setNoImageUrl" :src="renderFile(context)" class="me-2" alt="" style="width:50px; height:50px; border-radius:10px; object-fit: cover;">
                                                    <div class="d-flex flex-column">
                                                        <h6>{{ context?.name || '-' }}</h6>
                                                        <small class="text-muted">{{ context?.address || '-' }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td valign="middle">
                                                <span class="badge badge-light-info" v-for="(val, i) in context?.culinaryCategories" style="word-break:break-all !important; max-width:100%;">{{ val?.name }}</span>
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
                                                        <li><a class="dropdown-item p-2" href="javascript:void(0)" @click="$router.push({path: `culinary/edit/${context?.id}`})">Edit</a></li>
                                                        <li><a class="dropdown-item p-2" href="javascript:void(0)" @click="modalQRCode(context)">QR Code</a></li>
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

        <div class="modal fade" tabindex="-1" id="modal-code">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="m-auto" style="width:100%;">
                            <div class="d-flex flex-column justify-content-center align-items-center">
                                <h1 class="modal-title text-gray-700">QR Code</h1>
                                <h6 class="text-gray-700 mt-3">{{ qrcode.data.name }}</h6>
                            </div>
                        </div>
                        <!--begin::Close-->
                        <button type="button" class="btn-close m-2" data-bs-dismiss="modal" aria-label="Close"></button>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body justify-content-center align-items-center d-flex" id="wrap-qrcode">
                        <vue-qrcode :value="qrcode.data.link" :quality="1" style="width:70%;"></vue-qrcode>
                    </div>
                    <div class="modal-footer d-flex justify-content-center align-items-center">
                        <button class="btn btn-secondary btn-sm btn-success me-4" @click="downloadQr()">Unduh</button>
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
                selectList: {
                },
                filter: {
                    category: ''
                },
                qrcode: {
                    loading: false,
                    data: {
                        name: '',
                        link: ''
                    }
                },
                formHeader: {
                    loading: false,
                    dzHeader: '',
                    dzHeaderView: '',
                    data: {
                        id: '',
                        heading: '',
                        description: ''
                    }
                },
                tableConfig: {
                    data: {
                        header: [
                            {
                                text: '<input type="checkbox" id="checkfor-all-culinary" style="width:20px;height:20px;"/>',
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
                                text: 'Judul',
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
                                text: 'Kategori',
                                sortBy: 'tourismCategory',
                                sort: false,
                                class: {
                                    column: '',
                                    wrap: '',
                                    text: ''
                                },
                                style: {
                                    column: 'width:27%;',
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
                        search: '',
                        categoryId: ''
                    }
                },
                qrCode: {

                }
            }
        },
        mounted(){
            let that = this;
            $("body").on('click','#checkfor-all-culinary',function(){                
                that.changeKominfoAll();
            });
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
                this.$axios().get(`menu-header?headerType=culinary`)
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
                data.headerType = 'culinary';

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
            checkCheckboxAll(){
                if(this.tableConfig.data.body.length > 0){
                    $("#checkfor-all-culinary").removeAttr('disabled');
                    if(!this.tableConfig.data.body.filter((e) => !e.isChecklist).length){
                        $("#checkfor-all-culinary").prop('checked',true); 
                    }else{
                        $("#checkfor-all-culinary").prop('checked',false); 
                    }
                }
            },
            getDataTable(){
                let that = this;
                this.tableConfig.config.loading = true;

                this.tableConfig.data.body = [];
                $("#checkfor-all-culinary").attr('disabled',true).prop('checked',false);
                this.$axios().get(`culinary`, {params: this.tableConfig?.config})
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
            switchStatus(id){
                let that = this;

                this.$ewpLoadingShow();
                this.$axios().put(`culinary/switch-status/${id}`)
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
            modalQRCode(data){
                let that = this;
                this.qrcode.data.name = data?.name;
                this.qrcode.data.link = `${ this.$baseUrl() }/culinary/${data?.id}`;
                $('#modal-code').modal('show');
            },
            downloadQr(){
                let x = document.createElement('a');
                x.href = $('#wrap-qrcode img').attr('src');
                x.download = 'qrcode.png';
                x.click();
            },
            renderFile(data){
                return `${data?.culinaryThumbnail?.link}?token=${this.token}`;
            },
            changeKominfoAll(){
                this.$ewpLoadingShow();
                setTimeout(() => {     
                    let checklist = [];                
                    let isChecked = $("#checkfor-all-culinary").is(":checked") ? 1 : 0;
                    let mainChecked = $("#checkfor-all-culinary").is(":checked") ? true : false;
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
                    this.$axios().put(`culinary/checklist-data`,formData)
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
                this.$axios().put(`culinary/checklist-data`,formData)
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

    .btn-outline-info{
        border:1px solid #0E5CA8 !important;
        background-color:#F1FAFF !important;
    }
</style>

