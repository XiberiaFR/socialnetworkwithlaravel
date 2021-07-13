

<?php $__env->startSection('content'); ?>

<div class="container">
    <form action="<?php echo e(route('image.upload.post')); ?>" method="POST" enctype="multipart/form-data">

        <?php echo csrf_field(); ?>
        <div class="row">

            <div class="col-md-6">
                <?php if(session('image')): ?>
                <img src="<?php echo e(asset('images')); ?>/<?php echo e(session('image')); ?>" class="img-thumbnail" alt="">
                <?php else: ?>
                <img src="<?php echo e(asset('images')); ?>/<?php echo e($pomgo->image); ?>" class="img-thumbnail" alt="">
                <?php endif; ?>
                <input type="file" name="image" class="form-control">
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-success">Enregistrer l'image</button>
            </div>
        </div>
    </form>

    <form method="POST" action="<?php echo e(route('pomgo.update', $pomgo)); ?>">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="justify-content-center">
            <input type="text" class="form-control" id="pomgo_text" name="pomgo_text" value="<?php echo e($pomgo->content); ?>">
            <input type="text" class="form-control col-md-4" id="pomgo_tags" name="pomgo_tags" value="<?php echo e($pomgo->tags); ?>">

            <?php if(session('image')): ?>
            <input type="hidden" class="form-control" id="pomgo_img" name="pomgo_img" readonly="readonly" value="<?php echo e(session('image')); ?>">
            <?php endif; ?>

            <button class="btn btn-primary" type="submit">Je pomgo</button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\socialnetworkwithlaravel\resources\views/pomgo/edit.blade.php ENDPATH**/ ?>