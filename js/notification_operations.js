const friendshipSystemApi = "/api/friendSystem/";

const friendRequestURL = friendshipSystemApi + "send_friend_request.php";
const acceptFriendURL = friendshipSystemApi + "accept_friend_request.php";
const rejectFriendURL = friendshipSystemApi + "reject_friend_request.php";

const chatSystemApi = "/api/chatSystem/";

const joinRoomApi = chatSystemApi + "joinRoom";
const rejectRoomAppointmentApi = chatSystemApi + "rejectRoomAppointment";


let params = new URLSearchParams(window.location.search);
if (document.getElementById("friendStatus") != null) {
    let friendStatus = $('#friendStatus');
    friendStatus.click(function(event) {
        $.ajax({
            type: 'POST',
            url: friendRequestURL,
            data: { "requestedUser": params.get("user") },
            success: function(res) {
                friendStatus.text(res);
                friendStatus.css("background-color", "blue")
            }
        });
    });
}



function acceptFriendRequest(requestedUser) {
    $.ajax({
        type: "POST",
        url: acceptFriendURL,
        data: { "requestedUser": requestedUser },
        success: setTimeout("location.reload(true);", 500)
    });
}

function rejectFriendRequest(requestedUser) {
    $.ajax({
        type: "POST",
        url: rejectFriendURL,
        data: { "requestedUser": requestedUser },
        success: setTimeout("location.reload(true);", 500)
    });
}