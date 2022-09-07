import "../css/app.css";

import { createApp, DefineComponent, h } from "vue";
import { createInertiaApp } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { plugin as FormKit } from "@formkit/vue";
import { formTheme } from "./formTheme";
// eslint-disable-next-line @typescript-eslint/ban-ts-comment
// @ts-ignore
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";

const appName =
    window.document.getElementsByTagName("title")[0]?.innerText || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob<DefineComponent>("./Pages/**/*.vue")
        ),
    setup({ el, app, props, plugin }) {
        createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(FormKit, formTheme)
            .mount(el);
    },
});

InertiaProgress.init({ color: "#4B5563" });
