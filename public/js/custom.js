$(document).ready(function(){
    $("#createLounge" ).click(function(eventClick) {
        eventClick.preventDefault();
        $("#upload").submit();
    });
});