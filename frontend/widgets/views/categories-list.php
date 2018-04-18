<div class="left-sidebar">
    <h2>Category</h2>
    <div class="panel-group category-products" id="accordian"><!--category-productsr-->
        <?php foreach ($categories as $category):  ?>
            <div class="panel panel-default">
                <?php if (count($category['nodes']) > 0): ?>
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" href="#category_<?= $category['id']?>"><span class="badge pull-right"><i class="fa fa-plus"></i></span></a>
                            <a href="/category/view/<?=$category['id']?>"><?php echo $category['text'];?></a>
                        </h4>
                    </div>
                    <div id="category_<?= $category['id']?>" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul>
                                <?php foreach ($category['nodes'] as $node): ?>
                                    <li><a href="/category/view/<?= $node['id']; ?>"><?= $node['text']?> </a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a href="/category/view/<?= $node['id']; ?>"><?php echo $category['text'];?></a></h4>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>

    </div><!--/category-products-->
</div>
<!-- left -->
