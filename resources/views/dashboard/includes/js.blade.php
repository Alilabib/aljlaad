        <!--
            OneUI JS Core

            Vital libraries and plugins used in all pages. You can choose to not include this file if you would like
            to handle those dependencies through webpack. Please check out assets/_es6/main/bootstrap.js for more info.

            If you like, you could also include them separately directly from the assets/js/core folder in the following
            order. That can come in handy if you would like to include a few of them (eg jQuery) from a CDN.

            assets/js/core/jquery.min.js
            assets/js/core/bootstrap.bundle.min.js
            assets/js/core/simplebar.min.js
            assets/js/core/jquery-scrollLock.min.js
            assets/js/core/jquery.appear.min.js
            assets/js/core/js.cookie.min.js
        -->
    <script src="{{asset('/')}}js/oneui.core.min.js"></script>

        <!--
            OneUI JS

            Custom functionality including Blocks/Layout API as well as other vital and optional helpers
            webpack is putting everything together at assets/_es6/main/app.js
        -->
        <script src="{{asset('/')}}js/oneui.app.min.js"></script>

        <!-- Page JS Plugins -->
        <script src="{{asset('/')}}js/plugins/chart.js/Chart.bundle.min.js"></script>

        <!-- Page JS Code -->
        <script src="{{asset('/')}}js/pages/be_pages_ecom_dashboard.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

        <script>
                function getAjaxResponse(route,place) {
                    $.ajax({
                        url: route,
                        method: "GET",
                        dataType:"json",
                        success:function(data){
                            if (data['value'] == 1) {
                                $('#'+place).html(data['view']);
                            }
                        }
                    });
                }


                function getAjaxPostResponse(route,place,send_data) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });

                $.ajax({
                    url: route,
                    method: "POST",
                    dataType:"json",
                    data:send_data,
                    success:function(data){
                        if (data['value'] == 1) {
                            $('#'+place).html(data['view']);
                        }
                    }
                });
            }

        </script>
@yield('js')