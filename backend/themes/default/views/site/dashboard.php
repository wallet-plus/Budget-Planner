<?php
use yii\helpers\Url;
use yii\bootstrap4\Html;
?>

<project class="ng-star-inserted">
      <div class="flex flex-col flex-auto min-w-0">
        <div class="bg-card">
          <div class="flex flex-col w-full max-w-screen-xl mx-auto px-6 sm:px-8">
            <div class="flex flex-col sm:flex-row flex-auto sm:items-center min-w-0 my-8 sm:my-12">
              <div class="flex flex-auto items-center min-w-0">
                <div class="flex-0 w-16 h-16 rounded-full overflow-hidden">
                  <?= Html::img('@web/users/' . Yii::$app->user->identity->image, ['alt' => 'Image', ]) ?>
                  <!-- <img src=" class="w-full h-full object-cover"> -->
                </div>
                <div class="flex flex-col min-w-0 ml-4">
                  <div class="text-2xl md:text-5xl font-semibold tracking-tight leading-7 md:leading-snug truncate ng-star-inserted">Welcome back, <?php echo Yii::$app->user->identity->firstname;?> <?php echo Yii::$app->user->identity->lastname;?>!</div>
                  <div class="flex items-center">
                    <mat-icon role="img" class="mat-icon notranslate icon-size-5 mat-icon-no-color" aria-hidden="true" ng-reflect-svg-icon="heroicons_solid:bell" data-mat-icon-type="svg" data-mat-icon-name="bell" data-mat-icon-namespace="heroicons_solid">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" fit="" height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
                        <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"></path>
                      </svg>
                    </mat-icon>
                    <div class="ml-1.5 leading-6 truncate text-secondary">Do not save what is left after spending, but spend what is left after saving. – Warren Buffett</div>
                  </div>
                </div>
              </div>
              <div class="flex items-center mt-6 sm:mt-0 sm:ml-2 space-x-3">
                <!-- <button mat-flat-button="" class="mat-focus-indicator fuse-mat-button-rounded bg-accent-700 mat-flat-button mat-button-base mat-accent" ng-reflect-color="accent">
                  <span class="mat-button-wrapper">
                    <mat-icon role="img" class="mat-icon notranslate icon-size-5 mat-icon-no-color" aria-hidden="true" ng-reflect-svg-icon="heroicons_solid:mail" data-mat-icon-type="svg" data-mat-icon-name="mail" data-mat-icon-namespace="heroicons_solid">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" fit="" height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                      </svg>
                    </mat-icon>
                    <span class="ml-2">Messages</span>
                  </span>
                  <span  class="mat-ripple mat-button-ripple" ng-reflect-disabled="false" ng-reflect-centered="false" ng-reflect-trigger="[object HTMLButtonElement]"></span>
                  <span class="mat-button-focus-overlay"></span>
                </button> -->
                <button mat-flat-button="" class="mat-focus-indicator fuse-mat-button-rounded mat-flat-button mat-button-base mat-primary" ng-reflect-color="primary">
                  <span class="mat-button-wrapper">


                    <mat-icon role="img" class="mat-icon notranslate icon-size-5 mat-icon-no-color" aria-hidden="true" ng-reflect-svg-icon="heroicons_solid:cog" data-mat-icon-type="svg" data-mat-icon-name="cog" data-mat-icon-namespace="heroicons_solid">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" fit="" height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
                        <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path>
                      </svg>
                    </mat-icon>
                    <span class="ml-2"><?php echo Html::a('Profile', ['/site/profile'], ['class'=>'mat-tooltip-trigger fuse-vertical-navigation-item ng-star-inserted']);?></span>
                  </span>
                  <span  class="mat-ripple mat-button-ripple" ng-reflect-disabled="false" ng-reflect-centered="false" ng-reflect-trigger="[object HTMLButtonElement]"></span>
                  <span class="mat-button-focus-overlay"></span>
                </button>
              </div>
            </div>
            
          </div>
        </div>
        <div class="flex-auto border-t -mt-px pt-4 sm:pt-6">
          <div class="w-full max-w-screen-xl mx-auto">
            <mat-tab-group class="mat-tab-group sm:px-2 mat-primary" ng-reflect-animation-duration="0">
              
              <div class="mat-tab-body-wrapper">
                <mat-tab-body role="tabpanel" class="mat-tab-body ng-tns-c207-101 mat-tab-body-active ng-star-inserted" id="mat-tab-content-3-0" ng-reflect-_content="[object Object]" ng-reflect-position="0" ng-reflect-animation-duration="0ms" aria-labelledby="mat-tab-label-3-0" ng-reflect-origin="0">
                  <div cdkscrollable="" class="mat-tab-body-content ng-tns-c207-101 ng-trigger ng-trigger-translateTab" style="transform: none;">

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 w-full min-w-0 ng-star-inserted" style="">

                    
                    <div class="flex flex-col flex-auto p-6 bg-card shadow rounded-2xl overflow-hidden">
                   
                    <!-- <a href="<?= Url::toRoute('income/index')?>"> -->
                      <div class="flex items-start justify-between">
                          <div class="text-lg font-medium tracking-tight leading-6 truncate">Remaining</div>
                        </div>
                        <div class="flex flex-col items-center mt-2">
                          <div class="text-6xl sm:text-6xl font-bold tracking-tight leading-none text-amber-500">
                            <?php 
                            $remaining = number_format((float)$incomeTotal - ($expenseTotal + $expenditureTotal), 2, '.', '');
                            echo preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $remaining);
                            ?>
                          </div>
                          <div class="text-lg font-medium text-amber-600 dark:text-amber-500">In Wallet</div>
                        </div>
                      <!-- </a> -->
                       
                      </div>

                      

                      <div class="flex flex-col flex-auto p-6 bg-card shadow rounded-2xl overflow-hidden">
                      <a href="<?= Url::toRoute('income/index')?>">
                        <div class="flex items-start justify-between">
                          <div class="text-lg font-medium tracking-tight leading-6 truncate">Total Income</div>                          
                        </div>
                        <div class="flex flex-col items-center mt-2">
                          <div class="text-6xl sm:text-6xl font-bold tracking-tight leading-none text-blue-500">
                            
                            <?php 
                            $incomeTotal = number_format((float)$incomeTotal, 2, '.', '');
                            echo preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $incomeTotal);
                            ?>
                            
                            </div>
                          <div class="text-lg font-medium text-blue-600 dark:text-blue-500">Rs.<?php echo round($incomeTotal / 30, 2) ?>/ Day</div>
                        </div>
                        </a>
                      </div>

                      


                      <div class="flex flex-col flex-auto p-6 bg-card shadow rounded-2xl overflow-hidden">
                      <a href="<?= Url::toRoute('savings/index')?>">
                        <div class="flex items-start justify-between">
                          <div class="text-lg font-medium tracking-tight leading-6 truncate">Savings</div>
                        </div>
                        <div class="flex flex-col items-center mt-2">
                          <div class="text-6xl sm:text-6xl font-bold tracking-tight leading-none text-green-500">
                          <?php 
                          $expenditureTotal = number_format((float)$expenditureTotal, 2, '.', '');
                          echo preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $expenditureTotal);
                          ?>
                          </div>
                          <div class="text-lg font-medium text-green-600 dark:text-green-500">Savings</div>
                        </div>
                        </a>
                      </div>

                      


                      <div class="flex flex-col flex-auto p-6 bg-card shadow rounded-2xl overflow-hidden">
                      <a href="<?= Url::toRoute('expense/index')?>">
                        <div class="flex items-start justify-between">
                          <div class="text-lg font-medium tracking-tight leading-6 truncate">Total Expenses</div>                          
                        </div>
                        <div class="flex flex-col items-center mt-2">
                          <div class="text-6xl sm:text-6xl font-bold tracking-tight leading-none text-red-500">
                            <?php 
                            $expenseTotal = number_format((float)$expenseTotal, 2, '.', '');
                            echo preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $expenseTotal);
                            ?></div>
                          <div class="text-lg font-medium">Rs.<?php echo round($expenseTotal / 30, 2)?> / Day</div>
                        </div>
                        </a>
                      </div>

                     

                      <div class="sm:col-span-2 md:col-span-4 flex flex-col flex-auto p-6 bg-card shadow rounded-2xl overflow-hidden">
                        <div class="flex flex-col sm:flex-row items-start justify-between">
                            <div class="text-lg font-medium tracking-tight leading-6 truncate">Day Wise Expense Chart (Rs. <span id="total-amount"></span>)</div>
                          <div class="mt-3 sm:mt-0 sm:ml-2">
                            <mat-button-toggle-group role="group" value="this-week" class="mat-button-toggle-group mat-button-toggle-group-appearance-standard" ng-reflect-value="this-week" aria-disabled="false">


                              <mat-button-toggle role="year-chart" value="year" class="mat-button-toggle mat-button-toggle-appearance-standard" ng-reflect-value="this-week"  id="year-chart" >
                                <button type="button" class="mat-button-toggle-button mat-focus-indicator"tabindex="0" aria-pressed="true" name="mat-button-toggle-group-21">
                                  <span class="mat-button-toggle-label-content">Year</span>
                                </button>
                                <span class="mat-button-toggle-focus-overlay"></span>
                                <span  class="mat-ripple mat-button-toggle-ripple" ng-reflect-trigger="[object HTMLButtonElement]" ng-reflect-disabled="false"></span>
                              </mat-button-toggle>


                              <mat-button-toggle role="month-chart" value="month" class="mat-button-toggle mat-button-toggle-appearance-standard" ng-reflect-value="last-week" id="month-chart">
                                <button type="button" class="mat-button-toggle-button mat-focus-indicator" id="mat-button-toggle-24-button" tabindex="0" aria-pressed="false" name="mat-button-toggle-group-21">
                                  <span class="mat-button-toggle-label-content">Month</span>
                                </button>
                                <span class="mat-button-toggle-focus-overlay"></span>
                                <span  class="mat-ripple mat-button-toggle-ripple" ng-reflect-trigger="[object HTMLButtonElement]" ng-reflect-disabled="false"></span>
                              </mat-button-toggle>

                              <!--  -->
                              <mat-button-toggle role="week-chart" value="week" class="mat-button-toggle  mat-button-toggle-appearance-standard mat-button-toggle-checked" ng-reflect-value="this-week" id="week-chart">
                                <button type="button" class="mat-button-toggle-button mat-focus-indicator" id="mat-button-toggle-25-button" tabindex="0" aria-pressed="true" name="mat-button-toggle-group-21">
                                  <span class="mat-button-toggle-label-content">Week</span>
                                </button>
                                <span class="mat-button-toggle-focus-overlay"></span>
                                <span  class="mat-ripple mat-button-toggle-ripple" ng-reflect-trigger="[object HTMLButtonElement]" ng-reflect-disabled="false"></span>
                              </mat-button-toggle>


                              


                            </mat-button-toggle-group>
                          </div>
                        </div>
                        <!-- lg:grid-cols-2 -->
                        <div class="grid grid-cols-1  grid-flow-row gap-6 w-full mt-8 sm:mt-4">
                          <div class="flex flex-col flex-auto">
                            <!-- <div class="font-medium text-secondary"></div> -->
                            <div class="flex flex-col flex-auto">
                            <div id="daily_expenses_bar_chart" style="width: 98%; height: 350px"></div>
                            </div>
                          </div>
                          
                        </div>
                      </div>

                      <div class="sm:col-span-2 md:col-span-4 flex flex-col flex-auto p-6 bg-card shadow rounded-2xl overflow-hidden">
                        <div class="flex flex-col sm:flex-row items-start justify-between">
                          <div class="text-lg font-medium tracking-tight leading-6 truncate">Category Expenses</div>
                          
                        </div>
                        <div class="grid grid-cols-1 lg:grid-cols-2 grid-flow-row gap-6 w-full mt-8 sm:mt-4">
                          <div class="flex flex-col flex-auto">
                            <div class="font-medium text-secondary">Categories Chart</div>
                            <div class="flex flex-col flex-auto">
                                <div id="piechart_3d" style="width: 100%; height: 350px;"></div>    
                            </div>
                          </div>
                          <div class="flex flex-col">
                            <div class="font-medium text-secondary">Montly Category Expenses</div>
                            <div class="flex flex-col flex-auto">
                                <div id="montly_category_expenses" style="width: 100%; height: 350px;"></div>    
                            </div>
                          </div>
                        </div>
                      </div>

                      


                      <div class="sm:col-span-2 md:col-span-4 lg:col-span-2 flex flex-col flex-auto p-6 bg-card shadow rounded-2xl overflow-hidden">
                        <div class="flex flex-col sm:flex-row items-start justify-between">
                          <div class="text-lg font-medium tracking-tight leading-6 truncate">Monthly Budget Tracker</div>
                          <div class="mt-3 sm:mt-0 sm:ml-2">
                            <!-- <mat-button-toggle-group role="group" value="this-week" class="mat-button-toggle-group mat-button-toggle-group-appearance-standard" ng-reflect-value="this-week" aria-disabled="false">
                              <mat-button-toggle role="presentation" value="last-week" class="mat-button-toggle mat-button-toggle-appearance-standard" ng-reflect-value="last-week" id="mat-button-toggle-26">
                                <button type="button" class="mat-button-toggle-button mat-focus-indicator" id="mat-button-toggle-26-button" tabindex="0" aria-pressed="false" name="mat-button-toggle-group-22">
                                  <span class="mat-button-toggle-label-content">Last Week</span>
                                </button>
                                <span class="mat-button-toggle-focus-overlay"></span>
                                <span  class="mat-ripple mat-button-toggle-ripple" ng-reflect-trigger="[object HTMLButtonElement]" ng-reflect-disabled="false"></span>
                              </mat-button-toggle>
                              <mat-button-toggle role="presentation" value="this-week" class="mat-button-toggle mat-button-toggle-checked mat-button-toggle-appearance-standard" ng-reflect-value="this-week" id="mat-button-toggle-27">
                                <button type="button" class="mat-button-toggle-button mat-focus-indicator" id="mat-button-toggle-27-button" tabindex="0" aria-pressed="true" name="mat-button-toggle-group-22">
                                  <span class="mat-button-toggle-label-content">This Week</span>
                                </button>
                                <span class="mat-button-toggle-focus-overlay"></span>
                                <span  class="mat-ripple mat-button-toggle-ripple" ng-reflect-trigger="[object HTMLButtonElement]" ng-reflect-disabled="false"></span>
                              </mat-button-toggle>
                            </mat-button-toggle-group> -->
                          </div>
                        </div>
                        <div class="flex flex-col flex-auto mt-6">
                            <div id="monthly-budget-tracker" style="width: 98%; height: 350px"></div>
                        </div>

                        <!-- <div class="grid grid-cols-2 border-t divide-x -m-6 mt-4 bg-gray-50 dark:bg-transparent">
                          <div class="flex flex-col items-center justify-center p-6 sm:p-8">
                            <div class="text-5xl font-semibold leading-none tracking-tighter"> 594 </div>
                            <div class="mt-1 text-center text-secondary">New tasks</div>
                          </div>
                          <div class="flex flex-col items-center justify-center p-6 sm:p-8">
                            <div class="text-5xl font-semibold leading-none tracking-tighter"> 287 </div>
                            <div class="mt-1 text-center text-secondary">Completed tasks</div>
                          </div>
                        </div> -->

                      </div> 


                       <!-- <div class="sm:col-span-2 md:col-span-4 lg:col-span-2 flex flex-col flex-auto p-6 bg-card shadow rounded-2xl overflow-hidden">
                        <div class="flex flex-col sm:flex-row items-start justify-between">
                          <div class="text-lg font-medium tracking-tight leading-6 truncate">Schedule</div>
                          <div class="mt-3 sm:mt-0 sm:ml-2">
                            <mat-button-toggle-group role="group" value="today" class="mat-button-toggle-group mat-button-toggle-group-appearance-standard" ng-reflect-value="today" aria-disabled="false">
                              <mat-button-toggle role="presentation" value="today" class="mat-button-toggle mat-button-toggle-checked mat-button-toggle-appearance-standard" ng-reflect-value="today" id="mat-button-toggle-28">
                                <button type="button" class="mat-button-toggle-button mat-focus-indicator" id="mat-button-toggle-28-button" tabindex="0" aria-pressed="true" name="mat-button-toggle-group-23">
                                  <span class="mat-button-toggle-label-content">Today</span>
                                </button>
                                <span class="mat-button-toggle-focus-overlay"></span>
                                <span  class="mat-ripple mat-button-toggle-ripple" ng-reflect-trigger="[object HTMLButtonElement]" ng-reflect-disabled="false"></span>
                              </mat-button-toggle>
                              <mat-button-toggle role="presentation" value="tomorrow" class="mat-button-toggle mat-button-toggle-appearance-standard" ng-reflect-value="tomorrow" id="mat-button-toggle-29">
                                <button type="button" class="mat-button-toggle-button mat-focus-indicator" id="mat-button-toggle-29-button" tabindex="0" aria-pressed="false" name="mat-button-toggle-group-23">
                                  <span class="mat-button-toggle-label-content">Tomorrow</span>
                                </button>
                                <span class="mat-button-toggle-focus-overlay"></span>
                                <span  class="mat-ripple mat-button-toggle-ripple" ng-reflect-trigger="[object HTMLButtonElement]" ng-reflect-disabled="false"></span>
                              </mat-button-toggle>
                            </mat-button-toggle-group>
                          </div>
                        </div>
                        <div class="flex flex-col mt-2 divide-y">
                          <div class="flex flex-row items-center justify-between py-4 px-0.5 ng-star-inserted">
                            <div class="flex flex-col">
                              <div class="font-medium">Group Meeting</div>
                              <div class="flex flex-col sm:flex-row sm:items-center -ml-0.5 mt-2 sm:mt-1 space-y-1 sm:space-y-0 sm:space-x-3">
                                <div class="flex items-center ng-star-inserted">
                                  <mat-icon role="img" class="mat-icon notranslate icon-size-5 text-hint mat-icon-no-color" aria-hidden="true" ng-reflect-svg-icon="heroicons_solid:clock" data-mat-icon-type="svg" data-mat-icon-name="clock" data-mat-icon-namespace="heroicons_solid">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" fit="" height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
                                      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                    </svg>
                                  </mat-icon>
                                  <div class="ml-1.5 text-md text-secondary">in 32 minutes</div>
                                </div>
                                <div class="flex items-center ng-star-inserted">
                                  <mat-icon role="img" class="mat-icon notranslate icon-size-5 text-hint mat-icon-no-color" aria-hidden="true" ng-reflect-svg-icon="heroicons_solid:location-marke" data-mat-icon-type="svg" data-mat-icon-name="location-marker" data-mat-icon-namespace="heroicons_solid">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" fit="" height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
                                      <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                    </svg>
                                  </mat-icon>
                                  <div class="ml-1.5 text-md text-secondary">Conference room 1B</div>
                                </div>
                              </div>
                            </div>
                            <button mat-icon-button="" class="mat-focus-indicator mat-icon-button mat-button-base">
                              <span class="mat-button-wrapper">
                                <mat-icon role="img" class="mat-icon notranslate mat-icon-no-color" aria-hidden="true" ng-reflect-svg-icon="heroicons_solid:chevron-right" data-mat-icon-type="svg" data-mat-icon-name="chevron-right" data-mat-icon-namespace="heroicons_solid">
                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" fit="" height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                  </svg>
                                </mat-icon>
                              </span>
                              <span  class="mat-ripple mat-button-ripple mat-button-ripple-round" ng-reflect-disabled="false" ng-reflect-centered="true" ng-reflect-trigger="[object HTMLButtonElement]"></span>
                              <span class="mat-button-focus-overlay"></span>
                            </button>
                          </div>
                          <div class="flex flex-row items-center justify-between py-4 px-0.5 ng-star-inserted">
                            <div class="flex flex-col">
                              <div class="font-medium">Coffee Break</div>
                              <div class="flex flex-col sm:flex-row sm:items-center -ml-0.5 mt-2 sm:mt-1 space-y-1 sm:space-y-0 sm:space-x-3">
                                <div class="flex items-center ng-star-inserted">
                                  <mat-icon role="img" class="mat-icon notranslate icon-size-5 text-hint mat-icon-no-color" aria-hidden="true" ng-reflect-svg-icon="heroicons_solid:clock" data-mat-icon-type="svg" data-mat-icon-name="clock" data-mat-icon-namespace="heroicons_solid">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" fit="" height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
                                      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                    </svg>
                                  </mat-icon>
                                  <div class="ml-1.5 text-md text-secondary">10:30 AM</div>
                                </div>
                              </div>
                            </div>
                            <button mat-icon-button="" class="mat-focus-indicator mat-icon-button mat-button-base">
                              <span class="mat-button-wrapper">
                                <mat-icon role="img" class="mat-icon notranslate mat-icon-no-color" aria-hidden="true" ng-reflect-svg-icon="heroicons_solid:chevron-right" data-mat-icon-type="svg" data-mat-icon-name="chevron-right" data-mat-icon-namespace="heroicons_solid">
                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" fit="" height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                  </svg>
                                </mat-icon>
                              </span>
                              <span  class="mat-ripple mat-button-ripple mat-button-ripple-round" ng-reflect-disabled="false" ng-reflect-centered="true" ng-reflect-trigger="[object HTMLButtonElement]"></span>
                              <span class="mat-button-focus-overlay"></span>
                            </button>
                          </div>
                          <div class="flex flex-row items-center justify-between py-4 px-0.5 ng-star-inserted">
                            <div class="flex flex-col">
                              <div class="font-medium">Public Beta Release</div>
                              <div class="flex flex-col sm:flex-row sm:items-center -ml-0.5 mt-2 sm:mt-1 space-y-1 sm:space-y-0 sm:space-x-3">
                                <div class="flex items-center ng-star-inserted">
                                  <mat-icon role="img" class="mat-icon notranslate icon-size-5 text-hint mat-icon-no-color" aria-hidden="true" ng-reflect-svg-icon="heroicons_solid:clock" data-mat-icon-type="svg" data-mat-icon-name="clock" data-mat-icon-namespace="heroicons_solid">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" fit="" height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
                                      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                    </svg>
                                  </mat-icon>
                                  <div class="ml-1.5 text-md text-secondary">11:00 AM</div>
                                </div>
                              </div>
                            </div>
                            <button mat-icon-button="" class="mat-focus-indicator mat-icon-button mat-button-base">
                              <span class="mat-button-wrapper">
                                <mat-icon role="img" class="mat-icon notranslate mat-icon-no-color" aria-hidden="true" ng-reflect-svg-icon="heroicons_solid:chevron-right" data-mat-icon-type="svg" data-mat-icon-name="chevron-right" data-mat-icon-namespace="heroicons_solid">
                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" fit="" height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                  </svg>
                                </mat-icon>
                              </span>
                              <span  class="mat-ripple mat-button-ripple mat-button-ripple-round" ng-reflect-disabled="false" ng-reflect-centered="true" ng-reflect-trigger="[object HTMLButtonElement]"></span>
                              <span class="mat-button-focus-overlay"></span>
                            </button>
                          </div>
                          <div class="flex flex-row items-center justify-between py-4 px-0.5 ng-star-inserted">
                            <div class="flex flex-col">
                              <div class="font-medium">Lunch</div>
                              <div class="flex flex-col sm:flex-row sm:items-center -ml-0.5 mt-2 sm:mt-1 space-y-1 sm:space-y-0 sm:space-x-3">
                                <div class="flex items-center ng-star-inserted">
                                  <mat-icon role="img" class="mat-icon notranslate icon-size-5 text-hint mat-icon-no-color" aria-hidden="true" ng-reflect-svg-icon="heroicons_solid:clock" data-mat-icon-type="svg" data-mat-icon-name="clock" data-mat-icon-namespace="heroicons_solid">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" fit="" height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
                                      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                    </svg>
                                  </mat-icon>
                                  <div class="ml-1.5 text-md text-secondary">12:10 PM</div>
                                </div>
                              </div>
                            </div>
                            <button mat-icon-button="" class="mat-focus-indicator mat-icon-button mat-button-base">
                              <span class="mat-button-wrapper">
                                <mat-icon role="img" class="mat-icon notranslate mat-icon-no-color" aria-hidden="true" ng-reflect-svg-icon="heroicons_solid:chevron-right" data-mat-icon-type="svg" data-mat-icon-name="chevron-right" data-mat-icon-namespace="heroicons_solid">
                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" fit="" height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                  </svg>
                                </mat-icon>
                              </span>
                              <span  class="mat-ripple mat-button-ripple mat-button-ripple-round" ng-reflect-disabled="false" ng-reflect-centered="true" ng-reflect-trigger="[object HTMLButtonElement]"></span>
                              <span class="mat-button-focus-overlay"></span>
                            </button>
                          </div>
                          <div class="flex flex-row items-center justify-between py-4 px-0.5 ng-star-inserted">
                            <div class="flex flex-col">
                              <div class="font-medium">Dinner with David</div>
                              <div class="flex flex-col sm:flex-row sm:items-center -ml-0.5 mt-2 sm:mt-1 space-y-1 sm:space-y-0 sm:space-x-3">
                                <div class="flex items-center ng-star-inserted">
                                  <mat-icon role="img" class="mat-icon notranslate icon-size-5 text-hint mat-icon-no-color" aria-hidden="true" ng-reflect-svg-icon="heroicons_solid:clock" data-mat-icon-type="svg" data-mat-icon-name="clock" data-mat-icon-namespace="heroicons_solid">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" fit="" height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
                                      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                    </svg>
                                  </mat-icon>
                                  <div class="ml-1.5 text-md text-secondary">05:30 PM</div>
                                </div>
                                <div class="flex items-center ng-star-inserted">
                                  <mat-icon role="img" class="mat-icon notranslate icon-size-5 text-hint mat-icon-no-color" aria-hidden="true" ng-reflect-svg-icon="heroicons_solid:location-marke" data-mat-icon-type="svg" data-mat-icon-name="location-marker" data-mat-icon-namespace="heroicons_solid">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" fit="" height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
                                      <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                    </svg>
                                  </mat-icon>
                                  <div class="ml-1.5 text-md text-secondary">Magnolia</div>
                                </div>
                              </div>
                            </div>
                            <button mat-icon-button="" class="mat-focus-indicator mat-icon-button mat-button-base">
                              <span class="mat-button-wrapper">
                                <mat-icon role="img" class="mat-icon notranslate mat-icon-no-color" aria-hidden="true" ng-reflect-svg-icon="heroicons_solid:chevron-right" data-mat-icon-type="svg" data-mat-icon-name="chevron-right" data-mat-icon-namespace="heroicons_solid">
                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" fit="" height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                  </svg>
                                </mat-icon>
                              </span>
                              <span  class="mat-ripple mat-button-ripple mat-button-ripple-round" ng-reflect-disabled="false" ng-reflect-centered="true" ng-reflect-trigger="[object HTMLButtonElement]"></span>
                              <span class="mat-button-focus-overlay"></span>
                            </button>
                          </div>
                          <div class="flex flex-row items-center justify-between py-4 px-0.5 ng-star-inserted">
                            <div class="flex flex-col">
                              <div class="font-medium">Jane's Birthday Party</div>
                              <div class="flex flex-col sm:flex-row sm:items-center -ml-0.5 mt-2 sm:mt-1 space-y-1 sm:space-y-0 sm:space-x-3">
                                <div class="flex items-center ng-star-inserted">
                                  <mat-icon role="img" class="mat-icon notranslate icon-size-5 text-hint mat-icon-no-color" aria-hidden="true" ng-reflect-svg-icon="heroicons_solid:clock" data-mat-icon-type="svg" data-mat-icon-name="clock" data-mat-icon-namespace="heroicons_solid">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" fit="" height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
                                      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                    </svg>
                                  </mat-icon>
                                  <div class="ml-1.5 text-md text-secondary">07:30 PM</div>
                                </div>
                                <div class="flex items-center ng-star-inserted">
                                  <mat-icon role="img" class="mat-icon notranslate icon-size-5 text-hint mat-icon-no-color" aria-hidden="true" ng-reflect-svg-icon="heroicons_solid:location-marke" data-mat-icon-type="svg" data-mat-icon-name="location-marker" data-mat-icon-namespace="heroicons_solid">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" fit="" height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
                                      <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                    </svg>
                                  </mat-icon>
                                  <div class="ml-1.5 text-md text-secondary">Home</div>
                                </div>
                              </div>
                            </div>
                            <button mat-icon-button="" class="mat-focus-indicator mat-icon-button mat-button-base">
                              <span class="mat-button-wrapper">
                                <mat-icon role="img" class="mat-icon notranslate mat-icon-no-color" aria-hidden="true" ng-reflect-svg-icon="heroicons_solid:chevron-right" data-mat-icon-type="svg" data-mat-icon-name="chevron-right" data-mat-icon-namespace="heroicons_solid">
                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" fit="" height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                  </svg>
                                </mat-icon>
                              </span>
                              <span  class="mat-ripple mat-button-ripple mat-button-ripple-round" ng-reflect-disabled="false" ng-reflect-centered="true" ng-reflect-trigger="[object HTMLButtonElement]"></span>
                              <span class="mat-button-focus-overlay"></span>
                            </button>
                          </div>
                          <div class="flex flex-row items-center justify-between py-4 px-0.5 ng-star-inserted">
                            <div class="flex flex-col">
                              <div class="font-medium">Overseer's Retirement Party</div>
                              <div class="flex flex-col sm:flex-row sm:items-center -ml-0.5 mt-2 sm:mt-1 space-y-1 sm:space-y-0 sm:space-x-3">
                                <div class="flex items-center ng-star-inserted">
                                  <mat-icon role="img" class="mat-icon notranslate icon-size-5 text-hint mat-icon-no-color" aria-hidden="true" ng-reflect-svg-icon="heroicons_solid:clock" data-mat-icon-type="svg" data-mat-icon-name="clock" data-mat-icon-namespace="heroicons_solid">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" fit="" height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
                                      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                    </svg>
                                  </mat-icon>
                                  <div class="ml-1.5 text-md text-secondary">09:30 PM</div>
                                </div>
                                <div class="flex items-center ng-star-inserted">
                                  <mat-icon role="img" class="mat-icon notranslate icon-size-5 text-hint mat-icon-no-color" aria-hidden="true" ng-reflect-svg-icon="heroicons_solid:location-marke" data-mat-icon-type="svg" data-mat-icon-name="location-marker" data-mat-icon-namespace="heroicons_solid">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" fit="" height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
                                      <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                    </svg>
                                  </mat-icon>
                                  <div class="ml-1.5 text-md text-secondary">Overseer's room</div>
                                </div>
                              </div>
                            </div>
                            <button mat-icon-button="" class="mat-focus-indicator mat-icon-button mat-button-base">
                              <span class="mat-button-wrapper">
                                <mat-icon role="img" class="mat-icon notranslate mat-icon-no-color" aria-hidden="true" ng-reflect-svg-icon="heroicons_solid:chevron-right" data-mat-icon-type="svg" data-mat-icon-name="chevron-right" data-mat-icon-namespace="heroicons_solid">
                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" fit="" height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                  </svg>
                                </mat-icon>
                              </span>
                              <span  class="mat-ripple mat-button-ripple mat-button-ripple-round" ng-reflect-disabled="false" ng-reflect-centered="true" ng-reflect-trigger="[object HTMLButtonElement]"></span>
                              <span class="mat-button-focus-overlay"></span>
                            </button>
                          </div>
                        </div> -->
                      </div>
                    </div>
                  </div>
                </mat-tab-body>
              </div>
            </mat-tab-group>
          </div>
        </div>
      </div>
    </project>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  setTimeout(() => {
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
      var data = google.visualization.arrayToDataTable([
          ['Category', 'Amount'],
          <?php 
          foreach ($categories as $cat) {
          echo "['".$cat['category_name']."', ". $cat['total'] . "],";
          } ?>
      ]);

      var options = {
          chart: {
          // title: 'Expenses',
          // subtitle: 'Sales, Expenses, and Profit: 2014-2017',
          },legend: {position: 'none'}
      };

      var chart = new google.charts.Bar(document.getElementById('montly_category_expenses'));

      chart.draw(data, google.charts.Bar.convertOptions(options));
      }
  }, 1000);
</script>

<script type="text/javascript">
  setTimeout(() => {
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
    var data = google.visualization.arrayToDataTable([
        ['Category', 'Amount'],
        <?php 
        foreach ($categories as $cat) {
        echo "['".$cat['category_name']."', ". $cat['total'] . "],";
        } ?>
    ]);

    var options = {
        // title: 'Expenses',
        is3D: true,
        legend: {position: 'none'}
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
    chart.draw(data, options);
    }
  }, 2000);

</script>

<script type="text/javascript">
  google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Remaining',     <?php echo  $remaining ?>],
          // ['Income',      <?php echo  $incomeTotal ?>],
          ['Savings',  <?php echo  $expenditureTotal ?>],
          ['Expenses', <?php echo  $expenseTotal ?>]
        ]);

        var options = {
          // title: 'My Daily Activities',
          pieHole: 0.4,
          legend: {position: 'none'}
        };

        var chart = new google.visualization.PieChart(document.getElementById('monthly-budget-tracker'));
        chart.draw(data, options);
      }
  </script>






<script>
    
    $( document ).ready(function() {

         
        
        showChart('week');
        /** Menu Toggle */
        $("#year-chart").click(function(){   showChart('year'); });
        $("#month-chart").click(function(){   showChart('month'); });
        $("#week-chart").click(function(){   showChart('week'); });
        


        function showChart(flag){
          $("#year-chart").removeClass("mat-button-toggle-checked");
           $("#month-chart").removeClass("mat-button-toggle-checked");
           $("#week-chart").removeClass("mat-button-toggle-checked");

           $("#"+flag+"-chart").addClass("mat-button-toggle-checked");

            google.charts.load('current', {'packages':['bar']});
            google.charts.setOnLoadCallback(drawDailyExpensesBarChart);

            function drawDailyExpensesBarChart() {

            var data ;
              if(flag == 'year'){

                data =  google.visualization.arrayToDataTable([
                  ['Date', 'Amount'],
                  <?php 
                      $totalYearAmount = 0;
                      foreach ($yearWiseExpenses as $expense) {
                      echo "['".$expense['date_of_transaction']."', ". $expense['amount'] . "],";
                      $totalYearAmount = $totalYearAmount + $expense['amount'];
                  } ?>   
                ]);

                
                

                $("#total-amount").text("<?php echo preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $totalYearAmount); ?>");

              }else if(flag == 'month'){
                data =  google.visualization.arrayToDataTable([
                  ['Date', 'Amount'],
                  <?php 
                      $totalMonthAmount = 0;
                      foreach ($monthWiseExpenses as $expense) {
                      echo "['".$expense['date_of_transaction']."', ". $expense['amount'] . "],";
                      $totalMonthAmount = $totalMonthAmount + $expense['amount'];
                  } ?>
                ]);
                $("#total-amount").text("<?php echo  preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $totalMonthAmount);  ?>");
              }else{
                data =  google.visualization.arrayToDataTable([
                  ['Date', 'Amount'],
                  <?php 
                      $totalWeekAmount = 0;
                      foreach ($weekWiseExpenses as $expense) {
                      echo "['".$expense['date_of_transaction']."', ". $expense['amount'] . "],";
                      $totalWeekAmount = $totalWeekAmount + $expense['amount'];
                  } ?>
                ]);
                $("#total-amount").text("<?php echo preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $totalWeekAmount); ?>");
              }

            

            var options = {
                chart: {
                // title: 'Expenses',
                // subtitle: 'Sales, Expenses, and Profit: 2014-2017',
                },legend: {position: 'none'}
            };

            var chart = new google.charts.Bar(document.getElementById('daily_expenses_bar_chart'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
            }

    }
    });


    

</script>