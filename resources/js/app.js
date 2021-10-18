require("./bootstrap");
import VueRouter from "vue-router";
import router from "./routes";
import Index from "./Index";
import moment from "moment";
import FatalError from "./shared/components/FatalError";
import Success from "./shared/components/Success";
import ValidationErrors from "./shared/components/ValidationErrors";
import StarRating from "./shared/components/StarRating";

window.Vue = require("vue").default;

Vue.use(VueRouter);
Vue.filter("fromNow", value => moment(value).fromNow());

Vue.component("fatal-error", FatalError);
Vue.component("success", Success);
Vue.component("validation-errors", ValidationErrors);
Vue.component("star-rating", StarRating);

const app = new Vue({
    el: "#app",
    router,
    components: {
        "index": Index,
    }
});
