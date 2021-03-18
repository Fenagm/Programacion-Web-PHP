<?php


$id=$_GET['id'];
$sth = $con->prepare("SELECT *, ROUND(AVG(valoracion),1) as promedio, COUNT(ranking.id_producto) as reviews FROM web.ranking
INNER JOIN web.productos
ON productos.id_producto = ranking.id_producto
INNER JOIN web.categorias ON categorias.id_categoria = productos.id_categoria
WHERE productos.id_producto =$id");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);

$id_padre = $result['id_padre']; 

$padre = $con->prepare("SELECT * FROM web.categorias WHERE id_categoria = $id_padre");
$padre->execute();
$result2 = $padre->fetch(PDO::FETCH_ASSOC);


/*
$rank = $con->prepare("SELECT ROUND(AVG(valoracion),1) FROM ranking WHERE id_producto=$id ");
$rank->execute();
$rank = $rank->fetch(PDO::FETCH_ASSOC);

SELECT productos.id_producto, nombre, descripcion, modelo, habilitado, img, id_marca, avg(ranking.valoracion) as promedio, COUNT(ranking.id_producto) as reviews FROM web.ranking
INNER JOIN web.productos
ON productos.id_producto = ranking.id_producto
WHERE productos.id_producto = 1;
*/


//print_r($result);
//var_dump($rank);
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
							<li class="active"><a href="index.php?seccion=product&idcatp=<?php echo $result["id_padre"] ?>&idcat=<?php echo $result["id_categoria"] ?>">
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
								<img src="./imagenes/<?php echo $result["img"] ?> " alt="">
							</div>
							<div class="product-preview">
								<img src="./imagenes/<?php echo $result["img2"] ?> " alt="">
							</div>
							<div class="product-preview">
								<img src="./imagenes/<?php echo $result["img3"] ?> " alt="">
							</div>
						</div>
					</div>
					<!-- /Product main img -->

					<!-- Product thumb imgs -->
					<div class="col-md-2  col-md-pull-5">
						<div id="product-imgs">
							<div class="product-preview">
							<img src="./imagenes/<?php echo $result["img"] ?> " alt="">
							</div>
							<div class="product-preview">
							<img src="./imagenes/<?php echo $result["img2"] ?> " alt="">
							</div>
							<div class="product-preview">
							<img src="./imagenes/<?php echo $result["img3"] ?> " alt="">
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
													<span><?php $valor=$result["promedio"];
																	echo $valor ?></span>
													<div class="rating-stars">

													<?php echo str_repeat("<i class='fa fa-star'></i> ", $valor) ?>
					
													<?php echo str_repeat("<i class='fa fa-star-o'></i> ", 5-$valor) ?>
														
													
													</div>					
								</div>
								<a class="review-link" href="#tab3"><?php echo $result['reviews']; ?> Review(s) | Add your review</a>
							</div>
							<div>
								<h3 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h3>
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
								<li><a href="index.php?seccion=product&idcatp=<?php echo $result["id_padre"] ?>&idcat=<?php echo $result["id_categoria"] ?>">
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

													<?php echo str_repeat("<i class='fa fa-star'></i> ", $valor) ?>
					
													<?php echo str_repeat("<i class='fa fa-star-o'></i> ", 5-$valor) ?>
														
													
													</div>
												</div>
												<ul class="rating">
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
														</div>
														<div class="rating-progress">
															<div style="width: 80%;"></div>
														</div>
														<span class="sum">3</span>
													</li>


													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div style="width: 60%;"></div>
														</div>
														<span class="sum">2</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div></div>
														</div>
														<span class="sum">0</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div></div>
														</div>
														<span class="sum">0</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div></div>
														</div>
														<span class="sum">0</span>
													</li>
												</ul>
											</div>
										</div>
										<!-- /Rating -->

										   <!-- Reviews -->
										   <div class="col-md-6">
                                <div id="reviews">
                                    <ul class="reviews">
                                        <li>
                                            <div class="review-heading">
                                                <h5 class="name"><?php echo $result['usuario'] ?> </h5>
                                                <p class="date"><?php echo $result['date']  ?></p>
                                                <div class="review-rating">
													
												<?php echo str_repeat("<i class='fa fa-star'></i> ", $valor) ?>
                                                <?php echo str_repeat("<i class='fa fa-star-o'></i> ", 5-$valor) ?>
    
                                                </div>
                                            </div>
                                            <div class="review-body">
                                                <p><?php echo $result['comentario'] ?></p>
                                            </div>
                                        </li>
                                        
									</ul>
									
                                    <ul class="reviews-pagination">
                                        <li class="active">1</li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">4</a></li>
                                        <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /Reviews -->

							<!-- Review Form -->
							
                            <div class="col-md-3">
								
                                <div id="review-form"  action="../../procesar-review.php" method="post">
                                    <form class="review-form">
                                        <input class="input" type="text" placeholder="Your Name" name="nombre">
                                        <input class="input" type="email" placeholder="Your Email" name="email">
                                        <textarea class="input" placeholder="Your Review" name="comentario"></textarea>
                                        <div class="input-rating">
                                            <span>Your Rating: </span>
                                            <div class="stars">
                                                <input id="star5" name="rating" value="5" type="radio"><label
                                                    for="star5"></label>
                                                <input id="star4" name="rating" value="4" type="radio"><label
                                                    for="star4"></label>
                                                <input id="star3" name="rating" value="3" type="radio"><label
                                                    for="star3"></label>
                                                <input id="star2" name="rating" value="2" type="radio"><label
                                                    for="star2"></label>
                                                <input id="star1" name="rating" value="1" type="radio"><label
                                                    for="star1"></label>
                                            </div>
                                        </div>
                                        <button class="primary-btn">Enviar</button>
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




	