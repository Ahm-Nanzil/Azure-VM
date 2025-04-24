<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Inventory Loss & adjustment')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <?php if(isset($lossAdjustment)): ?>
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
                    <?php if(isset($lossAdjustment)): ?>
                        <?php echo e(Form::model($lossAdjustment, array('route' => array('inventory.loss-adjustment.update', $lossAdjustment->id), 'method' => 'post','enctype' => 'multipart/form-data','class' => 'modalForm'))); ?>

                    <?php else: ?>
                        <?php echo e(Form::open(array('route' => ['inventory.loss-adjustment.store'], 'enctype' => 'multipart/form-data','class' => 'modalForm'))); ?>

                    <?php endif; ?>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6 form-group">
                                <?php echo e(Form::label('time', __('Time (Lost or Adjusted)'), ['class'=>'form-label'])); ?>

                                <?php echo e(Form::datetimeLocal('time', null, ['class' => 'form-control', 'required' => 'required'])); ?>

                            </div>

                            <div class="col-6 form-group">
                                <?php echo e(Form::label('type', __('Type'), ['class'=>'form-label'])); ?>

                                <?php echo e(Form::select('type', $types, null, ['class' => 'form-control select2', 'required' => 'required'])); ?>

                            </div>

                            <div class="col-6 form-group">
                                <?php echo e(Form::label('warehouse', __('warehouse'), ['class'=>'form-label'])); ?>

                                <?php echo e(Form::select('warehouse', $warehouses, null, ['class' => 'form-control select2', 'required' => 'required'])); ?>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(__('Item')); ?></th>
                                            <th><?php echo e(__('Lot Number')); ?></th>
                                            <th><?php echo e(__('Expiration Date')); ?></th>
                                            <th><?php echo e(__('Quantity Available')); ?></th>
                                            <th><?php echo e(__('Quantity in Stock')); ?></th>
                                            <th><?php echo e(__('Settings')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <?php echo e(Form::text('item', null, ['class' => 'form-control', 'placeholder' => __('Description'), 'required' => 'required'])); ?>

                                            </td>
                                            <td>
                                                <?php echo e(Form::text('lot_number', null, ['class' => 'form-control', 'placeholder' => __('Lot Number'), 'required' => 'required'])); ?>

                                            </td>
                                            <td>
                                                <?php echo e(Form::date('expiration_date', null, ['class' => 'form-control', 'required' => 'required'])); ?>

                                            </td>
                                            <td>
                                                <?php echo e(Form::text('quantity_available', null, ['class' => 'form-control', 'readonly' => true])); ?>

                                            </td>
                                            <td>
                                                <?php echo e(Form::number('quantity_in_stock', null, ['class' => 'form-control', 'min' => '0', 'required' => 'required'])); ?>

                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-light settings-btn" onclick="adjustStock()">
                                                    <i class="fas fa-cogs"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <?php echo e(Form::label('reason', __('Reason'), ['class'=>'form-label'])); ?>

                                <?php echo e(Form::textarea('reason', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => __('Reason'), 'required' => 'required'])); ?>

                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-light" data-bs-dismiss="modal">
                        <?php if(isset($lossAdjustment)): ?>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Soudi\ERPNBS\erpnbs\resources\views/loss_adjustment/create.blade.php ENDPATH**/ ?>