<form name="FORM_REGISTRATION" action="<?php echo Yii::app()->baseUrl; ?>/?r=tester" method="POST">
    <fieldset>
        <legend>ISO Tester 8583</legend>
        <div class="form-group">
            <label>Service Type</label>
            <select id="S_SERVICE" class="form-control" name="FORM[SERVICE]">
                <option value="pdam">PDAM</option>
                <option value="pln" selected>PLN</option>
                <option value="finance" selected>FINANCE</option>
                <option value="kai" selected>KAI</option>
                <option value="tiketux" selected>TIKETUX</option>
                <option value="paytv" selected>PAYTV</option>
                <option value="voucher" selected>VOUCHER PULSA</option>
            </select>
            <span class="help-block DIFF_PORT">Use different port each Product.</span>
        </div>
        <div class="form-group">
                    <div class="col-sm-4">
                        <label>Transactional *</label>
                        <label class="radio">
                            <input type="radio" name="FORM[MESSAGE_TYPE]" value="net"><span class="help-block">Netman</span>
                        </label>
                        <label class="radio">
                            <input type="radio" name="FORM[MESSAGE_TYPE]" value="inq"><span class="help-block">Inquiry</span>
                        </label>
                        <label class="radio">
                            <input type="radio" name="FORM[MESSAGE_TYPE]" value="pay"><span class="help-block">Payment</span>
                        </label>
                        <label class="radio">
                            <input type="radio" name="FORM[MESSAGE_TYPE]" value="adv"><span class="help-block">Advice</span>
                        </label>
                        <label class="radio">
                            <input type="radio" name="FORM[MESSAGE_TYPE]" value="advrep"><span class="help-block">Advice Repeat</span>
                        </label>
                        <label class="radio">
                            <input type="radio" name="FORM[MESSAGE_TYPE]" value="rev"><span class="help-block">Reversal</span>
                        </label>
                        
                    </div>
                    <div class="col-sm-6 reservation">
                        <label>Reservation  *</label>
                        <label class="radio">
                            <input type="radio" name="FORM[MESSAGE_TYPE]" value="revrep" onclick="OPEN_MODAL()"><span class="help-block">Get Original</span>
                        </label>
                        <label class="radio">
                            <input type="radio" name="FORM[MESSAGE_TYPE]" value="revrep"><span class="help-block">Get Schedule</span>
                        </label>
                        <label class="radio">
                            <input type="radio" name="FORM[MESSAGE_TYPE]" value="revrep"><span class="help-block">Get Seat Layout</span>
                        </label>
                        <label class="radio">
                            <input type="radio" name="FORM[MESSAGE_TYPE]" value="revrep"><span class="help-block">Get Booking</span>
                        </label>
                    </div>
            <div class="clearfix"></div>
        </div>
        <div class="form-group">
            <label>Sub ID / ID Pelanggan *</label>
            <input type="text" class="form-control" placeholder="ID Pelanggan" name="FORM[IDPEL]" >
            <span class="help-block">Server Name define by yourself.</span>
        </div>
        
        <div class="form-group">
            <label>Bank Code *</label>
            <input type="text" class="form-control" value="0090010" placeholder="Bank Code" name="FORM[BANK_CODE]" >
            <span class="help-block">Server Name define by yourself.</span>
        </div>
        <div class="form-group">
            <label>Central ID *</label>
            <input type="text" class="form-control" value="0091601" name="FORM[CID]" >
            <span class="help-block">Server Name define by yourself.</span>
        </div>
        <div class="form-group">
            <label>IP Address / Host *</label>
            <input type="text" class="form-control" value="192.168.168.130" name="FORM[IP]" >
            <span class="help-block">Server Name define by yourself.</span>
        </div>
        <div class="form-group">
            <label>Port *</label>
            <input type="text" class="form-control" value="30030" name="FORM[PORT]" >
            <span class="help-block">Server Name define by yourself.</span>
        </div>
        
        <div class="form-group">
            <label>Timeout *</label>
            <input type="text" class="form-control" maxlength="5" value="30000" name="FORM[TIMEOUT]">
            <span class="help-block">Server Name define by yourself.</span>
        </div>
        <div class="form-group">
            <label>Merchant *</label>
            <input type="text" class="form-control" maxlength="4" value="6012" name="FORM[MERCHANT]">
            <span class="help-block">Server Name define by yourself.</span>
        </div>
        <div class="form-group">
            <label>Product ID *</label>
            <input type="text" class="form-control" maxlength="5" name="FORM[PRODUCT_ID]">
            <span class="help-block">Server Name define by yourself.</span>
        </div>
        <div class="form-group">
            <label>Terminal ID *</label>
            <input type="text" class="form-control" maxlength="4" value="000000GSP0001236" name="FORM[TERMINAL_ID]">
            <span class="help-block">Server Name define by yourself.</span>
        </div>
        
        


        <div class="container">
          <h2>Detail For Reservasi</h2>
          <!-- Trigger the modal with a button -->
          <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

          <!-- Modal -->
          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Detail Reservation</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Departure</label>
                        <select class="form-control" name="FORM[DEPARTURE]">
                            <option value="Jakarta">JAKARTA</option>
                            <option value="Bandung" selected>BANDUNG</option>
                        </select>
                        <span class="help-block DIFF_PORT">Use different port each Product.</span>
                    </div>
                    <div class="form-group">
                        <label>Destination</label>
                        <select class="form-control" name="FORM[DESTINATION]">
                            <option value="Jakarta">JAKARTA</option>
                            <option value="Bandung" selected>BANDUNG</option>
                        </select>
                        <span class="help-block DIFF_PORT">Use different port each Product.</span>
                    </div>
                    <div class="form-group">
                        <label>Page *</label>
                        <input type="text" class="form-control" maxlength="2" value="00" name="FORM[PAGE]" disabled>
                        <span class="help-block">Server Name define by yourself.</span>
                    </div>
                    <div class="form-group">
                        <label>Total Page *</label>
                        <input type="text" class="form-control" maxlength="2" disabled="" value="00" name="FORM[TOTAL_PAGE]">
                        <span class="help-block">Server Name define by yourself.</span>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Next</button>
                </div>
              </div>

            </div>
          </div>

        </div>
        
    <button type="submit" name="submit" class="btn btn-primary">Execute Test</button>
</fieldset>
</form>

<script>
    $(".reservation").hide();
    $( "#S_SERVICE" ).change(function() {
        var rVal = $(this).val();
        if(rVal=="tiketux"){
            $(".reservation").slideDown();
            $( "input[name='FORM[IDPEL]']" ).prop({
              disabled: true
            });
        }else{
            $(".reservation").slideUp();
            $( "input[name='FORM[IDPEL]']" ).prop({
              disabled: false
            });
        }
    });
    function OPEN_MODAL(){
        $("#myModal").modal("show");
    }
    
</script>