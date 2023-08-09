import Item from "../../../services/api/ItemApi";
// import store from "../../index";
import store from "../../../store";

export const getItems = ({ commit }) => {
  Item.all().then((response) => {
    commit("SET_ITEMS", response.data);
  });
};

export const getItem = ({ commit }, id) => {
  Item.show(id).then((response) => {
    commit("SET_ITEM", response.data);
  });
};

export const storeItem = ({ commit, dispatch, rootState }, data) => {
  return Item.store(data).then((response) => {
    var data = response.data;
    commit("ADD_ITEM", { data });

    return JSON.stringify(response);
  });
};

export const updateItem = ({ commit }, data) => {
  return Item.update(data["0"], data["1"]).then((response) => {
    var data = response.data;
    commit("UPDATE_ITEM", { data });

    return JSON.stringify(response);
  });
};

export const deleteItem = ({ commit }, id) => {
  Item.delete(id).then((response) => {
    commit("DELETE_ITEM", response.data);
  });
};
