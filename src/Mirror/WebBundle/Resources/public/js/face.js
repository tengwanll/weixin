$(document).ready(function () {
    const now = new Date();
    $('#now').text(
        now.getFullYear() + '-' + now.getMonth()+ '-' + now.getDate() + ' '  +
        now.getHours() + ':' + now.getMinutes() + ':' +now.getSeconds()
    );
    $('input[type="checkbox"]').bootstrapSwitch({
        size: 'mini',
        onText: '',
        offText: '',
        handleWidth: 10
    });

    
})