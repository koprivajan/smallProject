import Vue from "vue";
import Vuex from "vuex";
import SecurityModule from "./security";
import PostModule from "./post";
import HomeModule from "./home";


Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    security: SecurityModule,
    post: PostModule,
    home: HomeModule
  }
});
