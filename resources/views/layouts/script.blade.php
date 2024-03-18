<script type="text/javascript" src="{{ asset('bower_components\jquery\js\jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/e_to_g.js') }}"></script>
<script type="text/javascript" src="{{ asset('bower_components\jquery-ui\js\jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('bower_components\popper.js\js\popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('bower_components\bootstrap\js\bootstrap.min.js') }}"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="{{ asset('bower_components\jquery-slimscroll\js\jquery.slimscroll.js') }}"></script>
<!-- modernizr js -->
<script type="text/javascript" src="{{ asset('bower_components\modernizr\js\modernizr.js') }}"></script>
<script type="text/javascript" src="{{ asset('bower_components\modernizr\js\css-scrollbars.js') }}"></script>

{{-- <script type="text/javascript" src="{{ asset('bower_components\switchery\js\switchery.min.js') }}"></script> --}}
<script>
    // Multiple swithces
   

</script>
<!-- Chart js -->
<script type="text/javascript" src="{{ asset('bower_components\chart.js\js\Chart.js') }}"></script>
<!-- Google map js -->
{{-- <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
</script>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=true"></script> --}}
<script type="text/javascript" src="{{ asset('assets\pages\google-maps\gmaps.js') }}"></script>
<!-- gauge js -->
<script src="{{ asset('assets\pages\widget\gauge\gauge.min.js') }}"></script>
<script src="{{ asset('assets\pages\widget\amchart\amcharts.js') }}"></script>
<script src="{{ asset('assets\pages\widget\amchart\serial.js') }}"></script>
<script src="{{ asset('assets\pages\widget\amchart\gauge.js') }}"></script>
<script src="{{ asset('assets\pages\widget\amchart\pie.js') }}"></script>
<script src="{{ asset('assets\pages\widget\amchart\light.js') }}"></script>
<!-- Custom js -->
<script src="{{ asset('assets\js\pcoded.min.js') }}"></script>
<script src="{{ asset('assets\js\vartical-layout.min.js') }}"></script>
<script src="{{ asset('assets\js\jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets\pages\dashboard\crm-dashboard.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets\js\script.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets\js\jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets\js\bootstrap.bundle.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets\js\dataTables.bootstrap5.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets\js\toastify-js.js') }}"></script>

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script> --}}
{{-- <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script> --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script> --}}
{{-- <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script> --}}

{{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script> --}}

<script type="text/javascript">
    function submit_success(result, table = null){
        $('div.company_add_modal').removeClass('show').html('').removeAttr("style");
        $('.modal-backdrop').removeClass('show').addClass('d-none');
        Toastify({text: result.msg,duration: 3000, gravity: "bottom", position: "left", backgroundColor:'#088f7d'}).showToast();
        if(table){
            table.ajax.reload();
        }
    }
    function submit_error(result){
        Toastify({text: result.msg,duration: 3000, gravity: "bottom", position: "left", backgroundColor:'#FF0000'}).showToast();
        $(".error").removeClass('d-inline-block');
        $(".msg").text('').removeClass('d-inline-block');
        $.each(result.data, function(key, val) {
            $("." + key + "_error").addClass('d-inline-block');
            $("." + key + "_error strong").text(val[0]);
        })
    } 
    // function Switchery(){
    //     var elem = Array.prototype.slice.call(document.querySelectorAll('.js-small'));
    //     console.log(elem);
    //     elem.forEach(function(html) {
    //         var switchery = new Switchery(html, {
    //             color: '#1abc9c',
    //             jackColor: '#fff',
    //             size: 'small'
    //         });
    //     });
    // }
    $(document).ready(function() {

        $(document).on('click', '.cus_form_open_btn', function(e) {
            var container = $(this).data("container");
            $.ajax({
                url: $(this).data("href"),
                dataType: "html",
                success: function(result) {
                    $(container).html(result).addClass('show').css("display", "block");
                    $('.modal-backdrop').addClass('show').removeClass('d-none');
                }
            });
        });

        $(document).on('click', '.close_cus', function(e) {
            window.location.reload();
            $('.company_add_modal, .company_edit_modal, .company_show_modal').removeClass('show').html('').removeAttr("style");
            $('.modal-backdrop').removeClass('show').addClass('d-none');
        });
    });
    
</script>

<!-- Select 2 js -->
<script type="text/javascript" src="{{ asset('bower_components\select2\js\select2.full.min.js') }}"></script>
<!-- Multiselect js -->
<script type="text/javascript" src="{{ asset('bower_components\bootstrap-multiselect\js\bootstrap-multiselect.js') }}"></script>
<script type="text/javascript" src="{{ asset('bower_components\multiselect\js\jquery.multi-select.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets\js\jquery.quicksearch.js') }}"></script>
<!-- Custom js -->
<script type="text/javascript" src="{{ asset('assets\pages\advance-elements\select2-custom.js') }}"></script>