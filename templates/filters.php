<?php 

// get options
$tiny_events_options['show_filters'] = get_option('tiny_events_show_filters') ? get_option('tiny_events_show_filters') : 0;
$tiny_events_options['list_max_width'] = get_option('tiny_events_list_max_width') ? get_option('tiny_events_list_max_width') : '100%';

if ($tiny_events_options['show_filters'] == 1) {
    
    $tiny_events_loop .= '<div class="tiny-events-filters" style="max-width:' . $tiny_events_options['list_max_width'] . '">';

        // date
        $tiny_events_loop .= '<div class="tiny-events-filters__date">';
            $tiny_events_loop .= '<label for="tiny_events_filter_date">Event Date</label>';
            $tiny_events_loop .= '<select id="tiny_events_filter_date">';
                $tiny_events_loop .= '<option value="all">All Events</option>';
            while( $query->have_posts() ){
                $query->the_post();
                $filter_date = get_field('date');
                if (!isset($filter_date_check)) {
                    $filter_date_check = '';
                }
                if ($filter_date) {
                    $filter_converted_date = DateTime::createFromFormat('Ymd', $filter_date);
                    $filter_date_string = $filter_converted_date->format('l j F');
                } else {
                    $filter_date = 'ongoing';
                    $filter_date_string = 'Ongoing events';
                }
                // create the option
                if ($filter_date_check != $filter_date) {
                    $tiny_events_loop .= '<option value="' . $filter_date . '">' . $filter_date_string . '</option>';
                }
                $filter_date_check = $filter_date;
            }
            $tiny_events_loop .= '</select>';
        $tiny_events_loop .= '</div>';

    $tiny_events_loop .= '</div>';
    
}