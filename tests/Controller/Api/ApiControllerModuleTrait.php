<?php
/**
 * Orange Management
 *
 * PHP Version 8.0
 *
 * @package   tests
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Admin\tests\Controller\Api;

use Modules\Admin\Models\ModuleStatusUpdateType;
use phpOMS\Message\Http\HttpRequest;
use phpOMS\Message\Http\HttpResponse;
use phpOMS\Message\Http\RequestStatusCode;
use phpOMS\Uri\HttpUri;

trait ApiControllerModuleTrait
{
    /**
     * @testdox The status of a module can be updated
     * @covers Modules\Admin\Controller\ApiController
     * @group module
     */
    public function testApiModuleStatusUpdate() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->header->account = 1;
        $request->setData('module', 'TestModule');

        $request->setData('status', ModuleStatusUpdateType::INSTALL);
        $this->module->apiModuleStatusUpdate($request, $response);
        self::assertEquals('ok', $response->get('')['status']);

        $request->setData('status', ModuleStatusUpdateType::ACTIVATE, true);
        $this->module->apiModuleStatusUpdate($request, $response);
        self::assertEquals('ok', $response->get('')['status']);

        $request->setData('status', ModuleStatusUpdateType::DEACTIVATE, true);
        $this->module->apiModuleStatusUpdate($request, $response);
        self::assertEquals('ok', $response->get('')['status']);

        $request->setData('status', ModuleStatusUpdateType::UNINSTALL, true);
        $this->module->apiModuleStatusUpdate($request, $response);
        self::assertEquals('ok', $response->get('')['status']);
    }

    /**
     * @testdox A missing module cannot be updated
     * @covers Modules\Admin\Controller\ApiController
     * @group module
     */
    public function testApiModuleStatusUpdateEmptyModule() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->header->account = 1;

        $request->setData('status', ModuleStatusUpdateType::INSTALL);
        $this->module->apiModuleStatusUpdate($request, $response);

        self::assertEquals(RequestStatusCode::R_403, $response->header->status);
        self::assertNull($response->get('module_stutus_update'));
    }

    /**
     * @testdox A invalid module status cannot update a module
     * @covers Modules\Admin\Controller\ApiController
     * @group module
     */
    public function testApiModuleStatusUpdateInvalidStatus() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->header->account = 1;
        $request->setData('module', 'TestModule');
        $request->setData('status', 99);

        $this->module->apiModuleStatusUpdate($request, $response);
        self::assertEquals(RequestStatusCode::R_400, $response->header->status);
    }

    /**
     * @testdox A invalid module cannot be updated
     * @covers Modules\Admin\Controller\ApiController
     * @group module
     */
    public function testApiModuleStatusUpdateInvalidModule() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->header->account = 1;
        $request->setData('module', 'invalid');
        $request->setData('status', ModuleStatusUpdateType::INSTALL);

        $this->module->apiModuleStatusUpdate($request, $response);
        self::assertEquals(RequestStatusCode::R_400, $response->header->status);
    }

    /**
     * @testdox A module can be re-initialized
     * @covers Modules\Admin\Controller\ApiController
     * @group module
     */
    public function testApiReInit() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->header->account = 1;

        $routes = include __DIR__ . '/../../../../../Web/Api/Routes.php';
        $hooks  = include __DIR__ . '/../../../../../Web/Api/Hooks.php';

        $this->module->apiReInit($request, $response);

        $routes2 = include __DIR__ . '/../../../../../Web/Api/Routes.php';
        $hooks2  = include __DIR__ . '/../../../../../Web/Api/Hooks.php';

        self::assertEquals($routes, $routes2);
        self::assertEquals($hooks, $hooks2);
    }
}
