<?php

namespace td1\controleur;
use Slim\Container;
use td1\modele\item;
use td1\modele\carte;
use td1\vue\VueParticipant;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Controleur
{
    private $c;
    private $htmlvars;

    public function __construct(Container $c) {
        $this->c = $c;
    }

    function controlQuestion_1(Request $rq, Response $rs, array $args ):Response{
        $liste = carte:: query()->select(["nom_proprietaire"], ["cumul"])->get();// all([""], ["mail_proprietaire"], ["cumul"]);
        if (!is_null($liste)){
            $vue = new VueParticipant([$liste], $this->c);
            $this->htmlvars['basepath'] = $rq->getUri()->getPath();
            $rs->getBody()->write($vue->question1());
        }
        return $rs;
    }
}