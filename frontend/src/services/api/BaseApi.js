import axios from "axios";
import store from "../../store";

const baseURL = store.state.baseUrl;
// const access_token = store.state.access_token;
// const access_token = localStorage.getItem("access_token");
// axios.defaults.headers.common["Authorization"] = "Bearer " + access_token;

export function http(access_token) {
  return axios.create({
    baseURL: baseURL,
    headers: {
      Accept: "application/json",
      Authorization: "Bearer " + localStorage.getItem("access_token"),
    },
  });
}
