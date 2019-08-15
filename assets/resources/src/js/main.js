$('form').submit(function(e) {
   e.preventDefault();

   var body = $('body');

   var data = {
      'module': $(body).attr('module'),
      'action': $(body).attr('action'),
      'formtype': $(this).attr('default'),
      'name':  $(this).attr('name'),
      'ajax': $(body).attr('url') + '/' + $(body).attr('module') + '/' + $(this).attr('name')
   };

   if (data['formtype'] != null && data['formtype'] == 'true' && data['name'] != null) {
      console.log('Sending: ' + data['name'] + ' data to: ' + data.ajax);
      $.ajax({
         url: data.ajax,
         type: "post",
         data: $(this).serialize(),
         success: function (response) {
            console.log(response);
         },
         error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
         }
      });
   } else {
      alert('Not a custom form!');
   }
});