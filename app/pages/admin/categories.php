<?php if($action == 'add'): ?>

<div class="col-md-6 mx-auto">
    <form method="post" enctype="multipart/form-data">
        <h1 class="h3 mb-3 fw-normal text-center">Create Category</h1>
        
        <?php if(!empty($errors)): ?>
        <div class="alert alert-danger">
            Please fix the error below:

        </div>
        <?php endif; ?>

        <div class="form-floating">
        <input value="<?=old_value('category')?>" name="category" type="category" class="form-control mb-2" id="floatingInput" placeholder="category">
        <label for="floatingInput">Category</label>
        </div>
        <?php if(!empty($errors['category'])): ?>
        <div class="text-danger">
            <?=$errors['category']?>
        </div>
        <?php endif; ?>

        <div class="form-floating">
        <select name="disabled" id="" class="form-select my-3">
            <option value="0">Yes</option>
            <option value="1">No</option>
        </select>
        <label for="floatingInput">Active</label>
        </div>
        
        <a href="<?=ROOT?>/admin/categories">
            <button class="mt-4 btn btn-lg btn-primary" type="button">Back</button>
        </a>
        <button class="mt-4 btn btn-lg btn-primary" type="submit">Add</button>
        
    </form>
</div>

<?php elseif($action == 'edit'): ?>
<div class="col-md-6 mx-auto">
    <form method="post" enctype="multipart/form-data">
        <h1 class="h3 mb-3 fw-normal text-center">Edit Category</h1>

        <?php if(!empty($row)): ?>
        <?php if(!empty($errors)): ?>
        <div class="alert alert-danger">
            Please fix the error below:

        </div>
        <?php endif; ?>

        <div class="form-floating">
        <input value="<?=old_value('category', $row['category'])?>" name="category" type="category" class="form-control mb-2" id="floatingInput" placeholder="category">
        <label for="floatingInput">Category</label>
        </div>
        <?php if(!empty($errors['category'])): ?>
        <div class="text-danger">
            <?=$errors['category']?>
        </div>
        <?php endif; ?>


        <div class="form-floating">
        <select name="disabled" id="" class="form-select my-3">
            <option <?=$row['disabled']=='0' ? ' selected ': ''?> value="0">Yes</option>
            <option <?=$row['disabled']=='1' ? ' selected ': ''?> value="1">No</option>
        </select>
        <label for="floatingInput">Active</label>
        </div>
        
        <a href="<?=ROOT?>/admin/categories">
            <button class="mt-4 btn btn-lg btn-primary" type="button">Back</button>
        </a>
        <button class="mt-4 btn btn-lg btn-primary float-end" type="submit">Save</button>

        <?php else: ?>
            <div class="alert alert-danger text-center">Record not found</div>
        <?php endif; ?>
    </form>
</div>

<?php elseif($action == 'delete'): ?>
<div class="col-md-6 mx-auto">
    <form method="post">
        <h1 class="h3 mb-3 fw-normal text-center">Delete Category</h1>
        
        <?php if(!empty($row)): ?>
        <?php if(!empty($errors)): ?>
        <div class="alert alert-danger">
            Please fix the error below:

        </div>
        <?php endif; ?>

        <div class="form-floating">
        <div class="form-control mb-2" id="floatingInput"><?=old_value('category', $row['category'])?></div>
        </div>
        <?php if(!empty($errors['category'])): ?>
        <div class="text-danger">
            <?=$errors['category']?>
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
        
        <a href="<?=ROOT?>/admin/categories">
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
    Categories
    <a href="<?=ROOT?>/admin/categories/add">
        <button class="btn btn-primary">Add new</button> 
    </a>
</h4>
<div class="table-responsive">
<table class="table">
    <tr>
        <th>#</th>
        <th>Category</th>
        <th>Slug</th>
        <th>Disabled</th>
        <th>Action</th>
    </tr>

    <?php
        $limit = 10;
        $offset = ($PAGE['page_no'] -1) * $limit;

        $query = "select * from categories order by id desc limit $limit offset $offset";
        $rows = db_query($query);
    ?>

    <?php if(!empty($rows)):?>
        <?php foreach($rows as $row): ?>
        <tr>
            <td><?=$row['id']?></td>
            <td><?=esc($row['category'])?></td>
            <td><?=$row['slug']?></td>
            <td><?=$row['disabled']?></td>
            
            <td>
                <a href="<?=ROOT?>/admin/categories/edit/<?=$row['id']?>">
                    <button class="btn btn-warning btn-sm text-white"><i class="bi bi-pencil-square"></i></button>
                </a>
                <a href="<?=ROOT?>/admin/categories/delete/<?=$row['id']?>">
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