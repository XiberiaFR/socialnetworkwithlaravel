<?php $__env->startSection('content'); ?>
<div class="panel-body" id="list-1" v-infinite-scroll="loadMore" infinite-scroll-disabled="busy" infinite-scroll-distance="10">
   <example-component :message="message"></example-component>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\socialnetworkwithlaravel\resources\views/home.blade.php ENDPATH**/ ?>