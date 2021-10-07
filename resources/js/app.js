require('./bootstrap');

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { formatMoney, hasAccess, lang, formatDate } from './mixins';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

const mixins = {
    methods: {
        route,
        formatMoney,
        hasAccess,
        lang,
        formatDate,
    }
};

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .mixin(mixins)
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
