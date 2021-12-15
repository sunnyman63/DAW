<?php

    use Doctrine\ORM\EntityRepository; 
    use Doctrine\ORM\Mapping as ORM;
    /**
     * @ORM\Entity
     * @ORM\Table(name="equipo")
     * 
     */
    

    class equipo {
        /** @ORM\Id @ORM\Column(type="integer") @ORM\GeneratedValue **/
        private $id;
        /** @ORM\Column(type="string") **/
        private $nombre;
        /** @ORM\Column(type="integer") **/ 
        private $fundacion;
        /** @ORM\Column(type="integer") **/ 
        private $socios;
        /** @ORM\Column(type="string") **/ 
        private $ciudad;

        public function __construct($id="",$nombre="",$fundacion="",$socios="",$ciudad=""){
            $this->id = $id;
            $this->nombre = $nombre;
            $this->fundacion = $fundacion;
            $this->socios = $socios;
            $this->ciudad = $ciudad;
        }

        public function getId() { return $this->id; } 
        public function getNombre() { return $this->nombre; } 
        public function setNombre($nombre) { $this->nombre = $nombre; } 
        public function getFundacion() { return $this->fundacion; } 
        public function setFundacion($fundacion) { $this->fundacion = $fundacion; } 
        public function getSocios() { return $this->socios; } 
        public function setSocios($socios) { $this->socios = $socios; } 
        public function getCiudad() { return $this->ciudad; } 
        public function setCiudad($ciudad) { $this->ciudad = $ciudad; }
    }

?>