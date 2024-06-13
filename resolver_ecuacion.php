<!DOCTYPE html>
<html>
<head>
    <title>Resuelve la Ecuación Cuadrática</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2, h3 {
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            padding: 10px 15px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        .results {
            margin-top: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            border-radius: 4px;
        }
        .results p {
            margin: 0;
            padding: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Resuelve la Ecuación Cuadrática</h1>
        <form method="POST">
            <div class="form-group">
                <label for="a">ax^2:</label>
                <input type="text" id="a" name="a" required>
            </div>
            <div class="form-group">
                <label for="b">bx:</label>
                <input type="text" id="b" name="b" required>
            </div>
            <div class="form-group">
                <label for="c">c:</label>
                <input type="text" id="c" name="c" required>
            </div>
            <button type="submit">Resolver</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $a = (double) $_POST['a'];
            $b = (double) $_POST['b'];
            $c = (double) $_POST['c'];

            echo "<div class='results'>";
            echo "<h2>Resultados</h2>";

            echo "<p>1. Ecuación característica: ";
            if ($a != 0 && $b != 0 && $c != 0) {
                printf("%.2lfm^2 + %.2lfm + %.2lf = 0\n", $a, $b, $c);
            } elseif ($a == 0 && $b != 0 && $c != 0) {
                printf("%.2lfm + %.2lf = 0\n", $b, $c);
            } elseif ($b == 0 && $a != 0 && $c != 0) {
                printf("%.2lfm^2 + %.2lf = 0\n", $a, $c);
            } elseif ($c == 0 && $a != 0 && $b != 0) {
                printf("%.2lfm^2 + %.2lfm = 0\n", $a, $b);
            }
            echo "</p>";

            $comp = ($b * $b) - 4 * $a * $c;

            echo "<p>2. Las raíces son: ";
            if ($comp < 0) {
                $raiz1_real = (-$b) / (2.0 * $a);
                $raiz1_imag = sqrt(abs($comp)) / (2.0 * $a);
                $raiz2_real = (-$b) / (2.0 * $a);
                $raiz2_imag = -sqrt(abs($comp)) / (2.0 * $a);

                printf("m1= %.2lf + %.2lfi y m2= %.2lf - %.2lfi\n", $raiz1_real, $raiz1_imag, $raiz2_real, $raiz1_imag);

                echo "<p>3. Soluciones Linealmente independientes: ";
                printf("y1 = e^(%.2f x) cos(%.2f x) ; y2= e^(%.2f x) sen(%.2f x)\n", $raiz1_real, $raiz1_imag, $raiz2_real, $raiz1_imag);
                if ($raiz1_real == 0 && $raiz2_real == 0) {
                    echo "<p>4. Solución general: ";
                    printf("yc = c1 cos(%.2f x) + c2sen(%.2f x)\n", $raiz1_imag, $raiz1_imag);
                } else {
                    echo "<p>4. Solución general: ";
                    printf("yc = c1 e^(%.2f x) cos(%.2f x) + c2 e^(%.2f x) sen(%.2f x)\n", $raiz1_real, $raiz1_imag, $raiz2_real, $raiz1_imag);
                }
            } else {
                $raiz1_real = (-$b + sqrt($comp)) / (2.0 * $a);
                $raiz2_real = (-$b - sqrt($comp)) / (2.0 * $a);
                printf("m1= %.2f y m2= %.2f\n", $raiz1_real,  $raiz2_real );
                echo "<p>3. Soluciones Linealmente independientes: ";
                printf("y1 = e^(%.2f x) ; y2= e^(%.2f x) ", $raiz1_real,  $raiz2_real);
                if ($raiz1_real == 0 && $raiz2_real == 0) {
                    echo "<p>4. Solución general: ";
                    echo "yc = c1 + c2\n";
                } elseif ($raiz1_real == $raiz2_real) {
                    echo "<p>4. Solución general: ";
                    printf("yc = c1 e^(%.2f x) + c2 x e^(%.2f x) ", $raiz1_real,  $raiz2_real);
                } elseif ($raiz1_real == 0 && $raiz2_real != 0) {
                    echo "<p>4. Solución general: ";
                    printf("yc = c1 + c2 e^(%.2f x) ", $raiz2_real);
                } elseif ($raiz1_real != 0 && $raiz2_real == 0) {
                    echo "<p>4. Solución general: ";
                    printf("yc = c1 e^(%.2f x) + c2  ", $raiz1_real);
                } elseif ($raiz1_real != 0 && $raiz2_real != 0) {
                    echo "<p>4. Solución general: ";
                    printf("yc = c1e^(%.2f x) + c2 e^(%.2f x) ", $raiz1_real,  $raiz2_real);
                }
            }
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>

