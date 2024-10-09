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





    
        <div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
        <!--left-fixed -navigation-->
        <aside class="sidebar-left">
        <nav class="navbar navbar-inverse">
        <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".collapse" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </button>
        <h1><a class="navbar-brand" ><span class="fa fa-area-chart"></span> <?php echo Yii::$app->name; ?></a></h1>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


            <?php
            NavBar::begin([
                // 'brandLabel' => Yii::$app->name,
                'brandUrl' => Yii::$app->homeUrl,
                'renderInnerContainer'=>false,
                'options' => [
                    'class' => 'sidebar-menu',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'treeview'],
                'items' => [
                    ['label' => 'Dashboard', 'url' => ['/site/dashboard'], 'visible' => !Yii::$app->user->isGuest],
                    ['label' => 'Customer', 'url' => ['/customer'], 'visible' => !Yii::$app->user->isGuest],
                    ['label' => 'Category', 'url' => ['/category'], 'visible' => !Yii::$app->user->isGuest],
                    ['label' => 'Categories', 'url' => ['/category'], 'visible' => !Yii::$app->user->isGuest],
                    ['label' => 'Income', 'url' => ['/income'], 'visible' => !Yii::$app->user->isGuest],
                    ['label' => 'Expense', 'url' => ['/expense'], 'visible' => !Yii::$app->user->isGuest],
                    ['label' => 'Savings', 'url' => ['/savings'], 'visible' => !Yii::$app->user->isGuest],
                    Yii::$app->user->isGuest ? (
                        ['label' => 'Login', 'url' => ['/site/login']]
                    ) : (
                        '<li>'
                        . Html::beginForm(['/site/logout'], 'post', ['class' => 'treeview'])
                        . Html::submitButton(
                            'Logout (' . Yii::$app->user->identity->username . ')',
                            ['class' => 'btn btn-link logout']
                        )
                        . Html::endForm()
                        . '</li>'
                    )
                ],
            ]);
            NavBar::end();
            ?>

        </div>
        <!-- /.navbar-collapse -->
        </nav>
        </aside>
        </div>



    <!-- header-starts -->
<div class="sticky-header header-section ">
<div class="header-left">
    <!--toggle button start-->
    <button id="showLeftPush"><i class="fa fa-bars"></i></button>
    <!--toggle button end-->
    <div class="profile_details_left"><!--notifications of menu start -->
        <ul class="nofitications-dropdown">
            <li class="dropdown head-dpdn">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-envelope"></i><span class="badge">4</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <div class="notification_header">
                            <h3>You have 3 new messages</h3>
                        </div>
                    </li>
                    <li><a href="#">
                        <div class="user_img"><img src="app/images/1.jpg" alt=""></div>
                        <div class="notification_desc">
                        <p>Lorem ipsum dolor amet</p>
                        <p><span>1 hour ago</span></p>
                        </div>
                        <div class="clearfix"></div>	
                    </a></li>
                    <li class="odd"><a href="#">
                        <div class="user_img"><img src="app/images/4.jpg" alt=""></div>
                        <div class="notification_desc">
                        <p>Lorem ipsum dolor amet </p>
                        <p><span>1 hour ago</span></p>
                        </div>
                        <div class="clearfix"></div>	
                    </a></li>
                    <li><a href="#">
                        <div class="user_img"><img src="app/images/3.jpg" alt=""></div>
                        <div class="notification_desc">
                        <p>Lorem ipsum dolor amet </p>
                        <p><span>1 hour ago</span></p>
                        </div>
                        <div class="clearfix"></div>	
                    </a></li>
                    <li><a href="#">
                        <div class="user_img"><img src="app/images/2.jpg" alt=""></div>
                        <div class="notification_desc">
                        <p>Lorem ipsum dolor amet </p>
                        <p><span>1 hour ago</span></p>
                        </div>
                        <div class="clearfix"></div>	
                    </a></li>
                    <li>
                        <div class="notification_bottom">
                            <a href="#">See all messages</a>
                        </div> 
                    </li>
                </ul>
            </li>
            <li class="dropdown head-dpdn">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell"></i><span class="badge blue">4</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <div class="notification_header">
                            <h3>You have 3 new notification</h3>
                        </div>
                    </li>
                    <li><a href="#">
                        <div class="user_img"><img src="app/images/4.jpg" alt=""></div>
                        <div class="notification_desc">
                        <p>Lorem ipsum dolor amet</p>
                        <p><span>1 hour ago</span></p>
                        </div>
                        <div class="clearfix"></div>	
                        </a></li>
                        <li class="odd"><a href="#">
                        <div class="user_img"><img src="app/images/1.jpg" alt=""></div>
                        <div class="notification_desc">
                        <p>Lorem ipsum dolor amet </p>
                        <p><span>1 hour ago</span></p>
                        </div>
                        <div class="clearfix"></div>	
                        </a></li>
                        <li><a href="#">
                        <div class="user_img"><img src="app/images/3.jpg" alt=""></div>
                        <div class="notification_desc">
                        <p>Lorem ipsum dolor amet </p>
                        <p><span>1 hour ago</span></p>
                        </div>
                        <div class="clearfix"></div>	
                        </a></li>
                    <li><a href="#">
                        <div class="user_img"><img src="app/images/2.jpg" alt=""></div>
                        <div class="notification_desc">
                        <p>Lorem ipsum dolor amet </p>
                        <p><span>1 hour ago</span></p>
                        </div>
                        <div class="clearfix"></div>	
                    </a></li>
                        <li>
                        <div class="notification_bottom">
                            <a href="#">See all notifications</a>
                        </div> 
                    </li>
                </ul>
            </li>	
            <li class="dropdown head-dpdn">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-tasks"></i><span class="badge blue1">8</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <div class="notification_header">
                            <h3>You have 8 pending task</h3>
                        </div>
                    </li>
                    <li><a href="#">
                        <div class="task-info">
                            <span class="task-desc">Database update</span><span class="percentage">40%</span>
                            <div class="clearfix"></div>	
                        </div>
                        <div class="progress progress-striped active">
                            <div class="bar yellow" style="width:40%;"></div>
                        </div>
                    </a></li>
                    <li><a href="#">
                        <div class="task-info">
                            <span class="task-desc">Dashboard done</span><span class="percentage">90%</span>
                            <div class="clearfix"></div>	
                        </div>
                        <div class="progress progress-striped active">
                                <div class="bar green" style="width:90%;"></div>
                        </div>
                    </a></li>
                    <li><a href="#">
                        <div class="task-info">
                            <span class="task-desc">Mobile App</span><span class="percentage">33%</span>
                            <div class="clearfix"></div>	
                        </div>
                        <div class="progress progress-striped active">
                                <div class="bar red" style="width: 33%;"></div>
                        </div>
                    </a></li>
                    <li><a href="#">
                        <div class="task-info">
                            <span class="task-desc">Issues fixed</span><span class="percentage">80%</span>
                            <div class="clearfix"></div>	
                        </div>
                        <div class="progress progress-striped active">
                                <div class="bar  blue" style="width: 80%;"></div>
                        </div>
                    </a></li>
                    <li>
                        <div class="notification_bottom">
                            <a href="#">See all pending tasks</a>
                        </div> 
                    </li>
                </ul>
            </li>	
        </ul>
        <div class="clearfix"> </div>
    </div>
    <!--notification menu end -->
    <div class="clearfix"> </div>
</div>
<div class="header-right">
    
    
    <!--search-box-->
    <div class="search-box">
        <form class="input">
            <input class="sb-search-input input__field--madoka" placeholder="Search..." type="search" id="input-31" />
            <label class="input__label" for="input-31">
                <svg class="graphic" width="100%" height="100%" viewBox="0 0 404 77" preserveAspectRatio="none">
                    <path d="m0,0l404,0l0,77l-404,0l0,-77z"/>
                </svg>
            </label>
        </form>
    </div><!--//end-search-box-->
    
    <div class="profile_details">		
        <ul>
            <li class="dropdown profile_details_drop">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <div class="profile_img">	
                        <span class="prfil-img"><img src="app/images/2.jpg" alt=""> </span> 
                        <div class="user-name">
                            <p><?php echo Yii::$app->user->identity->username ?></p>
                            <span>Administrator</span>
                        </div>
                        <i class="fa fa-angle-down lnr"></i>
                        <i class="fa fa-angle-up lnr"></i>
                        <div class="clearfix"></div>	
                    </div>	
                </a>

                

                <ul class="dropdown-menu drp-mnu">
                    <li> <a href="#"><i class="fa fa-cog"></i> Settings</a> </li> 
                    <li> <a href="#"><i class="fa fa-user"></i> My Account</a> </li> 
                    <li> <a href="#"><i class="fa fa-suitcase"></i> Profile</a> </li> 
                    <li> <a href="#"><i class="fa fa-sign-out"></i> Logout</a> </li>
                </ul>

                <?php
                /*
                NavBar::begin([
                    // 'brandLabel' => Yii::$app->name,
                    'brandUrl' => Yii::$app->homeUrl,
                    'renderInnerContainer'=>false,
                    'options' => [
                        'class' => 'dropdown-menu drp-mnu',
                    ],
                ]);
                echo Nav::widget([
                    'options' => ['class' => ''],
                    'items' => [
                        ['label' => 'Settings', 'url' => ['/site/dashboard'], 'visible' => !Yii::$app->user->isGuest],
                        ['label' => 'My Account', 'url' => ['/customer'], 'visible' => !Yii::$app->user->isGuest],
                        ['label' => 'Profile', 'url' => ['/category'], 'visible' => !Yii::$app->user->isGuest],
                        Yii::$app->user->isGuest ? (
                            ['label' => 'Login', 'url' => ['/site/login']]
                        ) : (
                            '<li>'
                            . Html::beginForm(['/site/logout'], 'post', ['class' => 'treeview'])
                            . Html::submitButton(
                                'Logout (' . Yii::$app->user->identity->username . ')',
                                ['class' => 'btn btn-link logout']
                            )
                            . Html::endForm()
                            . '</li>'
                        )
                    ],
                ]);
                NavBar::end();
                */
                ?>
            </li>
        </ul>
    </div>
    <div class="clearfix"> </div>				
</div>
<div class="clearfix"> </div>	
</div>
<!-- //header-ends -->