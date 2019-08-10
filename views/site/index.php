<?php include_once ROOT . '/views/layouts/header.php';?>
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
                                    <h4 class="panel-title"><a href="/category/<?= $category['id'] ?>"><?= $category['name'] ?></a></h4>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Последние товары</h2>
                    <?php foreach ($lastProductsList as $product): ?>
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <a href="/product/<?= $product['id'] ?>">
                                            <img src="<?= Product::getImage($product['id']); ?>" style="height: 237px;" alt="" /></a>
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
                    <?php endforeach; ?>         
                </div><!--features_items-->

                <div class="recommended_items"><!--recommended_items-->
                    <h2 class="title text-center">Рекомендуемые товары</h2>
                    
                    <div class="cycle-slideshow" 
                         data-cycle-fx=carousel
                         data-cycle-timeout=5000
                         data-cycle-carousel-visible=3
                         data-cycle-carousel-fluid=true
                         data-cycle-slides="div.item"
                         data-cycle-prev="#prev"
                         data-cycle-next="#next">                        
                        <?php foreach ($recommendProducts as $recomProduct):?>
                        <div class="item">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <a href="/product/<?=$recomProduct['id'] ?>"><img src="<?=Product::getImage($recomProduct['id']); ?>" style="height: 172px;" alt="" /></a>
                                                <h2><?= $recomProduct['price']; ?> $</h2>
                                                <p><a href="/product/<?= $recomProduct['id'] ?>"><?= $recomProduct['name']; ?></a></p>
                                                <a href="/cart/add/<?= $recomProduct['id']; ?>" class="btn btn-default add-to-cart" data-id="<?= $recomProduct['id']; ?>"><i class="fa fa-shopping-cart"></i>В корзину</a>
 
                                        </div>
                                        <?php if ($recomProduct['is_new']): ?>
                                            <img src="/template/images/home/new.png" class="new" alt="" />
                                        <?php endif; ?>
                                    </div>
                                </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <a class="left recommended-item-control" id="prev" href="#recommended-item-carousel" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="right recommended-item-control" id="next"  href="#recommended-item-carousel" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
      
                </div><!--/recommended_items-->

            </div>
        </div>
    </div>
</section>
<?php include_once ROOT . '/views/layouts/footer.php'; ?>