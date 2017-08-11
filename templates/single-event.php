<?php get_header( 'singular' ); ?>

<?php // build the event
    $event = '';
    $event['title'] = get_the_title();
    $event['ID'] = get_the_ID();
    $terms = get_the_term_list($event['ID'],'event_type', '', ', ');
    $event['type'] = strip_tags($terms);
    $event_image = get_field('event_image');
    $event['image'] = $event_image ? $event_image['sizes']['large'] : '' ;
    $event['short_description'] = get_field('short_description');
    $event['long_description'] = get_field('long_description');
    $event['partners'] = get_field('partners');
    $event['sponsors'] = get_field('sponsors');
    $event_logo = get_field('event_logo');
    $event['event_logo'] = $event_logo ? $event_logo['sizes']['medium'] : '' ;
    $event['venue'] = get_field('venue');
    $date = get_field('date');
    $event['date_string'] = '';
    $event['date'] = '';
    if ($date) {
        $converted_date = DateTime::createFromFormat('Ymd', $date);
        $event['date_string'] = $converted_date->format('l j F');
        $event['date'] = $converted_date->format('d/m/Y');
    }
    $start_time = get_field('start_time');
    $event['start_time'] = '';
    if ($start_time) {
        $start_time_object = get_field_object('start_time');
        $event['start_time'] = $start_time_object['choices'][ $start_time ];
    }
    $end_time = get_field('end_time');
    $event['end_time'] = '';
    if ($end_time) {
        $end_time_object = get_field_object('end_time');
        $event['end_time'] = $end_time_object['choices'][ $end_time ];
    }
    $event['speakers'] = get_field('speakers');
    $event['organisation'] = get_field('organisation');
    $event['cost'] = get_field('cost');
    $event['free_event'] = get_field('free_event');
    $event['primary_theme'] = get_field('primary_theme');
    $event['sub_theme'] = get_field('sub_theme');
    $website = get_field('website');
    $event['website'] = $website;
    if ((strpos($website,'http://') == false) || (strpos($website,'https://') == false)) {
        $website_url = 'http://' . $website;
    } else {
        $website_url = $website;
    }
    $event['website_url'] = $website_url;
    $event['booking_url'] = get_field('booking_url');
?>

<div id="content" class="site-content page-singular">
    <div id="primary-container" class="content-area page-page primary-page page-singular">
        <div id="breadcrumb">
            <?php get_sidebar('breadcrumb') ?>
        </div>
        <div id="subbanner">
            <?php get_sidebar('subbanner'); ?>
        </div>
        <main id="main" class="site-main" role="main">

            <article id="post-<?= $event['ID'] ?>" class="page type-page status-publish hentry">

                <div class="wrap entry-content">

                    <div class="singular-panel singular-light">
                        <div class="singular-content">
                    
                            <h1 class="tiny-events-single__title"><?= $event['title'] ?></h1>
                            <?php if($event['type']) { ?>
                                <small class="tiny-events-single__type"><em><?= $event['type'] ?></em></small>
                            <?php } ?>

                            <div class="tiny-events-single__keyinfo">
                                
                                <?php if($event['date']) { ?>
                                <!-- Date -->
                                <div class="tiny-events-single__date">
                                    <p>
                                        <img class="tiny-events-single__icon" src="<?= TINY_EVENTS_URL . '/images/icon-cal.png' ?>" alt=""><?= $event['date'] ?>
                                    </p>
                                </div>
                                <?php } ?>

                                <?php if(($event['start_time'] > 0) && ($event['start_time'] < 999999)) { ?>
                                <!-- Time -->
                                <div class="tiny-events-single__time">
                                    <p>
                                        <img class="tiny-events-single__icon" src="<?= TINY_EVENTS_URL . '/images/icon-clock.png' ?>" alt=""><?= $event['start_time'] ?><?php if(($event['end_time'] > 0) && ($event['end_time'] < 999999)) { ?> - <?= $event['end_time'] ?><?php } ?>
                                    </p>
                                </div>
                                <?php } ?>

                                <?php if($event['free_event'] || $event['cost']) { ?>
                                <!-- Cost -->
                                <div class="tiny-events-single__cost">
                                    <p>
                                        <img class="tiny-events-single__icon" src="<?= TINY_EVENTS_URL . '/images/icon-dollar.png' ?>" alt="">
                                        <?php if($event['free_event']) { ?>
                                            FREE
                                        <?php } elseif ($event['cost']) { ?>
                                            $<?= $event['cost'] ?>
                                        <?php } ?>
                                    </p>
                                </div>
                                <?php } ?>

                            </div>

                            <div class="row">
                                <div class="col-md-9">

                                    <div class="tiny-events-single">

                                        <?php if($event['image']) { ?>
                                        <!-- image -->
                                        <div class="tiny-events-single__image">                
                                            <img src="<?= $event['image'] ?>" alt="<?= $event['title'] ?>">
                                        </div>
                                        <?php } ?>

                                        <?php if($event['short_description']) { ?>
                                        <!-- short description -->
                                        <div class="tiny-events-single__shortdesc">
                                            <p><strong><?= $event['short_description'] ?></strong></p>
                                        </div>
                                        <?php } ?>

                                        <?php if($event['long_description']) { ?>
                                        <!-- long description -->
                                        <div class="tiny-events-single__longdesc">
                                            <p><?= $event['long_description'] ?></p>
                                        </div>
                                        <?php } ?>

                                        <?php if($event['partners']) { ?>
                                        <!-- partners -->
                                        <div class="tiny-events-single__partners">
                                            <h2>Event partners</h2>
                                            <p><strong><?= $event['partners'] ?></strong></p>
                                        </div>
                                        <?php } ?>

                                        <?php if($event['sponsors']) { ?>
                                        <!-- sponsors -->
                                        <div class="tiny-events-single__sponsors">
                                            <h2>Event sponsors</h2>
                                            <p><strong><?= $event['sponsors'] ?></strong></p>
                                        </div>
                                        <?php } ?>

                                    </div>

                                </div>
                            
                                <div class="col-md-3">

                                    <?php if($event['event_logo']) { ?>
                                    <!-- logo -->
                                    <div class="tiny-events-single__logo">
                                        <p>
                                            <img src="<?= $event['event_logo'] ?>" alt="<?= $event['title'] ?> logo">
                                        </p>
                                    </div>
                                    <?php } ?>

                                    <?php if($event['organisation']) { ?>
                                    <!-- organisation -->
                                    <div class="tiny-events-single__organisation">
                                        <p>
                                            <strong>Organisation</strong><br>
                                            <?= $event['organisation'] ?>
                                        </p>
                                    </div>
                                    <?php } ?>

                                    <?php if($event['venue']) { ?>
                                    <!-- venue -->
                                    <div class="tiny-events-single__venue">
                                        <p>
                                            <strong>Venue</strong><br>
                                            <?= $event['venue'] ?>
                                        </p>
                                    </div>
                                    <?php } ?>

                                    <?php if($event['speakers']) { ?>
                                    <!-- Speakers -->
                                    <div class="tiny-events-single__speakers">
                                        <p>
                                            <strong>Speakers</strong><br>
                                            <?= $event['speakers'] ?>
                                        </p>
                                    </div>
                                    <?php } ?>

                                    <?php if($event['primary_theme']) { ?>
                                    <!-- Primary Theme -->
                                    <div class="tiny-events-single__primarytheme">
                                        <p>
                                            <strong>Primary theme</strong><br>
                                            <?= $event['primary_theme'] ?>
                                        </p>
                                    </div>
                                    <?php } ?>

                                    <?php if($event['sub_theme']) { ?>
                                    <!-- Sub Theme -->
                                    <div class="tiny-events-single__subtheme">
                                        <p>
                                            <strong>Sub theme</strong><br>
                                            <?= $event['sub_theme'] ?>
                                        </p>
                                    </div>
                                    <?php } ?>

                                    <?php if($event['website']) { ?>
                                    <!-- Website -->
                                    <div class="tiny-events-single__website">
                                        <p>
                                            <strong>Website</strong><br>
                                            <a href="<?= $event['website_url'] ?>" target="_blank"><?= $event['website'] ?></a>
                                        </p>
                                    </div>
                                    <?php } ?>

                                    <?php if($event['booking_url']) { ?>
                                    <!-- Booking URL -->
                                    <div class="tiny-events-single__booking">
                                        <p>
                                            <strong>Registration</strong><br>
                                            <a href="<?= $event['booking_url'] ?>" target="_blank"><?= $event['booking_url'] ?></a>
                                        </p>
                                    </div>
                                    <?php } ?>
                                
                                </div>

                            </div>

                        </div>
                    </div>
                </div><!-- .wrap -->

            </article>

        </main><!-- .site-main -->
    </div><!-- #primary-container -->
    <div id="secondary-container" class="sidebar-area secondary-page page-singular">
        <?php get_sidebar('column'); ?>
    </div><!-- #secondary-container -->

<?php get_footer();
