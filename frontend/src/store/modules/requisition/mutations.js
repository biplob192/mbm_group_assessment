export const SET_REQUISITIONS = (state, response) => {
  state.requisitions = response.data;
};

export const SET_REQUISITION = (state, response) => {
  state.requisition = response.data;
};

export const ADD_REQUISITION = (state, response) => {
  if (state.requisitions.push(response.data)) {
    state.success_message = response.data.message;
  } else {
    state.success_message = "";
  }
};

export const UPDATE_REQUISITION = (state, response) => {
  if (state.requisitions.push(response.data)) {
    state.success_message = response.data.message;
  } else {
    state.success_message = "";
  }
};

export const DELETE_REQUISITION = (state, response) => { };

export const APPROVE_REQUISITION = (state, response) => { 
  if (state.requisitions.push(response.data)) {
    state.success_message = response.data.message;
  } else {
    state.success_message = "";
  }
};

export const REJECT_REQUISITION = (state, response) => { 
  if (state.requisitions.push(response.data)) {
    state.success_message = response.data.message;
  } else {
    state.success_message = "";
  }
};

export const ISSUE_REQUISITION = (state, response) => { 
  if (state.requisitions.push(response.data)) {
    state.success_message = response.data.message;
  } else {
    state.success_message = "";
  }
};