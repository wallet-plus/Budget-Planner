<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Savings');
$this->params['breadcrumbs'][] = $this->title;
?>


<!-- <pre>
<?php print_r($categories); ?>
</pre> -->
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>





<div class="flex flex-col flex-auto min-w-0">

      <div class="relative flex flex-col sm:flex-row flex-0 sm:items-center sm:justify-between py-8 px-6 md:px-8 border-b ng-tns-c161-6 bg-card">
        <div class="text-4xl font-extrabold tracking-tight ng-tns-c161-6"><?= Html::encode($this->title) ?></div>
        <div class="flex flex-shrink-0 items-center mt-6 sm:mt-0 sm:ml-4 ng-tns-c161-6">
          <!-- <mat-form-field class="mat-form-field fuse-mat-dense fuse-mat-no-subscript fuse-mat-rounded min-w-64 ng-tns-c161-6 ng-tns-c36-7 mat-primary mat-form-field-type-mat-input mat-form-field-appearance-fill mat-form-field-can-float ng-pristine ng-valid ng-star-inserted ng-touched">
            <div class="mat-form-field-wrapper ng-tns-c36-7">
              <div class="mat-form-field-flex ng-tns-c36-7">
                <div class="mat-form-field-prefix ng-tns-c36-7 ng-star-inserted">
                  <mat-icon role="img" matprefix="" class="mat-icon notranslate icon-size-5 mat-icon-no-color ng-tns-c36-7" aria-hidden="true" ng-reflect-svg-icon="heroicons_solid:search" data-mat-icon-type="svg" data-mat-icon-name="search" data-mat-icon-namespace="heroicons_solid">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" fit="" height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
                      <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                    </svg>
                  </mat-icon>
                </div>
                <div class="mat-form-field-infix ng-tns-c36-7">
                  <input matinput="" class="mat-input-element mat-form-field-autofill-control ng-tns-c36-7 ng-pristine ng-valid cdk-text-field-autofill-monitored ng-touched" ng-reflect-form="[object Object]" autocomplete="off" ng-reflect-placeholder="Search products" placeholder="Search products" id="mat-input-0" data-placeholder="Search products" aria-invalid="false" aria-required="false">
                  <span class="mat-form-field-label-wrapper ng-tns-c36-7"></span>
                </div>
              </div>
              <div class="mat-form-field-underline ng-tns-c36-7 ng-star-inserted">
                <span class="mat-form-field-ripple ng-tns-c36-7"></span>
              </div>
              <div class="mat-form-field-subscript-wrapper ng-tns-c36-7" ng-reflect-ng-switch="hint">
                <div class="mat-form-field-hint-wrapper ng-tns-c36-7 ng-trigger ng-trigger-transitionMessages ng-star-inserted" style="opacity: 1; transform: translateY(0%);">
                  <div class="mat-form-field-hint-spacer ng-tns-c36-7"></div>
                </div>
              </div>
            </div>
          </mat-form-field> -->

          <button mat-flat-button="" class="mat-focus-indicator ml-4 ng-tns-c161-6 mat-flat-button mat-button-base mat-primary" ng-reflect-color="primary">
            <span class="mat-button-wrapper">
              <!-- <mat-icon role="img" class="mat-icon notranslate mat-icon-no-color" aria-hidden="true" ng-reflect-svg-icon="heroicons_outline:plus" data-mat-icon-type="svg" data-mat-icon-name="plus" data-mat-icon-namespace="heroicons_outline">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" fit="" height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
              </mat-icon> -->
              <span>
                <!-- <?= Html::a(Yii::t('app', 'Create Savings'), ['create'], ['class' => 'btn']) ?> -->
                <a class="btn" id="ShowAnalytics">Show Analytics<a>
              </span>
            </span>
            <span matripple="" class="mat-ripple mat-button-ripple" ng-reflect-disabled="false" ng-reflect-centered="false" ng-reflect-trigger="[object HTMLButtonElement]"></span>
            <span class="mat-button-focus-overlay"></span>
          </button>

          <button mat-flat-button="" class="mat-focus-indicator ml-4 ng-tns-c161-6 mat-flat-button mat-button-base mat-primary" ng-reflect-color="primary">
            <span class="mat-button-wrapper">
              <mat-icon role="img" class="mat-icon notranslate mat-icon-no-color" aria-hidden="true" ng-reflect-svg-icon="heroicons_outline:plus" data-mat-icon-type="svg" data-mat-icon-name="plus" data-mat-icon-namespace="heroicons_outline">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" fit="" height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
              </mat-icon>
              <span><?= Html::a(Yii::t('app', 'Create Savings'), ['create'], ['class' => 'btn']) ?></span>
            </span>
            <span matripple="" class="mat-ripple mat-button-ripple" ng-reflect-disabled="false" ng-reflect-centered="false" ng-reflect-trigger="[object HTMLButtonElement]"></span>
            <span class="mat-button-focus-overlay"></span>
          </button>
        </div>
      </div>





      <!-- Savings Chart section start -->
      <!-- analytics-section sm:col-span-2 md:col-span-4 flex flex-col flex-auto p-6  rounded-2xl overflow-hidden -->
      <div 
        class="analytics-section bg-card shadow p-6" style="display:none !important;">
        <!-- <div class="flex flex-col sm:flex-row items-start justify-between " >
          <div class="text-lg font-medium tracking-tight leading-6 truncate">Savings Analytics</div>
          <div class="mt-3 sm:mt-0 sm:ml-2">
            <mat-button-toggle-group role="group" value="this-week" class="mat-button-toggle-group mat-button-toggle-group-appearance-standard" aria-disabled="false">
              <mat-button-toggle role="presentation" value="last-week" class="mat-button-toggle mat-button-toggle-appearance-standard" id="mat-button-toggle-3">
                <button type="button" class="mat-button-toggle-button mat-focus-indicator" id="mat-button-toggle-3-button" tabindex="0" aria-pressed="false" name="mat-button-toggle-group-0">
                  <span class="mat-button-toggle-label-content">Year</span>
                </button>
                <span class="mat-button-toggle-focus-overlay"></span>
                <span matripple="" class="mat-ripple mat-button-toggle-ripple"></span>
              </mat-button-toggle>
              <mat-button-toggle role="presentation" value="this-week" class="mat-button-toggle mat-button-toggle-checked mat-button-toggle-appearance-standard" id="mat-button-toggle-4">
                <button type="button" class="mat-button-toggle-button mat-focus-indicator" id="mat-button-toggle-4-button" tabindex="0" aria-pressed="true" name="mat-button-toggle-group-0">
                  <span class="mat-button-toggle-label-content">Month</span>
                </button>
                <span class="mat-button-toggle-focus-overlay"></span>
                <span matripple="" class="mat-ripple mat-button-toggle-ripple"></span>
              </mat-button-toggle>
            </mat-button-toggle-group>
          </div>
        </div> -->
        <!-- lg:grid-cols-2 -->
        <div class="grid grid-cols-1  grid-flow-row gap-6 w-full mt-8 sm:mt-4">
          <div class="flex flex-col">
            <div class="font-medium text-secondary">Overview</div>
            <div class="flex-auto grid grid-cols-4 gap-4 mt-6">

              <?php 
              foreach ($categories as $cat) { ?>
                <div class="col-span-2 flex flex-col items-center justify-center py-8 px-1 rounded-2xl bg-indigo-50 text-indigo-800 dark:bg-white dark:bg-opacity-5 dark:text-indigo-400">
                  <div class="text-5xl sm:text-7xl font-semibold leading-none tracking-tight"> 
                  <?php 
                  $cat['amount'] = number_format((float)$cat['amount'], 2, '.', '');
                  echo preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $cat['amount']);
                  ?>
                  
                </div>
                <?php 
                
                if($cat['category_name'] == 'Gold (Grams)') { 
                  $totalGoldAmount = number_format((float)($cat['amount'] * 6005), 2, '.', '');
                  $zakatAmount = number_format((float)(( 2.5/ 100) *  ( $cat['amount'] * 6005)), 2, '.', '');
                  ?>

                  

                  <p><b><?php echo preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $totalGoldAmount); ?></b> (1 Gram 6,005)</p>
                  <p>Zakat Amount : <?php echo preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $zakatAmount);   ?> </p>
                 <?php } ?>
                  <div class="mt-1 text-sm sm:text-lg font-medium"><?php echo $cat['category_name']; ?></div>
                </div>
              <?php  } ?>

              <!-- <div class="col-span-2 flex flex-col items-center justify-center py-8 px-1 rounded-2xl bg-indigo-50 text-indigo-800 dark:bg-white dark:bg-opacity-5 dark:text-indigo-400">
                <div class="text-5xl sm:text-7xl font-semibold leading-none tracking-tight"> 214 </div>
                <div class="mt-1 text-sm sm:text-lg font-medium">Total Savings</div>
              </div>

              <div class="col-span-2 flex flex-col items-center justify-center py-8 px-1 rounded-2xl bg-indigo-50 text-indigo-800 dark:bg-white dark:bg-opacity-5 dark:text-indigo-400">
                <div class="text-5xl sm:text-7xl font-semibold leading-none tracking-tight"> 214 </div>
                <div class="mt-1 text-sm sm:text-lg font-medium">Long Term Savings</div>
              </div>

              <div class="col-span-2 flex flex-col items-center justify-center py-8 px-1 rounded-2xl bg-green-50 text-green-800 dark:bg-white dark:bg-opacity-5 dark:text-green-500">
                <div class="text-5xl sm:text-7xl font-semibold leading-none tracking-tight"> 75 </div>
                <div class="mt-1 text-sm sm:text-lg font-medium">short Term Savings</div>
              </div>
              <div class="col-span-2 flex flex-col items-center justify-center py-8 px-1 rounded-2xl bg-green-50 text-green-800 dark:bg-white dark:bg-opacity-5 dark:text-green-500">
                <div class="text-5xl sm:text-7xl font-semibold leading-none tracking-tight"> 75 </div>
                <div class="mt-1 text-sm sm:text-lg font-medium">Emergency Fund</div>
              </div>
               -->

              <!-- <div class="col-span-2 sm:col-span-1 flex flex-col items-center justify-center py-8 px-1 rounded-2xl bg-gray-100 text-secondary dark:bg-white dark:bg-opacity-5">
                <div class="text-5xl font-semibold leading-none tracking-tight"> 3 </div>
                <div class="mt-1 text-sm font-medium text-center">Long Term</div>
              </div>
              <div class="col-span-2 sm:col-span-1 flex flex-col items-center justify-center py-8 px-1 rounded-2xl bg-gray-100 text-secondary dark:bg-white dark:bg-opacity-5">
                <div class="text-5xl font-semibold leading-none tracking-tight"> 4 </div>
                <div class="mt-1 text-sm font-medium text-center">Short Term</div>
              </div>
              <div class="col-span-2 sm:col-span-1 flex flex-col items-center justify-center py-8 px-1 rounded-2xl bg-gray-100 text-secondary dark:bg-white dark:bg-opacity-5">
                <div class="text-5xl font-semibold leading-none tracking-tight"> 8 </div>
                <div class="mt-1 text-sm font-medium text-center">Re-opened</div>
              </div>
              <div class="col-span-2 sm:col-span-1 flex flex-col items-center justify-center py-8 px-1 rounded-2xl bg-gray-100 text-secondary dark:bg-white dark:bg-opacity-5">
                <div class="text-5xl font-semibold leading-none tracking-tight"> 6 </div>
                <div class="mt-1 text-sm font-medium text-center">Needs Triage</div>
              </div> -->
              
            </div>
          </div>
        </div>
      </div>
      <!-- Savings Chart section end -->


      <div class="flex-auto p-6 sm:p-10">
        <div class="max-w-3xl">
          <div class="prose prose-sm max-w-3xl">
            <!-- <p> By default, Fuse changes the default form field appearance to <em>fill</em> and heavily modifies it to provide a more unique and consistent look. We <strong>DO NOT</strong> recommend using any other form field styles as they are not optimized for Fuse. </p> -->
            <!-- <h2>Appearance</h2> -->
            <!-- <p> Here's a very simple form layout to showcase the form fields. </p> -->
          </div>
        



          <?php if (Yii::$app->session->hasFlash('success')): ?>
                <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <h4><i class="icon fa fa-check"></i>Saved!</h4>
                    <?= Yii::$app->session->getFlash('success') ?>
                </div>
            <?php endif; ?>

            <?php if (Yii::$app->session->hasFlash('error')): ?>
                <div class="alert alert-danger alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <h4><i class="icon fa fa-check"></i>Saved!</h4>
                    <?= Yii::$app->session->getFlash('error') ?>
                </div>
            <?php endif; ?>


        



          <?= GridView::widget([
              'dataProvider' => $dataProvider,
              'columns' => [
                  ['class' => 'yii\grid\SerialColumn'],

                  // 'id_expense',
                  // 'id_type',
                  // 'id_category',
                  // 'id_customer',
                  'expense_name',
                  //'description:ntext',
                  //'image',
                  'amount',
                  'date_of_transaction',
                  //'deleted',
                  //'created_by',
                  //'date_created',
                  //'updated_by',
                  //'date_updated',
                  [
                    'class' => ActionColumn::className(),
                    'template' => '{update} {delete}',
                    'urlCreator' => function ($action, \app\models\Expense $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id_expense' => $model->id_expense]);
                    }
                  ],
              ],
          ]); ?>
        </div>
      </div>


  </div>

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script>


    // setTimeout(() => {
    //     google.charts.load('current', {'packages':['bar']});
    //     google.charts.setOnLoadCallback(drawChart);

    //     function drawChart() {
    //     var data = google.visualization.arrayToDataTable([
    //         ['Category', 'Amount'],
    //         <?php 
    //         foreach ($expenses as $exp) {
    //         echo "['".$exp['category_name']."', ". $exp['amount'] . "],";
    //         } ?>
    //     ]);
    //     var options = {
    //         chart: {
    //         title: 'Savings',
    //         height: 500,
    //         width: 500,
    //         chartArea:{left:0,top:0,width:"100%",height:"100%"}
    //         // subtitle: 'Sales, Expenses, and Profit: 2014-2017',
    //         },legend: {position: 'none'}
    //     };
    //     var chart = new google.charts.Bar(document.getElementById('savings_chart'));
    //     chart.draw(data, google.charts.Bar.convertOptions(options));
    //     }
    // }, 1000);

    $("#ShowAnalytics").click(function(){
      $('.analytics-section').toggle();

      // $('.analytics-section').addClass('block');
      // $('.analytics-section ').removeClass('hide');

    })
  </script>