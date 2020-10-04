       <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container bootstrap snippets bootdeys">
<div class="row">
  <div class="col-sm-12">
      <div class="panel panel-default invoice" id="invoice">
      <div class="panel-body">
      
        <div class="row">

        <div class="col-sm-6 top-left">
          <i class="fa fa-rocket"></i>
        </div>

        <div class="col-sm-6 top-right">
            <h3 class="marginright">INVOICE-<?= $order->order_number ?></h3>
            <span class="marginright"><?= $order->created_at ?></span>
          </div>

      </div>
      <hr>
      <div class="row">

        <div class="col-xs-4 from">
          <p class="lead marginbottom">Customer Details</p>
          <p><?= $order->customer_name ?></p>
          <p><?= $order->mobile_number ?></p>
          <p>California</p>
        </div>



          <div class="col-xs-4 text-right payment-details">
          <p class="lead marginbottom payment-info">Vendor details</p>
          <p><?= $vendor->vendor_name ?></p>
          <p><?= $vendor->email ?> </p>
          <p><?= $vendor->mobile ?> </p>
          <p><?= $vendor->vendor_address ?></p>
          </div>

      </div>

      <div class="row table-row">
        <table class="table table-striped">
            <thead>
              <tr>
                <th class="text-center" style="width:5%">#</th>
                <th style="width:50%">Item</th>
                <th class="text-right" style="width:15%">Quantity</th>
                <th class="text-right" style="width:15%">Unit</th>
                <th class="text-right" style="width:15%">Total Price</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center">1</td>
                <td><?= $item->item_name ?></td>
                <td class="text-right"><?= $order->qty ?></td>
                <td class="text-right"><?= $order->unit ?></td>
                <td class="text-right"><?= $order->price_range?> </td>
              </tr>
              
             </tbody>
          </table>

      </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
<?php /*
      <div class="row">
      <div class="col-xs-6 margintop">
        <p class="lead marginbottom">THANK YOU!</p>

        <button class="btn btn-success" id="invoice-print"><i class="fa fa-print"></i> Print Invoice</button>
        <button class="btn btn-danger"><i class="fa fa-envelope-o"></i> Mail Invoice</button>
      </div>
      <div class="col-xs-6 text-right pull-right invoice-total">
            <p>Subtotal : $1019</p>
                <p>Discount (10%) : $101 </p>
                <p>VAT (8%) : $73 </p>
                <p>Total : $991 </p>
      </div>
      </div>
      */ ?>

      </div>
    </div>
  </div>
</div>
</div>