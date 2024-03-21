<template>
    <div>
        <div class="container-xl d-flex m-auto">
            <div class="d-flex flex-column justify-content-center align-items-center">
                <img style="width:50%; margin:auto;" :src="`${assetUrl}assets/images/not_found.svg`" alt="">
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                assetUrl: assetUrl,
            }
        }
    }
</script>
