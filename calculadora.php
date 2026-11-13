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
            font-size: 13px;
            font-family: 'JetBrains Mono', monospace;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .calc-form input,
        .calc-form select {
            background: var(--bg-elev);
            color: var(--text);
            border: 1px solid var(--border);
            padding: 12px 14px;
            font-family: 'Inter', sans-serif;
            font-size: 16px;
            border-radius: var(--radius-sm);
            outline: none;
            transition: border-color .15s, box-shadow .15s;
        }
        .calc-form input:focus,
        .calc-form select:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--accent-glow);
        }
        .calc-form button {
            background: var(--accent);
            color: var(--bg);
            border: none;
            padding: 13px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: 1px;
            border-radius: var(--radius-sm);
            cursor: pointer;
            transition: background .15s, transform .1s;
        }
        .calc-form button:hover {
            background: var(--accent-soft);
            transform: translateY(-1px);
        }
        .resultado {
            margin-top: 18px;
            padding: 16px;
            border: 1px solid var(--accent);
            background: rgba(245,166,35,0.08);
            color: var(--accent-soft);
            font-size: 22px;
            text-align: center;
            font-family: 'JetBrains Mono', monospace;
            font-weight: 700;
            border-radius: var(--radius-sm);
        }
        .error {
            margin-top: 18px;
            padding: 14px;
            border: 1px solid #ff5555;
            background: rgba(255,85,85,0.08);
            color: #ff7a7a;
            text-align: center;
            font-size: 14px;
            border-radius: var(--radius-sm);
            font-family: 'JetBrains Mono', monospace;
        }
        .volver {
            display: inline-block;
            margin-top: 18px;
            color: var(--text-dim);
            text-decoration: none;
            font-size: 14px;
            font-family: 'JetBrains Mono', monospace;
        }
        .volver:hover { color: var(--accent); }
        .volver::before { content: '< '; }
    </style>
</head>
<body>
    <div class="scanlines"></div>

    <div class="terminal">
        <header class="topbar">
            <div class="topbar-inner">
                <a href="index.html" class="brand">
                    <span class="brand-prompt">jean@vergara:~$</span>
                    <span class="brand-name">calculadora.php</span>
                </a>
                <nav class="nav">
                    <a href="index.html">home</a>
                    <a href="calculadora.php" class="nav-cta">calc.php</a>
                </nav>
            </div>
        </header>

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
