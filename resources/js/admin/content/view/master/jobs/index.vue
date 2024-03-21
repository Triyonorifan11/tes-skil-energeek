<template>
    <div>
        <div id="main-content">
            <div class="post d-flex flex-column-fluid" id="kt_post">
                <div id="kt_content_container" class="container-xxl">
                    <div class="card card-flush mt-5 mb-5 mb-xl-10" id="kt_profile_details_view">
                        <div class="card card-xl-stretch mb-5 mb-xl-8">
                            <div class="card-header border-0 pt-5 align-items-center">
                                <div class="judul">
                                    <h2 class="text-gray-700">Master Skill</h2>
                                    <span class="text-gray-700">Daftar skill yang diperlukan</span>
                                </div>
                                <div class="button">
                                    <button class="btn btn-danger" @click="showModalAdd">Tambah Data</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <app-data-table :table-config="tableConfig" @get-data="getDataTable">
                                    <template v-slot:body>
                                        <tr v-for="(context, index) in tableConfig?.data?.body">
                                            <td valign="middle">
                                                <div
                                                    class="d-flex flex-column justify-content-center align-items-center">
                                                    {{ index + 1 + ((tableConfig?.config?.currentPage - 1) *
                                        tableConfig?.config?.limit) }}
                                                </div>
                                            </td>
                                            <td valign="middle">
                                                <b>{{ context?.name }}</b>
                                            </td>
                                            <td valign="middle">
                                                <b>{{ formatDate(context.createdAt) }}</b>
                                            </td>

                                            <td valign="middle" class="text-center">
                                                <button class="btn btn-secondary btn-sm" title="edit"
                                                    @click="edit(context)"><i class="bi bi-pen"></i></button>
                                                <button class="btn btn-danger btn-sm ms-2" title="hapus"
                                                    @click="destroy(context)"><i class="bi bi-trash"></i></button>
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
                                <h2 class="modal-title text-gray-700">{{ form.isEdit ? 'Edit' : 'Tambah' }} Skill</h2>
                                <span class="text-muted">Silahkan lengkapi form berikut untuk {{ form.isEdit ?
                                        'mengubah' :
                                        'menambahkan' }} data.</span>
                            </div>
                        </div>
                        <!--begin::Close-->
                        <button type="button" class="btn-close m-2" data-bs-dismiss="modal" aria-label="Close"></button>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body">
                        <label for="name">Nama Skill</label>
                        <input v-model="form.data.name" type="text" id="name" class="form-control"
                            placeholder="Contoh: PHP Laravel">
                        <br>
                    </div>
                    <div class="modal-footer d-flex justify-content-center align-items-center">
                        <button class="btn btn-secondary btn-sm me-4" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-success btn-sm"
                            @click="this.form.isEdit ? update() : simpan()">Simpan</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>


<script>
export default {
    data() {
        return {
            token: localStorage.getItem('token'),
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
                            text: 'Skill',
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
                            text: 'Dibuat pada',
                            sortBy: 'createdAt',
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
                    name: ''
                }
            }
        }
    },
    mounted() {
        this.getDataTable();
    },
    methods: {
        formatDate(date) {
            const options = {
                weekday: "long",
                year: "numeric",
                month: "long",
                day: "numeric",
            };
            const dateTemp = new Date(date);
            return dateTemp.toLocaleDateString("id-ID", options);
        },
        getDataTable() {
            let that = this;
            this.tableConfig.config.loading = true;
            this.$axios().get(`master/jobs`, { params: this.tableConfig?.config })
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
        resetModal() {
            this.form = {
                isEdit: false,
                idEdit: '',
                data: {
                    name: '',
                }
            }
        },
        showModalAdd() {
            this.resetModal();
            $(`#modal-form`).modal('show');
        },
        edit(data) {
            this.resetModal();
            this.form.isEdit = true;
            this.form.idEdit = data?.id;
            this.form.data.name = data?.name;
            $(`#modal-form`).modal('show');
        },
        simpan() {
            let that = this;

            this.$ewpLoadingShow();
            this.$axios().post(`master/jobs`, this?.form?.data)
                .then(res => {
                    $(`.modal`).modal('hide');
                    Swal.fire('Berhasil', 'Data berhasil disimpan.', 'success');
                    this.getDataTable();
                })
                .catch(err => {
                    this.$axiosHandleError(err);
                })
                .then(() => {
                    this.$ewpLoadingHide();
                });
        },
        update() {
            let that = this;

            this.$ewpLoadingShow();
            this.$axios().put(`master/jobs/${this?.form?.idEdit}`, this?.form?.data)
                .then(res => {
                    $(`.modal`).modal('hide');
                    Swal.fire('Berhasil', 'Data berhasil disimpan', 'success');
                    this.getDataTable();
                })
                .catch(err => {
                    this.$axiosHandleError(err);
                })
                .then(() => {
                    this.$ewpLoadingHide();
                });
        },
        

        async questionSwal(title, icon, text) {
            const swal = await Swal.fire({
                title,
                icon,
                text,
                showCancelButton: true,
                confirmButtonText: "Yes",
                confirmButtonColor: "#9061f9",
            });
            const result = swal.isConfirmed;
            return result;
        },

        async destroy(data) {
            const id = data?.id;
            const res = await this.questionSwal("Apakah Anda yakin?", 'warning', 'Data akan terhapus secara permanen!');
            if (res) {
                this.$ewpLoadingShow();
                this.$axios().delete(`master/jobs/${id}`)
                    .then(res => {
                        $(`.modal`).modal('hide');
                        toastr.success('Data berhasil dihapus');
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
    },
}
</script>

<style scoped>
.table-pomdes table thead,
.table-pomdes table tbody,
.table-pomdes table tr td,
.table-pomdes table tr th {
    border: 1px solid black !important;
}

.table-pomdes table tr td,
.table-pomdes table tr th {
    padding: 10px !important;
}

.form-check-custom.form-check-solid .form-check-input:checked {
    background-color: #50CD89;
}
</style>
