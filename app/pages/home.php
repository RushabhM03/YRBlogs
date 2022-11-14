

        <?php
          include "includes/header.php";
        ?>
      
        <h1 class= "mx-4">Featured</h1>

        <div class="row my-2 justify-content-center">
          
          <?php
            $query = "select posts.*, categories.category from posts join categories on posts.category_id = categories.id order by id desc limit 6";
            $rows = db_query($query);
            if($rows){
              foreach($rows as $row){
                include "includes/post-card.php";
              }
              

            }else{
              echo "No items found";
            }
            
          ?>
          
        </div>
    


    <?php
      include "includes/footer.php";
    ?>

      
 
