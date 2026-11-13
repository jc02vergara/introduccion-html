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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $num1 = isset($_POST["num1"]) ? trim($_POST["num1"]) : "";
    $num2 = isset($_POST["num2"]) ? trim($_POST["num2"]) : "";
    $operacion = isset($_POST["operacion"]) ? $_POST["operacion"] : "";

    // Validar que los campos sean numéricos
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
    <title>Calculadora PHP</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .calc-container {
            max-width: 420px;
            margin: 0 auto;
        }
        .calc-form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        .calc-form label {
            font-weight: 600;
            color: #2c3e50;
        }
        .calc-form input,
        .calc-form select {
            padding: 0.6rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1rem;
        }
        .calc-form button {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 0.8rem;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .calc-form button:hover {
            background-color: #2980b9;
        }
        .resultado {
            margin-top: 1.5rem;
            padding: 1rem;
            background-color: #eafaf1;
            border-left: 4px solid #27ae60;
            border-radius: 4px;
            font-size: 1.2rem;
            text-align: center;
        }
        .error {
            margin-top: 1.5rem;
            padding: 1rem;
            background-color: #fdecea;
            border-left: 4px solid #e74c3c;
            border-radius: 4px;
            text-align: center;
        }
        .volver {
            display: inline-block;
            margin-top: 1.5rem;
            color: #3498db;
            text-decoration: none;
        }
        .volver:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.html">Inicio</a></li>
                <li><a href="calculadora.php">Calculadora</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h2>Calculadora en PHP</h2>
            <p>Realiza operaciones básicas: suma, resta, multiplicación y división.</p>

            <div class="calc-container">
                <form class="calc-form" method="POST" action="calculadora.php">
                    <label for="num1">Primer número:</label>
                    <input type="text" id="num1" name="num1" value="<?php echo htmlspecialchars($num1); ?>" required>

                    <label for="operacion">Operación:</label>
                    <select id="operacion" name="operacion" required>
                        <option value="suma" <?php if ($operacion === "suma") echo "selected"; ?>>Suma (+)</option>
                        <option value="resta" <?php if ($operacion === "resta") echo "selected"; ?>>Resta (-)</option>
                        <option value="multiplicacion" <?php if ($operacion === "multiplicacion") echo "selected"; ?>>Multiplicación (*)</option>
                        <option value="division" <?php if ($operacion === "division") echo "selected"; ?>>División (/)</option>
                    </select>

                    <label for="num2">Segundo número:</label>
                    <input type="text" id="num2" name="num2" value="<?php echo htmlspecialchars($num2); ?>" required>

                    <button type="submit">Calcular</button>
                </form>

                <?php if ($mensaje !== ""): ?>
                    <div class="error"><?php echo htmlspecialchars($mensaje); ?></div>
                <?php elseif ($resultado !== null): ?>
                    <div class="resultado">
                        Resultado: <?php echo htmlspecialchars($num1); ?> <?php echo $op_symbol; ?> <?php echo htmlspecialchars($num2); ?> = <strong><?php echo $resultado; ?></strong>
                    </div>
                <?php endif; ?>
            </div>

            <a class="volver" href="index.html">&larr; Volver a la página personal</a>
        </section>
    </main>

    <footer>
        <p>&copy; 2026 Calculadora PHP. Tarea: Introducción a HTML.</p>
    </footer>
</body>
</html>
