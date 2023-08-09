import Stock from "../../../services/api/StockApi";

export const getStocks = ({ commit }) => {
  Stock.all().then((response) => {
    commit("SET_STOCKS", response.data);
  });
};
