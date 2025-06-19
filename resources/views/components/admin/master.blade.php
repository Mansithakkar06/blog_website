<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="author" content="">

    <title>blog site</title>

<x-admin.styles/>

</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
       <x-admin.sidebar/>
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
               <x-admin.topbar/>
               <div class="container-fluid">
                   {{ $slot }}
                </div>
            </div>
            <!-- Footer -->
           <x-admin.footer/>
        </div>
    </div>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <x-admin.logout_modal/>
     <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalBody">

                </div>

            </div>
        </div>
    </div>

<x-admin.scripts/>

</body>

</html>
