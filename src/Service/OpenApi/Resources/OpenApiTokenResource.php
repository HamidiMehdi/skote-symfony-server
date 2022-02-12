<?php

namespace App\Service\OpenApi\Resources;

use ApiPlatform\Core\OpenApi\Model\Operation;
use ApiPlatform\Core\OpenApi\Model\PathItem;
use ApiPlatform\Core\OpenApi\Model\RequestBody;
use ApiPlatform\Core\OpenApi\OpenApi;

class OpenApiTokenResource implements OpenApiResourcesInterface
{
    /**
     * @return string
     */
    public function getSection(): string
    {
        return 'Token';
    }

    public function createPaths(OpenApi $openApi): OpenApi
    {
        $this->createSchemasForToken($openApi);
        $openApi = $this->createRefreshTokenPath($openApi);
        $openApi = $this->createLoginTokenPath($openApi);

        return $openApi;
    }

    /**
     * @param OpenApi $openApi
     * @return void
     */
    private function createSchemasForToken(OpenApi $openApi): void
    {
        $schemas = $openApi->getComponents()->getSchemas();
        $schemas['TokenRefresh'] = new \ArrayObject([
            'type' => 'object',
            'properties' => [
                'refresh_token' => [
                    'type' => 'string',
                    'example' => '54a9e1bf41863fdd8d6a1a8a46a29874763267f3d77bb55597b1c8143edb8fb8967ef06274c9c8bfa8b678fd77fdec9452d8588c4316e516697b86d3d268125c'
                ]
            ]
        ]);
        $schemas['Token'] = new \ArrayObject([
            'type' => 'object',
            'properties' => [
                'token' => [
                    'type' => 'string',
                    'example' => '54a9e1bf41863fdd8d6a1a8a46a29874763267f3d77bb55597b1c8143edb8fb8967ef06274c9c8bfa8b678fd77fdec9452d8588c4316e516697b86d3d268125c'
                ],
                'refresh_token' => [
                    'type' => 'string',
                    'example' => '54a9e1bf41863fdd8d6a1a8a46a29874763267f3d77bb55597b1c8143edb8fb8967ef06274c9c8bfa8b678fd77fdec9452d8588c4316e516697b86d3d268125c'
                ]
            ]
        ]);
        $schemas['Login'] = new \ArrayObject([
            'type' => 'object',
            'properties' => [
                'username' => [
                    'type' => 'string',
                    'example' => 'john@example.com'
                ],
                'password' => [
                    'type' => 'string',
                    'example' => 'john000'
                ]
            ]
        ]);
    }

    /**
     * @param OpenApi $openApi
     * @return OpenApi
     */
    private function createRefreshTokenPath(OpenApi $openApi): OpenApi
    {
        $pathItem = new PathItem(
            summary: 'Refresh Token',
            description: 'Refresh a JWT Token',
            post: new Operation(
                operationId: 'apiPostRefreshToken',
                tags: [$this->getSection()],
                responses: [
                    '200' => [
                        'description' => 'User Token',
                        'content' => [
                            'application/json' => [
                                'schema' => [
                                    '$ref' => '#/components/schemas/Token'
                                ]
                            ]
                        ]
                    ]
                ],
                summary: 'Refresh a JWT Token',
                description: 'Refresh a JWT Token',
                requestBody: new RequestBody(
                    'The refresh token resource',
                    new \ArrayObject([
                        'application/json' => [
                            'schema' => [
                                '$ref' => '#/components/schemas/TokenRefresh'
                            ]
                        ]
                    ]),
                    true
                )
            )
        );

        $openApi->getPaths()->addPath('/api/refresh/token', $pathItem);
        return $openApi;
    }

    /**
     * @param OpenApi $openApi
     * @return OpenApi
     */
    private function createLoginTokenPath(OpenApi $openApi): OpenApi
    {
        $pathItem = new PathItem(
            summary: 'User login',
            description: 'Login a user',
            post: new Operation(
                operationId: 'apiPostLogin',
                tags: [$this->getSection()],
                responses: [
                    '200' => [
                        'description' => 'User Token',
                        'content' => [
                            'application/json' => [
                                'schema' => [
                                    '$ref' => '#/components/schemas/Token'
                                ]
                            ]
                        ]
                    ]
                ],
                summary: 'Login a user',
                description: 'Login a user',
                requestBody: new RequestBody(
                    'The login resource',
                    new \ArrayObject([
                        'application/json' => [
                            'schema' => [
                                '$ref' => '#/components/schemas/Login'
                            ]
                        ]
                    ]),
                    true
                )
            )
        );

        $openApi->getPaths()->addPath('/api/login', $pathItem);
        return $openApi;
    }
}
