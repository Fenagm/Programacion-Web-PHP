<?php

$id=$_GET['id'];
if(isset($_GET['p'])){
    $price=$_GET['p'];
}else{
    $price="Contactese para tasacion.";
}

$sth = $con->prepare("SELECT *,productos.img AS img, ROUND(AVG(valoracion),1) as promedio, COUNT(ranking.id_producto) as reviews FROM web.ranking
INNER JOIN web.productos
ON productos.id_producto = ranking.id_producto
INNER JOIN web.categorias ON categorias.id_categoria = productos.id_categoria
WHERE productos.id_producto =$id AND ranking.habilitado =1");

$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);

$id_padre = $result['id_padre'];

$padre = $con->prepare("SELECT * FROM web.categorias WHERE id_categoria = $id_padre");
$padre->execute();
$result2 = $padre->fetch(PDO::FETCH_ASSOC);

$contadorsql ="SELECT *, count(valoracion) as total FROM ranking where id_producto =$id and habilitado=1 GROUP BY valoracion DESC";

?>

<!-- BREADCRUMB -->

<div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb-tree">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="index.php?seccion=product">Productos</a></li>

                    <li><a href="index.php?seccion=product&idcatp=0&idcat=<?php echo $result2["id_categoria"] ?>">
                            <?php echo $result2["nombre"] ?></a></li>
                    <li class="active"><a
                            href="index.php?seccion=product&idcatp=<?php echo $result["id_padre"] ?>&idcat=<?php echo $result["id_categoria"] ?>">
                            <?php echo $result["nombre"] ?></a></li>
                </ul>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /BREADCRUMB -->


<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- Product main img -->
            <div class="col-md-5 col-md-push-2">
                <div id="product-main-img">
                    <div class="product-preview">
                        <img src="./imagenes/productos/<?php echo $result["img"] ?> " alt="">
                    </div>
                    <div class="product-preview">
                        <img src="./imagenes/productos/<?php echo $result["img2"] ?> " alt="">
                    </div>
                    <div class="product-preview">
                        <img src="./imagenes/productos/<?php echo $result["img3"] ?> " alt="">
                    </div>
                </div>
            </div>
            <!-- /Product main img -->

            <!-- Product thumb imgs -->
            <div class="col-md-2  col-md-pull-5">
                <div id="product-imgs">
                    <div class="product-preview">
                        <img src="./imagenes/productos/<?php echo $result["img"] ?> " alt="">
                    </div>
                    <div class="product-preview">
                        <img src="./imagenes/productos/<?php echo $result["img2"] ?> " alt="">
                    </div>
                    <div class="product-preview">
                        <img src="./imagenes/productos/<?php echo $result["img3"] ?> " alt="">
                    </div>
                </div>
            </div>
            <!-- /Product thumb imgs -->

            <!-- Product details -->
            <div class="col-md-5">
                <div class="product-details">
                    <h2 class="product-name"><?php echo $result["nombre"] ?></h2>
                    <h2 class="product-name"><?php echo $result["modelo"] ?></h2>
                    <div>
                        <div class="rating">
                            <span><?php $valor=$result["promedio"]; echo $valor ?></span>
                            <div class="rating-stars">

                                <?php echo str_repeat("<i class='fa fa-star'></i> ", round($valor)) ?>
                                <?php echo str_repeat("<i class='fa fa-star-o'></i> ", 5-round($valor)) ?>


                            </div>
                        </div>
                        <a class="review-link" href="#tab3"><?php echo $result['reviews']; ?> Review(s) | Add your
                            review</a>
                    </div>
                    <div>
                        <h3 class="product-price">$ <?PHP echo $price;?> <del class="product-old-price"><?php if(isset($_GET['p'])){echo '$';echo $price+300;} ?></del></h3>
                        <span class="product-available">In Stock</span>
                    </div>
                    <p><?php echo $result["descripcion"] ?></p>


                    <div class="add-to-cart">


                        <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
                    </div>



                    <ul class="product-links">
                        <li>Category:</li>
                        <li><a href="index.php?seccion=product&idcatp=0&idcat=<?php echo $result2["id_categoria"] ?>">
                                <?php echo $result2["nombre"] ?></a></li>
                        <li><a
                                href="index.php?seccion=product&idcatp=<?php echo $result["id_padre"] ?>&idcat=<?php echo $result["id_categoria"] ?>">
                                <?php echo $result["nombre"] ?></a></li>
                    </ul>

                    <ul class="product-links">
                        <li>Share:</li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                    </ul>

                </div>
            </div>
            <!-- /Product details -->

            <!-- Product tab -->
            <div class="col-md-12">
                <div id="product-tab">
                    <!-- product tab nav -->
                    <ul class="tab-nav">

                        <li><a data-toggle="tab" href="#tab3">Reviews (<?php echo $result['reviews']; ?>)</a></li>
                    </ul>
                    <!-- /product tab nav -->

                    <!-- product tab content -->

                    <!-- tab3  -->
                    <div id="tab3" class="tab-pane fade in">
                        <div class="row">
                            <!-- Rating -->
                            <div class="col-md-3">
                                <div id="rating">
                                    <div class="rating-avg">
                                        <span><?php $valor=$result["promedio"];
																	echo $valor ?></span>
                                        <div class="rating-stars">

                                            <?php echo str_repeat("<i class='fa fa-star'></i> ", round($valor)) ?>

                                            <?php echo str_repeat("<i class='fa fa-star-o'></i> ", 5-round($valor)) ?>


                                        </div>
                                    </div>
                                    <ul class="rating">

                                        <?php echo printstars($con,$contadorsql,$result['reviews']); ?>

                                    </ul>
                                </div>
                            </div>
                            <!-- /Rating -->

                            <!-- Reviews -->
                            <div class="col-md-6" id="comlist">
                                <div id="reviews comlist">
                                    <ul class="reviews list">

                                        <?php echo printCom($con,$id); ?>
                                    </ul>
                                    <ul class="pagination"></ul>
                                    </ul>
                                </div>
                            </div>

                            <!-- /Reviews -->

                            <!-- Review Form -->

                            <div class="col-md-3">
                                <div id="formulario_comentarios">
                                    <form class="review-form" action="seccion/comentarios.php" method="post">
                                        <h4>Comparte tu opinión</h4>
                                        <label for="usuario">Usuario</label>
                                        <input type="text" class="form-control" id="usuario" name="usuario"
                                            placeholder="Usuario" required>
                                        <div id="check_user"></div>
                                        <input class="input" type="email" placeholder="email" name="email" required>
                                        <input class="input" type="hidden" value=<?php echo $_GET['id']; ?> name="id">
                                        <input class="input" type="hidden" value=<?php echo $_GET['p']; ?> name="p">

                                        <textarea class="input" placeholder="Tu Review" name="comentario" required></textarea>
                                        <div class="input-rating">
                                            <span>Your Rating: </span>
                                            <div class="stars"> 
                                                <input id="star5" name="valoracion" value="5" type="radio" required="required"><label
                                                    for="star5"></label>
                                                <input id="star4" name="valoracion" value="4" type="radio" required="required"><label
                                                    for="star4"></label>
                                                <input id="star3" name="valoracion" value="3" type="radio" required="required"><label
                                                    for="star3"></label>
                                                <input id="star2" name="valoracion" value="2" type="radio" required="required"><label
                                                    for="star2"></label>
                                                <input id="star1" name="valoracion" value="1" type="radio" required="required"><label
                                                    for="star1"></label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Enviar</button>

                                    </form>
                                </div>
                            </div>
                            <!-- /Review Form -->


                        </div>
                    </div>
                    <!-- /tab3  -->
                </div>
                <!-- /product tab content  -->
            </div>
        </div>
        <!-- /product tab -->
    </div>
    <!-- /row -->
</div>
<!-- /container -->
</div>
<!-- /SECTION -->