<?php

namespace BiegalskiLLC\NotificationTracker\Providers\Email\Mailgun\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class ValidateMailgunWebhookMiddleware
 */
class ValidateMailgunWebhookMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (!$request->isMethod('post')) {
            abort(Response::HTTP_FORBIDDEN, 'Only POST requests are allowed.');
        }

        if ($this->verify($request)) {
            return $next($request);
        }

        abort(Response::HTTP_FORBIDDEN);
    }

    /**
     * Build the signature from POST data
     *
     * @see https://documentation.mailgun.com/user_manual.html#securing-webhooks
     * @param  $request The request object
     * @return string
     */
    private function buildSignature($request): string
    {
        return hash_hmac(
            'sha256',
            vsprintf(
                '%s%s',
                [
                    $request->input('signature.timestamp'),
                    $request->input('signature.token')
                ]
            ),
            config('services.mailgun.webhook_signing_key')
        );
    }

    /**
     * @param $request
     * @return bool
     */
    private function verify($request): bool
    {
        // Check if the timestamp is fresh
        if (abs(time() - $request->input('signature.timestamp')) > 15) {
            return false;
        }

        return $this->buildSignature($request) === $request->input('signature.signature');
    }
}
