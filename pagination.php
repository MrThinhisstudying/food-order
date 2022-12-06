
<html>
<style>
 
    /* thiết lập style cho thẻ a */
  .pagination a {
    color: black;
    float: left;
    padding:  12px 18px;
    text-decoration: none;
  }
 /* thiết lập style cho class active */
  .pagination a.active {
    background-color: #ff6b81;
    color: white;
    /*Thiết kế hình tròn với CSS*/
    border-radius: 50%;
    
  }
 /* thêm màu nền khi người dùng hover vào class không active */s
  .pagination a:hover:not(.active) {
    background-color: #47b4d1;
    color: white;
    /*Thiết kế hình tròn với CSS*/
    border-radius: 50%;
  }
</style>
  <!-- next page -->
  <div class="pagination" >
    <?php
        if($current_page > 1){
            $prev_page = $current_page -1 ;
        }
        
    ?>
<a class="page-item" href="?per-page=<?=$item_per_page?>&page=<?=$prev_page?>"><<</a>
    <?php for ($num =1; $num <= $totalPages; $num++){
        ?>
        <?php if($num != $current_page) { ?>
            <?php if($num > $current_page - 3 && $num < $current_page +3){ ?>
        <a href="?per-page=<?=$item_per_page?>&page=<?=$num?>"><?=$num?></a>
            <?php } ?>
        <?php } else{ ?>
            
            <a class="active"><?=$num?></a>
            
            <?php }?>
    <?php }?> 
    <?php
        if($current_page <= $totalPages - 1){
            $next_page =$current_page + 1;
        ?>
    <a class="page-item" href="?per-page=<?=$item_per_page?>&page=<?=$next_page?>">>></a>
        <?php
}
?> 
</div>
</html>
