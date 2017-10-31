$(document).ready(function () {
    $('.ui.checkbox').checkbox();
    $('.ui.calendar.datetime').calendar({
        ampm: false,
    });
    $('.ui.calendar.date').calendar({
        type: 'date',
    });
    $('.ui.calendar.time').calendar({
        type: 'time',
    });
});
