<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="../js/JsBarcode.all.min.js"></script>

<?php



?>
</div>

<br>

<style>



</style>


<table class="table table-striped"  id= "table_id">

                   
<thead>    
<tr >

</tr>
</thead>
<tbody>

<?php 
$conexion=mysqli_connect('localhost','root','','barcode');
$sql="SELECT codigo FROM tabla";
$resultado=mysqli_query($conexion,$sql);

$codbarra=array();
?>
<?php 
while($fila=mysqli_fetch_assoc($resultado)):
    $codbarra[]=(string)$fila['codigo']; 
?>

<tr>   
    <td style="text-align: center;">
        <svg id='<?php echo  "barcode".$fila['codigo']; ?>'>
        </svg>
    </td>
</tr>
<?php endwhile;?>
<style>


</style>
</table>


<script type="text/javascript">

function arrayjsonbarcode(j){
json=JSON.parse(j);
arr=[];
for (var x in json) {
arr.push(json[x]);
}
return arr;
}

jsonvalor='<?php echo json_encode($codbarra) ?>';
valores=arrayjsonbarcode(jsonvalor);

for (var i = 0; i < valores.length; i++) {

JsBarcode("#barcode" + valores[i], valores[i].toString(), {
format: "CODE128",
lineColor: "#000",
width: 2,
height: 30,
displayValue: true
});
}

</script>
 <script>
    document.addEventListener("DOMContentLoaded", () => {
        window.print();
        setTimeout(() => {
            window.location.href = "index.php";
        }, 1000);
    });
</script>
