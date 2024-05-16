<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/68a68b86d2.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
    <title> <?= lang('ticketsLang.Tickets')?></title>
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

        .menuButton a {
            width: 12vw;
            display: block;
        }

        .bottom-center {
            /* position: absolute;
            bottom: 90; */
            background-color: #6C757C;
            width: 99.4%;
            margin-left: 4px;
            height: 71px;
            line-height: 71px;
        }

        .titleForm {
            font-size: 32px;
            margin-bottom: 5px;
            background: #6C757C;
            width: 100%;
            margin-top: 5px;
            margin-bottom: 5px;
            color: white;
            padding-left: 10px;
            height: 72px;
            line-height: 72px;
        }

        .btnCancelar {
            background-color: #F9FAFB;
            height: 39px;
        }

        .btnSave {
            background-color: #1E5ED7;
            max-height: 39px;
        }

        .centres {
            display: flex;
            justify-content: center;
            align-items: flex-end;
        }

        .formAdd {
            background-color: #F8F9FA;
        }

        #centres {
            height: 100%;
        }

        #assign {
            height: 100%;
        }

        .select {
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="contain-fluid ">

        <div class="col-12 bgc-1" style="height: 8vh;">
            <!-- <div class="col-12 ps-3 pe-5 bgc-1 py-3 " style="height: 8vh;"> -->
            <img class="ms-4 mt-4" src="<?= base_url('images/gencat_cat_blanc.png') ?>" alt="Logo" style="height: 24px">
            <!-- <img src="<? base_url('Logo.png') ?>" alt="Logo" style="max-width: 60px"> -->
            <div class="mr-4" style="float: right; height: 100%; vertical-align: middle; display: flex; align-content: center; gap: 15px; align-items: center;">
            
            <!--  TODO: fer ifs -->
            
            <a class="m-0" style="text-decoration: none;<?php if(session()->get('lang') == 'es') echo 'border:  5px solid white; border-radius: 35px;'; ?>" class="me-2"  href="<?= base_url('changeLang/es')?>"><img style="border-radius: 10px; width: 26px;"  src="<?= base_url('images/spain.png') ?>"  /></a>
                <h3 class="me-2" style="color: white;" >|</h3>
                <a class="m-0" style="text-decoration: none;<?php if(session()->get('lang') == 'ca') echo 'border: 5px solid white; border-radius: 35px;'; ?>" class="me-3" href="<?= base_url('changeLang/ca')?>"><img style="border-radius: 10px; width: 26px;"src="<?= base_url('images/catalunya.png') ?>" /></a>
                
                <h3 class="me-2" style="color: white;" >|</h3>
                <a class="m-0" style="text-decoration: none;<?php if(session()->get('lang') == 'en') echo 'border: 5px solid white; border-radius: 25px;'; ?>" class="me-3" href="<?= base_url('changeLang/en')?>"><img style="border-radius: 15px; width: 26px;" class="m-0" src="<?= base_url('images/uk.png') ?>" /></a>
                
                <!-- <a style="text-decoration: none; ">
                    <i class="fa-regular fa-circle-user c-5 fa-xl me-4"></i>
                </a> -->
                <a href="<?= base_url('/logout') ?>" style="text-decoration: none; ">
                    <i class="fa-solid fa-right-from-bracket c-5 fa-xl me-3"></i>
                </a>
            </div>

        </div>

        <div class="row " style="height: 92vh; width: 100vw;">

            <div class="bgc-1 c-5 p-0 m-0 h-100 " style="position: fixed; top: 8vh; width: 12vw;">

                <div class="menuButton mt-5 mb-3">
                    <a href="<?= base_url('/viewTickets') ?>" class="py-2 ms-1 c-5 fs-5" style="text-decoration: none;">
                        <i class="fa-solid fa-ticket-simple ms-4 me-2"></i>
                        <?= lang('ticketsLang.Tickets')?>
                    </a>
                </div>
                <div class="menuButton mt-2 mb-3 ">
                    <a class="py-2 ms-1 c-5 fs-5" style="text-decoration: none;">
                        <i class="fa-solid fa-building-columns ms-4 me-2"></i>
                        <?= lang('ticketsLang.centers')?>
                    </a>
                </div>
                <div class="menuButton mt-2 mb-3 ">
                    <a href="<?= base_url('/viewStock') ?>" class="py-2 ms-1 c-5 fs-5" style="text-decoration: none;">
                        <i class="fa-solid fa-boxes-stacked ms-4 me-2"></i>
                        <?= lang('ticketsLang.stock')?>
                    </a>
                </div>
                <div class="menuButton mt-2 mb-3 ">
                    <a href="<?= base_url('/validateStudents') ?>" class="py-2 ms-1 c-5 fs-5" style="text-decoration: none;">
                        <i class="fa-solid fa-user ms-4 me-2"></i>
                        <?= lang('ticketsLang.student')?>
                    </a>
                </div>

                <!-- <div class="menuButton mt-1 mb-3 w-100">
                    <a href="<? base_url('/loginAuth') ?>" class="py-1 ms-1 c-5 fs-5 w-100" style="text-decoration: none; ">
                        <i class="fa-solid fa-ticket-simple ms-4 me-2"></i>
                        Log in
                    </a>
                </div> -->


                <!-- <div class="menuButton mt-1 mb-3 w-100">
                    <a class="py-1 ms-1 c-5 fs-5 w-100" style="text-decoration: none; ">
                        <i class="fa-solid fa-ticket-simple ms-4 me-2"></i>
                        Log out
                    </a>
                </div> -->

            </div>

            <div class="mx-4 my-2 p-3 " style="height:91vh; position: fixed; left: 11vw; overflow-y: auto; width: 87vw;">
                <?php echo $this->renderSection("main_content") ?>
            </div>
        </div>
    </div>
</body>

</html>