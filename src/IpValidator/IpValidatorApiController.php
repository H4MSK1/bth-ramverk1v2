<?php

namespace H4MSK1\IpValidator;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class IpValidatorApiController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function indexAction()
    {
        $page = $this->di->get('page');
        $page->add('anax/ipvalidator/api');

        return $page->render([
            'title' => 'IP Validator',
        ]);
    }

    public function validateAction()
    {
        $request = $this->di->get('request');
        $result = (new IpValidator($request->getGet('ip')))->validate();

        return [$result];
    }
}
