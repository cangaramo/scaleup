<?php 
    $quote = $component['pull_quote'];
    $author = $component['author'];
    $company = $component['company'];
?>
<div class="module-quote py-3 px-45 bg-white">

    <div class="bg-blue p-4 quote-cont">
        <p><span class="quote"><?php echo $quote ?></span></p>
        <p class="author"><?php echo $author ?></p>
        <p class="company"><?php echo $company ?></p>
    </div>
   
</div>