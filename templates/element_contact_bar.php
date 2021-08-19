<?php if(get_field('site_contact_email', 'option')): ?>
<div class="item card-list clean">
    <p><strong><i class="far fa-at"></i> Email</strong><br>
    <a href="mailto: <?php the_field('site_contact_email', 'option'); ?>"><?php the_field('site_contact_email', 'option'); ?></a></p>
</div>
<?php endif; ?>

<?php if(get_field('site_contact_phone', 'option')) : ?>
<div class="item card-list clean">
    <p><strong><i class="far fa-mobile"></i> Phone</strong><br>
    <a href="tel: <?php the_field('site_contact_phone', 'option'); ?>"><?php the_field('site_contact_phone', 'option'); ?></a></p>
</div>
<?php endif; ?>

<?php if(get_field('site_contact_address', 'option')): ?>
<div class="item card-list clean">
    <p><strong><i class="far fa-map-marker-alt"></i> Address</strong><br>
    <?php the_field('site_contact_address', 'option'); ?></p>
</div>
<?php endif; ?>

<?php if(get_field('site_contact_hours', 'option')): ?>
<div class="item card-list clean">
    <p><strong><i class="far fa-clock"></i> Oppening Hours</strong><br>
    <?php the_field('site_contact_hours', 'option'); ?></p>
</div>
<?php endif; ?>