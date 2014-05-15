<?php
namespace Nmkd\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NmkdController extends Controller
{
    public function inputAction()
    {
        return $this->render(
            'NmkdMainBundle:Nmkd:input.html.twig'
        );
    }

    public function setThemesAction()
    {
        $questionStr = $_POST['questions'];
        $questionArr = explode('<br />', nl2br($questionStr));
        $questionArr = array_map('trim',$questionArr);
        $questionArr = array_values(array_filter($questionArr));
        $this->storage()->set('questions', $questionArr);

        return $this->render(
            'NmkdMainBundle:Nmkd:setThemes.html.twig', array(
                'questions' => $questionArr
            )
        );
    }

    protected function storage()
    {
        return Container::get('static_storage');
    }

}