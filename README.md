# Codecept Finder

This is a helper CLI tool that queries codeception.yml files and associated test suite.xml files
to get a list of test filenames and print them. This is useful if you want to split tests to run
them in parallel based on timings on CI tools such as CircleCI.

It takes inspiration from phpunit-finder.

## Installation

Install with composer:

`composer require --dev cushon/codecept-finder`

## Usage

You can run by passing one or more test suite names as arguments:

`./vendor/bin/codecept-finder <test-suite-name>...`

## Configuration

codecept-finder assumes you have a codeception.yml in the working directory. You can
override the path using the `--config-file` option.
