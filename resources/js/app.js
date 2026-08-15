import './../css/app.css';
import { createInertiaApp } from '@inertiajs/svelte';
import { setMode } from 'mode-watcher';

setMode('light');

createInertiaApp();
