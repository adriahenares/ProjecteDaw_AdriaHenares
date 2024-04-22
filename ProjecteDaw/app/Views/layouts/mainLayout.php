<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/68a68b86d2.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Tickets</title>
    <style>
        * {
            font-family: Verdana, Arial, Helvetica, sans-serif;
        }

        .bgc-1 {
            background-color: #333333;
        }

        .bgc-2 {
            background-color: #666666;
        }

        .bgc-3 {
            background-color: #999999;
        }

        .bgc-4 {
            background-color: #DDDDDD;
        }

        .bgc-5 {
            background-color: #F5F5F5;
        }

        .c-1 {
            color: #333333;
        }

        .c-2 {
            color: #666666;
        }

        .c-3 {
            color: #999999;
        }

        .c-4 {
            color: #DDDDDD;
        }

        .c-5 {
            color: #F5F5F5;
        }

        .menuButton {
            cursor: pointer;
            transition: background-color 275ms ease-out;
            color: #F5F5F5;
            text-decoration: none;
        }

        .menuButton:hover {
            background-color: #C00000;
            text-decoration: none;
            color: #F5F5F5;
        }

        .menuButton a:hover {
            text-decoration: none !important;
            color: #F5F5F5;
        }

        /* a:hover{
            background-color: #C00000;
            text-decoration: none;
            color: #F5F5F5;
        } */
    </style>
</head>

<body>
    <div class="contain-fluid ">
        <div class="col-12 ps-3 pe-5 bgc-1 py-3 " style="height: 8vh;">
            <img src="<?= base_url('images/gencat_cat_blanc.png') ?>" alt="Logo" style="height: 24px">
            <!-- <img src="<? base_url('Logo.png') ?>" alt="Logo" style="max-width: 60px"> -->
        </div>

        <div class="row " style="height: 92vh; width: 100vw; ">
            <div class="col-2 bgc-1 c-5 p-0 m-0 h-100 " style="display: fixed;">
                <div class="col-12 menuButton mt-4 mb-2 w-100">
                    <a href="<?= base_url('/viewTickets') ?>" class="py-2 ms-2 c-5 fs-5 col-12 w-100" style="text-decoration: none;">
                        <i class="fa-solid fa-ticket-simple ms-4 me-2"></i>
                        Tickets
                    </a>
                </div>
                <div class="col-12 menuButton mt-1 mb-2 w-100">
                    <a href="<?= base_url('/assing') ?>" class="py-2 ms-2 c-5 fs-5 w-100" style="text-decoration: none;">
                        <i class="fa-solid fa-ticket-simple ms-4 me-2"></i>
                        Assign
                    </a>
                </div>
                <!-- <div class="col-12 menuButton">
                    <a class="py-2 ms-2 c-5 fs-5 w-100" style="text-decoration: none; ">
                        <i class="fa-solid fa-ticket-simple ms-4 me-2"></i>
                        Tickets
                    </a>
                </div> -->
            </div>

            <div class="col-10 p-0 ps-2 pt-2" style="height: 80vh;">
                <?php echo $this->renderSection("main_content") ?>
            </div>
        </div>
    </div>
</body>

</html>