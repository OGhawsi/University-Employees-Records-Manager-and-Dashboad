require('./bootstrap');

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';

import Chartkick from 'vue-chartkick';
import Highcharts from 'highcharts';
import 'chartkick/chart.js';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

import AuthenticatedLayout from '@/Layouts/Authenticated.vue'

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: name => {
        const page = require(`./Pages/${name}`).default
      if (page.layout === undefined && !name.startsWith('Public/')) {
        page.layout = page.layout || AuthenticatedLayout
      }
      return page
    },
    setup({ el, app, props, plugin }) {
        return createApp({ 
            render: () => h(app, props) 
          })
            .use(plugin)
            .use(Chartkick.use(Highcharts))
            .mixin({ methods: { route } })
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
