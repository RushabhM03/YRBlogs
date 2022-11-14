<?php

if($action == "add"){
    if(!empty($_POST)){
      //validate
  
      $errors = [];
  
      if(empty($_POST['username'])){ 
        $errors['username'] = "A username is required";
      }else
      if(!preg_match("/^[a-zA-Z]+$/", $_POST['username'])){
        $errors['username'] = "username can contain only letters and no spaces";
      }
      
      $query = "select id from users where email = :email limit 1";
      $email = db_query($query, ['email' => $_POST['email']]);
  
      if(empty($_POST['email'])){
        $errors['email'] = "An email is required";
      }else
      if($email){
        $errors['email'] = "This email has already been registered";
      }
  
      if(empty($_POST['password'])){
        $errors['password'] = "A password is required";
      }else
      if(strlen($_POST['password']) < 8){
        $errors['password'] = "password cannot be less than 8 characters";
      }else
      if($_POST['password'] !== $_POST['retype_password']){
        $errors['password'] = 'Passwords do not match';
      }
      
      $allowed = ['image/jpeg','image/png','image/webp'];
      if(!empty($_FILES['image']['name']))
      {
        $destination = "";
        if(!in_array($_FILES['image']['type'], $allowed))
        {
          $errors['image'] = "Image format not supported";
        }else
        {
          $folder = "uploads/";
          if(!file_exists($folder))
          {
            mkdir($folder, 0777, true);
          }

          $destination = $folder . time() . $_FILES['image']['name'];
          move_uploaded_file($_FILES['image']['tmp_name'], $destination);
          resize_image($destination);
              //echo "dest ".$destination;
        }
      }

      if(empty($errors)){
        //save
        $data = [];
        $data['username'] = $_POST['username'];
        $data['email'] = $_POST['email'];
        $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $data['role'] = $_POST['role'];
  
        $query = "insert into users (username,email,password,role) values (:username,:email,:password,:role)";
            
        if(!empty($destination))
        {
          $data['image']     = $destination;
          $query = "insert into users (username,email,password,role,image) values (:username,:email,:password,:role,:image)";
        }
        db_query($query, $data);
        redirect('admin/users');
      }
    }
  }else
  if($action == "edit"){
    $query = "select * from users where id = :id limit 1";
    $row = db_query_row($query, ['id'=>$id]);
    if(!empty($_POST)){
      
      //validate
      
      if($row){

        $errors = [];
      
        if(empty($_POST['username'])){
          $errors['username'] = "A username is required";
        }else
        if(!preg_match("/^[a-zA-Z]+$/", $_POST['username'])){
          $errors['username'] = "username can contain only letters and no spaces";
        }
          
        $query = "select id from users where email = :email && id!=:id limit 1";
        $email = db_query($query, ['email' => $_POST['email'], 'id'=>$id]);
      
        if(empty($_POST['email'])){
          $errors['email'] = "An email is required";
        }else
        if($email){
          $errors['email'] = "This email has already been registered";
        }
      
        if(empty($_POST['password'])){
            
        }else
        if(strlen($_POST['password']) < 8){
          $errors['password'] = "password cannot be less than 8 characters";
        }else
        if($_POST['password'] !== $_POST['retype_password']){
          $errors['password'] = 'Passwords do not match';
        }

        $allowed = ['image/jpeg','image/png','image/webp'];
          if(!empty($_FILES['image']['name']))
          {
            $destination = "";
            if(!in_array($_FILES['image']['type'], $allowed))
            {
              $errors['image'] = "Image format not supported";
            }else
            {
              $folder = "uploads/";
              if(!file_exists($folder))
              {
                mkdir($folder, 0777, true);                
              }
                  
              $destination = $folder . time() . $_FILES['image']['name'];
              move_uploaded_file($_FILES['image']['tmp_name'], $destination);
              resize_image($destination);
            }

          }
      
        if(empty($errors)){
            //save
          $data = [];
          $data['username'] = $_POST['username'];
          $data['email'] = $_POST['email'];
          
          $data['role'] = $_POST['role'];
          $data['id'] = $id;
          
            
          $password_str     = "";
          $image_str        = "";

          if(!empty($_POST['password']))
          {
            $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $password_str = "password = :password, ";
          }

          if(!empty($destination))
          {
            $image_str = "image = :image, ";
            $data['image']       = $destination;
          }
              
          $query = "update users set username = :username, email = :email, $password_str $image_str role = :role where id = :id limit 1";


          db_query($query, $data);
      
          redirect('admin/users');
        }
      }
    }
  }else
  if($action == 'delete'){
    $query = "select * from users where id = :id limit 1";
    $row = db_query_row($query, ['id'=>$id]);

    if(!empty($_SERVER['REQUEST_METHOD'] == 'POST')){
      
      //validate
      
      if($row){

        $errors = [];
      
        
      
        if(empty($errors)){
            //delete
          $data = [];
          $data['id'] = $id;
            
          
          $query = "delete from users where id = :id limit 1";
          
          db_query($query, $data);

          if(file_exists($row['image'])){
            unlink($row['image']);
          }
      
          redirect('admin/users');
        }
      }
    }
  }
