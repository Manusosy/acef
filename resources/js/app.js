import './bootstrap';
import './editor.js';
import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect';
import collapse from '@alpinejs/collapse';
import Sortable from 'sortablejs';

Alpine.plugin(intersect);
Alpine.plugin(collapse);
window.Alpine = Alpine;
window.Sortable = Sortable;

Alpine.start();
