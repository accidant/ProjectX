<?php

namespace Core\EntranceBundle\Component\Request;
/**
 * Date: 03.08.12
 * Time: 13:32
 * @author Thomas Joußen
 * @email tjoussen@databay.de
 * @company www.databay.de
 */
abstract class AbstractHandler {

   public function handle(){

   }

	abstract protected function doRequirements();
}