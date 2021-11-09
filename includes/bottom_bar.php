<div class="w3-bottom-right w3-padding-medium">
    <div class="w3-hover-amber w3-show-inline-block w3-padding-small">
        <a  title="İçerik Gönder" href="/content_editor/"><img src="/images/pencil.png" style="border-radius: 50%; height: 50px;"></a>
    </div>

    <div class="w3-show-inline-block">
        <button title="Mesaj Gönder" onclick="openMessageBox()" class="w3-border-0 w3-hover-blue" style="background-color: rgba(250,250,250,0);" ><img src="/images/send.png" style="border-radius: 50%; height: 50px;"></button>
        <div id="messageBox" class="w3-border-2 w3-border-orange w3-animate-right">
            <div class="w3-padding-medium">
                <center> <h4>Mesaj Gönder</h4> </center>
            </div>
            <div class="w3-padding-small">
                <button class="w3-btn-block w3-light-gray" onclick="openSelectRoomModal()">Oda Seç</button>
            </div>
            <div class="w3-padding-small">
                <textarea id="messageArea" class="w3-white" readonly></textarea>
                <div id="scrollBottom" class="w3-right-align w3-display-container w3-padding-bottom">
                    <button class="w3-btn-block w3-text-red w3-display-right fa fa-arrow-down" onclick="slideScrolltoBottom()"></button>
                </div>
            </div>
            <div class="w3-padding-small w3-padding-bottom">
                <input id="messageInput" class="w3-white" width="250px" placeholder="mesaj gönder"></input>
                <button title="Gönder"  onclick="sendMessage()" class="w3-border-0 w3-hover-blue" style="background-color: rgba(250,250,250,0);" ><img src="/images/send.png" style="border-radius: 50%; height: 25px;"></button>
            </div>

        </div>
    </div>

</div>

<!-- Modal For Select Message Room -->
<div id="selectRoom" class="w3-modal w3-animate-opacity">
  <div class="w3-modal-content">
    <div class="w3-container">
      <div>
        <div class="w3-padding-medium w3-display-topright w3-show-inline-block">
            <button onclick="document.getElementById('selectRoom').style.display='none'"
            class="w3-btn-floating w3-red fa fa-close"></button>
        </div>      
        <center> <h4 id="headerRoom" style="color:red">Kayıtlı Odaların Listesi</h4> </center>
        <div class="w3-show-inline-block">
            <button class="w3-btn-default w3-green fa fa-address-book" onclick="openCreateNewRoomModal()">Yeni Oda Oluştur</button>
        </div>
      </div>
      <div id="roomList" class="w3-border-amber w3-border-2">
            
      </div>
    </div>
  </div>
</div>

<!--You will create new modal for create a new room...-->
<div id="createRoom" class="w3-modal w3-animate-opacity">
  <div class="w3-modal-content">
    <div class="w3-container">
        <div>
            <div class="w3-padding-medium w3-display-topright w3-show-inline-block">
                <button onclick="document.getElementById('createRoom').style.display='none';"
                class="w3-btn-floating w3-red fa fa-close"></button>
            </div>  
            <div class="w3-padding-medium w3-display-topleft w3-show-inline-block">
            <button onclick="document.getElementById('selectRoom').style.display='block';document.getElementById('createRoom').style.display='none'"
            class="w3-btn-floating w3-red fa fa-arrow-left"></button>
        </div>
            <center> <h4 id="headerRoom" style="color:red">Yeni Oda Oluştur</h4> </center>
            <div class="w3-padding-medium">
                <div class="form-group">
                    <center>
                        <input class="w3-padding-medium" id="roomName" type="text" placeholder="Oda İsmi">  
                        <input class="w3-padding-medium" id="participations" type="text" placeholder="Davetliler" readonly> 
                        <button width="64px"><i class="fa fa-address-book-o" ></i>Kişi Ekle</button>
                    </center>                 
                </div>
                <div class="w3-padding-medium">
                    <button class="w3-btn-block w3-green" onclick="sendCreateRoom()">Odayı Oluştur</button>
                </div>
            </div>                      
        </div>
    </div>
  </div>
</div>


<!--Style Codes-->
<link href="/css/bottom_bar.css" rel="stylesheet" type="text/css"/>


<!--Script codes-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="/js/bottom_bar.js"></script>



