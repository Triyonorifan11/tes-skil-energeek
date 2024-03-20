<template>
    <div class="index-setting-header">
        <div id="main-content">
            <div class="post d-flex flex-column-fluid" id="kt_post">
                <div id="kt_content_container" class="container-xxl">
                    <div class="card card-flush mt-5 mb-5 mb-xl-10" id="kt_profile_details_view">
                        <div class="card card-xl-stretch mb-5 mb-xl-8">
                            <div class="card-header border-0 pt-5 align-items-center">
                                <div class="judul">
                                    <h2 class="text-gray-700">Hotel</h2>
                                    <span class="text-gray-700">Daftar hotel pada aplikasi Tourism Surabaya - Disbudporapar Kota Surabaya</span>
                                </div>
                                <div class="button d-flex">
                                    <button class="btn btn-outline-info me-3 dropdown-toggle">Export</button>
                                    <button class="btn btn-success" @click="$router.push({name: 'a-hotel-tambah'})">Tambah Data</button>
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
                                                    <div class="me-3" style="cursor:pointer" @click="pinHotel(context.id, context.isPinned)">
                                                        <svg v-if="context.isPinned" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_2086_18806)">
                                                        <path d="M23.3203 8.76562C23.0625 9.02344 22.8125 9.25781 22.5703 9.46875C22.3281 9.67969 22.0703 9.86328 21.7969 10.0195C21.5234 10.1758 21.2383 10.2891 20.9414 10.3594C20.6445 10.4297 20.2969 10.4727 19.8984 10.4883C19.6328 10.4883 19.3789 10.4648 19.1367 10.418L14.6953 14.8594C14.7969 15.1563 14.8711 15.4609 14.918 15.7734C14.9648 16.0859 14.9883 16.3984 14.9883 16.7109C14.9883 17.2187 14.9375 17.6797 14.8359 18.0938C14.7344 18.5078 14.5898 18.8984 14.4023 19.2656C14.2148 19.6328 13.9805 19.9805 13.6992 20.3086C13.418 20.6367 13.1094 20.9766 12.7734 21.3281L8.25 16.8047L1.59375 23.4727L0 24L0.527344 22.4062L7.19531 15.75L2.67188 11.2266C3.01563 10.8828 3.35156 10.5742 3.67969 10.3008C4.00781 10.0273 4.35547 9.79688 4.72266 9.60938C5.08984 9.42188 5.48047 9.27344 5.89453 9.16406C6.30859 9.05469 6.77344 9.00391 7.28906 9.01172C7.60156 9.01172 7.91406 9.03516 8.22656 9.08203C8.53906 9.12891 8.84375 9.20312 9.14062 9.30469L13.582 4.86328C13.5352 4.62109 13.5117 4.36719 13.5117 4.10156C13.5117 3.71875 13.5508 3.375 13.6289 3.07031C13.707 2.76562 13.8242 2.47656 13.9805 2.20312C14.1367 1.92969 14.3164 1.67578 14.5195 1.44141C14.7227 1.20703 14.9609 0.953125 15.2344 0.679688L23.3203 8.76562Z" fill="#FFA800"/>
                                                        </g>
                                                        <defs>
                                                        <clipPath id="clip0_2086_18806">
                                                        <rect width="24" height="24" fill="white"/>
                                                        </clipPath>
                                                        </defs>
                                                        </svg>
                                                        <svg v-else width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_2086_18824)">
                                                        <path d="M23.3203 8.76562C23.0625 9.02344 22.8125 9.25781 22.5703 9.46875C22.3281 9.67969 22.0742 9.86328 21.8086 10.0195C21.543 10.1758 21.2578 10.2891 20.9531 10.3594C20.6484 10.4297 20.2969 10.4727 19.8984 10.4883C19.6328 10.4883 19.3789 10.4648 19.1367 10.418L14.6953 14.8594C14.7969 15.1563 14.8711 15.4609 14.918 15.7734C14.9648 16.0859 14.9883 16.3984 14.9883 16.7109C14.9883 17.2187 14.9375 17.6797 14.8359 18.0938C14.7344 18.5078 14.5898 18.8984 14.4023 19.2656C14.2148 19.6328 13.9805 19.9805 13.6992 20.3086C13.418 20.6367 13.1094 20.9766 12.7734 21.3281L8.25 16.8047L1.59375 23.4727L0 24L0.527344 22.4062L7.19531 15.75L2.67188 11.2266L3.19922 10.6992C3.74609 10.1523 4.37109 9.73437 5.07422 9.44531C5.77734 9.15625 6.51953 9.01172 7.30078 9.01172C7.94141 9.01172 8.55469 9.10938 9.14062 9.30469L13.582 4.86328C13.5352 4.62109 13.5117 4.36719 13.5117 4.10156C13.5117 3.71875 13.5508 3.375 13.6289 3.07031C13.707 2.76562 13.8242 2.47656 13.9805 2.20312C14.1367 1.92969 14.3164 1.67578 14.5195 1.44141C14.7227 1.20703 14.9609 0.953125 15.2344 0.679688L23.3203 8.76562ZM19.8984 8.98828C20.3281 8.98828 20.7344 8.88672 21.1172 8.68359L15.3164 2.88281C15.1133 3.26563 15.0117 3.67187 15.0117 4.10156C15.0117 4.32031 15.0352 4.52344 15.082 4.71094C15.1289 4.89844 15.1875 5.09766 15.2578 5.30859L9.49219 11.0625C9.29688 10.9844 9.11328 10.9102 8.94141 10.8398C8.76953 10.7695 8.59766 10.7109 8.42578 10.6641C8.25391 10.6172 8.07812 10.582 7.89844 10.5586C7.71875 10.5352 7.51953 10.5195 7.30078 10.5117C6.85547 10.5117 6.42578 10.5742 6.01172 10.6992C5.59766 10.8242 5.20703 11.0156 4.83984 11.2734L12.7266 19.1602C12.9766 18.8008 13.168 18.4141 13.3008 18C13.4336 17.5859 13.5 17.1562 13.5 16.7109C13.5 16.5 13.4883 16.3047 13.4648 16.125C13.4414 15.9453 13.4023 15.7656 13.3477 15.5859C13.293 15.4063 13.2305 15.2305 13.1602 15.0586C13.0898 14.8867 13.0156 14.7031 12.9375 14.5078L18.6914 8.74219C18.8945 8.80469 19.0898 8.85938 19.2773 8.90625C19.4648 8.95312 19.6719 8.98047 19.8984 8.98828Z" fill="#888C9F"/>
                                                        </g>
                                                        <defs>
                                                        <clipPath id="clip0_2086_18824">
                                                        <rect width="24" height="24" fill="white"/>
                                                        </clipPath>
                                                        </defs>
                                                        </svg>


                                                    </div>
                                                    <img @error="$setNoImageUrl" :src="renderFile(context)" class="me-2" alt="" style="width:50px; height:50px; border-radius:10px; object-fit: cover;">
                                                    <div class="d-flex flex-column">
                                                        <h6>{{ context?.name || '-' }}</h6>
                                                        <small class="text-muted">{{ context?.address || '-' }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td valign="middle">
                                                <span>Bintang {{ context?.hotelCategory?.starNumber }}</span>
                                                <br>
                                                <div class="star d-flex justify-content-between mt-2">
                                                    <i class="bi bi-star-fill me-3 text-warning" v-for="(val, i) in Number(context?.hotelCategory?.starNumber)"></i>
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
                                                        <li><a class="dropdown-item p-2" href="javascript:void(0)" @click="$router.push({path: `hotel/edit/${context?.id}`})">Edit</a></li>
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
                                text: '<input type="checkbox" id="checkfor-all-hotel" style="width:20px;height:20px;"/>',
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
                                text: 'Hotel',
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
            $("body").on('click','#checkfor-all-hotel',function(){                   
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
                this.$axios().get(`menu-header?headerType=hotel`)
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
                data.headerType = 'hotel';

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
                    $("#checkfor-all-hotel").removeAttr('disabled');
                    if(!this.tableConfig.data.body.filter((e) => !e.isChecklist).length){
                        $("#checkfor-all-hotel").prop('checked',true); 
                    }else{
                        $("#checkfor-all-hotel").prop('checked',false); 
                    }
                }
            },
            getDataTable(){
                let that = this;
                this.tableConfig.config.loading = true;

                this.tableConfig.data.body = [];

                $("#checkfor-all-hotel").attr('disabled',true).prop('checked',false);

                this.$axios().get(`hotel`, {params: this.tableConfig?.config})
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
                this.$axios().put(`hotel/switch-status/${id}`)
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
            pinHotel(id, isPinned){                
                this.$ewpLoadingShow();
                this.$axios().put(`hotel/pin-hotel/${id}`)
                    .then(res => {                       
                        
                        if(isPinned){
                            Swal.fire('Berhasil','Unpinned berhasil','success')
                        }else[
                            Swal.fire('Berhasil','Pinned berhasil','success')
                        ]
                        
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
                this.qrcode.data.link = `${ this.$baseUrl() }/hotel/${data?.id}`;
                $('#modal-code').modal('show');
            },
            downloadQr(){
                let x = document.createElement('a');
                x.href = $('#wrap-qrcode img').attr('src');
                x.download = 'qrcode.png';
                x.click();
            },
            renderFile(data){
                return `${data?.hotelThumbnail?.link}?token=${this.token}`;
            },
            changeKominfoAll(){
                this.$ewpLoadingShow();
                setTimeout(() => {           
                    
                    let checklist = [];                
                    let isChecked = $("#checkfor-all-hotel").is(":checked") ? 1 : 0;
                    let mainChecked = $("#checkfor-all-hotel").is(":checked") ? true : false;
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
                    this.$axios().put(`hotel/checklist-data`,formData)
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
                this.$axios().put(`hotel/checklist-data`,formData)
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

