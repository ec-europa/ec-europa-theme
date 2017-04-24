# Ec-Europa theme
Repository containing the drupal theme for the NextEuropa platform.

The Ec-Europa theme is a Drupal 7 theme, the one currently used by the info website (ec.europa.eu/info).
This theme is responsive (3 different breakpoints), it uses B.E.M naming convention, in integrates a procedure to generate a styleguide and it is based on a component driven design.

### 1. Installation

Place the content of this repository into a folder in sites/all/themes and enable the theme going to admin/appearance.
Install the needed libraries by running the included drush make file (drush make --no-core europa.make)
The Ec-Europa-theme uses bootstrap as the base theme, so you need to have also this theme, you can get it here: https://www.drupal.org/project/bootstrap


### 2. Development

There is a gruntfile in the root of this project, if you run npm install you will get grunt and if you run it a watcher will take care of compiling your sass files into the final css and to re-generate the styleguide.


### 3. Styleguide

This repository contains all the source files needed to generate the Ec-Europa styleguide, but it doesn't contain the generated styleguide.
In your local environment, in order to generate the styleguide you will need npm (package manager for JavaScript) to be installed on your system, once you have npm you can run npm install from the root of the Ec-Europa theme and you will get Kss which is the library we are using to generate the styleguide.
There is a phing task named gen-styleguide which can be used to facilitate the styleguide generation
./bin/phing gen-styleguide
The generated files are excluded in .gitignore, so you should never notice them doing a git diff, in any case do not add those files to the repository, please.

### Working with the styleguide in standalone mode

You can also develop on the style guide independently from Drupal theme.

- Download dependencies:

```bash
$ npm i

// Or

$ yarn
```

- Start development server

```bash
$ npm start

// Or

$ yarn start
```

Then open the http://localhost:8080 in your browser.

- Clear development environment

```bash
$ npm run clean
```

- Prepare assets for deployment
```bash
$ npm run dist
```

- Deploy to github pages (after running `npm run dist` of course)

```bash
$ npm run deploy
```
