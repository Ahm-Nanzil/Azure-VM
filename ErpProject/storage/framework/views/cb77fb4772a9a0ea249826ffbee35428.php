<?php if(isset($approval)): ?>
<?php echo e(Form::model($approval, array('route' => array('inventory.approval.create', $approval->id), 'method' => 'PUT', 'class' => 'modalForm'))); ?>

<?php else: ?>
<?php echo e(Form::open(array('route' => ['inventory.approval.create'], 'class' => 'modalForm'))); ?>

<?php endif; ?>
<div class="modal-body">
<div class="row">
    <!-- Subject -->
    <div class="col-12 form-group">
        <?php echo e(Form::label('subject', __('Subject'), ['class' => 'form-label'])); ?>

        <?php echo e(Form::text('subject', null, ['class' => 'form-control', 'required' => true])); ?>

    </div>

    <!-- Related -->
    <div class="col-12 form-group">
        <?php echo e(Form::label('related', __('Related'), ['class' => 'form-label'])); ?>

        <?php echo e(Form::select('related', $relatedOptions, null, ['class' => 'form-control', 'placeholder' => __('Select Related'), 'required' => true])); ?>

    </div>

    <!-- Staff and Action -->
    <div class="col-12 form-group">
        <?php echo e(Form::label('staff_action', __('Staff and Actions'), ['class' => 'form-label'])); ?>

        <div id="staff-action-container">
            <div class="row mb-2 align-items-end">
                <div class="col-md-6">
                    <?php echo e(Form::label('staff[]', __('Staff'), ['class' => 'form-label'])); ?>

                    <?php echo e(Form::select('staff[]', $staffOptions, null, ['class' => 'form-control', 'placeholder' => __('Select Staff'), 'required' => true])); ?>

                </div>
                <div class="col-md-5">
                    <?php echo e(Form::label('action[]', __('Action'), ['class' => 'form-label'])); ?>

                    <?php echo e(Form::select('action[]', $actionOptions, null, ['class' => 'form-control', 'placeholder' => __('Select Action'), 'required' => true])); ?>

                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-success add-row">+</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="modal-footer">
<input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-light" data-bs-dismiss="modal">
<input type="submit" value="<?php echo e(__('Save')); ?>" class="btn btn-primary">
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH C:\xampp\htdocs\Soudi\ERPNBS\erpnbs\resources\views/inventorySetup/approvalCU.blade.php ENDPATH**/ ?>