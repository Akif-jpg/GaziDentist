
function openNav(){
    document.getElementById("mySideBar").style.display = "block";
}

function closeNav(){
    document.getElementById("mySideBar").style.display = "none";    
}

function openCat(){
    if(document.getElementById("catList").style.display == "none" || document.getElementById("catList").style.display == ""){
        document.getElementById("catList").style.display = "block";
    }else{
        document.getElementById("catList").style.display = "none";
    }   
}

function openLastP(){
    if(document.getElementById("lastPosts").style.display == "none" || document.getElementById("lastPosts").style.display == ""){
        document.getElementById("lastPosts").style.display = "block";
    }else{
        document.getElementById("lastPosts").style.display = "none";
    }   
}