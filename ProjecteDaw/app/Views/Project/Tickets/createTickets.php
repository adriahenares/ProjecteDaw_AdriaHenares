<?php
 $this->extend('layouts/mainLayout');

echo $this->section("main_content");
?>

<div class="container-fluid p-0 m-0 ">
    <div class="row">
        <div id="centres">
            <form action="<?php base_url("/addTickets") ?>" method="POST">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="description">Descripció</label>
                    <textarea class="form-control" name="description" id="description" cols="30" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="device">Dispositiu</label>
                    <select class="form-control" name="device" id="device">
                        <?php
                        $valueN = 1;
                        foreach ($device as $value) {
                            echo "<option value='" . $valueN . "'>" . $value . "</option>";
                            $valueN++;
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="center_g">Centre generador</label>
                    <select class="form-control" name="center_g" id="center_g">
                        <?php
                        echo "<option value='0' selected ></option>";
                        foreach ($center as $value) {
                            echo "<option value='" . $value['center_id'] . "'>" . $value['name'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <input type="text" id="search1" placeholder="Busca...">
                </div>
                <div>
                    <label for="center_r">Centre reparador</label>
                    <select class="form-control" name="center_r" id="center_r">
                        <?php
                        echo "<option value='0' selected ></option>";
                        foreach ($center as $value) {
                            echo "<option value='" . $value['center_id'] . "'>" . $value['name'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="<?= base_url("/viewTickets") ?>" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    const search1 = document.getElementById('search1');
    const select1 = document.getElementById('center_r');
    //const search2 = document.getElementById('search2');
    const select2 = document.getElementById('center_g');
    search1.addEventListener('input', filterR)

    function filterR() {
        var textToFilter = search1.value.toUpperCase();
        var options = select1.options;
        for (var i = 0; i < options.length; i++) {
            var txtValue = options[i].text.toUpperCase();
            if (txtValue.indexOf(textToFilter) > -1) {
                options[i].style.display = "";
            } else {
                options[i].style.display = "none";
            }
        }
    }
</script>
<?php echo $this->endSection(); ?>