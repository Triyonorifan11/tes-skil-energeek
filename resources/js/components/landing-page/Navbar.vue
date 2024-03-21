<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-custom">
            <div class="container">
                <router-link to="/" class="navbar-brand">
                    <img :src="`${$assetUrl()}assets/images/logo_app.svg`" class="brand-logo">
                </router-link>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars c-primary-custom"></i>
                </button>
                <div class="collapse navbar-collapse nav-group-custom" id="navbarNav">
                    <ul class="navbar-nav me-auto ms-auto nav-group-link-custom">
                        <li class="nav-item">
                            <router-link to="/whats-on" class="nav-link"
                                :class="$route.name && $route.name.toString().toLowerCase().includes('whats-on') ? 'active' : ''">
                                What’s On</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/destination" class="nav-link"
                                :class="$route.name && $route.name.toString().toLowerCase().includes('destination') ? 'active' : ''">
                                Stroll & Shop</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/cullnary" class="nav-link"
                                :class="$route.name && $route.name.toString().toLowerCase().includes('cullnary') ? 'active' : ''">
                                Culinary</router-link>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdownAccomodation" role="button"
                                :class="$route.name && $route.name.toString().toLowerCase().includes('accomodation') ? 'active' : ''"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Accommodation
                            </a>
                            <ul class="dropdown-menu animate slideIn" aria-labelledby="dropdownAccomodation">
                                <li>
                                    <router-link to="/hotel" class="dropdown-item">Hotel</router-link>
                                </li>
                                <li>
                                    <router-link to="/transportation" class="dropdown-item">Transportation</router-link>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdownTravelKit" role="button"
                                :class="$route.name && $route.name.toString().toLowerCase().includes('travel-kit') ? 'active' : ''"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Travel kit
                            </a>
                            <ul class="dropdown-menu animate slideIn" aria-labelledby="dropdownTravelKit">
                                <li>
                                    <router-link to="/map" class="dropdown-item">Map</router-link>
                                </li>
                                <li>
                                    <router-link to="/ebook" class="dropdown-item">E-Book</router-link>
                                </li>
                                <li>
                                    <router-link to="/travel-guide" class="dropdown-item">Travel Guide</router-link>
                                </li>
                                <li>
                                    <router-link to="/bus-ssct" class="dropdown-item">Bus SSCT</router-link>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <li class="nav-item dropdown nav-dropdown-language" v-if="listLanguage.length > 0">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownLanguage" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{selectedLanguageCode}}
                        </a>
                        <ul class="dropdown-menu animate slideIn" aria-labelledby="dropdownLanguage">
                            <li v-for="a in listLanguage"><a @click="changeLanguage(a.id, a.code)" href="javascript:void(0)"
                                    class="dropdown-item">{{a.name}}</a></li>
                        </ul>
                    </li>
                </div>
            </div>
        </nav>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                selectedLanguageCode: 'ID',
                languageLocalStorage: localStorage.getItem('language'),
                listLanguage: [],
            }
        },
        mounted() {
            this?.getLanguage();
        },
        methods: {
            getLanguage(){
                this.$axios().get(`select-list/language`)
                .then(response => {
                    this.listLanguage = response.data.data;

                    const findLanguage = this.listLanguage.findIndex((e) => e.id == this.languageLocalStorage);
                    if (findLanguage >= 0) {
                        this.selectedLanguageCode = this.listLanguage[findLanguage].code;
                    } else {
                        if (this.listLanguage.length > 0) {
                            this.selectedLanguageCode = this.listLanguage[0].code;
                            localStorage.setItem('language', this.listLanguage[0].id);
                        }
                    }


                });
            },
            changeLanguage(targetId, code) {
                localStorage.setItem('language', targetId);
                document.cookie = `tourism_language = ${code}`;
                location.reload();
            }
        }
    }

</script>
