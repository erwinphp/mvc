<?php
class ProductVO {
    private $cod_producto;
    private $nombre;
    private $descripcion;
    private $precio;
    private $status;

    public function setCod_Producto($cod_producto){

    }

    public function  setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }

    public function getDescripcion(){
        return $this->descripcion;
    }
    public function setPrecio($precio){
        $this->precio = $precio;
    }

    public function getPrecio(){
        return $this->precio;
    }

    public function setStatus($status){
        $this->status = $status;
    }

    public function getStatus(){
        return $this->status;
    }
}
?>