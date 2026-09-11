<?php 
    $this->extend('layouts/main_layout');
    $this->section('content');
?>

<div class="container-dashboard">
    <div class="titles-container-dashboard">
        <div class="titles-dashboard">
            <h1>CUSTOMERS</h1>
            <p>Registered customers in our system.</p>
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
                        <p>{$data [$i][1]}</p>
                        <p>{$data [$i][2]}</p>
                    </div>
                ";
        }
    ?>

</div>


<?= $this->endSection() ?>