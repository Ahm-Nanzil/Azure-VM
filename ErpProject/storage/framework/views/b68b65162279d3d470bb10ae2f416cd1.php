<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Purchase Request')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>


<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <?php if(isset($purchaseRequest)): ?>
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
                    <?php if(isset($purchaseRequest)): ?>
                        <?php echo e(Form::model($purchaseRequest, array('route' => array('purchase_request.update', $purchaseRequest->id), 'method' => 'PUT', 'enctype' => 'multipart/form-data', 'class' => 'modalForm'))); ?>

                    <?php else: ?>
                        <?php echo e(Form::open(array('route' => ['purchase_request.store'], 'enctype' => 'multipart/form-data', 'class' => 'modalForm'))); ?>

                    <?php endif; ?>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 form-group">
                                <?php echo e(Form::label('purchase_request_code', __('Purchase Request Code'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::text('purchase_request_code', $purchaseRequestCode, ['class' => 'form-control', 'readonly' => 'readonly'])); ?>

                            </div>

                            <div class="col-12 form-group">
                                <?php echo e(Form::label('purchase_request_name', __('Purchase Request Name'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::text('purchase_request_name', null, ['class' => 'form-control', 'required' => 'required'])); ?>

                            </div>

                            <div class="col-3 form-group">
                                <?php echo e(Form::label('project_id', __('Project'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::select('project_id', $projects, null, ['class' => 'form-control select2', 'required' => 'required'])); ?>

                            </div>

                            <div class="col-3 form-group">
                                <?php echo e(Form::label('sale_estimate_id', __('Sale Estimate'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::select('sale_estimate_id', $saleEstimates, null, ['class' => 'form-control select2', 'required' => 'required'])); ?>

                            </div>

                            <div class="col-3 form-group">
                                <?php echo e(Form::label('type_id', __('Type'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::select('type_id', $types, null, ['class' => 'form-control select2', 'required' => 'required'])); ?>

                            </div>

                            <div class="col-3 form-group">
                                <?php echo e(Form::label('currency', __('Currency'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::select('currency', $currencies, null, ['class' => 'form-control select2', 'required' => 'required'])); ?>

                            </div>

                            <div class="col-3 form-group">
                                <?php echo e(Form::label('department_id', __('Department'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::select('department_id', $departments, null, ['class' => 'form-control select2', 'required' => 'required'])); ?>

                            </div>

                            <div class="col-3 form-group">
                                <?php echo e(Form::label('sale_invoice_id', __('Sale Invoices'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::select('sale_invoice_id', $saleInvoices, null, ['class' => 'form-control select2', 'required' => 'required'])); ?>

                            </div>

                            <div class="col-3 form-group">
                                <?php echo e(Form::label('requester_id', __('Requester'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::select('requester_id', $requesters, null, ['class' => 'form-control select2', 'required' => 'required'])); ?>

                            </div>

                            <div class="col-3 form-group">
                                <?php echo e(Form::label('vendor_id', __('Share to Vendors'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::select('vendor_id', $vendors, null, ['class' => 'form-control select2', 'required' => 'required'])); ?>

                            </div>

                            <div class="col-12 form-group">
                                <?php echo e(Form::label('description', __('Description'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3])); ?>

                            </div>
                        </div>
                    </div>

                    <?php if(!isset($purchaseRequest)): ?>

                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="form-group">
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
                            </div>
                            <div class="table-responsive">
                                <table class="table" id="itemsTable">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(__('Item')); ?></th>
                                            <th><?php echo e(__('Unit Price (USD)')); ?></th>
                                            <th><?php echo e(__('Quantity')); ?></th>
                                            <th><?php echo e(__('Subtotal (USD)')); ?></th>
                                            <th><?php echo e(__('Tax')); ?></th>
                                            <th><?php echo e(__('Tax Value (USD)')); ?></th>
                                            <th><?php echo e(__('Total (USD)')); ?></th>
                                            <th><?php echo e(__('Settings')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr id="newItemRow">
                                            <td><?php echo e(Form::text('item_name', null, ['class' => 'form-control', 'id' => 'itemName', 'readonly' => 'readonly'])); ?></td>
                                            <td><?php echo e(Form::text('unit_price', null, ['class' => 'form-control', 'id' => 'itemPrice'])); ?></td>
                                            <td><?php echo e(Form::text('quantity', null, ['class' => 'form-control', 'id' => 'itemQuantity'])); ?></td>
                                            <td><input type="text" class="form-control" id="itemSubtotal" value="0" readonly></td>
                                            <td><?php echo e(Form::select('tax', ['No Tax' => __('No Tax')], null, ['class' => 'form-control', 'id' => 'itemTax'])); ?></td>
                                            <td><?php echo e(Form::text('tax_value', null, ['class' => 'form-control', 'id' => 'itemTaxValue', 'readonly' => 'readonly'])); ?></td>
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
                                    <label><?php echo e(__('Total')); ?></label>
                                    <input type="text" class="form-control" id="totalDisplay" value="0.00" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>


                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                                let items = <?php echo json_encode($items, 15, 512) ?>;

                                document.getElementById('itemDropdown').addEventListener('change', function() {
                                    let selectedItem = items.find(item => item.id == this.value) || {};
                                    document.getElementById('itemName').value = selectedItem.name || '';
                                    document.getElementById('itemPrice').value = selectedItem.sale_price || 0;
                                });

                                document.getElementById('addItemBtn').addEventListener('click', function() {
                                    let name = document.getElementById('itemName').value;
                                    let price = parseFloat(document.getElementById('itemPrice').value) || 0;
                                    let quantity = parseInt(document.getElementById('itemQuantity').value) || 1;
                                    let tax = document.getElementById('itemTax').value;
                                    let taxValue = tax === 'No Tax' ? 0 : (price * quantity * 0.1);
                                    let subtotal = price * quantity;
                                    let total = subtotal + taxValue;
                                    let itemId = document.getElementById('itemDropdown').value;

                                    if (!name || !itemId) {
                                        alert('Please select a valid item.');
                                        return;
                                    }

                                    let newRow = `<tr>
                                        <td>${name}</td>
                                        <td>${price.toFixed(2)}</td>
                                        <td>${quantity}</td>
                                        <td>${subtotal.toFixed(2)}</td>
                                        <td>${tax}</td>
                                        <td>${taxValue.toFixed(2)}</td>
                                        <td>${total.toFixed(2)}</td>
                                        <td><button type="button" class="btn btn-danger delete-btn"><i class="fas fa-trash"></i></button></td>
                                        <input type="hidden" name="items[${itemId}][id]" value="${itemId}">
                                        <input type="hidden" name="items[${itemId}][name]" value="${name}">
                                        <input type="hidden" name="items[${itemId}][price]" value="${price}">
                                        <input type="hidden" name="items[${itemId}][quantity]" value="${quantity}">
                                        <input type="hidden" name="items[${itemId}][subtotal]" value="${subtotal}">
                                        <input type="hidden" name="items[${itemId}][tax]" value="${tax}">
                                        <input type="hidden" name="items[${itemId}][tax_value]" value="${taxValue}">
                                        <input type="hidden" name="items[${itemId}][total]" value="${total}">
                                    </tr>`;

                                    document.querySelector('#itemsTable tbody').insertAdjacentHTML('beforeend', newRow);
                                    updateTotals();
                                });

                                document.querySelector('#itemsTable').addEventListener('click', function(event) {
                                    if (event.target.closest('.delete-btn')) {
                                        event.target.closest('tr').remove();
                                        updateTotals();
                                    }
                                });

                                function updateTotals() {
                                    let subtotal = 0;
                                    let total = 0;
                                    document.querySelectorAll('#itemsTable tbody tr:not(#newItemRow)').forEach(row => {
                                        let subtotalCell = parseFloat(row.cells[3].innerText) || 0;
                                        let totalCell = parseFloat(row.cells[6].innerText) || 0;
                                        subtotal += subtotalCell;
                                        total += totalCell;
                                    });
                                    document.getElementById('subtotalDisplay').value = subtotal.toFixed(2);
                                    document.getElementById('totalDisplay').value = total.toFixed(2);
                                }
                            });

                    </script>

                    <div class="modal-footer">
                        <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-light" data-bs-dismiss="modal">
                        <?php if(isset($purchaseRequest)): ?>
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


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Soudi\ERPNBS\erpnbs\Modules/Purchases\Resources/views/purchase_request/purchase.blade.php ENDPATH**/ ?>