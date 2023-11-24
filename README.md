# Kinub

![pp-logo](https://www.kinub.com/images/mesa%20de%20trabajo%202.png?crc=4015297829)

Kinub monorepo containing Kinub app and internal libs.

## Apps

# Kinub

- [.github/](.github)
  - [workflows/](.github\workflows)
  - [CODEOWNERS](.github\CODEOWNERS)
  - [pr-badge.yml](.github\pr-badge.yml)
  - [pull_request_template.md](.github\pull_request_template.md)
- [.husky/](.husky)
  - [commit-msg](.husky\commit-msg)
  - [pre-commit](.husky\pre-commit)
  - [pre-push](.husky\pre-push)
- [.vscode/](.vscode)
  - [extensions.json](.vscode\extensions.json)
  - [launch.json](.vscode\launch.json)
  - [README.md](.vscode\README.md)
  - [recommended-launch.json](.vscode\recommended-launch.json)
  - [recommended-settings.json](.vscode\recommended-settings.json)
- [app/](app)
  - [Config/](app\Config)
  - [Controllers/](app\Controllers)
  - [Database/](app\Database)
  - [Filters/](app\Filters)
  - [Helpers/](app\Helpers)
  - [Language/](app\Language)
  - [Libraries/](app\Libraries)
  - [Models/](app\Models)
  - [ThirdParty/](app\ThirdParty)
  - [Utils/](app\Utils)
  - [Validation/](app\Validation)
  - [Views/](app\Views)
  - [.htaccess](app.htaccess)
  - [index.html](app\index.html)
- [backup/](backup)
  - [Database.sql](backup\Database.sql)
- [public/](public)
  - [assets/](public\assets)
  - [uploads/](public\uploads)
  - [.htaccess](public.htaccess)
  - [favicon.ico](public\favicon.ico)
  - [index.php](public\index.php)
  - [robots.txt](public\robots.txt)
- [src/](src)
  - [admin/](src\admin)
  - [common/](src\common)
  - [images/](src\images)
  - [public/](src\public)
- [tests/](tests)
- [writable/](writable)
- [.editorconfig](.editorconfig)
- [.env](.env)
- [.env.example](.env.example)
- [.eslintignore](.eslintignore)
- [.eslintrc.js](.eslintrc.js)
- [.gitignore](.gitignore)
- [.hintrc](.hintrc)
- [.php-cs-fixer.dist.php](.php-cs-fixer.dist.php)
- [.prettierignore](.prettierignore)
- [.prettierrc](.prettierrc)
- [.stylelintignore](.stylelintignore)
- [.stylelintrc](.stylelintrc)
- [branch-name-lint.json](branch-name-lint.json)
- [builds](builds)
- [commitlint.config.js](commitlint.config.js)
- [composer.json](composer.json)
- [composer.lock](composer.lock)
- [CONTRIBUTING.md](CONTRIBUTING.md)
- [gulpfile.js](gulpfile.js)
- [LICENSE](LICENSE)
- [lint-staged.config.js](lint-staged.config.js)
- [package-lock.json](package-lock.json)
- [package.json](package.json)
- [phpunit.xml.dist](phpunit.xml.dist)
- [preload.php](preload.php)
- [README.md](README.md)
- [spark](spark)

## Getting Started

This Project use Velzon as and admin panel. Velzon is built with Bootstrap v5.3.0 and Codeigniter 4 with developer friendly code. You can simply change the layouts and mode using this template.

### Prerequisites

- **Wamp** Make sure to have [Wamp](https://www.wampserver.com/en/) or similar with PHP v8.2 or higher version installed, MySQL 8.0.34 or higher. If you already have installed Wamp or similar on your computer, you can skip this step.
- **Composer** Make sure to have the [Composer](https://getcomposer.org/) installed & running on your computer. If you already have installed Composer on your computer, you can skip this step.
- **Node** Make sure to have [Node](https://nodejs.org/es) installed & running on your computer. If you you al ready have installed Node on your
  computer, you can skip this step.
- **VirtualHost**Create a VirtualHost to this project using apache pointing to the `/public` folder the name could be similar to `http://kinub.cm`
- **.env** Make sure to copy the `.env.example` file and rename the file to just `.env`, then change the env variable to point to your VirtualHost
  `virtualHost = 'http://kinub.cm'`
- Make sure to configure your `.env` database a variables and email configuration.
- Make sure to read the [.vscode/README.md](.vscode\README.md) and follow the instructions.
- If you want to debug the app make sure to read this [documentation](https://loopcrack.atlassian.net/wiki/spaces/Kinub/pages/25100377/How+to+Debug+PHP+in+Our+Project+Using+CodeIgniter+4+XDEBUG+3+PHP+8+and+Visual+Studio+Code.)

### Install

| Command            | Description                                                                                                                                                                               |
| ------------------ | :---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `composer install` | This would install all the required packages in the `vendor` folder. If you getting any error when running composer install command, don't worry please continue with : `composer update` |
| `npm install`      | This would install all the required packages in the `node_modules` folder                                                                                                                 |

### Build

| Command         | Description                                                                                |
| --------------- | :----------------------------------------------------------------------------------------- |
| `npm run build` | Build all assets for the project such as Css, Js and files like images ready to production |

### Run Local

| Command              | Description                                                                                                                                                                                                              |
| -------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ |
| `npm run images`     | Minimizes the size of png/jpg/jpeg images as well as converts them to lightweight formats such as webp and avif and saves all image formats for production.                                                              |
| `npm run dev:public` | Build all the necessary assets for the project such as Css, Js on public area.                                                                                                                                           |
| `npm run dev:admin`  | Build all the necessary assets for the project such as Css, Js on admin area.                                                                                                                                            |
| `npm run dev:common` | Build all the necessary assets for the project such as Css, Js on common area.                                                                                                                                           |
| `npm run dev`        | Build all the necessary assets for the project such as Css, Js from all areas (admin, public, and common) and at the same time, runs the project locally. The development server is accessible at http://localhost:8080. |

### Test

### Deploy

### Links
