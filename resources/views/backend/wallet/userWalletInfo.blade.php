<div class="row">
    <div class="col-md-12">
    	<input type="hidden" name="user_id" value="{{ $user->id }}">
    	<p><span style="font-weight: bold;">User Name:</span>  {{ $user->name }}</p>
    	<p><span style="font-weight: bold;">Mobile Number:</span>  {{ $user->mobile }}</p>
    	<p><span style="font-weight: bold;"> Current Wallet Balance:</span> {{Config::get('siteSetting.currency_symble'). $user->wallet_balance }}</p>
    	
    </div>
    <div class="col-md-12">
       
            <label class="required" for="method_name">Recharge Amount</label>
            <input required="" name="amount" id="amount" value="{{old('amount')}}" type="number" placeholder="Enter Recharge Amount" class="form-control">
            @if ($errors->has('amount'))
            <span class="invalid-feedback" role="alert">
                {{ $errors->first('amount') }}
            </span>
            @endif
        
    </div>
    <div class="col-md-6">
       
            <label class="required" for="transaction_details">Transaction Details</label>
            <textarea rows="1" required="" name="transaction_details" id="transaction_details" style="resize: vertical;" placeholder="Write payment information" class="form-control">{{old('transaction_details')}}</textarea>
        
    </div>
    <div class="col-md-6">
       
        <label for="notes">Notes</label>
        <textarea rows="1" name="notes" id="notes" style="resize: vertical;" placeholder="Write your notes" class="form-control">{{old('notes')}}</textarea>
   	</div>
   	<div class="col-md-12">
   		<p style="white-space: nowrap;"><label for="addBalance"> <input type="radio" required name="wallet_type" data-parsley-required-message = "Please select wallet balance add or minus" id="addBalance" value="add"> Add Wallet Balance(+)</label> &nbsp;&nbsp;
   		<label for="minusBalance"> <input type="radio" required name="wallet_type" id="minusBalance" value="minus"> Minus Wallet Balance(-)</label></p>
    </div>
    <div class="col-md-12">
        <div class="modal-footer">
            <button type="submit" class="btn btn-success"> <i class="fa fa-save"></i> Wallet Balance Update</button>
          
        </div>
    </div>
</div>