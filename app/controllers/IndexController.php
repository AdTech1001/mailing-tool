<?php

namespace nltool\Controllers;

use Phalcon\Mvc\Controller;

/**
 * Class IndexController
 *
 * @package baywa-nltool\Controllers
 */
class IndexController extends Controller
{

    /**
     * @return \Phalcon\Http\ResponseInterface
     */
    public function indexAction()
    {
        $this->flashSession->error('Page not found: ' . $this->escaper->escapeHtml($this->router->getRewriteUri()));
        echo('<h1>Hello</h1>');
    }
}