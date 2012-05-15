<?php

namespace Eotvos\DemoBundle\RoundType;

/**
 * Basic type for offline finals
 * 
 * @author    Zsolt Parragi <zsolt.parragi@cancellar.hu> 
 * @copyright 2012 Cancellar
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @version   Release: v0.1
 */
class UploadType
{
    /**
     * Returns the list of the links displayed on the right.
     *
     * @return array of links (url => display name)
     */
    public function getRoundLinks($round)
    {
    $methods = array();

    $section = $round->getSection();
    $t = $section->getPage()->getRootNode()->getTerm();
    $term = $t->getName();

    $user = $this->container->get('security.context')->getToken()->getUser();

    if(!$user || !is_object($user)){
      return array();
    }

    $found = false;
    if ($user->GetRegistrationForTerm($t)) {
        foreach($user->getRegistrationForTerm($t)->getSections() as $userSec){
            if($userSec->getId() == $section->getId()){
                $found = true;
            }
        }
    } else {
        $found = true;
    }

    if(!$found) return array();

    $sr = $this->container->get('doctrine')->getRepository('\EotvosVersenyrBundle:Submission');

    $now = new \DateTime();
    $ended = $round->getStop() < $now;
    $started = $round->getStart() > $now;

    $config = json_decode($round->getConfig());

    if($started) return array();

    $submissions = $sr->getByUserAndRound($user, $round);
    $notFinalized = true;
    $submitted =false;
    foreach($submissions as $submission){
      $submitted = true;
      if($submission->getFinalized()){
        $notFinalized = false;
      }
    }

    if(!$ended && $notFinalized){
      $methods[$config->name.' feltöltése'] = $this->container->get('router')->generate('competition_round_upd_upload', array( 'term' => $term, 'sectionSlug' => $section->getPage()->getSlug(), 'roundSlug' => $round->getPage()->getSlug() ));
    }

    if(!$ended && $notFinalized && $submitted){
      $methods['Véglegesítés'] = $this->container->get('router')->generate('competition_round_upd_finalize', array( 'term' => $term, 'sectionSlug' => $section->getPage()->getSlug(), 'roundSlug' => $round->getPage()->getSlug() ));
    }

    if($submitted){
      $methods['Feltöltések megtekintése'] = $this->container->get('router')->generate('competition_round_upd_list', array( 'term' => $term, 'sectionSlug' => $section->getPage()->getSlug(), 'roundSlug' => $round->getPage()->getSlug() ));
    }

    return $methods;
  }

    public function setContainer($container)
    {
        $this->container = $container;
    }

    /**
     * Returns the name of the action added to section boxes.
     * 
     * @return string action name
     */
    public function getDescriptionAction()
    {
        return 'eotvos.versenyr.round.upload:activeDescriptionAction';
    }

    /**
     * Returns an URL for viewing a specific submission
     *
     * @param Submission $submission object
     * 
     * @return string URL
     */
    public function getAdminUrlForSubmission($submission)
    {
        return null;
    }

    /**
     * Returns an URL for configuring a given round
     *
     * @param Round $round object
     * 
     * @return string URL
     */
    public function getConfigurationUrl($round)
    {
        return 'round_upload_configure';
    }

    /**
     * Reorders the given array of [ user, [ submissions ], nullpoints ] into a descending list.
     * 
     * @param mixed $standing unordered user list
     * 
     * @return array ordered standing
     */
    public function orderStanding($standing)
    {
        foreach ($standing as $k => $v) {
            $sum = 0;
            foreach ($v[1] as $subm) {
                $sum += $subm->getPoints();
            }

            $standing[$k][2] = $sum;
        }
        $rs = $standing;

        uasort($rs, function($a,$b) {
            return (($a[2]==$b[2]) ? 0 : ($a[2] < $b[2] ? -1 : 1));
        });

        return $rs;
    }

    /**
     * Returns a user friendly name of the type
     * 
     * @return string
     */
    public function getDisplayName()
    {
        return 'UploadType';
    }

}

