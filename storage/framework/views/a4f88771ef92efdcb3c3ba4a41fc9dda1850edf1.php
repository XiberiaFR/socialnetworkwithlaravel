

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="card">
                <div class="card-header"><?php echo e(__('Bonjour')); ?> <?php echo e($user->prenom); ?> <?php echo e($user->nom); ?></div>
                <div class="card-body">
                <p><?php echo e(__('Votre pomgoname :')); ?> <?php echo e($user->pomgoname); ?></p>
                <p><?php echo e(__('Votre email :')); ?> <?php echo e($user->email); ?></p>
                <p><?php echo e(__('Votre mot de passe : •••••••••••')); ?></p>
                </div>

            </div>
            <a href="<?php echo e(route('user.edit', $user)); ?>" class="mt-3 btn btn-primary">
            <?php echo e(__('Modifier mes informations')); ?>

            </a>
        </div>
    </div>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\socialnetworkwithlaravel\resources\views/user/account.blade.php ENDPATH**/ ?>