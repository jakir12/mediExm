<?php $__env->startSection('content'); ?>
<div class="container-fluid app-body app-home">

    <div class="row">
        <div style="margin-top: 10px;">
            <form method="get" action="<?php echo e(URL::to('search-recentPost')); ?>">
                <div class="row" style="margin-left: 0px;">
                    <div class="col-md-3">
                        <div class="group">
                            <div class="input-group">
                                <input type="text" name="post_text" class="form-control" placeholder="Search" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="group">
                                <input type="date" name="sent_at" class="form-control">
                            </div>
                        </div>   
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="group">
                                <select name="group_id" class="form-control" style="width: 100%">
                                    <option value="0">All Group</option>
                                    <?php $__currentLoopData = $social_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($grp->id); ?>"><?php echo e($grp-> name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" name="search" class="btn btn-success">
                            Search
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <table class="table table-bordered"> 
            <thead> 
                <tr> 
                    <th>SL</th>
                    <th>Group Name</th>
                    <th>Group Type</th> 
                    <th>Account Name</th> 
                    <th>Post Text</th> 
                    <th>Time</th> 
                </tr> 
            </thead> 
            <tbody> 
                <?php $__currentLoopData = $buffer_postings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $bp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr> 

                    <td><?php echo e($bp->id); ?></td> 
                    <td><?php echo e($bp->name); ?></td> 
                    <td><?php echo e($bp->type); ?></td> 
                    <td><img src="<?php echo e($bp->avatar); ?>" style="width: 50px;height: 50px;border-radius: 50%"/></td> 
                    <td><?php echo e($bp->post_text); ?></td>
                    <td><?php echo e($bp->sent_at); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody> 
        </table>
        <?php echo e($buffer_postings->appends(Request::except('page'))->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>