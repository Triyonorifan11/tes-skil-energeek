<template>
    <div>
        <div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="page d-flex flex-row flex-column-fluid">
                <app-admin-sidebar></app-admin-sidebar>
				<!--begin::Wrapper-->
				<div class="wrapper d-flex flex-column flex-row-fluid" style="padding-top:20px !important;" id="kt_wrapper">
                    <app-admin-navbar></app-admin-navbar>
                    <!--begin::Content-->
                    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                        <router-view class="router-admin-content"></router-view>
                    </div>
                    <!--end::Content-->
                    </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Page-->
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {

            }
        },
        mounted(){
            setTimeout(function(){
                let scriptTag = document.createElement('script');
                scriptTag.src = assetUrl+`assets/js/init-metronic.js`;
                $('#script-metronic').append(scriptTag);
                reinitializeAllPlugin();
            },200);
        },
        methods: {

        }
    }
</script>
