$('#wdngbutton0').on('click', function(){
    $('#name1').text("Warriors Defender Firewall New Generate");
    $('#name').val("Warriors Defender Firewall New Generate");
});
$('#wdngbutton1').on('click', function(){
    $('#name1').text("Warriors Defender Firewall");
    $('#name').val("Warriors Defender Firewall");
});
$('#wdngbutton2').on('click', function(){
    $('#name1').text("Warriors Defender Mail");
    $('#name').val("Warriors Defender Mail");
});
$('#wdngbutton3').on('click', function(){
    $('#name1').text("Warriors Defender Captive Portal");
    $('#name').val("Warriors Defender Captive Portal");
});
$('#wdngbutton4').on('click', function(){
    $('#name1').text("Warriors Defender Storage");
    $('#name').val("Warriors Defender Storage");
});
$('#wdngbutton5').on('click', function(){
    $('#name1').text("Warriors Defender IPS/IDS");
    $('#name').val("Warriors Defender IPS/IDS");
});
$('#wdngbutton6').on('click', function(){
    $('#name1').text("Warriors Defender Central Console");
    $('#name').val("Warriors Defender Central Console");
});
$('#wdngbutton7').on('click', function(){
    $('#name1').text("Warriors Defender Reporter");
    $('#name').val("Warriors Defender Reporter");
});
$('#type').on('click', function(){
    
    if($('#type').val()=="Sale"){
        $('#users').empty();
        $('#time').empty();
        $('#users').append('<option>15</option>');
        $('#users').append('<option>100</option>');
        $('#users').append('<option>200</option>');
        $('#users').append('<option>300</option>');
        $('#users').append('<option>400</option>');
        $('#users').append('<option>500</option>');
        $('#users').append('<option>600</option>');
        $('#users').append('<option>700</option>');
        $('#users').append('<option>800</option>');
        $('#users').append('<option>900</option>');
        $('#users').append('<option>1000</option>');
        $('#time').append('<option>1</option>');
        $('#time').append('<option>2</option>');
        $('#time').append('<option>3</option>');
        $('#time').append('<option>4</option>');
        $('#time').append('<option>5</option>');
        $('#dm').text("years");
    }else{
        $('#users').empty();
        $('#time').empty();
        $('#users').append('<option>30</option>');
        $('#time').append('<option>5</option>');
        $('#dm').text("days");
    }
    
});
$('#users').on('click', function(){
    alert($('#users').val());
    
});
