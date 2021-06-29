

<?php $__env->startSection('content'); ?>
<div class="panel-heading">Profile</div><div class="panel-body">
    <?php echo e($pomgoname); ?>

</div>
<?php echo e(dd($pomgoname)); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\socialnetworkwithlaravel\resources\views/user/profile.blade.php ENDPATH**/ ?>