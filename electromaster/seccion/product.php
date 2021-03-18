<?php 



if(isset($_GET['idcat'])){
    $id_padre = $_GET['idcat'];

    $padre = $con->prepare("SELECT * FROM web.categorias WHERE id_categoria = $id_padre");
    $padre->execute();
    $result2 = $padre->fetch(PDO::FETCH_ASSOC);
}

$ordens = array("&orden=Destacados", "&orden=Ranqueados", "&orden=Z -> A", "&orden=A -> Z");
$link = str_replace($ordens, "", $_SERVER['REQUEST_URI']);


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


                        <?php                             
                                if(isset($_GET['idcatp'] )){
                                if($_GET['idcatp']=0){
                            ?>
                        <li><a href="index.php?seccion=product&idcatp=0&idcat=<?php echo $result2["id_categoria"] ?>">
                                <?php echo $result2["nombre"] ?></a></li>


                        <?php } else {?> <li><a
                                href="index.php?seccion=product&idcatp=0&idcat=<?php echo $result2["id_categoria"]; ?>">
                                <?php echo $result2["nombre"]; ?></a></li>


                        <?php    }}?>

                        <?php if(isset($_GET['idcat']) && isset($_GET['idcatp']) && $_GET['idcatp']>0){
                              
                            ?>
                        <li class="active"><a
                                href="index.php?seccion=product&idcatp=<?php echo $sql["id_padre"] ?>&idcat=<?php echo $result2["id_categoria"] ?>">
                                <?php echo $result2["nombre"]; ?></a></li><?php } ?>
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
                <!-- ASIDE -->
                <div id="aside" class="col-md-3">
                    <!-- aside Widget -->
                    <div class="aside">
                        <h3 class="aside-title">Categorias</h3>

                        <?php echo printCat($con)?>

                    </div>
                    <!-- /aside Widget -->

                    <!-- aside Widget -->
                    <div class="aside">
                        <h3 class="aside-title">Marca</h3>

                        <?php echo printMarca($con, $sqlMarca)?>

                    </div>

                    <!-- /aside Widget -->

                    <br>
                    <button onclick="window.location.href='index.php?seccion=product'" type="button"
                        class="btn btn-primary">Borrar
                        Filtro(s)</button>
                    <br>
                    <!-- /aside Widget -->




                </div>
                <!-- /ASIDE -->

                <!-- STORE -->
                <div id="store" class="col-md-9">
                    <!-- store top filter -->
                    <div class="store-filter clearfix">
                        <div class="store-sort">
                            <label>
                                Sort By:
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default dropdown-toggle"
                                        data-toggle="dropdown">
                                        <?php if(isset($_GET['orden'])){echo $_GET['orden'];}else{echo'- ordenar por -';}?>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo $link ?>&orden=Destacados">Destacados</a></li>
                                        <li><a href="<?php echo $link ?>&orden=Ranqueados">Ranqueados</a></li>
                                        <li><a href="<?php echo $link ?>&orden=Z -> A">Z -> A</a></li>
                                        <li><a href="<?php echo $link ?>&orden=A -> Z">A -> Z</a></li>
                                    </ul>
                                </div>
                            </label>

                            <label>
                                Show:
                                <select class="input-select">
                                    <option value="0">20</option>
                                    <option value="1">50</option>
                                </select>
                            </label>
                        </div>

                    </div>
                    <!-- /store top filter -->

                    <!-- store products -->
                    <div class="row">
                        <div class="checkbox-filter">
                            <div class="">

                                <!-- product -->
                                <?php 
                                    
                                    echo printProduct($con, $sql);
                                
							?>
                                <!-- /product -->

                            </div>
                        </div>
                    </div>
                    <!-- /store products -->

                    <!-- store bottom filter -->
                    <div class="store-filter clearfix">
                        <span class="store-qty">Showing 20-100 products</span>
                        <ul class="store-pagination">
                            <li class="active">1</li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                        </ul>
                    </div>
                    <!-- /store bottom filter -->
                </div>
                <!-- /STORE -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
   <!-- /SECTION -->
    </div>