 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Blog</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
           <x-admin.menu-items title="Dashboard" icon="tachometer-alt" url="/" path="/"/>
           <x-admin.menu-items title="User" icon="table" url="{{route('user.index')}}" path="user"/>
           <x-admin.menu-items title="Category" icon="table" url="{{route('category.index')}}" path="category"/>
           <x-admin.menu-items title="Post" icon="table" url="{{route('post.index')}}" path="post"/>



        </ul>
