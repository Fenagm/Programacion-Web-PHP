<?php 

$sqldestacados="SELECT *, ROUND(AVG(valoracion),1) as promedio FROM web.ranking
INNER JOIN web.productos 
ON ranking.id_producto = productos.id_producto 
INNER JOIN web.marcas 
ON productos.id_marca = marcas.id_marca 
GROUP BY ranking.id_producto
ORDER BY  promedio DESC
LIMIT 6";


?>	<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- shop -->
        
			<?php echo printCatHome($con) ?>
	

		<!-- /shop -->
			

        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

		<!-- REGISTRO SECTION -->
		<div id="hot-deal" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="hot-deal">
							
							<h2 class="text-uppercase">REGISTRATE AHORA</h2>
							<p>OBTENE UN 10% OFF EN TU PRIMER COMPRA</p>
							<a class="primary-btn cta-btn" href="index.php?seccion=contact">CONTACTANOS PARA MAS PROMOS</a>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /HOT DEAL SECTION -->


<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <!-- section title -->
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">Productos mas votados</h3>
                    <div class="section-nav">
                  
                    </div>
                </div>
            
            <!-- /section title -->


					<!-- Products tab & slick -->
					
							<div class="products-tabs">
								<!-- tab -->
								<div id="tab1" class="tab-pane active">
									<div class="products-slick" data-nav="#slick-nav-1">
									<?php 
																
										echo printProduct($con, $sqldestacados);
									

									
							?>								
									</div>
									<div id="slick-nav-1" class="products-slick-nav"></div>
								</div>
								<!-- /tab -->
							</div>
						</div>
					</div>
					<!-- Products tab & slick -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->



	