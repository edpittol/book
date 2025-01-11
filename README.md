# Book

A playground about PHP development best practices.

It is a simple [Symfony](https://symfony.com/doc/current/index.html) application that allow a person to search books and bookmark them.

## Docker
The PHP dependencies for the project are managed by [Docker](https://docs.docker.com/). And the services by [Docker Compose](https://docs.docker.com/compose/).

## Installation

Run `composer install` to install the project. The directories created is for shared cache to speed up the installation of packages between projects.

```bash
mkdir -p ~/.docker_cache/{composer,symfony5}
docker compose run --rm -u $(id -u):$(id -g) php composer install
```

## Serve

```bash
docker compose up -d server
```

The application run on http://localhost:8080.

## Quality tools

### Tools

#### Codeception

[Codeception](https://codeception.com/) is a versatile testing framework for PHP, supporting unit, functional, and acceptance testing. It provides an elegant syntax for writing tests.

The decision to use it instead default Symfony tools was because it can be used in another non-Symfony projects with similar settings.

#### PHPStan

[PHPStan](https://phpstan.org/) is a static analysis tool designed to find bugs in your PHP code without running it. It catches issues and misuse early in development. PHPStan enhances code reliability and maintainability.

#### Rector

[Rector](https://github.com/rectorphp/rector) automates PHP code refactoring and upgrades. It's an indispensable tool for modernizing legacy projects, applying coding standards, and migrating to newer PHP versions or frameworks. It helps maintain the quality of updated projects.

#### PHP Coding Standards Fixer
[PHP CS Fixer](https://cs.symfony.com/) is a tool for automatically fixing PHP code to meet defined Symfony coding standards.

#### Infection

[Infection](https://infection.github.io/) is a mutation testing framework for PHP that evaluates the quality of your tests. It introduces small changes (mutations) into your code and checks whether your tests detect them. By identifying weak spots in your test coverage, Infection helps ensure your code is rigorously tested. It is very important to maintain high test quality.

### How to run

The `qa` Composer script run all tools.

```
docker compose run --rm -u $(id -u):$(id -g) php composer qa
```

## Contributing

The project welcomes discussions and suggestions. The goal is to learn together and improve our PHP development practices. Feel free to open discussions, issues, or pull requests with your ideas and feedback.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.
