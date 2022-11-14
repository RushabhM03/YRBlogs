<?php
    include "includes/header.php";
?>   
<div class="mx-auto col-md-10">
<h1 class= "mx-4 my-4 text-center">Blog</h1>

    <div class="row my-2 justify-content-center">
      
    <?php
        $slug = $url[1] ?? null;
        if($slug){
            $query = "select posts.*, categories.category from posts join categories on posts.category_id = categories.id where posts.slug = :slug limit 1";
            $row = db_query_row($query, ['slug' => $slug]);
    
        }
        
        if(!empty($row)){ ?>
            
            <div class="col-md-12">
                <div class="g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm position-relative">
                    <div class="col-12 d-lg-block">
                        <img class="bd-placeholder-img w-100" width="100%" src="<?=get_image($row['image'])?>" alt="" style="object-fit: cover;">
                    </div>
                    <div class="col p-4 d-flex flex-column position-static ">
                        <strong class="d-inline-block mb-2 text-primary text-center"><?=esc($row['category'] ?? 'Unknown')?></strong>
                        <h3 class="mb-0 text-center"><?=esc($row['title'])?></h3>
                        <div class="mb-1 text-muted text-center"><?=date("jS M, Y",strtotime($row['date']))?></div>
                        <p class="card-text mb-auto"><?=nL2br(add_root_to_images($row['content']))?></p>

                    </div>
                    
                </div>
            </div>
 <?php
        }else{
            echo "No items found";
        }
            
    ?>
          
    </div>
    <?php
      include "includes/footer.php";
    ?>