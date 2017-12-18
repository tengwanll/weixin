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

    $('#info-form').on('submit', function(event) {
        event.preventDefault();

        var result = $('#info-form').serializeArray().reduce(function(obj, item) {
            if (item.name === 'ability') {
                obj[item.name] = obj[item.name] || [];
                obj[item.name].push(item.value);
                return obj;
            }
            obj[item.name] = item.value;
            return obj;
        }, {});
        result.ability = result.ability || [];
        result.boxId=boxId;

        ajaxAction("post",'/api/face',result,false,function(data,textStatus){
            $('#page1').hide();
            $('#page2').show();
        },function(errno,errmsg){

        });
    })
})