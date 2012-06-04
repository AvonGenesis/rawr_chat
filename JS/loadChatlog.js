//Load the file containing the chat log
function loadLog(){		
        $.ajax({
                url: "chat_container_new.php",
                cache: false,
                success: function(html){
                        $("#chatlog").prepend(html); //Insert chat log into the #chatbox div
                }
        });
}