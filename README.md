# Kinub

![pp-logo](https://www.kinub.com/images/mesa%20de%20trabajo%202.png?crc=4015297829)

Kinub monorepo containing Kinub app and internal libs.

## Apps

- app
  - Controllers
  - Database
  - Filters
  - Helpers
  - Language
  - Libraries
  - Models
  - ThirdParty
  - Views
  - .htaccess
  - Common.php
  - index.html
- public
  - assets
    - css
    - fonts
    - img
    - js
    - libs
  - .htaccess
  - favicon.ico
  - index.php
  - robots.txt
- src 
  - img
  - js
  - sass
- system
- writable
- composer.json
- composer.lock
- depfile.yaml
- env
- gulpfile.js
- package.json
- package-lock.json
- phpstan-baseline.neon.dist
- spark

## Getting Started

This Project use Velzon as and admin panel. Velzon is built with Bootstrap v5.3.0 and Codeigniter 4 with developer friendly code. You can simply change the layouts and mode using this template.

### Prerequisites

- **Xampp or Wamp** Make sure to have [Xampp](https://www.apachefriends.org/download.html)) or [Wamp](https://www.wampserver.com/en/) with PHP v7.4 or higher version installed & running on your computer. If you already have installed Xampp or Wamp on your computer, you can skip this step.
- **Composer** Make sure to have the [Composer](https://getcomposer.org/) installed & running on your computer. If you already have installed Composer on your computer, you can skip this step.
- **Node** Make sure to have [Node](https://nodejs.org/es) installed & running on your computer. If you you al ready have installed Node on your 
computer, you can skip this step.

### Install

| Command            | Description                                                                                                                                                                               |
| ------------------ | :---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `composer install` | This would install all the required packages in the `vendor` folder. If you getting any error when running composer install command, don't worry please continue with : `composer update` |
| `npm install`      | This would install all the required packages in the `node_modules` folder                                                                                                                 |

### Build

### Test

### Deploy

### Run
| Command             | Description                                                                                                                           | 
| ------------------- | :------------------------------------------------------------------------------------------------------------------------------------ |
| `npm run dev`       | Build all the necessary assets for the project such as Css, Js and files like images.                                                 |

### Local

| Command                       | Description                                                                                                               |
| ----------------------------- | :------------------------------------------------------------------------------------------------------------------------ |
| `php spark serve`             | Runs the project locally. The development server is accessible at http://localhost:8080.                                  |
| `php spark serve --port 8081` | If You Wish to Runs the project locally on Different Port. The development server is accessible at http://localhost:8081. |

### Links
