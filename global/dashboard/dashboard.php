<?php
    function checkBusiness(){
        if($_SESSION['business_id'] === null){
            CardSetup();
        }
    }
    
    function cardSetup(){
           echo '<div class="position-relative p-5 text-center text-muted bg-body border border-dashed rounded-5">
                    <h1 class="text-body-emphasis">Placeholder jumbotron</h1>
                    <p class="col-lg-6 mx-auto mb-4">
                    </p>
                    <button class="btn btn-primary px-5 mb-5" type="button">
                        Call to action
                    </button>
                </div>
           ';
    }
?>