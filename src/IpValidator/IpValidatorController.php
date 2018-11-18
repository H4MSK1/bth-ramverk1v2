<?php

namespace H4MSK1\IpValidator;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class IpValidatorController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function indexAction($result = null)
    {
        $page = $this->di->get('page');
        $page->add('anax/ipvalidator/index', compact('result'));

        return $page->render([
            'title' => 'IP Validator',
        ]);
    }

    public function indexActionPost()
    {
        $request = $this->di->get('request');
        $result = (new IpValidator($request->getPost('ip')))->validate();

        return $this->indexAction($result);
    }
}
