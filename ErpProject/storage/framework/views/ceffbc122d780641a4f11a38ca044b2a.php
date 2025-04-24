<?php echo e(Form::model($warehouse, array('route' => array('warehouse.update', $warehouse->id), 'method' => 'PUT'))); ?>


<div class="modal-body">
    
    <?php
        $settings = \App\Models\Utility::settings();
    ?>
    <?php if($settings['ai_chatgpt_enable'] == 'on'): ?>
    <div class="text-end">
        <a href="#" data-size="md" class="btn btn-primary btn-icon btn-sm" data-ajax-popup-over="true" data-url="<?php echo e(route('generate',['warehouse'])); ?>"
           data-bs-placement="top" data-title="<?php echo e(__('Generate content with AI')); ?>">
            <i class="fas fa-robot"></i> <span><?php echo e(__('Generate with AI')); ?></span>
        </a>
    </div>
    <?php endif; ?>
    

    <div class="row">
        <!-- Name Field -->
        <div class="form-group col-md-12">
            <?php echo e(Form::label('name', __('Name'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('name', null, array('class' => 'form-control','required'=>'required'))); ?>

            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <small class="invalid-name" role="alert">
                <strong class="text-danger"><?php echo e($message); ?></strong>
            </small>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Address Field -->
        <div class="form-group col-md-12">
            <?php echo e(Form::label('address', __('Address'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::textarea('address', null, ['class' => 'form-control', 'rows' => 3])); ?>

        </div>

        <!-- City Field -->
        <div class="form-group col-md-6">
            <?php echo e(Form::label('city', __('City'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('city', null, ['class' => 'form-control'])); ?>

        </div>

        <!-- Zip Code Field -->
        <div class="form-group col-md-6">
            <?php echo e(Form::label('city_zip', __('Zip Code'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('city_zip', null, ['class' => 'form-control'])); ?>

        </div>

        <!-- Warehouse Code Field -->
        <div class="form-group col-md-6">
            <?php echo e(Form::label('code', __('Warehouse Code'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('code', null, ['class' => 'form-control'])); ?>

        </div>

        <!-- State Field -->
        <div class="form-group col-md-6">
            <?php echo e(Form::label('state', __('State'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('state', null, ['class' => 'form-control'])); ?>

        </div>

        <!-- Postal Code Field -->
        <div class="form-group col-md-6">
            <?php echo e(Form::label('postal_code', __('Postal Code'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('postal_code', null, ['class' => 'form-control'])); ?>

        </div>

        <!-- Staffs Field (Multi-select) -->
        <div class="form-group col-md-6">
            <?php echo e(Form::label('staffs', __('Assign to Staffs'), ['class' => 'form-label'])); ?>

            
            <?php echo e(Form::select('staffs[]', $staffs, json_decode($warehouse->staffs, true), ['class' => 'form-control select2', 'multiple' => '', 'id' => 'assigned-users-select', 'required' => 'required'])); ?>


        </div>

        <!-- Display Field (Checkbox) -->
        <div class="form-group col-md-6">
            <?php echo e(Form::label('display', __('Display'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::checkbox('display', 1, $warehouse->display, ['class' => 'form-check-input'])); ?>

        </div>

        <!-- Hide When Out of Stock Field (Checkbox) -->
        <div class="form-group col-md-6">
            <?php echo e(Form::label('hide_when_out_of_stock', __('Hide When Out of Stock'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::checkbox('hide_when_out_of_stock', 1, $warehouse->hide_when_out_of_stock, ['class' => 'form-check-input'])); ?>

        </div>

        <!-- Note Field -->
        <div class="form-group col-md-12">
            <?php echo e(Form::label('note', __('Note'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::textarea('note', null, ['class' => 'form-control', 'rows' => 3])); ?>

        </div>
    </div>
</div>

<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Edit')); ?>" class="btn btn-primary">
</div>

<?php echo e(Form::close()); ?>

<?php /**PATH C:\xampp\htdocs\Soudi\ERPNBS\erpnbs\resources\views/warehouse/edit.blade.php ENDPATH**/ ?>