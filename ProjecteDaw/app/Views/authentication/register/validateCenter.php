<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="<?= base_url('/validateCenter') ?>" method="post">
    <?= csrf_field(); ?>
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
        <input type="submit" value="Envia">
    </form>
</body>

</html>
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