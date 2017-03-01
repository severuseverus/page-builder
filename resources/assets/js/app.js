/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('navbar', require('./components/Navbar.vue'));
Vue.component('textChange', require('./components/TextChange.vue'));
Vue.component('pageBuilder', require('./components/PageBuilder.vue'));
Vue.component('pageContent', require('./components/PageContent.vue'));
Vue.component('templateRow', require('./components/TemplateRow.vue'));
Vue.component('imageChange', require('./components/ImageChange.vue'));
Vue.component('mediaChange', require('./components/MediaChange.vue'));
Vue.component('videoChange', require('./components/VideoChange.vue'));
Vue.component('templateList', require('./components/TemplateList.vue'));
Vue.component('templateCollectionChooser', require('./components/TemplateCollectionChooser.vue'));

import Sortable from './directives/Sortable';
import Draggable from './directives/Draggable';
import Droppable from './directives/Droppable';
import TextChangeable from './directives/TextChangeable';
import ContentEditable from './directives/ContentEditable';
import MediaChangeable from './directives/MediaChangeable';
import BackgroundChangeable from './directives/BackgroundChangeable';
import ImageSourceChangeable from './directives/ImageSourceChangeable';

Vue.directive('sortable', Sortable);
Vue.directive('draggable', Draggable);
Vue.directive('droppable', Droppable);
Vue.directive('text-changeable', TextChangeable);
Vue.directive('content-editable', ContentEditable);
Vue.directive('media-changeable', MediaChangeable);
Vue.directive('image-changeable', ImageSourceChangeable);
Vue.directive('background-changeable', BackgroundChangeable);

const app = new Vue({
    el: '#app'
});