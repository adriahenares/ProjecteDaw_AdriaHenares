<style>
    #menu {
        height: calc(100vh - 110px); 
    }
</style>
<div id="menu" class="col-2 d-flex flex-column pe-0" >

    <div class="d-flex justify-content-start align-items-start h-100 ">

        <div class="bg-dark h-100 w-100" tabindex="0" id="start" aria-labelledby="offcanvasLabel ">

            <div class="mt-2 mb-3" style="text-align: center;">

                <h4 class="title text-white mb-0 ">MENU</h4>

            </div>

            <div style="text-align: center;">

                <div class="mb-3 fs-4" style="text-align: center;">

                    <a class="text-white text-decoration-none" href="<?php echo base_url('/') ?>">Tickets</a>

                </div>

                <div class="mb-3 fs-4" style="text-align: center;">

                    <a class="text-white text-decoration-none" href="<?php echo base_url('/add2fa') ?>">Inventario</a>
                
                </div>

                <div class="mb-3 mx-2 fs-4" style="text-align: center; ">
                    
                    <a class="text-white text-decoration-none" href="<?php echo base_url('/assing') ?>">Assigna Tickets</a>
                
                </div>

            </div>

        </div>

    </div>

</div>