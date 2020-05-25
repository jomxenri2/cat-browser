import Vue from "vue";
import VueRouter from "vue-router";

import PageHome from "./pages/home";
import PageDetail from "./pages/detail";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            component: PageHome
        },
        {
            path: "/:id",
            component: PageDetail,
            props: true
        }
    ]
});

export default router;