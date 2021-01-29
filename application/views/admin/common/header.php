
<!-- begin::Body -->
<body class="kt-page--loading-enabled kt-page--loading kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header--minimize-topbar kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-page--loading kt-aside--enabled kt-aside--fixed <?php if (isset($_COOKIE["theme"]) && $_COOKIE["theme"]=="dark") echo("theme_dark");?>">
  <!-- begin:: Header Mobile -->
  <div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
    <div class="kt-header-mobile__logo">
      <a href="<?=base_url()?>">
        <img alt="Logo" src="<?=base_url()?>assets/media/logos/logo-2-sm.png" />
      </a>
    </div>
    <div class="kt-header-mobile__toolbar">
      <button class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler"><span></span></button>
      <button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more-1"></i></button>
    </div>
  </div>
  <!-- end:: Header Mobile -->
<div class="kt-grid kt-grid--hor kt-grid--root">
  <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

      <div class="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch" id="kt_body">
        <!-- begin:: Header -->
        <div id="kt_header" class="kt-header kt-grid__item  kt-header kt-header--fixed " data-ktheader-minimize="on">
          <div class="kt-header__top">
            <div class="kt-container kt-container--fluid">
              <!-- begin:: Brand -->
              <div class="kt-header__brand kt-grid__item" id="kt_header_brand">
                <div class="kt-header__brand-logo">
                  <a href="<?=base_url()?>">
                    <img alt="Logo" src="<?=base_url()?>assets/media/logos/logo-green-md.png" class="kt-header__brand-logo-default" />
                    <img alt="Logo" src="<?=base_url()?>assets/media/logos/logo-green-sm.png" class="kt-header__brand-logo-sticky" />
                  </a>
                </div>
              </div>
              <!-- end:: Brand -->

              <!-- begin: Header Topbar -->
              <div class="kt-header__topbar">
                <!--begin: Theme switcher-->
                <div class = "kt-header__topbar-item">
                  <div class="kt-header__topbar-wrapper">
                    <div class = "btn btn-secondary theme_panel <?php if (isset($_COOKIE["theme"]) && $_COOKIE["theme"]=="dark") echo("theme_panel--dark");?>">
                      <div class = "theme_style theme_day" theme-style="day"></div>
                      <div class = "theme_style theme_night" theme-style="night"></div>
                      <div class = "theme_switcher"></div>
                    </div>
                  </div>
                </div>
                <!--end: Theme switcher-->

                <!--begin: User bar-->
                <div class="kt-header__topbar-item kt-header__topbar-item--user">
                  <?php
                  if(isset($_SESSION['logged_user'])) { ?>
                    <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,10px" aria-expanded="false">
                      <button class = "btn btn-login">
                        <a>Hi,<?=$_SESSION['logged_user']?></a>
                      </button>
                    </div>
                    <div class="user-account dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-sm-right">
                      <a href="<?=base_url()?>myaccount/favourite" class="dropdown-item">My Favourites</a>
                      <a href="<?=base_url()?>myaccount/download" class="dropdown-item">My Downloads</a>
                      <a href="<?=base_url()?>myaccount/accountinfo" class="dropdown-item">Account Information</a>
                      <a href="<?=base_url()?>myaccount/bill" class="dropdown-item">Billing Information</a>
                      <a href="<?=base_url()?>myaccount/accountaccess" class="dropdown-item">Hellp / Support</a>

                    </div>
                    <div class="kt-header__topbar-item">
                      <div class="kt-header__topbar-wrapper">
                        <div class="kt-header__topbar-wrapper">
                          <a href = "<?=base_url()?>user/logout">
                            <button class = "btn btn-signup"> Log&nbspout </button>
                          </a>
                        </div>
                      </div>
                    </div>
                    <?php
                  } else {?>
                    <div class="kt-header__topbar-wrapper">
                      <button class = "btn btn-login">
                        <a href = "<?=base_url()?>user/login">Login</a>
                      </button>
                    </div>
                    <div class="kt-header__topbar-item">
                      <div class="kt-header__topbar-wrapper">
                        <div class="kt-header__topbar-wrapper">
                          <a href = "<?=base_url()?>user/signup">
                            <button class = "btn btn-signup"> Sign&nbspUp </button>
                          </a>
                        </div>
                      </div>
                    </div>
                    <?php
                  }
                  ?>
                </div>

                <!--end: User bar-->
              </div>
              <!-- end: Header Topbar -->

            </div>
          </div>

        </div>

        <!-- end:: Header -->
        <div class="kt-container  pl-0 kt-container--fluid  kt-grid kt-grid--ver mainBg">


          <!-- begin:: Aside -->

          <div class="kt-aside mr-2 pl-0 ml-0  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

            <!-- begin:: Aside Menu -->
            <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
              <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1">
                <ul class="kt-menu__nav ">
                  <li style = "display:none;" class="kt-menu__item " aria-haspopup="true"><a href="<?=base_url()?>admin" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-user"></i><span class="kt-menu__link-text dayHead">Dashboard</span></a></li>

                  <li class="kt-menu__item <?=($this->uri->uri_string() == 'admin/order' ? 'kt-menu__item--open' : '');?>" aria-haspopup="true"><a href="<?=base_url()?>admin/order" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-cart"></i><span class="kt-menu__link-text dayHead">Orders</span></a></li>

                  <li class="kt-menu__item  <?=($this->uri->uri_string() == 'admin/product/create' ? 'kt-menu__item--open' : '');?>" aria-haspopup="true"><a href="<?=base_url()?>admin/product/create" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-add"></i><span class="kt-menu__link-text dayHead">Publish Product</span></a></li>

                  <li class="kt-menu__item  <?=($this->uri->uri_string() == 'admin/product' ? 'kt-menu__item--open' : '');?>" aria-haspopup="true"><a href="<?=base_url()?>admin/product" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-delivery-package"></i><span class="kt-menu__link-text dayHead">Products</span></a></li>

                  <li class="kt-menu__item  <?=($this->uri->uri_string() == 'admin/sport' ? 'kt-menu__item--open' : '');?>" aria-haspopup="true"><a href="<?=base_url()?>admin/sport" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-medal"></i><span class="kt-menu__link-text dayHead">Sports</span></a></li>

                  <li class="kt-menu__item  <?=($this->uri->uri_string() == 'admin/league' ? 'kt-menu__item--open' : '');?>" aria-haspopup="true"><a href="<?=base_url()?>admin/league" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-cup"></i><span class="kt-menu__link-text dayHead">Leagues</span></a></li>

                  <li class="kt-menu__item  <?=($this->uri->uri_string() == 'admin/season' ? 'kt-menu__item--open' : '');?>" aria-haspopup="true"><a href="<?=base_url()?>admin/season" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-map"></i><span class="kt-menu__link-text dayHead">Seasons</span></a></li>

                  <!-- <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon-users"></i><span class="kt-menu__link-text dayHead">User Management</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                      <ul class="kt-menu__subnav">
                        <li class="kt-menu__item " aria-haspopup="true"><a href="#" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text dayHead">Users</span></a></li>
                        <li class="kt-menu__item " aria-haspopup="true"><a href="#" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text dayHead">Add User</span></a></li>
                      </ul>
                    </div>
                  </li> -->

                  <li class="kt-menu__item  <?=($this->uri->uri_string() == 'admin/user' ? 'kt-menu__item--open' : '');?>" aria-haspopup="true"><a href="<?=base_url()?>admin/user" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-users-1"></i><span class="kt-menu__link-text dayHead">Users</span></a></li>

                  <li class="kt-menu__item  <?=($this->uri->uri_string() == 'admin/setting' ? 'kt-menu__item--open' : '');?>" aria-haspopup="true"><a href="<?=base_url()?>admin/setting" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-settings"></i><span class="kt-menu__link-text dayHead">Settings</span></a></li>

                </ul>
              </div>
            </div>

            <!-- end:: Aside Menu -->
          </div>
          <div class = "kt-portlet kt-portlet--mobile  kt-container--fluid" style = "overflow-x: auto">
            <div class = "kt-portlet__body mainBg">
          <!-- end:: Aside -->
<!--          <button class="btn btn-sm " id="kt_aside_close_btn"><i class="la la-close"></i></button>-->
