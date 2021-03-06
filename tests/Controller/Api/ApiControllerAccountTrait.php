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

use phpOMS\Account\AccountStatus;
use phpOMS\Account\AccountType;
use phpOMS\Message\Http\HttpRequest;
use phpOMS\Message\Http\HttpResponse;
use phpOMS\Message\Http\RequestStatusCode;
use phpOMS\Uri\HttpUri;

trait ApiControllerAccountTrait
{
    /**
     * @testdox A user can be returned
     * @covers Modules\Admin\Controller\ApiController
     * @group module
     */
    public function testApiAccountGet() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->header->account = 1;
        $request->setData('id', '1');

        $this->module->apiAccountGet($request, $response);

        self::assertEquals('admin', $response->get('')['response']->login);
        self::assertGreaterThan(0, $response->get('')['response']->getId());
    }

    /**
     * @testdox A user can be updated
     * @covers Modules\Admin\Controller\ApiController
     * @group module
     */
    public function testApiAccountUpdate() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->header->account = 1;
        $request->setData('id', 1);
        $request->setData('email', 'oms@orange-management.de');
        $request->setData('password', 'orange');

        $this->module->apiAccountUpdate($request, $response);
        $this->module->apiAccountGet($request, $response);

        self::assertEquals('oms@orange-management.de', $response->get('')['response']->getEmail());
        self::assertGreaterThan(0, $response->get('')['response']->getId());
    }

    /**
     * @testdox A user can be found by name
     * @covers Modules\Admin\Controller\ApiController
     * @group module
     */
    public function testApiAccountFind() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->header->account = 1;
        $request->setData('search', 'admin');

        $this->module->apiAccountFind($request, $response);
        self::assertCount(1, $response->get(''));
        self::assertEquals('admin', $response->get('')[0]->name1);
    }

    /**
     * @testdox A user and profile for the user can be created
     * @covers Modules\Admin\Controller\ApiController
     * @group module
     */
    public function testApiAccountAndProfileCreate() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->header->account = 1;
        $request->setData('login', 'guest');
        $request->setData('password', 'guest');
        $request->setData('name1', 'Guest');
        $request->setData('email', 'test@email.com');
        $request->setData('type', AccountType::USER);
        $request->setData('status', AccountStatus::INACTIVE);

        $this->module->apiAccountCreate($request, $response);

        self::assertEquals('guest', $response->get('')['response']->login);
        self::assertGreaterThan(0, $response->get('')['response']->getId());
    }

    /**
     * @covers Modules\Admin\Controller\ApiController
     * @group module
     */
    public function testApiAccountCreateWithCustomLocale() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->header->account = 1;
        $request->setData('login', 'guest2');
        $request->setData('password', 'guest2');
        $request->setData('name1', 'Guest2');
        $request->setData('email', 'guest2@email.com');
        $request->setData('type', AccountType::USER);
        $request->setData('status', AccountStatus::INACTIVE);
        $request->setData('locale', 'de_DE');

        $this->module->apiAccountCreate($request, $response);

        self::assertEquals('guest2', $response->get('')['response']->login);
        self::assertGreaterThan(0, $response->get('')['response']->getId());
    }

    /**
     * @testdox A user can be deleted
     * @covers Modules\Admin\Controller\ApiController
     * @group module
     */
    public function testApiAccountDelete() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->header->account = 1;
        // mustn't create a profile otherwise it will not be possible to delete the account because of FK constraints
        $request->setData('name1', 'Guest');
        $request->setData('email', 'test@email.com');
        $request->setData('type', AccountType::USER);
        $request->setData('status', AccountStatus::INACTIVE);

        $this->module->apiAccountCreate($request, $response);
        $request->setData('id', $response->get('')['response']->getId());
        $this->module->apiAccountDelete($request, $response);

        self::assertGreaterThan(0, $response->get('')['response']->getId());
    }

    /**
     * @testdox A invalid user cannot be created
     * @covers Modules\Admin\Controller\ApiController
     * @group module
     */
    public function testApiAccountCreateInvalid() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->header->account = 1;
        $request->setData('status', 999);
        $request->setData('description', 'test description');

        $this->module->apiAccountCreate($request, $response);
        self::assertEquals(RequestStatusCode::R_400, $response->header->status);
    }

    /**
     * @testdox A user group can be added to a user
     * @covers Modules\Admin\Controller\ApiController
     * @group module
     */
    public function testApiAddGroupToAccount() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->header->account = 1;
        $request->setData('account', 1);
        $request->setData('igroup-idlist', '1');

        $this->module->apiAddGroupToAccount($request, $response);
        self::assertEquals('ok', $response->get('')['status']);
    }
}
