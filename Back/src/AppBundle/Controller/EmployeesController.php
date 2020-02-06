<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Employees;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
/**
 * Employee controller.
 *
 */
class EmployeesController extends Controller
{
    /**
     * Lists all employee entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $employees = $em->getRepository('AppBundle:Employees')->findAll();

        return $this->render('employees/index.html.twig', array(
            'employees' => $employees,
        ));
    }

    /**
     * Creates a new employee entity.
     *
     */
    public function newAction(Request $request)
    {
        $employee = new Employees();
        $form = $this->createForm('AppBundle\Form\EmployeesType', $employee);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $services = $em->getRepository('AppBundle:Services')->findAll();
        if ($form->isSubmitted() && $form->isValid()) {
            $lastuser = $em->getRepository('AppBundle:FosUser')->findOneBy([], ['id' => 'desc']);
            $employee->setIdfos($lastuser);
            $service = $em->getRepository('AppBundle:Services')->findBy(array("id"=>$_POST['idservice']));
            $employee->setIdservice($service[0]);
            if(isset($_POST['giveaccess']))
                $employee->setGiveaccess(1);
            if(isset($_POST['payment']))
                $employee->setPayment(1);
            if(isset($_POST['transfert']))
                $employee->setTransfert(1);
            if(isset($_POST['verifyaccess']))
                $employee->setVerifyaccess(1);
            $em = $this->getDoctrine()->getManager();
            $em->persist($employee);
            $em->flush();

            return $this->redirectToRoute('employees_show', array('id' => $employee->getId()));
        }

        return $this->render('employees/new.html.twig', array(
            'employee' => $employee,
            'form' => $form->createView(),
            'services'=>$services,
        ));
    }

    /**
     * Finds and displays a employee entity.
     *
     */
    public function showAction(Employees $employee)
    {
        $em = $this->getDoctrine()->getManager();
        $deleteForm = $this->createDeleteForm($employee);
        $transactions = $em->getRepository('AppBundle:Transactions')->findBy(array(
            'idemployee' => $employee->getId()));
        return $this->render('employees/show.html.twig', array(
            'employee' => $employee,
            'transactions' => $transactions,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Finds and displays a employee entity by his fos id and return it in json.
     *
     */
    public function get_by_fosAction($username)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->findBy(array("username"=>$username));

        $employees = $em->getRepository('AppBundle:Employees')->findBy(array("idfos"=>$user[0]->getId()));
        

        $serializer=new Serializer([new ObjectNormalizer()]);
        $employees=$serializer->normalize($employees);
        return new JsonResponse($employees);
    }

    /**
     * Displays a form to edit an existing employee entity.
     *
     */
    public function editAction(Request $request, Employees $employee)
    {
        $deleteForm = $this->createDeleteForm($employee);
        $editForm = $this->createForm('AppBundle\Form\EmployeesType', $employee);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('employees_edit', array('id' => $employee->getId()));
        }

        return $this->render('employees/edit.html.twig', array(
            'employee' => $employee,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a employee entity.
     *
     */
    public function deleteAction(Request $request, Employees $employee)
    {
        $form = $this->createDeleteForm($employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($employee);
            $em->flush();
        }

        return $this->redirectToRoute('employees_index');
    }

    /**
     * Creates a form to delete a employee entity.
     *
     * @param Employees $employee The employee entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Employees $employee)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('employees_delete', array('id' => $employee->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
