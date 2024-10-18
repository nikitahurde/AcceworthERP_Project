<style type="text/css">
  .blink_me {
  animation: blinker 1s linear infinite;
  
}

@keyframes blinker {  
  50% { opacity: 0.5; }
}
</style>

  <!-- <th><div style="text-align: center;font-weight: bold;"><span class="blink_me" style="color:#DD4B39;">USER : <?= $form_name[0]->USER_CODE; ?></span></div></th></br> -->
 <table class="table table-bordered">
                  <thead>
                    <tr>
                      
                      
                      <!-- <th scope="col">Sr.no</th> -->
                       <th scope="col"  colspan="2"><span class="blink_me" style="color:#DD4B39;">USER : <?= $form_name[0]->USER_CODE; ?></span></th>
                      <th scope="col" style="text-align: center;">Object</th>
                      <th scope="col" style="text-align: center;">Values</th>
                      
                    </tr>
                  </thead>
                  <tbody>

                  	 <?php $srno=1; foreach ($form_name as $key) { ?>
                    <tr id="msg">
                     
                      <!-- <td >{{ $srno++ }}</td> -->
                      <td class="setname">{{ $key->menu_name}}</td>
                      <td class="setname">{{ $key->submenu_name}}</td>
                      <td class="setname">{{ $key->form_name}}</td>
                      <td class="setname">{{ $key->form_code }}</td>
                      
                    </tr>

                  <?php }  ?>
                    
                  </tbody>
            </table>