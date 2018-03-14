<?php
/**
 * PreregistrationController
 */

namespace App\Controllers;

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;
use App\Exceptions\ValidationException;
use App\Factory\PdoFactory;
use App\Lib\MailSender;
use App\Models\Domain\Preregistration\PreregistrationMailValue;
use App\Services\PreregistrationScenario;

/**
 * Class PreregistrationController
 *
 * @package App\Controllers
 */
class PreregistrationController extends Controller
{

    /**
     * 仮ユーザー登録のフォームを表示させる
     *
     * @param Request $request
     * @param Response $response
     * @param array $pathParams
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function showForm(
        Request $request,
        Response $response,
        array $pathParams = []
    ): Response {
        $renderParams = [
            'title' => 'PHP OJT 仮ユーザー登録',
        ];

        $response->getBody()->write($this->getTemplate()->render('preregistration/form.html', $renderParams));

        return $response;
    }

    /**
     * 仮ユーザー登録フォームにPOSTリクエストが送信されてきた時
     * 状況に応じて仮ユーザー登録の完了メッセージ、またはエラーメッセージを表示させる
     *
     * @param Request $request
     * @param Response $response
     * @param array $pathParams
     * @return Response
     * @throws \Exception
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function postToForm(
        Request $request,
        Response $response,
        array $pathParams = []
    ): Response {
        try {
            $request->getParsedBody();

            $preregistrationScenario = new PreregistrationScenario(
                PdoFactory::create()
            );

            $preregistrationEntity = $preregistrationScenario->preregistration($request->getParsedBody());

            $preregistrationMailValue = new PreregistrationMailValue($preregistrationEntity);

            $mailSender = new MailSender();
            $mailSender->send($preregistrationMailValue);

            return $response->withRedirect('http://192.168.33.10:8080/preregistration/complete');
        } catch (ValidationException $e) {
            $renderParams = [
                'title'        => 'PHP OJT 仮ユーザー登録完了',
                'email'        => $request->getParsedBody()['email'],
                'isError'      => true,
                'errorMessage' => $e->getErrors()['email'],
            ];

            $response
                ->getBody()
                ->write(
                    $this->getTemplate()->render('preregistration/form.html', $renderParams)
                );

            return $response;
        }
    }

    /**
     * 仮ユーザー登録の完了メッセージを表示させる
     *
     * @param Request $request
     * @param Response $response
     * @param array $pathParams
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function showCompleteMessage(
        Request $request,
        Response $response,
        array $pathParams = []
    ): Response {
        $renderParams = [
            'title' => 'PHP OJT 仮ユーザー登録完了',
        ];

        $response->getBody()->write($this->getTemplate()->render('preregistration/complete.html', $renderParams));

        return $response;
    }
}
