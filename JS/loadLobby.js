function loadLobby(){
        $.ajax({
            url: "lobby_list.php",
            cache: false,
            success: function(html){
                $("#lobbylist").html(html);
            }
        });
}