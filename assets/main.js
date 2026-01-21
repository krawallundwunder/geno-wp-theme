import 'vite/modulepreload-polyfill';
import 'iconify-icon';
import FlyntComponent from './scripts/FlyntComponent';

import 'lazysizes';

import { addCollection } from 'iconify-icon';

if (import.meta.env.DEV) {
  import('@vite/client');
}

import.meta.glob([
  '../Components/**',
  '../assets/**',
  '!**/*.js',
  '!**/*.php',
  '!**/*.twig',
  '!**/screenshot.png',
  '!**/*.md',
]);

window.customElements.define('flynt-component', FlyntComponent);
