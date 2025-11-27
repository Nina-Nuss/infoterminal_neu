<table id="personenTable">
    <?php
    $personen = array(
        array('name' => 'Hans', 'salt' => 856412, 'id' => 1),
        array('name' => 'Martin', 'salt' => 215863, 'id' => 2)
    );
    for ($i = 0; $i < count($personen); $i++) {
        echo "<tr>
           <th><input id='name_{$personen[$i]['id']}' type='text' value='{$personen[$i]['name']}' readonly></th>
            <th><input id='salt_{$personen[$i]['id']}' type='text' value='{$personen[$i]['salt']}' readonly></th>
            <th><input type='checkbox' value='{$personen[$i]['id']}' ></th>
            <th><button onchange='update(\"{$personen[$i]['id']}\")'>Update</button></th>
            </tr>";
    }
    ?>

</table>

<style>
    #personenTable tr input[type="text"] {
        border: none;
        background-color: transparent;
        font-size: 16px;
        width: 150px;
    }
</style>

<script>
    function update(id) {
        document.getElementById(id).readOnly = false;
    }
</script>