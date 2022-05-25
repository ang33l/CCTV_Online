<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 vh-100 bg-dark d-flex align-items-center">
                        <div class="container-fluid">
                            <div class="col-xs-12">
                                <h1 class="text-light">CCTV Online</h1>
                            </div>
                            <div class="col-xs-12">
                                <h4 class="text-light">Status kamery: <?php if(!$camera_status) echo '<span class="text-danger">wyłączona</span>'; else echo '<span class="text-success">włączona</span>'; ?></h2>
                            </div>
                        </div> 
                    </div>
                    <div class="col-md-6 vh-100 bg-light d-flex align-items-center">
                        <div class="container-fluid">
                            <div class="col-xs-12">
                                <h1 class="text-dark">Logowanie</h1>
                            </div>
                            <div class="col-xs-12">
                                <form action="javascript:myFunction()">
                                    <div class="mb-3">
                                      <label for="Login" class="form-label">Login</label>
                                      <input name="login" type="text" class="form-control formVal" id="Login" required>
                                    </div>
                                    <div class="mb-3">
                                      <label for="Password" class="form-label">Hasło</label>
                                      <input name="pass" type="password" class="form-control formVal" id="Password" required>
                                    </div>
                                    
                                    <div class="mb-3" id="error-window" style="display:none">
                                    <span class="text-danger">Nieprawidłowy login lub hasło!</span>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary" id="submitbtn">Zaloguj się</button>
                                  </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<script>
function myFunction()
{
    var elements = document.getElementsByClassName("formVal");
    var formData = new FormData(); 
    for(var i=0; i<elements.length; i++)
    {
        formData.append(elements[i].name, elements[i].value);
    }
    var xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange = function()
        {
            if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
            {
                if(xmlHttp.responseText == "1"){
                    console.log(xmlHttp.responseText);
                    window.location.replace("<?= base_url() ?>admin");
                }else{
                    document.getElementById("error-window").style.display = "";
                }
            }
        }
        xmlHttp.open("post", "<?= base_url() ?>login/verifyLogin"); 
        xmlHttp.send(formData); 
}
</script>