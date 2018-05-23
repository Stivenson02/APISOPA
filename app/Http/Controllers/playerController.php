<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Play;

class playerController extends Controller {

    public function create($name, $id) {

        $temOne = ["vaca", "perro", "gato", "raton", "oso", "hormiga", "tejon", "ardilla", "panda", "ballena"];
        $temTwo = ["java", "html", "objetos", "scrip", "linux", "mysql", "red", "ingenia", "htmlfive", "nulleable"];
        $temTree = ["casa", "cocina", "sala", "comedor", "garage", "control", "cobija", "hogar", "familia", "televisor"];
        $palabras = [];
        $juego = [];

        $tema = rand(1, 3);
        if ($tema == 1) {
            $palabras = $temOne;
        } elseif ($tema == 2) {
            $palabras = $temTwo;
        } elseif ($tema == 3) {
            $palabras = $temTree;
        }

        $dimension = $id * $id;

        for ($i = 1; $i <= $dimension; $i++) {
            $tablero[$i] = "-";
        }
        //Palabras
        $posision = rand(5, $id);
        $aumentodim = $id;
        $campmin = 1;
        $palabrainser = 0;
        if ($id >= 9 && $id <= 18) {

            for ($i = 0; $i < count($palabras); $i++) {

                // busca la linea vertical en donde sera incrustada la plabra
                while ($palabrainser == 0) {

                    if ($aumentodim == $dimension) {
                        $palabrainser = 1;
                    } else {
                        if ($posision <= $aumentodim) {

                            $espaciomax = $aumentodim - strlen($palabras[$i]); //15
                            //validar si la palabra encaja
                            if ($posision <= $espaciomax) {
                                //Validar si el tablero aun tiene espacio
                                for ($g = 0; $g < strlen($palabras[$i]); $g++) {

                                    $tablero[$posision] = $palabras[$i][$g];
                                    $solucion[$posision] = $posision;
                                    $posision = $posision + 1;
                                }
                                $palabraentablero[$i] = $palabras[$i];
                                $palabrainser = 1;
                            } else {
                                $posision = $posision + 1;
                            }
                        } else {
                            //salta a la siguiente linea vertical y declara el extreme menor y el mayor
                            $aumentodim = $id * $campmin;
                            $campmin = $campmin + 1;
                        }
                    }
                }
                $palabrainser = 0;
                $posision = $posision + rand(5, $id);
            }
            $pattern = "abcdefghijklmnopqrstuvwxyz";

            for ($i = 1; $i <= $dimension; $i++) {
                if ($tablero[$i] == "-") {
                    $key = $pattern{rand(0, 25)};
                    $juego[$i] = $key;
                }
            }

            $juegonuevo = new Play();
            $juegonuevo->tablero = implode($tablero);
            $juegonuevo->juego = implode($juego);
            $juegonuevo->solucion = implode($solucion);
            $juegonuevo->posiciones = implode(",", $palabraentablero);
            $juegonuevo->type = 1;
            $juegonuevo->estado = 1;
            $juegonuevo->dimension = $dimension;
            $juegonuevo->code = $id;
            $juegonuevo->name = $name;
            if ($juegonuevo->save()) {
                return [$juegonuevo->id, $dimension, $id, $tablero, $solucion, $palabraentablero];
            }
        }
    }

    public function almacenarSopa(Request $dates) {
        $play = Play::find($dates->id);
        $play->juego = implode($dates->sopa);
        $play->estado = 2;
        $play->save();
        return [
          "code" => $play->id,
          "message" => "Juego Guardado"
        ];
    }

    public function cargarJuego($id) {
        $juego = Play::find($id);
        $tablero = str_split($juego->tablero);
        $solucion = str_split($juego->solucion);
        $palabraentablero = explode(",", $juego->posiciones);
        return [$juego->id, $juego->dimension, $juego->code, $tablero, $solucion, $palabraentablero];
    }

}
