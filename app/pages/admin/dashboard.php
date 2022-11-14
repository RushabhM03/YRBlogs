<link href="<?=ROOT?>/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="<?=ROOT?>/assets/css/dashboard.css" rel="stylesheet">

<h4 class="text-center">Statistics</h4>

<div class="row justify-content-center">
	
	<div class="m-1 col-md-4 bg-light rounded shadow border text-center">
		<h1><i class="bi bi-person-video3"></i></h1>
		<div>
			Admins
		</div>
		<?php 

			$query = "select count(id) as num from users where role = 'admin'";
			$res = db_query_row($query);
		?>
		<h1 class="text-primary"><?=$res['num'] ?? 0?></h1>	</div>
	
	<div class="m-1 col-md-4 bg-light rounded shadow border text-center">
		<h1><i class="bi bi-person-circle"></i></h1>
		<div>
			Users
		</div>
		<?php 

			$query = "select count(id) as num from users where role = 'user'";
			$res = db_query_row($query);
		?>
		<h1 class="text-primary"><?=$res['num'] ?? 0?></h1>	</div>

	<div class="m-1 col-md-4 bg-light rounded shadow border text-center">
		<h1><i class="bi bi-tags"></i></h1>
		<div>
			Categories
		</div>
		<?php 

			$query = "select count(id) as num from categories";
			$res = db_query_row($query);
		?>
		<h1 class="text-primary"><?=$res['num'] ?? 0?></h1>	</div>

	<div class="m-1 col-md-4 bg-light rounded shadow border text-center">
		<h1><i class="bi bi-file-post"></i></h1>
		<div>
			Posts
		</div>
		<?php 

			$query = "select count(id) as num from posts";
			$res = db_query_row($query);
		?>
		<h1 class="text-primary"><?=$res['num'] ?? 0?></h1>
	</div>

</div>


<?php
    $q1 = "select categories.category, count(posts.title) from posts join categories on posts.category_id = categories.id group by categories.category";
    $res1 = db_query($q1);
    //print_r($res);

    $q2 = "select users.username, count(posts.title) from posts join users on posts.user_id = users.id group by users.username";
    $res2 = db_query($q2);
    //print_r($res2);

?>




<canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>

<?php
 //array("y" => 3373.64, "label" => "Germany" ),


$dataPoints1 = array();

foreach($res1 as $row){
    $subar = array("y"=>intval($row['count(posts.title)']), "label"=>$row['category']);
    array_push($dataPoints1, $subar);
     
}

$dataPoints2 = array();

foreach($res2 as $row){
    $subar = array("y"=>intval($row['count(posts.title)']), "label"=>$row['username']);
    array_push($dataPoints2, $subar);
    
}



 
?>

<div id="chartContainer1" class="my-4" style="height: 370px; width: 100%;"></div>


<div id="chartContainer2" class="my-4" style="height: 370px; width: 100%;"></div>


<script>
window.onload = function() {
 
var chart1 = new CanvasJS.Chart("chartContainer1", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "Distribution by categories"
	},
	axisY: {
		title: "Posts"
	},
	data: [{
		type: "column",
		yValueFormatString: "#,##0",
		dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
	}]
});
chart1.render();
//document.getElementById('chartContainer').appendChild(chart); 

 
var chart2 = new CanvasJS.Chart("chartContainer2", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "Distribution by users"
	},
	axisY: {
		title: "Posts"
	},
	data: [{
		type: "column",
		yValueFormatString: "#,##0",
		dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
	}]
});

chart2.render();
chart1.render();
//document.getElementById('chartContainer1').appendChild(chart1); 
}
</script>





<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
          



      <script src="<?=ROOT?>/assets/bootstrap/js/bootstrap.bundle.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous">

      </script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous">

      </script><script src="dashboard.js"></script>
