<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Productos</title>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
    }

    .container {
        max-width: 500px;
        margin: auto;
        background: white;
        padding: 20px;
    }

    h1 {
        text-align: center;
    }

    label {
        display: block;
        margin-top: 10px;
    }

    input {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        border: 1px solid #ccc;
    }

    input[type="submit"] {
        margin-top: 15px;
        padding: 10px;
        border: none;
        width: 100%;
    }

    td, table {
        border: 1px solid black;
    }

    table {
        width: 100%;
    }
</style>
<body>
    <div class="container">
        <h1>Calculadora de Productos</h1>
        <form id="calculatorForm" method="post">
            <label for="producto">Producto 1:</label>
            <input type="text" name="producto1" id="producto1" >

            <label for="cantidad">Cantidad:</label>
            <input type="number" name="cantidad1" id="cantidad1" >

            <label for="precio">Precio por Unidad:</label>
            <input type="number" name="precio1" id="precio1" >
            
            <label for="producto">Producto 2:</label>
            <input type="text" name="producto2" id="producto2" >

            <label for="cantidad">Cantidad:</label>
            <input type="number" name="cantidad2" id="cantidad2" >

            <label for="precio">Precio por Unidad:</label>
            <input type="number" name="precio2" id="precio2" >
            
            <label for="producto">Producto 3:</label>
            <input type="text" name="producto3" id="producto3" >

            <label for="cantidad">Cantidad:</label>
            <input type="number" name="cantidad3" id="cantidad3" >

            <label for="precio">Precio por Unidad:</label>
            <input type="number" name="precio3" id="precio3" >

            <input type="submit" value="Calcular Total">
        </form>

        <?php 
        // Definición de constantes
        define('DESCUENTO_PEQUENO', 0.1);
        define('LIMITE_DESCUENTO', 50);
        define('LIMITE_COMPRA_GRANDE', 100);

        // Manejo del formulario
        if (isset($_POST["producto1"])) {
            $productos = [
                [
                    "nombre" => $_POST["producto1"],
                    "cantidad" => (int)$_POST["cantidad1"],
                    "precio" => (float)$_POST["precio1"]
                ],
                [
                    "nombre" => $_POST["producto2"],
                    "cantidad" => (int)$_POST["cantidad2"],
                    "precio" => (float)$_POST["precio2"]
                ],
                [
                    "nombre" => $_POST["producto3"],
                    "cantidad" => (int)$_POST["cantidad3"],
                    "precio" => (float)$_POST["precio3"]
                ]
            ];
        
            $totalCompra = 0;
            $descuentoTotal = 0;
            ?>
            <div id="results" class="results">
                <h2>Resultados</h2>
                <table>
                    <tr>
                        <td>Descripción</td>
                        <td>Cantidad</td>
                        <td>Precio por unidad</td>
                        <td>Total</td>
                    </tr>
                    <?php foreach ($productos as $producto) {
                        $total = $producto["precio"] * $producto["cantidad"];
                        $descuento = ($total > LIMITE_DESCUENTO) ? $total * DESCUENTO_PEQUENO : 0;
                        $totalConDescuento = $total - $descuento;
        
                        $totalCompra += $totalConDescuento;
                        $descuentoTotal += $descuento;
                        ?>
                        <tr>
                            <td><?php echo $producto["nombre"]; ?></td>
                            <td><?php echo $producto["cantidad"]; ?></td>
                            <td><?php echo number_format($producto["precio"], 2, ',', '.') . '€'; ?></td>
                            <td><?php echo number_format($total, 2, ',', '.') . '€'; ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Descuento Total</td>
                        <td><?php echo number_format($descuentoTotal, 2, ',', '.') . '€'; ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Total con descuento</td>
                        <td><?php echo number_format($totalCompra, 2, ',', '.') . '€'; ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td><?php echo ($totalCompra > LIMITE_COMPRA_GRANDE) ? "Compra grande" : "Compra normal"; ?></td>
                        <td></td>
                    </tr>
                </table>
            </div>
        <?php } ?>
    </div>
</body>
</html>
