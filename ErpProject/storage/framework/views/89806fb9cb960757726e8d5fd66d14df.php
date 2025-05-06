<div class="card sticky-top" style="top:30px">
    <div class="list-group list-group-flush" id="useradd-sidenav">
        <a href="<?php echo e(route('inventory-general.index')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((Request::route()->getName() == 'inventory-general.index' ) ? ' active' : ''); ?>"><?php echo e(__('General')); ?>

            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
        </a>
        <a href="<?php echo e(route('inventory.product-types')); ?>" class="list-group-item list-group-item-action border-0"><?php echo e(__('Product Types')); ?>

          <div class="float-end"><i class="ti ti-chevron-right"></i></div>
        </a>
        <a href="<?php echo e(route('inventory.product-categories')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((Request::route()->getName() == 'inventory.product-categories' ) ? ' active' : ''); ?>"><?php echo e(__('Product Categories')); ?>

            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
        </a>
        <a href="<?php echo e(route('product-unit.index')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((Request::route()->getName() == 'product-unit.index' ) ? ' active' : ''); ?>"><?php echo e(__('Unit')); ?><div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

        <a href="<?php echo e(route('inventory.colors')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((Request::route()->getName() == 'inventory.colors' ) ? ' active' : ''); ?>"><?php echo e(__('Colors')); ?>

            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
        </a>
        <a href="<?php echo e(route('inventory.model')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((Request::route()->getName() == 'inventory.model' ) ? ' active' : ''); ?>"><?php echo e(__('Models')); ?>

            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
        </a>
        <a href="<?php echo e(route('inventory.style')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((Request::route()->getName() == 'inventory.style' ) ? ' active' : ''); ?>"><?php echo e(__('Styles')); ?>

            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
        </a>
        <a href="<?php echo e(route('inventory.custom')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((Request::route()->getName() == 'inventory.custom' ) ? ' active' : ''); ?>"><?php echo e(__('Warehouse Custom Fields')); ?>

            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
        </a>
        <a href="<?php echo e(route('inventory.minmax')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((Request::route()->getName() == 'inventory.minmax' ) ? ' active' : ''); ?>"><?php echo e(__('Minimum, Maximum Inventory')); ?>

            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
        </a>
        <a href="<?php echo e(route('inventory.prefix')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((Request::route()->getName() == 'inventory.prefix' ) ? ' active' : ''); ?>"><?php echo e(__('Prefix Settings')); ?>

            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
        </a>
        <a href="<?php echo e(route('inventory.approval')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((Request::route()->getName() == 'inventory.approval' ) ? ' active' : ''); ?>"><?php echo e(__('Approval Settings')); ?>

            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
        </a>
        <a href="<?php echo e(route('inventory.permission')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((Request::route()->getName() == 'inventory.permission' ) ? ' active' : ''); ?>"><?php echo e(__('Permissions')); ?>

            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
        </a>
        <a href="<?php echo e(route('inventory.reset')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((Request::route()->getName() == 'inventory.reset' ) ? ' active' : ''); ?>"><?php echo e(__('Reset Data')); ?>

            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
        </a>
    </div>

</div>
<?php /**PATH C:\xampp\htdocs\Soudi\ERPNBS\erpnbs\resources\views/layouts/inventory_setup.blade.php ENDPATH**/ ?>