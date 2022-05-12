<?php

namespace App\Controller;

use App\Entity\Campo;
use App\Entity\Equipo;
use App\Entity\Partido;
use App\Entity\Reserva;
use App\Entity\Usuario;
use App\Form\ReservaType;
use App\Service\buscarPorRol;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/reservas")
 */
class ReservasController extends AbstractController
{
    /**
     * @Route("", name="app_reservas")
     */
    public function index(EntityManagerInterface $em, buscarPorRol $bpr, Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_CAPITAN');

        $user = $this->getUser();
        $paramErr = $this->container->get('session')->get('error');
        $err = "";
        if($paramErr != null) {
            $err = $paramErr;
        }
        
        try {

            $usuario = $em->getRepository(Usuario::class)->findOneBy(['email'=>$user->getUserIdentifier()]);
            $equipo = $usuario->getEquipo();
            $tipo = $equipo->getTipo();

            $campos = $em->getRepository(Campo::class)->findBy(['tipo'=>$tipo]);
            
            //$partidos = $em->createQuery("SELECT e FROM App\Entity\Partido e WHERE e.fechaHora LIKE '2022-05-07%'")->getResult();

        } catch(\Exception $e) {
            $err = "Error del servidor.";
        }

        return $this->render('reservas/reservarEntrenamiento.html.twig', [
            'controller_name' => 'ReservasController',
            'user' => $user,
            'error' => $err,
            'campos' => $campos,
        ]);
    }

    /**
     * @Route("/cancelar/{id}", name="app_cancelar_reserva")
     */
    public function cancelarReserva(EntityManagerInterface $em, $id) {
        $this->denyAccessUnlessGranted('ROLE_CAPITAN');
        $user = $this->getUser();
        try {
            $reserva = $em->getRepository(Reserva::class)->find($id);
            $profeEncargado = $reserva->getVigila();
            $profeEncargado->removeVigilancia($reserva);

            $em->remove($reserva);
            $em->flush();

        } catch(\Exception $e) {
            return $this->redirectToRoute('app_equipo');
        }
        return $this->redirectToRoute('app_equipo');
    }

    /**
     * @Route("/disponibilidad", name="app_comprobar_disponibilidad", methods={"GET"})
     */
    public function generarHoras(EntityManagerInterface $em, Request $request) {

        $campo = $request->query->get("campo");
        $fecha = $request->query->get("fecha");
        $hora = $request->query->get("hora");
        $fechaHora = new \DateTime($fecha." ".$hora);
        $fechaActual = new \DateTime("now");
        $diff = $fechaActual->diff($fechaHora);
        $respuesta = [];

        if($fechaActual > $fechaHora) {
            $respuesta = ['ok' => false];
        } else if(intval($fechaHora->format("d")) - intval($fechaActual->format("d")) == 1) {
            if($diff->y < 19 || ($diff->h == 19 && $diff->i <= 20)) {
                $respuesta = ['ok' => false];
            } 
        } 

        if($fechaHora->format("D") == "Sat" || $fechaHora->format("D") == "Sun") {
            $respuesta = ['ok' => "not_allowed"];
        } else {
            try {
                $user = $this->getUser();

                $usuario = $em->getRepository(Usuario::class)->findOneBy(['email'=>$user->getUserIdentifier()]);
                $equipo = $usuario->getEquipo();
                $reservasUser = $em->getRepository(Reserva::class)->findBy(['equipo'=>$equipo->getId()]);

                $contador = 0;

                foreach($reservasUser as $reservaUser) {
                    $fechaHoraReservaUser = $reservaUser->getFechaHora();
                    if($fechaHoraReservaUser->format("W") == $fechaHora->format("W")) {
                        $contador++;
                    }
                }

                if($contador >= 3) {
                    $respuesta = ['ok' => "dennied"];
                } else {
                    $reserva = $em->getRepository(Reserva::class)->findOneBy(['campo'=>$campo,'fechaHora'=>$fechaHora]);
        
                    if(empty($reserva)) {
                        $respuesta = ['ok' => true];
                    } else {
                        $respuesta = ['ok' => false];
                    }
                }
            } catch(\Exception $e) {
                $respuesta = ['ok' => "error"];
            }
        }
        return new Response(json_encode($respuesta));
    }

    /**
     * @Route("/reservar/{id}", name="app_hacer_reserva", methods={"POST"})
     */
    public function hacerReserva(EntityManagerInterface $em, Request $request, $id) {
        $this->denyAccessUnlessGranted('ROLE_CAPITAN');
        $reserva = new Reserva();
        $error = null;
        try {
            $campoId = $request->request->get("campo");
            $fechaDia = $request->request->get("fechaDia");
            $fechaMes = $request->request->get("fechaMes");
            $fechaAnyo = $request->request->get("fechaAnyo");
            $fecha = $fechaAnyo."-".$fechaMes."-".$fechaDia;
            $hora = $request->request->get("hora");
            $fechaHora = new \DateTime($fecha." ".$hora);

            $equipo = $em->getRepository(Equipo::class)->find($id);
            $campo = $em->getRepository(Campo::class)->find($campoId);

            $profes = [];
            $profs = $em->getRepository(Usuario::class)->findAll();
            
            foreach($profs as $prof) {
                $roles = $prof->getRoles();
                // array_push($profes,$roles[0]);
                if($roles[0] == "ROLE_ADMIN") {
                    array_push($profes,$prof);
                }
            }
            $random = random_int(0,count($profes)-1);

            $reserva->setCampo($campo);
            $reserva->setFechaHora($fechaHora);
            $reserva->setEquipo($equipo);
            $profes[$random]->addVigilancia($reserva);

            $em->persist($reserva);
            $em->persist($profes[$random]);

            $em->flush();

        } catch(\Exception $e) {
            $error = "Error del servidor";
            $this->container->get('session')->set('error', $error);
            return $this->redirectToRoute('app_reservas');
        }

        return $this->redirectToRoute('app_equipo');
    }

    /**
     * @Route("/traspasar", name="app_traspasar_reserva")
     */
    public function traspasarReserva(EntityManagerInterface $em, Request $request) {

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $user = $this->getUser();

        $idReserva = $request->query->get("idReserva");
        $idAdmin = $request->query->get("idAdmin");

        try {

            $adminTraspasa = $em->getRepository(Usuario::class)->findBy(['email'=>$user->getUserIdentifier()]);
            $adminRecibe = $em->getRepository(Usuario::class)->find($idAdmin);
            $reserva = $em->getRepository(Reserva::class)->find($idReserva);

            $adminTraspasa[0]->removeVigilancia($reserva);
            $adminRecibe->addVigilancia($reserva);

            $em->persist($adminTraspasa[0]);
            $em->persist($adminRecibe);
            $em->persist($reserva);

            $em->flush();

        } catch(\Exception $e) {
            return $this->redirectToRoute('app_gestionar_reservas');
            //return new Response('<p>'.$e.'</p>');
        }

        return $this->redirectToRoute('app_gestionar_reservas');
    }
}
