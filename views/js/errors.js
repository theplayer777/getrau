var myMessages = ['info','warning','error','success'];

function hideAllMessages()
{
    var messagesHeights = new Array(); // this array will store height for each
	 
    for (i=0; i<myMessages.length; i++)
    {
        messagesHeights[i] = $('.' + myMessages[i]).outerHeight(); // fill array
        $('.' + myMessages[i]).css('top', -messagesHeights[i]); //move element outside viewport	  
    }
//console.log(messagesHeights);
}
$(document).ready(function(){
		 
    // Initially, hide them all
    hideAllMessages();
    showMessage();
    // Show message
    /*for(var i=0;i<myMessages.length;i++)
    {
        showMessage(myMessages[i]);
    }*/
		 
    // When message is clicked, hide it
    $('.message').click(function(){			  
        $(this).animate({
            top: -$(this).outerHeight()
        }, 500);
    });	

		 
});  
                  
function showMessage(type){
    hideAllMessages();				  
    $('.'+type).animate({
        top:"0"
    }, 500);
    setTimeout(function(){
        $('.message').animate({
            top: -$(this).outerHeight()
        }, 500);
    },4000);
}

function showMessagePerso(type,title,text){
    var div = $('<div/>').addClass(type+" message").css('top','421px');
    div.html('<h3>'+title+'</h3><p>'+text+'</p>');
             
    console.log("hello world");
    $("body").append(div);
    showMessage(type);

}