$(document).ready(function(){

    console.log('daaa')
    
    $('.timepicker').timepicker({
        timeFormat: 'HH:mm',
        interval: 30,
        dynamic: false,
        dropdown: true,
        scrollbar: true
    });

})