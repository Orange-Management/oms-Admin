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

use phpOMS\Account\GroupStatus;
use phpOMS\Message\Http\HttpRequest;
use phpOMS\Message\Http\HttpResponse;
use phpOMS\Message\Http\RequestStatusCode;
use phpOMS\Uri\HttpUri;

trait ApiControllerGroupTrait
{
    /**
     * @testdox A user group can be returned
     * @covers Modules\Admin\Controller\ApiController
     * @group module
     */
    public function testApiGroupGet() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->header->account = 1;
        $request->setData('id', '3');

        $this->module->apiGroupGet($request, $response);

        self::assertEquals('admin', $response->get('')['response']->name);
        self::assertGreaterThan(0, $response->get('')['response']->getId());
    }

    /**
     * @testdox A user group can be updated
     * @covers Modules\Admin\Controller\ApiController
     * @group module
     */
    public function testApiGroupSet() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->header->account = 1;
        $request->setData('id', '3');
        $request->setData('name', 'root');

        $this->module->apiGroupUpdate($request, $response);
        $this->module->apiGroupGet($request, $response);

        self::assertEquals('root', $response->get('')['response']->name);

        $request->setData('name', 'admin', true);
        $this->module->apiGroupUpdate($request, $response);
    }

    /**
     * @testdox A user group can be found by name
     * @covers Modules\Admin\Controller\ApiController
     * @group module
     */
    public function testApiGroupFind() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->header->account = 1;
        $request->setData('search', 'admin');

        $this->module->apiGroupFind($request, $response);
        self::assertCount(1, $response->get(''));
        self::assertEquals('admin', $response->get('')[0]->name);
    }

    /**
     * @testdox A user group can be created and deleted
     * @covers Modules\Admin\Controller\ApiController
     * @group module
     */
    public function testApiGroupCreateDelete() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->header->account = 1;
        $request->setData('name', 'test');
        $request->setData('status', GroupStatus::INACTIVE);
        $request->setData('description', 'test description');

        $this->module->apiGroupCreate($request, $response);

        self::assertEquals('test', $response->get('')['response']->name);
        self::assertGreaterThan(0, $response->get('')['response']->getId());

        // test delete
        $request->setData('id', $response->get('')['response']->getId());
        $this->module->apiGroupDelete($request, $response);

        self::assertGreaterThan(0, $response->get('')['response']->getId());
    }

    /**
     * @testdox A invalid user group cannot be created
     * @covers Modules\Admin\Controller\ApiController
     * @group module
     */
    public function testApiGroupCreateInvalid() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->header->account = 1;
        $request->setData('status', 999);
        $request->setData('description', 'test description');

        $this->module->apiGroupCreate($request, $response);
        self::assertEquals(RequestStatusCode::R_400, $response->header->status);
    }

    /**
     * @testdox A user can be added to a user group
     * @covers Modules\Admin\Controller\ApiController
     * @group module
     */
    public function testApiAddAccountToGroup() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->header->account = 1;
        $request->setData('group', 1);
        $request->setData('iaccount-idlist', '1');

        $this->module->apiAddAccountToGroup($request, $response);
        self::assertEquals('ok', $response->get('')['status']);
    }

    /**
     * @testdox A user and user group can be found by name
     * @covers Modules\Admin\Controller\ApiController
     * @group module
     */
    public function testApiAccountGroupFind() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->header->account = 1;
        $request->setData('search', 'admin');

        $this->module->apiAccountGroupFind($request, $response);
        self::assertCount(2, $response->get(''));
        self::assertEquals('admin', $response->get('')[0]['name'][0] ?? '');
        self::assertEquals('admin', $response->get('')[1]['name'][0] ?? '');
    }
}
