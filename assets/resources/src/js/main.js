$('form').submit(function(e) {
   e.preventDefault();

   var body = $('body');

   var data = {
      'module': $(body).attr('module'),
      'action': $(body).attr('action'),
      'formtype': $(this).attr('default'),
      'name':  $(this).attr('name'),
      'ajax': $(body).attr('url') + '/' + $(body).attr('module') + '/' + $(this).attr('name'),
      'form': $(this),
      'form_result': $(this).find('.form_result')
   };

   if (data['formtype'] != null && data['formtype'] == 'true' && data['name'] != null) {
      console.log('Sending: ' + data['name'] + ' data to: ' + data.ajax);
      $.ajax({
         url: data.ajax,
         dataType: "JSON",
         type: "POST",
         data: $(this).serialize(),
         success: function (response) {
            var response_style = (response.result === false) ? 'danger' : 'success';
            if ($(['data.form_result']).length) {
               $(data['form_result']).remove();
            }
            $(data['form']).prepend('<div class="alert alert-' + response_style + ' form_result">' + response.message + '</div>');
         },
         error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
         }
      });
   } else {
      alert('Not a custom form!');
   }
});