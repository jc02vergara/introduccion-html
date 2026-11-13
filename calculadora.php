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
    <title>calculadora.php | jean@vergara</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=VT323&family=Share+Tech+Mono&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .calc-wrap { max-width: 520px; margin: 0 auto; }
        .calc-form { display: flex; flex-direction: column; gap: 14px; }
        .calc-form label {
            color: var(--accent);
            font-size: 16px;
        }
        .calc-form input,
        .calc-form select {
            background: #020602;
            color: var(--fg-bright);
            border: 1px solid var(--border);
            padding: 10px 12px;
            font-family: 'Share Tech Mono', monospace;
            font-size: 16px;
            outline: none;
            transition: border-color 0.15s, box-shadow 0.15s;
        }
        .calc-form input:focus,
        .calc-form select:focus {
            border-color: var(--fg);
            box-shadow: var(--glow);
        }
        .calc-form button {
            background: transparent;
            color: var(--fg-bright);
            border: 1px solid var(--fg);
            padding: 12px;
            font-family: 'VT323', monospace;
            font-size: 22px;
            letter-spacing: 2px;
            cursor: pointer;
            text-shadow: var(--glow);
            transition: background 0.15s, color 0.15s;
        }
        .calc-form button:hover {
            background: var(--fg);
            color: var(--bg);
            text-shadow: none;
        }
        .resultado {
            margin-top: 18px;
            padding: 14px;
            border: 1px solid var(--fg);
            background: rgba(51,255,102,0.06);
            color: var(--fg-bright);
            font-size: 20px;
            text-align: center;
            text-shadow: var(--glow);
            font-family: 'VT323', monospace;
            letter-spacing: 1px;
        }
        .error {
            margin-top: 18px;
            padding: 14px;
            border: 1px solid var(--danger);
            background: rgba(255,85,85,0.06);
            color: var(--danger);
            text-align: center;
            font-size: 16px;
        }
        .volver {
            display: inline-block;
            margin-top: 18px;
            color: var(--fg-dim);
            text-decoration: none;
            font-size: 15px;
        }
        .volver:hover { color: var(--accent); }
        .volver::before { content: '< '; }
    </style>
</head>
<body>
    <div class="scanlines"></div>

    <div class="terminal">
        <header class="boot">
            <div class="boot-lines">
                <p><span class="prompt">></span> LOADING calculadora.php ... <span class="ok">[OK]</span></p>
                <p><span class="prompt">></span> MODE: php arithmetic engine</p>
                <p><span class="prompt">></span> STATUS: <span class="blink">READY</span></p>
            </div>
        </header>

        <nav class="nav">
            <a href="index.html">home</a>
            <a href="calculadora.php">calc.php</a>
        </nav>

        <main>
            <section class="panel">
                <span class="panel-title">[ calc.php ]</span>
                <h1>Calculadora</h1>
                <p class="title">operaciones básicas: suma, resta, multiplicación, división</p>

                <div class="calc-wrap">
                    <form class="calc-form" method="POST" action="calculadora.php">
                        <label for="num1">&gt; primer número:</label>
                        <input type="text" id="num1" name="num1" value="<?php echo htmlspecialchars($num1); ?>" required autofocus>

                        <label for="operacion">&gt; operación:</label>
                        <select id="operacion" name="operacion" required>
                            <option value="suma" <?php if ($operacion === "suma") echo "selected"; ?>>suma (+)</option>
                            <option value="resta" <?php if ($operacion === "resta") echo "selected"; ?>>resta (-)</option>
                            <option value="multiplicacion" <?php if ($operacion === "multiplicacion") echo "selected"; ?>>multiplicación (*)</option>
                            <option value="division" <?php if ($operacion === "division") echo "selected"; ?>>división (/)</option>
                        </select>

                        <label for="num2">&gt; segundo número:</label>
                        <input type="text" id="num2" name="num2" value="<?php echo htmlspecialchars($num2); ?>" required>

                        <button type="submit">[ EJECUTAR ]</button>
                    </form>

                    <?php if ($mensaje !== ""): ?>
                        <div class="error">&gt; ERROR: <?php echo htmlspecialchars($mensaje); ?></div>
                    <?php elseif ($resultado !== null): ?>
                        <div class="resultado">
                            <?php echo htmlspecialchars($num1); ?> <?php echo $op_symbol; ?> <?php echo htmlspecialchars($num2); ?> = <?php echo $resultado; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <a class="volver" href="index.html">volver a home</a>
            </section>
        </main>

        <footer>
            <p>jean@vergara:~$ <span class="blink">_</span> &nbsp;|&nbsp; calculadora.php &nbsp;|&nbsp; php arithmetic engine</p>
        </footer>
    </div>
</body>
</html>
