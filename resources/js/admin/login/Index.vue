<template>
    <div>
        <div class="wrap-root">
            <div class="d-flex flex-column align-items-center justify-content-center"
                style="width:100%; height:100vh; background-color:white; position:relative;">
                <!-- <img :src="`${assetUrl}assets_admin/images/background_login.svg`" style="position:absolute; bottom:0; right:0; left:0; height:70%; width:100%; " alt=""> -->

                <div class="card p-2"
                    style="width:400px; box-shadow: 0px 0px 10px lightgray; position:relative; z-index:2;">
                    <div class="card-body">
                        <div class="judul">
                            <div class="d-flex flex-column justify-content-center align-items-center">
                                <div class="logo mb-2">
                                    <img :src="`${assetUrl}assets/images/logo.svg`" alt="">
                                </div>
                                
                            </div>
                        </div>
                        <div class="form my-10 mb-0 ">
                            <label for="username"><b class="text-gray-600">Username</b></label>
                            <input v-model="data.username" type="text" class="form-control"
                                placeholder="Masukkan username" @keyup.enter="login()">
                            <br>
                            <div class="group-password" style="position:relative;">
                                <label for="password"><b class="text-gray-600">Password</b></label>
                                <input v-model="data.password" :type="`${hiddenPassword ? `password` : `text`}`"
                                    class="form-control" placeholder="Masukkan password" @keyup.enter="login()">
                                <!-- <div class="eye d-flex justify-content-end px-4" style="margin-top:-35px;"> -->
                                <i style="position:absolute; right:0; bottom:7px; cursor:pointer;"
                                    class="px-4 bi bi-eye fa-2x" v-if="hiddenPassword"
                                    @click="hiddenPassword = false"></i>
                                <i style="position:absolute; right:0; bottom:7px; cursor:pointer;"
                                    class="px-4 bi bi-eye-slash fa-2x" v-else @click="hiddenPassword = true"></i>
                                <!-- </div> -->
                            </div>
                            <div class="d-flex justify-content-center mt-4 mb-3">
                                <vue-recaptcha ref="recaptcha" :sitekey="siteKeyCaptcha" @verify="verifyMethod"
                                    @expired="expiredMethod"></vue-recaptcha>
                            </div>
                            <div class="d-flex flex-column justify-content-center align-items-center">
                                <button class="btn btn-primary px-10 d-flex" type="button" :disabled="!data.recaptcha"
                                    @click="login">Masuk</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {
    VueRecaptcha
} from 'vue-recaptcha';
export default {
    components: { VueRecaptcha },
    data() {
        return {
            assetUrl: assetUrl,
            hiddenPassword: true,
            siteKeyCaptcha: CAPTCHA_SITE_KEY,
            data: {
                username: '',
                password: '',
                recaptcha: ''
            }
        }
    },
    mounted() {

    },
    methods: {
        verifyMethod(response) {
            this.data.recaptcha = response;
        },
        expiredMethod() {
            this.data.recaptcha = '';
        },
        login() {
            if (!this.data.recaptcha) {
                return false;
            }
            let that = this;
            this.$ewpLoadingShow();
            this.$axios().post(`auth/login`, this.data)
                .then(res => {
                    let data = res?.data?.data;
                    localStorage.setItem('token', data?.auth?.accessToken);
                    this.$store.commit("setAuth", data?.me);
                    this.$router.push({ name: 'a-destinasi' });
                })
                .catch(err => {
                    grecaptcha.reset()
                    this.expiredMethod();
                    this.$axiosHandleError(err);
                })
                .then(() => {
                    this.$ewpLoadingHide();
                });
        }
    }
}
</script>
