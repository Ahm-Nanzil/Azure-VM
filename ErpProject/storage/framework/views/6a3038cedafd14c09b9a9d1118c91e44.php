<?php if(isset($custom)): ?>
    <?php echo e(Form::model($custom, ['route' => ['inventory.custom.update', $custom->id], 'method' => 'PUT', 'class' => 'modalForm'])); ?>

<?php else: ?>
    <?php echo e(Form::open(['route' => 'inventory.custom.store', 'class' => 'modalForm'])); ?>

<?php endif; ?>



<div class="modal-body">
    <div class="row">
        <div class="form-group col-12">
            <?php echo e(Form::label('field_id', __('Custom Field'), ['class'=>'form-label'])); ?>

            <?php echo e(Form::select(
                'field_id',
                $fields,
                isset($custom) ? $custom->field : null, // Pass the correct value for editing
                ['class' => 'form-control select2', 'required' => 'required']
            )); ?>

        </div>
        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('warhouse', __('Warhouse Name'), ['class'=>'form-label'])); ?>

                <?php echo e(Form::select(
                    'warehouses[]',
                    $warhouses,  // Ensure this array is populated
                    isset($custom) ? (is_array($custom->warhouses) ? $custom->warhouses : json_decode($custom->warhouses, true)) : null,
                    ['class' => 'form-control select2', 'multiple' => '', 'id' => 'warhouses-select', 'required' => 'required']
                )); ?>

            </div>
        </div>
    </div>


</div>

<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Close')); ?>" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(isset($custom) ? __('Update') : __('Save')); ?>" class="btn btn-primary">
</div>

<?php echo e(Form::close()); ?>

<?php /**PATH C:\xampp\htdocs\Soudi\ERPNBS\erpnbs\resources\views/inventorySetup/customCU.blade.php ENDPATH**/ ?>