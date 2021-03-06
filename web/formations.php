<?php

require('config/connect.php');
$sql = $db->query("SELECT * FROM formations");

while($row = $sql->fetch_assoc()) {
        printf('
        <div class="formations col-12 col-md-6 col-lg-4 text-left">
        <div class="card">
        <h4 class="card-header bg-dark text-white"><img src="admin/www/images/%s" class="img-thumbnail" alt="logo %s"/>
        <div class="float-right small">
        <a class="btn btn-raised btn-primary" href="mailto:%s" title="Envoyer un mail" data-placement="top" title="Tooltip on top"><i class="fa fa-envelope" aria-hidden="true"></i></a>
        <a class="btn btn-raised btn-warning" href="http://%s" target="_blank" title="%s"><i class="fa fa-internet-explorer" aria-hidden="true"></i></a>
        <a class="btn btn-raised btn-primary" href="https://www.google.fr/maps/place/%s %s %s %s" title="map" target="_blank"><i class="fa fa-map-marker" aria-hidden="true"></i></a>
        </div>
        </h4>
        <div class="card-body">
        <div class="row justify-content-center">
        <div class="alert alert-primary row">
        <div class="col-4 society">Organisme :</div>
        <div class="col-8 society">%s</div>
        </div>
        <div class="alert alert-warning row">
        <div class="col-4 society">Adresse :</div>
        <div class="col-8 society">%s %s</div>
        </div>
        <div class="alert alert-primary row">
        <div class="col-4 society">Ville :</div>
        <div class="col-8 society">%s %s</div>
        </div>
        <div class="alert alert-warning row">
        <div class="col-4 society">Contact :</div>
        <div class="col-8 society">%s</div>
        </div>
        <div class="alert alert-primary row">
        <div class="col-4 society">Téléphone :</div>
        <div class="col-8 society"><a href="tel:%s">%s</a></div>
        </div>
        </div>
        </div>
        </div>
        </div>'
        , $row["image"]
        , $row["image"]
        , $row["mail"]
        , $row["web"]
        , $row["web"]
        , $row["number_street"]
        , $row["street"]
        , $row["postal_code"]
        , $row["city"]
        , $row["title"]
        , $row["number_street"]
        , $row["street"]
        , $row["postal_code"]
        , $row["city"]
        , $row["contact"]
        , $row["phone"]
        , $row["phone"]
      );
    } // fin de 'formation'

 ?>
