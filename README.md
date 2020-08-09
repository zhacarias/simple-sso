## Simple Single Sign-On using Slim Framework

### API Endpoint usage

###### Custom

* HTTP Method: `GET/POST`
* Endpoint: `/api/authenticate`
* Request Headers: `Authorization: Basic {Encoded Base64}`

###### Active Directory

* HTTP Method: `POST`
* Endpoint: `/api/ldap-auth`
* Request Headers: `Authorization: Basic {Encoded Base64}`
* Request Parameter: `network={domain name}`