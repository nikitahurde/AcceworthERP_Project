<h4 class="modal-title modltitletext text-center" id="exampleModalLabel_" style="font-weight:bold;color: #5696bb;font-size:19px;text-align:center;">{{$comp_name}}</h4>
<div style="line-height:0.5px;padding-top:-15px;">
<p class="text-center;">{{$address}}</p>
<p class="text-center" style="font-weight: 700;font-size: 18px;text-align:center;">SALARY SLIP</p>
</div>
<table style="width:100%;border-collapse: collapse;">
      <tr style="border:1px solid #a5a2a2;padding:20px;">
            <td style="border:1px solid #a5a2a2;padding-left:10px;font-size: 15px;font-weight:700;height:30px;">Employee Name</td>
            <td style="border:1px solid #a5a2a2;padding-left:10px;">{{$name}}</td>
             <td style="border:1px solid #a5a2a2;text-align: left;font-size: 15px;padding-left:10px;">PAN</td>
            <td style="border:1px solid #a5a2a2;padding-left:10px;">{{$panNo}}</td>
           

      <tr  style="border:1px solid #a5a2a2;padding: 5px;">
            <td style="border:1px solid #a5a2a2;text-align: left;padding-left:10px;font-size: 15px;height:30px;">Employee Code</td>
            <td style="border:1px solid #a5a2a2;padding-left:10px;">{{$empcode}}</td>
            <td style="border: 1px solid #a5a2a2;padding-left:10px;text-align: left;font-size: 15px;">PF Number</td>
            <td style="border:1px solid #a5a2a2;padding-left:10px;">{{$pfNum}}</td>
      </tr>

      <tr  style="border:1px solid #a5a2a2;padding: 5px;">
            <td style="border:1px solid #a5a2a2;text-align: left;padding-left:10px;font-size: 15px;height:30px;">Designation</td>
            <td style="border:1px solid #a5a2a2;padding-left:10px;">{{$empDesig}}</td>
            <td style="border:1px solid #a5a2a2;text-align: left;padding-left:10px;font-size: 15px;">Account No </td>
            <td style="border:1px solid #a5a2a2;padding-left:10px;">{{$accNo}}</td>
            <!-- <td style="border: 1px solid #a5a2a2;text-align: left;padding-left:10px;font-size: 15px;">SA Number</td>
            <td style="border:1px solid #a5a2a2;padding-left:10px;">{{$saNum}}</td> -->
      </tr>

      <tr  style="border:1px solid #a5a2a2;padding: 10px;">
            <td style="border:1px solid #a5a2a2;text-align: left;padding-left:10px;font-size: 15px;height:30px;">Date Of Joining</td>
            <td style="border:1px solid #a5a2a2;padding-left:10px;">{{$empDOJ}}</td>
            <td style="border: 1px solid #a5a2a2;padding-left:10px;text-align: left;font-size: 15px;padding-left:10px;">IFSC</td>
            <td style="border:1px solid #a5a2a2;padding-left:10px;">No</td>
            
      </tr>

      <tr  style="border:1px solid #a5a2a2;padding: 5px;">
           <td class="child" style="width: 179px;padding-left:10px;font-size:15px;border:1px solid #a5a2a2;">
                                    CTC </td>
           <td class="child" style="border:1px solid #a5a2a2;padding-left:10px;">{{$ctcAmt}}</td>
           <td style="border: 1px solid #a5a2a2;text-align: left;padding-left:10px;font-size: 15px;">Bank Name</td>
           <td style="border:1px solid #a5a2a2;padding-left:10px;">{{$bankName}}</td>   
      </tr>

      <tr  style="border:1px solid #a5a2a2;padding: 5px;">
           <td class="child" style="width: 179px;padding-left:10px;font-size:15px;border:1px solid #a5a2a2;">
                                    Pay Period </td>
           <td class="child" style="border:1px solid #a5a2a2;padding-left:10px;">{{$payPeriod}}</td>
           <td style="border: 1px solid #a5a2a2;text-align: left;padding-left:10px;font-size: 15px;">Grade</td>
           <td style="border:1px solid #a5a2a2;padding-left:10px;">{{$grade}}</td>   
      </tr>

      <tr style="border:1px solid #a5a2a2;">
            <td colspan="4" style="height:20px;"></td>
      </tr>

      <tr class="text-center" style="border:1px solid #a5a2a2;height:40%;">
            <th colspan="2" style="border: 1px solid #a5a2a2;background-color:#FFB6C1;height:40%;">Income </th>
            <th colspan="2" style="border: 1px solid #a5a2a2;background-color:#FFB6C1;height:40%;">Deduction</th>
      </tr>

      <tr style="background-color:#efd5d5fa;">
            <th style="width:25%;text-align: center;border:1px solid #a5a2a2;">Particulars</th>
            <th style="width:25%;text-align: center;border:1px solid #a5a2a2;">Amount</th><th style="width:25%;text-align: center;border:1px solid #a5a2a2;">Particulars</th>
            <th style="width:25%;text-align: center;border:1px solid #a5a2a2;">Amount</th>
      </tr>

      <tr>
            <td colspan="2" class="parent" style="border:1px solid #a5a2a2;border-spacing:0px;border-collapse:collapse;padding:0px !important;"cellspacing="0">
                  <table style="width:100%;border-collapse:collapse;border-spacing:0px;margin:0;" cellspacing="0">
                        <!-- <tr style="padding:10px;margin:0;">
                              
                        </tr> -->

                        @foreach($wageInEarning as $key =>$row)
                        <tr style="border:1px solid #a5a2a2;padding:10px;">
                              <td class="child" style="width: 179px;padding-left:10px;font-size:15px;">
                                   {{$row}} </td>
                                   
                                   <?php $i = $key; ?>
                              <td class="child" style="border:1px solid #a5a2a2;padding-left:10px;">{{$wageInEarningAmt[$i]}}</td>
                             
                        </tr>
                        @endforeach 

                        
                        
                       
                        
                  </table>
            </td>
            <td colspan="2" cellspacing="0" class="parent" style="vertical-align:top !important;border-spacing:0px;border-collapse:collapse;padding:0px !important;border:1px solid #a5a2a2;">
                  <table style="width:100%;border-collapse: collapse;border-spacing:0px;margin:0;" cellspacing="0">
                        @if($wageInDeduction != '')
                           @foreach($wageInDeduction as $key =>$row)
                        <tr style="border:1px solid #a5a2a2;padding:10px;">
                              <td class="child" style="width: 179px;padding-left:10px;font-size:15px;">
                                   {{$row}} </td>
                                   
                                   <?php $i = $key; ?>
                              <td class="child" style="border:1px solid #a5a2a2;padding-left:10px;">{{$wageInDeducAmt[$i]}}</td>
                             
                        </tr>
                        
                        @endforeach    
                        @endif

                        <tr style="border:1px solid #a5a2a2;padding:10px;">
                              <td class="child" style="width: 179px;padding-left:10px;font-size:15px;">
                                   P-TAX</td>
                                   
                                   
                              <td class="child" style="border:1px solid #a5a2a2;padding-left:10px;">{{$ptax}}</td>
                             
                        </tr>

                        <tr style="border:1px solid #a5a2a2;padding:10px;">
                              <td class="child" style="width: 179px;padding-left:10px;font-size:15px;">
                                   I-TAX</td>
                                   
                                   
                              <td class="child" style="border:1px solid #a5a2a2;padding-left:10px;">{{$itax}}</td>
                             
                        </tr>

                        <tr style="border:1px solid #a5a2a2;padding:10px;">
                              <td class="child" style="width: 179px;padding-left:10px;font-size:15px;">
                                   Advance/Loan</td>
                                   
                                   
                              <td class="child" style="border:1px solid #a5a2a2;padding-left:10px;">{{$advOrLoanAmt}}</td>
                             
                        </tr>
                        
                  </table>
            </td>

          </tr>
           
          <tr>
            <td colspan="2" style="border:1px solid #a5a2a2;text-align: center;font-size: 15px;font-weight: bold;"> <table>
                        <tr>
                              <td class="child" style="width:100px;font-size:15px;font-weight: bold !important;">
                              Total Earning</td>
                              <td class="child">:</td>
                              <td class="child">{{$tlEarnAmt}}</td>
                        </tr></table></td>
            <td colspan="2" style="border:1px solid #a5a2a2;text-align: center;font-size: 15px;font-weight: bold;"> <table>
                        <tr>
                              <td class="child" style="width:150px;padding-left:10px;font-size:15px;font-weight: bold !important;">
                             Total Deduction </td>
                              <td class="child">:</td>
                              <td class="child">{{$tlDeducAmt}}</td>
                        </tr></table></td>
          </tr>

          <tr>
            <td colspan="3" style="background-color:#FFB6C1;border:1px solid #a5a2a2;text-align: center;font-size: 15px;font-weight: bold;">Net Salary </td>
            <td style="border:1px solid #a5a2a2;text-align:center;font-weight:bold;"><p style="padding-top: 5%;font-weight: 900;">{{$totalNp}}</p></td>
          </tr>

          <tr style="border:1px solid #a5a2a2;">
            <td colspan="2" style="border:1px solid #a5a2a2;text-align:center;" class="parent"><strong>Attendance Details</strong></td>
            <td colspan="2" style="border:1px solid #a5a2a2;text-align:center;"><strong>Form 16 Summary</strong></td>
         </tr>

         <tr>
            <td colspan="2" class="parent" style="border:1px solid #a5a2a2;">
                  <table>
                        <tr>
                              <td class="child" style="width:150px;padding-left:10px;font-size:15px;font-weight: 900 !important;">
                              MM Days </td>
                              <td class="child">:</td>
                              <td class="child">{{$totalWorkDays}}</td>
                        </tr>
                        <tr>
                              <td class="child" style="padding-left:10px;">
                                     Holidays </td>
                              <td class="child">:</td>
                              <td class="child">{{$holiday}}</td>
                        </tr>

                        <tr>
                              <td class="child" style="padding-left:10px;">
                              Leave(SL/CL)</td>
                              <td class="child">:</td>
                              <td class="child">{{$leaves}}</td>
                        </tr>
                        <tr>
                              <td class="child" style="padding-left:10px;"> Absent</td>
                              <td class="child">:</td>
                              <td class="child">{{$absent}}</td>
                        </tr>
                        <tr>
                              <td class="child" style="padding-left:10px;">
                               Working Days</td>
                              <td class="child">:</td>
                              <td class="child">{{$numWorkDay}}</td>
                        </tr>
                  </table>
            </td>

            <td colspan="2" style="border:1px solid #a5a2a2;">
                  <table>
                        <tr>
                              <td class="child" style="width:200px;padding-left:10px;font-size:15px;">
                              Gross Salary </td>
                              <td class="child">:</td>
                              <td class="child">{{$grossSal}}</td>
                        </tr>
                        <tr>
                              <td class="child" style="padding-left:10px;">
                              Deduction </td>
                              <td class="child">:</td>
                              <td class="child">{{$deduction}}</td>
                        </tr>
                        <tr>
                              <td class="child" style="padding-left:10px;">
                              Taxable Income</td>
                              <td class="child">:</td>
                              <td class="child">{{$taxableIn}}</td>
                        </tr>
                        <tr>
                              <td class="child" style="padding-left:10px;"> Tax Amt.</td>
                              <td class="child">:</td>
                              <td class="child">{{$taxAmt}}</td>
                        </tr>
                        <tr>
                              <td class="child" style="padding-left:10px;">
                              Tax Paid</td>
                              <td class="child">:</td>
                             <td class="child">{{$taxpaid}}</td>
                       </tr>
                       <tr>
                        <td class="child" style="padding-left:10px;">
                              Net Tax / Due Refund</td>
                              <td class="child">:</td>
                              <td class="child">{{$taxDueRefund}}</td>
                        </tr>
                  </table>
            </td>
         </tr>
         <tr>
            <td colspan="2" style="border:1px solid #a5a2a2;height:80px;"></td>
            <td colspan="2" style="border:1px solid #a5a2a2;"></td>
         </tr>
         <tr>
            <td colspan="2" style="border:1px solid #a5a2a2;text-align:center;"><strong>Employee Signature</strong></td>
            <td colspan="2" style="border:1px solid #a5a2a2;text-align:center;"><strong>Employer Signature</strong></td>
      </tr>

</table>

<strong>NOTE : </strong>
