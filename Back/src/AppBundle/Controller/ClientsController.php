<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Clients;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Client controller.
 *
 */
class ClientsController extends Controller
{
    /**
     * Lists all client entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $clients = $em->getRepository('AppBundle:Clients')->findAll();

        return $this->render('clients/index.html.twig', array(
            'clients' => $clients,
        ));
    }
    public function get_by_fosAction($username)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->findBy(array("username"=>$username));
        $client = $em->getRepository('AppBundle:Clients')->findBy(array("idfos"=>$user[0]->getId()));
        $serializer=new Serializer([new ObjectNormalizer()]);
        $client=$serializer->normalize($client);
        return new JsonResponse($client);
    }
    /**
     * Creates a new client entity.
     *
     */
    public function newAction(Request $request)
    {
        $client = new Clients();
        $form = $this->createForm('AppBundle\Form\ClientsType', $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $lastuser = $em->getRepository('AppBundle:FosUser')->findOneBy([], ['id' => 'desc']);
            $lastaccount = $em->getRepository('AppBundle:Accounts')->findOneBy([], ['id' => 'desc']);
            $client->setIdfos($lastuser);
            $lastaccount->setIdclient($client);
            $client->setIdAccount($lastaccount);
            $em->persist($client);
            $em->flush();

            return $this->redirectToRoute('clients_show', array('id' => $client->getId()));
        }

        return $this->render('clients/new.html.twig', array(
            'client' => $client,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a client entity.
     *
     */
    public function showAction(Clients $client)
    {
        $deleteForm = $this->createDeleteForm($client);

        return $this->render('clients/show.html.twig', array(
            'client' => $client,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing client entity.
     *
     */
    public function editAction(Request $request, Clients $client)
    {
        $deleteForm = $this->createDeleteForm($client);
        $editForm = $this->createForm('AppBundle\Form\ClientsType', $client);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('clients_edit', array('id' => $client->getId()));
        }

        return $this->render('clients/edit.html.twig', array(
            'client' => $client,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a client entity.
     *
     */
    public function deleteAction(Request $request, Clients $client)
    {
        $form = $this->createDeleteForm($client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($client);
            $em->flush();
        }

        return $this->redirectToRoute('clients_index');
    }

    /**
     * Creates a form to delete a client entity.
     *
     * @param Clients $client The client entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Clients $client)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('clients_delete', array('id' => $client->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
