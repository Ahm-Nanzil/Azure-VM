<?php if(isset($view)): ?>
    <?php echo e(Form::model($view, array('route' => array('leads.visit.update', $lead->id, $view->id), 'method' => 'PUT','enctype' => 'multipart/form-data','class' => 'modalForm'))); ?>

<?php else: ?>
    <?php echo e(Form::open(array('route' => ['leads.visit.store',$lead->id],'enctype' => 'multipart/form-data','class' => 'modalForm'))); ?>

<?php endif; ?>
<div class="modal-body">
    <div class="row">
        <div class="col-12 form-group">
            <?php echo e(Form::label('title', __('Title'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('title', null, array('class' => 'form-control','required'=>'required'))); ?>

        </div>
        <div class="col-12 form-group">
            <?php echo e(Form::label('description', __('Description'),['class'=>'form-label'])); ?>

            <?php echo e(Form::textarea('description', null, array('class' => 'summernote-simple','id'=>'summernote'))); ?>


        </div>
        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('assigned_users', __('Assigned Users'), ['class'=>'form-label'])); ?>

                <?php echo e(Form::select(
                    'assigned_users[]',
                    $assignedUsers,  // Ensure this array is populated
                    isset($view) ? (is_array($view->assigned_users) ? $view->assigned_users : json_decode($view->assigned_users, true)) : null,
                    ['class' => 'form-control select2', 'multiple' => '', 'id' => 'assigned-users-select', 'required' => 'required']
                )); ?>

            </div>
        </div>

        <div class="col-6 form-group">
            <?php echo e(Form::label('date', __('Date'),['class'=>'form-label'])); ?>

            <?php echo e(Form::date('date', null, array('class' => 'form-control','required'=>'required','min' => \Carbon\Carbon::today()->toDateString()))); ?>

        </div>
        <div class="col-6 form-group">
            <?php echo e(Form::label('time', __('Time'),['class'=>'form-label'])); ?>

            <?php echo e(Form::time('time', null, array('class' => 'form-control','required'=>'required'))); ?>

        </div>
        <div class="col-6 form-group">
            <?php echo e(Form::label('location', __('Location'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('location', null, array('class' => 'form-control','required'=>'required'))); ?>

        </div>

        <div class="col-6 form-group">
            <?php echo e(Form::label('status', __('Status'),['class'=>'form-label'])); ?>

            <select class="form-control select2" name="status" id="choices-multiple2" required>
                <?php $__currentLoopData = $status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $st): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($key); ?>" <?php if(isset($view) && $view->status == $key): ?> selected <?php endif; ?>><?php echo e(__($st)); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="col-6 form-group">
            <label for="recurrence-toggle" class="form-label">
                <input type="checkbox" id="recurrence-toggle"> <?php echo e(__('Enable Recurrence')); ?>

            </label>
        </div>
        <input type="hidden" id="recurrence-status-hidden" name="recurrence_status" value="0">

        <div id="recurrence-fields" style="display: none;">

            <div class="col-6 form-group">
                <?php echo e(Form::label('recurrence', __('Recurrence'), ['class'=>'form-label'])); ?>

                <select class="form-control select2" name="recurrence" id="recurrence-dropdown" required>
                    <?php $__currentLoopData = $recurrances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $recurrance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key); ?>" <?php if(isset($view) && $view->recurrance == $key): ?> selected <?php endif; ?>>
                            <?php echo e(__($recurrance)); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="col-6 form-group">
                <?php echo e(Form::label('repeat_interval', __('Repeat Interval'), ['class'=>'form-label'])); ?>

                <?php echo e(Form::number('repeat_interval', null, ['class' => 'form-control', 'min' => 1])); ?>

            </div>

            <div class="col-6 form-group">
                <?php echo e(Form::label('end_recurrence', __('End Recurrence'), ['class'=>'form-label'])); ?>

                <?php echo e(Form::date('end_recurrence', null, ['class' => 'form-control','min' => \Carbon\Carbon::today()->toDateString()])); ?>

            </div>

            <div class="col-6 form-group">
                <?php echo e(Form::label('reminder', __('Reminder'),['class'=>'form-label'])); ?>

                <?php echo e(Form::time('reminder', null, array('class' => 'form-control'))); ?>

            </div>
        </div>
        <script>
            $(document).on('change', '#recurrence-toggle', function () {
                const recurrenceFields = $('#recurrence-fields');
                const hiddenInput = $('#recurrence-status-hidden');

                if ($(this).is(':checked')) {
                    recurrenceFields.show();
                    hiddenInput.val('1');
                } else {
                    recurrenceFields.hide();
                    hiddenInput.val('0');
                }
            });


        </script>


        <div class="col-6 form-group">
            <i class="fas fa-info-circle" data-bs-toggle="tooltip" title="<?php echo e(__('You can attach any files related to this visit')); ?>"></i>

            <?php echo e(Form::label('files', __('Files'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::file('files[]', ['class' => 'form-control', 'placeholder' => __('Files')])); ?>

        </div>


    </div>

</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <?php if(isset($view)): ?>
        <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn  btn-primary">
    <?php else: ?>
        <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
    <?php endif; ?>

</div>
<?php echo e(Form::close()); ?>



<script>
    $('#date').daterangepicker({
        locale: {format: 'YYYY-MM-DD'},
        singleDatePicker: true,
    });
    $("#time").timepicker({
        icons: {
            up: 'ti ti-chevron-up',
            down: 'ti ti-chevron-down'
        }
    });
</script>

<?php /**PATH C:\xampp\htdocs\Soudi\ERPNBS\erpnbs\resources\views/leads/view.blade.php ENDPATH**/ ?>