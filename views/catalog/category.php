<?php include_once ROOT . '/views/layouts/header.php'; ?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Каталог</h2>
                    <div class="panel-group category-products">
                        <?php foreach ($categoriesList as $category): ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="/category/<?= $category['id'] ?>" class="<?php if ($categoryId == $category['id']) echo 'active'; ?>"><?= $category['name'] ?></a></h4>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Последние товары</h2>
                    <?php if(!empty($categoryProducts)):?> 
                    <?php $i = 0; foreach ($categoryProducts as $product): ?>
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <a href="/product/<?= $product['id'] ?>"><img src="<?= Product::getImage($product['id']); ?>" style="height: 237px;" alt="" /></a>
                                        <h2><?= $product['price']; ?> $</h2>
                                        <p><a href="/product/<?= $product['id'] ?>"><?= $product['name'] ?></a></p>
                                        <a href="/cart/add/<?= $product['id']; ?>" class="btn btn-default add-to-cart" data-id="<?= $product['id']; ?>"><i class="fa fa-shopping-cart"></i>В корзину</a>
                                    </div>
                                    <?php if ($product['is_new']): ?>
                                        <img src="/template/images/home/new.png" class="new" alt="" />
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php $i++?>
<?php if($i % 3 == 0):?>
    <div class="clearfix"></div>
<?php endif;?>   
<?php endforeach; ?>   
    <div class="clearfix"></div>
    <?php if($total > 3):?>
    <?= $pagination->get();?>
    <?php endif;?>  
    <?php else:?>
                    <h2>Здесь товаров пока нет</h2>
<?php endif;?>
                    

                </div><!--features_items-->

            </div>
        </div>
    </div>
</section>
<?php include_once ROOT . '/views/layouts/footer.php'; ?>