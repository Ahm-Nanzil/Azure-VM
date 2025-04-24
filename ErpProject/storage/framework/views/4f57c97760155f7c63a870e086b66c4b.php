<?php if(isset($color)): ?>
    <?php echo e(Form::model($color, array('route' => array('inventory.colors.update',$color->id), 'method' => 'PUT','class' => 'modalForm'))); ?>

<?php else: ?>
    <?php echo e(Form::open(array('route' => ['inventory.colors.store'], 'class' => 'modalForm'))); ?>

<?php endif; ?>
<div class="modal-body">
    <div class="row">
        <!-- Color Code -->
        <div class="col-12 form-group">
            <?php echo e(Form::label('color_code', __('Color Code'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('color_code', null, ['class' => 'form-control', 'required' => true])); ?>

        </div>

        <!-- Color Name -->
        <div class="col-12 form-group">
            <?php echo e(Form::label('color_name', __('Color Name'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('color_name', null, ['class' => 'form-control', 'required' => true])); ?>

        </div>

        <!-- Color Hex -->
        <div class="col-12 form-group">
            <?php echo e(Form::label('color_hex', __('Color Hex'), ['class' => 'form-label'])); ?>

            <div class="input-group">
                <?php echo e(Form::text('color_hex', null, ['class' => 'form-control', 'required' => true, 'id' => 'color-hex-input'])); ?>

                <span class="input-group-text">
                    <input type="color" id="color-picker" value="#ffffff" onchange="document.getElementById('color-hex-input').value = this.value">
                </span>
            </div>
        </div>

        <!-- Order -->
        <div class="col-12 form-group">
            <?php echo e(Form::label('order', __('Order'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::number('order', null, ['class' => 'form-control', 'required' => true])); ?>

        </div>

        <!-- Note -->
        <div class="col-12 form-group">
            <?php echo e(Form::label('note', __('Note'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::textarea('note', null, ['class' => 'form-control', 'rows' => 3])); ?>

        </div>

        <!-- Display (Checklist) -->
        <div class="col-12 form-group">
            <?php echo e(Form::label('display', __('Display'), ['class' => 'form-label'])); ?>

            <div class="form-check">
                <?php echo e(Form::checkbox('display', 1, false, ['class' => 'form-check-input', 'id' => 'display-check'])); ?>

                <label class="form-check-label" for="display-check"><?php echo e(__('Enable Display')); ?></label>
            </div>
        </div>
    </div>
</div>

<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Save')); ?>" class="btn btn-primary">
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH C:\xampp\htdocs\Soudi\ERPNBS\erpnbs\resources\views/inventorySetup/colorsCU.blade.php ENDPATH**/ ?>