<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Inventory Setup')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Prefix')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css-page'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('action-btn'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-3">
            <?php echo $__env->make('layouts.inventory_setup', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="col-9">
            <div class="card mb-3">

                <div class="row">

                                            <?php
                                                $prefix = $inventoryGenerals->firstWhere('name', 'prefix');
                                                // $ = json_decode($inventory_settings->value, true);



                                            ?>
                    <?php echo e(isset($prefix) ? Form::model($prefix, ['route' => ['inventory-general.store', $prefix->id], 'method' => 'POST', 'class' => 'mt-4']) : Form::open(['route' => 'inventory-general.store', 'class' => 'mt-4'])); ?>


                    <?php echo e(Form::hidden('form_name', 'prefix')); ?>


                    <!-- Inventory Received Note -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5>Inventory Received Note</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <?php echo e(Form::label('inventory_received_prefix', __('Inventory Received Number Prefix'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::text('inventory_received_prefix', $prefix ? json_decode($prefix->value)->inventory_received_prefix : 'NK-', ['class' => 'form-control'])); ?>

                            </div>
                            <div class="mb-3">
                                <?php echo e(Form::label('next_inventory_received_number', __('Next Inventory Received Number'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::number('next_inventory_received_number', $prefix ? json_decode($prefix->value)->next_inventory_received_number : 332, ['class' => 'form-control'])); ?>

                            </div>
                        </div>
                    </div>

                    <!-- Inventory Delivery Note -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5>Inventory Delivery Note</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <?php echo e(Form::label('inventory_delivery_prefix', __('Inventory Delivery Number Prefix'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::text('inventory_delivery_prefix', $prefix ? json_decode($prefix->value)->inventory_delivery_prefix : 'XK-', ['class' => 'form-control'])); ?>

                            </div>
                            <div class="mb-3">
                                <?php echo e(Form::label('next_inventory_delivery_number', __('Next Inventory Delivery Number'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::number('next_inventory_delivery_number', $prefix ? json_decode($prefix->value)->next_inventory_delivery_number : 669, ['class' => 'form-control'])); ?>

                            </div>
                        </div>
                    </div>

                    <!-- Internal Delivery Note -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5>Internal Delivery Note</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <?php echo e(Form::label('internal_delivery_prefix', __('Internal Delivery Number Prefix'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::text('internal_delivery_prefix', $prefix ? json_decode($prefix->value)->internal_delivery_prefix : 'ID-', ['class' => 'form-control'])); ?>

                            </div>
                            <div class="mb-3">
                                <?php echo e(Form::label('next_internal_delivery_number', __('Next Internal Delivery Number'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::number('next_internal_delivery_number', $prefix ? json_decode($prefix->value)->next_internal_delivery_number : 23, ['class' => 'form-control'])); ?>

                            </div>
                        </div>
                    </div>

                    <!-- Packing List -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5>Packing List</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <?php echo e(Form::label('packing_list_prefix', __('Packing List Number Prefix'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::text('packing_list_prefix', $prefix ? json_decode($prefix->value)->packing_list_prefix : 'PL-', ['class' => 'form-control'])); ?>

                            </div>
                            <div class="mb-3">
                                <?php echo e(Form::label('next_packing_list_number', __('Next Packing List Number'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::number('next_packing_list_number', $prefix ? json_decode($prefix->value)->next_packing_list_number : 41, ['class' => 'form-control'])); ?>

                            </div>
                        </div>
                    </div>

                    <!-- Receiving-Exporting Return Order -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5>Receiving-Exporting Return Order</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <?php echo e(Form::label('receipt_return_prefix', __('Receipt Return Order Prefix'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::text('receipt_return_prefix', $prefix ? json_decode($prefix->value)->receipt_return_prefix : 'ReReturn-', ['class' => 'form-control'])); ?>

                            </div>
                            <div class="mb-3">
                                <?php echo e(Form::label('next_receipt_return_number', __('Next Receipt Return Order Number'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::number('next_receipt_return_number', $prefix ? json_decode($prefix->value)->next_receipt_return_number : 20, ['class' => 'form-control'])); ?>

                            </div>
                            <div class="mb-3">
                                <?php echo e(Form::label('delivery_return_prefix', __('Delivery Return Purchasing Goods Prefix'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::text('delivery_return_prefix', $prefix ? json_decode($prefix->value)->delivery_return_prefix : 'DEReturn-', ['class' => 'form-control'])); ?>

                            </div>
                            <div class="mb-3">
                                <?php echo e(Form::label('next_delivery_return_number', __('Next Delivery Return Purchasing Goods Number'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::number('next_delivery_return_number', $prefix ? json_decode($prefix->value)->next_delivery_return_number : 7, ['class' => 'form-control'])); ?>

                            </div>
                        </div>
                    </div>

                    <!-- SKU Prefix -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5>SKU Prefix</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <?php echo e(Form::label('sku_prefix', __('SKU Prefix'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::text('sku_prefix', $prefix ? json_decode($prefix->value)->sku_prefix : 'SKU-', ['class' => 'form-control'])); ?>

                            </div>
                        </div>
                    </div>

                    <!-- Lot Numbers -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5>Lot Numbers</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-check mb-3">
                                <?php echo e(Form::checkbox('auto_generate_batch', 1, $prefix ? json_decode($prefix->value)->auto_generate_batch : false, ['class' => 'form-check-input', 'id' => 'auto_generate_batch'])); ?>

                                <?php echo e(Form::label('auto_generate_batch', __('Automatically generate batch numbers'), ['class' => 'form-check-label'])); ?>

                            </div>
                            <div class="mb-3">
                                <?php echo e(Form::label('lot_number_prefix', __('Lot Number Prefix'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::text('lot_number_prefix', $prefix ? json_decode($prefix->value)->lot_number_prefix : 'LOT', ['class' => 'form-control'])); ?>

                            </div>
                            <div class="mb-3">
                                <?php echo e(Form::label('next_lot_number', __('Next Lot Number'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::number('next_lot_number', $prefix ? json_decode($prefix->value)->next_lot_number : 492, ['class' => 'form-control'])); ?>

                            </div>
                        </div>
                    </div>

                    <!-- Serial Numbers -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5>Serial Numbers</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <?php echo e(Form::label('next_serial_number', __('Next Serial Number'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::number('next_serial_number', $prefix ? json_decode($prefix->value)->next_serial_number : 1592597, ['class' => 'form-control'])); ?>

                            </div>
                            <div class="mb-3">
                                <label class="form-label"><?php echo e(__('Serial Number Format')); ?></label>
                                <div class="form-check">
                                    <?php echo e(Form::radio('serial_number_format', 'number_based', $prefix ? json_decode($prefix->value)->serial_number_format === 'number_based' : false, ['class' => 'form-check-input', 'id' => 'number_based'])); ?>

                                    <?php echo e(Form::label('number_based', __('Number Based (0000001)'), ['class' => 'form-check-label'])); ?>

                                </div>
                                <div class="form-check">
                                    <?php echo e(Form::radio('serial_number_format', 'date_based', $prefix ? json_decode($prefix->value)->serial_number_format === 'date_based' : false, ['class' => 'form-check-input', 'id' => 'date_based'])); ?>

                                    <?php echo e(Form::label('date_based', __('Date Based (YYYYMMDD000001)'), ['class' => 'form-check-label'])); ?>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <?php echo e(Form::submit(isset($prefix) ? __('Update') : __('Save'), ['class' => 'btn btn-primary'])); ?>

                    </div>

                    <?php echo e(Form::close()); ?>





                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Soudi\ERPNBS\erpnbs\resources\views/inventorySetup/prefix.blade.php ENDPATH**/ ?>