<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'AppBundle\Doctrine\HashPasswordListener' shared autowired service.

include_once $this->targetDirs[3].'/src/AppBundle/Doctrine/HashPasswordListener.php';

return $this->services['AppBundle\Doctrine\HashPasswordListener'] = new \AppBundle\Doctrine\HashPasswordListener(${($_ = isset($this->services['security.password_encoder']) ? $this->services['security.password_encoder'] : $this->load('getSecurity_PasswordEncoderService.php')) && false ?: '_'});
