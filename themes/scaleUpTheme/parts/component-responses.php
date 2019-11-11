<?php 
    $responses = $values['responses'];
?>
<div class="bg-gray_blue">
    <div class="container py-4">
        <div class="row">
            <div class="col-8">

                <h4>Responses to consultations</h4>

                <?php foreach ($responses as $response): ?>

                    <div class="bg-white p-3 my-3">
                        <div class="row">
                            <div class="col-9">
                                <p class="title-blue-lowercase mb-3"><?php echo ($response['title']) ?></p>
                                <p><?php echo ($response['description']) ?></p>
                            </div>
                            <div class="col-3">
                                <div class="d-flex h-100 align-items-center">
                                    <a href="<?php echo $response['file'] ?>" target="_blank" class="btn-blue float-right">Download<img class="btn-icon" src="<?php echo get_bloginfo('template_url')?>/assets/images/download-icon.png"></a>
                                </div>
                            </div>
                        </div>    
                    </div>

                <?php endforeach ?>

            </div>
        </div>
    </div>
</div>

