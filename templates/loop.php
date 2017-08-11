<?php

// set random vars
$date_header = '';

// get options
$tiny_events_options['list_max_width'] = get_option('tiny_events_list_max_width') ? get_option('tiny_events_list_max_width') : '100%';

// container
$tiny_events_loop .= '<section class="tiny-events-list" style="max-width:' . $tiny_events_options['list_max_width'] . '">';

    $tiny_events_loop .= '<div class="grid-x grid-margin-x">';
    while( $query->have_posts() ){
    $query->the_post();

        // build event array
        $event = '';
        $event['title'] = get_the_title();
        $event['link'] = get_the_permalink();
        $event['ID'] = get_the_ID();
        $terms = get_the_term_list($event['ID'],'event_type', '', ', ');
        $event['type'] = strip_tags($terms);
        $event_image = get_field('event_image');
        $event['image'] = $event_image ? $event_image['sizes']['medium'] : TINY_EVENTS_URL . '/images/nophoto.png' ;
        $event['description'] = get_field('short_description');
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
        $event['cost'] = get_field('cost');
        $event['free_event'] = get_field('free_event');

        // Date Header
        if ($date && ($date_header != $date)) {
            $tiny_events_loop .= '<div class="large-12 cell tiny-event-wrap" data-event-date="' . $date . '">';
                $tiny_events_loop .= '<h2 class="tiny-events-list__date">' . $event['date_string'] . '</h2>';
                $tiny_events_loop .= '<hr>';
            $tiny_events_loop .= '</div>';
            $date_header = $date;
        } elseif (!$date && ($date_header != 'ongoing')) {
            $tiny_events_loop .= '<div class="large-12 cell tiny-event-wrap" data-event-date="ongoing">';
                $tiny_events_loop .= '<h2 class="tiny-events-list__date">Ongoing Events</h2>';
                $tiny_events_loop .= '<hr>';
            $tiny_events_loop .= '</div>';
            $date_header = 'ongoing';
        }
        
        // Tiny Event
        $tiny_events_loop .= '<div class="large-12 cell tiny-event-wrap" data-event-date="';
        $tiny_events_loop .= ($date) ? $date : 'ongoing';
        $tiny_events_loop .= '">';
            $tiny_events_loop .= '<div class="tiny-event">';

                $tiny_events_loop .= '<div class="tiny-event__header">';
                    $tiny_events_loop .= '<h4>' . $event['title'] . '</h4>';
                    $tiny_events_loop .= '<small class="tiny-event__type"><em>' . $event['type'] . '</em></small>';
                $tiny_events_loop .= '</div>';

                $tiny_events_loop .= '<div class="tiny-event__content">';
                    $tiny_events_loop .= '<div class="tiny-event__image" style="background-image: url(' . $event['image'] . ')"></div>';
                    $tiny_events_loop .= '<div class="tiny-event__content-inner">';
                        
                        // date
                        if($event['date']) {
                        $tiny_events_loop .= '<div class="tiny-event__date">';
                            $tiny_events_loop .= '<p>';
                                $tiny_events_loop .= '<img class="tiny-event__icon" src="' . TINY_EVENTS_URL . '/images/icon-cal.png" alt="">' . $event["date"] . '</a>';
                            $tiny_events_loop .= '</p>';
                        $tiny_events_loop .= '</div>';
                        }

                        // time
                        if(($event['start_time'] > 0) && ($event['start_time'] < 999999)) {
                        $tiny_events_loop .= '<div class="tiny-event__time">';
                            $tiny_events_loop .= '<p>';
                                $tiny_events_loop .= '<img class="tiny-event__icon" src="' . TINY_EVENTS_URL . '/images/icon-clock.png" alt="">' . $event["start_time"];
                                if(($event['end_time'] > 0) && ($event['end_time'] < 999999)) {
                                    $tiny_events_loop .= ' - ' . $event["end_time"];
                                }
                            $tiny_events_loop .= '</p>';
                        $tiny_events_loop .= '</div>';
                        }

                        // cost
                        if($event['free_event'] || $event['cost']) {
                        $tiny_events_loop .= '<div class="tiny-event__cost">';
                            $tiny_events_loop .= '<p>';
                                $tiny_events_loop .= '<img class="tiny-event__icon" src="' . TINY_EVENTS_URL . '/images/icon-dollar.png" alt="">';
                                if($event["free_event"]) {
                                    $tiny_events_loop .= 'FREE';
                                } elseif ($event["cost"]) {
                                    $tiny_events_loop .= '$' . $event["cost"];
                                }
                            $tiny_events_loop .= '</p>';
                        $tiny_events_loop .= '</div>';
                        }

                        // description
                        $tiny_events_loop .= '<p>' . $event['description'] . '</p>';

                    $tiny_events_loop .= '</div>';
                $tiny_events_loop .= '</div>';

                $tiny_events_loop .= '<span class="tiny-event__btn">View event details</span>';

                $tiny_events_loop .= '<a href="' . $event['link'] . '"></a>';

            $tiny_events_loop .= '</div>';
        $tiny_events_loop .= '</div>';

        // clean event array
        $event = '';

    }
    $tiny_events_loop .= '</div>';

$tiny_events_loop .= '</section>'; // end container