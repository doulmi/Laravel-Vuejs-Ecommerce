@if (Auth::check())
    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="https://placehold.it/160x160/00a65a/ffffff/&text={{ mb_substr(Auth::user()->name, 0, 1) }}" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p>{{ Auth::user()->name }}</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li class="header">{{ trans('backpack::base.administration') }}</li>
          <!-- ================================================ -->
          <!-- ==== Recommended place for admin menu items ==== -->
          <!-- ================================================ -->
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>


          <!-- ======================================= -->
          <li class="header">{{ trans('backpack::base.user') }}</li>
          <li><a href="{{ url('admin/language') }}"><i class="fa fa-tag"></i> <span>Manage Languages</span></a></li>
          <li><a href="{{ url('admin/currency') }}"><i class="fa fa-tag"></i> <span>Manage Currencies</span></a></li>
          <li><a href="{{ url('admin/user') }}"><i class="fa fa-tag"></i> <span>Manage Users</span></a></li>
          <li><a href="{{ url('admin/category') }}"><i class="fa fa-tag"></i> <span>Manage Categories</span></a></li>
          <li><a href="{{ url('admin/product') }}"><i class="fa fa-tag"></i> <span>Manage Products</span></a></li>
          <li><a href="{{ url('admin/order') }}"><i class="fa fa-tag"></i> <span>Manage Orders</span></a></li>
          <li><a href="{{ url('admin/address') }}"><i class="fa fa-tag"></i> <span>Manage Addresses</span></a></li>
          <li><a href="{{ url('admin/cart') }}"><i class="fa fa-tag"></i> <span>Manage Carts</span></a></li>
          <li><a href="{{ url('admin/collect') }}"><i class="fa fa-tag"></i> <span>Manage Collects</span></a></li>
          <li><a href="{{ url('admin/promoCode') }}"><i class="fa fa-tag"></i> <span>Manage Promo Code</span></a></li>
          <li><a href="{{ url('admin/reservation') }}"><i class="fa fa-tag"></i> <span>Manage Reservations</span></a></li>
          <li><a href="{{ url('admin/comment') }}"><i class="fa fa-tag"></i> <span>Manage Comments</span></a></li>
          <li><a href="{{ url('admin/gift') }}"><i class="fa fa-tag"></i> <span>Manage Gifts</span></a></li>
          <li><a href="{{ url('admin/like') }}"><i class="fa fa-tag"></i> <span>Manage Likes</span></a></li>
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/elfinder') }}"><i class="fa fa-files-o"></i> <span>File manager</span></a></li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
@endif
