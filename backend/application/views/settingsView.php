<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#"></a>
        <a class="navbar-brand ml-2" href="#">CCTV Online</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 p-3">
                <h2>Zarządzaj dostępem do kamery</h2>
                <div class="form-group">
                    <p>Kamera</p>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="cam_status" id="cam_on" value="1">
                        <label class="form-check-label" for="cam_on">Włączona</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="cam_status" id="cam_off" value="0" checked>
                        <label class="form-check-label" for="cam_off">Wyłączona</label>
                      </div>
                </div>
                <div class="form-group mt-5">
                    <p>Godziny aktywnej pracy kamery</p>
                    <div class="form-group col-sm-4">
                        <div class='input-group date'>
                           <input type='time' class="form-control" />
                           <input type='time' class="form-control" />
                        </div>
                        <div class='input-group date' id='datetimepicker3'>
                            
                            <span class="input-group-addon">
                            <span class="glyphicon glyphicon-time"></span>
                            </span>
                         </div>
                     </div>
                </div>
                <button class="btn btn-primary mt-3">Zatwierdź zmiany</button>
            </div>
        </div>
    </div>