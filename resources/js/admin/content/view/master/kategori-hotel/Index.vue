<template>
    <div>
        <div id="main-content">
            <div class="post d-flex flex-column-fluid" id="kt_post">
                <div id="kt_content_container" class="container-xxl">
                    <div class="card card-flush mt-5 mb-5 mb-xl-10" id="kt_profile_details_view">
                        <div class="card card-xl-stretch mb-5 mb-xl-8">
                            <div class="card-header border-0 pt-5 align-items-center">
                                <div class="judul">
                                    <h2 class="text-gray-700">Master Kategori Hotel</h2>
                                    <span class="text-gray-700">Daftar kategori hotel pada aplikasi Tourism Surabaya - Disbudporapar Kota Surabaya</span>
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
                                                <b>Bintang {{ context?.starNumber }}</b>
                                            </td>
                                            <td valign="middle">
                                                <div class="d-flex">
                                                    <template v-for="(val, i) in Number(context?.starNumber)">
                                                        <i class="bi bi-star-fill me-3 text-warning"></i>
                                                    </template>
                                                </div>
                                            </td>
                                            <td valign="middle">
                                                <div class="m-auto form-check form-switch form-check-custom form-check-solid">
                                                    <input class="ms-auto form-check-input h-30px w-50px" type="checkbox" :checked="context?.isActive == 1 ? true : false" @change="switchStatus(context?.id)"/>
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
                                <h2 class="modal-title text-gray-700">{{ form.isEdit ? 'Edit' : 'Tambah' }} Kategori Hotel</h2>
                                <span class="text-muted">Silahkan lengkapi form berikut untuk {{ form.isEdit ? 'mengubah' : 'menambahkan' }} data.</span>
                            </div>
                        </div>
                        <!--begin::Close-->
                        <button type="button" class="btn-close m-2" data-bs-dismiss="modal" aria-label="Close"></button>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body">
                        <label for="name">Kategori Hotel</label>
                        <input v-model="form.data.starNumber" type="number" id="name" class="form-control" placeholder="Contoh: 1">
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
                                text: 'Kategori',
                                sortBy: 'starNumber',
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
                                text: 'Simbol',
                                sortBy: 'starNumber',
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
                                text: 'Status',
                                sortBy: 'isActive',
                                sort: true,
                                class: {
                                    column: '',
                                    wrap: '',
                                    text: ''
                                },
                                style: {
                                    column: '',
                                    wrap: '',
                                    text: 'text-align:right;',
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
                        starNumber: ''
                    }
                }
            }
        },
        mounted(){
            this.getDataTable();
        },
        methods: {
            getDataTable(){
                let that = this;
                this.tableConfig.config.loading = true;
                this.$axios().get(`master/hotel-category`, {params: this.tableConfig?.config})
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
                        starNumber: ''
                    }
                }
            },
            showModalAdd(){
                this.resetModal();
                $(`#modal-form`).modal('show');
            },
            edit(data){
                this.resetModal();
                this.form.isEdit = true;
                this.form.idEdit = data?.id;
                this.form.data.starNumber = data?.starNumber;
                $(`#modal-form`).modal('show');
            },
            simpan(){
                let that = this;

                this.$ewpLoadingShow();
                this.$axios().post(`master/hotel-category`, this?.form?.data)
                    .then(res => {
                        $(`.modal`).modal('hide');
                        Swal.fire('Berhasil','Data berhasil disimpan.','success');
                        this.getDataTable();
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

                this.$ewpLoadingShow();
                this.$axios().put(`master/hotel-category/${this?.form?.idEdit}`, this?.form?.data)
                    .then(res => {
                        $(`.modal`).modal('hide');
                        Swal.fire('Berhasil','Data berhasil disimpan.','success');
                        this.getDataTable();
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
                this.$axios().put(`master/hotel-category/switch-status/${id}`)
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
</style>

