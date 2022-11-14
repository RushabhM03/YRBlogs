<?php if($action == 'add'): ?>
<link rel="stylesheet" href="<?=ROOT?>/assets/summernote/summernote-lite.min.css">
<div class="col-md-6 mx-auto">
    <form method="post" enctype="multipart/form-data">
        <h1 class="h3 mb-3 fw-normal text-center">Create Post</h1>
        
        <?php if(!empty($errors)): ?>
        <div class="alert alert-danger">
            Please fix the error below:

        </div>
        <?php endif; ?>

        <div class="my-2">
            Featured Image <br>
        <label class="d-block">
            <img class="mx-auto d-block image-preview-edit" src="<?=get_image('')?>" style="cursor: pointer;width: 150px;height: 150px;object-fit: cover;">
            <input onchange="display_image_edit(this.files[0])" type="file" name="image" class="d-none">
        </label>
        <?php if(!empty($errors['image'])):?>
          <div class="text-danger"><?=$errors['image']?></div>
        <?php endif;?>

        <script>
            
            function display_image_edit(file)
            {
                document.querySelector(".image-preview-edit").src = URL.createObjectURL(file);
            }
        </script>
        </div>


        <div class="form-floating">
        <input value="<?=old_value('title')?>" name="title" type="title" class="form-control mb-2" id="floatingInput" placeholder="name">
        <label for="floatingInput">Title</label>
        </div>
        <?php if(!empty($errors['title'])): ?>
        <div class="text-danger">
            <?=$errors['title']?>
        </div>
        <?php endif; ?>

        <div class="form-floating">
        <select name="category_id" id="" class="form-select my-3">
            <?php
            
                $query = "select * from categories order by id desc";
                $categories = db_query($query);

            ?>
            <option value="">--Select One--</option>
            <?php if(!empty($categories)) :?>
                <?php foreach($categories as $cat) :?>
                    <option <?=old_select('category_id', $cat['id'])?> value="<?=$cat['id']?>"><?=$cat['category']?></option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
        <label for="floatingInput">category</label>
        </div>
        <?php if(!empty($errors['category'])): ?>
        <div class="text-danger">
            <?=$errors['category']?>
        </div>
        <?php endif; ?>

        <div>
        <textarea id="summernote" rows="10" name="content" class="form-control my-2" type="text" id="floatingInput" placeholder="content"></textarea>
        <label for="floatingInput">Content</label>
        </div>
        <?php if(!empty($errors['content'])): ?>
        <div class="text-danger">
            <?=$errors['content']?>
        </div>
        <?php endif; ?>
        
        <a href="<?=ROOT?>/admin/posts">
            <button class="mt-4 btn btn-lg btn-primary" type="button">Back</button>
        </a>
        <button class="mt-4 btn btn-lg btn-primary" type="submit">Create</button>
        
    </form>
</div>

<script src="<?=ROOT?>/assets/js/jquery.js"></script>
<script src="<?=ROOT?>/assets/summernote/summernote-lite.min.js"></script>
<script>
      $('#summernote').summernote({
        placeholder: 'Hello Bootstrap 4',
        tabsize: 2,
        height: 300
      });
</script>

<?php elseif($action == 'edit'): ?>
<link rel="stylesheet" href="<?=ROOT?>/assets/summernote/summernote-lite.min.css">



<div class="col-md-6 mx-auto">
    <form method="post" enctype="multipart/form-data">
        <h1 class="h3 mb-3 fw-normal text-center">Edit Post</h1>
        
        <div class="my-2">
            <label class="d-block">
                <img class = "mx-auto d-block image-preview-edit" src="<?=get_image($row['image'])?>" alt=""style="cursor: pointer; width: 150px; height: 150px; object-fit: cover">
                <input onchange="display_image_edit(this.files[0])" type="file" name="image" class= "d-none">
            </label>
            <script>
                function display_image_edit(file){
                    document.querySelector(".image-preview-edit").src = URL.createObjectURL(file);
                }
            </script>
        </div>

        <?php if(!empty($row)): ?>
        <?php if(!empty($errors)): ?>
        <div class="alert alert-danger">
            Please fix the error below:

        </div>
        <?php endif; ?>

        <div class="form-floating">
        <input value="<?=old_value('title', $row['title'])?>" name="title" type="text" class="form-control" id="floatingInput" placeholder="title">
        <label for="floatingInput">Title</label>
        </div>
        <?php if(!empty($errors['title'])): ?>
        <div class="text-danger">
            <?=$errors['title']?>
        </div>
        <?php endif; ?>

        <div class="form-floating">
        <select name="category_id" id="" class="form-select my-3">
            <?php
            
                $query = "select * from categories order by id desc";
                $categories = db_query($query);

            ?>
            <option value="">--Select One--</option>
            <?php if(!empty($categories)) :?>
                <?php foreach($categories as $cat) :?>
                    <option <?=$row['category_id']==$cat['id'] ? ' selected ': ''?> value="<?=$cat['id']?>"><?=$cat['category']?></option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
        <label for="floatingInput">category</label>
        </div>
        <?php if(!empty($errors['category'])): ?>
        <div class="text-danger">
            <?=$errors['category']?>
        </div>
        <?php endif; ?>

        <div>
        <textarea id="summernote" rows="10" name="content" class="form-control my-2" type="text" id="floatingInput" placeholder="content"><?=old_value('content', add_root_to_images($row['content']))?></textarea>
        <label for="floatingInput">Content</label>
        </div>
        <?php if(!empty($errors['content'])): ?>
        <div class="text-danger">
            <?=$errors['content']?>
        </div>
        <?php endif; ?>
        
        <a href="<?=ROOT?>/admin/posts">
            <button class="mt-4 btn btn-lg btn-primary" type="button">Back</button>
        </a>
        <button class="mt-4 btn btn-lg btn-primary float-end" type="submit">Save</button>

        <?php else: ?>
            <div class="alert alert-danger text-center">Record not found</div>
        <?php endif; ?>
    </form>
</div>
<script src="<?=ROOT?>/assets/js/jquery.js"></script>
<script src="<?=ROOT?>/assets/summernote/summernote-lite.min.js"></script>
<script>
      $('#summernote').summernote({
        placeholder: 'Hello Bootstrap 4',
        tabsize: 2,
        height: 300
      });
</script>

<?php elseif($action == 'delete'): ?>
<div class="col-md-6 mx-auto">
    <form method="post">
        <h1 class="h3 mb-3 fw-normal text-center">Delete Post</h1>
        
        <?php if(!empty($row)): ?>
        <?php if(!empty($errors)): ?>
        <div class="alert alert-danger">
            Please fix the error below:

        </div>
        <?php endif; ?>

        <div class="form-floating">
        <div class="form-control mb-2" id="floatingInput"><?=old_value('title', $row['title'])?></div>
        </div>
        <?php if(!empty($errors['title'])): ?>
        <div class="text-danger">
            <?=$errors['title']?>
        </div>
        <?php endif; ?>

        <div class="form-floating">
        <div class="form-control" id="floatingInput"><?=old_value('slug', $row['slug'])?></div>
        </div>
        <?php if(!empty($errors['slug'])): ?>
        <div class="text-danger">
            <?=$errors['slug']?>
        </div>
        <?php endif; ?>
        
        <a href="<?=ROOT?>/admin/posts">
            <button class="mt-4 btn btn-lg btn-info" type="button">Back</button>
        </a>
        <button class="mt-4 btn btn-lg btn-danger float-end" type="submit">Delete</button>

        <?php else: ?>
            <div class="alert alert-danger text-center">Record not found</div>
        <?php endif; ?>
    </form>
</div>

<?php else: ?>    
<h4>
    Posts
    <a href="<?=ROOT?>/admin/posts/add">
        <button class="btn btn-primary">Add new</button> 
    </a>
</h4>
<div class="table-responsive">
<table class="table">
    <tr>
        <th>#</th>
        <th>Title</th>
        <th>Slug</th>
        <th>Image</th>
        <th>Date</th>
        <th>Action</th>
    </tr>

    <?php
        $limit = 10;
        $offset = ($PAGE['page_no'] -1) * $limit;

        $query = "select * from posts order by id desc limit $limit offset $offset";
        $rows = db_query($query);
    ?>

    <?php if(!empty($rows)):?>
        <?php foreach($rows as $row): ?>
        <tr>
            <td><?=$row['id']?></td>
            <td><?=esc($row['title'])?></td>
            <td><?=$row['slug']?></td>
            <td>
                <img src="<?=get_image($row['image'])?>" alt=""style="width: 100px; height: 100px; object-fit: cover">
            </td>
            <td><?=$row['date']?></td>
            <td>
                <a href="<?=ROOT?>/admin/posts/edit/<?=$row['id']?>">
                    <button class="btn btn-warning btn-sm text-white"><i class="bi bi-pencil-square"></i></button>
                </a>
                <a href="<?=ROOT?>/admin/posts/delete/<?=$row['id']?>">
                    <button class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></button>
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>

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
<?php endif; ?>