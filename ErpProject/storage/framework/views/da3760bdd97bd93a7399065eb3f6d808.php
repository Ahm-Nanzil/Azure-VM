<?php if(isset($productType)): ?>
    <?php echo e(Form::model($productType, ['route' => ['inventory.product-types.update', $productType->id], 'method' => 'PUT', 'class' => 'modalForm'])); ?>

<?php else: ?>
    <?php echo e(Form::open(['route' => 'inventory.product-types.store', 'class' => 'modalForm'])); ?>

<?php endif; ?>

<style>
    .table-excel .form-group {
        margin: 0;
    }
    .table-excel .form-control {
        border: none;
        border-radius: 0;
        padding: 5px 8px;
        height: 35px;
    }
    .table-excel td {
        padding: 0 !important;
    }
    .table-excel thead th {
        background-color: #f8f9fa;
        padding: 8px !important;
    }
    .table-excel .form-check-input {
        margin: 0;
        height: 35px;
    }
</style>

<div class="modal-body">
    <div class="table-responsive">
        <table class="table table-bordered table-excel">
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th width="25%"><?php echo e(__('Product type code')); ?></th>
                    <th width="30%"><?php echo e(__('Product type name')); ?></th>
                    <th width="20%"><?php echo e(__('Order')); ?></th>
                    <th width="10%"><?php echo e(__('Display')); ?></th>
                    <th width="10%"><?php echo e(__('Note')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($productType)): ?>
                    <tr>
                        <td class="text-center align-middle">1</td>
                        <td>
                            <?php echo e(Form::text("items[0][code]", $productType->code ?? '', [
                                'class' => 'form-control',
                            ])); ?>

                        </td>
                        <td>
                            <?php echo e(Form::text("items[0][name]", $productType->name ?? '', [
                                'class' => 'form-control',
                            ])); ?>

                        </td>
                        <td>
                            <?php echo e(Form::number("items[0][order]", $productType->order ?? '', [
                                'class' => 'form-control',
                                'min' => '1',
                            ])); ?>

                        </td>
                        <td class="text-center">
                            <?php echo e(Form::checkbox("items[0][display]", 1, $productType->display ?? true, [
                                'class' => 'form-check-input',
                            ])); ?>

                        </td>
                        <td>
                            <?php echo e(Form::text("items[0][note]", $productType->note ?? '', [
                                'class' => 'form-control',
                            ])); ?>

                        </td>
                    </tr>
                <?php else: ?>


                    <?php for($i = 0; $i < 9; $i++): ?>
                        <tr>
                            <td class="text-center align-middle"><?php echo e($i + 1); ?></td>
                            <td>
                                <?php echo e(Form::text("items[$i][code]", '', [
                                    'class' => 'form-control',
                                ])); ?>

                            </td>
                            <td>
                                <?php echo e(Form::text("items[$i][name]", '', [
                                    'class' => 'form-control',
                                ])); ?>

                            </td>
                            <td>
                                <?php echo e(Form::number("items[$i][order]", '', [
                                    'class' => 'form-control',
                                    'min' => '1',
                                ])); ?>

                            </td>
                            <td class="text-center">
                                <?php echo e(Form::checkbox("items[$i][display]", 1, true, [
                                    'class' => 'form-check-input',
                                ])); ?>

                            </td>
                            <td>
                                <?php echo e(Form::text("items[$i][note]", '', [
                                    'class' => 'form-control',
                                ])); ?>

                            </td>
                        </tr>
                    <?php endfor; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Close')); ?>" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(isset($productType) ? __('Update') : __('Save')); ?>" class="btn btn-primary">
</div>

<?php echo e(Form::close()); ?>

<?php /**PATH C:\xampp\htdocs\Soudi\ERPNBS\erpnbs\resources\views/inventorySetup/product-typesCU.blade.php ENDPATH**/ ?>