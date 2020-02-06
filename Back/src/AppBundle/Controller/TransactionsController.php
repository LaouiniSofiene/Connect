<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Transactions;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
/**
 * Transaction controller.
 *
 */
class TransactionsController extends Controller
{
    /**
     * Lists all transaction entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $transactions = $em->getRepository('AppBundle:Transactions')->findAll();
        // $serializer=new Serializer([new ObjectNormalizer()]);
        // $transactions=$serializer->normalize($transactions);
        // return new JsonResponse($transactions);
        return $this->render('transactions/index.html.twig', array(
            'transactions' => $transactions,
        ));
    }
    /**
     * Lists all transaction of a given employee entities.
     *
     */
    public function getbypersonnelAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $transactions = $em->getRepository('AppBundle:Transactions')->findBy(array("idemployee"=>$id));
        $serializer=new Serializer([new ObjectNormalizer()]);
        $transactions=$serializer->normalize($transactions);
        return new JsonResponse($transactions);
        // return $this->render('transactions/index.html.twig', array(
        //     'transactions' => $transactions,
        // ));
    }

    /**
     * Creates a new transaction entity.
     *
     */
    public function newAction(Request $request)
    {
        $transaction = new Transactions();
        $form = $this->createForm('AppBundle\Form\TransactionsType', $transaction);
        $form->handleRequest($request);
        if ($request->getContentType() == 'json' && $request->getContent()) {
            $data=json_decode($request->getContent(), true);
            $transaction = new transactions();
            $transaction->setAmount($data['amount']);
            $em = $this->getDoctrine()->getManager();
            $employee = $em->getRepository('AppBundle:Employees')->findBy(array("id"=>$data['idemployee']));
            $transaction->setIdemployee($employee[0]);
            $transaction->setQrstring($data['qrstring']);
            $em->persist($transaction);
            $em->flush();
            $csrfToken='TransactionAdded';
            $csrfToken=array($csrfToken);
            $serializer=new Serializer([new ObjectNormalizer()]);
            $csrfToken=$serializer->normalize($csrfToken);
            return new JsonResponse($csrfToken);
        }
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($transaction);
            $em->flush();
            var_dump($_POST);
            die;
            return $this->redirectToRoute('transactions_show', array('id' => $transaction->getId()));
        }

        return $this->render('transactions/new.html.twig', array(
            'transaction' => $transaction,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a transaction entity.
     *
     */
    public function showAction(Transactions $transaction)
    {
        $deleteForm = $this->createDeleteForm($transaction);

        return $this->render('transactions/show.html.twig', array(
            'transaction' => $transaction,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing transaction entity.
     *
     */
    public function editAction(Request $request, Transactions $transaction)
    {
        $deleteForm = $this->createDeleteForm($transaction);
        $editForm = $this->createForm('AppBundle\Form\TransactionsType', $transaction);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('transactions_edit', array('id' => $transaction->getId()));
        }

        return $this->render('transactions/edit.html.twig', array(
            'transaction' => $transaction,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a transaction entity.
     *
     */
    public function deleteAction(Request $request, Transactions $transaction)
    {
        $form = $this->createDeleteForm($transaction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($transaction);
            $em->flush();
        }

        return $this->redirectToRoute('transactions_index');
    }

    /**
     * Creates a form to delete a transaction entity.
     *
     * @param Transactions $transaction The transaction entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Transactions $transaction)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('transactions_delete', array('id' => $transaction->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
