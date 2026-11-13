<?php
/**
 * Calculadora sencilla en PHP
 * Realiza operaciones básicas: suma, resta, multiplicación y división.
 */

$resultado = null;
$mensaje = "";
$operacion = "";
$num1 = "";
$num2 = "";
$op_symbol = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $num1 = isset($_POST["num1"]) ? trim($_POST["num1"]) : "";
    $num2 = isset($_POST["num2"]) ? trim($_POST["num2"]) : "";
    $operacion = isset($_POST["operacion"]) ? $_POST["operacion"] : "";

    if ($num1 === "" || $num2 === "") {
        $mensaje = "Por favor ingrese ambos números.";
    } elseif (!is_numeric($num1) || !is_numeric($num2)) {
        $mensaje = "Los valores ingresados deben ser números.";
    } else {
        $a = (float) $num1;
        $b = (float) $num2;

        switch ($operacion) {
            case "suma":
                $resultado = $a + $b;
                $op_symbol = "+";
                break;
            case "resta":
                $resultado = $a - $b;
                $op_symbol = "-";
                break;
            case "multiplicacion":
                $resultado = $a * $b;
                $op_symbol = "*";
                break;
            case "division":
                if ($b == 0) {
                    $mensaje = "No se puede dividir entre cero.";
                } else {
                    $resultado = $a / $b;
                    $op_symbol = "/";
                }
                break;
            default:
                $mensaje = "Operación no válida.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>calculadora.php | Y2K Desktop</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .calc-wrap { max-width: 420px; margin: 0 auto; }
        .calc-form { display: flex; flex-direction: column; gap: 10px; }
        .calc-form label { font-size: 11px; font-weight: bold; margin-bottom: 2px; display: block; }
        .calc-form input,
        .calc-form select {
            width: 100%;
            background: #fff;
            color: #000;
            border: 1px solid #000;
            padding: 4px 6px;
            font-family: Tahoma, Verdana, sans-serif;
            font-size: 12px;
            box-shadow: inset 1px 1px 0 #808080;
        }
        .calc-form button {
            background: #c0c0c0;
            color: #000;
            border: 1px solid #000;
            padding: 4px 12px;
            font-size: 12px;
            cursor: pointer;
            box-shadow: inset 1px 1px 0 #fff, inset -1px -1px 0 #808080;
            font-family: Tahoma, sans-serif;
            margin-top: 4px;
        }
        .calc-form button:hover { background: #e0e0e0; }
        .resultado {
            margin-top: 12px;
            padding: 8px;
            border: 1px solid #000;
            background: #ffffcc;
            color: #000;
            font-size: 16px;
            text-align: center;
            font-weight: bold;
        }
        .error {
            margin-top: 12px;
            padding: 8px;
            border: 1px solid #cc0000;
            background: #ffcccc;
            color: #cc0000;
            text-align: center;
            font-size: 12px;
        }
        .volver {
            display: inline-block;
            margin-top: 12px;
            color: #0000cc;
            text-decoration: underline;
            font-size: 11px;
        }
    </style>
</head>
<body>
    <div class="desktop" style="grid-template-columns: 1fr; max-width: 520px;">
        <section class="win win-mint">
            <div class="titlebar">
                <span class="title">calculadora.php</span>
                <div class="controls">
                    <button type="button">_</button>
                    <button type="button">□</button>
                    <button type="button">×</button>
                </div>
            </div>
            <div class="win-body">
                <h1>Calculadora</h1>
                <p class="small">operaciones básicas: suma, resta, multiplicación, división</p>

                <div class="calc-wrap">
                    <form class="calc-form" method="POST" action="calculadora.php">
                        <div>
                            <label for="num1">primer número:</label>
                            <input type="text" id="num1" name="num1" value="<?php echo htmlspecialchars($num1); ?>" required autofocus>
                        </div>
                        <div>
                            <label for="operacion">operación:</label>
                            <select id="operacion" name="operacion" required>
                                <option value="suma" <?php if ($operacion === "suma") echo "selected"; ?>>suma (+)</option>
                                <option value="resta" <?php if ($operacion === "resta") echo "selected"; ?>>resta (-)</option>
                                <option value="multiplicacion" <?php if ($operacion === "multiplicacion") echo "selected"; ?>>multiplicación (*)</option>
                                <option value="division" <?php if ($operacion === "division") echo "selected"; ?>>división (/)</option>
                            </select>
                        </div>
                        <div>
                            <label for="num2">segundo número:</label>
                            <input type="text" id="num2" name="num2" value="<?php echo htmlspecialchars($num2); ?>" required>
                        </div>
                        <button type="submit">[ ejecutar ]</button>
                    </form>

                    <?php if ($mensaje !== ""): ?>
                        <div class="error">&gt; ERROR: <?php echo htmlspecialchars($mensaje); ?></div>
                    <?php elseif ($resultado !== null): ?>
                        <div class="resultado">
                            <?php echo htmlspecialchars($num1); ?> <?php echo $op_symbol; ?> <?php echo htmlspecialchars($num2); ?> = <?php echo $resultado; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <p class="hint"><a href="index.html">← volver al escritorio</a></p>
            </div>
        </section>
    </div>

    <footer class="taskbar">
        <button class="start-btn"> ( ) Inicio</button>
        <span class="taskbar-text">calculadora.php — Y2K Desktop</span>
        <span class="clock">12:00</span>
    </footer>
</body>
</html>
