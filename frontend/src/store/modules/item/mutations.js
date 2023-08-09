export const SET_ITEMS = (state, response) => {
  state.items = response.data;
};

export const SET_ITEM = (state, response) => {
  state.item = response.data;
};

export const ADD_ITEM = (state, response) => {
  if (state.items.push(response.data)) {
    state.success_message = response.data.message;
  } else {
    state.success_message = "";
  }
};

export const UPDATE_ITEM = (state, response) => {
  // if (state.items.push(response.data)) {
  //   state.success_message = response.data.message;
  // } else {
  //   state.success_message = "";
  // }
};

export const DELETE_ITEM = (state, response) => { };