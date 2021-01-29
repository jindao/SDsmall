
<!-- begin::Body -->
<?php
//  session_start();
//  var_dump($_SESSION);
?>

  <input type=hidden id="BASE_URL" name="BASE_URL" value="<?=base_url()?>">
  <body class="kt-page--loading-enabled kt-page--loading kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header--minimize-topbar kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-page--loading <?php if (isset($_COOKIE['theme']) && $_COOKIE['theme']=='dark') echo('theme_dark');?>" >
    <!-- begin:: Header Mobile -->
    <div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
      <div class="kt-header-mobile__logo">
        <a href="<?=base_url()?>">
          <img alt="Logo" src="<?=base_url()?>assets/media/logos/logo-green-sm.png" />
        </a>
      </div>
      <div class="kt-header-mobile__toolbar">
        <button class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler"><span></span></button>
        <button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more-1"></i></button>
      </div>
    </div>
    <!-- end:: Header Mobile -->
    <!-- begin:: Page -->
    <div class="kt-grid kt-grid--hor kt-grid--root">
      <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
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
                <!-- begin: Header Menu -->
                <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
                <div class = "kt-header-menu-wrapper" id = "kt_header_menu_wrapper">
                  <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile ml-auto mr-5">
                    <ul class="kt-menu__nav">
                      <li class="kt-menu__item kt-menu__item--submenu kt-menu__item--rel p-2" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                          <span class="kt-menu__link-text">Football</span>
                          <i class="kt-menu__ver-arrow la la-angle-down"></i>
                        </a>
                        <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left pl-3">
                          <ul class="kt-menu__subnav">
                            <li class="kt-menu__item" aria-haspopup="true">
                              <a href="#" class="kt-menu__link ">
                                <span class="kt-menu__link-text">UEFA Champion League</span>
                              </a>
                            </li>
                            <li class="kt-menu__item" aria-haspopup="true">
                              <a href="#" class="kt-menu__link ">
                                <span class="kt-menu__link-text">World Cup</span>
                              </a>
                            </li>
                            <li class="kt-menu__item" aria-haspopup="true">
                              <a href="#" class="kt-menu__link ">
                                <span class="kt-menu__link-text">Asia</span>
                              </a>
                            </li>
                            <li class="kt-menu__item" aria-haspopup="true">
                              <a href="#" class="kt-menu__link ">
                                <span class="kt-menu__link-text">Europ</span>
                              </a>
                            </li>
                            <li class="kt-menu__item" aria-haspopup="true">
                              <a href="#" class="kt-menu__link ">
                                <span class="kt-menu__link-text">All Leagues</span>
                              </a>
                            </li>
                          </ul>
                        </div>
                      </li>
                      <li class="kt-menu__item kt-menu__item--submenu kt-menu__item--rel p-2" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                          <span class="kt-menu__link-text">Basketball</span>
                          <i class="kt-menu__ver-arrow la la-angle-down"></i>
                        </a>
                        <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left pl-3">
                          <ul class="kt-menu__subnav">
                            <li class="kt-menu__item" aria-haspopup="true">
                              <a href="#" class="kt-menu__link ">
                                <span class="kt-menu__link-text">UEFA Champion League</span>
                              </a>
                            </li>
                            <li class="kt-menu__item" aria-haspopup="true">
                              <a href="#" class="kt-menu__link ">
                                <span class="kt-menu__link-text">World Cup</span>
                              </a>
                            </li>
                            <li class="kt-menu__item" aria-haspopup="true">
                              <a href="#" class="kt-menu__link ">
                                <span class="kt-menu__link-text">Asia</span>
                              </a>
                            </li>
                            <li class="kt-menu__item" aria-haspopup="true">
                              <a href="#" class="kt-menu__link ">
                                <span class="kt-menu__link-text">Europ</span>
                              </a>
                            </li>
                            <li class="kt-menu__item" aria-haspopup="true">
                              <a href="#" class="kt-menu__link ">
                                <span class="kt-menu__link-text">All Leagues</span>
                              </a>
                            </li>
                          </ul>
                        </div>
                      </li>
                      <li class="kt-menu__item kt-menu__item--submenu kt-menu__item--rel p-2" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                          <span class="kt-menu__link-text">Tennis</span>
                          <i class="kt-menu__ver-arrow la la-angle-down"></i>
                        </a>
                        <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left pl-3">
                          <ul class="kt-menu__subnav">
                            <li class="kt-menu__item" aria-haspopup="true">
                              <a href="#" class="kt-menu__link ">
                                <span class="kt-menu__link-text">UEFA Champion League</span>
                              </a>
                            </li>
                            <li class="kt-menu__item" aria-haspopup="true">
                              <a href="#" class="kt-menu__link ">
                                <span class="kt-menu__link-text">World Cup</span>
                              </a>
                            </li>
                            <li class="kt-menu__item" aria-haspopup="true">
                              <a href="#" class="kt-menu__link ">
                                <span class="kt-menu__link-text">Asia</span>
                              </a>
                            </li>
                            <li class="kt-menu__item" aria-haspopup="true">
                              <a href="#" class="kt-menu__link ">
                                <span class="kt-menu__link-text">Europ</span>
                              </a>
                            </li>
                            <li class="kt-menu__item" aria-haspopup="true">
                              <a href="#" class="kt-menu__link ">
                                <span class="kt-menu__link-text">All Leagues</span>
                              </a>
                            </li>
                          </ul>
                        </div>
                      </li>
                      <li class="kt-menu__item kt-menu__item--submenu kt-menu__item--rel p-2" data-ktmenu-submenu-toggle="over" aria-haspopup="true">
                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                          <span class="kt-menu__link-text">Baseball</span>
                          <i class="kt-menu__ver-arrow la la-angle-down"></i>
                        </a>
                        <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left pl-3">
                          <ul class="kt-menu__subnav">
                            <li class="kt-menu__item" aria-haspopup="true">
                              <a href="#" class="kt-menu__link ">
                                <span class="kt-menu__link-text">UEFA Champion League</span>
                              </a>
                            </li>
                            <li class="kt-menu__item" aria-haspopup="true">
                              <a href="#" class="kt-menu__link ">
                                <span class="kt-menu__link-text">World Cup</span>
                              </a>
                            </li>
                            <li class="kt-menu__item" aria-haspopup="true">
                              <a href="#" class="kt-menu__link ">
                                <span class="kt-menu__link-text">Asia</span>
                              </a>
                            </li>
                            <li class="kt-menu__item" aria-haspopup="true">
                              <a href="#" class="kt-menu__link ">
                                <span class="kt-menu__link-text">Europ</span>
                              </a>
                            </li>
                            <li class="kt-menu__item" aria-haspopup="true">
                              <a href="#" class="kt-menu__link ">
                                <span class="kt-menu__link-text">All Leagues</span>
                              </a>
                            </li>
                          </ul>
                        </div>
                      </li>
                      <li class="kt-menu__item kt-menu__item--submenu kt-menu__item--rel p-2" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                          <span class="kt-menu__link-text">AM Football</span>
                          <i class="kt-menu__ver-arrow la la-angle-down"></i>
                        </a>
                        <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left pl-3">
                          <ul class="kt-menu__subnav">
                            <li class="kt-menu__item" aria-haspopup="true">
                              <a href="#" class="kt-menu__link ">
                                <span class="kt-menu__link-text">UEFA Champion League</span>
                              </a>
                            </li>
                            <li class="kt-menu__item" aria-haspopup="true">
                              <a href="#" class="kt-menu__link ">
                                <span class="kt-menu__link-text">World Cup</span>
                              </a>
                            </li>
                            <li class="kt-menu__item" aria-haspopup="true">
                              <a href="#" class="kt-menu__link ">
                                <span class="kt-menu__link-text">Asia</span>
                              </a>
                            </li>
                            <li class="kt-menu__item" aria-haspopup="true">
                              <a href="#" class="kt-menu__link ">
                                <span class="kt-menu__link-text">Europ</span>
                              </a>
                            </li>
                            <li class="kt-menu__item" aria-haspopup="true">
                              <a href="#" class="kt-menu__link ">
                                <span class="kt-menu__link-text">All Leagues</span>
                              </a>
                            </li>
                          </ul>
                        </div>
                      </li>
                      <li class="kt-menu__item kt-menu__item--submenu kt-menu__item--rel p-2" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                          <span class="kt-menu__link-text">Cricket</span>
                          <i class="kt-menu__ver-arrow la la-angle-down"></i>
                        </a>
                        <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left pl-3">
                          <ul class="kt-menu__subnav">
                            <li class="kt-menu__item" aria-haspopup="true">
                              <a href="#" class="kt-menu__link ">
                                <span class="kt-menu__link-text">UEFA Champion League</span>
                              </a>
                            </li>
                            <li class="kt-menu__item" aria-haspopup="true">
                              <a href="#" class="kt-menu__link ">
                                <span class="kt-menu__link-text">World Cup</span>
                              </a>
                            </li>
                            <li class="kt-menu__item" aria-haspopup="true">
                              <a href="#" class="kt-menu__link ">
                                <span class="kt-menu__link-text">Asia</span>
                              </a>
                            </li>
                            <li class="kt-menu__item" aria-haspopup="true">
                              <a href="#" class="kt-menu__link ">
                                <span class="kt-menu__link-text">Europ</span>
                              </a>
                            </li>
                            <li class="kt-menu__item" aria-haspopup="true">
                              <a href="#" class="kt-menu__link ">
                                <span class="kt-menu__link-text">All Leagues</span>
                              </a>
                            </li>
                          </ul>
                        </div>
                      </li>
                    </ul>
                  </div>              
                </div>
                <!-- end: Header Menu -->
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
                  <!--begin: My cart-->
                  <div class="kt-header__topbar-item dropdown">
                    <div class="kt-header__topbar-wrapper" data-toggle="dropdown">
                      <button type="button" class="btn btn-cart">
                        <i class="la la-shopping-cart"></i>
                        <span id = "mycart_size" class="cart-size">
                        <?php
                          
                          $shoppingcart = new ShoppingCart();
                          $cartItems = $shoppingcart->getCartItems()["array"];
                          if(is_array($cartItems))
                            echo (count($cartItems));
                          else
                            echo "";
                        ?>
                        </span>
                      </button>
                    </div>
                    <div class="mycart-menu dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim">
                      <form>
                        <!-- begin:: Mycart -->
                        <div class="kt-mycart p-3">
                          <div class="kt-mycart__head p-0">
                            <div class="kt-mycart__info">
                              <span class="kt-mycart__title pl-2">My Cart</span>
                            </div>
                          </div>
                          <div id = "mycart__body" class="kt-mycart__body kt-scroll" data-scroll="true" data-height="auto" data-mobile-height="200">
                            <div class="kt-mycart__section">
                               <?php 
                               if(is_array($cartItems))
                                foreach($cartItems as $item){
                                    echo '<div class="kt-mycart__item alert alert-secondary alert-dismissible p-2 m-2">
                                    <span>'.$item["season_name"].'</span>
                                    <button type="button" class="close p-2 m-0" data-dismiss="alert" onclick="removeShoppingCartItem(\''.$item["id"].'\')">&times;</button>
                                  </div>';
                                }
                               ?> 
                            </div>
                            <div class="kt-mycart__section m-2 mt-3 mb-3">
                              <span class="kt-mycart__subtitle"><?php if(is_array($cartItems)) echo count($cartItems); else echo "0";?> items in cart</span>
                              <button type="button" onclick = "manageShoppingCart('' , '' );" class="btn update-cart p-0 text-normal"> Update cart <i class="flaticon-refresh"></i></button>
                            </div>
                            <div class="kt-mycart__section p-1">
                              <div class="kt-align-right p-1">
                                <span style = "left: 50px;position: absolute;" class="kt-mycart__subtitle">Subtotal:</span>
                                <span class="kt-mycart__price ml-3 text-normal">$ <?php echo $shoppingcart->getCartItems()["finalSum"];?></span>
                              </div>
                              <div class="kt-align-right p-1">
                                <span style = "left: 50px;position: absolute;" class="kt-mycart__subtitle">Taxation:</span>
                                <span class="kt-mycart__price ml-3 text-normal">$ 0.00</span>
                              </div>
                              <div class="kt-align-right p-1">
                                <span style = "left: 50px;position: absolute;" class="kt-mycart__subtitle">Total:</span>
                                <span class="kt-mycart_price ml-3 text-green">$ <?php echo $shoppingcart->getCartItems()["finalSum"];?></span>
                              </div>
                            </div>
                          </div>
                          <div class="kt-mycart__footer p-0">
                            <div class="kt-mycart__button kt-align-right">
                              <a href = "<?=base_url()?>checkout"><button type="button" class="btn btn-checkout">Checkout</button></a>
                            </div>
                          </div>
                        </div>
                        <!-- end:: Mycart -->
                      </form>
                    </div>
                  </div>
                  <!--end: My cart-->
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
                        <!-- <a href="<?=base_url()?>myaccount/billinfo" class="dropdown-item">Billing Information</a> -->
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
          
          <!-- begin:: Body -->
          <div class="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch" id="kt_body">
            <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
