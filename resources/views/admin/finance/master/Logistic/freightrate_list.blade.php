@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')



@include('admin.include.navbar')



@include('admin.include.sidebar')



<style type="text/css">

  .PageTitle{

    margin-right: 1px !important;

  }

 .required-field::before {

    content: "*";

    color: red;

  }

  .Custom-Box {

    /*border: 1px solid #e0dcdc;

    border-radius: 10px;

*/    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);

  }

  .showSeletedName{

    font-size: 15px;

    margin-top: 2%;

    text-align: center;

    font-weight: 600;

    color: #4f90b5;

  }

  .rightcontent{

  text-align:right;


}

::placeholder {
  
  text-align:left;
}
.showinmobile{
  display: none;
}

@media screen and (max-width: 600px) {

  .showinmobile{

    display: block;

  }
  .PageTitle{
    float: left;
  }
  .hideinmobile{
    display: none;
  }

}
</style>



<div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Master Route

            <small>Update Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Master</a></li>

            <li class="active"><a href="{{ url('/form-mast-rate') }}">Master Route</a></li>

            <li class="active"><a href="{{ url('/form-mast-rate') }}">Update Route</a></li>

          </ol>

        </section>

        <form action="{{ url('form-mast-rate-update') }}" method="POST" >

             @csrf


        <section class="content">

          <div class="row">

           
            <div class="col-sm-12">

              <div class="box box-primary Custom-Box">

                  <div class="box-header with-border" style="text-align: center;">

                    <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Update Route </h2>

                    <div class="box-tools pull-right showinmobile">

                      <a href="{{ url('/view-mast-freight-rate') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Route</a>

                    </div>

                      <div class="box-tools pull-right">

                      <a href="{{ url('/view-mast-freight-rate') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Route</a>

                    </div>

                    
                    

                  </div><!-- /.box-header -->

                  @if(Session::has('alert-success'))



                    <div class="alert alert-success alert-dismissible" style="width: 96%;margin-left: 2%;">

                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                      <h4>

                        <i class="icon fa fa-check"></i>

                        Success...!

                      </h4>

                       {!! session('alert-success') !!}

                    </div>





                  @endif





                  @if(Session::has('alert-error'))



                    <div class="alert alert-danger alert-dismissible" style="width: 96%;margin-left: 2%;">

                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                      <h4>

                        <i class="icon fa fa-ban"></i>

                        Error...!

                      </h4>

                      {!! session('alert-error') !!}

                    </div>



                  @endif



                <div class="box-body">

                
                     <div class="row">

                        <div class="col-md-3"></div>
                        <div class="col-md-2">
                          
                          <div class="form-group">

                           <label for="exampleInputEmail1">Route Code : <span class="required-field"></span></label>

                            <div class="input-group">

                             <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>
                             
                             <input type="hidden" id="freightId" name="freightId" value="{{$rate_list[0]->FREIGHTROUTEID}}">
                             <input type="text" id="route_code" name="route_code" class="form-control  " value="{{$rate_list[0]->ROUTE_CODE}}" placeholder="" autocomplete="off" maxlength="4" readonly>
                            </div>
                          </div>

                        </div>

                        <div class="col-md-4">

                          <div class="form-group">

                            <label>

                              Route Name : 

                              <span class="required-field"></span>

                            </label>

                              <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                                 <input type="text"  id="route_name" name="route_name" class="form-control  pull-left " value="{{ $rate_list[0]->ROUTE_NAME}}" placeholder="Select Root Name" autocomplete="off" readonly="">

                              </div>

                                <small id="emailHelp" class="form-text text-muted">

                                  {!! $errors->first('route_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                                </small>
                              <small>
                                <div class="pull-left showSeletedName" id="depotText"></div>
                              </small>


                          </div>

                        </div>

                        
                      

                    </div>

                    <!-- /.row -->



                    





                </div><!-- /.box-body -->



                </div>

            </div>

          </div>


         


           

        </section>

        <section class="content" style="margin-top: -10%;">

          <div class="row">

            <div class="col-sm-12">

              <div class="box box-primary Custom-Box">

                <div class="box-body">

          
                <div class="table-responsive">

                <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbledata">

                  <tr>

                   <th>From Place</th>

                    <th>To Place</th>

                    <th>km</th>

                    <th>toll</th>
                    <th>Enhance Weight Rate</th>
                    <th>Extra Mileage</th>

                    <th>Extra km</th>

                    <th>Less km</th>

                    <th>Extra Toll</th>
                    <th>Trip Days</th>
                    <th>Holiday</th>


                  </tr>

                   <?php $srNo=1; ?>
                      @foreach($rate_list as $row)
                  <tr class="useful">

                  <!--  <td class="tdthtablebordr">
                      <span id='snum' style="width: 10px;">{{$srNo}}</span>
                    </td>  -->

                    <td class="tdthtablebordr tooltips">

                      <input type="text" class="inputboxclr getAccNAme" style="width: 120px;margin-bottom: 5px;" id='from_place{{$srNo}}' value="{{$row->FROM_PLACE}}" name="from_place[]"autocomplete="off"/>

                      <small class="tooltiptextitem tooltiphide" id="itemNameTooltip1"></small>
                      
                    </td>

                    <td class="tdthtablebordr">

                      <div style="display: inline-flex;border: none;margin-top: -3%;">

                      <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter getqtytotal quantityC moneyformate" value="{{$row->TO_PLACE}}" id='to_place{{$srNo}}' name="to_place[]" style="width: 80px" autocomplete="off"/>
              
                      </div>
                       <div><small id="errmsgqty1"></small></div>

                    </td>

                     <td class="tdthtablebordr">

                      <div style="display: inline-flex;border: none;margin-top: -3%;">

                      <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter"  id='km{{$srNo}}' name="km[]"  value="{{$row->KM}}" style="width: 80px" autocomplete="off"/>

                      </div>

                    </td>

                     <td class="tdthtablebordr">

                      <div style="display: inline-flex;border: none;margin-top: -3%;">

                      <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter"  id='toll{{$srNo}}' name="toll[]" value="{{$row->TOLL}}" style="width: 80px" autocomplete="off"/>

                      </div>

                    </td>

                    <td class="tdthtablebordr">

                      <div style="display: inline-flex;border: none;margin-top: -3%;">

                      <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter"  id='Weightrate{{$srNo}}' name="Weightrate[]" value="{{$row->WEIGHT_RATE}}" style="width: 80px" autocomplete="off"/>

                      </div>

                    </td>

                    <td class="tdthtablebordr">

                      <div style="display: inline-flex;border: none;margin-top: -3%;">

                      <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter"  id='extraMileage{{$srNo}}' name="extraMileage[]" value="{{$row->EXTRA_MILEAGE}}" style="width: 80px" autocomplete="off"/>

                      </div>

                    </td>

                     <td class="tdthtablebordr">

                      <div style="display: inline-flex;border: none;margin-top: -3%;">

                      <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter"  id='extra_km{{$srNo}}' name="extra_km[]" value="{{$row->EXTRA_KM}}"  style="width: 80px" autocomplete="off"/>

                      </div>

                    </td>


                     <td class="tdthtablebordr">

                      <div style="display: inline-flex;border: none;margin-top: -3%;">

                      <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter"  id='less_km{{$srNo}}' name="less_km[]" value="{{$row->LESS_KM}}" style="width: 80px"autocomplete="off" />

                      </div>

                    </td>

                    <td class="tdthtablebordr">

                      <div style="display: inline-flex;border: none;margin-top: -3%;">

                      <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter"  id='extra_toll{{$srNo}}' name="extra_toll[]" value="{{$row->EXTRA_TOLL}}" style="width: 80px" autocomplete="off" />

                      </div>

                    </td>
                    <td>
                      <div style="display: inline-flex;border: none;margin-top: -3%;">
                        <input type='text' class="debitcreditbox dr_amount Number inputboxclr SetInCenter"  id='trip_days{{$srNo}}' name="trip_days[]" Number value="{{$row->TRIP_DAYS}}" style="width: 80px" autocomplete="off" />
                      </div>
                    </td>
                    <td>
                      <div style="">
                       <input list="daysList" type='text' class="daysname"  style="padding:1px !important;width: 80px;" name="off_days[]" id="off_day{{$srNo}}" value="{{$row->HOLIDAYS}}"  autocomplete="off" />
                      <datalist id="daysList">

                              <option selected="selected" value="">-- Select --</option>
                              <option  value="Sunday" data-xyz="Sunday">Sunday</option>
                              <option  value="Monday" data-xyz="Monday">Monday</option>
                              <option  value="Tuesday" data-xyz="Tuesday">Tuesday</option>
                              <option  value="Wednesday" data-xyz="Wednesday">Wednesday</option>
                              <option  value="Thursday" data-xyz="Thursday">Thursday</option>
                              <option  value="Friday" data-xyz="Friday">Friday</option>
                              <option  value="Saturday" data-xyz="Saturday">Saturday</option>

                             
                          </datalist>
                     </div>
                    </td>

                    

                    

                  </tr>
                  <?php $srNo++; ?>
                      @endforeach
                 

                </table>

              </div><!-- /div -->

            
             


        
<style type="text/css">

  .rTable { display: table; }

.rTableRow { display: table-row; }

.rTableHeading { display: table-header-group; }

.rTableBody { display: table-row-group; }

.rTableFoot { display: table-footer-group; }

.rTableCell, .rTableHead { display: table-cell; }

  .rTable {
   display: table;
   /*width: 100%;*/
}

.rTableRow {

   display: table-row;

}

.rTableHeading {

   display: table-header-group;

   background-color: #ddd;

}

.rTableCell, .rTableHead {

   display: table-cell;

   padding: 3px 10px;

   border: 1px solid #ebe7e7;

}

.rTableHeading {

   display: table-header-group;

   background-color: #ddd;

   font-weight: bold;

}

.rTableFoot {

   display: table-footer-group;

   font-weight: bold;

   background-color: #ddd;

}

.rTableBody {

   display: table-row-group;

}

.setInline{

  display: flex;

  margin-bottom: 4px;

}

.rowClass{

  margin: 0px;

  margin-top: 3%;

}

.rowClass1{

  margin: 0px;

  margin-top: 0%;

}

.rowClassonModel{

   margin: 0px;

  margin-top: 1%;

}

.LableTextField{

  text-align: center;

  font-weight: 600;

}

.distClass{

  display: none;



}

.sgstBlock{

  display: none;

}

.cgstBlock{

  display: none;

}

.afforblck{

  display: none;

}

.affiveblck{

  display: none;

}

.afsixblck{

  display: none;

}

.afsevenblck{

  display: none;

}

.afheadeightblck{

  display: none;

}

.afheadnineblck{

  display: none;

}

.afheadtenblck{

  display: none;

}

.afheadelvnblck{

  display: none;

}

.afheadtwelblck{

  display: none;

}

.getheading{

  border: none;

  width: 61px;

}
.settaxcodemodel{
  font-size: 16px;
    font-weight: 800;
    color: #5d9abd;
}

</style>    

      <br>

        

        <p class="text-center">

          <button class="btn btn-success" type="submit" id="submitdata"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Update</button>

          <button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancel</button>

        </p>

       

<style>
              .boxer {
                display: table;
                border-collapse: collapse;
              }
              .boxer .box-row {
                display: table-row;
              }
              .boxer .box-row:first-child {
                font-weight:bold;
              }
              .boxer .box10 {
                display: table-cell;
                vertical-align: top;
                border: 1px solid #ddd;
                padding: 5px;
              }
              .boxer .hidebordritm {
                display: table-cell;
                vertical-align: top;
                border: none;
                padding: 5px;
              }
              .boxer .ebay {
                padding:5px 1.5em;
              }
              .boxer .google {
                padding:5px 1.5em;
              }
              .boxer .amazon {
                padding:5px 1.5em;
              }
              .center {
                text-align:center;
              }
              .right {
                float:right;
              }
              .texIndbox{
                width: 25%; 
                text-align: center;
              }
               .texIndbox1{
                width: 5%; 
                text-align: center;
              }
              .rateIndbox{
                width: 15%;
                text-align: center;
              }
              .itmdetlheading{
                vertical-align: middle !important;
                text-align: center;
              }
              .rateBox{
                width: 20%;
                text-align: center;
              }
              .amountBox{
                width: 20%;
                text-align: center;
              }
              .inputtaxInd{
                background-color: white !important;
                border: none;
                text-align: center;
              }
              .showind_Ch{
                display: none;
              }
            </style>
      <!-- when hsn code same then show model -->

     
  </div><!-- /.box-body -->

</div>

</div>

</div>

</section>

</form>

</div>



@include('admin.include.footer')




<script type="text/javascript">
  $(document).ready(function(){
  $('.Number').keypress(function (event) {
    var keycode = event.which;
    if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
        event.preventDefault();
    }
});

  });
</script>



@endsection