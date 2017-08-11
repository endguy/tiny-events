function runEvents() {

    // Events Loop Filtering
    function eventsFilter() {

        // event date
        document.querySelector('#tiny_events_filter_date').addEventListener('change',function(){
            var filterDate = this.value;
            var theEvents = document.querySelectorAll('.tiny-event-wrap');
            theEvents.forEach(function(item) {
                var eventDate = item.getAttribute('data-event-date');
                if ((eventDate == filterDate) || (filterDate == 'all')) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });

        });

    }
    eventsFilter();



}

// in case the document is already rendered
if (document.readyState!='loading') runEvents();
// modern browsers
else if (document.addEventListener) document.addEventListener('DOMContentLoaded', runEvents);
// IE <= 8
else document.attachEvent('onreadystatechange', function(){
    if (document.readyState=='complete') runEvents();
});