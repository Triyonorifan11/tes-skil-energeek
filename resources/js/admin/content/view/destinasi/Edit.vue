<template>
    <div>
        <div id="main-content">
            <div class="post d-flex flex-column-fluid" id="kt_post">
                <div id="kt_content_container" class="container-xxl">
                    <div class="card card-flush mt-5 mb-5 mb-xl-10" id="kt_profile_details_view">
                        <div class="card card-xl-stretch mb-5 mb-xl-8">
                            <div class="card-header border-0 pt-5 align-items-center">
                                <div class="judul">
                                    <h2 class="text-gray-700">Edit Destinasi Wisata</h2>
                                    <span class="text-gray-700">Daftar user pada aplikasi Tourism Surabaya - Disbudporapar Kota Surabaya</span>
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
                                    <div class="loader justify-content-center align-items-center">
                                        <app-loader></app-loader>
                                    </div>
                                </template>
                                <template v-else>
                                    <div class="card" style="border:2px dashed lightgray;">
                                        <div class="card-body">
                                            <div class="button-bahasa">
                                                <template v-for="(context, index) in form?.data?.destinations">
                                                    <button :class="`btn btn-outline-success me-5 my-3 ${context?.language?.id == form?.langSelectedId ? 'active' : ''}`" style="position:relative;" @click="clickActiveLanguage(context?.language?.id)">
                                                        <button class="btn-close-lang" v-if="index != 0" @click="removeDestinations(index)">x</button>
                                                        {{ context?.language?.text || 'Pilih bahasa' }}
                                                    </button>
                                                </template>
                                                <button class="btn btn-outline-success" :disabled="form.data.destinations.findIndex(value => !value?.language?.id) != -1 ? true : false" @click="addDestinations">
                                                    <svg width="20" height="19" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10.0001 9.50008H1.66675M10.0001 1.16675V9.50008V1.16675ZM10.0001 9.50008V17.8334V9.50008ZM10.0001 9.50008H18.3334H10.0001Z" stroke="#049C4F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                                    Tambah
                                                </button>
                                            </div>
                                            <br>
                                            <template v-for="(context, index) in form?.data?.destinations">
                                                <template v-if="form.langSelectedId == context?.language?.id">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="lang">Bahasa</label>
                                                            <app-select2 id="lang" v-model="context.language" :disabled="index == 0" :options="selectList.language.list" :loading="selectList.language.loading" @get-options="getLanguage" placeholder="Pilih bahasa" @change-options="changeLanguage" :multiple="false"></app-select2>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <label for="name">Nama Destinasi</label>
                                                            <input type="text" id="name" v-model="context.name" class="form-control" placeholder="Masukkan nama destinasi">
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <label for="desc">Deskripsi</label>
                                                    <QuillEditor theme="snow" :toolbar="toolbarOptions" v-model:content="context.description" contentType="html" />
                                                    <!-- <app-tinymce v-model="context.description"></app-tinymce> -->
                                                    <!-- <textarea v-model="context.description" id="desc" rows="5" class="form-control" placeholder="Masukkan deskripsi"></textarea> -->
                                                </template>
                                            </template>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="info-global">
                                        <h1 class="text-success">Info Global</h1>
                                        <div class="foto d-flex align-items-center my-4" style="flex-wrap:wrap;">
                                                <div v-for="(context,index) in dropzoneFileFiles" class="item-foto me-5 my-5" style="border-radius:10px; width:115px; height:105px; background-color:transparent; position:relative;">
                                                    <img :id="`image-item-${index}`" :src="context?.dataURL" style="width:100%; height:100%; border-radius:10px; object-fit:cover !important;" alt="item">
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
                                        <div class="htm">
                                            <div class="ndas d-flex align-items-center justify-content-between mb-3">
                                                <h6>Harga Tiket Masuk (HTM)</h6>
                                                <div class="check-all-gratis">
                                                    <div class="form-check form-check-custom form-check-solid">
                                                        <input v-model="form.data.isFreeForAll" class="form-check-input me-2" type="checkbox" id="all-free"/>
                                                        <label class="form-check-label" for="all-free">
                                                            <b>Gratis Untuk Semua</b>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <template v-if="form?.data?.isFreeForAll">
                                                <div class="card" style="background-color:#F1FAFF;">
                                                    <div class="card-body d-flex align-items-center">
                                                        <div class="wrap-icon me-5">
                                                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M27.4057 5.83773L16.2397 2.69972C16.0835 2.65576 15.9168 2.65576 15.7604 2.69972L4.59429 5.83773C4.24157 5.93685 4 6.24101 4 6.58601V18.0921C4 19.5886 4.64679 21.1206 5.92227 22.6454C6.89641 23.8101 8.24419 24.9794 9.928 26.1213C12.7567 28.0394 15.5421 29.2161 15.6593 29.2651C15.7677 29.3106 15.8839 29.3334 16.0001 29.3334C16.1163 29.3334 16.2325 29.3107 16.3409 29.2651C16.458 29.2161 19.2435 28.0394 22.0721 26.1213C23.7559 24.9794 25.1036 23.8101 26.0779 22.6454C27.3533 21.1206 28 19.5886 28 18.0921V6.58601C28 6.24101 27.7585 5.93685 27.4057 5.83773Z" fill="#009EF7"/><path d="M14.0807 15.0722L12.7637 13.7357C12.3755 13.3419 11.7402 13.3419 11.352 13.7357C10.9718 14.1215 10.9718 14.7411 11.352 15.1269L13.8908 17.703C14.4131 18.2329 15.2679 18.2329 15.7902 17.703L20.6477 12.7739C21.0279 12.3882 21.0279 11.7686 20.6477 11.3828C20.2596 10.9889 19.6243 10.9889 19.2362 11.3828L15.6002 15.0722C15.1824 15.4961 14.4986 15.4961 14.0807 15.0722Z" fill="#009EF7"/></svg>
                                                        </div>
                                                        <div class="wrap-tulisan">
                                                            <h3>Destinasi Gratis</h3>
                                                            <span>Tiket masuk destinasi ini adalah gratis</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </template>
                                            <template v-else>
                                                <div class="card" style="border:1px dashed green;">
                                                    <div class="card-body">
                                                        <div class="row my-3" v-for="(context, index) in form.data.tickets">
                                                            <div class="col-md-5">
                                                                <input v-model="context.name" type="text" class="form-control" placeholder="Contoh: Anak-anak">
                                                            </div>
                                                            <div class="col-md-5">
                                                                <div class="input-group">
                                                                    <span class="input-group-text text-gray-500" :id="`basic-addon${index}`">Rp</span>
                                                                    <app-money3 v-model="context.price" :disabled="context.isFree" class="form-control" placeholder="Masukkan harga" v-bind="money3"></app-money3>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1 d-flex align-items-center">
                                                                <div class="form-check form-check-custom form-check-solid">
                                                                    <input @click="clickFree(index)" class="form-check-input me-2" :checked="context?.isFree" type="checkbox" :id="`free-${index}`"/>
                                                                    <label class="form-check-label" :for="`free-${index}`">
                                                                        <b>Gratis</b>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1 d-flex justify-content-center align-items-center">
                                                                <button class="btn btn-light-danger btn-sm" v-if="index > 0" @click="removeTicket(index)">
                                                                    <i class="bi bi-trash fa-2x"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="btn btn-outline-success active my-2" @click="addTicket">
                                                    <svg width="20" height="19" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10.0001 9.50008H1.66675M10.0001 1.16675V9.50008V1.16675ZM10.0001 9.50008V17.8334V9.50008ZM10.0001 9.50008H18.3334H10.0001Z" stroke="#049C4F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                                    Tambah Spesifik Harga
                                                </button>
                                            </template>
                                        </div>
                                        <br>
                                        <div class="open">
                                            <h6>Jam Buka</h6>
                                            <div class="card" style="border:1px dashed green;">
                                                <div class="card-body">
                                                    <div class="row my-3" v-for="(context, index) in form.data.openingHours">
                                                        <div class="col-md-3">
                                                            <input v-model="context.day" type="text" class="form-control" placeholder="Contoh: Senin">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <app-datepicker v-model:value="context.startTime" :disabled="context.isClose" type="time" input-class="form-control" input-style="width:100% !important;" format="HH:mm:ss" value-type="HH:mm:ss" placeholder="Jam mulai"></app-datepicker>
                                                        </div>
                                                        <div class="col-md-1 d-flex align-items-center justify-content-center">s/d</div>
                                                        <div class="col-md-3">
                                                            <app-datepicker v-model:value="context.endTime" :disabled="context.isClose" type="time" input-class="form-control" input-style="width:100% !important;" format="HH:mm:ss" value-type="HH:mm:ss" placeholder="Jam Tutup"></app-datepicker>
                                                        </div>
                                                        <div class="col-md-1 d-flex align-items-center">
                                                            <div class="form-check form-check-custom form-check-solid">
                                                                <input @click="clickClose(index)" class="form-check-input me-2" type="checkbox" :id="`close-${index}`" :checked="context.isClose ? true : false"/>
                                                                <label class="form-check-label" :for="`close-${index}`">
                                                                    <b>Tutup</b>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1 d-flex justify-content-center align-items-center">
                                                            <button class="btn btn-light-danger btn-sm" v-if="index > 0" @click="removeOpening(index)">
                                                                <i class="bi bi-trash fa-2x"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-outline-success active my-2" @click="addOpening">
                                                <svg width="20" height="19" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10.0001 9.50008H1.66675M10.0001 1.16675V9.50008V1.16675ZM10.0001 9.50008V17.8334V9.50008ZM10.0001 9.50008H18.3334H10.0001Z" stroke="#049C4F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                                Tambah Spesifik Jam Buka
                                            </button>
                                        </div>
                                        <br>
                                        <label>URL Social Media</label>
                                        <div class="card" style="border:1px dashed #2FAF6E;">
                                            <div class="card-body p-5">
                                                <table class="table">
                                                    <tr v-for="(context,index) in form?.data?.socialMedia">
                                                        <td style="width:6%;"><div class="d-flex align-items-center justify-content-center" v-html="context?.icon"></div></td>
                                                        <td><input :disabled="!context.isActive" v-model="context.url" type="text" class="form-control" placeholder="Masukkan URL sosial media"></td>
                                                        <td style="width:10%;">
                                                            <div class="m-auto form-check form-switch form-check-custom form-check-solid">
                                                                <input class="m-auto form-check-input abang h-30px w-50px" type="checkbox" v-model="context.isActive" @change="context.url = ''"/>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <br>
                                        <label for="category">Kategori</label>
                                        <app-select2 id="category" v-model="form.data.category" :loading="selectList.category.loading" :options="selectList?.category?.list" @get-options="getCategory" placeholder="Pilih kategori" :multiple="true"></app-select2>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <template v-if="superior.loading">
                                                    <div class="loader d-flex justify-content-center align-items-center">
                                                        <app-loader></app-loader>
                                                    </div>
                                                </template>
                                                <template v-else>
                                                    <label for="superior">Destinasi Unggulan</label><span class="mx-4 badge" style="background-color:#0E5CA8;">Sisa {{ superior.count || '-' }}</span>
                                                    <div class="m-auto my-4 form-check form-switch form-check-custom form-check-solid">
                                                        <input class="me-auto form-check-input h-30px w-50px" type="checkbox" :checked="form.data.isSuperior == 1 ? true : false" @change="form.data.isSuperior == 1 ? form.data.isSuperior = 0 : form.data.isSuperior = 1; form.data.isSuperior == 1 ? superior.count-- : superior.count++;"/>
                                                    </div>
                                                </template>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="web">Website Resmi(opsional)</label>
                                                <input v-model="form.data.websiteLink" id="web" type="text" class="form-control" placeholder="cth:https://www.google.com/">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="contact">Kontak</label>
                                                <input v-model="form.data.contact" id="contact" type="text" class="form-control" placeholder="Cth: 081239482920">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="jurisdiction">Wilayah Yursidiksi</label>
                                                <app-select2 id="jurisdiction" v-model="form.data.jurisdiction" :loading="selectList.jurisdiction.loading" :options="selectList?.jurisdiction?.list" @get-options="getJurisdiction" placeholder="Pilih wilayah yurisdiksi" :multiple="false"></app-select2>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="web">Alamat</label>
                                                <input v-model="form.data.address" id="address" type="text" class="form-control" placeholder="Masukkan alamat lengkap">
                                            </div>
                                        </div>
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
                                            <br><br>
                                            <div class="btn-simpan d-flex justify-content-center align-items-center">
                                                <button class="btn btn-success btn-sm" @click="simpan()">Simpan Data</button>
                                            </div>
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
                    language: {
                        loading: false,
                        list: []
                    },
                    category: {
                        loading: false,
                        list: []
                    },
                    jurisdiction: {
                        loading: false,
                        list: []
                    },
                },
                dropzoneFile: '',
                dropzoneFileFiles: '',
                indexFileThumbnails: '',
                toolbarOptions: [
                    ['bold', 'italic', 'underline', 'strike'],        // toggled buttons

                    [{ 'header': 1 }, { 'header': 2 }],               // custom button values
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
                    [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
                    [{ 'direction': 'rtl' }],                         // text direction

                    [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
                    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

                    [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
                    [{ 'font': [] }],
                    [{ 'align': [] }],
                    ['image'],
                    ['clean']                                         // remove formatting button
                ],
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
                    langSelectedId: VITE_INDONESIAN_LANGUAGE_ID,
                    data: {
                        destinations: [
                            {
                                language: {id: VITE_INDONESIAN_LANGUAGE_ID, code: 'ID', text: 'Indonesia'},
                                languageId: '',
                                name: '',
                                description: '',
                            }
                        ],
                        photos: [//
                            {
                                file: '',
                                fileType: ''
                            }
                        ],
                        tickets: [
                            {
                                name: '',
                                price: ''
                            }
                        ],
                        category: [],
                        categories: [],
                        openingHours: [
                            {
                                day: '',
                                startTime: '',
                                endTime: '',
                                isClose: false
                            }
                        ],
                        socialMedia: [
                            {
                                icon: `
                                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M24.0001 2.00024H8.0002C4.68652 2.00024 2.00024 4.68652 2.00024 8.0002V24.0001C2.00024 27.3138 4.68652 30.0001 8.0002 30.0001H24.0001C27.3138 30.0001 30.0001 27.3138 30.0001 24.0001V8.0002C30.0001 4.68652 27.3138 2.00024 24.0001 2.00024Z" fill="url(#paint0_radial_2003_16507)"/><path d="M24.0001 2.00024H8.0002C4.68652 2.00024 2.00024 4.68652 2.00024 8.0002V24.0001C2.00024 27.3138 4.68652 30.0001 8.0002 30.0001H24.0001C27.3138 30.0001 30.0001 27.3138 30.0001 24.0001V8.0002C30.0001 4.68652 27.3138 2.00024 24.0001 2.00024Z" fill="url(#paint1_radial_2003_16507)"/><path d="M24.0001 2.00024H8.0002C4.68652 2.00024 2.00024 4.68652 2.00024 8.0002V24.0001C2.00024 27.3138 4.68652 30.0001 8.0002 30.0001H24.0001C27.3138 30.0001 30.0001 27.3138 30.0001 24.0001V8.0002C30.0001 4.68652 27.3138 2.00024 24.0001 2.00024Z" fill="url(#paint2_radial_2003_16507)"/><path d="M23.0002 10.5C23.0002 11.3284 22.3286 12 21.5002 12C20.6718 12 20.0002 11.3284 20.0002 10.5C20.0002 9.67157 20.6718 9 21.5002 9C22.3286 9 23.0002 9.67157 23.0002 10.5Z" fill="white"/><path fill-rule="evenodd" clip-rule="evenodd" d="M16.0005 21.0004C18.7618 21.0004 21.0004 18.7618 21.0004 16.0005C21.0004 13.2391 18.7618 11.0005 16.0005 11.0005C13.2391 11.0005 11.0005 13.2391 11.0005 16.0005C11.0005 18.7618 13.2391 21.0004 16.0005 21.0004ZM16.0005 19.0004C17.6573 19.0004 19.0004 17.6573 19.0004 16.0005C19.0004 14.3436 17.6573 13.0005 16.0005 13.0005C14.3436 13.0005 13.0005 14.3436 13.0005 16.0005C13.0005 17.6573 14.3436 19.0004 16.0005 19.0004Z" fill="white"/><path fill-rule="evenodd" clip-rule="evenodd" d="M6.00024 15.5999C6.00024 12.2397 6.00024 10.5595 6.6542 9.27604C7.22944 8.14707 8.14731 7.22919 9.27628 6.65396C10.5597 6 12.2399 6 15.6002 6H16.4002C19.7604 6 21.4406 6 22.724 6.65396C23.853 7.22919 24.7709 8.14707 25.3461 9.27604C26.0001 10.5595 26.0001 12.2397 26.0001 15.5999V16.3999C26.0001 19.7602 26.0001 21.4404 25.3461 22.7238C24.7709 23.8528 23.853 24.7707 22.724 25.3459C21.4406 25.9999 19.7604 25.9999 16.4002 25.9999H15.6002C12.2399 25.9999 10.5597 25.9999 9.27628 25.3459C8.14731 24.7707 7.22944 23.8528 6.6542 22.7238C6.00024 21.4404 6.00024 19.7602 6.00024 16.3999V15.5999ZM15.6002 7.99999H16.4002C18.1134 7.99999 19.2779 8.00155 20.178 8.07509C21.0549 8.14673 21.5033 8.27657 21.8161 8.43595C22.5687 8.81945 23.1806 9.43137 23.5641 10.184C23.7235 10.4968 23.8534 10.9452 23.925 11.8221C23.9985 12.7223 24.0001 13.8867 24.0001 15.5999V16.3999C24.0001 18.1131 23.9985 19.2776 23.925 20.1778C23.8534 21.0547 23.7235 21.5031 23.5641 21.8159C23.1806 22.5685 22.5687 23.1804 21.8161 23.5639C21.5033 23.7233 21.0549 23.8532 20.178 23.9248C19.2779 23.9983 18.1134 23.9999 16.4002 23.9999H15.6002C13.887 23.9999 12.7225 23.9983 11.8223 23.9248C10.9454 23.8532 10.497 23.7233 10.1842 23.5639C9.43161 23.1804 8.8197 22.5685 8.4362 21.8159C8.27682 21.5031 8.14697 21.0547 8.07533 20.1778C8.00179 19.2776 8.00023 18.1131 8.00023 16.3999V15.5999C8.00023 13.8867 8.00179 12.7223 8.07533 11.8221C8.14697 10.9452 8.27682 10.4968 8.4362 10.184C8.8197 9.43137 9.43161 8.81945 10.1842 8.43595C10.497 8.27657 10.9454 8.14673 11.8223 8.07509C12.7225 8.00155 13.887 7.99999 15.6002 7.99999Z" fill="white"/><defs><radialGradient id="paint0_radial_2003_16507" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(12.0002 23.0001) rotate(-55.3758) scale(25.5194)"><stop stop-color="#B13589"/><stop offset="0.79309" stop-color="#C62F94"/><stop offset="1" stop-color="#8A3AC8"/></radialGradient><radialGradient id="paint1_radial_2003_16507" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(11.0002 31) rotate(-65.1363) scale(22.594)"><stop stop-color="#E0E8B7"/><stop offset="0.444662" stop-color="#FB8A2E"/><stop offset="0.71474" stop-color="#E2425C"/><stop offset="1" stop-color="#E2425C" stop-opacity="0"/></radialGradient><radialGradient id="paint2_radial_2003_16507" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(0.500255 3.00024) rotate(-8.1301) scale(38.8906 8.3183)"><stop offset="0.156701" stop-color="#406ADC"/><stop offset="0.467799" stop-color="#6A45BE"/><stop offset="1" stop-color="#6A45BE" stop-opacity="0"/></radialGradient></defs></svg>
                                `,
                                name: 'Instagram',
                                url: '',
                                isActive: false,
                            },
                            {
                                icon: `
                                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_2003_16533)"><path fill-rule="evenodd" clip-rule="evenodd" d="M3.2 0H28.8C30.5674 0 32 1.43258 32 3.2V28.8C32 30.5674 30.5674 32 28.8 32H3.2C1.43258 32 0 30.5674 0 28.8V3.2C0 1.43258 1.43258 0 3.2 0Z" fill="#010101"/><path fill-rule="evenodd" clip-rule="evenodd" d="M20.0935 29.44C21.0672 29.44 21.8566 28.657 21.8566 27.6912C21.8566 26.7255 21.0672 25.9424 20.0935 25.9424H19.8279C20.8016 25.9424 21.591 26.7255 21.591 27.6912C21.591 28.657 20.8016 29.44 19.8279 29.44H20.0935Z" fill="#EE1D51"/><path fill-rule="evenodd" clip-rule="evenodd" d="M19.8039 25.9424H19.5383C18.5646 25.9424 17.7751 26.7255 17.7751 27.6912C17.7751 28.657 18.5646 29.44 19.5383 29.44H19.8039C18.8301 29.44 18.0407 28.657 18.0407 27.6912C18.0407 26.7255 18.8301 25.9424 19.8039 25.9424Z" fill="#66C8CF"/><path d="M19.816 28.5414C20.2895 28.5414 20.6734 28.1607 20.6734 27.6911C20.6734 27.2215 20.2895 26.8408 19.816 26.8408C19.3424 26.8408 18.9585 27.2215 18.9585 27.6911C18.9585 28.1607 19.3424 28.5414 19.816 28.5414Z" fill="#010101"/><path fill-rule="evenodd" clip-rule="evenodd" d="M6.40015 25.1519V26.0383H7.43848V29.4159H8.4772V26.0622H9.32239L9.61218 25.1519H6.40015ZM14.9013 25.1519V26.0383H15.9396V29.4159H16.9783V26.0622H17.8235L18.1133 25.1519H14.9013ZM9.80559 25.6549C9.80559 25.3771 10.0323 25.1519 10.3123 25.1519C10.5927 25.1519 10.8196 25.3771 10.8196 25.6549C10.8196 25.9327 10.5928 26.1579 10.3123 26.1579C10.0323 26.1578 9.80559 25.9327 9.80559 25.6549ZM9.80559 26.5174H10.8196V29.4159H9.80559V26.5174ZM11.2544 25.1519V29.4159H12.2688V28.3141L12.5828 28.0264L13.5729 29.4399H14.6596L13.2346 27.3797L14.5146 26.1339H13.283L12.2688 27.14V25.1519H11.2544ZM22.1946 25.1519V29.4159H23.2091V28.3141L23.523 28.0264L24.5133 29.4399H25.6001L24.1751 27.3797L25.4551 26.1339H24.2235L23.2091 27.14V25.1519H22.1946Z" fill="white"/><path fill-rule="evenodd" clip-rule="evenodd" d="M20.6294 10.3917C22.0302 11.3925 23.7464 11.9815 25.5999 11.9815V8.41653C25.2491 8.41667 24.8992 8.38008 24.556 8.30735V11.1135C22.7027 11.1135 20.9868 10.5246 19.5855 9.52373V16.7986C19.5855 20.4379 16.6339 23.3879 12.9929 23.3879C11.6344 23.3879 10.3717 22.9774 9.32275 22.2734C10.5199 23.4969 12.1894 24.2559 14.0365 24.2559C17.6777 24.2559 20.6295 21.3059 20.6295 17.6665L20.6294 10.3917ZM21.9171 6.79516C21.2012 6.01346 20.7311 5.00316 20.6294 3.88623V3.42773H19.6402C19.8892 4.84725 20.7384 6.06005 21.9171 6.79516ZM11.6256 19.4809C11.2257 18.9567 11.0095 18.3154 11.0104 17.6561C11.0104 15.9916 12.3606 14.6421 14.0262 14.6421C14.3366 14.6419 14.6452 14.6895 14.9411 14.7833V11.1387C14.5954 11.0914 14.2465 11.0713 13.8976 11.0787V13.9154C13.6016 13.8216 13.2929 13.774 12.9824 13.7742C11.3167 13.7742 9.96672 15.1237 9.96672 16.7884C9.96672 17.9653 10.6415 18.9845 11.6256 19.4809Z" fill="#EE1D52"/><path fill-rule="evenodd" clip-rule="evenodd" d="M19.5857 9.52373C20.9869 10.5246 22.7029 11.1135 24.5562 11.1135V8.30735C23.5217 8.08719 22.6058 7.54677 21.9172 6.79516C20.7386 6.06005 19.8893 4.84725 19.6403 3.42773H17.0421V17.6663C17.0362 19.3262 15.6883 20.6702 14.0262 20.6702C13.0468 20.6702 12.1766 20.2037 11.6256 19.4809C10.6415 18.9845 9.96673 17.9653 9.96673 16.7884C9.96673 15.1237 11.3167 13.7742 12.9824 13.7742C13.3015 13.7742 13.6091 13.8239 13.8976 13.9154V11.0787C10.3206 11.1525 7.44385 14.0738 7.44385 17.6665C7.44385 19.4599 8.16026 21.0857 9.32289 22.2736C10.3718 22.9776 11.6346 23.3881 12.993 23.3881C16.634 23.3881 19.5857 20.4379 19.5857 16.7987V9.52373Z" fill="white"/><path fill-rule="evenodd" clip-rule="evenodd" d="M24.5562 8.30752V7.54873C23.6232 7.55014 22.7087 7.28901 21.9172 6.7952C22.6179 7.56189 23.5405 8.09061 24.5562 8.30752ZM19.6403 3.4279C19.6166 3.29225 19.5983 3.15569 19.5857 3.01855V2.56006H15.9981V16.7988C15.9923 18.4586 14.6446 19.8026 12.9824 19.8026C12.4944 19.8026 12.0337 19.6868 11.6256 19.481C12.1767 20.2038 13.0468 20.6704 14.0263 20.6704C15.6882 20.6704 17.0362 19.3264 17.0421 17.6665V3.4279H19.6403ZM13.8977 11.0788V10.271C13.598 10.23 13.2957 10.2096 12.9932 10.2097C9.35183 10.2097 6.40015 13.1599 6.40015 16.7988C6.40015 19.0803 7.56021 21.0909 9.32303 22.2736C8.1604 21.0858 7.44399 19.4599 7.44399 17.6665C7.44399 14.0739 10.3207 11.1527 13.8977 11.0788Z" fill="#69C9D0"/><path fill-rule="evenodd" clip-rule="evenodd" d="M19.8279 29.44C20.8016 29.44 21.5911 28.657 21.5911 27.6912C21.5911 26.7255 20.8016 25.9424 19.8279 25.9424H19.8038C18.8301 25.9424 18.0408 26.7255 18.0408 27.6912C18.0408 28.657 18.8301 29.44 19.8038 29.44H19.8279ZM18.9585 27.6912C18.9585 27.2215 19.3425 26.8409 19.8161 26.8409C20.2893 26.8409 20.6733 27.2215 20.6733 27.6912C20.6733 28.161 20.2893 28.5418 19.8161 28.5418C19.3425 28.5417 18.9585 28.161 18.9585 27.6912Z" fill="white"/></g><defs><clipPath id="clip0_2003_16533"><rect width="32" height="32" fill="white"/></clipPath></defs></svg>
                                `,
                                name: 'TikTok',
                                url: '',
                                isActive: false,
                            },
                            {
                                icon: `
                                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M30.0001 15.9997C30.0001 12.2867 28.5251 8.72573 25.8996 6.10024C23.2741 3.47475 19.7132 1.99976 16.0002 1.99976C12.4749 1.99651 9.07813 3.32333 6.48842 5.71521C3.89871 8.10709 2.3067 11.3879 2.0304 14.9024C1.75409 18.4168 2.81383 21.9061 4.99793 24.6733C7.18203 27.4405 10.3297 29.2819 13.8122 29.8296V20.0456H10.2602V15.9997H13.8142V12.9157C13.8142 9.40771 15.9042 7.46772 19.1021 7.46772C20.6341 7.46772 22.2361 7.74172 22.2361 7.74172V11.1877H20.4701C18.7301 11.1877 18.1901 12.2677 18.1901 13.3737V15.9997H22.0721L21.4521 20.0456H18.1881V29.8296C21.4811 29.3081 24.48 27.6287 26.6453 25.0935C28.8106 22.5583 30.0001 19.3337 30.0001 15.9997Z" fill="#1877F2"/><path d="M21.4502 20.0455L22.0702 15.9995H18.1882V13.3735C18.1882 12.2675 18.7282 11.1876 20.4682 11.1876H22.2342V7.73957C22.2342 7.73957 20.6322 7.46558 19.1002 7.46558C15.9002 7.46558 13.8122 9.40556 13.8122 12.9135V15.9995H10.2603V20.0455H13.8142V29.8294C15.264 30.0576 16.7405 30.0576 18.1902 29.8294V20.0455H21.4502Z" fill="white"/></svg>
                                `,
                                name: 'Facebook',
                                url: '',
                                isActive: false,
                            },
                            {
                                icon: `
                                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_2003_16566)"><path fill-rule="evenodd" clip-rule="evenodd" d="M32 5.82361C30.8242 6.35906 29.5583 6.72116 28.2303 6.88295C29.5864 6.05089 30.627 4.73152 31.1172 3.15983C29.8475 3.93027 28.4445 4.49075 26.9456 4.79122C25.751 3.48341 24.0437 2.66675 22.1541 2.66675C18.531 2.66675 15.5915 5.68107 15.5915 9.39842C15.5915 9.92616 15.6478 10.4385 15.7605 10.9316C10.3042 10.6504 5.46763 7.97311 2.22762 3.89559C1.66226 4.8933 1.33919 6.05088 1.33919 7.28358C1.33919 9.618 2.4981 11.6789 4.25991 12.8866C3.18554 12.8538 2.17127 12.5476 1.28473 12.0468V12.1296C1.28473 15.3924 3.54804 18.114 6.55326 18.7303C6.00293 18.8882 5.42255 18.9672 4.82338 18.9672C4.40077 18.9672 3.98755 18.9268 3.58748 18.8478C4.42331 21.5212 6.84627 23.4685 9.72001 23.5205C7.47361 25.3272 4.64119 26.4038 1.56647 26.4038C1.0368 26.4038 0.512766 26.373 0 26.3114C2.90568 28.2182 6.35792 29.3334 10.0637 29.3334C22.141 29.3334 28.7431 19.077 28.7431 10.1804C28.7431 9.88764 28.7374 9.59488 28.7262 9.30789C30.009 8.35833 31.1229 7.17379 32 5.82361Z" fill="#00AAEC"/></g><defs><clipPath id="clip0_2003_16566"><rect width="32" height="32" fill="white"/></clipPath></defs></svg>
                                `,
                                name: 'Twitter',
                                url: '',
                                isActive: false,
                            },
                            {
                                icon: `
                                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_2003_16514)"><path fill-rule="evenodd" clip-rule="evenodd" d="M12.6962 20.1794L12.6952 11.1247L21.3411 15.6677L12.6962 20.1794ZM31.68 9.55567C31.68 9.55567 31.367 7.33505 30.408 6.35717C29.191 5.07313 27.827 5.06708 27.2021 4.99255C22.7241 4.66626 16.0071 4.66626 16.0071 4.66626H15.9931C15.9931 4.66626 9.27619 4.66626 4.79822 4.99255C4.17222 5.06708 2.80923 5.07313 1.59124 6.35717C0.632243 7.33505 0.320239 9.55567 0.320239 9.55567C0.320239 9.55567 0.000244141 12.164 0.000244141 14.7714V17.2166C0.000244141 19.8249 0.320239 22.4323 0.320239 22.4323C0.320239 22.4323 0.632243 24.6529 1.59124 25.6308C2.80923 26.9148 4.40821 26.8745 5.1202 27.0085C7.68019 27.2562 16.0001 27.3328 16.0001 27.3328C16.0001 27.3328 22.7241 27.3227 27.2021 26.9964C27.827 26.9209 29.191 26.9148 30.408 25.6308C31.367 24.6529 31.68 22.4323 31.68 22.4323C31.68 22.4323 32 19.8249 32 17.2166V14.7714C32 12.164 31.68 9.55567 31.68 9.55567Z" fill="#CE1312"/></g><defs><clipPath id="clip0_2003_16514"><rect width="31.9998" height="31.9998" fill="white"/></clipPath></defs></svg>
                                `,
                                name: 'YouTube',
                                url: '',
                                isActive: false,
                            },
                        ],
                        socialMedias: [],
                        contact: '',
                        isSuperior: 0,
                        websiteLink: '',
                        address: '',
                        jurisdiction: '',//
                        jurisdictionId: '',
                        latitude:'',
                        longitude: '',
                        isFreeForAll: false,
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
                this.$axios().get(`tourist-destination/${this.$route?.params?.id}`)
                    .then(res => {
                        let data = res?.data?.data;
                        this.loading = false;
                        setTimeout(function(){
                            that.initDropzone(1, data?.touristDestinationFiles);
                            that.initMap();
                            that.getSuperior();
                            that.dropzoneFile.on('addedfile',function(){
                                that.dropzoneFileFiles = [];
                                that.dropzoneFileFiles = that.dropzoneFile.files;
                            });
                        },200);
                      

                        this.form.data.address = data?.address;
                        data?.isSuperior ? this.form.data.isSuperior = 1 : this.form.data.isSuperior = 0;
                        this.form.data.jurisdiction = {id: data?.jurisdiction?.id, text: data?.jurisdiction?.name};
                        this.map.surabaya.lat = Number(data?.latitude);
                        this.map.surabaya.lng = Number(data?.longitude);
                        this.form.data.latitude = data?.latitude;
                        this.form.data.longitude = data?.longitude;
                        this.form.data.contact = data.contact;
                        this.form.data.websiteLink = data?.websiteLink;
                        this.form.data.category = [];
                        $.each(data?.tourismCategory, function(i,val){
                            that.form.data.category.push({id: val?.id, text: val?.name});
                        });
                        this.form.data.openingHours = [];
                        $.each(data?.touristDestinationOpeningHours, function(i,val){
                            that.form.data.openingHours.push({day: val?.day, startTime: val?.startTime ? val?.startTime : '', endTime: val?.endTime ? val?.endTime : '',  isClose: val?.isClosed ? true : false});
                        });
                        this.form.data.tickets = [];
                        $.each(data?.touristDestinationTicketPrices, function(i,val){
                            that.form.data.tickets.push({name: val?.name, price: val?.price, isFree: val?.price > 0 ? false : true});
                        });
                        this.form.data.destinations = [];
                        $.each(data?.touristDestinationLanguages, function(i,val){
                            that.form.data.destinations.push({language: {id: val?.language?.id, text: val?.language?.name}, name: val?.name, description: val?.description});
                        });
                        this.form.data.isFreeForAll = data?.isFreeForAll;
                        if(!data?.touristDestinationTicketPrices?.length){
                            this.form.data.tickets.push({name: '', price: '', isFree: false})
                        }

                        if(data.touristDestinationSocialMedias){
                            for(let i = 0; i < data.touristDestinationSocialMedias.length; i++){
                                if(data.touristDestinationSocialMedias[i].socialMedia == 'Instagram'){
                                    this.form.data.socialMedia[0].url = data.touristDestinationSocialMedias[i].urlAccount;
                                    this.form.data.socialMedia[0].isActive = true;
                                }else if(data.touristDestinationSocialMedias[i].socialMedia == 'TikTok'){
                                    this.form.data.socialMedia[1].url = data.touristDestinationSocialMedias[i].urlAccount;
                                    this.form.data.socialMedia[1].isActive = true;
                                }else if(data.touristDestinationSocialMedias[i].socialMedia == 'Facebook'){
                                    this.form.data.socialMedia[2].url = data.touristDestinationSocialMedias[i].urlAccount;
                                    this.form.data.socialMedia[2].isActive = true;
                                }else if(data.touristDestinationSocialMedias[i].socialMedia == 'Twitter'){
                                    this.form.data.socialMedia[3].url = data.touristDestinationSocialMedias[i].urlAccount;
                                    this.form.data.socialMedia[3].isActive = true;
                                }else if(data.touristDestinationSocialMedias[i].socialMedia == 'YouTube'){
                                    this.form.data.socialMedia[4].url = data.touristDestinationSocialMedias[i].urlAccount;
                                    this.form.data.socialMedia[4].isActive = true;
                                }
                            }
                        }                        
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
                                                b.id = val.id;
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
            getSuperior(){
                this.superior.loading = true;
                this.$axios().get(`tourist-destination/rest-superior-detination`)
                    .then(res => {
                        let data = res?.data?.data;
                        this.superior.count = data?.count;
                    })
                    .catch(err => {
                        this.$axiosHandleError(err);
                    })
                    .then(() => {
                        this.superior.loading = false;
                    });
            },
            getLanguage(search, limit){
                let that = this;

                this.selectList.language.loading = true;
                this.$axios().get(`select-list/language?search=${search}&limit=${limit}`)
                    .then(res => {
                        let data = res?.data?.data;
                        this.selectList.language.list = [];
                        $.each(data, function(i,val){
                            let findExist = that.form.data.destinations.findIndex(value => value?.language?.id == val?.id);
                            if(findExist == -1){
                                that.selectList.language.list.push({id: val?.id, code: val?.code, text: val?.name});
                            }
                        });
                    })
                    .catch(err => {
                        this.$axiosHandleError(err);
                    })
                    .then(() => {
                        this.selectList.language.loading = false;
                    });
            },
            getCategory(search, limit){
                let that = this;

                this.selectList.category.loading = true;
                this.$axios().get(`select-list/tourism-category?search=${search}&limit=${limit}`)
                    .then(res => {
                        let data = res?.data?.data;
                        this.selectList.category.list = [];
                        $.each(data, function(i,val){
                            that.selectList.category.list.push({id: val?.id, text: val?.name});
                        });
                    })
                    .catch(err => {
                        this.$axiosHandleError(err);
                    })
                    .then(() => {
                        this.selectList.category.loading = false;
                    });
            },
            getJurisdiction(search, limit){
                let that = this;

                this.selectList.jurisdiction.loading = true;
                this.$axios().get(`select-list/jurisdiction?search=${search}&limit=${limit}`)
                    .then(res => {
                        let data = res?.data?.data;
                        this.selectList.jurisdiction.list = [];
                        $.each(data, function(i,val){
                            that.selectList.jurisdiction.list.push({id: val?.id, text: val?.name});
                        });
                    })
                    .catch(err => {
                        this.$axiosHandleError(err);
                    })
                    .then(() => {
                        this.selectList.jurisdiction.loading = false;
                    });
            },
            changeLanguage(data){
                this.form.langSelectedId = data?.id;
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

                    });
                });
            },
            addDestinations(){
                this.form.data.destinations.push({
                    language: '',
                    name: '',
                    description: '',
                });
            },
            removeDestinations(index){
                this.form?.data?.destinations?.splice(index,1);
            },
            clickActiveLanguage(id){
                this.form.langSelectedId = id;
            },
            addTicket(){
                this.form.data.tickets.push({
                    name: '',
                    price: ''
                });
            },
            clickFree(index){
                if(this.form?.data?.tickets[index]?.isFree){
                    this.form.data.tickets[index].isFree = false;
                }
                else{
                    this.form.data.tickets[index].isFree = true;
                    this.form.data.tickets[index].price = 0;
                }
            },
            removeTicket(index){
                this.form.data.tickets.splice(index,1);
            },
            addOpening(){
                this.form.data.openingHours.push({
                    day: '',
                    startTime: '',
                    endTime: ''
                });
            },
            removeOpening(index){
                this.form.data.openingHours.splice(index,1);
            },
            clickClose(index){
                if(this.form?.data?.openingHours[index]?.isClose){
                    this.form.data.openingHours[index].isClose = false;
                }
                else{
                    this.form.data.openingHours[index].isClose = true;
                    this.form.data.openingHours[index].startTime = '';
                    this.form.data.openingHours[index].endTime = '';
                }
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
                $.each(data.destinations, function(i,val){
                    val.languageId=val?.language?.id;
                });
                data.categories = [];
                $.each(data.category, function(i,val){
                    data.categories.push(val?.id);
                });
                data.socialMedias = [];
                $.each(data.socialMedia, function(i,val){
                    if(val.url && val.isActive){
                        data.socialMedias.push({
                            socialMedia: val.name,
                            urlAccount: val.url,
                            isActive: val.isActive ? 1 : 0
                        });
                    }
                    
                });

                if(this.form.data.isFreeForAll){
                    data.tickets = [];
                }
                data.jurisdictionId = data?.jurisdiction?.id;

                this.$ewpLoadingShow();
                this.$axios().put(`tourist-destination/${this.$route.params.id}`,data)
                .then(res => {
                    let data = res?.data?.data;
                    if(this.dropzoneFileFiles.length){
                        this.uploadFile(data?.id);
                    }
                    else{
                        Swal.fire('Berhasil','Data berhasil disimpan','success').then(result => {
                            that.$router.push({name: 'a-destinasi'});
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

                this.$axios().post(`tourist-destination/upload-file/${id}`,formData)
                    .then(res => {
                        Swal.fire('Berhasil','Data berhasil disimpan','success').then(result => {
                            that.$router.push({name: 'a-destinasi'});
                        });
                    })
                    .catch(err => {
                        this.$axiosHandleError(err);
                        this.$router.push({name: 'a-destinasi'});
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

