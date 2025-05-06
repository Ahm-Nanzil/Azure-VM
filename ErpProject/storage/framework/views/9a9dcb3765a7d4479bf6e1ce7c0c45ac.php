<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Inventory Packing List')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <?php if(isset($packing)): ?>
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
                <style>
                    #billToDisplay, #shipToDisplay {
                    padding: 10px;
                    background-color: #f8f9fa;
                    border: 1px solid #dee2e6;
                    border-radius: 4px;
                    }

                </style>
                <div class="card-body table-border-style">
                    <?php if(isset($packing)): ?>
                        <?php echo e(Form::model($packing, array('route' => array('inventory.packing-list.update', $packing->id), 'method' => 'post','enctype' => 'multipart/form-data','class' => 'modalForm'))); ?>

                    <?php else: ?>
                        <?php echo e(Form::open(array('route' => ['inventory.packing-list.store'], 'enctype' => 'multipart/form-data','class' => 'modalForm'))); ?>

                    <?php endif; ?>
                    <div class="modal-body">
                        <div class="row">
                            <!-- Stock Export -->
                            <div class="col-6 form-group">
                                <?php echo e(Form::label('stock_export', __('Stock Export'), ['class'=>'form-label'])); ?>

                                <?php echo e(Form::select('stock_export_id', $stockExports, null, ['class' => 'form-control select2', 'required' => 'required'])); ?>

                            </div>

                            <!-- Customer -->
                            <div class="col-6 form-group">
                                <?php echo e(Form::label('customer', __('Customer'), ['class'=>'form-label'])); ?>

                                <?php echo e(Form::select('customer_id', $customers, null, ['class' => 'form-control select2', 'required' => 'required'])); ?>

                            </div>
                        </div>

                        <div class="row">
                            <!-- Bill To -->
                            <div class="col-6 form-group">
                                <?php echo e(Form::label('bill_to', __('Bill To'), ['class'=>'form-label'])); ?>

                                <button type="button" class="btn btn-light btn-icon" data-bs-toggle="modal" data-bs-target="#billToModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <div id="billToDisplay" class="mt-2"><?php echo e(old('bill_to', $packing->bill_to ?? '')); ?></div> <!-- Display billing address here -->
                            </div>

                            <!-- Ship To -->
                            <div class="col-6 form-group">
                                <?php echo e(Form::label('ship_to', __('Ship To'), ['class'=>'form-label'])); ?>

                                <button type="button" class="btn btn-light btn-icon" data-bs-toggle="modal" data-bs-target="#shipToModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <div id="shipToDisplay" class="mt-2"><?php echo e(old('ship_to', $packing->ship_to ?? '')); ?></div> <!-- Display shipping address here -->
                            </div>

                            <?php echo e(Form::hidden('bill_to', null, ['id' => 'billToHidden'])); ?>

                            <?php echo e(Form::hidden('ship_to', null, ['id' => 'shipToHidden'])); ?>


                        </div>

                        <div class="row">
                            <!-- Packing List Number -->
                            <div class="col-6 form-group">
                                <?php echo e(Form::label('packing_list_number', __('Packing List Number'), ['class'=>'form-label'])); ?>

                                <?php echo e(Form::text('packing_list_number', $packingListNumber, ['class' => 'form-control'])); ?>

                            </div>
                        </div>

                        <div class="row">
                            <!-- Dimensions and Weight -->
                            <div class="col-3 form-group">
                                <?php echo e(Form::label('width', __('Width (m)'), ['class'=>'form-label'])); ?>

                                <?php echo e(Form::number('width', 0, ['class' => 'form-control'])); ?>

                            </div>

                            <div class="col-3 form-group">
                                <?php echo e(Form::label('height', __('Height (m)'), ['class'=>'form-label'])); ?>

                                <?php echo e(Form::number('height', 0, ['class' => 'form-control'])); ?>

                            </div>

                            <div class="col-3 form-group">
                                <?php echo e(Form::label('length', __('Length (m)'), ['class'=>'form-label'])); ?>

                                <?php echo e(Form::number('length', 0, ['class' => 'form-control'])); ?>

                            </div>

                            <div class="col-3 form-group">
                                <?php echo e(Form::label('weight', __('Weight (kg)'), ['class'=>'form-label'])); ?>

                                <?php echo e(Form::number('weight', 0, ['class' => 'form-control'])); ?>

                            </div>

                            <div class="col-3 form-group">
                                <?php echo e(Form::label('volume', __('Volume (m3)'), ['class'=>'form-label'])); ?>

                                <?php echo e(Form::number('volume', 0, ['class' => 'form-control'])); ?>

                            </div>
                        </div>

                        <!-- Client Note -->
                        <div class="row mt-3">
                            <div class="col-12">
                                <textarea name="client_note" class="form-control" rows="3" placeholder="<?php echo e(__('Client Note')); ?>"></textarea>
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
                                            <th><?php echo e(__('Shipping Fee')); ?></th>
                                            <th><?php echo e(__('Total Payment')); ?></th>
                                            <th><?php echo e(__('Settings')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?php echo e(Form::text('item_description[]', null, ['class' => 'form-control', 'placeholder' => __('Item Description')])); ?></td>

                                            
                                            <td><?php echo e(Form::number('quantity', null, ['class' => 'form-control', 'placeholder' => __('Quantity')])); ?></td>

                                            <td><?php echo e(Form::number('sale_price', null, ['class' => 'form-control', 'placeholder' => __('Sale Price'), 'step' => '0.01'])); ?></td>
                                            <td><?php echo e(Form::select('tax', $taxes, null, ['class' => 'form-control'])); ?></td>
                                            <td><?php echo e(Form::text('subtotal', null, ['class' => 'form-control', 'readonly' => true])); ?></td>

                                            
                                            
                                            
                                            
                                            <td><?php echo e(Form::number('discount_percentage', null, ['class' => 'form-control', 'placeholder' => __('%')])); ?></td>
                                            <td><?php echo e(Form::number('discount_amount', null, ['class' => 'form-control', 'readonly' => true])); ?></td>
                                            <td><?php echo e(Form::number('shipping_fee', null, ['class' => 'form-control', 'placeholder' => __('Shipping Fee')])); ?></td>
                                            <td><?php echo e(Form::text('total_payment', null, ['class' => 'form-control', 'readonly' => true])); ?></td>

                                            <td>
                                                <button type="button" class="btn btn-light settings-btn" onclick="calculateTotal()">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Total Section -->
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


                        <!-- Admin Note -->
                        <div class="row mt-3">
                            <div class="col-12">
                                <textarea name="admin_note" class="form-control" rows="3" placeholder="<?php echo e(__('Admin Note')); ?>"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-light" data-bs-dismiss="modal">
                        <?php if(isset($packing)): ?>
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
    <!-- Bill To Modal -->
    <div class="modal fade" id="billToModal" tabindex="-1" aria-labelledby="billToModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="billToModalLabel"><?php echo e(__('Billing Address')); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="billingAddress"><?php echo e(__('Address')); ?></label>
                        <textarea id="billingAddress" class="form-control" rows="3" placeholder="<?php echo e(__('Enter billing address')); ?>"></textarea>
                    </div>
                    <div class="form-group mt-3">
                        <label for="billingCity"><?php echo e(__('City')); ?></label>
                        <input id="billingCity" type="text" class="form-control" placeholder="<?php echo e(__('Enter city')); ?>">
                    </div>
                    <div class="form-group mt-3">
                        <label for="billingState"><?php echo e(__('State')); ?></label>
                        <input id="billingState" type="text" class="form-control" placeholder="<?php echo e(__('Enter state')); ?>">
                    </div>
                    <div class="form-group mt-3">
                        <label for="billingZip"><?php echo e(__('ZIP Code')); ?></label>
                        <input id="billingZip" type="text" class="form-control" placeholder="<?php echo e(__('Enter ZIP code')); ?>">
                    </div>
                    <div class="form-group mt-3">
                        <label for="billingCountry"><?php echo e(__('Country')); ?></label>
                        <select id="billingCountry" name="billing_country" class="form-control">
                            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($code); ?>"><?php echo e($name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
                    <button type="button" class="btn btn-primary" id="applyBilling"><?php echo e(__('Apply')); ?></button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="shipToModal" tabindex="-1" aria-labelledby="shipToModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="shipToModalLabel"><?php echo e(__('Shipping Address')); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="shippingAddress"><?php echo e(__('Address')); ?></label>
                        <textarea id="shippingAddress" class="form-control" rows="3" placeholder="<?php echo e(__('Enter shipping address')); ?>"></textarea>
                    </div>
                    <div class="form-group mt-3">
                        <label for="shippingCity"><?php echo e(__('City')); ?></label>
                        <input id="shippingCity" type="text" class="form-control" placeholder="<?php echo e(__('Enter city')); ?>">
                    </div>
                    <div class="form-group mt-3">
                        <label for="shippingState"><?php echo e(__('State')); ?></label>
                        <input id="shippingState" type="text" class="form-control" placeholder="<?php echo e(__('Enter state')); ?>">
                    </div>
                    <div class="form-group mt-3">
                        <label for="shippingZip"><?php echo e(__('ZIP Code')); ?></label>
                        <input id="shippingZip" type="text" class="form-control" placeholder="<?php echo e(__('Enter ZIP code')); ?>">
                    </div>
                    <div class="form-group mt-3">
                        <label for="shippingCountry"><?php echo e(__('Country')); ?></label>
                        <select id="shippingCountry" class="form-control">
                            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($code); ?>"><?php echo e($name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
                    <button type="button" class="btn btn-primary" id="applyShipping"><?php echo e(__('Apply')); ?></button>
                </div>
            </div>
        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Apply Billing Address
        document.getElementById('applyBilling').addEventListener('click', function () {
            const billingAddress = document.getElementById('billingAddress').value;
            const billingCity = document.getElementById('billingCity').value;
            const billingState = document.getElementById('billingState').value;
            const billingZip = document.getElementById('billingZip').value;
            const billingCountry = document.getElementById('billingCountry').selectedOptions[0].text;

            const formattedBilling = `${billingAddress}, ${billingCity}, ${billingState}, ${billingZip}, ${billingCountry}`;
            document.getElementById('billToHidden').value = formattedBilling;
            document.getElementById('billToDisplay').innerText = formattedBilling;

            const billingModal = bootstrap.Modal.getInstance(document.getElementById('billToModal'));
            billingModal.hide();
        });

        // Apply Shipping Address
        document.getElementById('applyShipping').addEventListener('click', function () {
            const shippingAddress = document.getElementById('shippingAddress').value;
            const shippingCity = document.getElementById('shippingCity').value;
            const shippingState = document.getElementById('shippingState').value;
            const shippingZip = document.getElementById('shippingZip').value;
            const shippingCountry = document.getElementById('shippingCountry').selectedOptions[0].text;

            const formattedShipping = `${shippingAddress}, ${shippingCity}, ${shippingState}, ${shippingZip}, ${shippingCountry}`;
            document.getElementById('shipToHidden').value = formattedShipping;
            document.getElementById('shipToDisplay').innerText = formattedShipping;

            const shippingModal = bootstrap.Modal.getInstance(document.getElementById('shipToModal'));
            shippingModal.hide();
        });
    });


</script>

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


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Soudi\ERPNBS\erpnbs\resources\views/packing_list/create.blade.php ENDPATH**/ ?>