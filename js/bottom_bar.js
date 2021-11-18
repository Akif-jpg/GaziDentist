const apiUrl = "/api/chatSystem/";

var chatArea = document.getElementById("messageArea");
let mouseOverMessageArea = false;

var connectable = false;
var currentRoomId = -1;

var roomListDiv = document.getElementById("roomList");
let xhr = new XMLHttpRequest();


document.getElementById("scrollBottom").style.display = "none";
// 2. Configure it: GET-request for the URL /article/.../load        

// 3. Send the request over the network       

// 4. This will be called after the response is received
xhr.onload = function() {
    if (xhr.status != 200) { // analyze HTTP status of the response
        alert(`Error ${xhr.status}: ${xhr.statusText}`); // e.g. 404: Not Found
    } else { // show the result  
        roomListDiv.innerHTML = "";
        let responseArray = JSON.parse(xhr.responseText);
        console.log(responseArray);
        if (responseArray.length == 0) {
            roomListDiv.innerHTML = '<div class="w3-center">Hiçbir oda bulunamadı. Login olmayı veya oda oluşturmayı deneyin.</div>'
        } else {
            for (var i = 0; i < responseArray.length; i++) {
                id = responseArray[i]["id"];
                title = responseArray[i]["title"];
                roomListDiv.innerHTML += "<div class='w3-center roomDiv'> <span class='room' onclick=" +
                    "'selectWillConnect(" + id + ")'>" + title +
                    "</span> <span style='font-size: 16px;'><i class='fa fa-gear'></i></span></div>";
            }

        }

    }
}


function openMessageBox() {
    var messageBox = document.getElementById("messageBox");
    if (messageBox.style.display == "inline-block") {
        messageBox.style.display = "none";
        connectable = false;
        console.log("messagebox closed: " + currentRoomId);
    } else {
        messageBox.style.display = "inline-block";
        connectable = true;
    }
}

function openSelectRoomModal() {
    document.getElementById('selectRoom').style.display = "block";
    xhr.open('GET', apiUrl + 'user_message_rooms.php');
    xhr.send();

    chatArea.scrollTop = chatArea.scrollHeight;
}

function openCreateNewRoomModal() {
    document.getElementById('selectRoom').style.display = "none";
    document.getElementById('createRoom').style.display = "block";
}

function sendMessage() {
    //Buraya mesaj göndermeyle ilgili olacak script kodu gelecek.
    var messageContent = document.getElementById("messageInput").value;
    console.log(messageContent);
    document.getElementById("messageInput").value = "";
    $.ajax({
        type: "POST",
        url: apiUrl + "send_message_to_room.php",
        data: { "message": messageContent, "roomId": currentRoomId },
        error: function(res) {
            alert("mesajınız gönderilemedi");
            console.log(res);
        }
    });
}


function sendCreateRoom() {
    var roomName = document.getElementById("roomName").value;
    var participations = document.getElementById("participations").value;
    $.ajax({
        type: "POST",
        url: apiUrl + "create_new_message_room.php",
        data: { 'roomTitle': roomName, 'participants': participations },
        success: function(res) {
            alert("Odanız başarıyla oluşturulmuştur.");
            xhr.open('GET', apiUrl + 'user_message_rooms.php');
            xhr.send();

        }
    });
}

/*
 *Bu fonksiyon herhangi bir odaya bağlanmamızı ve o odanın içerisindeki mesajlaşma bilgilerini almamızı sağlar.
 *Eğer client id bilgisi verilen odaya erişme yetkisine sahip ise o odaya erişebilir. Akis takdirde erişimi reddedilir
 *ve bağlantı başarısız oldu bilgisini alır. 
 */
function selectWillConnect(roomId) {
    currentRoomId = roomId;
}

function connectToRoom(roomId) {
    $.ajax({
        type: "GET",
        url: apiUrl + "connect_message_room.php",
        data: { 'roomId': roomId },
        success: function(res) {
            console.log(res);
            let messageList = JSON.parse(res);
            messageArea = document.getElementById("messageArea");
            messageArea.innerHTML = "";
            for (var i = 0; i < messageList.length; i++) {
                messageArea.innerHTML += messageList[i]["sender"] +
                    " [" + messageList[i]["date"] + "]: " +
                    "&#13;&#10; \t" +
                    messageList[i]["message"] + "&#13;&#10;";
            }
            currentRoomId = roomId;
        },
        error: function(res) {
            alert("Bağlantı başarısız oldu");
            currentRoomId = -1;
        }
    });
}

function slideScrolltoBottom() {
    chatArea.scrollTop = chatArea.scrollHeight;
    mouseOverMessageArea = false;
    document.getElementById("scrollBottom").style.display = "none";
}


function approveConnectToRoom() {
    if (connectable && currentRoomId > 0) {
        connectToRoom(currentRoomId);

        if (!mouseOverMessageArea) {
            chatArea.scrollTop = chatArea.scrollHeight;
        }
    }
}

setInterval(approveConnectToRoom, 1000);

$('#messageArea').scroll(function() {
    if (chatArea.scrollTop + 150 <= chatArea.scrollHeight) {
        document.getElementById("scrollBottom").style.display = "block";
        mouseOverMessageArea = true;
    }
});

$('#messageInput').keypress(
    function(e) {
        var key = e.which;
        if (key == 13) {
            sendMessage();
        }
    }
);

var willAddFriends = "";

function addFriend(friend) {
    //Will add friend to willAddFriends string and it will push to participations
}

function removeFriend(friend) {
    //Will remove friend to willAddFriends string and it will push to participations

}