<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagar</title>
    <link rel="stylesheet" href="./../../../bootstrap-5.3.3-dist/css/bootstrap.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="./../../../bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            /* Fondo gris claro */
            color: #333;
            /* Color de texto principal */
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #343a40 !important;
            /* Fondo gris oscuro para la barra de navegación de Bootstrap */
            padding: 2%;
        }

        .navbar-brand,
        .navbar-nav .nav-link {
            color: #fff !important;
            /* Color de texto blanco para los elementos de navegación */
        }

        .navbar-toggler-icon {
            color: #fff !important;
            /* Color del icono del botón de menú */
        }


        .container {
            margin-top: 30px;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            margin-bottom: 40px;
            margin-top: 60px;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-body {
            padding: 30px;
        }

        .card-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
        }

        #paypal-button-container {
            margin-top: 20px;
        }

        .btn-paypal {
            background-color: #00457C;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 12px 20px;
            font-size: 18px;
            font-weight: bold;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }

        .btn-paypal:hover {
            background-color: #00345C;
        }

        .paypal-icon {
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <?php require_once "./superior.php"; ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title">Elige la opción de pago</h1>
                        <!-- Contenedor para el botón de PayPal -->
                        <div id="paypal-button-container"></div>
                        <!-- Botón de PayPal alternativo -->
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Incluye el SDK de PayPal JavaScript -->
    <script src="https://www.paypal.com/sdk/js?client-id=AWkwn-ZpT6B30b4VO--Hw0vxxfAjPiAaa390-0-FSFTdQF6YZUVbJeXcxGOhzkMrrEIwstluGw7Lu_d9&currency=MXN"></script>

    <script>
        // Renderiza el botón de PayPal en #paypal-button-container
        paypal.Buttons({
            style: {
                color: 'blue',
                shape: 'pill'
            },
            // Llama a tu servidor para configurar la transacción
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            currency_code: 'MXN',
                            value: '150.00' // Monto del pago
                        }
                    }]
                });
            },
            // Maneja la aprobación del pago
            onApprove: function(data, actions) {
                // Captura el pago
                return actions.order.capture().then(function(details) {
                    // Redirecciona a la página del ticket o página de confirmación
                    window.location.href = "ticket.php";
                    console.log(details);
                });
            },
            // Maneja la cancelación del pago
            onCancel: function(data) {
                alert("Pago cancelado");
                console.log(data);
            }
        }).render('#paypal-button-container');
    </script>

    <?php
    require_once "./inferior.php";
    ?>
</body>

</html>