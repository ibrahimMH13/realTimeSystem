<?php

namespace Zmq\Auth;

use Thruway\Authentication\AbstractAuthProviderClient;

class AuthToken extends AbstractAuthProviderClient
{
    //doc to use jwt with auth also
    //https://voryx.net/using-json-web-token-jwt-for-thruway-authentication/
    public function getMethodName()
    {
        return 'token';
    }

    public function processAuthenticate($signature, $extra = null)
    {
        if (isset($signature)) {
            return ["SUCCESS", ["msg" => "its work now"]];
        } else {
            return ["FAILURE"];
        }

    }
}
