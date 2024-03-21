$(document).ready(function(){
    // reinitializeAllPlugin();
});

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
