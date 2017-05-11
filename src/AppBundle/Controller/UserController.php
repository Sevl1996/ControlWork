<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;


class UserController extends Controller
{

    /**
     * @Route("/users", name="users")
     */
    public function indexAction()
    {
        $users=$this->getDoctrine()
            ->getRepository("AppBundle:User")
            ->findAll();
        return $this->render('AppBundle:User:index.html.twig',array(
            'users' => $users,
        ));

    }

    /**
     * @Route("/user/editUser/{id}")
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editUserAction(Request $request,$id)
    {
        $user=$this->getDoctrine()
            ->getRepository("AppBundle:User")->find($id);

        $form=$this->createFormBuilder($user)
            ->add('username', TextareaType::class,array("label"=> "Username",'label_attr'=>array(
                'class' => 'labelinput'
            ),'attr' => array(
                'class' =>"form-control"
            )))
            ->add('password', TextareaType::class,array("label"=> "Password",'label_attr'=>array(
                'class' => 'labelinput'
            ),'attr' => array(
                'class' =>"form-control",
                'type' => "password"
            )))
            ->add('email', TextareaType::class,array("label"=> "Email",'label_attr'=>array(
                'class' => 'labelinput'
            ),'attr' => array(
                'class' =>"form-control"
            )))
            ->add('submit', SubmitType::class,array('label'=> 'Submit',
                'attr' => array(
                    'class' => 'btn btn-success'
                )))
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $name=$form['username']->getData();
            $pass=$form['password']->getData();
            $email=$form['email']->getData();

            $em=$this->getDoctrine()->getManager();
            $user=$em->getRepository("AppBundle:User")->find($id);

            $user->setUsername($name);
            $user->setEmail($email);
            $user->setPassword($pass);

            $em->flush();

            return $this->redirectToRoute("users");
        }
        return $this->render('AppBundle:User:edit_user.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/user/addUser")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addUserAction(Request $request)
    {
        $user = new User;
        $form=$this->createFormBuilder($user)
            ->add('username', TextareaType::class,array("label"=> "Username",'label_attr'=>array(
                'class' => 'labelinput'
            ),'attr' => array(
                'class' =>"form-control"
            )))
            ->add('password', TextareaType::class,array("label"=> "Password",'label_attr'=>array(
                'class' => 'labelinput'
            ),'attr' => array(
                'class' =>"form-control",
                'type' => "password"
            )))
            ->add('email', TextareaType::class,array("label"=> "Email",'label_attr'=>array(
                'class' => 'labelinput'
            ),'attr' => array(
                'class' =>"form-control"
            )))
            ->add('submit', SubmitType::class,array('label'=> 'Submit',
                'attr' => array(
                    'class' => 'btn btn-success'
                )))
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $name=$form['username']->getData();
            $pass=$form['password']->getData();
            $email=$form['email']->getData();

            $user->setUsername($name);
            $user->setEmail($email);
            $user->setPassword($pass);

            $em=$this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();


            return $this->redirectToRoute("users");
        }
        return $this->render('AppBundle:User:add_user.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/user/deleteUser/{id}")
     */
    public function deleteUserAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->find($id);
        $em->remove($user);
        $em->flush();


        return $this->redirectToRoute("users");
    }

    /**
     * @Route("/user/infoUser/{id}")
     */
    public function infoUserAction($id)
    {
        $user=$this->getDoctrine()
            ->getRepository("AppBundle:User")->find($id);

        $form=$this->createFormBuilder($user)
            ->add('username', TextareaType::class,array("label"=> "Username",'label_attr'=>array(
                'class' => 'labelinput'
            ),'attr' => array(
                'class' =>"form-control"
            )))
            ->add('password', TextareaType::class,array("label"=> "Password",'label_attr'=>array(
                'class' => 'labelinput'
            ),'attr' => array(
                'class' =>"form-control",
                'type' => "password"
            )))
            ->add('email', TextareaType::class,array("label"=> "Email",'label_attr'=>array(
                'class' => 'labelinput'
            ),'attr' => array(
                'class' =>"form-control"
            )))
            ->getForm();
        return $this->render('AppBundle:User:info_user.html.twig', array(
            'form' => $form->createView()
        ));
    }

}
