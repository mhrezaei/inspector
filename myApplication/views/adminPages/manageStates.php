<title><?php echo $siteTitle; ?> | مدیریت استان ها و شهرستان ها</title>
<style type="text/css">
#states th, #states td{
    text-align: right;
}
</style>
<div class="panel panel-success panelContent" id="loginInfo">
      <div class="panel-heading" style="padding-left: 0px;">
        <h3 class="panel-title panelTitleText">مدیریت استان ها و شهرستان ها</h3>
        <div class="glyphicon glyphicon-remove panelInfoBTN" id="loginInfoRemove" onclick="showPanel('loginInfo', 'r')"></div>
        <div class="glyphicon glyphicon-minus panelInfoBTN" id="loginInfoMinus" onclick="showPanel('loginInfo', 'm')"></div>
        <div class="glyphicon glyphicon-plus panelInfoBTN" style="display: none;" id="loginInfoPlus" onclick="showPanel('loginInfo', 'p')"></div>
        <div class="clearB"></div>
      </div>
      <div class="panel-body panelBodyText" id="loginInfoBody" style="width: 60%; text-align: right; margin: 0 auto;">
            <div style="width: 100%; height: auto; direction: rtl; margin: 0 auto;">
                
                
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                
                <!-- add state panel -->
                <div class="panel panel-success" data-toggle="modal" data-target="#addStateModal" onclick="addState(0)">
                    <div style="cursor: pointer;" class="panel-heading collapsed">
                      <span style="color: green; cursor: pointer; float: right; padding-left: 5px;" class="glyphicon glyphicon-plus"></span>
                      <h4 style="width: 50%; float: right;" class="panel-title">
                        <a class="collapsed">
                           افزودن استان جدید
                        </a>
                      </h4>
                      <div class="clearB"></div>
                    </div>
                    
                  </div>
                  <!-- add state panel -->
                          
                          
                          <?php if(is_array($states) && count($states) > 0)
                                {
                                    for($i = 0, $a = 1; $i < count($states); $i++)
                                    {
                                        
                          ?>
                          <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="heading<?php echo $a; ?>"  data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $a; ?>" aria-expanded="false" aria-controls="collapse<?php echo $a; ?>" style="cursor: pointer;">
                              <h4 class="panel-title" style="width: 50%; float: right;">
                                <a class="collapsed">
                                  <?php echo $a; ?> - <span id="cityName<?php echo $states[$i]['id']; ?>"><?php echo $states[$i]['name']; ?></span> <span class="text-info">(تعداد کل بیمارستان ها: <?php echo $states[$i]['hos']; ?><span id="numOfCityForState<?php echo $states[$i]['id']; ?>" style="display: none;"><?php echo count($states[$i]['city']); ?></span>)</span>
                                </a>
                              </h4>
                              <div class="glyphicon glyphicon-remove" style="color: red; cursor: pointer; float: left;" rel="tooltip" data-placement="top" title="حذف کردن استان" data-toggle="modal" data-target="#deleteStateModal" onclick="deleteStateOrCity('<?php echo $states[$i]['id']; ?>');"></div>
                              
                              <div class="glyphicon glyphicon-pencil" style="color: black; cursor: pointer; float: left; padding-left: 10px;" rel="tooltip" data-placement="top" title="ویرایش استان" data-toggle="modal" data-target="#editStateModal" onclick="editOneState('<?php echo $states[$i]['id']; ?>');"></div>
                              
                              <div class="glyphicon glyphicon-plus" style="color: green; cursor: pointer; float: left; padding-left: 10px;" rel="tooltip" data-placement="top" title="افزودن شهر" data-toggle="modal" data-target="#addStateModal" onclick="addState('<?php echo $states[$i]['id']; ?>');"></div>
                              <div class="clearB"></div>
                            </div>
                            <div id="collapse<?php echo $a; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $a; ?>">
                              <div class="panel-body">
                                    <?php
                                        if(is_array($states[$i]['city']) && count($states[$i]['city']) > 0)
                                        {
                                            
                                    ?>
                                    <table class="table table-hover table-striped" style="direction: rtl;" id="states">
                                      <thead style="direction: rtl; text-align: right;">
                                        <tr>
                                          <th style="width: 10%;">ردیف</th>
                                          <th style="width: 40%;">شهر</th>
                                          <th style="width: 30%; text-align: center;">تعداد بیمارستان ها</th>
                                          <th style="width: 20%; text-align: center;">امکانات</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                    <?php
                                            for($j = 0, $n = 1; $j < count($states[$i]['city']); $j++)
                                            {
                                                
                                    ?>
                                        <tr>
                                          <td style="width: 10%;"><?php echo $n; ?></td>
                                          <td style="width: 40%;" id="cityName<?php echo $states[$i]['city'][$j]['id']; ?>"><?php echo $states[$i]['city'][$j]['name']; ?></td>
                                          <td style="width: 30%; text-align: center;" id="numOfHosForCity<?php echo $states[$i]['city'][$j]['id']; ?>"><?php echo $states[$i]['city'][$j]['num']; ?></td>
                                          <td style="width: 20%; text-align: center;">
                                            <div class="glyphicon glyphicon-pencil" style="color: black; cursor: pointer;" data-toggle="modal" data-target="#editStateModal" onclick="editOneState('<?php echo $states[$i]['city'][$j]['id']; ?>');"></div>
                                            <div class="glyphicon glyphicon-remove" style="color: red; cursor: pointer;" data-toggle="modal" data-target="#deleteStateModal" onclick="deleteStateOrCity('<?php echo $states[$i]['city'][$j]['id']; ?>');"></div>
                                          </td>
                                        </tr>
                                    <?php
                                                $n++;
                                            }
                                     ?>
                                      </tbody>
                                    </table>
                                    <?php
                                        }
                                        else
                                        {
                                            echo 'برای این استان شهری ثبت نشده است.';
                                        }
                                     ?>
                              </div>
                            </div>
                          </div>
                          
                          <?php
                                        $a++;
                                    }
                                }
                                else
                                {
                                    echo 'تا کنون استانی ثبت نشده است.';
                                }
                          ?>
  
  
  
                </div>
                
                
                
            </div>
      </div>
</div>


<!-- edit state Modal -->
<div class="modal fade" id="editStateModal" tabindex="-1" role="dialog" aria-labelledby="editStateModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" style="float: left;"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="editStateModalabel" style="font-family: 'BYekan';">ویرایش شهر ها و استان ها</h4>
      </div>
      <div class="modal-body" id="modalBodyData">
            
            <div id="editStatesForm">
                <form class="form-horizontal" role="form" onsubmit="return false;">
                  <div class="form-group">
                    <label for="inputStateName" class="col-sm-3 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">نام استان / شهر:</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="inputStateName" style="font-family: 'BYekan';" value="" placeholder="نام استان / شهر">
                    </div>
                  </div>
                </form>
            </div>
            
            <div class="progress" id="modalLoading" style="display: none;">
                  <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%; float: right;">
                    <span class="sr-only">70% Complete</span>
                  </div>
            </div>
            
            
            <div role="alert" class="alert alert-success" style="padding: 10px; width: 50%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="successAlert">تغییرات با موفقیت ذخیره گردید.</div>
            
            
            <div role="alert" class="alert alert-danger" style="padding: 10px; width: 50%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="dangerAlert">خطایی در ثبت اطلاعات رخ داده است، دوباره امتحان کنید.</div>
            
            <div role="alert" class="alert alert-danger" style="padding: 10px; width: 50%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="dangerAlertTwo">نام شهر / استان نمی تواند خالی باشد.</div>
            
            
             
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" style="float: left; font-family: 'BYekan';" id="saveBTN">ذخیره تغییرات</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" style="float: left; font-family: 'BYekan';">انصراف</button>
      </div>
    </div>
  </div>
</div>
<!-- edit state Modal -->

<!-- add state Modal -->
<div class="modal fade" id="addStateModal" tabindex="-1" role="dialog" aria-labelledby="addStateModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" style="float: left;"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="addStateModallabel" style="font-family: 'BYekan';">افزودن استان جدید</h4>
      </div>
      <div class="modal-body" id="addStateModalBodyData">
            
            <div id="addStateModalForm">
                <form class="form-horizontal" role="form" onsubmit="return false;">
                  <div class="form-group" id="addStaticCity" style="display: none;">
                    <label for="inputStateNameStatic" class="col-sm-3 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">نام استان:</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="inputStateNameStatic" style="font-family: 'BYekan';" value="تهران" readonly="readonly">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="inputNewStateName" class="col-sm-3 control-label" style="float: right; font-family: 'BYekan'; font-weight: normal;">نام:</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="inputNewStateName" style="font-family: 'BYekan';" value="" placeholder="نام">
                    </div>
                  </div>
                </form>
            </div>
            
            <div class="progress" id="addStateModalLoading" style="display: none;">
                  <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%; float: right;">
                    <span class="sr-only">70% Complete</span>
                  </div>
            </div>
            
            
            <div role="alert" class="alert alert-success" style="padding: 10px; width: 50%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="addSuccessAlert">اطلاعات مورد نظر با موفقیت ذخیره گردید.</div>
            
            
            <div role="alert" class="alert alert-danger" style="padding: 10px; width: 50%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="addDangerAlert">خطایی در ثبت اطلاعات رخ داده است، دوباره سعی نمائید.</div>
            
            
             
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" style="float: left; font-family: 'BYekan';" id="addSaveBTN">افزودن</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" style="float: left; font-family: 'BYekan';">انصراف</button>
      </div>
    </div>
  </div>
</div>
<!-- add state Modal -->

<!-- delete state or city -->
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="deleteStateModal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" style="float: left;"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h5 class="modal-title" id="deleteStateModallabel" style="font-family: 'webYekan'; font-weight: normal;">حذف کردن استان / شهر</h5>
      </div>
      <div class="modal-body">
        
        <div style="width: 90%; margin: 0 auto; text-align: justify; font-family: 'BNazanin', Tahoma; font-size: 16px;" id="deleteStateModalActiveQuestion"></div>
        
        <div class="progress" id="deleteStateModalLoading" style="display: none;">
            <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%; float: right;">
                <span class="sr-only">70% Complete</span>
            </div>
        </div>
        
        <div role="alert" class="alert alert-danger" style="padding: 10px; width: 100%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="deleteStateModalDanger1">خطایی در حذف استان / شهر رخ داده است.</div>
        
        <div role="alert" class="alert alert-success" style="padding: 10px; width: 100%; margin: 0 auto; font-family: 'BNazanin'; font-weight: normal; text-align: center; display: none;" id="deleteStateModalDanger3">استان / شهر با موفقیت حذف گردید.</div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" style="float: left; font-family: 'BYekan'; font-weight: normal;" id="deleteStateModalBTN">حذف کردن</button>
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" style="float: left; font-family: 'BYekan'; font-weight: normal;">انصراف</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- delete state or city -->