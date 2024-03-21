import router from '@/router';
import api from '@/global-plugins/api.js';
import store from '@/vuex';
import moment from 'moment/min/moment-with-locales';

export default {
    install(app, options){
        const global = app.config.globalProperties;

        global.$axiosHandleError = (err) => {
            console.log(err)
            let data = err?.response?.data;
            let status = {
                title: 'OOPS...',
                message: 'Terjadi kesalahan',
                icon: 'error',
            };

            switch(err?.response?.status){
                case 300:
                    status.title = 'Multiple Choises';
                    status.icon = 'warning';
                    break;
                case 301:
                    status.title = 'Move Permanently';
                    status.icon = 'warning';
                    break;
                case 302:
                    status.title = 'Found';
                    status.icon = 'warning';
                    break;
                case 303:
                    status.title = 'See Other';
                    status.icon = 'warning';
                    break;
                case 304:
                    status.title = 'Not Modified';
                    status.icon = 'warning';
                    break;
                case 305:
                    status.title = 'Use Proxy';
                    status.icon = 'warning';
                    break;
                case 400:
                    status.title = 'Bad Request';
                    if(typeof data?.status?.message == 'object'){
                        status.message = ``;
                        $.each(data?.status?.message, function(index,value){
                            $.each(value, function(i,val){
                                status.message += `${val}<br>`;
                            });
                        });
                    }
                    else{
                        status.message = data?.status?.message;
                    }
                    status.icon = 'warning';
                    break;
                case 401:
                    status.title = 'Unauthorized';
                    status.message = 'Silahkan login kembali';
                    status.icon = 'warning';
                    break;
                case 403:
                    status.title = 'Forbidden';
                    status.message = data?.status?.message;
                    status.icon = 'warning';
                    break;
                case 404:
                    status.title = 'URL Not Found';
                    status.message = data?.status?.message;
                    status.icon = 'warning';
                    break;
                case 422:
                    let res = err.response ? err.response.data : null;   
                    status.message = '';
                    if (res?.data?.errors) {
                        const entries = Object.entries(res?.data?.errors || {});

                        for (const [name, errMsg] of entries) {
                            status.message += `<br>. ${errMsg}`;
                        }
                    } else {
                        const entries = Object.entries(res?.data || {});

                        for (const [name, errMsg] of entries) {
                            status.message += `<br>. ${errMsg}`;
                        }
                    }
                    status.title = 'Pastikan data sudah benar!';                   
                    status.icon = 'warning';
                    break;
                default:
                    status.title = 'Terjadi kesalahan koneksi';
                    status.icon = 'error';
            }
            Swal.fire({
                title: status?.title,
                html: status?.message,
                icon: status?.icon
            }).then(()=>{
                if(err?.response?.status == 401){
                    store.state.auth.authenticated = false;
                    router.push({name: 'a-login'});
                }
            });
        };
        global.$noImageUrl = () => {
            return `${assetUrl}assets/images/sample/noimage.jpg`;
        };
        global.$setNoImageUrl= (event) => {   
            event.target.src = `${assetUrl}assets/images/sample/noimage.jpg`;
        };
        global.$axios = () => {
            return api();
        };
        global.$apiUrl = () => {
            return urlApi;
        };
        global.$assetUrl = () => {
            return assetUrl;
        };
        global.$baseUrl = () => {
            return baseUrl;
        };
        global.$fullPathUrl = () => {
            return fullPathUrl;
        };

        global.$ewpLoadingShow = () => {
            store.state.pageLoading = true;
        }
        global.$ewpLoadingHide = () => {
            store.state.pageLoading = false;
        }

        app.config.globalProperties.$moment = moment

        global.$rupiahFormat = (data) => {
            return new Intl.NumberFormat("id-ID", {
                // style: "currency",
                // currency: "IDR"
            }).format(data);
        };
        global.$getTitleEventsOrDestination = (languangeData) => {
            if(!languangeData || (languangeData && languangeData.length == 0)){
                return '-';
            }
            if(localStorage.getItem('language')){
                const checkIndex = languangeData.findIndex((e) => e.language && e.language.id == localStorage.getItem('language'));
                if(checkIndex >= 0){
                    return languangeData[checkIndex].name;
                }

                return languangeData[0].name;
            }
        //    return languangeData[0].name;
        };
        global.$getDescriptionEventsOrDestination = (languangeData) => {
            if(!languangeData || (languangeData && languangeData.length == 0)){
                return '-';
            }
            if(localStorage.getItem('language')){
                const checkIndex = languangeData.findIndex((e) => e.language && e.language.id == localStorage.getItem('language'));
                if(checkIndex >= 0){
                    return languangeData[checkIndex].description;
                }

                return languangeData[0].description;
            }
        //    return languangeData[0].description;
         };

        global.$formatBytes = (bytes, decimals = 2) => {
            if (!+bytes) return '0 Bytes'

            const k = 1024
            const dm = decimals < 0 ? 0 : decimals
            const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB']

            const i = Math.floor(Math.log(bytes) / Math.log(k))

            return `${parseFloat((bytes / Math.pow(k, i)).toFixed(dm))} ${sizes[i]}`
        };
    }
}

export function axios() {
    return api();
};

export function axiosHandleError(err){
    let data = err?.response?.data;
    let status = {
        title: 'OOPS...',
        message: 'Terjadi kesalahan',
        icon: 'error',
    };

    switch(err?.response?.status){
        case 300:
            status.title = 'Multiple Choises';
            status.icon = 'warning';
            break;
        case 301:
            status.title = 'Move Permanently';
            status.icon = 'warning';
            break;
        case 302:
            status.title = 'Found';
            status.icon = 'warning';
            break;
        case 303:
            status.title = 'See Other';
            status.icon = 'warning';
            break;
        case 304:
            status.title = 'Not Modified';
            status.icon = 'warning';
            break;
        case 305:
            status.title = 'Use Proxy';
            status.icon = 'warning';
            break;
        case 400:
            status.title = 'Bad Request';
            if(typeof data?.status?.message == 'object'){
                status.message = ``;
                $.each(data?.status?.message, function(index,value){
                    $.each(value, function(i,val){
                        status.message += `${val}<br>`;
                    });
                });
            }
            else{
                status.message = data?.status?.message;
            }
            status.icon = 'warning';
            break;
        case 401:
            status.title = 'Unauthorized';
            status.message = 'Silahkan login kembali';
            status.icon = 'warning';
            break;
        case 403:
            status.title = 'Forbidden';
            status.message = data?.status?.message;
            status.icon = 'warning';
            break;
        case 404:
            status.title = 'URL Not Found';
            status.message = data?.status?.message;
            status.icon = 'warning';
            break;
        case 422:
            status.title = 'Pastikan data sudah benar!';
            if(typeof data?.status?.message == 'object'){
                status.message = ``;
                $.each(data?.status?.message, function(index,value){
                    $.each(value, function(i,val){
                        status.message += `${val}<br>`;
                    });
                });
            }
            else{
                status.message = data?.status?.message;
            }
            status.icon = 'warning';
            break;
        default:
            status.title = 'Terjadi kesalahan koneksi';
            status.icon = 'error';
    }
    Swal.fire({
        title: status?.title,
        html: status?.message,
        icon: status?.icon
    }).then(()=>{
        if(err?.response?.status == 401){
            store.state.auth.authenticated = false;
            router.push({name: 'a-login'});
        }
    });
}
