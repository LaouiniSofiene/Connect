<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Accounts;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


/**
 * Account controller.
 *
 */
class AccountsController extends Controller
{
    /**
     * Lists all account entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $accounts = $em->getRepository('AppBundle:Accounts')->findAll();
        return $this->render('accounts/index.html.twig', array(
            'accounts' => $accounts,
        ));
    }


    public function inAction($qrcode,$amount)
    {
        $em = $this->getDoctrine()->getManager();
        $accounts = $em->getRepository('AppBundle:Accounts')->findBy(array("qrstring"=>$qrcode));
        $account=$accounts[0];
        $account->setAmount($account->getAmount()+$amount);
        $this->getDoctrine()->getManager()->flush();
        $csrfToken='added';
        $csrfToken=array($csrfToken);
        $serializer=new Serializer([new ObjectNormalizer()]);
        $csrfToken=$serializer->normalize($csrfToken);
        return new JsonResponse($csrfToken);

    }
    public function goinAction($qrcode)
    {
        $em = $this->getDoctrine()->getManager();
        $accounts = $em->getRepository('AppBundle:Accounts')->findBy(array("qrstring"=>$qrcode));
        $account=$accounts[0];
        if($account->getNumberin()<$account->getNumberaccess())
        {
          $csrfToken='accepte';
          $account->setNumberin($account->getNumberin()+1);
        }
        else {
          $csrfToken='no';
        }
        $this->getDoctrine()->getManager()->flush();

        $csrfToken=array($csrfToken);
        $serializer=new Serializer([new ObjectNormalizer()]);
        $csrfToken=$serializer->normalize($csrfToken);
        return new JsonResponse($csrfToken);

    }
    public function gooutAction($qrcode)
    {
        $em = $this->getDoctrine()->getManager();
        $accounts = $em->getRepository('AppBundle:Accounts')->findBy(array("qrstring"=>$qrcode));
        $account=$accounts[0];
        $account->setNumberin($account->getNumberin()-1);
        $this->getDoctrine()->getManager()->flush();
        $csrfToken='Retreved';
        $csrfToken=array($csrfToken);
        $serializer=new Serializer([new ObjectNormalizer()]);
        $csrfToken=$serializer->normalize($csrfToken);
        return new JsonResponse($csrfToken);

    }
    public function existAction($qrcode)
    {
        $em = $this->getDoctrine()->getManager();

        $accounts = $em->getRepository('AppBundle:Accounts')->findBy(array("qrstring"=>$qrcode));
        if(empty($accounts))
        {
            $csrfToken='no';
        }
        else
        {
            $csrfToken='yes';
        }
        $csrfToken=array($csrfToken);
        $serializer=new Serializer([new ObjectNormalizer()]);
        $csrfToken=$serializer->normalize($csrfToken);
        return new JsonResponse($csrfToken);

    }
    public function soldAction($qrcode)
    {
        $em = $this->getDoctrine()->getManager();

        $accounts = $em->getRepository('AppBundle:Accounts')->findBy(array("qrstring"=>$qrcode));
        if(empty($accounts))
        {
            $csrfToken='no';
        }
        else
        {
            $csrfToken=$accounts[0]->getAmount();
        }
        $csrfToken=array($csrfToken);
        $serializer=new Serializer([new ObjectNormalizer()]);
        $csrfToken=$serializer->normalize($csrfToken);
        return new JsonResponse($csrfToken);

    }
    public function outAction($qrcode,$amount)
    {
        $em = $this->getDoctrine()->getManager();
        $accounts = $em->getRepository('AppBundle:Accounts')->findBy(array("qrstring"=>$qrcode));
        $account=$accounts[0];
        $account->setAmount($account->getAmount()-$amount);
        $this->getDoctrine()->getManager()->flush();
        $csrfToken='Retreved';
        $csrfToken=array($csrfToken);
        $serializer=new Serializer([new ObjectNormalizer()]);
        $csrfToken=$serializer->normalize($csrfToken);
        return new JsonResponse($csrfToken);

    }

    /**
     * Creates a new account entity.
     *
     */
    public function newAction(Request $request)
    {
        if ($request->getContentType() == 'json' && $request->getContent()) {
            $data=json_decode($request->getContent(), true);
            var_dump($data);
            $account = new Accounts();
            $account->setAmount($data['Amount']);
            $account->setNumberaccess($data['Numberaccess']);
            $account->setQrstring($data['Qrstring']);
            $em = $this->getDoctrine()->getManager();
            $em->persist($account);
            $em->flush();
            $csrfToken='accountAdded';
            $csrfToken=array($csrfToken);
            $serializer=new Serializer([new ObjectNormalizer()]);
            $csrfToken=$serializer->normalize($csrfToken);
            return new JsonResponse($csrfToken);
        }
        $account = new Accounts();
        $form = $this->createForm('AppBundle\Form\AccountsType', $account);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $account->setQrstring($_POST['qrstring']);
            $em->persist($account);
            $em->flush();

            return $this->redirectToRoute('clients_new', array('id' => $account->getId()));
        }
        $length = 20;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $this->render('accounts/new.html.twig', array(
            'account' => $account,
            'form' => $form->createView(),
            'randomCode' => $randomString ,
        ));
    }
    /**
     * Finds and displays a account entity.
     *
     */
    public function showAction(Accounts $account)
    {
        $em = $this->getDoctrine()->getManager();
        $deleteForm = $this->createDeleteForm($account);

        $transactions = $em->getRepository('AppBundle:Transactions')->findBy(array(
            'qrString' => $account->getQrstring()));
        return $this->render('accounts/show.html.twig', array(
            'account' => $account,
            'transactions' => $transactions,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing account entity.
     *
     */
    public function editAction(Request $request, Accounts $account)
    {
        $deleteForm = $this->createDeleteForm($account);
        $editForm = $this->createForm('AppBundle\Form\AccountsType', $account);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('accounts_edit', array('id' => $account->getId()));
        }

        return $this->render('accounts/edit.html.twig', array(
            'account' => $account,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a account entity.
     *
     */
    public function deleteAction(Request $request, Accounts $account)
    {
        $form = $this->createDeleteForm($account);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($account);
            $em->flush();
        }

        return $this->redirectToRoute('accounts_index');
    }

    /**
     * Creates a form to delete a account entity.
     *
     * @param Accounts $account The account entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Accounts $account)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('accounts_delete', array('id' => $account->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
