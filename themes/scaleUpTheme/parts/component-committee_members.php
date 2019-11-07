<?php 
    $section_title = $values['section_title'];
    $committee_title = $values['committee_title'];
    $members = $values['members'];
?>

<div class="bg-light_gray pt-3 pb-4">
    <div class="container">

        <?php if ($section_title): ?>
            <h4 class="my-4 pb-2"><?php echo $section_title ?></h4>
        <?php endif ?>
       
        <h5 class="mb-2"><strong><?php echo $committee_title ?></strong></h5>

        <div class="row committees">
            <?php foreach ($members as $member):
                $member_id = $member;
                $title = get_the_title ($member);
                $all_fields = get_fields($member);
            ?>
                <div class="col-4">
                    <div class="bg-white box m-2 p-3">
                        <p><?php echo $title ?></p>
                        <p><?php echo $all_fields['position']?></p>
                        <a href="<?php echo $all_fields['link'] ?>">View Linkedin Profile</a>
                    </div>
                </div>
            <?php endforeach ?>
        </div>

    </div>
</div>