<?php

if($action == "add"){
    if(!empty($_POST)){
      //validate
  
      $errors = [];
  
      if(empty($_POST['category'])){ 
        $errors['category'] = "A category is required";
      }else
      if(!preg_match("/^[a-zA-Z0-9 \-\_\&\[\]]+$/", $_POST['category'])){
        $errors['category'] = "category can contain only have text";
      }

      $slug = str_to_url($_POST['category']);
      
      $query = "select id from categories where slug = :slug limit 1";
      $slug_row = db_query($query, ['slug' => $slug]);
  
      
      if($slug_row){
        $slug .= rand(1000,9999);
      }

      if(empty($errors)){
        //save
        $data = [];
        $data['category'] = $_POST['category'];
        $data['slug'] = $slug;
        $data['disabled'] = $_POST['disabled'];
  
        $query = "insert into categories (category,slug,disabled) values (:category,:slug,:disabled)";
            
        db_query($query, $data);
        redirect('admin/categories');
      }
    }
  }else
  if($action == "edit"){
    $query = "select * from categories where id = :id limit 1";
    $row = db_query_row($query, ['id'=>$id]);
    if(!empty($_POST)){
      
      //validate
      
      if($row){

        $errors = [];
      
        if(empty($_POST['category'])){
          $errors['category'] = "A category is required";
        }else
        if(!preg_match("/^[a-zA-Z0-9 \-\_\&\[\]]+$/", $_POST['category'])){
          $errors['category'] = "category can contain only text";
        }
          
        $query = "select id from categories where category = :category && id!=:id limit 1";
        $c = db_query($query, ['category' => $_POST['category'], 'id'=>$id]);
      
        if(empty($_POST['category'])){
          $errors['category'] = "A category is required";
        }else
        if($c){
          $errors['category'] = "This category has already been registered";
        }
      
        if(empty($errors)){
            //save
          $data = [];
          $data['category'] = $_POST['category'];
          $data['disabled'] = $_POST['disabled'];
          $data['id'] = $id;

          $query = "update categories set category = :category, disabled = :disabled where id = :id limit 1";
          db_query($query, $data);
      
          redirect('admin/categories');
        }
      }
    }
  }else
  if($action == 'delete'){
    $query = "select * from categories where id = :id limit 1";
    $row = db_query_row($query, ['id'=>$id]);

    if(!empty($_SERVER['REQUEST_METHOD'] == 'POST')){
      
      //validate
      
      if($row){

        $errors = [];
        if(empty($errors)){
            //delete
          $data = [];
          $data['id'] = $id;
            
          
          $query = "delete from categories where id = :id limit 1";
          
          db_query($query, $data);
      
          redirect('admin/categories');
        }
      }
    }
  }
