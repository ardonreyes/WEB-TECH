<?php 
    $this->extend('layouts/main_layout');
    $this->section('content');
?>

<div class="container-dashboard">
    <div class="titles-container-dashboard">
        <div class="titles-dashboard">
            <h1>USERS</h1>
            <p>Registered users in our system.</p>
        </div>
        <div class="icon-titles-dashboard">
            <button>≡≡</button>
        </div>
    </div>
    
    <?php 
        for($i = 0; $i < 5; $i++){
            echo "
                    <div class=\"customer-node\">
                        <h1>{$data[$i][0]}</h1>
                        <p>{$data [$i][3]}</p>
                        <p>{$data [$i][4]}</p>
                    </div>
                ";
        }
    ?>

</div>


<?= $this->endSection() ?>