<!DOCTYPE html>
<html lang="id">
<!--begin::Head-->

<head>
    <base href="">
    <title>My Tes - Energeek</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#049c4f" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{url()->full()}}" />
    <meta property="og:title" content="Energeek Tess" />
    <meta property="og:description"
        content="Test Energeek with pattern project and test case for each programming language." />
    <meta property="og:image" content="{{asset('assets_admin/images/logo_app.svg')}}" />
    <meta property="twitter:site" content="{{url()->full()}}" />
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:title" content="Surabaya Tourism" />
    <meta property="twitter:description"
        content="Test Energeek with pattern project and test case for each programming language." />
    <meta property="twitter:image" content="{{asset('assets_admin/images/logo_app.svg')}}" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
    <link rel="canonical" href="Https://preview.keenthemes.com/metronic8" />
    <link href="{{ asset('assets/images/logo.svg') }}" rel="shortcut icon">
    @include('components.css')
    @vite('resources/css/landing-app.css')
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body"
    class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed"
    style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">

    <div id="app"></div>

    <script>
        let baseUrl = `{{url('/')}}`;
        let fullPathUrl = `${baseUrl}/{{config('myconfig.SUBPATH_DOMAIN')}}`;
        let urlApi = baseUrl + '/api/';
        let assetUrl = `{{asset('/')}}`;
        let SUBPATH_DOMAIN = `{{config('myconfig.SUBPATH_DOMAIN')}}`;
        var VITE_INDONESIAN_LANGUAGE_ID = "{{config('myconfig.VITE_INDONESIAN_LANGUAGE_ID')}}";
        var CAPTCHA_SITE_KEY = "{{config('myconfig.recaptcha_key.site')}}";

        function reinitializeAllPlugin() {
            $(".drawer-overlay").remove();
            setTimeout(() => {
                KTDialer.init();
                KTDrawer.init();
                KTImageInput.init();
                KTMenu.createInstances()
                KTPasswordMeter.init();
                KTScroll.init();
                KTScrolltop.init();
                KTSticky.init();
                KTSwapper.init();
                KTToggle.init();
                KTUtil.onDOMContentLoaded((function () {
                    KTApp.init()
                })), window.addEventListener("load", (function () {
                    KTApp.initPageLoader()
                })), "undefined" != typeof module && void 0 !== module.exports && (module.exports = KTApp);

                KTUtil.onDOMContentLoaded((function () {
                    KTLayoutAside.init()
                }));


                KTUtil.onDOMContentLoaded((function () {
                    KTLayoutSearch.init()
                }));

                KTUtil.onDOMContentLoaded((function () {
                    KTLayoutToolbar.init()
                }));

            }, 100);

            setTimeout(() => {
                $('body').attr('data-kt-drawer-aside', 'off');
                $('body').attr('data-kt-drawer', 'off');
                $('body').attr('data-kt-aside-minimize', 'off');

                $(".drawer-overlay").remove();
            }, 10);


            $("#kt_aside_mobile_toggle").on('click', function () {
                setTimeout(() => {


                    $('.drawer-overlay').each(function () {
                        let checkLength = $(".drawer-overlay").length;

                        if (checkLength > 1) {
                            $(this).remove();
                        }

                    });
                }, 10);
            });

        }


        function reinitializeKTMenuPlugin() {
            KTMenu.createInstances()
        }

    </script>
    @vite('resources/js/app.js')
    @include('components.js')
</body>
<!--end::Body-->

</html>
