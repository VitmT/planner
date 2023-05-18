$(document).ready(function(){

    console.log('daaa')
    
    $('.timepicker').timepicker({
        timeFormat: 'HH:mm',
        interval: 30,
        dynamic: false,
        dropdown: true,
        scrollbar: true,
    });

    $('.timepicker2').timepicker({
        timeFormat: 'HH:mm',
        interval: 30,
        dynamic: false,
        dropdown: true,
        scrollbar: true,
        minTime: '00:00',
        maxTime: '05:00'
    });

})