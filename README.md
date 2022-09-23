# Codecept Finder

This is a helper CLI tool that queries phpunit.xml files to get a list of test
filenames and print them. This is useful if you want to split tests to run them
in parallel based on timings on CI tools such as CirclCI.

It takes inspiration from phpunit-finder.

## Installation

Install with composer:

`composer require --dev cushon/codecept-finder`

## Usage

You can run with defaults using:

`./vendor/bin/codecept-finder`

By default, it will look for all test suites to scan.

You can filter by specific test suites as follows:

`./vendor/bin/codecept-finder unit functional`

## Configuration

codecept-finder assumes you have a codeception.yml in the root of your project. You can
override the path using the `--config-file` option.
