// colors
    // 1 #432C68
    // 2 #DE960A
    // 3 #1FAF5A
    // 4 #FB3F3F
$(document).ready(function (e) {

    $(document).ready(function() {

        $('.calendar-load').fullCalendar({
            header: {
                left: 'prev,today,next',
                //center: 'month,agendaFourDay', // buttons for switching between views
                center: 'title',
                right: 'agendaDay,agendaFourDay,agendaWeek,month'
            },
            views: {
                agendaFourDay: {
                    type: 'agenda',
                    duration: { days: 4 },
                    buttonText: '4 day'
                }
            },
            defaultDate: '2015-02-12',
            defaultView: 'agendaWeek',
            eventStartEditable: true,
            eventDurationEditable: true,
            eventLimit: true, // allow "more" link when too many events
            editable: true,
            events: [
                {
                    title: 'All Day Event',
                    start: '2015-02-01',
                    color: '#DE960A'
                },
                {
                    title: 'Long Event',
                    start: '2015-02-07',
                    end: '2015-02-10',
                    color: '#DE960A'
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: '2015-02-09T16:00:00',
                    color: '#432C68'
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: '2015-02-16T16:00:00',
                    color: '#432C68'
                },
                {
                    title: 'Conference',
                    start: '2015-02-11',
                    end: '2015-02-13',
                    color: '#DE960A'
                },
                {
                    title: 'Meeting',
                    start: '2015-02-12T10:30:00',
                    end: '2015-02-12T12:30:00',
                    color: '#1FAF5A'
                },
                {
                    title: 'Lunch',
                    start: '2015-02-12T12:00:00',
                    color: '#1FAF5A'
                },
                {
                    title: 'Meeting',
                    start: '2015-02-12T14:30:00',
                    color: '#1FAF5A'
                },
                {
                    title: 'Happy Hour',
                    start: '2015-02-12T17:30:00',
                    color: '#FB3F3F'
                },
                {
                    title: 'Dinner',
                    start: '2015-02-12T20:00:00',
                    color: '#432C68'
                },
                {
                    title: 'Birthday Party',
                    start: '2015-02-13T07:00:00',
                    color: '#1FAF5A'
                },
                {
                    title: 'Click for Google',
                    url: 'http://google.com/',
                    start: '2015-02-28',
                    color: '#FB3F3F'
                }
            ]
        });

    });
});