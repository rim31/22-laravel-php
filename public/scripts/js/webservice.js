// var token = "{{Session::token()}}";
// var url = "{{ route('webService')}}";

$('#buttonAjax').on('click', function() {
	console.log($('#url').text());
  $.ajax({
    method: 'POST',
    url: $('#url').text(),
    data: {
    user_id:$('#user_id').val(),
    exp_id:$('#exp_id').val(),
    image_id:$('#image_id').val(),
    hotspot_id:$('#hotspot_id').val(),
    _token:  $('#token').text(),}
  })
    .done(function(msg) {
      console.log(msg);
      var results = JSON.parse(msg.replace(/&quot;/g,'"'));
      console.log(results);
       for (var i = 0; i < results.length; i++) 
       { 
        console.log(results[i]);
          if(results[i]) 
          {
            for (var j = 0; j < results[i].length; j++) 
            {
              if(results[i][j].id) 
              {
                $("#afficheAjax").append('<p>exp_id : '+results[i][j].id+'</p>');
                $("#afficheAjax").append('<p>exp_name: '+results[i][j].name+'</p>');
              }
              if(results[i][j]) 
              {
               for (var k = 0; k < results[i][j].length; k++) 
               {
                if(results[i][j][k].image_name) 
                  $("#afficheAjax").append('<p>image_name: '+results[i][j][k].image_name+'</p>');
               }
              }
            }
          }
          // if(results[i][j][k].media_id) 
          // $("#afficheAjax").append('<p>hotspot_name :'+results[i].media_id+'</p>');
       }
    });
});

$('#putClient').on('click', function() {
	console.log($('#url').text());
$.ajax({
   url: $('#urlApi').text(),
   type: 'GET',
   data : { user_id : $('#user_id').val(),
    exp_id : $('#exp_id').val(),
    image_id : $('#image_id').val(),
    hotspot_id : $('#hotspot_id').val(),
    },
   success: function(result) {
       console.log(result);
       var results = JSON.parse(result.replace(/&quot;/g,'"'));
       console.log(results);
       $("#afficheAjax").html(result);
       for (var i = 0; i < results.length; i++) 
       { 
        console.log(results[i].id);
          $("#afficheAjax").append('<p>'+results[i].exp_id+'</p>');
       }
    }
  });
});


