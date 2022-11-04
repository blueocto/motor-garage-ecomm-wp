<service-highlight>
    <div class="picture highlight-img-1">
        <?php print(wp_get_attachment_image( get_field("service_image_1", 'option'), "large", array( 'loading' => 'lazy'))); ?>
    </div>
    <div class="picture highlight-img-2">
        <?php print(wp_get_attachment_image( get_field("service_image_2", 'option'), "large", array( 'loading' => 'lazy'))); ?>
    </div>
    <div class="picture highlight-img-3">
        <?php print(wp_get_attachment_image( get_field("service_image_3", 'option'), "large", array( 'loading' => 'lazy'))); ?>
    </div>
    <div class="highlight-content">
        <h2><?php print(get_field("service_heading", "option")); ?></h2>
        <?php print(get_field("service_content", "option")); ?>
        <p><a class="btn" href="<?php print(get_field("service_link_url", "option")); ?>"><?php print(get_field("service_link_text", "option")); ?></a></p>
    </div>
    <div class="picture highlight-img-4">
     <?php print(wp_get_attachment_image( get_field("service_image_4", 'option'), "large", array( 'loading' => 'lazy'))); ?>
    </div>
    <div class="picture highlight-img-5">
        <?php print(wp_get_attachment_image( get_field("service_image_5", 'option'), "large", array( 'loading' => 'lazy'))); ?>
    </div>
    <div class="picture highlight-img-6">
        <?php print(wp_get_attachment_image( get_field("service_image_6", 'option'), "large", array( 'loading' => 'lazy'))); ?>
    </div>
</service-highlight>