# Javascript:  (vanilla and jQuery) code bundled with Vite bundler
Webpack bundler was used from v0 to v1.4.0 of the plugin, vite is used from 1.4.1 (2022).
Link to old configuration: [github](https://github.com/moxie-lean/patternlab-starterkit-twig).

The directories are organized following the [atomic design](http://bradfrost.com/blog/post/atomic-web-design/#atoms) philosophy so every UI element might be part of a template, organisms, molecule or atom.

This directory contains all the assets required to create the site and here
is where mostly all of your javascript code should be placed.  



# Tasks

### `npm run build`

This task run: vite build.

Vite creates a single JS file, which is placed in head section of your website.

This task creates a single JS file with no comments, removes [source maps](#whats-a-source-map) 
and creates a [minified](#whats-minification) version, this is useful to decrease the 
file size on the final version of the generated file.

### `npm run lint`

This task run: eslint main.js ./scripts --fix

Eslint checks js code for modern ecmascript standards specified in .eslint.json file (if you use VScode and Prettier, you will find .prettierrc.json useful for you).

### `npm run watch`

vite build --watch

Keeps track of every change on the JS files and generate the development version of the JS assets,
every time a new change is detected on the JS files. Developer don't have to run  `npm run build` 
manually after every change is made.


The rules of the linter are specified on the hidden file [`.eslintrc.json`](.eslintrc.json)

## FAQs
- [What's a source map?](#whats-a-source-map)
- [What's minification](#whats-minification)
- [How to add a new JS function / behavior ?](#how-to-add-a-new-js-function--behavior-)
  - [External resources](#external-resources)
- [How to use an external package from NPM?.](#how-to-use-an-external-package-from-npm)

### How to add new icons? 

### What's a source map?

Source Maps map minified code to source code. You can then read and debug compiled code 
in its original source, ([more info and details about how to enable it on Google Chrome](https://developers.google.com/web/tools/chrome-devtools/javascript/source-maps))

For more information about the usage of this helper function please take 
a [look here](https://github.com/moxie-lean/lean-theme/#use_icon).

### What's minification

Is the process of removing all unnecessary characters from source code without 
changing its functionality. [Wikipedia](https://en.wikipedia.org/wiki/Minification_programming) .

### How to add a new JS function / behavior ?

First of all you need to create a new file where it makes more sense for example we want to create a
listener for the click event in buttons so every time a button is clicked we want to add a new
class to the body.

In this case it would make sense to create a new atom called inside of (in our case `scripts` folder)
`atoms/buttons/toggle-button-listener.js` such as.

```js
// Everything inside of this file is going to be local to the scope of this file

const targetButtonClassName = '.fancy-button';
const toggleClassName = '.button-is-active';

function myMainAction() {
  const buttons = searchButtons();
  buttons.forEach( attachEvent );
}

function queryTheDOM() {
  return Array.from( document.querySelectorAll( targetButtonClassName ) ) ;
}

function attachEvent( node ) {
  node.addEventListener( 'click', clickListener );
}

function clickListener() {
  document.body.classList.toggle( toggleClassName );
}

export default myMainAction;
```

As you can see the example has several functions but the one that is exported to the outside world
is only `myMainAction` at this point this JS is not going to be executed unless you explicit espcify
so inside of [`main.js`](main.js) inside of the [`onReady`](main.js#L7) function, eveyrything inside
of this function is going to be executed once the DOM is ready. 

So following the example aboye you need to add this two lines inside of `main.js`

```js
import myMainAction from './atoms/buttons/toggle-button-listener';
// inside of onReady
function onReady() {
  // other functions before
  myMainAction();
}
```

**NOTE** The code is transpiled so can be executed on browsers where `import` or `export` is not
supported yet.

#### External resources

- [How `import` works](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Statements/import).
- [How `export` works](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Statements/export).


### How to use an external package from NPM?.

Inside of your own modules you can import files from `node_modules` you only need to make sure
you added the dependency inside of `package.json`.

And the sintax is pretty similar to `import action from 'package-name';` 

For example to add [`flatpickr`](https://chmln.github.io/flatpickr/) we need to run the following
command in to the terminal: 

```
npm install flatpickr --save-dev 
```

And to usage the package you only need to add: 

```js
import Flatpickr from 'flatpickr';
// Usage example
function init() {
  const node = document.querySelector('.flatpickr');
  const instance = new Flatpickr( node );
}

export default init;
```

