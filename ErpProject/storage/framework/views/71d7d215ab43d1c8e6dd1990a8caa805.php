<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Inventory Delivery Notes')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <?php if(isset($internalDelivery)): ?>
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
                    <?php if(isset($internalDelivery)): ?>
                        <?php echo e(Form::model($internalDelivery, array('route' => array('inventory.delivery-notes.update', $internalDelivery->id), 'method' => 'post','enctype' => 'multipart/form-data','class' => 'modalForm'))); ?>

                    <?php else: ?>
                        <?php echo e(Form::open(array('route' => ['inventory.delivery-notes.store'], 'enctype' => 'multipart/form-data','class' => 'modalForm'))); ?>

                    <?php endif; ?>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6 form-group">
                                <?php echo e(Form::label('internal_delivery_name', __('Internal Delivery Note Name'), ['class'=>'form-label'])); ?>

                                <?php echo e(Form::text('internal_delivery_name', null, ['class' => 'form-control', 'required' => 'required'])); ?>

                            </div>

                            <div class="col-6 form-group">
                                <?php echo e(Form::label('internal_delivery_number', __('Internal Delivery Note Number'), ['class'=>'form-label'])); ?>

                                <?php echo e(Form::text('internal_delivery_number', $internalDeliveryNumber, ['class' => 'form-control', 'readonly' => 'readonly'])); ?>

                            </div>

                            <div class="col-4 form-group">
                                <?php echo e(Form::label('accounting_date', __('Accounting Date'), ['class'=>'form-label'])); ?>

                                <?php echo e(Form::date('accounting_date', null, ['class' => 'form-control', 'required' => 'required'])); ?>

                            </div>

                            <div class="col-4 form-group">
                                <?php echo e(Form::label('voucher_date', __('Voucher Date'), ['class'=>'form-label'])); ?>

                                <?php echo e(Form::date('voucher_date', null, ['class' => 'form-control', 'required' => 'required'])); ?>

                            </div>

                            <div class="col-4 form-group">
                                <?php echo e(Form::label('deliverer', __('Deliverer'), ['class'=>'form-label'])); ?>

                                <?php echo e(Form::select('deliverer', $deliverers, null, ['class' => 'form-control select2', 'required' => 'required'])); ?>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(__('Item')); ?></th>
                                            <th><?php echo e(__('From Stock Name')); ?></th>
                                            <th><?php echo e(__('To Stock Name')); ?></th>
                                            <th><?php echo e(__('Available Quantity')); ?></th>
                                            <th><?php echo e(__('Quantity')); ?></th>
                                            <th><?php echo e(__('Unit Price')); ?></th>
                                            <th><?php echo e(__('Amount')); ?></th>
                                            <th><?php echo e(__('Settings')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <?php echo e(Form::text('item_description', null, ['class' => 'form-control', 'placeholder' => __('Item'), 'required' => 'required'])); ?>

                                            </td>
                                            <td>
                                                <?php echo e(Form::select('from_stock_name', $stockLocations, null, ['class' => 'form-control select2', 'required' => 'required'])); ?>

                                            </td>
                                            <td>
                                                <?php echo e(Form::select('to_stock_name', $stockLocations, null, ['class' => 'form-control select2', 'required' => 'required'])); ?>

                                            </td>
                                            <td>
                                                <?php echo e(Form::text('available_quantity', null, ['class' => 'form-control', 'readonly' => true])); ?>

                                            </td>
                                            <td>
                                                <?php echo e(Form::number('quantity', null, ['class' => 'form-control', 'id' => 'quantity', 'required' => 'required', 'min' => '1'])); ?>

                                            </td>
                                            <td>
                                                <?php echo e(Form::number('unit_price', null, ['class' => 'form-control', 'id' => 'unit_price', 'required' => 'required', 'min' => '0', 'step' => '0.01'])); ?>

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
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo e(__('Total Summary')); ?></h5>
                                        <div class="mb-3">
                                            <label class="form-label"><strong><?php echo e(__('Total Amount:')); ?></strong></label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <?php echo e(Form::text('total_amount', '0.00', ['class' => 'form-control', 'id' => 'total_amount', 'readonly' => true])); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Notes -->
                        <div class="row mt-3">
                            <div class="col-12">
                                <?php echo e(Form::textarea('notes', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => __('Note')])); ?>

                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-light" data-bs-dismiss="modal">
                        <?php if(isset($internalDelivery)): ?>
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
        const quantity = parseFloat(document.getElementById('quantity').value) || 0;
        const unitPrice = parseFloat(document.getElementById('unit_price').value) || 0;

        // Calculate amount
        const amount = quantity * unitPrice;
        document.getElementById('amount').value = amount.toFixed(2);

        // Update total amount
        document.getElementById('total_amount').value = amount.toFixed(2);
    }

    // Auto calculate when quantity or unit price changes
    document.getElementById('quantity').addEventListener('input', calculateTotal);
    document.getElementById('unit_price').addEventListener('input', calculateTotal);

    // Check available quantity when from_stock_name changes
    document.querySelector('select[name="from_stock_name"]').addEventListener('change', async function() {
        const stockId = this.value;
        const itemId = document.querySelector('input[name="item_description"]').value;

        if (stockId && itemId) {
            try {
                const response = await fetch(`/api/stock-quantity/${stockId}/${itemId}`);
                const data = await response.json();
                document.querySelector('input[name="available_quantity"]').value = data.quantity;
            } catch (error) {
                console.error('Error fetching available quantity:', error);
            }
        }
    });
    </script>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Soudi\ERPNBS\erpnbs\resources\views/delivery_notes/create.blade.php ENDPATH**/ ?>