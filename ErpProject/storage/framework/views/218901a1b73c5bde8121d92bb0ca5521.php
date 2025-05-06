<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Inventory Cust & Supp Returns')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <?php if(isset($packing)): ?>
    <li class="breadcrumb-item"><?php echo e(__('Delivery Return Edit')); ?></li>
    <?php else: ?>
    <li class="breadcrumb-item"><?php echo e(__('Delivery Return Create')); ?></li>
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
                    <?php if(isset($orderReturn)): ?>
                        <?php echo e(Form::model($orderReturn, array('route' => array('inventory.de-return.update', $orderReturn->id), 'method' => 'post','enctype' => 'multipart/form-data','class' => 'modalForm'))); ?>

                    <?php else: ?>
                        <?php echo e(Form::open(array('route' => ['inventory.de-return.store'], 'enctype' => 'multipart/form-data','class' => 'modalForm'))); ?>

                    <?php endif; ?>
                    <div class="modal-body">
                        <div class="row">
                            <!-- Related Type -->
                            <div class="col-6 form-group">
                                <?php echo e(Form::label('related_type', __('Related Type'), ['class'=>'form-label'])); ?>

                                <?php echo e(Form::select('related_type_id', $relatedTypes, null, ['class' => 'form-control select2', 'required' => 'required'])); ?>

                            </div>

                            <!-- Related Data -->
                            <div class="col-6 form-group">
                                <?php echo e(Form::label('related_data', __('Related Data'), ['class'=>'form-label'])); ?>

                                <?php echo e(Form::select('related_data_id', $relatedData, null, ['class' => 'form-control select2', 'required' => 'required'])); ?>

                            </div>
                        </div>

                        <div class="row">
                            <!-- Order Number -->
                            <div class="col-6 form-group">
                                <?php echo e(Form::label('order_number', __('Order Number'), ['class'=>'form-label'])); ?>

                                <?php echo e(Form::text('order_number', null, ['class' => 'form-control', 'required' => 'required'])); ?>

                            </div>

                            <!-- Order Date -->
                            <div class="col-6 form-group">
                                <?php echo e(Form::label('order_date', __('Order Date'), ['class'=>'form-label'])); ?>

                                <?php echo e(Form::date('order_date', null, ['class' => 'form-control', 'required' => 'required'])); ?>

                            </div>
                        </div>

                        <div class="row">
                            <!-- vendor -->
                            <div class="col-6 form-group">
                                <?php echo e(Form::label('vendor', __('Vendor'), ['class'=>'form-label'])); ?>

                                <?php echo e(Form::select('vendor_id', $vendors, null, ['class' => 'form-control select2', 'required' => 'required'])); ?>

                            </div>

                            <!-- Date Created -->
                            <div class="col-6 form-group">
                                <?php echo e(Form::label('date_created', __('Date Created'), ['class'=>'form-label'])); ?>

                                <?php echo e(Form::date('date_created', null, ['class' => 'form-control', 'required' => 'required'])); ?>

                            </div>
                        </div>

                        <div class="row">
                            <!-- Return Type -->
                            <div class="col-6 form-group">
                                <?php echo e(Form::label('return_type', __('Return Type'), ['class'=>'form-label'])); ?>

                                <?php echo e(Form::select('return_type_id', $returnTypes, null, ['class' => 'form-control select2', 'required' => 'required'])); ?>

                            </div>

                            <!-- Email -->
                            <div class="col-6 form-group">
                                <?php echo e(Form::label('email', __('Email'), ['class'=>'form-label'])); ?>

                                <?php echo e(Form::email('email', null, ['class' => 'form-control', 'required' => 'required'])); ?>

                            </div>
                        </div>

                        <div class="row">
                            <!-- Phone Number -->
                            <div class="col-6 form-group">
                                <?php echo e(Form::label('phone_number', __('Phone Number'), ['class'=>'form-label'])); ?>

                                <?php echo e(Form::text('phone_number', null, ['class' => 'form-control', 'required' => 'required'])); ?>

                            </div>

                            <!-- Order Return Number -->
                            <div class="col-6 form-group">
                                <?php echo e(Form::label('order_return_number', __('Order Return Number'), ['class'=>'form-label'])); ?>

                                <div class="input-group">
                                    <?php echo e(Form::text('order_return_number_prefix', $orderReturnPrefix, ['class' => 'form-control', 'readonly' => 'readonly'])); ?>

                                    <?php echo e(Form::text('order_return_number_suffix', null, ['class' => 'form-control', 'required' => 'required'])); ?>

                                </div>
                            </div>
                        </div>

                        <!-- Items Table Section -->
                        <div class="row mt-4">
                            <div class="col-lg-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(__('Item')); ?></th>
                                            <th><?php echo e(__('Quantity')); ?></th>
                                            <th><?php echo e(__('Sale Price')); ?></th>
                                            <th><?php echo e(__('Tax')); ?></th>
                                            <th><?php echo e(__('Subtotal')); ?></th>
                                            <th><?php echo e(__('Discount')); ?></th>
                                            <th><?php echo e(__('Discount (money)')); ?></th>
                                            <th><?php echo e(__('Total Payment')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?php echo e(Form::text('item_description[]', null, ['class' => 'form-control', 'placeholder' => __('Item Description')])); ?></td>
                                            <td><?php echo e(Form::number('quantity[]', null, ['class' => 'form-control', 'placeholder' => __('Quantity')])); ?></td>
                                            <td><?php echo e(Form::number('sale_price[]', null, ['class' => 'form-control', 'placeholder' => __('Sale Price'), 'step' => '0.01'])); ?></td>
                                            <td><?php echo e(Form::select('tax[]', $taxes, null, ['class' => 'form-control'])); ?></td>
                                            <td><?php echo e(Form::text('subtotal[]', null, ['class' => 'form-control', 'readonly' => true])); ?></td>
                                            <td><?php echo e(Form::number('discount_percentage[]', null, ['class' => 'form-control', 'placeholder' => __('%')])); ?></td>
                                            <td><?php echo e(Form::number('discount_amount[]', null, ['class' => 'form-control', 'readonly' => true])); ?></td>
                                            <td><?php echo e(Form::text('total_payment', null, ['class' => 'form-control', 'readonly' => true])); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Total Section -->
                        <div class="row mt-4">
                            <div class="col-lg-4 offset-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo e(__('Total Summary')); ?></h5>
                                        <div class="mb-3">
                                            <label class="form-label"><strong><?php echo e(__('Subtotal:')); ?></strong></label>
                                            <?php echo e(Form::text('summary_subtotal', '0.00', ['class' => 'form-control', 'readonly' => true])); ?>

                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label"><strong><?php echo e(__('Additional Discount:')); ?></strong></label>
                                            <?php echo e(Form::text('summary_additional_discount', '0.00', ['class' => 'form-control', 'readonly' => true])); ?>

                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label"><strong><?php echo e(__('Total Discount:')); ?></strong></label>
                                            <?php echo e(Form::text('summary_total_discount', '0.00', ['class' => 'form-control', 'readonly' => true])); ?>

                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label"><strong><?php echo e(__('Total Payment:')); ?></strong></label>
                                            <?php echo e(Form::text('summary_total_payment', '0.00', ['class' => 'form-control', 'readonly' => true])); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Reason -->
                        <div class="row mt-3">
                            <div class="col-12">
                                <textarea name="reason" class="form-control" rows="3" placeholder="<?php echo e(__('Reason')); ?>"></textarea>
                            </div>
                        </div>

                        <!-- Admin Note -->
                        <div class="row mt-3">
                            <div class="col-12">
                                <textarea name="admin_note" class="form-control" rows="3" placeholder="<?php echo e(__('Admin Note')); ?>"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-light" data-bs-dismiss="modal">
                        <?php if(isset($orderReturn)): ?>
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




<script>
    function calculateTotals() {
        // Retrieve values from the input fields
        const quantity = parseFloat(document.querySelector('input[name="quantity"]').value) || 0;
        const salePrice = parseFloat(document.querySelector('input[name="sale_price"]').value) || 0;
        // const taxRate = parseFloat(document.querySelector('select[name="tax"]').value) || 0;
        const discountPercentage = parseFloat(document.querySelector('input[name="discount_percentage"]').value) || 0;
        const shippingFee = parseFloat(document.querySelector('input[name="shipping_fee"]').value) || 0;
        const taxOption = parseInt(document.querySelector('select[name="tax"]').value) || 0;
        let taxRate = 0;
    switch(taxOption) {
        case 1: taxRate = 0; break;  // No Tax
        case 2: taxRate = 5; break;  // 5%
        case 3: taxRate = 10; break; // 10%
        case 4: taxRate = 15; break; // 15%
        default: taxRate = 0; break;
    }
        console.log(taxRate);

        // Calculate subtotal (quantity * sale price)
        const subtotal = quantity * salePrice;

        console.log(subtotal);
        // Calculate tax amount (subtotal * tax rate / 100)
        const taxAmount = (taxRate / 100) * subtotal;
        console.log(taxAmount);

        // Calculate discount amount (subtotal * discount percentage / 100)
        const discountAmount = (discountPercentage / 100) * subtotal;
        console.log(discountAmount);

        // Calculate total payment (subtotal + tax - discount + shipping fee)
        const totalPayment = subtotal + taxAmount - discountAmount + shippingFee;
        console.log(totalPayment);

        // Update the form fields with the calculated values
        document.querySelector('input[name="subtotal"]').value = subtotal.toFixed(2);
        document.querySelector('input[name="discount_amount"]').value = discountAmount.toFixed(2);
        document.querySelector('input[name="total_payment"]').value = totalPayment.toFixed(2);

        // Update the summary fields
        document.querySelector('input[name="summary_subtotal"]').value = subtotal.toFixed(2);
        document.querySelector('input[name="summary_discount"]').value = discountAmount.toFixed(2);
        document.querySelector('input[name="summary_shipping_fee"]').value = shippingFee.toFixed(2);
        document.querySelector('input[name="summary_total_payment"]').value = totalPayment.toFixed(2);

        // Make Discount (Amount) field non-editable
        document.querySelector('input[name="discount_amount"]').setAttribute('readonly', 'readonly');
    }

    // Attach the calculation to the tick icon button
    document.querySelector('.settings-btn').addEventListener('click', calculateTotals);
</script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Soudi\ERPNBS\erpnbs\resources\views/cust_supp/deReturn.blade.php ENDPATH**/ ?>