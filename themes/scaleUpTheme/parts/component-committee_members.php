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
       
        <div class="row">
            <div class="col-6">
                <h5 class="mb-2"><strong><?php echo $committee_title ?></strong></h5>
            </div>
            <div class="col-6">
                <button class="open-committee float-right" data-toggle="collapse" data-target="#committee<?php echo $index_component ?>" aria-expanded="false">
                    <span>View</span>
                    <img height="15" src="https://www.scaleupinstitute.org.uk/wp-content/themes/scaleUpTheme/assets/images/arrow.png">
                </button>
            </div>
        </div>

        <div class="collapse" id="committee<?php echo $index_component ?>">
            <div class="py-3">
                <div class="row committees">
                    <?php foreach ($members as $member):
                        $member_id = $member;
                        $title = get_the_title ($member);
                        $all_fields = get_fields($member);
                    ?>
                        <div class="col-lg-4">
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

        

    </div>
</div>