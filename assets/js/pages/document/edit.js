$(document).ready(function() {

    previewCard();
    $("#_tab_info").click();

});

$("#_tab_info").on('click', function(event){
  var id = $('#id').val();
  $.post(base_url + "document/tab_info/" + id)
        .done(function(result){
            $('#tab_content').html(result);
        })

});

$("#_tab_routes").on('click', function(event){
  var id = $('#id').val();
  $.post(base_url + "document/tab_routes/" + id)
        .done(function(result){
            $('#tab_content').html(result);
        })

});

function previewCard(){
  var id = $('#id').val();

  $.post(base_url + "document/preview_card/" + id)
        .done(function(result){
            $('#preview_card').html(result);
        })
}