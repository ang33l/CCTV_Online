<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$camera_status = false;
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
                                <form method="post" action="<?=base_url()?>login/verifyLogin">
                                    <div class="mb-3">
                                      <label for="Login" class="form-label">Login</label>
                                      <input name="login" type="text" class="form-control" id="Login">
                                    </div>
                                    <div class="mb-3">
                                      <label for="Password" class="form-label">Hasło</label>
                                      <input name="pass" type="password" class="form-control" id="Password">
                                    </div>
                                    <?php if(isset($id)){

                                    ?>
                                    <div class="mb-3">
                                    <span class="text-danger">Nieprawidłowy login lub hasło!</span>
                                    </div>
                                    <?php } ?>
                                    <button type="submit" class="btn btn-primary" id="submitbtn">Zaloguj się</button>
                                  </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
