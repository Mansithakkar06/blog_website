<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Blog</title>
        <x-frontend.styles/>
    </head>
    <body>
        <!-- Navigation-->
       <x-frontend.navbar/>
        <!-- Page Header-->
       <x-frontend.header image="{{ request()->is('/')? asset('assets/images/home-bg.jpg'):'' }}" title="{{request()->is('/')?'JustBlogged':''}}" subtitle="{{request()->is('/')? 'A Blog Website by Mansi':''}}" />
        <!-- Main Content-->
        <div class="container px-4 px-lg-5">
        </div>
        {{ $slot }}
        <!-- Footer-->
      <x-frontend.footer/>
       <x-frontend.scripts/>
    </body>
</html>
