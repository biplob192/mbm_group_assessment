import { createStore } from "vuex";
import state from "./state";
import * as getters from "./getters";
import * as mutations from "./mutations";
import * as actions from "./actions";

// Import Modules
import auth from "./modules/auth";
import item from "./modules/item";
import requisition from "./modules/requisition";
import stock from "./modules/stock";

const store = createStore({
  namespaced: true,
  state,
  getters,
  mutations,
  actions,

  modules: {
    auth,
    item,
    requisition,
    stock,
  },
});

export default store;
