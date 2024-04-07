<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./../../../bootstrap-5.3.3-dist/css/bootstrap.css">
    <script src="./../../../bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>
    
    <title>Document</title>

</head>
<body>
        <?php
        require_once "./superior.php";
        ?>

        <div class="container">
            <div class="row">
                <h1>ELIGA LA OPCION DE PAGO</h1>
                <div class="col">
                <div id="paypal-button-container"></div>

<!-- Include the PayPal JavaScript SDK -->
<script src="https://www.paypal.com/sdk/js?client-id=AWkwn-ZpT6B30b4VO--Hw0vxxfAjPiAaa390-0-FSFTdQF6YZUVbJeXcxGOhzkMrrEIwstluGw7Lu_d9&currency=MXN"></script>

<script>
    // Render the PayPal button into #paypal-button-container
    paypal.Buttons({
            style:{
                color :'blue',
                shape : 'pill'
            },
        // Call your server to set up the transaction
        createOrder: function(data, actions) {
           return actions.order.create({
            purchase_units: [{
                amount: {
                    currency_code: 'MXN',
                    value: '150.00'
                }
            }]
           })
        },
        onApprove: function (data, actions){
            actions.order.capture().then(function(detalles){
                window.location.href="ticket.php";
                console.log(detalles);
            });
        },
        onCancel:function(data){
            alert("Cancelado");
            console.log(data);
        }

       

    }).render('#paypal-button-container');
</script>
                </div>
            </div>
        </div>
       
</body>
</html>