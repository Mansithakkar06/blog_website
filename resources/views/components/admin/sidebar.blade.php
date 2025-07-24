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
           <x-admin.menu-items title="Dashboard" icon="tachometer-alt" url="{{route('dashboard')}}" path="dashboard"/>
           <x-admin.menu-items title="User" icon="users" url="{{route('user.index')}}" path="user"/>
           <x-admin.menu-items title="Category" icon="list" url="{{route('category.index')}}" path="category"/>
           <x-admin.menu-items title="Post" icon="list" url="{{route('post.index')}}" path="post"/>
           <x-admin.menu-items title="Comment" icon="comment" url="{{route('comment.index')}}" path="comment"/>




        </ul>
