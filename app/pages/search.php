<?php
    include "includes/header.php";
?>   
<div class="mx-auto col-md-10">
<h1 class= "mx-4 my-4 text-center">Search</h1>

    <div class="row my-2 justify-content-center">
      
    <?php

        $limit = 10;
        $offset = ($PAGE['page_no'] -1) * $limit;

        $find = $_GET['find'] ?? null;
        if($find){
            $find = "%$find%";
            $query = "select posts.*, categories.category from posts join categories on posts.category_id = categories.id where posts.title like :find order by id desc limit $limit offset $offset";
            $rows = db_query($query, ['find' => $find]);
        }

        
        if(!empty($rows)){
            foreach($rows as $row){
                include "includes/post-card.php";
            }
              

        }else{
            echo "No items found";
        }
            
    ?>
          
    </div>
    <div class="col-md-12 mb-4">
        <a href="<?=$PAGE['first_link']?>">
            <button class="btn btn-primary">First Page</button>
        </a>
        <a href="<?=$PAGE['prev_link']?>">
            <button class="btn btn-primary">Prev Page</button>
        </a>
        <a href="<?=$PAGE['next_link']?>">
            <button class="btn btn-primary float-end">Next Page</button>
        </a>
    </div>
    </div>
    <?php
      include "includes/footer.php";
    ?>