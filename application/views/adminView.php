<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#"></a>
        <a class="navbar-brand" href="#">CCTV Online</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-item nav-link active" href="admin">Podgląd kamery</a>
            <a class="nav-item nav-link" href="admin/settings">Ustawienia</a>
            <a class="nav-item nav-link" href="login/logout">Wyloguj</a>
          </div>
        </div>
    </nav>
<div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="m-3">
                  <?php 
                  if(!$camera_status) 
                    echo '<h5>Nie można wyświetlić kamery, ponieważ jest wyłączona!</h5>'; 
                  else 
                    echo ' <img src="http://192.168.1.38:8000/stream.mjpg" width="640" height="480">'; ?>
                </div>
            </div>
            <div class="col-md-6 p-3">
                <h2>Status kamery</h2>
                <p><?php if(!$camera_status) echo '<span class="text-danger">wyłączona</span>'; else echo '<span class="text-success">włączona</span>'; ?></p>
            </div>
        </div>
    </div>