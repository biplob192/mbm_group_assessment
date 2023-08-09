import state from "./state";
import * as getters from "./getters";
import * as mutations from "./mutations";
import * as actions from "./actions";

// First way to export modules state, getters, mutations ans actions
const store = {
  namespaced: true,
  state,
  getters,
  mutations,
  actions,
};

export default store;