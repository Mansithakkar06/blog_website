<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Blog</title>
    <x-frontend.styles />
</head>

<body>
    <!-- Navigation-->
    <x-frontend.navbar />
    <!-- Page Header-->

    <!-- Main Content-->
    <div class="container px-4 px-lg-5">
    </div>
    {{ $slot }}
    <!-- Footer-->
    <x-frontend.footer />
    <x-frontend.scripts />
</body>

</html>
