<?php

namespace Confluence\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Confluence\Content;

class ContentTest extends TestCase
{
    private int $id;

    protected function setUp(): void
    {
        parent::setUp();
        $this->api = new Content($this->conf);
        $this->id = $this->faker->randomNumber();
    }

    public function testDestroy()
    {
        $params = ['status' => $this->faker->word];
        $clientMock = $this->getMockBuilder(Client::class)->getMock();
        $clientMock->expects($this->once())
            ->method('request')
            ->with(
                'DELETE',
                "content/{$this->id}",
                ['query' => $params]
            )
            ->willReturn(new Response(200, []));
        $this->api->setClient($clientMock);

        $r = $this->api->destroy($this->id, $params);
        $this->assertEquals(null, $r);
    }

    public function testIndex()
    {
        $data = json_decode('{
            "_links": {
                "self": "http://localhost:8090/confluence/rest/api/content"
            },
            "limit": 10,
            "results": [
                {
                    "_expandable": {
                        "ancestors": "",
                        "children": "/rest/api/content/557065/child",
                        "container": "",
                        "descendants": "/rest/api/content/557065/descendant",
                        "version": ""
                    },
                    "_links": {
                        "self": "http://localhost:8090/confluence/rest/api/content/557065",
                        "tinyui": "/x/CYAI",
                        "webui": "/display/TST/Test+Space+Home"
                    },
                    "body": {
                        "editor": {
                            "_expandable": {
                                "content": "/rest/api/content/557065"
                            },
                            "representation": "editor"
                        },
                        "export_view": {
                            "_expandable": {
                                "content": "/rest/api/content/557065"
                            },
                            "representation": "export_view"
                        },
                        "storage": {
                            "_expandable": {
                                "content": "/rest/api/content/557065"
                            },
                            "representation": "storage"
                        },
                        "view": {
                            "_expandable": {
                                "content": "/rest/api/content/557065"
                            },
                            "representation": "view",
                            "value": "<p>Example page</p>"
                        }
                    },
                    "history": {
                        "_expandable": {
                            "lastUpdated": ""
                        },
                        "_links": {
                            "self": "http://localhost:8090/confluence/rest/api/content/557065/history"
                        },
                        "createdBy": {
                            "displayName": "A. D. Ministrator",
                            "profilePicture": {
                                "height": 48,
                                "isDefault": true,
                                "path": "/confluence/s/en_GB-1988/4960/NOCACHE1/_/images/icons/profile/default.png",
                                "width": 48
                            },
                            "type": "known",
                            "username": "admin"
                        },
                        "createdDate": "2014-03-07T16:14:35.220+1100",
                        "latest": true
                    },
                    "id": "557065",
                    "metadata": {
                        "labels": {
                            "_links": {
                                "self": "http://localhost:8090/confluence/rest/api/content/557065/label"
                            },
                            "limit": 200,
                            "results": [],
                            "size": 0,
                            "start": 0
                        },
                        "likesCount": null
                    },
                    "space": {
                        "_links": {
                            "self": "http://localhost:8090/confluence/rest/api/space/TST"
                        },
                        "id": 786433,
                        "key": "TST",
                        "name": "Test Space"
                    },
                    "title": "Test Space Home",
                    "type": "page"
                },
                {
                    "_expandable": {
                        "ancestors": "",
                        "children": "/rest/api/content/557067/child",
                        "container": "",
                        "descendants": "/rest/api/content/557067/descendant",
                        "version": ""
                    },
                    "_links": {
                        "self": "http://localhost:8090/confluence/rest/api/content/557067",
                        "tinyui": "/x/C4AI",
                        "webui": "/display/TST/A+new+page"
                    },
                    "body": {
                        "editor": {
                            "_expandable": {
                                "content": "/rest/api/content/557067"
                            },
                            "representation": "editor"
                        },
                        "export_view": {
                            "_expandable": {
                                "content": "/rest/api/content/557067"
                            },
                            "representation": "export_view"
                        },
                        "storage": {
                            "_expandable": {
                                "content": "/rest/api/content/557067"
                            },
                            "representation": "storage"
                        },
                        "view": {
                            "_expandable": {
                                "content": "/rest/api/content/557067"
                            },
                            "representation": "view",
                            "value": ""
                        }
                    },
                    "history": {
                        "_expandable": {
                            "lastUpdated": ""
                        },
                        "_links": {
                            "self": "http://localhost:8090/confluence/rest/api/content/557067/history"
                        },
                        "createdBy": {
                            "displayName": "A. D. Ministrator",
                            "profilePicture": {
                                "height": 48,
                                "isDefault": true,
                                "path": "/confluence/s/en_GB-1988/4960/NOCACHE1/_/images/icons/profile/default.png",
                                "width": 48
                            },
                            "type": "known",
                            "username": "admin"
                        },
                        "createdDate": "2014-03-07T16:18:33.554+1100",
                        "latest": true
                    },
                    "id": "557067",
                    "metadata": {
                        "labels": {
                            "_links": {
                                "self": "http://localhost:8090/confluence/rest/api/content/557067/label"
                            },
                            "limit": 200,
                            "results": [],
                            "size": 0,
                            "start": 0
                        },
                        "likesCount": null
                    },
                    "space": {
                        "_links": {
                            "self": "http://localhost:8090/confluence/rest/api/space/TST"
                        },
                        "id": 786433,
                        "key": "TST",
                        "name": "Test Space"
                    },
                    "title": "A new page",
                    "type": "page"
                },
                {
                    "_expandable": {
                        "ancestors": "",
                        "children": "/rest/api/content/950276/child",
                        "container": "",
                        "descendants": "/rest/api/content/950276/descendant",
                        "version": ""
                    },
                    "_links": {
                        "self": "http://localhost:8090/confluence/rest/api/content/950276",
                        "tinyui": "/x/BIAO",
                        "webui": "/display/TST/myPage+Title"
                    },
                    "body": {
                        "editor": {
                            "_expandable": {
                                "content": "/rest/api/content/950276"
                            },
                            "representation": "editor"
                        },
                        "export_view": {
                            "_expandable": {
                                "content": "/rest/api/content/950276"
                            },
                            "representation": "export_view"
                        },
                        "storage": {
                            "_expandable": {
                                "content": "/rest/api/content/950276"
                            },
                            "representation": "storage"
                        },
                        "view": {
                            "_expandable": {
                                "content": "/rest/api/content/950276"
                            },
                            "representation": "view",
                            "value": "<p>Some content</p>"
                        }
                    },
                    "history": {
                        "_expandable": {
                            "lastUpdated": ""
                        },
                        "_links": {
                            "self": "http://localhost:8090/confluence/rest/api/content/950276/history"
                        },
                        "createdBy": {
                            "displayName": "A. D. Ministrator",
                            "profilePicture": {
                                "height": 48,
                                "isDefault": true,
                                "path": "/confluence/s/en_GB-1988/4960/NOCACHE1/_/images/icons/profile/default.png",
                                "width": 48
                            },
                            "type": "known",
                            "username": "admin"
                        },
                        "createdDate": "2014-03-07T17:08:20.326+1100",
                        "latest": true
                    },
                    "id": "950276",
                    "metadata": {
                        "labels": {
                            "_links": {
                                "self": "http://localhost:8090/confluence/rest/api/content/950276/label"
                            },
                            "limit": 200,
                            "results": [],
                            "size": 0,
                            "start": 0
                        },
                        "likesCount": null
                    },
                    "space": {
                        "_links": {
                            "self": "http://localhost:8090/confluence/rest/api/space/TST"
                        },
                        "id": 786433,
                        "key": "TST",
                        "name": "Test Space"
                    },
                    "title": "myPage Title",
                    "type": "page"
                }
            ],
            "size": 3,
            "start": 0
        }', true);
        $params = [
            'type' => 'blogpost',
            'expand' => 'space,history,body.view,metadata.labels',
            'start' => 20,
            'limit' => 10,
        ];
        $clientMock = $this->getMockBuilder(Client::class)->getMock();
        $clientMock->expects($this->once())
            ->method('request')
            ->with(
                'GET',
                'content',
                ['query' => $params]
            )
            ->willReturn(new Response(200, [], json_encode($data)));
        $this->api->setClient($clientMock);

        $r = $this->api->index($params);
        $this->assertEquals($data, $r);
    }

    public function testShow()
    {
        $data = json_decode('{
            "_expandable": {
                "ancestors": "",
                "children": "",
                "container": "",
                "history": "/rest/api/content/3965072/history",
                "metadata": "",
                "space": "/rest/api/space/TST",
                "version": ""
            },
            "_links": {
                "base": "http://localhost:8090/confluence",
                "collection": "/rest/api/contents",
                "self": "http://localhost:8090/confluence/rest/api/content/3965072",
                "tinyui": "/x/kIA8",
                "webui": "/display/TST/Test+Page"
            },
            "body": {
                "editor": {
                    "_expandable": {
                        "content": "/rest/api/content/3965072"
                    },
                    "representation": "editor"
                },
                "export_view": {
                    "_expandable": {
                        "content": "/rest/api/content/3965072"
                    },
                    "representation": "export_view"
                },
                "storage": {
                    "_expandable": {
                        "content": "/rest/api/content/3965072"
                    },
                    "representation": "storage",
                    "value": "<p>blah blah</p>"
                },
                "view": {
                    "_expandable": {
                        "content": "/rest/api/content/3965072"
                    },
                    "representation": "view"
                }
            },
            "id": "3965072",
            "title": "Test Page",
            "type": "page"
        }', true);
        $clientMock = $this->getMockBuilder(Client::class)->getMock();
        $clientMock->expects($this->once())
            ->method('request')
            ->with(
                'GET',
                "content/{$this->id}"
            )
            ->willReturn(new Response(200, [], json_encode($data)));
        $this->api->setClient($clientMock);

        $r = $this->api->show($this->id);
        $this->assertEquals($data, $r);
    }

    public function testStore()
    {
        $data = [
            'type' => 'page',
            'title' => 'new page',
            'space' => [
                'key' => 'TST',
            ],
            'body' => [
                'storage' => [
                    'value' => '<p>This is <br/> a new page</p>',
                    'representation' => 'storage',
                ],
            ],
        ];

        $clientMock = $this->getMockBuilder(Client::class)->getMock();
        $clientMock->expects($this->once())
            ->method('request')
            ->with(
                'POST',
                'content',
                ['json' => $data]
            )
            ->willReturn(new Response(200, [], '{
                "_expandable": {
                    "children": "/rest/api/content/3604482/child",
                    "descendants": "/rest/api/content/3604482/descendant",
                    "metadata": ""
                },
                "_links": {
                    "base": "http://localhost:8090/confluence",
                    "collection": "/rest/api/contents",
                    "self": "http://localhost:8090/confluence/rest/api/content/3604482",
                    "tinyui": "/x/AgA3",
                    "webui": "/display/TST/new+page"
                },
                "ancestors": [],
                "body": {
                    "editor": {
                        "_expandable": {
                            "content": "/rest/api/content/3604482"
                        },
                        "representation": "editor"
                    },
                    "export_view": {
                        "_expandable": {
                            "content": "/rest/api/content/3604482"
                        },
                        "representation": "export_view"
                    },
                    "storage": {
                        "_expandable": {
                            "content": "/rest/api/content/3604482"
                        },
                        "representation": "storage",
                        "value": "<p>This is a new page</p>"
                    },
                    "view": {
                        "_expandable": {
                            "content": "/rest/api/content/3604482"
                        },
                        "representation": "view"
                    }
                },
                "container": {
                    "_links": {
                        "self": "http://localhost:8090/confluence/rest/api/space/TST"
                    },
                    "id": 2719747,
                    "key": "TST",
                    "name": "Test Space"
                },
                "history": {
                    "_expandable": {
                        "lastUpdated": ""
                    },
                    "_links": {
                        "self": "http://localhost:8090/confluence/rest/api/content/3604482/history"
                    },
                    "createdBy": {
                        "displayName": "A. D. Ministrator",
                        "profilePicture": {
                            "height": 48,
                            "isDefault": true,
                            "path": "/confluence/s/en_GB-1988/4960/NOCACHE1/_/images/icons/profile/default.png",
                            "width": 48
                        },
                        "type": "known",
                        "username": "admin"
                    },
                    "createdDate": "2014-03-10T23:14:35.031+1100",
                    "latest": true
                },
                "id": "3604482",
                "space": {
                    "_links": {
                        "self": "http://localhost:8090/confluence/rest/api/space/TST"
                    },
                    "id": 2719747,
                    "key": "TST",
                    "name": "Test Space"
                },
                "title": "new page",
                "type": "page",
                "version": {
                    "by": {
                        "displayName": "A. D. Ministrator",
                        "profilePicture": {
                            "height": 48,
                            "isDefault": true,
                            "path": "/confluence/s/en_GB-1988/4960/NOCACHE1/_/images/icons/profile/default.png",
                            "width": 48
                        },
                        "type": "known",
                        "username": "admin"
                    },
                    "message": "",
                    "minorEdit": false,
                    "number": 1,
                    "when": "2014-03-10T23:14:35.031+1100"
                }
            }'));
        $this->api->setClient($clientMock);

        $r = $this->api->store($data);
        $this->assertArrayHasKey('id', $r);
    }

    public function testUpdate()
    {
        $data = [
            'version' => [
                'number' => 2,
            ],
            'title' => 'My new title',
            'type' => 'page',
            'body' => [
                'storage' => [
                    'value' => '<p>New page data.</p>',
                    'representation' => 'storage',
                ],
            ],
        ];

        $clientMock = $this->getMockBuilder(Client::class)->getMock();
        $clientMock->expects($this->once())
            ->method('request')
            ->with(
                'PUT',
                "content/{$this->id}",
                ['json' => $data]
            )
            ->willReturn(new Response(200, [], '{
                "_expandable": {
                    "children": "/rest/api/content/3604482/child",
                    "descendants": "/rest/api/content/3604482/descendant",
                    "metadata": ""
                },
                "_links": {
                    "base": "http://localhost:8090/confluence",
                    "collection": "/rest/api/contents",
                    "self": "http://localhost:8090/confluence/rest/api/content/3604482",
                    "tinyui": "/x/AgA3",
                    "webui": "/display/TST/new+page"
                },
                "ancestors": [],
                "body": {
                    "editor": {
                        "_expandable": {
                            "content": "/rest/api/content/3604482"
                        },
                        "representation": "editor"
                    },
                    "export_view": {
                        "_expandable": {
                            "content": "/rest/api/content/3604482"
                        },
                        "representation": "export_view"
                    },
                    "storage": {
                        "_expandable": {
                            "content": "/rest/api/content/3604482"
                        },
                        "representation": "storage",
                        "value": "<p>This is a new page</p>"
                    },
                    "view": {
                        "_expandable": {
                            "content": "/rest/api/content/3604482"
                        },
                        "representation": "view"
                    }
                },
                "container": {
                    "_links": {
                        "self": "http://localhost:8090/confluence/rest/api/space/TST"
                    },
                    "id": 2719747,
                    "key": "TST",
                    "name": "Test Space"
                },
                "history": {
                    "_expandable": {
                        "lastUpdated": ""
                    },
                    "_links": {
                        "self": "http://localhost:8090/confluence/rest/api/content/3604482/history"
                    },
                    "createdBy": {
                        "displayName": "A. D. Ministrator",
                        "profilePicture": {
                            "height": 48,
                            "isDefault": true,
                            "path": "/confluence/s/en_GB-1988/4960/NOCACHE1/_/images/icons/profile/default.png",
                            "width": 48
                        },
                        "type": "known",
                        "username": "admin"
                    },
                    "createdDate": "2014-03-10T23:14:35.031+1100",
                    "latest": true
                },
                "id": "3604482",
                "space": {
                    "_links": {
                        "self": "http://localhost:8090/confluence/rest/api/space/TST"
                    },
                    "id": 2719747,
                    "key": "TST",
                    "name": "Test Space"
                },
                "title": "My new title",
                "type": "page",
                "version": {
                    "by": {
                        "displayName": "A. D. Ministrator",
                        "profilePicture": {
                            "height": 48,
                            "isDefault": true,
                            "path": "/confluence/s/en_GB-1988/4960/NOCACHE1/_/images/icons/profile/default.png",
                            "width": 48
                        },
                        "type": "known",
                        "username": "admin"
                    },
                    "message": "",
                    "minorEdit": false,
                    "number": 1,
                    "when": "2014-03-10T23:14:35.031+1100"
                }
            }'));
        $this->api->setClient($clientMock);

        $r = $this->api->update($this->id, $data);
        $this->assertEquals($data['title'], $r['title']);
    }
}
