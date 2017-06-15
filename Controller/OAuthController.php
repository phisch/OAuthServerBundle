<?php

namespace Phisch\OAuthServerBundle\Controller;

use Phisch\OAuthServerBundle\Form\ScopeConfirmationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class OAuthController extends Controller
{
    public function tokenAction()
    {

    }

    /**
     * @Route("/authorize", name="_authorize")
     * @Method({"GET", "POST"})
     * @Template("@OAuthServer/OAuth/confirm_scopes.html.twig")
     */
    public function authorizeAction(Request $request)
    {
        $authorizationServer = $this->get('phisch.oauth_server_bundle.authorization_server');

        if ($errorResponse = $authorizationServer->validateAuthorization($request)) {
            return $errorResponse;
        }

        $form = $this->createForm(ScopeConfirmationType::class);

        if ($request->isMethod(Request::METHOD_POST)) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->get('submit')->isClicked()) {
                return $authorizationServer->handleAuthorization($request);
            }
            return $authorizationServer->cancelAuthorization($request);
        }

        $client = $this->get('phisch.oauth_server_bundle.repository.client_repository')
            ->getClient($request->get('client_id')); // TODO: put 'client_id' in oauth lib const

        $scopes = $this->get('phisch.oauth_server_bundle.repository.scope_repository')
            ->getScopesBySpaceSeparatedString($request->get('scope'));

        return [
            'user' => $this->getUser(),
            'client' => $client,
            'scopes' => $scopes,
            'scopeConfirmationForm' => $form->createView()
        ];
    }
}
