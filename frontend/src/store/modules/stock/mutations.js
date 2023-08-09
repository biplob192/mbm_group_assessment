export const SET_STOCKS = (state, response) => {
  state.stocks = response.data;
};