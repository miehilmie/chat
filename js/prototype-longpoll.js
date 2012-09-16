var Comet = Class.create();
Comet.prototype = {

  timestamp: 0,
  url: 'ajaxRetrieve.php',
  noerror: true,

  initialize: function() { },

  connect: function()
  {
    this.ajax = new Ajax.Request(this.url, {
      asynchronous: true,
      method: 'get',
      dataType: 'jsonp',
      parameters: { 'timestamp' : this.timestamp },
      onSuccess: function(transport) {
        // handle the server response
        var response = transport.responseText.evalJSON();
        this.comet.timestamp = response['timestamp'];
        this.comet.handleResponse(response);
        this.comet.noerror = true;
      },
      onComplete: function(transport) {
        // send a new ajax request when this request is finished
        if (!this.comet.noerror)
          // if a connection problem occurs, try to reconnect each 5 seconds
          setTimeout(function(){ comet.connect() }, 5000); 
        else
          this.comet.connect();
        this.comet.noerror = false;
      }
    });
    this.ajax.comet = this;
  },

  disconnect: function()
  {
  },

  handleResponse: function(response)
  {
  	jQuery.each(response.obj,function(i,v) {
		jQuery('#chatArea').append('<div><strong>'+response.obj[i].user+': </strong>'+response.obj[i].message+'</div>');
  	});
  },
}
var comet = new Comet();
comet.connect();

jQuery(document).ready(function() {
	jQuery('#postChat').submit(function() {
		jQuery.post('ajaxPost.php', jQuery('#postChat').serialize());
		jQuery('#iMessage').val('');
		return false;
	});
 });
