function openEditWindow() {
    document.getElementById("edit-profile-window").style.display = "flex";
}

function closeEditWindow() {
    document.getElementById("edit-profile-window").style.display = "none";
}

function editProfile() {
    var newprofile = document.getElementById("profile-pic-preview").src;
    if (newprofile) {
        document.getElementById("profileuser").src = newprofile;
        closeEditWindow();
    } else {
        document.getElementById("profileuser").src = "../public/picture/non.png";
    }
}

function previewProfile(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById("profile-pic-preview");
        output.src = reader.result;
    };

    reader.readAsDataURL(event.target.files[0]);
}

function open_statswindow() {
    document.getElementById("windowstats").style.display = "flex";
}

function close_statswindow() {
    document.getElementById("windowstats").style.display = "none";
}

function open_achivewindow() {
    document.getElementById("window-achive").style.display = "flex";
}

function close_achivewindow() {
    document.getElementById("window-achive").style.display = "none";
}