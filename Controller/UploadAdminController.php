<?php
/**
 * Declaration of UploadRoundController class.
 *
 * @category EotvosVerseny
 * @package Controller
 * @author Zsolt Parragi <zsolt.parragi@cancellar.hu>
 * @copyright 2011, Cancellar Informatikai Bt
 * @license http://www.opensource.org/licenses/BSD-2-Clause
 */

namespace Eotvos\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\DependencyInjection\ContainerAware;

use Symfony\Component\HttpFoundation\RedirectResponse;

use Eotvos\VersenyrBundle\Entity\Submission;
use Eotvos\VersenyrBundle\Entity\UploadRoundSecurityToken;

use Symfony\Component\HttpFoundation\Response;

use Eotvos\DemoBundle\Form\SimpleFileForm;
use Eotvos\DemoBundle\Form\UploadAdminForm;
use Eotvos\DemoBundle\Extension\ExtToMime;

/**
 * Controller for rounds requiring a single file upload.
 *
 * This class is used as a service, indetified by "eotvos.versenyr.round.upload"
 *
 * @todo describe the process
 * @todo move general route parts here
 *
 * @todo check round type at many places!
 *
 * @category EotvosVerseny
 * @package Controller
 * @license http://www.opensource.org/licenses/BSD-2-Clause
 * @author Zsolt Parragi <zsolt.parragi@cancellar.hu>
 * @since   2011-09-26
 * @version 2011-10-11
 */
class UploadAdminController extends ContainerAware
{
  /**
    * Renders a view.
    *
    * Copied from symfony's Controller class.
    *
    * @param string   $view The view name
    * @param array    $parameters An array of parameters to pass to the view
    * @param Response $response A response instance
    *
    * @return Response A Response instance
    *
    * @author Fabien Potencier <fabien@symfony.com>
    */
  protected function render($view, array $parameters = array(), Response $response = null)
  {
      return $this->container->get('templating')->renderResponse($view, $parameters, $response);
  }

  /**
   * configureAction
   * 
   * @param string $round 
   * 
   * @return void
   *
   * @Route("/configure/upload/{round}", name="round_upload_configure")
   * @Template()
   */
  public function configureAction($round)
  {
      $round = $this->container->get('doctrine')->getRepository('EotvosVersenyrBundle:Round')->findOneById($round);

      $config = json_decode($round->getConfig());


      $uaf = new UploadAdminForm();
      $form = $this->container->get('form.factory')->create($uaf, $uaf->fromInputFormat($config), array());

      $em = $this->container->get('doctrine')->getEntityManager();

      $request = $this->container->get('request');

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

                $config = $uaf->toInputFormat($form->getData());
                $round->setConfig(json_encode($config));

                $em->flush();

                return new RedirectResponse($this->container->get('router')->generate('admin_textpage_index'), 302);
        }

      return array(
          'form' => $form->createView(),
      );
  }

}
