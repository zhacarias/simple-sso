## Single sign-on

This project is created for centralized Single Sign-on API using e-Payslip and Active Directory as source credentials.

### Production Platform

- Programming Language: **[PHP 7.2.4](https://www.php.net/)**
- Framework: **[Slim](http://www.slimframework.com/)**
- Web Server: **[Apache 2.4.29](https://httpd.apache.org/)**
- DBMS:  **[Microsoft SQL Server 2016](https://www.microsoft.com/en-us/sql-server/sql-server-2016)**
- Operating System: **[CentOS Linux 7](https://centos.org/)**
- Driver: **[FreeTDS](https://www.freetds.org/)**

### License

> Unauthorized copying of this project, via any medium is strictly prohibited   
> Proprietary and confidential   
> Copyright (c) 2019, Intellectual Property of [SM Retail, Inc.](https://sminvestments.com/investments/retail) (ITS-BOS HRP)   
> All rights reserved.

### API Endpoint usage

##### SSO Authentication Base URL:  `https://sso.smretail.intranet`

###### e-Payslip

* HTTP Method: `GET/POST `
* Endpoint: `/api/authenticate`
* Request Headers: `Authorization: Basic {Encoded Base64}`

###### Active Directory

* HTTP Method: `POST `
* Endpoint: `/api/ldap-auth`
* Request Headers: `Authorization: Basic {Encoded Base64}`
* Request Parameter: `network={domain name}`