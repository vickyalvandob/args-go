---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://args.test/docs/collection.json)

<!-- END_INFO -->

#Antagonist


<!-- START_ca791a8d56d907d832d3ad90a1f62285 -->
## Antagonist Attack Index
List of history antagonist attack

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "http://args.test/api/antagonistAttack" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://args.test/api/antagonistAttack"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "antagonistAttacks": "antagonistAttacks",
    "message": "Info validation"
}
```

### HTTP Request
`GET api/antagonistAttack`


<!-- END_ca791a8d56d907d832d3ad90a1f62285 -->

<!-- START_4b291bc570e3526f3ca16ce801096bcd -->
## Antagonist Attack
user minus energy when antagonist attack

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://args.test/api/antagonistAttack" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"antagonist_id":20}'

```

```javascript
const url = new URL(
    "http://args.test/api/antagonistAttack"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "antagonist_id": 20
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "user": "update coin_ttg user",
    "antagonist": "antagonist",
    "antagonistAttack": "store query antagonistAttack",
    "message": "Successfully"
}
```

### HTTP Request
`POST api/antagonistAttack`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `antagonist_id` | integer |  required  | 
    
<!-- END_4b291bc570e3526f3ca16ce801096bcd -->

#Authentication


<!-- START_c3fa189a6c95ca36ad6ac4791a873d23 -->
## Login

> Example request:

```bash
curl -X POST \
    "http://args.test/api/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"username":"laboriosam","password":"et"}'

```

```javascript
const url = new URL(
    "http://args.test/api/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "username": "laboriosam",
    "password": "et"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC93ZWJtYXN0ZXIudGVzdFwvYXBpXC9sb2dpbiIsImlhdCI6MTYxOTM4MzY4MywiZXhwIjoxNjE5Mzg3MjgzLCJuYmYiOjE2MTkzODM2ODMsImp0aSI6InltTmRZV2U4SHFLeGxPdm0iLCJzdWIiOjEsInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEifQ.y9l9cci70N8um7RzsRs0ziMqVR0VTy3ODJaZU5SFwn4",
            "token_type": "bearer",
            "expires_in": 3600,
            "user": {
                "id": 1,
                "name": "user",
                "username": "user",
                "email": "user@gmail.com",
                "email_verified_at": null,
                "image": "default.png",
                "address": null,
                "city": null,
                "country": null,
                "zipcode": null,
                "phone": null,
                "birth": null,
                "balance": 0,
                "coin_gast": 0,
                "coin_ttg": 0,
                "energy": 0,
                "energy_quota": 0,
                "created_at": "2021-04-24 06:19:21",
                "updated_at": "2021-04-26 01:58:05"
            }
        }
    ]
}
```

### HTTP Request
`POST api/login`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `username` | string |  required  | 
        `password` | string |  required  | 
    
<!-- END_c3fa189a6c95ca36ad6ac4791a873d23 -->

<!-- START_d7b7952e7fdddc07c978c9bdaf757acf -->
## Register

> Example request:

```bash
curl -X POST \
    "http://args.test/api/register" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"cumque","email":"quia","username":"reiciendis","password":"sequi","password_confirmation":"ratione","phone":"voluptatum","zipcode":"nemo","city":"fugiat","birth":"ut","address":"non"}'

```

```javascript
const url = new URL(
    "http://args.test/api/register"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "cumque",
    "email": "quia",
    "username": "reiciendis",
    "password": "sequi",
    "password_confirmation": "ratione",
    "phone": "voluptatum",
    "zipcode": "nemo",
    "city": "fugiat",
    "birth": "ut",
    "address": "non"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "message": "User successfully registered",
            "user": {
                "name": "user2",
                "email": "user2@gmail.com",
                "username": "user2",
                "phone": null,
                "zipcode": null,
                "city": null,
                "birth": null,
                "address": null,
                "updated_at": "2021-04-26 06:24:37",
                "created_at": "2021-04-26 06:24:37",
                "id": 2
            }
        }
    ]
}
```

### HTTP Request
`POST api/register`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `name` | string |  required  | 
        `email` | string |  required  | 
        `username` | string |  required  | 
        `password` | string |  required  | 
        `password_confirmation` | string |  required  | 
        `phone` | string |  optional  | 
        `zipcode` | string |  optional  | 
        `city` | string |  optional  | 
        `birth` | date |  optional  | 
        `address` | text |  optional  | 
    
<!-- END_d7b7952e7fdddc07c978c9bdaf757acf -->

<!-- START_61739f3220a224b34228600649230ad1 -->
## Logout

> Example request:

```bash
curl -X POST \
    "http://args.test/api/logout" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://args.test/api/logout"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "message": "Successfully logged out"
        }
    ]
}
```

### HTTP Request
`POST api/logout`


<!-- END_61739f3220a224b34228600649230ad1 -->

<!-- START_3fba263a38f92fde0e4e12f76067a611 -->
## Refresh a token.

> Example request:

```bash
curl -X POST \
    "http://args.test/api/refresh" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://args.test/api/refresh"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/refresh`


<!-- END_3fba263a38f92fde0e4e12f76067a611 -->

#Claim


<!-- START_08cdded3d400b1cb88e811e4d011839a -->
## Claim Coin GAST Index
Get data coin GAST user yang sudah di claim

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "http://args.test/api/coinClaim" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://args.test/api/coinClaim"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "coinClaims": "List claim coin GAST"
}
```

### HTTP Request
`GET api/coinClaim`


<!-- END_08cdded3d400b1cb88e811e4d011839a -->

<!-- START_1ff9b0a04a1c671be3edbd93f1300031 -->
## Claim Coin GAST Store
Request claim coin gast use coin ttg

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://args.test/api/coinClaim" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"amount":4570.7288643,"note":"vero"}'

```

```javascript
const url = new URL(
    "http://args.test/api/coinClaim"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "amount": 4570.7288643,
    "note": "vero"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "user": "update coin_gast & coin_ttg user",
    "coinClaim": "store query coinClaim "
}
```

### HTTP Request
`POST api/coinClaim`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `amount` | float |  required  | 
        `note` | text |  optional  | optional
    
<!-- END_1ff9b0a04a1c671be3edbd93f1300031 -->

<!-- START_5db9ddb11d9a59410718b02f361d0001 -->
## Reward Claim Index

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "http://args.test/api/rewardClaim" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://args.test/api/rewardClaim"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "rewardClaims": "rewardClaims"
}
```

### HTTP Request
`GET api/rewardClaim`


<!-- END_5db9ddb11d9a59410718b02f361d0001 -->

<!-- START_cf679c74946aa760b5e8c210f8222752 -->
## Claim Reward Store

request claim Reward use coin ttg

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://args.test/api/rewardClaim" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"reward_collect_id":49.26,"qty":2569.8,"recipient_name":37716243.16960546,"recipient_phone":2646676.820948,"recipient_address":2.34,"note":"similique"}'

```

```javascript
const url = new URL(
    "http://args.test/api/rewardClaim"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "reward_collect_id": 49.26,
    "qty": 2569.8,
    "recipient_name": 37716243.16960546,
    "recipient_phone": 2646676.820948,
    "recipient_address": 2.34,
    "note": "similique"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "user": "update query user",
    "rewardClaim": "store query rewardClaim",
    "rewardCollect": "store query rewardCollect",
    "reward": "store query reward"
}
```

### HTTP Request
`POST api/rewardClaim`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `reward_collect_id` | float |  required  | 
        `qty` | float |  required  | 
        `recipient_name` | float |  required  | 
        `recipient_phone` | float |  required  | 
        `recipient_address` | float |  required  | 
        `note` | text |  optional  | optional
    
<!-- END_cf679c74946aa760b5e8c210f8222752 -->

<!-- START_2e7d09ae4ce08c138f9fdcdc2d1ac3cb -->
## Puzzle Claim Index

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "http://args.test/api/puzzleClaim" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"amount":18774352.707421,"qty":18}'

```

```javascript
const url = new URL(
    "http://args.test/api/puzzleClaim"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "amount": 18774352.707421,
    "qty": 18
}

fetch(url, {
    method: "GET",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "puzzlePieceClaims": "update query puzzlePieceClaims"
}
```

### HTTP Request
`GET api/puzzleClaim`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `amount` | float |  required  | 
        `qty` | integer |  required  | 
    
<!-- END_2e7d09ae4ce08c138f9fdcdc2d1ac3cb -->

<!-- START_c8104098aa0ac396978f4997a6758804 -->
## Puzzle Claim Store

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://args.test/api/puzzleClaim" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"puzzle_collect_id":4,"recipient_name":"quaerat","recipient_phone":"qui","recipient_address":"sint","note":"fuga","qty":9}'

```

```javascript
const url = new URL(
    "http://args.test/api/puzzleClaim"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "puzzle_collect_id": 4,
    "recipient_name": "quaerat",
    "recipient_phone": "qui",
    "recipient_address": "sint",
    "note": "fuga",
    "qty": 9
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "user": "update coin_ttg user",
    "puzzleCollect": "update qty puzzleCollect",
    "puzzleClaim": "store query puzzleClaim",
    "message": "Successfully"
}
```

### HTTP Request
`POST api/puzzleClaim`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `puzzle_collect_id` | integer |  required  | 
        `recipient_name` | string |  required  | 
        `recipient_phone` | string |  required  | 
        `recipient_address` | string |  required  | 
        `note` | string |  required  | 
        `qty` | integer |  required  | 
    
<!-- END_c8104098aa0ac396978f4997a6758804 -->

#Collection


<!-- START_eb783257bcc779ba25a708794d0ccbb1 -->
## Get Collection
ambil data reward, coin, puzzle untuk di collect

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "http://args.test/api/collection" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://args.test/api/collection"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "user": "user data",
    "coin": "coin data",
    "puzzle": "puzzle data",
    "puzzlePiece": "puzzlePiece data",
    "reward": "reward data",
    "message": "Get Collection"
}
```

### HTTP Request
`GET api/collection`


<!-- END_eb783257bcc779ba25a708794d0ccbb1 -->

<!-- START_622e5fe0210a6d28f9f13b9a213a579c -->
## Coin GAST Index
Get data coin GAST user yang sudah di collection

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "http://args.test/api/coinCollect" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://args.test/api/coinCollect"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "coinCollects": "coinCollects",
    "message": "List Collect Coin GAST"
}
```

### HTTP Request
`GET api/coinCollect`


<!-- END_622e5fe0210a6d28f9f13b9a213a579c -->

<!-- START_bf0ca9514a160ff2fd1161f57daf3b2b -->
## Coin GAST Store
Store collection coin nya pake coin_id yg di dapet dari get collection.

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://args.test/api/coinCollect" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"coin_id":13}'

```

```javascript
const url = new URL(
    "http://args.test/api/coinCollect"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "coin_id": 13
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "user": "update query user",
    "coinCollect": "store query coinCollect",
    "message": "Collect Coin GAST"
}
```

### HTTP Request
`POST api/coinCollect`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `coin_id` | integer |  required  | 
    
<!-- END_bf0ca9514a160ff2fd1161f57daf3b2b -->

<!-- START_fa4ba544b89c11d5bcc409ea19302531 -->
## Reward Index
Get data reward user yang sudah di collection

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "http://args.test/api/rewardCollect" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://args.test/api/rewardCollect"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "rewardCollects": "rewardCollects",
    "rewardCollectHistory": "rewardCollectHistory",
    "message": "List Collect Reward"
}
```

### HTTP Request
`GET api/rewardCollect`


<!-- END_fa4ba544b89c11d5bcc409ea19302531 -->

<!-- START_bf362327fb79f2758e8e305e336d6084 -->
## Reward Store
Store collection reward  pake reward_id yg di dapet dari get collection.

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://args.test/api/rewardCollect" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"reward_id":9}'

```

```javascript
const url = new URL(
    "http://args.test/api/rewardCollect"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "reward_id": 9
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "user": "user",
    "rewardCollect": "rewardCollect",
    "rewardCollectHistory": "rewardCollectHistory"
}
```

### HTTP Request
`POST api/rewardCollect`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `reward_id` | integer |  required  | 
    
<!-- END_bf362327fb79f2758e8e305e336d6084 -->

<!-- START_fb5aec833db44930373c866d94a42e60 -->
## Puzzle Index
get data puzzle yang telah ter combine dari pieces2 yg di collection

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "http://args.test/api/puzzleCollect" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://args.test/api/puzzleCollect"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "puzzles": "get query puzzle",
    "puzzleCollects": "get query puzzleCollect",
    "puzzleCollectHistorys": "get query puzzleCollect"
}
```

### HTTP Request
`GET api/puzzleCollect`


<!-- END_fb5aec833db44930373c866d94a42e60 -->

<!-- START_232917d4d93edff48988b37532bc71a6 -->
## Puzzle  Store
Combine pieces become full puzzle

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://args.test/api/puzzleCollect" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"puzzle_id":8,"qty":8}'

```

```javascript
const url = new URL(
    "http://args.test/api/puzzleCollect"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "puzzle_id": 8,
    "qty": 8
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "user": "update query user",
    "puzzle": "show query puzzle",
    "puzzleCollect": "store or update qty puzzleCollect",
    "puzzleCollectHistory": "store query puzzleCollectHistory",
    "puzzlePieceCollectHistory": "store query puzzlePieceCollectHistory"
}
```

### HTTP Request
`POST api/puzzleCollect`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `puzzle_id` | integer |  required  | 
        `qty` | integer |  required  | 
    
<!-- END_232917d4d93edff48988b37532bc71a6 -->

<!-- START_8a9b8faf2c1ef4b388dedcffb1baa3f2 -->
## Puzzle Piece Index
get data pieece yang di collection

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "http://args.test/api/puzzlePieceCollect" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://args.test/api/puzzlePieceCollect"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "puzzles": "get query puzzle",
    "puzzleCollects": "get query puzzleCollect",
    "puzzleCollectHistorys": "get query puzzleCollect"
}
```

### HTTP Request
`GET api/puzzlePieceCollect`


<!-- END_8a9b8faf2c1ef4b388dedcffb1baa3f2 -->

<!-- START_6701f3fd63af8b5e76b482dd14a52163 -->
## Puzzle Piece Store
collect pize puzzle dari get collection

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://args.test/api/puzzlePieceCollect" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"puzzle_piece_id":12}'

```

```javascript
const url = new URL(
    "http://args.test/api/puzzlePieceCollect"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "puzzle_piece_id": 12
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "user": "update query user",
    "puzzlePiece": "show query puzzlePiece",
    "puzzlePieceCollect": "store or update qty puzzlePieceCollect",
    "puzzlePieceCollectHistory": "store query puzzlePieceCollectHistory"
}
```

### HTTP Request
`POST api/puzzlePieceCollect`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `puzzle_piece_id` | integer |  required  | 
    
<!-- END_6701f3fd63af8b5e76b482dd14a52163 -->

#Energy Boost


<!-- START_08f6aad15c79f3c94be726ebebc09a7e -->
## Index

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "http://args.test/api/energyBoost" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://args.test/api/energyBoost"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "energyBoost": "query tbl energy boost"
}
```

### HTTP Request
`GET api/energyBoost`


<!-- END_08f6aad15c79f3c94be726ebebc09a7e -->

<!-- START_b6bf3101efc1bfb9c26e7274bd18e788 -->
## Store
Boost enum[plus, minus] to update energy  until max or blank

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://args.test/api/energyBoost" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"type":"quos"}'

```

```javascript
const url = new URL(
    "http://args.test/api/energyBoost"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "type": "quos"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "user": "update energy user",
    "energyBoost": "store query tbl energy boost"
}
```

### HTTP Request
`POST api/energyBoost`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `type` | string |  required  | 
    
<!-- END_b6bf3101efc1bfb9c26e7274bd18e788 -->

#Mall


<!-- START_ad56000ecbe6523c8c4b718c435e01ff -->
## reward Sells Index

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "http://args.test/api/rewardSell" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://args.test/api/rewardSell"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "rewardSells": "list item user Sell reward in mall",
    "pieces": "List item in mall"
}
```

### HTTP Request
`GET api/rewardSell`


<!-- END_ad56000ecbe6523c8c4b718c435e01ff -->

<!-- START_c0f4d61e5e94e6da730de73fd6d23acf -->
## Reward Sell Store

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://args.test/api/rewardSell" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"reward_collect_id":19,"amount":20,"qty":13}'

```

```javascript
const url = new URL(
    "http://args.test/api/rewardSell"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "reward_collect_id": 19,
    "amount": 20,
    "qty": 13
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "user": "user",
    "rewardCollect": "rewardCollect",
    "rewardSell": "rewardSell"
}
```

### HTTP Request
`POST api/rewardSell`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `reward_collect_id` | integer |  required  | 
        `amount` | integer |  required  | 
        `qty` | integer |  required  | 
    
<!-- END_c0f4d61e5e94e6da730de73fd6d23acf -->

<!-- START_5f66c5f5d3fc0a1a3399bc7e7f8f6d61 -->
## Reward Buys Index

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "http://args.test/api/rewardBuy" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://args.test/api/rewardBuy"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "rewardBuys": "list item user buy reward another user in mall",
    "rewardSellBuys": "List item user sell reward in purchase another user"
}
```

### HTTP Request
`GET api/rewardBuy`


<!-- END_5f66c5f5d3fc0a1a3399bc7e7f8f6d61 -->

<!-- START_6810feb12a73aae338a403319e022867 -->
## Reward Buy Store

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://args.test/api/rewardBuy" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"reward_collect_id":9,"amount":16,"qty":7}'

```

```javascript
const url = new URL(
    "http://args.test/api/rewardBuy"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "reward_collect_id": 9,
    "amount": 16,
    "qty": 7
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "user": "user",
    "seller": "seller",
    "rewardCollect": "rewardCollect",
    "rewardSell": "rewardSell",
    "rewardBuy": "rewardBuy"
}
```

### HTTP Request
`POST api/rewardBuy`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `reward_collect_id` | integer |  required  | 
        `amount` | integer |  required  | 
        `qty` | integer |  required  | 
    
<!-- END_6810feb12a73aae338a403319e022867 -->

<!-- START_905b8959d4905b6d8bc6577691870a6c -->
## Puzzle Piece Sells Index

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "http://args.test/api/puzzlePieceSell" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://args.test/api/puzzlePieceSell"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "puzzlePieceSells": "list item user Sell puzzle piece in mall",
    "pieces": "List item in mall"
}
```

### HTTP Request
`GET api/puzzlePieceSell`


<!-- END_905b8959d4905b6d8bc6577691870a6c -->

<!-- START_c14e96d54af8a3d3afb15cf42f2b3ecc -->
## Puzzle Piece Sells Store

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://args.test/api/puzzlePieceSell" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"puzzle_piece_collect_id":4,"amount":10.938522678,"qty":9}'

```

```javascript
const url = new URL(
    "http://args.test/api/puzzlePieceSell"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "puzzle_piece_collect_id": 4,
    "amount": 10.938522678,
    "qty": 9
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "user": "update query user",
    "puzzlePieceCollect": "update query puzzlePieceCollect",
    "puzzlePieceSell": "store query puzzlePieceSell"
}
```

### HTTP Request
`POST api/puzzlePieceSell`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `puzzle_piece_collect_id` | integer |  required  | 
        `amount` | float |  required  | 
        `qty` | integer |  required  | 
    
<!-- END_c14e96d54af8a3d3afb15cf42f2b3ecc -->

<!-- START_037636aab7fd3180bdbb48bf3fcb6913 -->
## Puzzle Piece Buys Index

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "http://args.test/api/puzzlePieceBuy" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://args.test/api/puzzlePieceBuy"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "puzzlePieceBuys": "list item user buy puzzle piece another user in mall",
    "puzzlePieceSellBuys": "List item user sell puzzle in purchase another user"
}
```

### HTTP Request
`GET api/puzzlePieceBuy`


<!-- END_037636aab7fd3180bdbb48bf3fcb6913 -->

<!-- START_b5b71e9823ffb659e1e34b29d35a090a -->
## Puzzle Piece Buy store
Buy piece puzzle in mall

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://args.test/api/puzzlePieceBuy" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"puzzle_piece_sell_id":1,"qty":11}'

```

```javascript
const url = new URL(
    "http://args.test/api/puzzlePieceBuy"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "puzzle_piece_sell_id": 1,
    "qty": 11
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "user": "update coin_ttg user",
    "puzzlePieceCollect": "update puzzlePieceCollect",
    "seller": "show query seller",
    "puzzlePieceSell": "store or update puzzlePieceSell",
    "puzzlePieceBuy": "store query puzzlePieceBuy"
}
```

### HTTP Request
`POST api/puzzlePieceBuy`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `puzzle_piece_sell_id` | integer |  required  | 
        `qty` | integer |  required  | 
    
<!-- END_b5b71e9823ffb659e1e34b29d35a090a -->

#Payout


<!-- START_91410692f9b5faa17cb40bf0f4e79259 -->
## Index

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "http://args.test/api/payout" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://args.test/api/payout"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "payout": "payout data"
}
```

### HTTP Request
`GET api/payout`


<!-- END_91410692f9b5faa17cb40bf0f4e79259 -->

<!-- START_41fa144ac19f31ae63e5795d057dafd4 -->
## Store

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://args.test/api/payout" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"amount":41064086.6331,"note":"quia"}'

```

```javascript
const url = new URL(
    "http://args.test/api/payout"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "amount": 41064086.6331,
    "note": "quia"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "user": "user data",
    "payout": "payout data"
}
```

### HTTP Request
`POST api/payout`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `amount` | float |  required  | 
        `note` | string |  optional  | 
    
<!-- END_41fa144ac19f31ae63e5795d057dafd4 -->

#Top Up


<!-- START_2df0fa9b98f101602b9ef85d24ed6b6a -->
## Index

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "http://args.test/api/topUp" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://args.test/api/topUp"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "topUp": "show query top Up"
}
```

### HTTP Request
`GET api/topUp`


<!-- END_2df0fa9b98f101602b9ef85d24ed6b6a -->

<!-- START_9fd89935f47ab1bbadbb5ac6890eae86 -->
## Store

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://args.test/api/topUp" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"amount":13131740.99721,"note":"quas","proof_image":"optio"}'

```

```javascript
const url = new URL(
    "http://args.test/api/topUp"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "amount": 13131740.99721,
    "note": "quas",
    "proof_image": "optio"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "topUp": "store new query top Up"
}
```

### HTTP Request
`POST api/topUp`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `amount` | float |  required  | 
        `note` | string |  optional  | 
        `proof_image` | string |  required  | 
    
<!-- END_9fd89935f47ab1bbadbb5ac6890eae86 -->

#Transfer


<!-- START_76d2028bb36d2fc4f209efca1ffd8eb3 -->
## Index

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "http://args.test/api/transfer" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://args.test/api/transfer"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "transfer": "transfer data"
}
```

### HTTP Request
`GET api/transfer`


<!-- END_76d2028bb36d2fc4f209efca1ffd8eb3 -->

<!-- START_94e11f68870ff2d5ebc3c07919d78668 -->
## Store

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://args.test/api/transfer" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"username":"aut","amount":3945.63122626,"type":"dolore","note":"aliquid"}'

```

```javascript
const url = new URL(
    "http://args.test/api/transfer"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "username": "aut",
    "amount": 3945.63122626,
    "type": "dolore",
    "note": "aliquid"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "user": "user data",
    "recipient": "recipient data",
    "transfer": "transfer data"
}
```

### HTTP Request
`POST api/transfer`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `username` | string |  required  | 
        `amount` | float |  required  | 
        `type` | string |  optional  | enum['ARGS', 'GAST',]
        `note` | string |  optional  | 
    
<!-- END_94e11f68870ff2d5ebc3c07919d78668 -->

#User


<!-- START_3c520b0ccdbf5100b6f6994368e1b344 -->
## Index

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "http://args.test/api/profile" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://args.test/api/profile"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "user": "user data"
}
```

### HTTP Request
`GET api/profile`


<!-- END_3c520b0ccdbf5100b6f6994368e1b344 -->

<!-- START_1497ed33b433ac5263898f3caa2548a7 -->
## Update

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://args.test/api/profile" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"enim","city":"soluta","zipcode":"quis","phone":"ab","birth":"quod","address":"at"}'

```

```javascript
const url = new URL(
    "http://args.test/api/profile"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "enim",
    "city": "soluta",
    "zipcode": "quis",
    "phone": "ab",
    "birth": "quod",
    "address": "at"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "user": "user data"
}
```

### HTTP Request
`POST api/profile`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `name` | string |  required  | 
        `city` | string |  optional  | 
        `zipcode` | string |  optional  | 
        `phone` | string |  optional  | 
        `birth` | date |  optional  | 
        `address` | text |  optional  | 
    
<!-- END_1497ed33b433ac5263898f3caa2548a7 -->

<!-- START_227fd7c494cbc54bc5deecfc352a82a8 -->
## Change Password

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://args.test/api/password" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"old_password":"debitis","password":"eos","password_confirmation":"facilis"}'

```

```javascript
const url = new URL(
    "http://args.test/api/password"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "old_password": "debitis",
    "password": "eos",
    "password_confirmation": "facilis"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "user": "user data"
}
```

### HTTP Request
`POST api/password`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `old_password` | string |  required  | 
        `password` | string |  required  | 
        `password_confirmation` | string |  required  | 
    
<!-- END_227fd7c494cbc54bc5deecfc352a82a8 -->

#Weapon


<!-- START_053aedf5069d66796e230b9bb3fc9fb5 -->
## List Weapon Mall
list of weapon in mall

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "http://args.test/api/weapon" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://args.test/api/weapon"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "weapons": "weapons"
}
```

### HTTP Request
`GET api/weapon`


<!-- END_053aedf5069d66796e230b9bb3fc9fb5 -->

<!-- START_20faeab025242acc8559c3bc665a234f -->
## Weapon User
list of weapon purchase user

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "http://args.test/api/weaponCollect" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://args.test/api/weaponCollect"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "weaponCollects": "weaponCollects"
}
```

### HTTP Request
`GET api/weaponCollect`


<!-- END_20faeab025242acc8559c3bc665a234f -->

<!-- START_5d2199c4af88f0d817e03f18eac786f1 -->
## Weapon Buy Index
List of history purchase weapon in mall

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "http://args.test/api/weaponBuy" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://args.test/api/weaponBuy"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "weaponBuys": "weaponBuys",
    "message": "Info validation"
}
```

### HTTP Request
`GET api/weaponBuy`


<!-- END_5d2199c4af88f0d817e03f18eac786f1 -->

<!-- START_194a00d0622ec1912c7a7e839fe770f1 -->
## Weapon Buy Store
store purchase weapon in mall

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://args.test/api/weaponBuy" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"weapon_id":12,"qty":20}'

```

```javascript
const url = new URL(
    "http://args.test/api/weaponBuy"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "weapon_id": 12,
    "qty": 20
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "user": "update minus coin_ttg user",
    "weaponCollect": "update plus qty puzzleCollect",
    "weaponBuy": "store query weaponBuy",
    "message": "Purchase weapon"
}
```

### HTTP Request
`POST api/weaponBuy`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `weapon_id` | integer |  required  | 
        `qty` | integer |  required  | 
    
<!-- END_194a00d0622ec1912c7a7e839fe770f1 -->

<!-- START_fb832036c0ddc4c7adac1ad85284c4f7 -->
## Weapon Attack Index
list of weapon attack history

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "http://args.test/api/weaponAttack" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://args.test/api/weaponAttack"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "weaponAttacks": "weaponAttacks"
}
```

### HTTP Request
`GET api/weaponAttack`


<!-- END_fb832036c0ddc4c7adac1ad85284c4f7 -->

<!-- START_255d39df3a4b51f5f67cb58fa3012eac -->
## Weapon Attack Store
Store attack antaginist with weapon

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://args.test/api/weaponAttack" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"weapon_collect_id":8,"qty":14,"antagonist_id":5}'

```

```javascript
const url = new URL(
    "http://args.test/api/weaponAttack"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "weapon_collect_id": 8,
    "qty": 14,
    "antagonist_id": 5
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "weaponCollect": "weaponCollect",
    "antagonist": "antagonist",
    "weaponAttack": "weaponAttack",
    "message": "Info validation"
}
```

### HTTP Request
`POST api/weaponAttack`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `weapon_collect_id` | integer |  required  | 
        `qty` | integer |  required  | 
        `antagonist_id` | integer |  required  | 
    
<!-- END_255d39df3a4b51f5f67cb58fa3012eac -->

#general


<!-- START_705ed5b2175448eeae215b0332dc04e3 -->
## General
General setting tax, charge, logo, etc.

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "http://args.test/api/general" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://args.test/api/general"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "general": {
        "id": 1,
        "title": "ARGS",
        "description": null,
        "favicon": null,
        "logo_sm": "1619525299logo_sm.png",
        "logo_light": "1619462486logo_light.png",
        "logo_dark": "1619462486logo_dark.png",
        "coin_gast": "coin_gast.svg",
        "coin_ttg": "coin_ttg.svg",
        "coin_args": "coin_args.svg",
        "transfer_tax": 0,
        "transfer_ttg": 0.01,
        "topUp_tax": 0,
        "payout_tax": 0,
        "energy_exchange": 10,
        "energy_exchange_coin_gast": 10,
        "boost_percentage": 1,
        "created_at": "2020-11-15 19:08:50",
        "updated_at": "2021-04-27 19:08:19"
    },
    "message": "Successfully"
}
```

### HTTP Request
`GET api/general`


<!-- END_705ed5b2175448eeae215b0332dc04e3 -->


