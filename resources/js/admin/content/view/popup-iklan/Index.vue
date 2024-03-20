<template>
    <div>
        <div id="main-content">
            <div class="post d-flex flex-column-fluid" id="kt_post">
                <div id="kt_content_container" class="container-xxl">
                    <div class="card card-flush mt-5 mb-5 mb-xl-10" id="kt_profile_details_view">
                        <div class="card card-xl-stretch mb-5 mb-xl-8">
                            <div class="card-header border-0 pt-5 align-items-center">
                                <div class="judul">
                                    <h2 class="text-gray-700">Pop Up Iklan</h2>
                                    <span class="text-gray-700">Daftar iklan pada aplikasi Tourism Surabaya - Disbudporapar Kota Surabaya</span>
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
                                                <b>{{ context?.title }}</b>
                                            </td>
                                            <td valign="middle">
                                                {{ $moment(context?.startDate).locale('id').format('DD MMMM YYYY  HH:mm:ss') }} s/d {{ $moment(context?.endDate).locale('id').format('DD MMMM YYYY  HH:mm:ss') }}
                                            </td>
                                            <td valign="middle" class="text-center">
                                                <span class="badge badge-success" v-if="context.statusType == 'publish'">Publish</span>
                                                <span class="badge badge-secondary" v-if="context.statusType == 'draft'">Draft</span>
                                                <span class="badge badge-danger" v-if="context.statusType == 'hidden'">Disembunyikan</span>
                                            </td>
                                            <td valign="middle" class="text-center">
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Aksi</button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item p-2" href="javascript:void(0)" @click="$router.push({path: `popup-iklan/edit/${context?.id}`})">Edit</a></li>                                                        
                                                        <li v-if="context.statusType == 'hidden'"><a class="dropdown-item p-2" href="javascript:void(0)" @click="publish(context.id)">Publish</a></li>                                                        
                                                        <li v-if="context.statusType == 'publish'"><a class="dropdown-item p-2" href="javascript:void(0)" @click="sembunyikan(context.id)">Sembunyikan</a></li>                                                        
                                                        <li><a class="dropdown-item p-2" href="javascript:void(0)" @click="hapus(context.id)">Hapus</a></li>                                                        
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
                                text: 'Periode Penayangan',
                                sortBy: 'start_date',
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
                                sortBy: 'status_type',
                                sort: true,
                                class: {
                                    column: '',
                                    wrap: '',
                                    text: ''
                                },
                                style: {
                                    column: '',
                                    wrap: '',
                                    text: 'text-align:center;',
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
            }
        },
        mounted(){
            this.getDataTable();
        },
        methods: {
            getDataTable(){
                let that = this;
                this.tableConfig.config.loading = true;
                this.$axios().get(`advertisement`, {params: this.tableConfig?.config})
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
            showModalAdd(){    
                this.$router.push({
                    path:'/admin/popup-iklan/tambah'
                })           
            },
            hapus(id){    
                let that = this;  
                Swal.fire({
                    title: 'Hapus Data?',
                    html: `Data yang dihapus tidak dapat dikembalikan.`,
                    icon: 'warning',
                    showCancelButton: true,
                    showConfirmButton: true,
                    confirmButtonColor: 'red',
                    cancelButtonColor: 'gray',
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batal',
                }).then(result => {
                    if(result.isConfirmed){
                        that.$ewpLoadingShow();
                        that.$axios().delete(`advertisement/${id}`)
                            .then(res => {
                                Swal.fire('Berhasil','Data iklan dihapus','success').then(() => {
                                    that.getDataTable();
                                    that.tableConfig.config.currentPage = 1;
                                });
                            })
                            .catch(err => {
                                that.$axiosHandleError(err);
                            })
                            .then(() => {
                                that.$ewpLoadingHide();
                            });
                    }
                });        
            },   
            publish(id){
                
                let that = this; 
                let params = {
                    statusType: 'publish'
                } 
                that.$ewpLoadingShow();
                that.$axios().put(`advertisement/switch-status/${id}`,params)
                    .then(res => {
                        Swal.fire('Berhasil','Iklan berhasil ditayangkan dihalaman website','success').then(() => {
                            that.getDataTable();                                    
                        });
                    })
                    .catch(err => {
                        that.$axiosHandleError(err);
                    })
                    .then(() => {
                        that.$ewpLoadingHide();
                    });
            },    
            sembunyikan(id){
                let that = this; 
                let params = {
                    statusType: 'hidden'
                } 
                that.$ewpLoadingShow();
                that.$axios().put(`advertisement/switch-status/${id}`,params)
                    .then(res => {
                        Swal.fire('Berhasil','Iklan berhasil disembunyikan','success').then(() => {
                            that.getDataTable();                                    
                        });
                    })
                    .catch(err => {
                        that.$axiosHandleError(err);
                    })
                    .then(() => {
                        that.$ewpLoadingHide();
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

