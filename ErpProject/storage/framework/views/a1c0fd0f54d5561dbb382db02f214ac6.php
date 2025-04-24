<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Inventory Reciept Return')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <?php if(isset($voucher)): ?>
    <li class="breadcrumb-item"><?php echo e(__('Edit')); ?></li>
    <?php else: ?>
    <li class="breadcrumb-item"><?php echo e(__('Create')); ?></li>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">


    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">

        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <?php if(isset($voucher)): ?>
                        <?php echo e(Form::model($voucher, array('route' => array('inventory.return-voucher.update', $voucher->id), 'method' => 'post','enctype' => 'multipart/form-data','class' => 'modalForm'))); ?>

                    <?php else: ?>
                        <?php echo e(Form::open(array('route' => ['inventory.return-voucher.store'], 'enctype' => 'multipart/form-data','class' => 'modalForm'))); ?>

                    <?php endif; ?>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 form-group">
                                <?php echo e(Form::label('delivery_docket_number', __('Delivery Docket Number'), ['class'=>'form-label'])); ?>

                                <?php echo e(Form::text('delivery_docket_number', $deliveryDocketNumber, ['class' => 'form-control', 'readonly' => 'readonly'])); ?>

                            </div>

                            <div class="col-3 form-group">
                                <?php echo e(Form::label('accounting_date', __('Accounting Date'), ['class'=>'form-label'])); ?>

                                <?php echo e(Form::date('accounting_date', null, ['class' => 'form-control', 'required' => 'required'])); ?>

                            </div>

                            <div class="col-3 form-group">
                                <?php echo e(Form::label('voucher_date', __('Voucher Date'), ['class'=>'form-label'])); ?>

                                <?php echo e(Form::date('voucher_date', null, ['class' => 'form-control', 'required' => 'required'])); ?>

                            </div>

                            <div class="col-3 form-group">
                                <?php echo e(Form::label('purchase_order', __('Choose from a Purchase Order'), ['class'=>'form-label'])); ?>

                                <?php echo e(Form::select('purchase_order', $purchaseOrders, null, ['class' => 'form-control select2', 'required' => 'required'])); ?>

                            </div>

                            <div class="col-3 form-group">
                                <?php echo e(Form::label('supplier_name', __('Supplier Name'), ['class'=>'form-label'])); ?>

                                <?php echo e(Form::select('supplier_name', $suppliers, null, ['class' => 'form-control select2', 'required' => 'required'])); ?>

                            </div>

                            <div class="col-3 form-group">
                                <?php echo e(Form::label('buyer', __('Buyer'), ['class'=>'form-label'])); ?>

                                <?php echo e(Form::select('buyer', $buyers, null, ['class' => 'form-control select2', 'required' => 'required'])); ?>

                            </div>

                            <div class="col-3 form-group">
                                <?php echo e(Form::label('project', __('Project'), ['class'=>'form-label'])); ?>

                                <?php echo e(Form::select('project', $projects, null, ['class' => 'form-control select2', 'required' => 'required'])); ?>

                            </div>

                            <div class="col-3 form-group">
                                <?php echo e(Form::label('type', __('Type'), ['class'=>'form-label'])); ?>

                                <?php echo e(Form::select('type', $types, null, ['class' => 'form-control select2', 'required' => 'required'])); ?>

                            </div>

                            <div class="col-3 form-group">
                                <?php echo e(Form::label('department', __('Department'), ['class'=>'form-label'])); ?>

                                <?php echo e(Form::select('department', $departments, null, ['class' => 'form-control select2', 'required' => 'required'])); ?>

                            </div>

                            <div class="col-3 form-group">
                                <?php echo e(Form::label('requester', __('Requester'), ['class'=>'form-label'])); ?>

                                <?php echo e(Form::select('requester', $requesters, null, ['class' => 'form-control select2', 'required' => 'required'])); ?>

                            </div>

                            <div class="col-3 form-group">
                                <?php echo e(Form::label('deliverer', __('Deliverer'), ['class'=>'form-label'])); ?>

                                <?php echo e(Form::text('deliverer', null, ['class' => 'form-control', 'required' => 'required'])); ?>

                            </div>

                            <div class="col-3 form-group">
                                <?php echo e(Form::label('warehouse_name', __('Warehouse Name'), ['class'=>'form-label'])); ?>

                                <?php echo e(Form::select('warehouse_name', $warehouses, null, ['class' => 'form-control select2', 'required' => 'required'])); ?>

                            </div>

                            <div class="col-3 form-group">
                                <?php echo e(Form::label('expiry_date', __('Expiry Date'), ['class'=>'form-label'])); ?>

                                <?php echo e(Form::date('expiry_date', null, ['class' => 'form-control'])); ?>

                            </div>

                            <div class="col-3 form-group">
                                <?php echo e(Form::label('invoice_no', __('Invoice No.'), ['class'=>'form-label'])); ?>

                                <?php echo e(Form::text('invoice_no', null, ['class' => 'form-control', 'required' => 'required'])); ?>

                            </div>
                        </div>
                        <div class="row">
                            <!-- Items Table Section  -->
                            <div class="col-lg-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(__('Item')); ?></th>
                                            <th><?php echo e(__('Warehouse Name')); ?></th>
                                            <th><?php echo e(__('Quantity')); ?></th>
                                            <th><?php echo e(__('Unit Price')); ?></th>
                                            <th><?php echo e(__('Tax')); ?></th>
                                            <th><?php echo e(__('Lot Number')); ?></th>
                                            <th><?php echo e(__('Date Manufacture')); ?></th>
                                            <th><?php echo e(__('Expiry Date')); ?></th>
                                            <th><?php echo e(__('Amount')); ?></th>
                                            <th><?php echo e(__('Settings')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <?php echo e(Form::text('item_description', null, ['class' => 'form-control', 'placeholder' => __('Description')])); ?>

                                                <small><?php echo e(__('Commodity Notes')); ?></small>
                                            </td>
                                            <td>
                                                <?php echo e(Form::select('item_warehouse_name', [
                                                    '' => __('None Selected'),
                                                    'Warehouse A' => 'Warehouse A',
                                                    'Warehouse B' => 'Warehouse B'
                                                ], null, ['class' => 'form-control select2'])); ?>

                                            </td>
                                            <td>
                                                <?php echo e(Form::number('quantity', null, ['class' => 'form-control', 'id' => 'quantity', 'placeholder' => __('Quantity')])); ?>

                                            </td>
                                            <td>
                                                <?php echo e(Form::number('unit_price', null, ['class' => 'form-control', 'id' => 'unit_price', 'placeholder' => __('Unit Price'), 'step' => '0.01'])); ?>

                                            </td>
                                            <td>
                                                <?php echo e(Form::select('tax', [
                                                    '0' => __('No Tax'),
                                                    '10' => __('10%'),
                                                    '15' => __('15%')
                                                ], null, ['class' => 'form-control', 'id' => 'tax'])); ?>

                                            </td>
                                            <td>
                                                <?php echo e(Form::text('lot_number', null, ['class' => 'form-control', 'placeholder' => __('Lot Number')])); ?>

                                            </td>
                                            <td>
                                                <?php echo e(Form::date('date_manufacture', null, ['class' => 'form-control'])); ?>

                                            </td>
                                            <td>
                                                <?php echo e(Form::date('item_expiry_date', null, ['class' => 'form-control'])); ?>

                                            </td>
                                            <td>
                                                <?php echo e(Form::text('amount', null, ['class' => 'form-control', 'id' => 'amount', 'readonly' => true])); ?>

                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-light settings-btn" onclick="calculateTotal()">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-lg-8">

                            </div>
                            <!-- Totals Section  -->
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo e(__('Total Summary')); ?></h5>
                                        <div class="mb-3">
                                            <label class="form-label"><strong><?php echo e(__('Total Goods Value:')); ?></strong></label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <?php echo e(Form::text('total_goods_value', '0.00', ['class' => 'form-control', 'id' => 'total_goods_value', 'readonly' => true])); ?>

                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label"><strong><?php echo e(__('Value of Inventory:')); ?></strong></label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <?php echo e(Form::text('value_of_inventory', '0.00', ['class' => 'form-control', 'id' => 'value_of_inventory', 'readonly' => true])); ?>

                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label"><strong><?php echo e(__('Total Tax Amount:')); ?></strong></label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <?php echo e(Form::text('total_tax_amount', '0.00', ['class' => 'form-control', 'id' => 'total_tax_amount', 'readonly' => true])); ?>

                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label"><strong><?php echo e(__('Total Payment:')); ?></strong></label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <?php echo e(Form::text('total_payment', '0.00', ['class' => 'form-control', 'id' => 'total_payment', 'readonly' => true])); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Notes -->
                        <div class="row mt-3">
                            <div class="col-12">
                                <textarea name="notes" class="form-control" rows="3" placeholder="<?php echo e(__('Note')); ?>"></textarea>
                            </div>
                        </div>
                    </div>






                    <div class="modal-footer">
                        <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-light" data-bs-dismiss="modal">
                        <?php if(isset($voucher)): ?>
                            <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn btn-primary">
                        <?php else: ?>
                            <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn btn-primary">
                        <?php endif; ?>
                    </div>
                    <?php echo e(Form::close()); ?>



                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<script>
    function calculateTotal() {
        // Get input values
        const quantity = parseFloat(document.getElementById('quantity').value) || 0;
        const unitPrice = parseFloat(document.getElementById('unit_price').value) || 0;
        const taxRate = parseFloat(document.getElementById('tax').value) || 0;

        // Calculate amount (before tax)
        const amount = quantity * unitPrice;
        document.getElementById('amount').value = amount.toFixed(2);

        // Calculate totals
        const totalGoodsValue = amount;
        const valueOfInventory = amount;
        const totalTaxAmount = (amount * taxRate) / 100;
        const totalPayment = totalGoodsValue + totalTaxAmount;

        // Update total fields
        document.getElementById('total_goods_value').value = totalGoodsValue.toFixed(2);
        document.getElementById('value_of_inventory').value = valueOfInventory.toFixed(2);
        document.getElementById('total_tax_amount').value = totalTaxAmount.toFixed(2);
        document.getElementById('total_payment').value = totalPayment.toFixed(2);
    }

    // Auto calculate when any input changes
    document.getElementById('quantity').addEventListener('input', calculateTotal);
    document.getElementById('unit_price').addEventListener('input', calculateTotal);
    document.getElementById('tax').addEventListener('change', calculateTotal);

    // Add validation before form submission
    document.querySelector('form').addEventListener('submit', function(e) {
        // Recalculate totals before submission to ensure latest values
        calculateTotal();

        // All total fields are already part of the form as input fields,
        // so they will be automatically submitted with the form
    });
    </script>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Soudi\ERPNBS\erpnbs\resources\views/return_voucher/create.blade.php ENDPATH**/ ?>