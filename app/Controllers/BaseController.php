<?php

declare(strict_types=1);

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Model;
use Psr\Log\LoggerInterface;

/**
 * Shared behaviour for every controller in the application.
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * Helpers loaded automatically for every controller.
     *
     * @var list<string>
     */
    protected $helpers = ['form_ui'];

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger): void
    {
        parent::initController($request, $response, $logger);
    }

    /**
     * Renders a page inside the admin layout.
     *
     * Layout data understood by the header and navigation views:
     *  - pageTitle    (string)            shown in the browser tab and page header
     *  - pageSubtitle (string, optional)  one-line description under the title
     *  - breadcrumbs  (array, optional)   label => url (null for the current page)
     *
     * @param array<string, mixed> $data
     */
    protected function render(string $view, array $data = []): string
    {
        return view('Admin_header', $data)
            . view('Admin_nav', $data)
            . view($view, $data)
            . view('Admin_footer', $data);
    }

    /**
     * Returns one record by id, or raises a 404 when it does not exist.
     */
    protected function findOrFail(Model $model, int $id): object
    {
        $record = $model->find($id);

        if ($record === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        return $record;
    }

    /**
     * Sends the user back to the form with their input and the validation errors.
     *
     * Call only after `validate()` has returned false.
     */
    protected function validationFailed(): RedirectResponse
    {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }
}
