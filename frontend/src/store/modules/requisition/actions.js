import Requisition from "../../../services/api/RequisitionApi";


export const getRequisitions = ({ commit }) => {
  Requisition.all().then((response) => {
    commit("SET_REQUISITIONS", response.data);
  });
};

export const getItem = ({ commit }, id) => {
  Item.show(id).then((response) => {
    commit("SET_ITEM", response.data);
  });
};

export const storeRequisition = ({ commit, dispatch, rootState }, data) => {
  return Requisition.store(data).then((response) => {
    var data = response.data;
    commit("ADD_REQUISITION", { data });

    return JSON.stringify(response);
  });
};

export const updateItem = ({ commit }, data) => {
  return Requisition.update(data["0"], data["1"]).then((response) => {
    var data = response.data;
    commit("UPDATE_ITEM", { data });

    return JSON.stringify(response);
  });
};

export const deleteItem = ({ commit }, id) => {
  Requisition.delete(id).then((response) => {
    commit("DELETE_ITEM", response.data);
  });
};

export const approveRequisition = ({ commit }, id) => {
  Requisition.approve(id).then((response) => {
    commit("APPROVE_REQUISITION", response.data);
  });
};

export const rejectRequisition = ({ commit }, id) => {
  Requisition.reject(id).then((response) => {
    commit("REJECT_REQUISITION", response.data);
  });
};

export const issueRequisition = ({ commit }, data) => {
  return Requisition.issue(data).then((response) => {
    commit("ISSUE_REQUISITION", response.data);

    return JSON.stringify(response);
  });
};
