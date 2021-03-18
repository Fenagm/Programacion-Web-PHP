<footer class="navbar-fixed-bottom">
    <p class="panel-footer">�2020 Coscia-Gonzalez M.-Olguin</p>
</footer>

<!-- script references -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.4.0/dist/sweetalert2.all.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>
<script tipo="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script tipo="text/javascript" src="https://cdn.rawgit.com/prashantchaudhary/ddslick/master/jquery.ddslick.min.js"></script>
<script tipo="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script tipo="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script tipo="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap.min.js"></script>
</body>

</html>



<script>
    $(document).ready(function() {
        $('#filtroTabla').DataTable();
    });
</script>

<script type="text/javascript">
function ShowSelected()
{
/* Para obtener el valor */
var cod = document.getElementById("id_padre").value;
alert(cod);
return cod;
 
}
</script>

<script>
function pOnChange(sel) {
      if (sel.value!="0"){
           divC = document.getElementById("imagen");
           divC.style.display = "none";


      }else{

           divC = document.getElementById("imagen");
           divC.style.display="";

      }
}</script>


