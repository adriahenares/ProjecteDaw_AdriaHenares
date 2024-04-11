<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> -->
    <title>Tickets</title>
</head>

<body>
<!-- <body class="m-0 p-0"> -->
    <div class="contain-fluid">

        <div class="row">

            <div class="col-12">
                
                <div class="col-12 px-2  bg-black"style="heigth: 80px" >
                        <img src="<?= base_url('Logo.png') ?>" alt="Logo" style="max-width: 90px">
                        <!-- <img src="<? base_url('gencat_cat_blanc.png') ?>" alt="Logo" style="max-width: 90px"> -->
                </div>
            </div>

        </div>


        <?php echo $this->renderSection("main_content") ?>
    </div>
</body>
</html>

