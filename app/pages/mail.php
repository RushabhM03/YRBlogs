<?php
    include "includes/header.php";
?>   

<div class="d-flex justify-content-center flex-nowrap ">
    <div>
        <img src="<?=ROOT?>/assets/images/mail.png" alt="">
    </div>
    
</div>

<?php
    $address = $_GET['mail'] ?? 'email@email.com';
    $cont = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer dapibus faucibus eleifend. Nam neque lorem, finibus nec finibus at, sollicitudin et tellus. Suspendisse potenti. Nulla scelerisque nibh rhoncus nibh finibus, quis feugiat nisi commodo. Integer at facilisis massa. Morbi feugiat, diam id fringilla fringilla, diam tellus scelerisque turpis, id ultrices elit felis vel mi. Donec lacinia ipsum felis, sed accumsan ipsum varius sit amet. Fusce eu ultrices elit. Curabitur eu arcu tincidunt, dapibus quam at, consectetur lorem. Nunc dapibus mollis dui, nec dapibus risus bibendum vitae. Nulla gravida felis vel turpis pellentesque, ac facilisis turpis ullamcorper. Vestibulum eu aliquet nibh, eget dignissim ligula. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec molestie sed ante eu vestibulum. Nullam faucibus risus eu ante efficitur commodo. Quisque tincidunt id tellus id condimentum. Sed sit amet lacus euismod, dictum ipsum ac, ullamcorper massa. Nam nec tortor blandit, tristique felis id, tincidunt metus. Maecenas ornare at mi id tristique. Pellentesque tincidunt facilisis sem vel blandit. Vestibulum varius eget lectus ac lobortis. Morbi est sapien, maximus quis sem vitae, blandit accumsan neque. In placerat sapien sapien. Fusce ac ipsum non ante cursus molestie et vitae diam.";
    //mail($address, "Welcome to YKBlogs", $cont);
?>

<?php
    include "includes/footer.php";
?>