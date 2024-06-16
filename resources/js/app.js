/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});

import ExampleComponent from './components/ExampleComponent.vue';
import SliderCarousel from './components/home/SliderCarousel.vue';
import CategoryNews from './components/home/CategoryNews.vue';
import LatestPopular from './components/home/LatestPopular.vue';
import SinglePost from './components/home/SinglePost.vue';
import SearchResult from './components/home/SearchResult.vue';
import CategoryPosts from './components/home/CategoryPosts.vue';
import MyPosts from './components/dashboard/MyPosts.vue';
import ManagePost from './components/dashboard/ManagePost.vue';

app.component('example-component', ExampleComponent);
app.component('slider-carousel', SliderCarousel);
app.component('category-news', CategoryNews);
app.component('category-posts', CategoryPosts);
app.component('latest-popular', LatestPopular);
app.component('search-result', SearchResult);
app.component('single-post', SinglePost);
app.component('my-posts', MyPosts);
app.component('manage-post', ManagePost);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');
