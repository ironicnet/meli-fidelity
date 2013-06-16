$(document).ready(function() { 
   var options = { 
      beforeSubmit:  showRequest,  // pre-submit callback 
success:       showResponse  // post-submit callback 
   }; 

   $('#submit-message-form').ajaxForm(options); 
}); 

function showRequest(formData, jqForm, options) { 
   if($("#message-box").val() == "")
   {
      alert("Por favor escriba un mensaje");
      return false;
   }
   else
   {
      $("#submit-message").attr("disabled", "disabled").addClass("disabled").html("Enviando..."); 
      return true; 
   }
} 

function showResponse(responseText, statusText, xhr, $form)  { 
   $("#submit-message").removeAttr("disabled").removeClass("disabled").html("<i class='icon-ok'></i> Enviar");
   var json_response = $.parseJSON(responseText);
   if(json_response.state == "success")
   {
     $("#no-messages-alert").remove();
      $("#message-box").val("");
      $("#messages").prepend(json_response.new_message_html);
   }
   else
   {
      alert("Se ha producido un error");
   }
} 

