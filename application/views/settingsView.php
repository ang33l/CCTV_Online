<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#"></a>
    <a class="navbar-brand ml-2" href="#">CCTV Online</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link" href="../admin">Podgląd kamery</a>
            <a class="nav-item nav-link active" href="../admin/settings">Ustawienia</a>
            <a class="nav-item nav-link" href="../login/logout">Wyloguj</a>
        </div>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-md-6 p-3">
            <h2>Zarządzaj dostępem do kamery</h2>
            <div class="form-group">
                <h5>Kamera: <?php 
                if(!$camera_status) {
                    echo '<span class="text-danger">wyłączona</span><br>'; 
                    echo '<a href="'.base_url().'admin/changeCameraState" class="btn btn-success">Włącz</a>';
                }
                else {
                    echo '<span class="text-success">włączona</span><br>'; 
                    echo '<a href="'.base_url().'admin/changeCameraState" class="btn btn-danger">Wyłącz</a>';
                }
                
                ?></h5>
                <?php if($user == "admin"){

                ?>
                <form action="javascript:activeHours()">
                    <div>
                        <h5>Wybierz użytkownika, któremu zostaną zmienione uprawnienia do kamery</h5>
                        <select class="form-select formVal" name="user">

                            <option value="" selected disabled hidden>Wybierz użytkownika</option>
                            <?php foreach($users as $user){
                  echo "<option value='".$user['user_id']."'>".$user['user_name']."</option>";
                }
                ?>
                        </select>
                    </div>


                    <h5 class="mt-2">Godziny aktywnej pracy kamery</h5>

                    <div class="form-group col-sm-6">
                        <div class='input-group date'>
                            <input name="from" type='time' class="form-control formVal" required />
                            <input name="to" type='time' class="form-control formVal" required />
                        </div>

                    </div>
                    <div id="error-window2" style="display: none"></div>
                    <button class="btn btn-primary mt-3">Zatwierdź zmiany</button>
                </form>
                <?php } else echo "<h4>Brak uprawnień, zaloguj się na konto admina w celu zmian ustawień</h4>";?>
            </div>

        </div>
        <div class="col-md-6 p-3">
            <h2>Zarządzaj swoim kontem</h2>
            <div class="form-group">
                <h4>Zmiana hasła</h4>
                <form action="javascript:changePassword()">
                    <div class="mb-3">
                        <label for="pass" class="form-label">Aktualne hasło</label>
                        <input name="pass" type="password" class="form-control passVal" id="pass">
                    </div>
                    <div class="mb-3">
                        <label for="newPass" class="form-label">Nowe hasło</label>
                        <input name="newPass" type="password" class="form-control passVal" id="newPass">
                    </div>
                    <div class="mb-3">
                        <label for="rePass" class="form-label">Potwierdź nowe hasło</label>
                        <input name="rePass" type="password" class="form-control passVal" id="rePass">
                    </div>
                    <div id="error-window" style="display: none"></div>
                    <button class="btn btn-primary mt-3">Zatwierdź zmiany</button>
                </form>

            </div>

        </div>
    </div>
</div>
<script>
function changePassword() {
    var elements = document.getElementsByClassName("passVal");
    var formData = new FormData();
    for (var i = 0; i < elements.length; i++) {
        formData.append(elements[i].name, elements[i].value);
    }
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            if (xmlHttp.responseText == "1") {
                console.log(xmlHttp.responseText);
                //window.location.replace("<= base_url() ?>admin");
                document.getElementById("error-window").style.display = "";
                document.getElementById("error-window").innerHTML =
                    '<span class="text-success">Hasło zostało zmienione pomyślnie!</span>';
                for (var i = 0; i < elements.length; i++) {
                    elements[i].value = "";
                }
            } else if (xmlHttp.responseText == "-1") {
                console.log(xmlHttp.responseText);
                document.getElementById("error-window").style.display = "";
                document.getElementById("error-window").innerHTML =
                    '<span class="text-warning">Nowe hasło nie może być takie samo jak aktualne.</span>';
            } else if (xmlHttp.responseText == "-2" || xmlHttp.responseText == "-3") {
                console.log(xmlHttp.responseText);
                document.getElementById("error-window").style.display = "";
                document.getElementById("error-window").innerHTML =
                    '<span class="text-danger">Podane hasło jest niepoprawne!</span>';
            }

        }
    }
    xmlHttp.open("post", "<?= base_url() ?>admin/changePassword");
    xmlHttp.send(formData);
}

function changeCameraState() {

}

function activeHours() {
    var elements = document.getElementsByClassName("formVal");
    var formData = new FormData();
    for (var i = 0; i < elements.length; i++) {
        formData.append(elements[i].name, elements[i].value);
    }
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            if (xmlHttp.responseText == "1") {
                console.log(xmlHttp.responseText);
                //window.location.replace("<?= base_url() ?>admin");
            } else {
                console.log("błont");
                //document.getElementById("error-window").style.display = "";
            }
            if (xmlHttp.responseText == "1") {
                document.getElementById("error-window2").style.display = "";
                document.getElementById("error-window2").innerHTML =
                    '<span class="text-success">Dane zostały zmienione pomyślnie!</span>';
                for (var i = 0; i < elements.length; i++) {
                    elements[i].value = "";
                }
                setTimeout('document.getElementById("error-window2").style.display = "none"', 2000);
            } else if (xmlHttp.responseText == "-1") {
                console.log(xmlHttp.responseText);
                document.getElementById("error-window2").style.display = "";
                document.getElementById("error-window2").innerHTML =
                    '<span class="text-warning">Nie udało się zmienić danych!</span>';
                setTimeout('document.getElementById("error-window2").style.display = "none"', 2000);
            }
        }
    }
    xmlHttp.open("post", "<?= base_url() ?>admin/changeActiveHours");
    xmlHttp.send(formData);
}
</script>