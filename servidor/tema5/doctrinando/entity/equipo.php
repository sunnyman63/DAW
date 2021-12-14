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
    }

?>