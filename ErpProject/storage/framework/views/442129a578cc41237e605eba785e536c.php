<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Estimate ')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>


<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <?php if(isset($estimate)): ?>
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
                    <?php if(isset($estimate)): ?>
                        <?php echo e(Form::model($estimate, array('route' => array('quotations.update', $estimate->id), 'method' => 'PUT', 'enctype' => 'multipart/form-data', 'class' => 'modalForm'))); ?>

                    <?php else: ?>
                        <?php echo e(Form::open(array('route' => ['quotations.store'], 'enctype' => 'multipart/form-data', 'class' => 'modalForm'))); ?>

                    <?php endif; ?>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 form-group">
                                <?php echo e(Form::label('vendor_id', __('Vendors'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::select('vendor_id', $vendors, null, ['class' => 'form-control select2', 'required' => 'required'])); ?>

                            </div>

                            <div class="col-12 form-group">
                                <?php echo e(Form::label('purchase_request_id', __('Purchase Request'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::select('purchase_request_id', $purchaseRequests, null, ['class' => 'form-control select2', 'required' => 'required'])); ?>

                            </div>

                            <div class="col-6 form-group">
                                <?php echo e(Form::label('estimate_number', __('Estimate Number'), ['class' => 'form-label'])); ?>

                                <div class="input-group">
                                    <span class="input-group-text">EST</span>
                                    <?php echo e(Form::text('estimate_number', null, ['class' => 'form-control', 'required' => 'required'])); ?>

                                </div>
                            </div>

                            <div class="col-6 form-group">
                                <?php echo e(Form::label('buyer_id', __('Buyer'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::select('buyer_id', $buyers, null, ['class' => 'form-control select2', 'required' => 'required'])); ?>

                            </div>

                            <div class="col-3 form-group">
                                <?php echo e(Form::label('currency', __('Currency'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::select('currency', $currencies, null, ['class' => 'form-control select2', 'required' => 'required'])); ?>

                            </div>

                            <div class="col-3 form-group">
                                <?php echo e(Form::label('estimate_date', __('Estimate Date'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::date('estimate_date', null, ['class' => 'form-control', 'required' => 'required'])); ?>

                            </div>

                            <div class="col-3 form-group">
                                <?php echo e(Form::label('expiry_date', __('Expiry Date'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::date('expiry_date', null, ['class' => 'form-control', 'required' => 'required'])); ?>

                            </div>

                            <div class="col-3 form-group">
                                <?php echo e(Form::label('discount_type', __('Discount Type'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::select('discount_type', ['before_tax' => 'Before Tax', 'after_tax' => 'After Tax'], null, ['class' => 'form-control select2', 'required' => 'required'])); ?>

                            </div>
                        </div>


                    </div>

                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="form-group">
                                <?php echo e(Form::label('item_select', __('Select Item'))); ?>

                                <select class="form-control select2" id="itemDropdown">
                                    <option value=""><?php echo e(__('Select Item')); ?></option>
                                    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($item->id); ?>" data-name="<?php echo e($item->name); ?>" data-price="<?php echo e($item->sale_price ?? ''); ?>">
                                            <?php echo e($item->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="table-responsive">
                                <table class="table" id="itemsTable">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(__('Item')); ?></th>
                                            <th><?php echo e(__('Unit Price (USD)')); ?></th>
                                            <th><?php echo e(__('Quantity')); ?></th>
                                            <th><?php echo e(__('Subtotal (before tax) (USD)')); ?></th>
                                            <th><?php echo e(__('Tax')); ?></th>
                                            <th><?php echo e(__('Tax Value (USD)')); ?></th>
                                            <th><?php echo e(__('Subtotal (after tax) (USD)')); ?></th>
                                            <th><?php echo e(__('Discount (%)')); ?></th>
                                            <th><?php echo e(__('Discount (money) (USD)')); ?></th>
                                            <th><?php echo e(__('Total (USD)')); ?></th>
                                            <th><?php echo e(__('Settings')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr id="newItemRow">
                                            <td><?php echo e(Form::text('item_name', null, ['class' => 'form-control', 'id' => 'itemName', 'readonly' => 'readonly'])); ?></td>
                                            <td><?php echo e(Form::text('unit_price', null, ['class' => 'form-control', 'id' => 'itemPrice'])); ?></td>
                                            <td><?php echo e(Form::text('quantity', null, ['class' => 'form-control', 'id' => 'itemQuantity'])); ?></td>
                                            <td><input type="text" class="form-control" id="itemSubtotalBeforeTax" value="0" readonly></td>
                                            <td><?php echo e(Form::select('tax', ['No Tax' => __('No Tax'), '10%' => '10%'], null, ['class' => 'form-control', 'id' => 'itemTax'])); ?></td>
                                            <td><?php echo e(Form::text('tax_value', null, ['class' => 'form-control', 'id' => 'itemTaxValue', 'readonly' => 'readonly'])); ?></td>
                                            <td><input type="text" class="form-control" id="itemSubtotalAfterTax" readonly></td>
                                            <td><?php echo e(Form::text('discount_percentage', null, ['class' => 'form-control', 'id' => 'itemDiscountPercentage'])); ?></td>
                                            <td><?php echo e(Form::text('discount_money', null, ['class' => 'form-control', 'id' => 'itemDiscountMoney', 'readonly' => 'readonly'])); ?></td>
                                            <td><input type="text" class="form-control" id="itemTotal" readonly></td>
                                            <td>
                                                <button type="button" class="btn btn-light settings-btn" id="addItemBtn">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label><?php echo e(__('Subtotal')); ?></label>
                                    <input type="text" class="form-control" id="subtotalDisplay" value="0.00" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label><?php echo e(__('Total Discount')); ?></label>
                                    <input type="text" class="form-control" id="totalDiscountDisplay" value="0.00" readonly>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label><?php echo e(__('Shipping Fee')); ?></label>
                                    <input type="text" class="form-control" id="shippingFee" value="0" oninput="updateGrandTotal()">
                                </div>
                                <div class="col-md-6">
                                    <label><?php echo e(__('Grand Total')); ?></label>
                                    <input type="text" class="form-control" id="grandTotalDisplay" value="0.00" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                        let items = <?php echo json_encode($items, 15, 512) ?>;
                        let itemsData = [];

                        document.getElementById('itemDropdown').addEventListener('change', function() {
                            let selectedItem = items.find(item => item.id == this.value) || {};
                            document.getElementById('itemName').value = selectedItem.name || '';
                            document.getElementById('itemPrice').value = selectedItem.sale_price || 0;
                        });

                        document.getElementById('addItemBtn').addEventListener('click', function() {
                            let name = document.getElementById('itemName').value;
                            let price = parseFloat(document.getElementById('itemPrice').value) || 0;
                            let quantity = parseInt(document.getElementById('itemQuantity').value) || 1;
                            let taxRate = document.getElementById('itemTax').value === '10%' ? 0.1 : 0;
                            let taxValue = price * quantity * taxRate;
                            let subtotalBeforeTax = price * quantity;
                            let subtotalAfterTax = subtotalBeforeTax + taxValue;
                            let discountPercentage = parseFloat(document.getElementById('itemDiscountPercentage').value) || 0;
                            let discountMoney = (subtotalAfterTax * discountPercentage) / 100;
                            let total = subtotalAfterTax - discountMoney;

                            let itemData = {
                                item_id: document.getElementById('itemDropdown').value,
                                name: name,
                                unit_price: price,
                                quantity: quantity,
                                tax_rate: taxRate,
                                tax_value: taxValue,
                                subtotal_before_tax: subtotalBeforeTax,
                                subtotal_after_tax: subtotalAfterTax,
                                discount_percentage: discountPercentage,
                                discount_money: discountMoney,
                                total: total
                            };

                            itemsData.push(itemData);

                            let newRow = `<tr data-index="${itemsData.length - 1}">
                                <td>${name}</td>
                                <td>${price.toFixed(2)}</td>
                                <td>${quantity}</td>
                                <td>${subtotalBeforeTax.toFixed(2)}</td>
                                <td>${taxRate ? '10%' : 'No Tax'}</td>
                                <td>${taxValue.toFixed(2)}</td>
                                <td>${subtotalAfterTax.toFixed(2)}</td>
                                <td>${discountPercentage}</td>
                                <td>${discountMoney.toFixed(2)}</td>
                                <td>${total.toFixed(2)}</td>
                                <td><button type="button" class="btn btn-danger delete-btn"><i class="fas fa-trash"></i></button></td>
                            </tr>`;

                            document.querySelector('#itemsTable tbody').insertAdjacentHTML('beforeend', newRow);
                            updateTotals();
                            clearItemForm();
                        });

                        function clearItemForm() {
                            document.getElementById('itemDropdown').value = '';
                            document.getElementById('itemName').value = '';
                            document.getElementById('itemPrice').value = '';
                            document.getElementById('itemQuantity').value = '';
                            document.getElementById('itemTax').value = 'No Tax';
                            document.getElementById('itemDiscountPercentage').value = '';
                        }

                        document.querySelector('#itemsTable tbody').addEventListener('click', function(event) {
                            if (event.target.closest('.delete-btn')) {
                                let row = event.target.closest('tr');
                                let index = row.getAttribute('data-index');
                                itemsData.splice(index, 1);
                                row.remove();
                                updateTotals();
                                // Update remaining rows' indices
                                document.querySelectorAll('#itemsTable tbody tr:not(#newItemRow)').forEach((row, idx) => {
                                    row.setAttribute('data-index', idx);
                                });
                            }
                        });

                        function updateTotals() {
                            let subtotal = 0, totalDiscount = 0, grandTotal = 0;
                            itemsData.forEach(item => {
                                subtotal += item.subtotal_before_tax;
                                totalDiscount += item.discount_money;
                                grandTotal += item.total;
                            });

                            let shippingFee = parseFloat(document.getElementById('shippingFee').value) || 0;
                            grandTotal += shippingFee;

                            document.getElementById('subtotalDisplay').value = subtotal.toFixed(2);
                            document.getElementById('totalDiscountDisplay').value = totalDiscount.toFixed(2);
                            document.getElementById('grandTotalDisplay').value = grandTotal.toFixed(2);
                        }

                        // Add hidden input for items data before form submission
                        document.querySelector('.modalForm').addEventListener('submit', function(e) {
                            e.preventDefault();
                            let itemsInput = document.createElement('input');
                            itemsInput.type = 'hidden';
                            itemsInput.name = 'items';
                            itemsInput.value = JSON.stringify(itemsData);
                            this.appendChild(itemsInput);
                            this.submit();
                        });

                        // Update grand total when shipping fee changes
                        document.getElementById('shippingFee').addEventListener('input', updateTotals);
                    });
                    </script>

                    <div class="col-12 form-group">
                        <?php echo e(Form::label('vendor_note', __('Vendor Note'), ['class' => 'form-label'])); ?>

                        <?php echo e(Form::textarea('vendor_note', null, ['class' => 'form-control', 'rows' => 3])); ?>

                    </div>

                    <div class="col-12 form-group">
                        <?php echo e(Form::label('terms_conditions', __('Terms & Conditions'), ['class' => 'form-label'])); ?>

                        <?php echo e(Form::textarea('terms_conditions', null, ['class' => 'form-control', 'rows' => 3])); ?>

                    </div>


                    <div class="modal-footer">
                        <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-light" data-bs-dismiss="modal">
                        <?php if(isset($estimate)): ?>
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


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Soudi\ERPNBS\erpnbs\Modules/Purchases\Resources/views/quotations/estimate.blade.php ENDPATH**/ ?>