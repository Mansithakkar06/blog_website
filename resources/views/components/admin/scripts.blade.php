    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('jquery/jquery.js')}}"></script>
    <script src="{{asset('bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script src="{{asset('js/custom.js')}}"></script>


    <!-- Page level plugins -->
    {{-- <script src="{{asset('chart.js/Chart.min.js')}}"></script> --}}

    <!-- Page level custom scripts -->
    <script src="{{asset('js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('js/demo/chart-pie-demo.js')}}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2@11.js') }}"></script>
    <script>
        @if (Session::has('success'))
        toastr.success('{{Session::get('success')}}');
        @elseif (Session::has('error'))
        toastr.error('{{ Session::get('error') }}');
    @endif
     @if (Session::has('status'))
        toastr.success('{{Session::get('status')}}');
        @endif
    </script>

@stack('script')
