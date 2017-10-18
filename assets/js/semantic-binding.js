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
    /*
      $('.ui.address').find('input').on('change keyup', function () {
        console.log('address changed');
        console.log($(this).val());
        console.log("{{ path('red_carpet_core_address_autocomplete') }}");
        $.ajax({
          url: "/ajax_request",
          type: "POST",
          data: $(this).val(),
          async: true,
          success: function (data) {
            console.log(data);
          }
        })
      });
      */

    $('.ui.address').find('input').on('change keyup', function () {
        console.log('address changed');
        var $form = $(this).closest('form');
        console.log($(this).val());
        $.ajax({
            url: $form.attr('action'),
            type: "POST",
            data: {address: $(this).val()},
            success: function (data) {
                console.log(data);
            }
        })
    });

});
