
<script src="{{asset('jquery/jquery.min.js')}}"></script>
         <!-- Bootstrap core JS-->
        <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
        <!-- Core theme JS-->
        <script src="{{asset('assets/js/scripts.js')}}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2@11.js') }}"></script>
  <!-- Font Awesome icons (free version)-->
        {{-- <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script> --}}
        @stack('script')
