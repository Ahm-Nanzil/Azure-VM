<?php if(isset($meeting)): ?>
    <?php echo e(Form::model($meeting, array('route' => ['deals.meeting.update', $deal->id, $meeting->id], 'method' => 'PUT', 'class' => 'modalForm'))); ?>

<?php else: ?>
    <?php echo e(Form::open(array('route' => ['deals.meeting.store', $id], 'class' => 'modalForm'))); ?>

<?php endif; ?>

<div class="modal-body">
    
    <?php
        $settings = \App\Models\Utility::settings();
    ?>
    <?php if($settings['ai_chatgpt_enable'] == 'on'): ?>
        <div class="text-end">
            <a href="#" data-size="md" class="btn btn-primary btn-icon btn-sm" data-ajax-popup-over="true" data-url="<?php echo e(route('generate', ['meeting'])); ?>"
               data-bs-placement="top" data-title="<?php echo e(__('Generate content with AI')); ?>">
                <i class="fas fa-robot"></i> <span><?php echo e(__('Generate with AI')); ?></span>
            </a>
        </div>
    <?php endif; ?>
    

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('members', __('Members'), ['class'=>'form-label'])); ?>

                <?php echo e(Form::select(
                    'members[]',
                    $members,
                    isset($meeting) ? (is_array($meeting->members) ? $meeting->members : json_decode($meeting->members, true)) : null,
                    ['class' => 'form-control select2', 'multiple' => '', 'id' => 'members-select', 'required' => 'required']
                )); ?>

            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('title', __('Meeting Title'), ['class'=>'form-label'])); ?>

                <?php echo e(Form::text('title', null, ['class'=>'form-control', 'placeholder' => __('Enter Meeting Title'), 'required' => 'required'])); ?>

            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('date', __('Meeting Date'), ['class'=>'form-label'])); ?>

                <?php echo e(Form::date('date', null, ['class' => 'form-control', 'required' => 'required','min' => \Carbon\Carbon::today()->toDateString()])); ?>

            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('time', __('Meeting Time'), ['class'=>'form-label'])); ?>

                <?php echo e(Form::time('time', null, ['class' => 'form-control timepicker', 'required' => 'required'])); ?>

            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('note', __('Meeting Note'), ['class'=>'form-label'])); ?>

                <?php echo e(Form::textarea('note', null, ['class'=>'form-control', 'placeholder' => __('Enter Meeting Note')])); ?>

            </div>
        </div>

        <?php if(isset($settings['google_calendar_enable']) && $settings['google_calendar_enable'] == 'on'): ?>
            <div class="form-group col-md-6">
                <?php echo e(Form::label('synchronize_type', __('Synchronize in Google Calendar?'), ['class'=>'form-label'])); ?>

                <div class="form-switch">
                    <input type="checkbox" class="form-check-input mt-2" name="synchronize_type" id="switch-shadow" value="google_calendar" <?php if(isset($meeting) && $meeting->synchronize_type == 'google_calendar'): ?> checked <?php endif; ?>>
                    <label class="form-check-label" for="switch-shadow"></label>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-light" data-bs-dismiss="modal">
    <?php if(isset($meeting)): ?>
        <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn btn-primary">
    <?php else: ?>
        <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn btn-primary">
    <?php endif; ?>
</div>

<?php echo e(Form::close()); ?>


<script>
    $('#date').daterangepicker({
        locale: { format: 'YYYY-MM-DD' },
        singleDatePicker: true,
    });
    $("#time").timepicker({
        icons: {
            up: 'ti ti-chevron-up',
            down: 'ti ti-chevron-down'
        }
    });
</script>
<?php /**PATH C:\xampp\htdocs\Soudi\ERPNBS\erpnbs\resources\views/deals/meeting.blade.php ENDPATH**/ ?>