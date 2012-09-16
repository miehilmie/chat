 $(document).ready(function() {
	$('#postChat').submit(function() {
		$.post('ajaxPost.php', $('#postChat').serialize());
		$('#iMessage').val('');
		return false;
	});

	getChat();
 });
var timestamp = 0; 
function getChat() {
    $.ajax({
        type: "GET",
        url: "ajaxRetrieve.php?timestamp="+timestamp,
        async: true,
        cache: false,
        dataType: 'json',
        timeout: 28000,
        success: function(data) {
        	$.each(data.obj, function(i,v) {
                $('#chatArea').append('<div><strong>'+data.obj[i].user+': </strong>'+data.obj[i].message+'</div>');
        	});
            timestamp = data.timestamp;
            setTimeout("getChat()", 2000);
        },
        error: function() {
        	setTimeout("getChat()", 1000+Math.random()*3000);
        }
    });
}