<template>
    <div>
      <div :style="style" class="loader-component"></div>
    </div>
  </template>

  <script>
    export default {
        props: {
            style: {
                type: String,
            }
        },
        data(){
            return {

            }
        }
    }
  </script>

  <style scoped>
  .loader-component {
    border: 5px solid #39A388 ;
    border-radius: 50%;
    border-top: 5px solid #f2f2f2;
    width: 50px;
    height: 50px;
    -webkit-animation: spin 2s linear infinite;

    animation: spin 2s linear infinite;
  }

  /* Safari */
  @-webkit-keyframes spin {
    0% {
        -webkit-transform: rotate(0deg);
    }

    100% {
        -webkit-transform: rotate(360deg);
    }
  }

  @keyframes spin {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
  }
  </style>
