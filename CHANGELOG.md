# Changelog

All notable changes to this project will be documented in this file. See [standard-version](https://github.com/conventional-changelog/standard-version) for commit guidelines.

## [1.1.0](https://github.com/GabrielFNLima/magento2-pixqrcode/compare/v1.0.1...v1.1.0) (2024-03-24)


### Features

* Improve structure of payment display on checkout success and order views ([36867d7](https://github.com/GabrielFNLima/magento2-pixqrcode/commit/36867d77a706a28b76ba592a52994817c050fdb3))
* **logging:** add error handling for incorrect configuration ([dd34aa4](https://github.com/GabrielFNLima/magento2-pixqrcode/commit/dd34aa406262d2d981784fc935589b0e422ae650))
* **payment:** introduce new type of receive for proof of the payment via WhatsApp ([5b8eb80](https://github.com/GabrielFNLima/magento2-pixqrcode/commit/5b8eb8044ec623fb039f25182df8b8633996b0c5))
* **pwa-studio:** add PWA Studio integration for Pix QR Code ([6443207](https://github.com/GabrielFNLima/magento2-pixqrcode/commit/64432073b94e0c6f4e5296c03e477938b34a7736))
* **style-structure:** Adding a new style for the pix display on checkout success ([aaf3e32](https://github.com/GabrielFNLima/magento2-pixqrcode/commit/aaf3e321b45f70897ba4be84c3590d9d2cbe90ef))

### 1.0.1 (2023-09-07)


### Bug Fixes

* **success-page:** handle undefined array key error ([fd2284d](https://github.com/GabrielFNLima/magento2-pixqrcode/commit/fd2284d2bd5bdf18ac0684d7a8bf16288a48e22d)), closes [#1](https://github.com/GabrielFNLima/magento2-pixqrcode/issues/1)


## 1.0.0 (2023-06-12)


### Features

* **admin-panel:** Show PIX digitable line on admin panel order ([f6a395d](https://github.com/magento/magento2/commit/f6a395ddd7315e9d1ef689c8be65f9a67bb5983c))
* **customer-page:** Show digitable line on customer order page ([7be9380](https://github.com/magento/magento2/commit/7be93801952abe4dd7b9c02e7d8b700249d090d9))
* **customer-page:** Show PIX QR code and digitable line on customer order page ([21730fd](https://github.com/magento/magento2/commit/21730fd989d8e7418e21ac6c84fd185c89b381c1))
* **i18n:** Add translation support for pt_BR locale ([b931dc9](https://github.com/magento/magento2/commit/b931dc93b2f369f91cb0a6485e682b71cb232dee))
* **localization:** Add translation file for Brazilian Portuguese (pt_BR) ([3b2f1e2](https://github.com/magento/magento2/commit/3b2f1e2f4e71b3e75dbe3a634b6b284cfc04fdf0))
* **payment:** Add new configuration fields ([688fdb8](https://github.com/magento/magento2/commit/688fdb8d74767afadf0aabf6e9c6cd73d161b509))
* **payment:** Generate PIX payload ([1f84f26](https://github.com/magento/magento2/commit/1f84f264d5643e3db8c7f6261a0c9ff6f4d5ec1c))
* **payment:** Get comment for customer from configuration and display it on the payment method ([9420be0](https://github.com/magento/magento2/commit/9420be02607e8855b4657d8f3c0f053e85d225fe))
* **payment:** render simple payment ([ec90ed4](https://github.com/magento/magento2/commit/ec90ed4fc2636acad922dd9112290c601121deaf))
* **success-page:** Add conditional display for payment method on success page ([f741bd3](https://github.com/magento/magento2/commit/f741bd3dc1373585df5b3cbe773a0c038da50436))
* **success-page:** Show PIX QR code and digitable line on success page ([f91bc3e](https://github.com/magento/magento2/commit/f91bc3ecf273e4411be1f8444e84a7353925a889))
