<?php if(isset($vendorItem)): ?>
    <?php echo e(Form::model($vendorItem, array('route' => array('vendor_items.update', $vendorItem->id), 'method' => 'PUT','class' => 'modalForm'))); ?>

<?php else: ?>
    <?php echo e(Form::open(array('route' => ['vendor_items.store'], 'class' => 'modalForm'))); ?>

<?php endif; ?>

<div class="modal-body">
    <div class="row">
        <div class="col-12 form-group">
            <?php echo e(Form::label('vendor', __('Vendor'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::select('vendor', $vendors, null, ['class' => 'form-control select2', 'required' => 'required', 'data-live-search' => 'true', 'data-none-selected-text' => __('Select Vendor')])); ?>

        </div>

        <div class="col-12 form-group">
            <?php echo e(Form::label('categories', __('Group Items'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::select('categories', $groups, null, ['class' => 'form-control select2', 'required' => 'required', 'data-live-search' => 'true', 'data-none-selected-text' => __('Select Group')])); ?>

        </div>

        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('products', __('Products'), ['class'=>'form-label'])); ?>

                <?php echo e(Form::select(
                    'products[]',
                    $products,
                    isset($vendorItem) ? (is_array($vendorItem->products) ? $vendorItem->products : json_decode($vendorItem->products, true)) : null,
                    ['class' => 'form-control select2', 'multiple' => '', 'id' => 'products-select', 'required' => 'required']
                )); ?>

            </div>
        </div>



    </div>
</div>

<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-light" data-bs-dismiss="modal">
    <?php if(isset($vendorItem)): ?>
        <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn btn-primary">
    <?php else: ?>
        <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn btn-primary">
    <?php endif; ?>
</div>

<?php echo e(Form::close()); ?>

<?php /**PATH C:\xampp\htdocs\Soudi\ERPNBS\erpnbs\Modules/Purchases\Resources/views/vendor_items/item.blade.php ENDPATH**/ ?>