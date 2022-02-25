<?php

namespace App\Controller;

use App\Entity\Campo;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Usuario;
use App\Entity\Liga;
use App\Entity\Equipo;
use App\Entity\Partido;
use App\Form\RegistroType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Service\generadorPartidos;

class AdministracionController extends AbstractController
{
    /**
     * @Route("/administracion", name="app_administracion")
     */
    public function index(): Response{

        $user = $this->getUser();
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('admin/administracion.html.twig', [
            'user' => $user,
            'error' => ''
        ]);
    }

    /**
     * @Route("/administracion/nuevo/profesor", name="app_nuevo_profesor")
     */
    public function nuevoProfe(UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $em, Request $request): Response {


        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $user = $this->getUser();
        $usuario = new Usuario();
        $err = "";
        $form = $this->createForm(RegistroType::class,$usuario);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid()) {
            $pass1 = $form->get("password")->getData();
            $pass2 = $form->get("password2")->getData();
            if(strcmp($pass1,$pass2) == 0) {
                $a = ['ROLE_ADMIN'];
                $usuario->setRoles($a);
                $hashedPassword = $passwordHasher->hashPassword($usuario,$form->get("password")->getData());
                $usuario->setPassword($hashedPassword);
                try {
                    $em->persist($usuario);
                    $em->flush();
                } catch(\Exception $e) {
                    if(str_contains($e,"SQLSTATE[23000]")) {
                        $err = "Ya existe una cuenta con ese correo.";
                    } else {
                        $err = "Error del servidor.";
                    }
                    return $this->render('admin/nuevoProfesor.html.twig', [
                        'user' => $user,
                        'form' => $form->createView(),
                        'error' => $err,
                    ]);
                }
                return $this->redirectToRoute('app_login');
            } else {
                $err = "Las contraseñas no coinciden.";
                return $this->render('admin/nuevoProfesor.html.twig', [
                    'user' => $user,
                    'form' => $form->createView(),
                    'error' => $err,
                ]);
            }
            
        }

        return $this->render('admin/nuevoProfesor.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
            'error' => $err
        ]);
    }

    /**
     * @Route("/administracion/liga/solicitudes", name="app_gestionar_ligas")
     */
    public function gestionarSolicitudesLiga(EntityManagerInterface $em): Response {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $user = $this->getUser();
        $err = "";
        $ligas = array();
        try {
            $ligas = $em->getRepository(Liga::class)->findAll();
        } catch(\Exception $e) {
            $err = "Error del servidor.";
        }
        return $this->render('admin/administrarSolicitudesLigas.html.twig', [
            'user' => $user,
            'ligas' => $ligas,
            'error' => $err
        ]);
    }

    /**
     * @Route("/administracion/liga/solicitud/aceptar/{id}", name="app_aceptar_solicitud_ligas")
     */
    public function aceptarSolicitudLigas(EntityManagerInterface $em, $id): Response {

        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $error = "";
        try {
            $equipo = $em->getRepository(Equipo::class)->find($id);
            $liga = $equipo->getSolicitarParticipar();

            $liga->removeSolicitude($equipo);
            $liga->addEquipo($equipo);

            $em->persist($liga);
            $em->persist($equipo);
            $em->flush();
        } catch(\Exception $e) {
            $error = "Error del servidor";
        }
        
        return $this->redirectToRoute('app_gestionar_ligas');
    }

    /**
     * @Route("/administracion/liga/solicitud/denegar/{id}", name="app_denegar_solicitud_ligas")
     */
    public function denegarSolicitudLigas(EntityManagerInterface $em, $id): Response {

        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $error = "";
        try {
            $equipo = $em->getRepository(Equipo::class)->find($id);
            $liga = $equipo->getSolicitarParticipar();

            $liga->removeSolicitude($equipo);
            
            $em->persist($liga);
            $em->persist($equipo);
            $em->flush();
        } catch(\Exception $e) {
            $error = "Error del servidor";
        }
        
        return $this->redirectToRoute('app_gestionar_ligas');
    }

    /**
     * @Route("/administracion/ligas/completas", name="app_listado_ligas_completas")
     */
    public function listarLigasCompletas(EntityManagerInterface $em): Response {
        
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $ligas = [];
        $error = "";
        $hoy = new \Datetime();
        $fechaIniFinalizada = [];
        try {
            $ligas = $em->getRepository(Liga::class)->findAll();

            foreach($ligas as $liga) {
                $fecha = $liga->getFechaInicio();
                if(strtotime($fecha->format("Y-m-d")) <= strtotime($hoy->format("Y-m-d"))) {
                    array_push($fechaIniFinalizada,$liga->getId());  
                }
            }
            
        } catch(\Exception $e) {
            $error = "Error del servidor";
        }
        $user = $this->getUser();
        return $this->render('admin/listadoListasPorCerrar.html.twig', [
            'user' => $user,
            'ligas' => $ligas,
            'error' => $error,
            'fechaIniFinalizada' => $fechaIniFinalizada,
        ]);
    }

    /**
     * @Route("/administracion/partidos/resultados/agregar", name="app_gestionar_partidos")
     */
    public function gestionarPartidos(EntityManagerInterface $em): Response {

        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $error = "";
        $hoy = new \DateTime();
        $aux = [];

        try {
            $partidos = $em->getRepository(Partido::class)->findAll();
            foreach($partidos as $partido) {
                $fecha = $partido->getFechaHora();
                $fechaAux = $hoy->sub(new \DateInterval("P1D"));
                if(strtotime($fecha->format("Y-m-d")) <= strtotime($fechaAux->format("Y-m-d"))) {
                    array_push($aux,$partido);
                }
            }
            
        } catch(\Exception $e) {
            $error = "Error del servidor";
        }
        $user = $this->getUser();
        return $this->render('admin/ponerResultadoPartidos.html.twig', [
            'user' => $user,
            'error' => $error,
            'partidos' => $aux,
        ]);
    }

    /**
     * @Route("/administracion/generar/partidos/{id}", name="app_generar_partidos")
     */
    public function generarPartidos(EntityManagerInterface $em, generadorPartidos $gp, $id) {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $error = "";
        try {
            $liga = $em->getRepository(Liga::class)->find($id);
            $equipos = $liga->getEquipos();
            $fechaIni = $liga->getFechaInicio();

            $fechaPrimerPartido = new \Datetime($fechaIni->format("Y-m-d")." 15:00:00");
            $fechaPrimerPartido->add(new \DateInterval("P5D"));

            $idsEquipos = [];
            foreach($equipos as $equipo) {
                array_push($idsEquipos,$equipo->getId());
            }

            $partidosIda = $gp->generarPartidosIda($idsEquipos);
            $partidosVuelta = $gp->generarPartidosVuelta($partidosIda);

            $profes = $em->getRepository(Usuario::class)->findBy(array('roles'=>'["ROLE_ADMIN"]'));
            $random = random_int(0,count($profes)-1);

            $fechaAux = $fechaPrimerPartido;

            foreach($partidosIda as $semana) {
                
                foreach($semana as $partido) {
                    $local = $em->getRepository(Equipo::class)->find($partido['local']);
                    $visitante = $em->getRepository(Equipo::class)->find($partido['visitante']);
                    $campo = $em->getRepository(Campo::class)->find(1);

                    $partido = new Partido();

                    $local->addPartidosLocal($partido);
                    $visitante->addPartidosVisitante($partido);
                    $partido->setCampo($campo);
                    $profes[$random]->addArbitracione($partido);
                    $liga->addPartido($partido);
                    $partido->setFechaHora($fechaAux);

                    $em->persist($local);
                    $em->persist($visitante);
                    $em->persist($partido);
                    $em->persist($profes[$random]);
                    $em->persist($liga);

                    $fechaAux->modify('+90 minute');
                }
                $fechaAux->add(new \DateInterval("P7D"));
                $fechaAux->modify("-450 minute");
            }


            foreach($partidosVuelta as $semana) {
                
                foreach($semana as $partido) {
                    $local = $em->getRepository(Equipo::class)->find($partido['local']);
                    $visitante = $em->getRepository(Equipo::class)->find($partido['visitante']);
                    $campo = $em->getRepository(Campo::class)->find(1);

                    $partido = new Partido();

                    $local->addPartidosLocal($partido);
                    $visitante->addPartidosVisitante($partido);
                    $partido->setCampo($campo);
                    $profes[$random]->addArbitracione($partido);
                    $liga->addPartido($partido);
                    $partido->setFechaHora($fechaAux);

                    $em->persist($local);
                    $em->persist($visitante);
                    $em->persist($partido);
                    $em->persist($profes[$random]);
                    $em->persist($liga);

                    $fechaAux->modify('+90 minute');
                }
                $fechaAux->add(new \DateInterval("P7D"));
                $fechaAux->modify("-450 minute");
            }

            $fechaAux->sub(new \DateInterval("P7D"));
            $liga->setFechaFinal($fechaAux);
            $em->persist($liga);

            $em->flush();
            
        } catch(\Exception $e) {
            $error = "Error del servidor";
        }
        $user = $this->getUser();
        return $this->render('admin/listadoListasPorCerrar.html.twig', [
            'user' => $user,
            'error' => $error,
        ]);
    }
}
