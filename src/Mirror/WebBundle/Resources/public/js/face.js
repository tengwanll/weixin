$(document).ready(function () {
    const now = new Date();
    $('#now').text(
        now.getFullYear() + '-' + now.getMonth()+ '-' + now.getDate() + ' '  +
        now.getHours() + ':' + now.getMinutes() + ':' +now.getSeconds() 
    );
})