<template>
    <div>
        <div id="main-content">
            <div class="post d-flex flex-column-fluid" id="kt_post">
                <div id="kt_content_container" class="container-xxl">
                    <div class="card card-flush mt-5 mb-5 mb-xl-10" id="kt_profile_details_view">
                        <div class="card card-xl-stretch mb-5 mb-xl-8">
                            <div class="card-header border-0 pt-5 align-items-center">
                                <div class="judul">
                                    <h2 class="text-gray-700">Artikel</h2>
                                    <span class="text-gray-700">Daftar artikel pada aplikasi Tourism Surabaya - Disbudporapar Kota Surabaya</span>
                                </div>
                                <div class="button d-flex">
                                    <button class="btn btn-success" @click="$router.push({name: 'a-artikel-tambah'})">Tambah Data</button>
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
                                                <div class="d-flex align-items-center">
                                                    <img :src="renderFile(context)" @error="$setNoImageUrl" class="me-2" alt="" style="width:50px; height:50px; border-radius:10px; object-fit: cover;">
                                                    <div class="d-flex flex-column">
                                                        <h6>{{ context?.title || '-' }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td valign="middle">
                                                <h6>{{ $moment(context?.end_date).format('DD/MM/YYYY (HH:mm:ss)') }}</h6>
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
                                                        <li><a class="dropdown-item p-2" href="javascript:void(0)" @click="$router.push({path: `artikel/edit/${context?.id}`})">Edit</a></li>
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
                qrcode: {
                    loading: false,
                    data: {
                        name: '',
                        link: ''
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
                                text: 'Judul',
                                sortBy: 'title',
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
                                    column: 'width:10%;',
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
        },
        methods: {
            getDataTable(){
                let that = this;
                this.tableConfig.config.loading = true;
                this.$axios().get(`article`, {params: this.tableConfig?.config})
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
                this.$axios().put(`article/switch-status/${id}`)
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
                this.qrcode.data.name = data?.title;
                this.qrcode.data.link = `${ this.$baseUrl() }/stroll-around/${data?.id}`;
                $('#modal-code').modal('show');
            },
            renderFile(data){
                return `${data?.articleThumbnail?.link}?token=${this.token}`;
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

    .dropzone{
        position:relative !important;
    }
    .dz-preview.dz-image-preview{
        position:absolute !important;
        top:0;
        left:0;
        margin-left:-10px;
        margin-top:-10px;
        background-color: transparent !important;
    }
    .dz-preview.dz-image-preview .dz-image{
        border-radius:100% !important;
        z-index:0 !important;
        background-color: transparent !important;
    }
    .dz-preview.dz-image-preview .dz-image img[data-dz-thumbnail]{
        object-fit: cover !important;
        width: 100%;
        height: 100%;
    }
    .dz-preview.dz-image-preview .dz-details{
        background-color: transparent !important;
    }

    .btn-outline-info{
        border:1px solid #0E5CA8 !important;
        background-color:#F1FAFF !important;
    }
</style>

