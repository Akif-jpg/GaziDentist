const api = "/api/friendSystem/";

const friendRequestURL = api + "send_friend_request.php";

let params = new URLSearchParams(window.location.search);
let friendStatus = $('#friendStatus');
friendStatus.click(function(event){
    $.ajax({
        type:'POST',
        url: friendRequestURL,
        data: {"requestedUser": params.get("user")},
        success:function(res){
           friendStatus.text(res);
           friendStatus.css("background-color","blue")
        }
    });
});