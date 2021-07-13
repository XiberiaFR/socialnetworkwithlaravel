

<?php $__env->startSection('content'); ?>

<form enctype="multipart/form-data" class="m-1 d-flex align-items-center mb-3" method="POST" action="<?php echo e(route('comment.update', $comment)); ?>">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>
    <input name="pomgo-id-comment" type="hidden" value="<?php echo e($comment->pomgo_id); ?>">
    <textarea name="comment-content" class="ml-1 col-md-8" type="text" placeholder="Ecrivez votre commentaire"><?php echo e($comment->content); ?></textarea>
    <div class="col-md-4 m-2">
    <img src="<?php echo e(asset('images')); ?>/<?php echo e($comment->image); ?>" class="img-thumbnail" alt="">
        <input type="file" name="image_comment" class="mb-2 form-control">
        <button class=" btn btn-success" type="submit">Publier</button>
    </div>
</form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\socialnetworkwithlaravel\resources\views/comments/edit.blade.php ENDPATH**/ ?>