<?php

/** @var yii\web\View $this */
/** @var string $content */
use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
AppAsset::register($this);
?> 

<?php $this->beginPage(); ?>



	<?php  echo $this->render('header'); ?>
  <body>
  <?php if(Yii::$app->user->identity ) { ?>
  <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
      
        <?php  echo $this->render('app-menu'); ?>
     

        <!-- Layout wrapper -->

        

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->
          <?php if(Yii::$app->user->identity ) { ?>
            <nav
              class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
              id="layout-navbar">
              <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                  <i class="bx bx-menu bx-sm"></i>
                </a>
              </div>

              <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                <!-- Search -->
                <div class="navbar-nav align-items-center">
                  <div class="nav-item d-flex align-items-center">
                    <i class="bx bx-search fs-4 lh-0"></i>
                    <input
                      type="text"
                      class="form-control border-0 shadow-none ps-1 ps-sm-2"
                      placeholder="Search..."
                      aria-label="Search..." />
                  </div>
                </div>
                <!-- /Search -->

                <ul class="navbar-nav flex-row align-items-center ms-auto">
                  

                  <!-- User -->
                  <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                      <div class="avatar avatar-online">
                        

                        <?= Html::img('@web/users/' . Yii::$app->user->identity->image, ['alt' => 'Image', 'class'=>'w-px-40 h-auto rounded-circle']) ?>
                      </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                      <li>
                        <a class="dropdown-item" href="#">
                          <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                              <div class="avatar avatar-online">
                                <?= Html::img('@web/users/' . Yii::$app->user->identity->image, ['alt' => 'Image', 'class'=>'w-px-40 h-auto rounded-circle']) ?>
                              </div>
                            </div>
                            <div class="flex-grow-1">
                              <span class="fw-medium d-block"><?php echo Yii::$app->user->identity->firstname;?> <?php echo Yii::$app->user->identity->lastname;?></span>
                              <!-- <small class="text-muted">Admin</small> -->
                            </div>
                          </div>
                        </a>
                      </li>
                      <li>
                        <div class="dropdown-divider"></div>
                      </li>
                      <li>
                        <?php echo Html::a(
                          '<i class="bx bx-user me-2"></i>
                          <span class="align-middle">My Profile</span>',
                          ['/site/profile'],
                          ['class' => 'dropdown-item', 'encode' => false]
                        ); ?>
                      </li>
                      <li>
                        <div class="dropdown-divider"></div>
                      </li>
                      <li>
                          <?php echo Html::beginForm(['/site/logout'], 'post', ['id' => 'logout-form', 'class' => 'd-inline']) ?>
                              <a href="javascript:void(0);" class="dropdown-item" onclick="document.getElementById('logout-form').submit();">
                                  <i class="bx bx-power-off me-2"></i>
                                  <span class="align-middle">Log Out</span>
                              </a>
                          <?php echo Html::endForm() ?>
                      </li>
                    </ul>
                  </li>
                  <!--/ User -->
                </ul>
              </div>
            </nav>
          <?php }?>
          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            
            <?php echo $content ?>
            <!-- / Content -->

            <!-- Footer -->
            <!-- <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  , made with ❤️ by
                  <a href="https://themeselection.com" target="_blank" class="footer-link fw-medium">ThemeSelection</a>
                </div>
                <div class="d-none d-lg-inline-block">
                  <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
                  <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>

                  <a
                    href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/documentation/"
                    target="_blank"
                    class="footer-link me-4"
                    >Documentation</a
                  >

                  <a
                    href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
                    target="_blank"
                    class="footer-link"
                    >Support</a
                  >
                </div>
              </div>
            </footer> -->
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      
    <!-- / Layout wrapper -->
      </div>
    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
  </div>
  <?php }else { ?>
    <?php echo $content ?>
  <?php } ?>   

    <?php  echo $this->render('footer'); ?>
    
  </body>

<?php $this->endPage(); ?>