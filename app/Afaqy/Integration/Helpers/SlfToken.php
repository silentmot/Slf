<?php

namespace Afaqy\Integration\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Afaqy\Integration\Facades\Tracer;
use Afaqy\Integration\Events\Fail\FailGetToken;
use Afaqy\Integration\Models\SlfToken as Token;
use Afaqy\Integration\Events\Success\SuccessfullyReceiveSlfToken;

class SlfToken
{
    /**
     * @var boolean
     */
    public $check_token_on_slf = false;

    /**
     * Get token from SLF system to use it on integration operation.
     *
     * @return string|null
     */
    public function token()
    {
        $token = Token::latest()->first();

        if ($this->isTokenExpire($token)) {
            $request = [
                'url'  => config('slf.url') . '/token',
                'type' => 'post',
                'body' => [
                    'client_id'     => config('slf.client_id'),
                    'client_secret' => config('slf.client_secret'),
                ],
            ];

            $token = $this->createNewToken($request);
        }

        return ($token) ? $token->access_token : $token;
    }

    /**
     * @param  \Afaqy\Integration\Models\SlfToken|null  $token
     * @return boolean
     */
    private function isTokenExpire($token)
    {
        if (is_null($token) || $token->expires_at < Carbon::now()->toDateString()) {
            return true;
        }

        if (!$this->check_token_on_slf) {
            $response = Http::acceptJson()
                ->timeout(300)
                ->withToken($token->access_token)
                ->get(config('slf.url') . '/token-test');

            if ($response->status() != 200) {
                return true;
            }

            $this->check_token_on_slf = true;
        }

        return false;
    }

    /**
     * @param  array $request
     * @return \Afaqy\Integration\Models\SlfToken|null
     */
    private function createNewToken($request)
    {
        $response = Http::acceptJson()->post($request['url'], $request['body']);

        if (!$response->successful()) {
            event(new FailGetToken('slf', $request, $response));

            Tracer::setErrors(['SLF client can\'t get access token from cloud SLF!']);

            return null;
        }

        event(new SuccessfullyReceiveSlfToken($request, $response));

        $data = $response->json()['data'];

        return Token::create([
            'expires_in'   => $data['expires_in'],
            'expires_at'   => Carbon::now()->addSeconds($data['expires_in'])->toDateString(),
            'token_type'   => $data['token_type'],
            'access_token' => $data['access_token'],
        ]);
    }

    /**
     * @return boolean
     */
    public function getCheckTokenStatus()
    {
        return $this->check_token_on_slf;
    }
}
