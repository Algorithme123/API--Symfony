<?php

namespace App\Controller;

use App\Entity\Personne;
use App\Repository\PersonneRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PersonneApiController extends AbstractController
{

 /** 
    *@Route("/personne/api/lire",name="liste_personne",methods={"GET"})


    */


    // public function index(PersonneRepository $personneRepository, NormalizerInterface $normalizerInterface)
    // {
    //     $personne=$personneRepository->findAll();
    //     // dd($personne);

    //     $personne=$normalizerInterface->normalize($personne,null,['groups'=>'lire:personne']);
    //    // dd($personne);
    //     $json=json_encode($personne);
    // //    dd($json);
        

    //    $response=new Response($json,200,[
    //        "Content-Type"=>"application/json"

    //    ]);
    //    return $response;
    // }

    // 11111111111111111111111111111111111111
    // deuxiemme methode
    // 1111111111111111111111111111111111111

    // public function index(PersonneRepository $personneRepository,SerializerInterface $serializer){
    //     $personne=$personneRepository->findAll();
    //     $json=$serializer->serialize($personne,'json',['groups'=>'lire:personne']);
    //     $response= new Response($json, 200, [
    //         "Content-Type" => 'application/json'
    //     ]);

    //     return $response;

    // }

    // 11111111111111111111111111111111111111
    // troisiemme  methode
    // 1111111111111111111111111111111111111
    public function index(PersonneRepository $personneRepository){
        $personne=$personneRepository->findAll();

        $response=$this->json($personne,200,[],['groups'=>'lire:personne']);
        return $response;
    }
    /** 
     *@Route("/personne/api/lire/{id}",name="la_personne",methods={"GET"})


     */
    public function personne_one($id,PersonneRepository $personneRepository)
    {
        $personne = $personneRepository->find($id);

        $response = $this->json($personne, 200, [], ['groups' => 'lire:personne']);
        return $response;
    }





    /** 
    *@Route("/personne/api/ajout",name="ajout_personne",methods={"POST"})


    */
    public function ajouter(Request $request ,SerializerInterface $serializer ,EntityManagerInterface $entityManager, ValidatorInterface $validator){

        
        
       $jsonRecu= json_decode($request->getContent(), true);

        // try {
        //     //code...
        $personne=$serializer->deserialize($jsonRecu, Personne::class, 'json');
            

        //     $errors=$validator->validate($personne);
        //     if( count($errors)>0){
        //         return $this->json($errors,400);
        //     }
        

        $entityManager->persist($personne);
        $entityManager->flush();

        //dd($personne);


        return $this->json($personne,201,[],['groups'=>'lire:personne']);
    }

    /** 
    *@Route("/personne/api/modifier/{id}",name="modifier_personne",methods={"PUT"})


    */
    public function modifier(int $id,PersonneRepository $personneRepository, Request $request ,SerializerInterface $serializer ,EntityManagerInterface $entityManager, ValidatorInterface $validator){


        $personne = $personneRepository->find($id);
       $jsonRecu= json_decode($request->getContent(), true);

        // try {
        //     //code...
        $serializer->deserialize($jsonRecu, Personne::class, 'json',[AbstractNormalizer::OBJECT_TO_POPULATE=>$personne]);

        // $personne
        //     ->setNom($p->getNom())
        //     ->setPrenom($p->getPrenom())
        //     ->setAge($p->getAge())
        //     ->setNationalite($p->getNationalite())
        //     ->setProfession($p->getProfession())
        //     ->setCompagnie($p->getCompagnie());



        //     $errors=$validator->validate($personne);
        //     if( count($errors)>0){
        //         return $this->json($errors,400);
        //     }

        $entityManager->persist($personne);
        $entityManager->flush();

        //dd($personne);


        return $this->json($personne,201,[],['groups'=>'lire:personne']);
    }

    //return  $this->json(["data" => ""], 200);
    // } catch (\Throwable $th) {
    //     //throw $th;
    //     return $this->json([
    //         'status'=>400,
    //         'message'=>$th->getMessage()

    //     ],400); 
    //}






    // public function modifierPersonne(Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager, PersonneRepository $personneRepository){


    //     // $personne=$personneRepository->


    // }


    /** 
      *@Route("/personne/api/delete/{id}",name="delete_personne",methods={"DELETE"})


     */
    public function delete_personne( int $id,PersonneRepository $personneRepository,EntityManagerInterface $entityManager)
    {
        $personne = $personneRepository->find($id);

        $entityManager->remove($personne);
        $entityManager->flush();

        return $this->json($personne,201,[]);

    }


    }


