<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Inventory Cust Delivery Notes')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
<script>
    function calculateTotals() {
        // Retrieve values from the input fields
        const quantity = parseFloat(document.querySelector('input[name="quantity"]').value) || 0;
        const salePrice = parseFloat(document.querySelector('input[name="sale_price"]').value) || 0;
        const taxRate = parseFloat(document.querySelector('select[name="tax"]').value) || 0;
        const discountPercentage = parseFloat(document.querySelector('input[name="discount_percentage"]').value) || 0;
        const shippingFee = parseFloat(document.querySelector('input[name="shipping_fee"]').value) || 0;

        // Calculate subtotal (quantity * sale price)
        const subtotal = quantity * salePrice;

        // Calculate tax amount (subtotal * tax rate / 100)
        const taxAmount = (taxRate / 100) * subtotal;

        // Calculate discount amount (subtotal * discount percentage / 100)
        const discountAmount = (discountPercentage / 100) * subtotal;

        // Calculate total payment (subtotal + tax - discount + shipping fee)
        const totalPayment = subtotal + taxAmount - discountAmount + shippingFee;

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

<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <?php if(isset($stockExport)): ?>
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
                    <?php if(isset($stockExport)): ?>
                        <?php echo e(Form::model($stockExport, array('route' => array('inventory.stock-export.update', $stockExport->id), 'method' => 'post', 'enctype' => 'multipart/form-data', 'class' => 'modalForm'))); ?>

                    <?php else: ?>
                        <?php echo e(Form::open(array('route' => ['inventory.stock-export.store'], 'enctype' => 'multipart/form-data', 'class' => 'modalForm'))); ?>

                    <?php endif; ?>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 form-group">
                                <?php echo e(Form::label('document_number', __('Document Number'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::text('document_number', $documentNumber, ['class' => 'form-control', 'readonly' => 'readonly'])); ?>

                            </div>

                            <div class="col-3 form-group">
                                <?php echo e(Form::label('accounting_date', __('Accounting Date'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::date('accounting_date', null, ['class' => 'form-control', 'required' => 'required'])); ?>

                            </div>

                            <div class="col-3 form-group">
                                <?php echo e(Form::label('voucher_date', __('Voucher Date'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::date('voucher_date', null, ['class' => 'form-control', 'required' => 'required'])); ?>

                            </div>

                            <div class="col-3 form-group">
                                <?php echo e(Form::label('invoice_id', __('Invoices'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::select('invoice_id', $invoices, null, ['class' => 'form-control select2', 'required' => 'required'])); ?>

                            </div>

                            <div class="col-3 form-group">
                                <?php echo e(Form::label('customer_id', __('Customer Name'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::select('customer_id', $customers, null, ['class' => 'form-control select2', 'required' => 'required'])); ?>

                            </div>

                            <div class="col-3 form-group">
                                <?php echo e(Form::label('receiver', __('Receiver'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::text('receiver', null, ['class' => 'form-control', 'required' => 'required'])); ?>

                            </div>

                            <div class="col-3 form-group">
                                <?php echo e(Form::label('address', __('Address'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::text('address', null, ['class' => 'form-control', 'required' => 'required'])); ?>

                            </div>

                            <div class="col-3 form-group">
                                <?php echo e(Form::label('project_id', __('Project'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::select('project_id', $projects, null, ['class' => 'form-control select2', 'required' => 'required'])); ?>

                            </div>

                            <div class="col-3 form-group">
                                <?php echo e(Form::label('type_id', __('Type'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::select('type_id', $types, null, ['class' => 'form-control select2', 'required' => 'required'])); ?>

                            </div>

                            <div class="col-3 form-group">
                                <?php echo e(Form::label('department_id', __('Department'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::select('department_id', $departments, null, ['class' => 'form-control select2', 'required' => 'required'])); ?>

                            </div>

                            <div class="col-3 form-group">
                                <?php echo e(Form::label('requester_id', __('Requester'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::select('requester_id', $requesters, null, ['class' => 'form-control select2', 'required' => 'required'])); ?>

                            </div>

                            <div class="col-3 form-group">
                                <?php echo e(Form::label('sales_person_id', __('Sales Person'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::select('sales_person_id', $salesPersons, null, ['class' => 'form-control select2', 'required' => 'required'])); ?>

                            </div>

                            <div class="col-3 form-group">
                                <?php echo e(Form::label('invoice_no', __('Invoice No.'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::text('invoice_no', null, ['class' => 'form-control', 'required' => 'required'])); ?>

                            </div>
                        </div>

                        <div class="row mt-4">
                            <!-- Item Selection -->
                            <div class="col-12 form-group">
                                <?php echo e(Form::label('item_dropdown', __('Item'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::select('item_dropdown', $items, null, ['class' => 'form-control select2', 'placeholder' => __('Select Item')])); ?>

                            </div>

                            <!-- Items Table Section -->
                            <div class="col-lg-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(__('Item')); ?></th>
                                            <th><?php echo e(__('Warehouse Name')); ?></th>
                                            <th><?php echo e(__('Available Quantity')); ?></th>
                                            <th><?php echo e(__('Quantity')); ?></th>
                                            <th><?php echo e(__('Sale Price')); ?></th>
                                            <th><?php echo e(__('Subtotal')); ?></th>
                                            <th><?php echo e(__('Tax')); ?></th>
                                            <th><?php echo e(__('Discount (%)')); ?></th>
                                            <th><?php echo e(__('Discount (Amount)')); ?></th>
                                            <th><?php echo e(__('Shipping Fee')); ?></th>
                                            <th><?php echo e(__('Total Payment')); ?></th>
                                            <th><?php echo e(__('Settings')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?php echo e(Form::text('item', null, ['class' => 'form-control', 'readonly' => true])); ?></td>
                                            <td><?php echo e(Form::select('warehouse_name', $warehouses, null, ['class' => 'form-control select2'])); ?></td>
                                            <td><?php echo e(Form::text('available_quantity', null, ['class' => 'form-control', 'readonly' => true])); ?></td>
                                            <td><?php echo e(Form::number('quantity', null, ['class' => 'form-control', 'placeholder' => __('Quantity')])); ?></td>
                                            <td><?php echo e(Form::number('sale_price', null, ['class' => 'form-control', 'placeholder' => __('Sale Price'), 'step' => '0.01'])); ?></td>
                                            <td><?php echo e(Form::text('subtotal', null, ['class' => 'form-control', 'readonly' => true])); ?></td>
                                            <td><?php echo e(Form::select('tax', $taxes, null, ['class' => 'form-control'])); ?></td>
                                            <td><?php echo e(Form::number('discount_percentage', null, ['class' => 'form-control', 'placeholder' => __('%')])); ?></td>
                                            <td><?php echo e(Form::number('discount_amount', null, ['class' => 'form-control', 'readonly' => true])); ?></td>
                                            <td><?php echo e(Form::number('shipping_fee', null, ['class' => 'form-control', 'placeholder' => __('Shipping Fee')])); ?></td>
                                            <td><?php echo e(Form::text('total_payment', null, ['class' => 'form-control', 'readonly' => true])); ?></td>
                                            <td>
                                                <button type="button" class="btn btn-light settings-btn" onclick="calculateTotals()">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <!-- Total Summary Section -->
                            <div class="col-lg-4 offset-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo e(__('Total Summary')); ?></h5>
                                        <div class="mb-3">
                                            <label class="form-label"><strong><?php echo e(__('Subtotal:')); ?></strong></label>
                                            <?php echo e(Form::text('summary_subtotal', '0.00', ['class' => 'form-control', 'readonly' => true])); ?>

                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label"><strong><?php echo e(__('Total Discount:')); ?></strong></label>
                                            <?php echo e(Form::text('summary_discount', '0.00', ['class' => 'form-control', 'readonly' => true])); ?>

                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label"><strong><?php echo e(__('Shipping Fee:')); ?></strong></label>
                                            <?php echo e(Form::text('summary_shipping_fee', '0.00', ['class' => 'form-control', 'readonly' => true])); ?>

                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label"><strong><?php echo e(__('Total Payment:')); ?></strong></label>
                                            <?php echo e(Form::text('summary_total_payment', '0.00', ['class' => 'form-control', 'readonly' => true])); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Notes Section -->
                        <div class="row mt-3">
                            <div class="col-12">
                                <textarea name="notes" class="form-control" rows="3" placeholder="<?php echo e(__('Note')); ?>"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-light" data-bs-dismiss="modal">
                        <?php if(isset($stockExport)): ?>
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


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Soudi\ERPNBS\erpnbs\resources\views/stock_export/create.blade.php ENDPATH**/ ?>