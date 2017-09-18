<?php $__env->startSection('main'); ?>
    <div class=<?php echo $__env->yieldContent("class"); ?>>
        <?php echo $__env->yieldContent('carousel'); ?>
        <div class="main-left" id="article">
        	<?php echo $__env->yieldContent('content'); ?>
        </div>
        <div class="main-right">
        	<?php echo $__env->yieldContent('article-tab'); ?>
            <div class="tab">
              <div class="title">技术站点</div>
              <div class="layui-tab-content" style="height: 100px;background-color:white;">
                <div class="layui-tab-item layui-show">1</div>
              </div>
            </div>
            <div class="tab">
              <div class="title">标签列表</div>
              <div class="layui-tab-content" style="height: 100px;background-color:white;">
                <div class="layui-tab-item layui-show">1</div>
              </div>
            </div>
            <div class="tab">
              <div class="title">友情链接</div>
              <div class="layui-tab-content" style="height: 100px;background-color:white;">
                <div class="layui-tab-item layui-show">1</div>
              </div>
            </div>
        </div>
        <div style="clear:both;"></div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>